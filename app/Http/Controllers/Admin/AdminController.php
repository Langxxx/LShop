<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\CreateRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use Alert;

class AdminController extends BaseController
{
    protected $admin;
    protected $role;

    public function __construct(AdminRepository $admin, RoleRepository $role)
    {
        parent::__construct();
        $this->admin = $admin;
        $this->role = $role;
    }

    public function index()
    {
        $admins = $this->admin->paginate(5);
        return view('admin/admin/index', compact('admins'));
    }

    public function create(CreateRequest $request)
    {
        if ($request->getMethod() == 'POST') {
            return $this->store($request->except('_token'));
        }
        $roles = $this->role->getRolesForSelect();
        return view('admin/admin/create', compact('roles'));
    }

    protected function store($attributes)
    {
        $this->admin->create($attributes);
        Alert::success('添加了一个管理员', '成功');
        return redirect('admin/admin');
    }

    public function edit(UpdateRequest $request,$adminID)
    {
//        dd($request->getMethod());
        if ($request->getMethod() == 'PUT') {
            return $this->update($adminID, $request->except(['_token', 'email']));
        }

        $admin = $this->admin->getAdminWithRoles($adminID);
        $roles = $this->role->getRolesForSelect();
        return view('admin/admin/edit', compact('admin', 'roles'));
    }

    protected function update($adminID, $attributes)
    {
        $this->admin->update($adminID, $attributes);
        Alert::success('修改成功', '成功');
        return redirect('admin/admin');
    }
}
