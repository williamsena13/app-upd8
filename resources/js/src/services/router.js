import { createRouter, createWebHistory } from 'vue-router';
import DashboardComponent from '../../components/DashboardComponent.vue';
import ExampleComponent from '../../components/ExampleComponent.vue';
import CustomerList from '../../components/CustomersList.vue';


const routes = [
  { path: '/', component: DashboardComponent },
  { path: '/home', component: DashboardComponent },
  { path: '/exemplo', component: ExampleComponent },
  { path: '/clientes', name: 'customer.index' , component: CustomerList }
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;