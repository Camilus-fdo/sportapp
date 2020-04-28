import Vue from 'vue'
import VueRouter from 'vue-router'
import store from "./store.js";

Vue.use(VueRouter)

import Login from './components/Login.vue'
import Registration from './components/Registration.vue'
import CreateTeam from './components/CreateTeams.vue'
import CreateTournament from './components/CreateTournament.vue'
import ListTournament from './components/ListTournaments.vue'
import TournamentFixture from './components/TournamentFixture.vue'
import ScoreBoard from './components/ScoreBoard.vue'
import LeaderBoard from './components/LeaderBoard.vue'

const router = new VueRouter({
	mode: 'history',
	routes: [
		{path: "/", component: Login, name:'Login'},
		{path: "/login", component: Login, name:'Login'},
		{path: "/registration", component: Registration, name:'Registration'},
		{path: "/create_team", component: CreateTeam, name:'CreateTeam'},
		{path: "/create_tournament", component: CreateTournament, name:'CreateTournament'},
		{path: "/list_tournaments", component: ListTournament, name:'ListTournament'},
		{path: "/tournament_fixture", component: TournamentFixture, name:'TournamentFixture'},
		{path: "/score_board", component: ScoreBoard, name:'ScoreBoard'},
		{path: "/leader_board", component: LeaderBoard, name:'LeaderBoard'},
	]

});

export default router;