<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Requests\Admin\Category\CreateRequest;
use Alert;

class CategoryController extends BaseController
{
    protected  $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->getAllCategoriesWithParentName()->paginate(15);
        return view('admin/category/index', compact('categories'));
    }

    public function create(CreateRequest $request)
    {
        if ($request->getMethod() == 'POST') {
            $this->category->create($request->except('__token'));
            Alert::success('添加了一个分类', '成功');
            return redirect('admin/category');
        }

        $categories = $this->category->getCategoriesForSelect();
        return view('admin/category/create', compact('categories'));
    }

    public function edit(UpdateRequest $request, $catID)
    {
        if ($request->getMethod() == 'PUT') {
            $this->category->update($catID, $request->except('__token'));
            Alert::success('添加了一个管理员', '成功');
            return redirect('admin/category');
        }
        $categories = $this->category->getCategoriesForSelect();
        $category = $this->category->find($catID);
        return view('admin/category/edit', compact('categories', 'category'));
    }

    public function destroy($catID)
    {
    }
}
