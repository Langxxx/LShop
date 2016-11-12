@extends('Admin.layouts.app')

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
    <script>
        //选择类型执行AJAX取出类型的属性
        $("select[name=type_id]").change(function() {
            $typeID = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ url('admin/goods/ajaxGetAttr') }}" + '/' +  $typeID,
                dateType: 'json',
                success: function (response) {
                    if (response['status']) {
                        var attributes = response['content'];
                        var html = '';
                        $(attributes).each(function (k, v) {
                            {{--html += '{!! Form::label('type_id', '商品类型: ') !!}';--}}
//                            html += "<label>" + v['name']  + ":</label>";



                            if (v.type == 1) { //判断是否是可选
                                html += "<label class='col-sm-2 control-label'>" + v['name']  + ":</label>";
                                html += '<div class="input-group " style="margin-bottom: 15px">';
                                html += '<span class="input-group-btn">';
                                html += '<button class="btn btn-default" ' +
                                        'type="button">[+]</button>';
                                html += '</span>';
//                                html += ' </div>'
                            }else {
                                html += "<label class='col-sm-2 control-label'>" + v['name']  + ":</label>";
                                html += "<div class='input-group'>";
                            }

                            if (v.option_value == "") {
                                html += '<div class="col-sm-10">';
                                html += "<input class='form-control'>";
                                html += '</div>';
                            }else {
                                html += '<div class="col-sm-10" style="padding-left: 0px">';
                                //把可选值转化成下拉框
                                var attr = v.option_value.split(',');
                                html += "<select class='form-control'>";
                                for (var i = 0; i < attr.length; i++) {
                                    html += "<option value='" +  attr[i] + "'>" + attr[i] + "</option>";
                                }
                                html += "</select>"
                                html += '</div>';
                            }
                            if (v.type == 1) {
//                                html += "<input class='form-control'>";

                            }


//                            html += '<div class="form-group">';

                            html += '</div>'
                        });
                        {{--var html = "";--}}
                        {{--$(attributes).each(function (k, v) {--}}
                        {{--html += "<div class='form-group'>";--}}
                        {{--html += "{!! Form::label('type_id', '商品类型: ') !!}";--}}
                        {{--html += "</div>"--}}
                        {{--});--}}
                        $('#type_attr').nextAll().remove();
                        $('#type_attr').after(html);
                    }
                }
            })
        })
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
                                        {!! Form::select('type_id', $types, '', ['class' => 'form-control js-example-basic-single']) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="settings">
                                <h4>Settings Tab</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
