@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '管理员管理')
@section('pageAction')
    <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/admin/create') }}'">添加管理员</button>
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
                    管理员列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>管理员名称</th>
                                <th>邮箱</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->created_at }}</td>
                                    <td><a href="{{ url('admin/admin/' . $admin->id . '/edit') }}">编辑</a> |
                                        <a href="#">移除</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $admins->links() }}
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