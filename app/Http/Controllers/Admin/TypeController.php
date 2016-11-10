<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Eloquent\TypeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Type\UpdateRequest;
use App\Http\Requests\Admin\Type\CreateRequest;
use Alert;

class TypeController extends BaseController
{
    protected $type;

    public function __construct(TypeRepository $type)
    {
        parent::__construct();
        $this->type = $type;
    }

    public function index()
    {
        $types = $this->type->paginate(15);
        return view('admin/type/index', compact('types'));
    }

    public function create(CreateRequest $request)
    {
        if ($request->getMethod() == 'POST') {
            $this->type->create($request->except('_token'));
            Alert::success('添加了一个商品类型', '成功');
            return redirect('admin/type');
        }

        return view('admin/type/create');
    }

    public function edit(UpdateRequest $request, $typeID)
    {
        if ($request->getMethod() == 'PUT') {
            $this->type->update($typeID, $request->except('_token'));
            Alert::success('修改了一个商品类型', '成功');
            return redirect('admin/type');
        }
        $type = $this->type->find($typeID);
        return view('admin/type/edit', compact('type'));
    }
}
