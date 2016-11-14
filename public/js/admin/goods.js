
/**
 * Created by wl on 16/11/14.
 */
    //选择类型执行AJAX取出类型的属性

/**
 * 改变视频类型后,从服务器加载类型所具备的属性
 */
function getTypeAttrView(url) {
    $.ajax({
        type: "GET",
        url: url,
        dateType: 'json',
        success: function (response) {
            if (response['status']) {
                var attributes = response['content'];
                var html = '';
                $(attributes).each(function (k, v) {

                    if (v.type == 1) { //判断是否是可选
                        html += '<div class="form-group ">';
                        html += "<label class='col-sm-2 control-label'>" + "<a onclick='addNew(this)'" +
                            " href='javascript:void(0);'>[+]</a>" + v['name']  + ":</label>";
                    }else {
                        html += "<div class='form-group'>";
                        html += "<label class='col-sm-2 control-label'>" + v['name']  + ":</label>";
                    }

                    if (v.option_value == "") {
                        html += '<div class="col-sm-5">';
                        html += "<input name='attr_value[" + v.id + "][]' class='form-control'>";
                        html += '</div>';
                    }else {
                        html += '<div class="col-sm-5">';
                        //把可选值转化成下拉框
                        var attr = v.option_value.split(',');
                        html += "<select name='attr_value[" + v.id + "][]' class='form-control js-example-basic-single'>";
                        html += "<option value=''>请选择</option>";
                        for (var i = 0; i < attr.length; i++) {
                            html += "<option value='" +  attr[i] + "'>" + attr[i] + "</option>";
                        }
                        html += "</select>"
                        html += '</div>';
                    }
                    if (v.type == 1) {
                        html += '<div class="col-sm-5">';
                        html += "<input name='attr_price[" + v.id + "][]' class='form-control' " +
                            "placeholder='价格/单位/人民币'>";
                        html += '</div>';
                    }

                    html += '</div>'
                });

            }

            $('#type_attr').nextAll().remove();
            $('#type_attr').after(html);
        }
    })
}

function ajaxDelete(url, noticeInfo, successInfo, successCallBack) {

    goodsDelete(noticeInfo, function () {
        $.ajax({
            type: 'DELETE',
            url: url, //do
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                if (response['status']) {
                    successCallBack();
                    swal("删除成功!", successInfo, "success"); //do
                }else {
                    swal("删除失败!", response['msg'], "error");
                }
            }
        })
    });

}

function goodsDelete(noticeInfo, callBack) {
    swal({
        title: "确定要删除吗?",
        text: noticeInfo,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "取消!",
        confirmButtonText: "删除!",
        closeOnConfirm: false
    }, function(){
        callBack();
    });
}
