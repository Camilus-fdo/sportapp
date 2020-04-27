import Vue from 'vue'
import VueRouter from 'vue-router'
import store from "./store.js";

Vue.use(VueRouter)

import Login from './components/Login.vue'
import Registration from './components/Registration.vue'
import CreateTeam from './components/CreateTeams.vue'
import CreateTournament from './components/CreateTournament.vue'

const router = new VueRouter({
	mode: 'history',
	routes: [
		{path: "/login", component: Login},
		{path: "/registration", component: Registration},
		{path: "/create_team", component: CreateTeam},
		{path: "/create_tournament", component: CreateTournament},
	]

});

export default router;