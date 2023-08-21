import { createApp } from 'vue';
import './bootstrap';
import componentsApp from './src/components';
import router from './src/services/router';
import HttpPlugin from './src/services/http';
import VueSweetalert2 from "vue-sweetalert2";
import mitt from 'mitt';
const eventBus = mitt();

//
const app = createApp({});
app.use(router);
app.use( componentsApp )
app.use(HttpPlugin);


app.provide('eventBus',eventBus);


app.use(VueSweetalert2);

app.mount('#app');
