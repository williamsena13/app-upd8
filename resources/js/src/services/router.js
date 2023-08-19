import { createRouter, createWebHistory } from 'vue-router';
import DashboardComponent from '../../components/DashboardComponent.vue';
import ExampleComponent from '../../components/ExampleComponent.vue';


const routes = [
  { path: '/', component: DashboardComponent },
  { path: '/home', component: DashboardComponent },
  { path: '/exemplo', component: ExampleComponent }
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;


/*
import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from '../../components/ExampleComponent.vue';
import DashboardComponent from '../../components/DashboardComponent.vue';

Vue.use(VueRouter);

const routes = [
    //{ path: '/', component: DashboardComponent },
    { path: '/home', component: DashboardComponent },
    { path: '/example', component: ExampleComponent },
];

const router = new VueRouter({
    routes
});

export default router;
*/