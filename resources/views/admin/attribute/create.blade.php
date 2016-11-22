@extends('admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '属性管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/attribute/' . $typeID) }}'">属性列表</button>
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
                    添加属性
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
                        {!! Form::open(['url' => '/admin/attribute/' . $typeID]) !!}
                        <div class="form-group">
                            {!! Form::label('name', '属性名称') !!}
                            {!! Form::text('name', '', ['class' => 'form-control']) !!}
                        </div>
                        {{--//todo 这里可以点击控制可选值框禁止与使用 --}}
                        <div class="form-group">
                            {!! Form::label('type', '属性的类型: ') !!}
                            {!! Form::select('type', ['0' => '唯一', '1' => '可选'], 2, ['class' => 'form-control js-example-basic-single']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('option_value', '属性可选值') !!}
                            {!! Form::text('option_value', '', ['class' => 'form-control']) !!}
                            <p class="help-block">多个值可用,隔开.</p>
                        </div>
                        <div class="form-group">
                            {!! Form::label('type_id', '属性所属商品类型') !!}
                            {!! Form::select('type_id', $types, $typeID, ['class' => 'form-control js-example-basic-single']) !!}
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <a onclick="$('form').submit()" class="btn btn-success btn-block">添加属性</a>

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
