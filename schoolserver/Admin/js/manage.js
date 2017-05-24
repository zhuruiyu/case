
$(function () {
    $title = $('#title');
    $title.css('margin-left',-$title.width()/2+'px');
    $aLi = $('#nav-list li');
    $aContainer = $('.container');

    for(var i=0;i<$aLi.length;i++){
        $aLi[i].index = i;

        $aLi.eq(i).on('click',function () {
            for(var j=0;j<$aContainer.length;j++){
                $aContainer.eq(j).removeClass('active');
            }
             $aContainer.eq(this.index+1).addClass('active');
        });
    }
    var href = window.location.href;
    if(href.indexOf('?')!=-1){
        var arr = href.split('');
        var index = arr[arr.length-1];
        for(var j=0;j<$aContainer.length;j++){
            $aContainer.eq(j).removeClass('active');
        }
        $aContainer.eq(index).addClass('active');
    }


});
