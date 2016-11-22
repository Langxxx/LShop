@extends('admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '角色管理')
@section('pageAction')
    <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/role/create') }}'">添加角色</button>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    角色列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>角色名称</th>
                                <th>角色描述</th>
                                <th>角色权限</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>{{ $role->permsDisplayName }}</td>
                                    <td><a href="{{ url('admin/role/' . $role->id . '/edit') }}">编辑</a>
                                        <a style="cursor: pointer" rid="{{ $role->id }}" onclick="roleDelete(this)">移除</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--{{ $roles->links() }}--}}
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
@section('HeaderCSSAndJS')
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
@endsection
@section('FooterCSSAndJS')
    <script type="text/javascript">
        function roleDelete(e)
        {
            var rid = $(e).attr('rid');
            var tr = $(e).parent().parent();
            console.log($('meta[name="_token"]').attr('content'));
            swal({
                    title: "确定要删除吗?",
                    text: "您正在删除一个角色!如果有管理员属于当前角色,删除将会失败!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "取消!",
                    confirmButtonText: "删除!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ url('admin/role') }}" + '/' +  rid,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function (response) {
                            console.log(response);
                            if (response['status']) {
                                tr.fadeOut("slow");
                                swal("删除成功!", "角色已经删除.", "success");
                            }else {
                                swal("删除失败!", response['error'], "error");
                            }
                        }
                    })
                });
        }

    </script>

@endsection