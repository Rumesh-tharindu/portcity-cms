<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct(User $model)
    {
        $this->model = new UserRepository($model);
    }

    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.user.index');
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'name');

        return view('backend.user.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                if ($model = $this->model->create($data)) {
                    $roles = $request->input('roles') ? $request->input('roles') : [];

                    $model->assignRole($roles);

                    event(new Registered($model));

                    $request->session()->flash('success', 'Success!...Email Verification Sent!');

                    return response()->json(['message' => 'Success!']);
                }

                return response()->json(['message' => 'Not Found!'], 404);
            } catch (\Exception $e) {
                Log::error($e->getMessage());

                return response()->json(['message' => 'Error!'], 400);
            }
        }

        return abort(400);
    }

    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::get()->pluck('name', 'name');

        return view('backend.user.edit', ['model' => $this->model->show($id), 'roles' => $roles]);
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                if ($this->model->update($data, $id)) {
                    $model = $this->model->show($id);
                    $roles = $request->input('roles') ? $request->input('roles') : [];
                    $model->syncRoles($roles);

                    $request->session()->flash('success', 'Success!');

                    return response()->json(['message' => 'Success!']);
                }

                return response()->json(['message' => 'Not Found!'], 404);
            } catch (\Exception $e) {
                Log::error($e->getMessage());

                return response()->json(['message' => 'Error!'], 400);
            }
        }

        return abort(400);
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(auth()->id() == $id || $id == 1){
                return redirect()->back()->withFail('Failed!');
            }
            if ($this->model->delete($id)) {
                return redirect()->back()->withSuccess('Success!');
            }

            return redirect()->back()->withFail('Failed!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->withFail('Failed!');
        }
    }

    public function showChangePasswordGet()
    {
        return view('backend.user.change-password');
    }

    public function changePasswordPost(ChangePasswordRequest $request)
    {
        //Change Password
        try {
            DB::transaction(function () use ($request) {
                $user = auth()->user();
                $user->password = $request->get('password');
                $user->save();
            });

            return redirect()->back()->withSuccess('Success!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->withFail('Failed!');
        }
    }

    public function sendEmailVerificationNotification(User $user)
    {
        try {
            if (is_null($user->email_verified_at)) {
                DB::transaction(function () use ($user) {
                    $user->sendEmailVerificationNotification();
                });

                return redirect()->back()
                ->withSuccess('Success, Email Verification Sent!');
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->withFail('Failed!');
        }

        return redirect()->back()->withFail('Failed!');
    }
}
