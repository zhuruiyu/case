<template>
  <div id="user-container">
    <div class="wrapper">
      <table>
        <tr class="t-head">
          <th>用户ID</th>
          <th>用户名</th>
          <th>是否为管理员</th>
          <th>是否进行邮箱验证</th>
          <th>注册时间</th>
          <th>操作</th>
        </tr>
        <tr v-for="(user,index) in userList">
          <td>{{ user.uid }}</td>
          <td>{{ user.user }}</td>
          <td v-if="user.admin">是</td>
          <td v-else>否</td>
          <td v-if="user.state">是</td>
          <td v-else>否</td>
          <td>{{ user.regdate }}</td>
          <td @click="deleteUser(user.uid,index)"><a href="javascript:;">删除用户</a></td>
        </tr>
      </table>
      <ul class="page-nav">
        <li v-for="x in pageList" @click="changePage(x.val)" :class="{show:x.isNow}"><a href="javascript:;">{{ x.val }}</a></li>

      </ul>
    </div>
  </div>
</template>
<script>
  import axios from 'axios'
  export default{
      beforeCreate(){
        this.$store.commit('checkLogin');
      },
      created:function () {
          this.init();
      },
      data(){
          return {
              userList:[],
              index:0,
              perPage:10,
              pageList:[]
          }
      },
      computed:{
          liClass:function () {
            let arr = [];
            for(let i=0;i<this.pageNum;i++){
                if(i === this.whichPage){
                    arr.push('show');
                }else{
                    arr.push('hide');
                }
            }
            console.log(arr);
            return arr;
          }
      },
      methods:{
          deleteUser (uid,index) {
              console.log('aa');
              axios.get('http://localhost:80/schoolserver/Client/delete_user?uid='+uid)
                .then(function (res) {
                    if(res.data === 'success'){
                        this.userList.slice(index,1);
                    }
                }.bind(this))
          },
          loadData(){        //进行加载数据
              const that = this;
              axios.get("http://localhost:80/schoolserver/Client/get_user",{
                  params:{
                      index:that.index,
                      perPage:that.perPage
                  }
              }).then(function (res) {
                    that.userList = res.data;
                })
          },
          init(){        //进行组件的初始化
            axios.get('http://localhost:80/schoolserver/Client/user_init?perPage='+this.perPage)
              .then(function (res) {
                let pageNum = Math.ceil(parseInt(res.data)/this.perPage);
                for(let i=0;i<pageNum;i++){
                    let obj = {};
                    obj.val = i+1;
                    if(i === 0){
                        obj.isNow = true;
                    }else{
                        obj.isNow = false;
                    }
                    this.pageList.push(obj);
                }
                this.loadData();
              }.bind(this))
          },
          changePage(index){     //切换页面
              for(let i=0;i<this.pageList.length;i++){
                  this.pageList[i].isNow = false;
                  if(this.pageList[i].val == index){
                      this.pageList[i].isNow = true;
                  }
              }
              this.index = index-1;
            this.loadData();
          }
      }
  }
</script>
<style scoped>
  #user-container{
    width: 100%;
  }
  #user-container .wrapper{
    width: 80%;
    margin: 0 auto;
  }
  #user-container .wrapper table .t-head{
    background: #ccc;
  }
  #user-container .wrapper table td,#user-container .wrapper table th{
    border: 1px solid #ddd;
    width: 150px;
    height: 30px;
    text-align: center;
  }
  #user-container .wrapper table th{
    font-size: 15px;
  }
  #user-container .wrapper table td a{
    text-decoration: none;
    color: #ff0000;
  }
  .page-nav{
    list-style: none;
    margin: 0;
    padding: 0;
  }
  .page-nav li{
    float: left;
    margin: 10px;
    width: 20px;
    height: 20px;
    background: #CCCCCC;
    text-align: center;
    line-height:20px;
    border-radius: 5px;
  }
  .page-nav li.show{
    background: orange;
  }
  .page-nav li a{
    text-decoration: none;
    color: #000000;
  }
</style>
