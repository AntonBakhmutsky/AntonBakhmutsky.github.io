import { createApp } from 'vue';

import router from '@/router/router';
import store from '@/store';
import App from './App';

import BaseCard from '@/components/UI/BaseCard';
import BaseButton from '@/components/UI/BaseButton';
import BaseBadge from '@/components/UI/BaseBadge';

const app = createApp(App)

app.use(router);
app.use(store);

app.component('BaseCard', BaseCard);
app.component('BaseButton', BaseButton);
app.component('BaseBadge', BaseBadge);

app.mount('#app');
