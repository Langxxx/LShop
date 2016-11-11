@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '商品管理')
@section('pageAction')
    <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/goods/create') }}'">添加商品</button>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    商品列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>商品名称</th>
                                <th>本店价</th>
                                <th>市场价</th>
                                <th>logo</th>
                                <th>热卖</th>
                                <th>新品</th>
                                <th>精品</th>
                                <th>上架</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allGoods as $goods)
                                <tr>
                                    <td>{{ $goods->name }}</td>
                                    <td>{{ $goods->market_price }}</td>
                                    <td>{{ $goods->shop_price }}</td>
                                    <td>{{ showImg($goods->sm_logo, 50, 50) }}</td>
                                    <td>{{ $goods->is_hot }}</td>
                                    <td>{{ $goods->is_new }}</td>
                                    <td>{{ $goods->is_best }}</td>
                                    <td>{{ $goods->is_on_sale }}</td>
                                    <td><a href="{{ url('admin/goods/' . $goods->id . '/edit') }}">编辑</a> |
                                        <a pid="{{ $goods->id }}" onclick="goodsDelete(this)" style="cursor:pointer;" >移除</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $allGoods->links() }}
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
        function goodsDelete(e)
        {
            var pid = $(e).attr('pid');
            var tr = $(e).parent().parent();
            //todo 这里可以抽取一下
            swal({
                title: "确定要删除吗?",
                text: "您正在删除一个商品!",
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
                    url: "{{ url('admin/goods') }}" + '/' +  pid,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function (response) {
                        console.log(response);
                        if (response['status']) {
                            tr.fadeOut("slow");
                            swal("删除成功!", "商品已经删除.", "success");
                        }else {
                            swal("删除失败!", response['msg'], "error");
                        }
                    }
                })

            });
        }

    </script>

@endsection