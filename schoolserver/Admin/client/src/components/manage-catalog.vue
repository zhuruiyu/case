<template>
  <div id="catalog-manage">
    <table class="catalog-msg">
      <tr>
        <th>标签ID</th>
        <th>标签名</th>
        <th>父标签id</th>
        <th>标签等级</th>
        <th>标签操作</th>
      </tr>
      <tr v-for="x in catalogList">
        <td>{{ x.cid }}</td>
        <td>{{ x.cname }}</td>
        <td>{{ x.father }}</td>
        <td>{{ x.level }}</td>
        <td v-if="x.level == 3">删除</td>
      </tr>
    </table>
    <ul class="page-nav">
      <li v-for="x in pageList">{{ x.val }}</li>
    </ul>
  </div>
</template>
<script>
  import axios from 'axios';
  export default{
      beforeCreate(){
          this.$store.commit('checkLogin');
      },
      created(){
          this.init();
      },
      data(){
          return{
              catalogList:[],
              perPage:10,
              pageList:[],
              index:0
          }
      },
      methods:{
          loadData(){
              let that = this;
              axios.get('http://localhost:80/schoolserver/client/get_catalog',{
                params:{
                  index:that.index,
                  perPage:that.perPage
                }
              })
                .then(function (res) {
                    that.catalogList = res.data;
                    console.log(that.catalogList);
                })
          },
          init(){
              axios.get('http://localhost:80/schoolserver/client/catalog_init')
                .then(function (res) {
                    let pageNum = Math.ceil(parseInt(res.data)/this.perPage);
                    for(let i=0;i<pageNum;i++){
                        let obj = {};
                        obj.val = i+1;
                        obj.isNow = i===0;
                        this.pageList.push(obj);
                        this.loadData();
                    }

                }.bind(this))
          }
      }
  }
</script>
<style>

</style>
