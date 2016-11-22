@extends('admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '属性管理')
@section('pageAction')
    <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/attribute/' . $type->id . '/create') }}'">添加属性</button>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    {{ $type->name }}--属性列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>属性名称</th>
                                <th>属性类型, 0唯一|1可选</th>
                                <th>属性可选值,多个用,隔开</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $attribute->type }}</td>
                                    <td>{{ $attribute->option_value }}</td>
                                    <td><a href="{{ url('admin/attribute/' . $attribute->id . '/edit') }}">编辑</a> |
                                        <a pid="{{ $attribute->id }}" onclick="attributeDelete(this)" style="cursor:pointer;" >移除</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $attributes->links() }}
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
        function attributeDelete(e)
        {
            var pid = $(e).attr('pid');
            var tr = $(e).parent().parent();
            //todo 这里可以抽取一下
            swal({
                title: "确定要删除吗?",
                text: "您正在删除一个属性!",
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
                    url: "{{ url('admin/attribute') }}" + '/' +  pid,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function (response) {
                        console.log(response);
                        if (response['status']) {
                            tr.fadeOut("slow");
                            swal("删除成功!", "属性已经删除.", "success");
                        }else {
                            swal("删除失败!", response['msg'], "error");
                        }
                    }
                })

            });
        }

    </script>

@endsection