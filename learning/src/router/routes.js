import MainLayout from '@/layouts/MainLayout'

import Home from '@/views/Home'
import Fighter from '@/views/Fighter'
import Error from '@/views/Error'

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
      {
        path: '/',
        name: 'home',
        component: Home
      },
      {
        path: '/fighters/:code',
        name: 'fighter',
        component: Fighter,
        props: {
          bodyClass: ['body-aside-page']
        }
      },
      {
        path: '/404',
        name: '404',
        component: Error,
        props: {
          bodyClass: ['body-aside-page', 'body-aside-page_404']
        }
      },
      {
        path: '*',
        redirect: { name: '404' }
      }
    ]
  }
]

export default routes
