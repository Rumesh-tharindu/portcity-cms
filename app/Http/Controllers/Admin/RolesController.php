<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct(Role $model, Permission $permission)
    {
        $this->model = new RoleRepository($model);
        $this->permission = new PermissionRepository($permission);
    }

    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.role.index');
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permission->all()->groupBy(function ($item, $key) {

            return explode(".", $item->name)[1];     //treats the name string as an array
        })
            ->sortBy(function ($item, $key) {      //sorts A-Z at the top level
                return $key;
            });

        $routesArr = [];
            foreach($permissions as $permission){
                foreach($permission as $routeName){
                $nameSegments = explode(".", $routeName->name);
                $routesArr[] = $this->buildingDynamicAssociativeArray($nameSegments, $routeName->name);

                }
            }

        $permissions = $this->array_merge_deep_array($routesArr);

        return view('backend.role.create', compact('permissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolesRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->except('permission');

                if ($model = $this->model->create($data)) {

                    $permissions = $request->input('permission') ? $request->input('permission') : [];

                    $model->givePermissionTo($permissions);

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
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = $this->permission->all()->groupBy(function ($item, $key) {

            return explode(".", $item->name)[1];     //treats the name string as an array
        })
            ->sortBy(function ($item, $key) {      //sorts A-Z at the top level
                return $key;
            });

        $routesArr = [];
        foreach ($permissions as $permission) {
            foreach ($permission as $routeName) {
                $nameSegments = explode(".", $routeName->name);
                $routesArr[] = $this->buildingDynamicAssociativeArray($nameSegments, $routeName->name);
            }
        }

        $permissions = $this->array_merge_deep_array($routesArr);

        $rolePermissions = $this->model->show($id)->permissions->pluck('name')->toArray();

        return view('backend.role.edit', ['model' => $this->model->show($id), 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]);
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->except('permission');

                if ($this->model->update($data, $id)) {

                    $model = $this->model->show($id);

                    $permissions = $request->input('permission') ? $request->input('permission') : [];

                    $model->syncPermissions($permissions);

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
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            if (!auth()->user()->hasRole($this->model->show($id)->name) && $this->model->delete($id)) {
                return redirect()->back()->withSuccess('Success!');
            }

            return redirect()->back()->withFail('Failed!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->withFail('Failed!');
        }
    }

    public function buildingDynamicAssociativeArray($arr, $value) {
        if (!count($arr)) {
            return $value;
        }
        foreach (array_reverse($arr) as $key) {
            $dynamicAssociativeArr = [$key => $value];
            $value = $dynamicAssociativeArr;
        }
        return $dynamicAssociativeArr;
    }

    public function array_merge_deep()
    {
        $args = func_get_args();
        return $this->array_merge_deep_array($args);
    }

    public function array_merge_deep_array($arrays)
    {
        $result = array();
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                // Renumber integer keys as array_merge_recursive() does. Note that PHP
                // automatically converts array keys that are integer strings (e.g., '1')
                // to integers.
                if (is_integer($key)) {
                    $result[] = $value;
                } elseif (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                    $result[$key] = $this->array_merge_deep_array(array(
                        $result[$key],
                        $value,
                    ));
                } else {
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }
}
