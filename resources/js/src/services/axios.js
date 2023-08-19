import Vue from 'vue';
import axios from "axios";

Vue.use({
  install(Vue){
    //Vue.prototype.$http = axios;
    Vue.prototype.$http = axios.create({
      baseURL: "http://api-upd8.test/api",
      frontURL: "/",
    })

    Vue.prototype.$http.interceptors.request.use( request => {
        return request;
    }, error => {
        return error
    });

    Vue.prototype.$http.interceptors.response.use( response =>{
      return response
    } , error => {
      return error
    });

  }
})
