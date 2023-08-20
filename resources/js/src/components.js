// components/services/components.js

import { createApp } from 'vue';
import ExampleComponent from '../components/ExampleComponent.vue';
import DashboardComponent from '../components/DashboardComponent.vue';
const app = createApp({});

app.component('dashboard-component', DashboardComponent);
app.component('example-component', ExampleComponent);



export default app;
