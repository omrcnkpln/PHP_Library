import { createApp } from 'vue';
import App from './App.vue';
import routes from './router';
import bootstrap from './bootstrap';

const app = createApp(App)

app.use(routes)

app.mount('#app')
