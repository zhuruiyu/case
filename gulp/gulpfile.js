var gulp = require('gulp');

gulp.task('test',function(){
    console.log('haha');
});

gulp.task('test2',function(){
   console.log('hehe');
});

gulp.task('default',['test','test2']);

gulp.task('task',function(){

});