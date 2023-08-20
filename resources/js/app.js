import { createApp } from 'vue';
import './bootstrap';
import componentsApp from './src/components';

import router from './src/services/router';

const app = createApp({});
app.use(router); // Use o Vue Router


app.mount('#app');