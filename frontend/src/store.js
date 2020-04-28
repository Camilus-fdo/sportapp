import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Router from './router.js'


Vue.use(Vuex)
Vue.use(VueAxios, axios)

export default new Vuex.Store({
	state:{
		loggingIn: false,
		loginMessage: null,
		loginSuccessful: false,
		errorMessage : false,
		accessToken: null
	},

	mutations:{
		loginStart: state => state.loggingIn = true,
		loginStop: (state, data) => {
			state.loggingIn = false;
			//console.log('mu', data);
			state.loginMessage = data.errors;
			state.loginSuccessful = data.status;
			state.errorMessage = !data.status;
		},
		
		updateAccessToken(state, accessToken){
			state.accessToken = accessToken;
		},

		logout(state, accessToken){
			state.accessToken = null;
		},
	},

	actions:{
		doLogin({commit}, loginData) {
			commit('loginStart');
			Vue.axios.post('http://sportapp.com/api/login',{
				...loginData
			})
			.then(response => {
				console.log(response)
				localStorage.setItem('accessToken', response.data.data.token)
				commit('loginStop', {status: response.data.success, message:response.data.message})
				commit('updateAccessToken', response.data.data.token)
				Router.push('/list_tournaments');
			})
			.catch(error => {
				// console.log("asasasas",error.response)
				commit('loginStop', error.response.data)
				commit('updateAccessToken', null)
			})
		},

		fetchAccessToken({ commit }) {

      		commit('updateAccessToken', localStorage.getItem('accessToken'));
    	},

    	dologout({commit}){
    		localStorage.removeItem('accessToken');
    		commit('logout');
    		Router.push('/login');
    	}
	}


})