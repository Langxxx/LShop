@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '权限管理')
@section('pageAction')
    <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/permission/create') }}'">添加权限</button>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    权限列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>权限名称</th>
                                <th>权限描述</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{!! $permission->display_name !!}</td>
                                    <td>{!! $permission->description !!}</td>
                                    <td><a href="{{ url('admin/permission/' . $permission->id . '/edit') }}">编辑</a> |
                                        <a pid="{!! $permission->id !!}" onclick="permissionDelete(this)" style="cursor:pointer;" >移除</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $permissions->links() }}
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
        function permissionDelete(e)
        {
            var pid = $(e).attr('pid');
            var tr = $(e).parent().parent();
            //todo 这里可以抽取一下
            swal({
                title: "确定要删除吗?",
                text: "您正在删除一个权限!",
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
                    url: "{{ url('admin/permission') }}" + '/' +  pid,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function (response) {
                        console.log(response);
                        if (response['status']) {
                            tr.fadeOut("slow");
                            swal("删除成功!", "权限已经删除.", "success");
                        }else {
                            swal("删除失败!", response['msg'], "error");
                        }
                    }
                })

            });
        }

    </script>

@endsection