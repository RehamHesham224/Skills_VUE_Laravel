import './assets/main.css'
import './index.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')

// document.addEventListener('DOMContentLoaded', function() {
//         var menuButton = document.getElementById('menu-button');
//         var sidebar = document.getElementById('sidebar');

//         menuButton.addEventListener('click', function() {
//             sidebar.classList.toggle('hidden');
//             sidebar.classList.toggle('lg:block');
//         });
//     });