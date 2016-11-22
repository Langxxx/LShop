@extends('admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '商品管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/goods/') }}'">商品列表</button>
@endsection
@section('HeaderCSSAndJS')
    <script type="text/javascript" charset="utf-8" src="/js/admin/UEditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/js/admin/UEditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/lang/zh-cn/zh-cn.js"></script>

    <meta name="_token" content="{{ csrf_token() }}">
    <script src="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">

@endsection
@section('FooterCSSAndJS')
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>

    <script src="/js/admin/it.js"></script>
    <script src="/js/admin/nl.js"></script>

    <script type="text/javascript">
        $(".js-example-basic-single").select2();
    </script>
    <script>
        UE.getEditor('goods_desc', {
            "maximumWords" : 10000            // 最大可以输入的字符数量
        });
    </script>
    <script src="/js/admin/goods.js"></script>
    <script>
        $("select[name=type_id]").change(function() {
            var typeID = $(this).val();
            console.log(typeID)
            if (typeID == 0) {
                $('#type_attr').nextAll().remove();
                return;
            }
            getTypeAttrView("{{ url('admin/goods/ajaxGetAttr') }}" + '/' +  typeID);
        });

        function addNew(a) {
            var g = $(a).parent().parent();

            if ($(a).html() == "[+]") {
                var newP = g.clone();

                if  (newP.find("select").length > 0) {
                    var oldName = newP.find("select").attr("name");
                    var newName = oldName.replace("old_", "");
                    newName = newName.slice(0, newName.indexOf(']') + 1) + '[]';
                    newP.find("select").attr("name", newName);

                    var oldInputName = newP.find("input").attr("name");
                    var newInputName = oldInputName.replace("old_", "");
                    newInputName = newInputName.slice(0, newInputName.indexOf(']') + 1) + '[]';
                    newP.find("input").attr("name", newInputName);

                    newP.find("a").removeAttr("attriD");

                }else {
                    newP.find("a").removeAttr("picID");
                    newP.find("img").remove();
                }

                newP.find("a").html("[-]");
                g.after(newP);
            } else {
                if (g.find("select").length > 0) {
                    var attrID = $(a).attr('attrId');
                    if (attrID) {
                        var url = "{{ url('admin/goods/ajaxDeleteAttr') }}" + '/' +  attrID + '/' + {{ $goods->id }};
                         ajaxDelete(url, '您正在删除一个属性!', '属性已经被删除', function() {
                             g.remove();
                         });
                    }else {
                        goodsDelete('您正在删除一个属性!', function() {
                            swal("删除成功!", "属性已经删除.", "success");
                            g.remove();
                        });
                    }
                }else {
                    var picID = $(a).attr('picID');
                    if (picID) {
                        var url = "{{ url('admin/goods/ajaxDeleteImg') }}" + '/' +  picID;
                        ajaxDelete(url, '您正在删除一个图片!', '图片已经被删除', function() {
                            g.remove();
                        });
                    }else {
                        goodsDelete('您正在删除一个图片!', function() {
                            swal("删除成功!", "图片已经被删除.", "success");
                            g.remove();
                        });
                    }
                }
            }
        }
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    添加商品
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                                <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab"
                                                  aria-expanded="true">基本信息</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab"
                                            aria-expanded="false">商品描述</a>
                            </li>
                            <li class=""><a href="#messages" data-toggle="tab"
                                            aria-expanded="false">商品属性</a>
                            </li>
                            <li class=""><a href="#settings" data-toggle="tab"
                                            aria-expanded="false">商品相册</a>
                            </li>
                        </ul>

                        {!! Form::open(['url' => '/admin/goods/' . $goods->id,'method' => 'PUT', 'files' => true, 'class' => 'form-horizontal']) !!}
                                <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home">
                                <br>
                                <div class="form-group">
                                    {!! Form::label('name', '商品名称', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('name', $goods->name, ['class' => 'form-control ']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('category_id', '商品分类: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('category_id', $categories, $goods->category->id, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('brand_id', '品牌: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('brand_id', $brands, isset($goods->brand) ? $goods->brand->id : '', ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('market_price', '市场价', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('market_price', $goods->market_price, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('shop_price', '本店价', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('shop_price', $goods->shop_price, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('logo', 'logo', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::file('logo', ['class' => 'form-control']) !!}
                                        {{ showImg($goods->sm_logo, 100, 100) }}
                                        {!! Form::hidden('old_logo', $goods->logo) !!}
                                        {!! Form::hidden('old_sm_logo', $goods->sm_logo) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_hot', '是否热卖: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_hot', ['0' => '否', '1' => '是'], $goods->is_hot, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_new', '是否新品: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_new', ['0' => '否', '1' => '是'], $goods->is_new, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_best', '是否精品: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_best', ['0' => '否', '1' => '是'], $goods->is_best, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_on_sale', '是否销售: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_on_sale', ['0' => '否', '1' => '是'], $goods->is_on_sale, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('sort_num', '排序', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('sort_num', $goods->sort_num, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <br>
                                <textarea id="goods_desc" name="goods_desc">{{ $goods->goods_desc }}</textarea>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <br>

                                <div class="form-group" id="type_attr">
                                    {!! Form::label('type_id', '商品类型: ', ['class' => 'col-sm-2 control-label'] ) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('type_id', $types, $goods->type->id, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>

                                @inject('goodsService', 'App\Services\GoodsAttributeViewService')
                                {!! $goodsService->getGoodsAttributeView($goods->goodsAttributes, $goods->type->id) !!}
                            </div>
                            <div class="tab-pane fade" id="settings">
                                <br>
                                @if(count($goods->pics) == 0)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><a onclick="addNew(this)" href="javascript:void(0);">[+]</a>相册:</label>
                                        <div class="col-sm-6">
                                            {!! Form::file('pics[]', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                @endif
                                @foreach($goods->pics as $key => $pic)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><a picid = '{{ $pic->id }}'  onclick="addNew(this)" href="javascript:void(0);">{!! $key == 0 ? '[+]' : '[-]' !!}</a>相册:</label>
                                        <div class="col-sm-6">
                                        {!! Form::file('pics[]', ['class' => 'form-control']) !!}
                                        {!! showImg($pic->pic, 50, 50) !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {!! Form::hidden('create_at', \Carbon\Carbon::now()) !!}
                        {!! Form::hidden('old_type_id', $goods->type->id) !!}
                        <a onclick="$('form').submit()" class="btn btn-success btn-block">保存</a>

                        {!! Form::close() !!}

                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
@endsection
