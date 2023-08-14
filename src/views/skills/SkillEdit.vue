<template>
    <app-layout>
        <div class="flex items-center justify-center">
            <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
                <h1 class="text-xl font-semibold text-gray-700 mb-5">Edit Skill</h1>
                <form @submit.prevent="skillsStore.update($route.params.id)">
                    <div>
                        <label class="block mb-2 text-sm text-gray-600">
                            Title
                        </label>
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            type="text" v-model="skill.title" placeholder="title">
                        <div v-if="skillsStore.errors.title">
                            {{ skillsStore.errors.title[0] }}
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm text-gray-600">
                            Slug
                        </label>
                        <input type="text" v-model="skill.slug" placeholder="slug"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <div v-if="skillsStore.errors.slug">
                            {{ skillsStore.errors.slug[0] }}
                        </div>
                    </div>
                    <input
                        class="mt-3 w-32 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2"
                        type="submit" value="Edit">
                </form>
            </div>
        </div>
    </app-layout>
</template>
<script setup>
import { useSkillsStore } from '../../stores/skill';
import { onMounted, reactive } from 'vue';
import { storeToRefs } from 'pinia';
import AppLayout from '../../components/AppLayout.vue';
const skillsStore = useSkillsStore();
const { skill, errors } = storeToRefs(skillsStore);
const props = defineProps({
    id: {
        type: String,
        required: true
    }
})
onMounted(() => {
    skillsStore.show(props.id);
})
</script>