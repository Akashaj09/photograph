import Vue from 'vue'
import vueRouter from 'vue-router'

import Index from '@/pages/home/index'
import Register from '@/pages/home/Register'
import Login from '@/pages/home/login'
import Dashboard from '@/pages/home/dashboard'
import Activate from '@/pages/home/activate'
import PublishPhoto from '@/pages/admin/publishphoto'
import UserPhotos from '@/pages/admin/userphotos'
import Photo from '@/pages/home/photo'
import Home from '@/pages/home/home'
import Edit from '@/pages/admin/editphoto'
import Photos from '@/pages/admin/photo'

Vue.use(vueRouter)


export default new vueRouter({
	routes: [
		{
			path: '/',
			component: Index,
			name: 'Index'
		},
		{
			path: '/photo/:id',
			component: Photo,
			name: 'photo'
		},
		{
			path: '/home/:pagenum',
			component: Home,
			name: 'home'
		},
		{
			path: '/register',
			component: Register,
			name: 'Register'
		},
		{
			path: '/login',
			component: Login,
			name: 'Login'
		},
		{
			path: '/dashboard',
			component: Dashboard,
			name: 'dashboard',
			meta: { isAuth: true }
		},
		{
			path: '/activate/:email',
			component: Activate,
			name: 'activate'
		},
		{
			path: '/addphotos',
			component: PublishPhoto,
			name: 'publishphoto',
			meta: { isAuth: true }
		},
		{
			path: '/userphotos/:pagenum',
			component: UserPhotos,
			name: 'userphotos',
			meta: { isAuth: true }
		},
		{
			path: '/photo/:id/edit',
			component: Edit,
			name: 'edit',
			meta: { isAuth: true }
		},
		{
			path: '/photos/:id',
			component: Photos,
			name: 'photos',
			meta: { isAuth: true }
		},
		{
			path: '*',
			component: Index
		}
	],
	mode: 'history',

	scrollBehavior (to, from, savedPosition) {
	  if (savedPosition) {
	    return savedPosition
	  } else {
	    return { x: 0, y: 0 }
	  }
	}
})