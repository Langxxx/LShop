@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '角色管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/role/') }}'">角色列表</button>
@endsection

@section('FooterCSSAndJS')
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>

    <script src="/js/admin/it.js"></script>
    <script src="/js/admin/nl.js"></script>

    <script type="text/javascript">
        $(".js-example-basic-multiple").select2({
            placeholder : '请选择权限'
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    添加角色
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
                        {!! Form::open(['url' => '/admin/role']) !!}
                        <div class="form-group">
                            {!! Form::label('name', '角色名称') !!}
                            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => '列如: admin']) !!}
                            <p class="help-block">用于后台控制角色访问使用.</p>
                        </div>
                        <div class="form-group">
                            {!! Form::label('display_name', '角色展示名称') !!}
                            {!! Form::text('display_name', '', ['class' => 'form-control']) !!}
                            <p class="help-block">用于展示的角色名称.</p>
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', '角色描述') !!}
                            {!! Form::text('description', '', ['class' => 'form-control']) !!}
                            <p class="help-block">角色描述.</p>
                        </div>
                        <div class="form-group">
                            {!! Form::label('role_permission', '添加权限') !!}
                            {!! Form::select('role_permission[]', $permissions, null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => '"multiple"' ]) !!}
                            <p class="help-block">角色所具备的权限.</p>
                        </div>

                        <!-- Change this to a button or input when using this as a form -->
                        <a onclick="$('form').submit()" class="btn btn-success btn-block">添加角色</a>

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
