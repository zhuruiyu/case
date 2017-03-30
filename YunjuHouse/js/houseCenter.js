/**
 * Created by ZJing on 2017/3/2.
 */

require(['jquery'],function($) {
    var $choose = $("#choose input");
    $choose.focus(function () {
        if ($(this).val() == this.defaultValue) {
            this.value = "";
        }
    }).blur(function () {
        //$(this).val($(this).value==""?this.defaultValue:this.value);
        $(this).val(this.value == "" ? this.defaultValue : this.value);
    });

    var $moreChoose = $("#more-choose li");
    $moreChoose.on('click',function(){
        //console.log($(this));
        $(this).addClass("selected").siblings().removeClass("selected");
        $("#more-choose li input").parent().removeClass("selected");
    });

    var $liIdx = $("#ways li");
    var $ulIdx = $("#many-house .many-house ul");
    $liIdx.on('click',function(){
        var index = $(this).index();
        //console.log($(this).index);
        $liIdx.eq(index).addClass("selected").siblings().removeClass("selected");
        $ulIdx.eq(index).show().siblings().hide();
    })
});
