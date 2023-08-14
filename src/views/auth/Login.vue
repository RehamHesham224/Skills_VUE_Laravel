<template>
<!-- <GuestLayout title="Sign In" @submit="authStore.login()"> -->
    <GuestLayout title="Sign In" >
        <form 
        class="mt-6" 
        @submit.prevent="authStore.login(user)" 
        method="POST"
        >
            <div>
                <label
                    for="email" 
                    class="block text-xs font-semibold text-gray-600 uppercase" >
                    E-mail
                </label>

                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    placeholder="john.doe@company.com" 
                    autocomplete="email" 
                    class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" 
                    required
                    v-model="user.email" >
            </div>
            <div class="text-red-500" v-if="authStore.errors.email">
                    {{ authStore.errors.email[0] }}
                </div>

            <div>
                <label 
                    for="password" 
                    class="block mt-2 text-xs font-semibold text-gray-600 uppercase">
                    Password
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    v-model="user.password" 
                    placeholder="********"
                    autocomplete="current-password" 
                    class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" 
                    required>
                    <div class="text-red-500 pb-8" v-if="authStore.errors.password">
                    {{ authStore.errors.password[0] }}
                    </div>
            </div>
            <div>
                <label 
                    for="remember_me" 
                    class="inline-flex items-center mt-3 cursor-pointer">
                    <input 
                        v-model="user.remember"
                        id="remember_me" 
                        type="checkbox" 
                        class="w-5 h-5 text-gray-600 border-gray-300 rounded focus:outline-none focus:shadow-outline" 
                        name="remember">
                    <span class="ml-2 text-sm font-semibold text-gray-500">Remember me</span>
                </label>
            </div>
            <button 
                type="submit" 
                class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                Login
            </button>
            <router-link :to="{name:'RequestPassword'}"
             class="flex justify-between inline-block mt-4 text-xs text-gray-500 cursor-pointer hover:text-black">
             Forgot password?
            </router-link>
        </form>
    </GuestLayout>
</template>
<script setup>
import {useAuthStore} from '../../stores/auth';
import {reactive } from 'vue';
import GuestLayout from '../../components/GuestLayout.vue';
const authStore=useAuthStore();
const user=reactive({ 
    email:'',
    password:'',
    remember:false
});

</script>