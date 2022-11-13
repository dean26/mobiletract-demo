const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '', component: () => import('pages/IndexPage.vue'), name: 'Home'
      },
      {
        path: '/login', component: () => import('src/pages/LoginPage.vue'), name: 'Login'
      },
      {
        path: '/logout', component: () => import('src/pages/LogoutPage.vue')
      },
    ]
  },
  {
    path: '/users',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '', component: () => import('pages/UsersPage.vue'), name: 'Users'
      }
    ]
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
