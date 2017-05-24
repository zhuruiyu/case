// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import vuex from 'vuex'
import axios from 'axios'
Vue.config.productionTip = false
Vue.use(vuex);
axios.defaults.withCredentials = true;
/* eslint-disable no-new */
const store = new vuex.Store({
  state: {
    router:router,    //存储router对象在子组件方便路由跳转的使用
    isLogin:false     //记录是否登录
  },
  mutations: {
    checkLogin(state){
      if(!state.isLogin){            //先判断状态
        axios.get('http://localhost:80/schoolserver/Client/check_isLogin')   //向服务器查询session
          .then(function (res) {
            if(res.data === 'login'){
              state.isLogin = true;
            }else{
              router.replace('login');
            }
          });
      }


    }
  }
});
store.commit('checkLogin');
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
});
