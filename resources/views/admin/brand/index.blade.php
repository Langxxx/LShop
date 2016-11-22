@extends('admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '品牌管理')
@section('pageAction')
    <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/brand/create') }}'">添加品牌</button>
@endsection
@section('HeaderCSSAndJS')
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    品牌列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>品牌名称</th>
                                <th>网站</th>
                                <th>logo</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->url }}</td>
                                    <td>{{ showImg($brand->logo) }}</td>
                                    <td><a href="{{ url('admin/brand/' . $brand->id . '/edit') }}">编辑</a> |
                                        <a href="#">移除</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
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