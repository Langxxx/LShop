<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\AttributeRepository;
use App\Repositories\Eloquent\TypeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\Attribute\UpdateRequest;
use App\Http\Requests\Admin\Attribute\CreateRequest;

class AttributeController extends BaseController
{
    protected $attribute;
    protected $type;

    public function __construct(AttributeRepository $attribute, TypeRepository $type)
    {
        //todo 这里是否可以使用中间件在路有中直接注册?
        parent::__construct();
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function index($typeID)
    {
        $type = $this->type->find($typeID);
        $attributes = $type->attributes()->paginate(15);
        return view('admin/attribute/index', compact('attributes', 'type'));
    }

    public function create(CreateRequest $request, $typeID)
    {
        if ($request->getMethod() == 'POST') {
            $this->attribute->create($request->except('_token'));
            return redirect('admin/attribute/' . $request->input('type_id'));
        }
        $types = $this->type->getTypesForSelect();
        return view('admin/attribute/create', compact('types', 'typeID'));
    }

    public function edit(UpdateRequest $request, $attrID)
    {
        if ($request->getMethod() == 'PUT') {
            $this->attribute->update($attrID, $request->except('_token'));
            return redirect('admin/attribute/' . $request->input('type_id'));
        }
        $attr = $this->attribute->find($attrID);
        $types = $this->type->getTypesForSelect();
        return view('admin/attribute/edit', compact('types', 'attr'));
    }
}
