import { createApp } from 'vue'
import App from './App.vue'
import './assets/css/tailwind.css';
import router from './router';
import JwPagination from 'jw-vue-pagination';


const app = createApp(App);
app.use(router)
app.component('jw-Pagination', JwPagination)




app.mount('#app');