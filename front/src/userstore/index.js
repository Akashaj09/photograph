const state = {
	authUser: null,
	email: null
}

const mutations = {
	SET_EMAIL(state, email){
		state.email = email
	},
	SET_AUTH_USER(state, userObj){
		state.authUser = userObj
	},
	CLEAR_AUTH(state){
		state.authUser = null
	}
}

const actions = {
	setuserobj: ({ commit }, userObj) => {
		commit('SET_AUTH_USER', userObj)
	},
	setEmail: ({ commit }, email) => {
		commit('SET_EMAIL', email)
	},
	clearAuth: ({ commit }) => {
		commit('CLEAR_AUTH')
	}
}
export default{
	state, mutations, actions
}