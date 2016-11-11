@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '商品管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/goods/') }}'">商品列表</button>
@endsection
@section('FooterCSSAndJS')
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>

    <script src="/js/admin/it.js"></script>
    <script src="/js/admin/nl.js"></script>

    <script type="text/javascript">
        $(".js-example-basic-single").select2();
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
                        {!! Form::open(['url' => '/admin/goods', 'files' => true]) !!}
                                <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home">
                                <br>
                                <div class="form-group">
                                    {!! Form::label('name', '商品名称') !!}
                                    {!! Form::text('name', '', ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('category_id', '商品分类: ') !!}
                                    {!! Form::select('category_id', $categories, '', ['class' => 'form-control js-example-basic-single']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('brand_id', '品牌: ') !!}
                                    {!! Form::select('brand_id', $brands, '', ['class' => 'form-control js-example-basic-single']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('market_price', '市场价') !!}
                                    {!! Form::text('market_price', '', ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('shop_price', '本店价') !!}
                                    {!! Form::text('shop_price', '', ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('logo', 'logo') !!}
                                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::label('is_hot', '是否热卖: ') !!}
                                    {!! Form::select('is_hot', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::label('is_new', '是否新品: ') !!}
                                    {!! Form::select('is_new', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::label('is_best', '是否精品: ') !!}
                                    {!! Form::select('is_best', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::label('is_on_sale', '是否销售: ') !!}
                                    {!! Form::select('is_on_sale', ['0' => '否', '1' => '是'], 0, ['class' => 'form-control js-example-basic-single']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('sort_num', '排序') !!}
                                    {!! Form::text('sort_num', '100', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h4>Profile Tab</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <h4>Messages Tab</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
