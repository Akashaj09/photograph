import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import axios from 'axios'
import store from './store'
import App from './App.vue'

import router from './router'

Vue.use(BootstrapVue, axios);

var SocialSharing = require('vue-social-sharing');

Vue.use(SocialSharing);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.productionTip = false
window.axios = require('axios')

router.beforeEach((to, from, next) => {
	if(to.name == 'Login'){
		window.localStorage.setItem('fromLink', JSON.stringify(from.path))
		next();
	}
	if(to.meta.isAuth){
		const user = JSON.parse(window.localStorage.getItem('authUser'))
		if(user && user.access_token){
			next()
		}else{
			next({ path: '/login' })
		}
	}
	next();
})

new Vue({
	router,store,
  	render: h => h(App)
}).$mount('#app')