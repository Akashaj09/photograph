import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

import userStore from '@/userstore'

export default new Vuex.Store({
	modules: {
		userStore
	},
	strict: debug
})