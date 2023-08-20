import { createRouter, createWebHistory } from 'vue-router';
import DashboardComponent from '../../components/DashboardComponent.vue';
import ExampleComponent from '../../components/ExampleComponent.vue';
import CustomerList from '../../components/CustomersList.vue';
import CustomersForm from '../../components/CustomersForm.vue';


const routes = [
  { path: '/', component: DashboardComponent },
  { path: '/home', component: DashboardComponent },
  { path: '/exemplo', component: ExampleComponent },
  { path: '/clientes', name: 'customer.index' , component: CustomerList },
  { path: '/clientes/novo', name: 'customer.create' , component: CustomersForm },
  { path: "/clientes/editar/:id",name: "editar-cliente",component: CustomersForm  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;