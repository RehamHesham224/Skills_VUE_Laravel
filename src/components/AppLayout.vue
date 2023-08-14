<template>
<div class="bg-gray-200 lg:flex min-h-screen ">
   <Navbar></Navbar>
   <Sidebar></Sidebar>
    <div class="lg:w-full lg:ml-64 px-6 py-8">
        <slot></slot>
    </div>
</div>
</template>
<script setup>
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';
</script>