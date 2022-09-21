import { createApp } from 'vue';

import App from './App'
import BaseCard from './components/UI/BaseCard';
import BaseButton from './components/UI/BaseButton';

const app = createApp(App)

app.component('BaseCard', BaseCard);
app.component('BaseButton', BaseButton);

app.mount('#app');
