@extends('Admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '库存管理')
@section('pageAction')
    <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/goods') }}'">商品列表</button>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    {{ $goods->name }}--库存列表
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
                    <div class="table-responsive">
                        {!! Form::open(['url' => '/admin/stock/' . $goods->id, 'method' => 'POST']) !!}
                        <table class="table table-striped table-bordered table-hover">

                            <thead>
                            <tr>
                            @foreach($goodsAttributes as $name => $attribute)
                                <th>{{ $name }}</th>
                            @endforeach
                                <th>库存</th>
                                <th>操作</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($goodsStocks->isEmpty())
                                <tr>
                                    @foreach($goodsAttributes as $attribute)
                                        <td>
                                            {!! Form::select('goods_attr_id[]',$attribute->goodsAttribute, '', ['class' => 'form-control'] ) !!}
                                        </td>
                                    @endforeach
                                    <td><input type="text" name="number[]" class="form-control"></td>
                                    <td><a onclick="addNew(this)" style="cursor:pointer;" >[+]</a></td></td>
                                </tr>
                            @else
                                @foreach($goodsStocks as $index => $goodsStock)
                                    <tr>
                                        @foreach($goodsAttributes as $attribute)
                                            <td>
                                                <select name="goods_attr_id[]" class="form-control">
                                                    @foreach($attribute->goodsAttribute as $key => $value)
                                                        @if(in_array($key, current($goodsStock)))
                                                            <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                                                        @else
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endforeach
                                        <td><input type="text" name="number[]" class="form-control" value="{{ key($goodsStock) }}"></td>
                                        <td><a onclick="addNew(this)" style="cursor:pointer;" >{{ $index == 0 ? '[+]' : '[-]' }}</a></td></td>
                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                        </table>
                        <a onclick="$('form').submit()" class="btn btn-success btn-block">保存</a>
                        {!! Form::close() !!}

                        {{--{{ $stocks->links() }}--}}
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
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>

    <script src="/js/admin/it.js"></script>
    <script src="/js/admin/nl.js"></script>

    <script type="text/javascript">
        $(".js-example-basic-single").select2();
    </script>
    <script>
        function addNew(a) {
            var g = $(a).parent().parent();

            if ($(a).html() == "[+]") {
                var newP = g.clone();
                newP.find("a").html("[-]");
                g.after(newP);
            }else {
                g.remove();
            }

        }
    </script>
@endsection