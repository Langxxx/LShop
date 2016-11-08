<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Role\CreateRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;

class RoleController extends BaseController
{
    protected $role;
    protected $permission;

    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        parent::__construct();
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->getRolesWithPermissionsName();
        return view('admin/role/index', compact('roles'));
    }

    public function create(CreateRequest $request)
    {
        if ($request->getMethod() == 'POST') {
            return $this->store($request->except('_token'));
        }

        $permissions = $this->permission->getPermissionsForSelect(false);
        return view('admin/role/create', compact('permissions'));
    }

    protected function store(array $attributes)
    {
        //创建一个角色
        $role = $this->role->create($attributes);
        Alert::success('添加了一个新角色', '成功');
        return redirect('admin/role');
    }

    public function edit(UpdateRequest $request, $roleID)
    {
        if ($request->getMethod() == 'PUT') {
            return $this->update($roleID, $request->except('_token'));
        }
        $role = $this->role->getRoleWithPermission($roleID);
        $permissions = $this->permission->getPermissionsForSelect(false);
        return view('admin/role/edit', compact('role', 'permissions'));
    }

    protected function update($roleID, array $attributes)
    {
        $this->role->update($roleID, $attributes);
        Alert::success('修改了一个角色', '成功');
        return redirect('admin/role');
    }

    public function destroy($roleID)
    {
        return response()->json($this->role->delete($roleID));
    }
}
