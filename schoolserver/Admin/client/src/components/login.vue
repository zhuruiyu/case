<template>
  <div id="container">
    <h3 class="welcome-title">欢迎来到校园生活服务平台后台管理界面</h3>
    <div class="login-box">
      <div class="input-group"><label for="username">用户名</label><input type="text" name="username" class="username" v-model="username"></div>
      <div class="input-group"><label for="password">密码</label><input type="password" name="password" class="password" v-model="password"></div>
      <div class="btn-group">
        <button @click="login">登录</button>
        <button @click="reset">重置</button>
      </div>

    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  axios.defaults.withCredentials = true;
//  var qs = _require('qs');
  export default{
      name:'login',
      methods:{
        login(){       //登录
          var params = new URLSearchParams();
          params.append('username', this.username);
          params.append('password', this.password);

          axios.post('http://localhost/schoolserver/Client/login',params

          ).then(function (res) {
              if(res.data === 'success'){
                this.$store.state.isLogin = true;
                this.$store.state.router.push('index');        //成功跳转到主页面
              }else{
                  this.$store.state.router.push('login');
              }
          }.bind(this))

        },
        reset(){
            this.username = '';
            this.password = '';
        }
      },
      data:function () {
        return{
            isLogin:false,
            username:'',
            password:''
        }
      }
  }
</script>
<style scoped>
  #container{
    width:100%;
    height: 100%;
    background: url("../assets/img/login.jpg") no-repeat;
    overflow: hidden;
    position: relative;
  }
  #container .welcome-title{
    text-align: center;
    font-size: 30px;
  }
  #container .login-box{
    height: 200px;
    width: 350px;
    border: 1px solid;
    position: absolute;
    right:100px;
    top:50%;
    transform: translateY(-50%);
    padding-top: 30px;
  }
  #container .login-box .input-group{
    width: 100%;
    margin: 20px auto 20px;
    text-align: center;
    height: 30px;
  }
  #container .login-box .input-group label{
    float: left;
    margin-left: 30px;
    width: 50px;
  }
  #container .login-box .input-group input{
    padding: 3px 10px 3px 10px;
    float: left;
    margin-left: 30px;
    height: 20px;
    width: 150px;
  }
  #container .login-box .btn-group{
    width: 100%;
    margin: 10px auto 0;
  }
  #container .login-box .btn-group button{
    float: left;
    margin: 20px 0 0 60px;
    height: 30px;
    width: 70px;
  }
  /*#container .login-box .btn-group button:first-child{*/
    /*background: rgba(56,147,54,0.99);*/
    /*height: 50px;*/
  /*}*/
</style>
