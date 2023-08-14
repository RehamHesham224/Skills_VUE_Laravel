<template>
<div class="grid min-h-screen place-items-center">
  <div class=" p-12 bg-white">
    <h1 class="text-xl font-semibold">{{ title }}</h1>

<!-- <form @submit.prevent="emit('submit')" method="POST"> -->
<slot></slot>
<!-- </form> -->
</div>
</div>
</template>
<script setup>
const {title}=defineProps({
    title:String
});
// const emit=defineEmits(['submit']);
</script>