/**
 * Created by Administrator on 2017/2/19 0019.
 */

define(['b'],function(isArray){
    function arraySort(arr){
        if(!isArray(arr)){
            return ;
        }
        arr.sort(function(a,b){
            return a-b;
        });
        return arr;
    }
    return arraySort;
});