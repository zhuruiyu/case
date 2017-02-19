/**
 * Created by Administrator on 2017/2/19 0019.
 */

require(['jquery','弹层组件开发/dialog1'],function($,Dialog){


    $('#btn').on('click',function(){
       Dialog.open();
   });
    $('#cbtn').on('click',function(){
        Dialog.close();
    });
});