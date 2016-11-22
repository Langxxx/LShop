@extends('admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '品牌管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/brand/') }}'">品牌列表</button>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    添加品牌
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
                    {!! Form::open(['url' => '/admin/brand/' . $brand->id, 'method' => 'PUT', 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::label('name', '品牌名称') !!}
                        {!! Form::text('name', $brand->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('url', '官网') !!}
                        {!! Form::text('url', $brand->url, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('logo', 'logo') !!}
                        {!! Form::file('logo', ['class' => 'form-control']) !!}
                        <td>{{ showImg($brand->logo) }}</td>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <a onclick="$('form').submit()" class="btn btn-success btn-block">添加品牌</a>

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
