<?php

namespace App\Http\Controllers\admin;

use App\Repositories\Eloquent\PermissionRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Admin\Permission\CreateRequest;
use App\Http\Requests\Admin\Permission\UpdateRequest;
use Alert;

class PermissionController extends Controller
{

    protected  $permission;

    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }

    public function index()
    {
        $permissions = $this->permission->paginate(5);

        return view('admin/permission/index', compact('permissions'));
    }

    public function create(CreateRequest $request)
    {
        if ($request->getMethod() == 'POST') {
            return $this->store($request->except('_token'));
        }

        $permissions = $this->permission->getPermissionsForSelect();
        return view('admin/permission/create', compact('permissions'));
    }

    protected function store(array $attribute) {
        $ret = $this->permission->create($attribute);
        if (!$ret) {
            Alert::error('添加失败', '失败');
            return redirect('admin/permission/create');
        }else {
            Alert::success('添加了一个新权限', '成功');
            return redirect('admin/permission');
        }
    }

    function edit(UpdateRequest $request, $permissionID)
    {
        if ($request->getMethod() == 'PUT') {
            return $this->update($permissionID, $request->except('_token'));
        }

        $permission = $this->permission->find($permissionID);
        $permissions = $this->permission->getPermissionsForSelect();
        return view('admin/permission/edit', compact('permission', 'permissions'));
    }

    protected function update($permissionID, array $attribute) {
        //todo 这里有bug,更新的时候,pid应该不能为自己或自己的子权限
        $ret = $this->permission->update($permissionID, $attribute);
        if (!$ret) {
            Alert::error('修改权限失败', '失败');
            return redirect('admin/permission/create');
        }else {
            Alert::success('修改权限成功', '成功');
            return redirect('admin/permission');
        }
    }

    public function destroy($permissionID)
    {
        $permission = $this->permission->find($permissionID);
        if ($permission) {
            $ret = $this->permission->delete($permissionID);
            return response()->json($ret);
        }else {
            return response()->json(['status' => false]);
        }
    }
}
