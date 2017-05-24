<template>
    <div id="user">

    </div>
</template>
<script>
import axios from 'axios';
axios.defaults.baseURL="http://localhost/schoolserver/Client";
export default {
   name:"user",
   data: function () {
     return {
       clickNum: 0,
       perNum:3
     }
   },
   created:function(){
      this.loadData()
   },
   methods:{
      loadData(){
         var parms=new FormData();
         parms.append("page",this.clickNum);
         parms.append("pernum",this.perNum);
         axios.post("/getUser",parms).then(function(data){
            console.log(data);
        });
      }
   }
}
</script>