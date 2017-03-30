/**
 * Created by ZJing on 2017/3/10.
 */
require(['jquery'],function($){
    //var $aA = $('#side-bar .menu a');
    var $aLi = $('#side-bar .menu li');
    $aLi.on('click',function(){
        $(this).addClass('selected').siblings('li').removeClass('selected');
    })
})