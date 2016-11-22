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
                newP.find("a").html("[-]");
                g.after(newP);
            }else {
                g.remove();
            }

        }

//        $('#type_id').trigger('change');
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
                        {!! Form::open(['url' => '/admin/goods', 'files' => true, 'class' => 'form-horizontal']) !!}
                                <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home">
                                <br>
                                <div class="form-group">
                                    {!! Form::label('name', '商品名称', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('name', '', ['class' => 'form-control ']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('category_id', '商品分类: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('category_id', $categories, '', ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('brand_id', '品牌: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('brand_id', $brands, '', ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('market_price', '市场价', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('market_price', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('shop_price', '本店价', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('shop_price', '', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('logo', 'logo', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::file('logo', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_hot', '是否热卖: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_hot', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_new', '是否新品: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_new', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_best', '是否精品: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_best', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('is_on_sale', '是否销售: ', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('is_on_sale', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('sort_num', '排序', ['class' => 'col-sm-2 control-label' ]) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('sort_num', '100', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <br>
                                <textarea id="goods_desc" name="goods_desc"></textarea>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <br>

                                <div class="form-group" id="type_attr">
                                    {!! Form::label('type_id', '商品类型: ', ['class' => 'col-sm-2 control-label'] ) !!}
                                    <div class="col-sm-6">
                                        {!! Form::select('type_id', $types, '', ['class' =>
                                        'form-control js-example-basic-single', 'id' => 'type_id']) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="settings">
                                <div class="form-group">
                                    <br>
                                    <label class="col-sm-2 control-label"><a onclick="addNew
                                    (this)" href="javascript:void(0);">[+]</a>相册:</label>
                                    <div class="col-sm-6">
                                        {!! Form::file('pics[]', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!! Form::hidden('create_at', \Carbon\Carbon::now()) !!}
                        <a onclick="$('form').submit()" class="btn btn-success btn-block">添加商品</a>

                        {!! Form::close() !!}

                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
@endsection
