<template>
 <!-- Barra lateral -->
 <div id="sidebar" class="lg:block hidden bg-white w-64 h-screen fixed rounded-none border-none">
        <!-- Items -->
        <div class="p-4 space-y-4">
                <RouterLink class="relative px-4 py-3 flex items-center space-x-4 rounded-lg bg-gray-100 hover:text-white hover:bg-gradient-to-r hover:from-sky-600 to-cyan-400" 
                    to="/">
                    Home
                </RouterLink>
                <RouterLink class="relative px-4 py-3 flex items-center space-x-4 rounded-lg bg-gray-100 hover:text-white hover:bg-gradient-to-r hover:from-sky-600 to-cyan-400"
                    to="/skills">
                   Skills
                </RouterLink>
        </div>
    </div>
</template>
<script setup>
</script>