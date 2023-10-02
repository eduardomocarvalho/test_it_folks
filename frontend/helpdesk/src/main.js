import { createApp } from 'vue'
import App from './root/App.vue'
import router from './root/router'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import 'bootstrap-icons/font/bootstrap-icons.css'

createApp(App).use(router).mount('#app')
