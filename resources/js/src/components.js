// components/services/components.js

import { createApp } from 'vue';
import ExampleComponent from '../components/ExampleComponent.vue';
import DashboardComponent from '../components/DashboardComponent.vue';
import CustomersFilter from '../components/CustomersFilter.vue';
const app = createApp({});

app.component('dashboard-component', DashboardComponent);
app.component('example-component', ExampleComponent);

app.component('customers-filter', CustomersFilter)

export default app;
