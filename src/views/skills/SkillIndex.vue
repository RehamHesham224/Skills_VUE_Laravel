<template>
<ul>
    <h1>Skills</h1>
    <!-- {{ skills[0] }} -->
    <li v-for="skill in skills" :key="skill.id">
        <router-link :to="{ name: 'SkillEdit', params: { id: skill.id } }">
            {{ skill.title }}
        </router-link>
    </li>
</ul>
</template>
<script setup>
import {useSkillsStore} from '@/stores/skill';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';
const skillsStore = useSkillsStore();
const {skills}=storeToRefs(skillsStore);
onMounted(()=>{
    skillsStore.index();
})
</script>