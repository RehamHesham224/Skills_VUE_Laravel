<template>
 <nav class="bg-white border-b border-gray-300 py-4">
        <div class="flex justify-between items-center px-9">
            <!-- Ícono de Menú -->
            <button id="menu-button" class="lg:hidden">
                close
                <!-- <i class="fas fa-bars text-cyan-500 text-lg"></i> -->
            </button>
            <!-- Ícono de Notificación y Perfil -->
            <div class="space-x-4 ">
                <RouterLink 
                    class="rounded-lg px-3 py-2 text-slate-700 font-medium hover:bg-slate-100 hover:text-slate-900"
                    to="/">
                    Home
                </RouterLink>
                <RouterLink
                    class="rounded-lg px-3 py-2 text-slate-700 font-medium hover:bg-slate-100 hover:text-slate-900"
                    to="/skills">
                   Skills
                </RouterLink>
            
            </div>
            
        </div>
    </nav>
       
</template>
<script setup>
    
</script>