@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '管理员管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/admin/') }}'">管理员列表</button>
@endsection

@section('FooterCSSAndJS')
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>

    <script src="/js/admin/it.js"></script>
    <script src="/js/admin/nl.js"></script>

    <script type="text/javascript">
        $(".js-example-basic-multiple").select2({
            placeholder : '请选择角色'
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    添加管理员
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
                    {!! Form::open(['url' => '/admin/admin/' . $admin->id, 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', '管理员名称') !!}
                        {!! Form::text('name', $admin->name, ['class' => 'form-control', 'placeholder' => '列如: admin']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', '管理员邮箱') !!}
                        {!! Form::text('email', $admin->email, ['class' => 'form-control', 'readOnly' => '"true"']) !!}
                        <p class="help-block">用于登陆.</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('role', '角色') !!}
                        {!! Form::select('roles[]', $roles, $admin->roles, ['class' => 'form-control js-example-basic-multiple', 'multiple' => '"multiple"' ]) !!}
                        {{--{!! Form::select('role', $roles, $admin->role, ['class' => 'form-control js-example-basic-multiple' ]) !!}--}}
                        <p class="help-block">管理员的角色.</p>
                    </div>

                    <!-- Change this to a button or input when using this as a form -->
                    <a onclick="$('form').submit()" class="btn btn-success btn-block">修改管理员</a>

                    {!! Form::close() !!}

                            <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    @include('sweet::alert')
@endsection
