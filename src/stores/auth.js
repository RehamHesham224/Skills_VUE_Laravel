import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'
import { useRouter } from 'vue-router';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';;
export const useAuthStore = defineStore('auth', {
  state: () => ({
    user:{},
    token:null,
    errors:{},
    router:useRouter()
  }),
  actions: {
    async login(data){
      try{
        await axios.post('login',data)
        .then(response => {
            this.setUser(response.data.user);

            this.setToken(response.data.token);

            // TODO: redirect to app.dashbord page
            this.router.push({name:'skillIndex'});
            
          })

      }catch(error){
          if(error.response.status===422){
            this.errors=error.response.data.errors;
            console.log(this.errors);
        }}

    },
    async logout(){
        console.log("logout");

    },
    async user(){
        this.user=await axios.get('user');

    },
    setToken(token){
      this.token = token;
      if(token){
        sessionStorage.setItem('token',token);
      }else{
        sessionStorage.removeItem('token');

      }
    },
    setUser(user){
      this.user = user;
    }
}
})