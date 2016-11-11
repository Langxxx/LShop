<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\BrandRepository;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Brand\CreateRequest;
use App\Http\Requests\Admin\Brand\UpdateRequest;


class BrandController extends Basecontroller
{
    protected $brand;

    public function __construct(BrandRepository $brandRepository)
    {
        parent::__construct();
        $this->brand = $brandRepository;
    }

    public function index()
    {
        $brands = $this->brand->paginate(15);
        return view('admin/brand/index', compact('brands'));
    }

    public function create(CreateRequest $request)
    {
        if ($request->getMethod() == 'POST') {
            $this->brand->create($request->except('_token'));
            return redirect('admin/brand');
        }
        return view('admin/brand/create');
    }

    public function edit(UpdateRequest $request, $brandID)
    {
        if ($request->getMethod() == 'PUT') {
            $this->brand->update($brandID, $request->except('_token'));
            return redirect('admin/brand');
        }
        $brand = $this->brand->find($brandID);
        return view('admin/brand/edit', compact('brand'));
    }
}
