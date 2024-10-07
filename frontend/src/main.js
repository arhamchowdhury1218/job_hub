import './assets/main.css';
import 'primeicons/primeicons.css';
import router from './router';
import { createApp } from 'vue';
import App from './App.vue';
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css';
import { createPinia } from 'pinia'

// var cors = require('cors')
// const corsOptions ={
//     origin:'http://localhost:3000', 
//     credentials:true,            //access-control-allow-credentials:true
//     optionSuccessStatus:200
// }
const app = createApp(App);
const pinia = createPinia()
// app.use(cors())
// Use the router
app.use(pinia)
app.use(router);
app.use(Toast);
// Mount the app
app.mount('#app');

