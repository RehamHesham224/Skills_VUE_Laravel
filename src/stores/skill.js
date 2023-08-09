import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'
import { useRouter } from 'vue-router';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';;
export const useSkillsStore = defineStore('skill', {
  state: () => ({
    skills: [],
    skill: [],
    errors:{},
    router:useRouter()
  }),
  actions: {
    async index(){
      const response = await axios.get('skills');
      this.skills= response.data.data;

    },
    async show(id){
      const response = await axios.get('skills/'+id);
      const {data}=await response.json();
      console.log(data);
      this.skill= data;

    },
    async create(data){
     try{
      await axios.post('skills',data);
      await this.router.push({name:'skillIndex'});
     }catch(error){
      if(error.response.status===422){
        this.errors=error.response.data.errors;
      }}
    },
    async update( id){
      try{
        await axios.put('skills/'+id,this.skill);
        await this.router.push({name:'skillIndex'});
      }catch(error){
        if(error.response.status===422){
          this.errors=error.response.data.errors;
        }
      }
    },
    async delete(id){
      if(window.confirm('Are you sure you want to delete this skill?'))return;
      
      await axios.delete('skills/'+id);
      await this.index();
    }
 

    }
  })
