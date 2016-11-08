@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '权限管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/permission/') }}'">权限列表</button>
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
                    添加权限
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
                    {!! Form::open(['url' => '/admin/permission/' . $permission->id, 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', '权限名称') !!}
                        {!! Form::text('name', $permission->name, ['class' => 'form-control', 'placeholder' => '列如: admin.permissions.list']) !!}
                        <p class="help-block">用于后台控制角色访问使用.</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('pid', '父级权限') !!}
                        {!! Form::select('pid', $permissions, $permission->pid, ['class' => 'form-control js-example-basic-single']) !!}
                        <p class="help-block">用于后台控制角色访问使用.</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('display_name', '权限展示名称') !!}
                        {!! Form::text('display_name', $permission->display_name, ['class' => 'form-control']) !!}
                        <p class="help-block">用于展示的权限名称.</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', '权限描述') !!}
                        {!! Form::text('description', $permission->description, ['class' => 'form-control']) !!}
                        <p class="help-block">权限描述.</p>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <a onclick="$('form').submit()" class="btn btn-success btn-block">保存</a>

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
