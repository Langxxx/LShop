<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\AttributeRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\TypeRepository;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Requests\Admin\Category\CreateRequest;
use Alert;

class CategoryController extends BaseController
{
    protected  $category;
    protected  $type;
    protected  $attribute;

    public function __construct(CategoryRepository $category, TypeRepository $type, AttributeRepository $attribute)
    {
        parent::__construct();
        $this->category = $category;
        $this->type = $type;
        $this->attribute = $attribute;
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
        $types = $this->type->getTypesForSelect();
        return view('admin/category/create', compact('categories', 'types'));
    }

    public function edit(UpdateRequest $request, $catID)
    {
        if ($request->getMethod() == 'PUT') {
            $this->category->update($catID, $request->except('__token'));
            Alert::success('修改了一个分类', '成功');
            return redirect('admin/category');
        }
        $categories = $this->category->getCategoriesForSelect();
        $category = $this->category->find($catID);
//        $category->search_types = $this->attribute
//            ->findWhereIn('id', explode(',', $category->search_attr_id))
//            ->groupBy('type_id')
//            ->get();
//        $category->search_types = $this->attribute
//            ->findWhereIn('id', explode(',', $category->search_attr_id))
//            ->with(["type" => function($query) {
//                $query->with('attributes');
//            }])
//            ->groupBy('type_id')
//            ->get();
        $category->search_types = $this->attribute
            ->getSearchInfoByAttrIDs($category->search_attr_id);



        //todo 这里很奇怪,关联类型不起作用
//        $search_types = $this->attribute
//            ->findWhereIn('id', explode(',', $category->search_attr_id))
//        ->with("type")
//            ->whereIn('id', [1, 2, 3, 4])
//            ->get();
//        dd($search_types->first()->type);
////        foreach ($category->search_types as $search_type) {
////            dd($search_type);
////        }
//        dd($category->search_types->first());
        $types = $this->type->getTypesForSelect();
        return view('admin/category/edit', compact('categories', 'category', 'types'));
    }

    public function destroy($catID)
    {
    }

    public function ajaxGetAttrForSelect($typeID)
    {
        $ret = $this->type->find($typeID)->attributes()->select('attributes.name', 'attributes.id')->get();
        return response()->json(['status' => true, 'content' => $ret]);
    }
}
