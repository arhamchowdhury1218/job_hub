import './assets/main.css';
import 'primeicons/primeicons.css';
import router from './router';
import { createApp } from 'vue';
import App from './App.vue';
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css';



const app = createApp(App);


// Use the router
app.use(router);
app.use(Toast);
// Mount the app
app.mount('#app');
