<template>
    <app-layout>    
        <!-- search -->
       <form method="get" @submit.prevent="performSearch">
        <div class="bg-white rounded-full border-none p-3 mb-4 shadow-md">
            <div class="flex items-center">
                <input
                v-model="skillsStore.search"
                name="search"
                 type="text" 
                 placeholder="Buscar..." 
                 class="ml-3 focus:outline-none w-full"
                 >
                 <button type="submit">
                    Search
                 </button>
            </div>
        </div>
       </form>
        <!-- main features -->
        <div class="bg-white p-4 rounded-lg xs:mb-4 max-w-full shadow-md "> 
            <!-- Cajas pequeñas -->
            <div class="flex flex-wrap justify-between h-full">
            
                <!-- Caja pequeña 3 -->
                <div class=" bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-2 space-y-2 border border-gray-200 m-2">
                    <i class="fas fa-qrcode text-white text-4xl"></i>
                    <p class="text-white">
                        <router-link :to="{ name: 'SkillCreate'}">
                            Create Skill
                        </router-link>
                    </p>
                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="bg-white rounded-lg p-4 shadow-md my-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b-2 w-full">
                            <h2 class="text-ml font-bold text-gray-600">Skills</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                    v-for="skill in skills" :key="skill.id"
                    class="border-b w-full">
                        <td class="px-4 py-2 text-left align-top w-1/2">
                            <div>
                                <h2>{{ skill.title }}</h2>
                                <p>{{ skill.slug }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-2 text-right text-cyan-500 w-1/2">
                            <p><span>
                                <router-link :to="{ name: 'SkillEdit', params: { id: skill.id } }">
                                    Edit
                                </router-link>
                            </span></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </app-layout>

</template>
<script setup>
import {useSkillsStore} from '../../stores/skill';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';
import { watchEffect } from 'vue';
import AppLayout from '../../components/AppLayout.vue';
const skillsStore = useSkillsStore();
const {skills}=storeToRefs(skillsStore);
const performSearch = () => {
    skillsStore.index(skillsStore.search);
};
const handleKeyPress=(event)=>{
    if(event.key === 'Enter'){
        performSearch();
    }
};

onMounted(()=>{
    skillsStore.index(skillsStore.search); 
})


</script>