@extends('admin.layouts.app')

@section('title', '管理中心')
@section('pageHeader', '商品分类管理')
@section('pageAction')
    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('admin/category/')
     }}'">商品分类列表</button>
@endsection

@section('FooterCSSAndJS')
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>

    <script src="/js/admin/it.js"></script>
    <script src="/js/admin/nl.js"></script>

    <script type="text/javascript">
        $(".js-example-basic-single").select2({
            placeholder : '请选择分类'
        });
        $(".js-example-type-single").select2({
        });
        $(".js-example-attr-multiple").select2({
            placeholder : '请选择属性'
        });
    </script>
    <script>
        $("select[name=type_id]").change(function() {

            var typeID = $(this).val();
            var _this = $(this);
            var nextSelect = _this.parent().next("div").find('select');

            if (typeID == 0) {
                nextSelect.remove();
                return;
            }
            var opt =  "<option value=''>选择属性</option>";
            $.ajax({
                type: "GET",
                url: "{{ url('admin/category/ajaxGetAttrForSelect') }}" + '/' +  typeID,
                dateType: 'json',
                success: function (response) {
                    if (response['status']) {

                        $(response['content']).each(function(k, v) {
                            opt += "<option value='" + v.id + "'>" + v.name + "</option>"
                        });

                    }
                    nextSelect.html(opt);
                }
            });

        });
        function addNew(a) {
            var g = $(a).parent().parent();

            if ($(a).html() == "[+]") {

                g.find('select').each(function (k, v) {
                    $(v).select2('destroy');
                });


                var newP = g.clone(true,true);
                newP.find("a").html("[-]");
                g.after(newP);

                g.find('select').each(function (k, v) {
                    $(v).select2();
                });
                newP.find('select').each(function (k, v) {
                    $(v).select2();
                });
            }else {
                g.remove();
            }

        }

        //        $('#type_id').trigger('change');
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div  class="panel-heading">
                    添加商品分类
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
                    {!! Form::open(['url' => '/admin/category','class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('name', '商品分类名称',['class' => 'col-sm-2 control-label' ]) !!}
                        <div class="col-sm-5">
                            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => '列如: admin']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('parent_id', '父级分类',['class' => 'col-sm-2 control-label' ]) !!}
                        <div class="col-sm-5">
                            {!! Form::select('parent_id', $categories, null, ['class' => 'form-control js-example-basic-single' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><a onclick="addNew(this)" href="javascript:void(0);">[+]</a>搜索属性</label>
                        <div class="col-sm-3">
                            {!! Form::select('type_id', $types, null, ['class' => 'form-control js-example-type-single' ]) !!}
                        </div>
                        <div class="col-sm-7">
                            {!! Form::select('attr_id[]', [], null, ['class' => 'form-control js-example-attr-multiple', 'multiple' => 'multiple' ]) !!}
                        </div>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <a onclick="$('form').submit()" class="btn btn-success btn-block">添加商品分类</a>

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
