import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignInView from '../views/SignInView.vue'
import TimeLineView from '../views/TimeLineView.vue'
import ProfileView from '../views/ProfileView.vue'
import ProfileEditView from '../views/ProfileEditView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/signin',
    name: 'signin',
    component: SignInView
  },
  {
    path: '/timeline',
    name: 'timeline',
    component: TimeLineView
  },
  {
    path: '/profile/:username',
    name: 'profile_home',
    component: ProfileView
  },
  {
    path: '/profile/edit/:username',
    name: 'profile_edit',
    component: ProfileEditView
  }
]

const router = new VueRouter({
  mode: 'history',
  hash: true,
  base: process.env.BASE_URL,
  scrollBehavior (to, from, savedPosition) {
    return { top: 0 }
  },
  routes
})

export default router
