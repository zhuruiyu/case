/**
 * Created by ZJing on 2017/2/25.
 */

require(['jquery'],function($){
    var $search = $("#search input");
    $search.focus(function(){
        if($(this).val() == this.defaultValue){
            this.value = "";
        }
    }).blur(function(){
        //$(this).val($(this).value==""?this.defaultValue:this.value);
        $(this).val(this.value==""?this.defaultValue:this.value);
    });
    $("#safe-trade").hover(function(){
        //$(this).parent().find("ul").show();
        //$(this).children('ul').show();
        $(this).siblings('ul').show();
    },function(){
        //$(this).parent().find("ul").hide();
        //$(this).children('ul').hide();
        $(this).siblings('ul').hide();
    });
});