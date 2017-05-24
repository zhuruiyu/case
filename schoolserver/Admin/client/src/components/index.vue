<template>
<h1 @click='check'>click</h1>
</template>
<script>
export default {
   name:'index',
   methods:{
      check(){
         console.log(this.$store.state.isLogin);
      }
   }
}
</script>