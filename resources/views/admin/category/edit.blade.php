@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '商品分类管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/category/')
     }}'">商品分类列表</button>
@endsection

@section('FooterCSSAndJS')
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>

    <script src="/js/admin/it.js"></script>
    <script src="/js/admin/nl.js"></script>

    <script type="text/javascript">
        $(".js-example-basic-single").select2({
            placeholder : '请选择分类'
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    添加商品分类
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
                    {!! Form::open(['url' => '/admin/category/' . $category->id, 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', '商品分类名称') !!}
                        {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => '列如: admin']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('parent_id', '父级分类') !!}
                        {!! Form::select('parent_id', $categories, $category->parent_id, ['class' => 'form-control js-example-basic-single' ]) !!}
                    </div>

                    <!-- Change this to a button or input when using this as a form -->
                    <a onclick="$('form').submit()" class="btn btn-success btn-block">添加商品分类</a>

                    {!! Form::close() !!}

                            <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

@endsection
