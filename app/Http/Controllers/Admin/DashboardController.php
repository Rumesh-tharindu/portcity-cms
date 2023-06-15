<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = AuthenticationLog::with('authenticatable')->select('authentication_log.*');

            return DataTables::eloquent($model)
                ->filter(function ($query) {
                    $query->whereHasMorph(
                        'authenticatable',
                        [User::class],
                        function ($q) {
                            $q->when(! auth()->user()->hasRole('Super Admin'), function ($query) {
                                $query->where('authenticatable_id', auth()->id());
                            });
                        }
                    );
                }, true)
                ->filterColumn('authenticatable.name', function ($query, $keyword) {
                    $userIds = AuthenticationLog::whereHasMorph(
                        'authenticatable',
                        [User::class],
                        function ($subquery, $type) use ($keyword) {
                            if ($type === User::class) {
                                $subquery->where('name', 'like', '%'.$keyword.'%')
                                    ->orWhere('email', 'like', '%'.$keyword.'%');
                            }
                        }
                    )->get()->pluck('id')->toArray();

                    $query->whereIn('authenticatable_id', $userIds);
                })
                ->editColumn('user_agent', function ($model) {
                    $agent = tap(new \Jenssegers\Agent\Agent, fn ($agent) => $agent->setUserAgent($model->user_agent));
                    $user_agent = $agent->platform().' - '.$agent->browser();

                    return $user_agent;
                })
                ->editColumn('location', function ($model) {
                    $location = $model->location && $model->location['default'] === false ? $model->location['city'].', '.$model->location['state'] : '-';

                    return $location;
                })
                ->editColumn('login_at', function ($model) {
                    $login_at = $model->login_at ? \Timezone::convertToLocal($model->login_at) : '-';

                    return $login_at;
                })
                ->editColumn('login_successful', function ($model) {
                    $login_successful = ($model->login_successful === true) ? 'Yes' : 'No';

                    return $login_successful;
                })
                ->editColumn('logout_at', function ($model) {
                    $logout_at = $model->logout_at ? \Timezone::convertToLocal($model->logout_at) : '-';

                    return $logout_at;
                })
                ->editColumn('cleared_by_user', function ($model) {
                    $cleared_by_user = ($model->cleared_by_user === true) ? 'Yes' : 'No';

                    return $cleared_by_user;
                })
                ->toJson();
        }

        return view('backend.dashboard.index');
    }
}
