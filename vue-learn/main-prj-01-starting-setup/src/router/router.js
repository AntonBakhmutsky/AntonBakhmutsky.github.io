import {createRouter, createWebHistory} from 'vue-router';

import CoachesList from '@/pages/coaches/CoachesList';
import CoachDetail from '@/pages/coaches/CoachDetail';
import CoachRegistration from '@/pages/coaches/CoachRegistration';
import ContactCoach from '@/pages/requests/ContactCoach';
import RequestsReceive from '@/pages/requests/RequestsReceive';
import NotFound from '@/pages/NotFound';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      redirect: '/coaches'
    },
    {
      path: '/coaches',
      component: CoachesList
    },
    {
      path: '/coaches/:id',
      component: CoachDetail,
      children: [
        { path: 'contact', component: ContactCoach }
      ]
    },
    {
      path: '/register',
      component: CoachRegistration
    },
    {
      path: '/requests',
      component: RequestsReceive
    },
    {
      path: '/:notFound(.*)',
      component: NotFound
    },
  ]
});

export default router;
