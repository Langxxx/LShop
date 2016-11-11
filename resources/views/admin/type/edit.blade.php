@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '商品类型管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/type/')
     }}'">商品类型列表</button>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    添加商品类型
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
                    {!! Form::open(['url' => '/admin/type/' . $type->id, 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', '商品类型名称') !!}
                        {!! Form::text('name', $type->name, ['class' => 'form-control', 'placeholder' => '列如: admin']) !!}
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <a onclick="$('form').submit()" class="btn btn-success btn-block">添加商品类型</a>

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
