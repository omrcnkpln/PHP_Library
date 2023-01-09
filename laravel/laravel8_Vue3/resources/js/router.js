import {createRouter, createWebHistory} from 'vue-router';
import ExampleComponent from "./components/ExampleComponent.vue";
import test from "./components/test.vue";

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: ExampleComponent,
        },
        {
            path: '/test',
            name: 'test',
            component: test,
        }
    ]
})

export default router;
