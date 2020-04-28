<template>
	<div class="container">
		<nav-bar></nav-bar>
		<div class="row">	
			<h1>Score Board</h1>
		</div>
		<div class="row">
			<div class="col-md-6 form-template">
				<div class="team-name">
					<b>{{team1_name}}</b>
				</div>
				<div v-if="byehandling" class="form-group">
					<label>Tries</label></br>
						<input type="number" class="scoure-counter" id="point1" name="points" step="1" v-model="point1" @click="handleBounusPoint()">
				</div>
				<div class="form-group" v-if="byehandling">
					<label>Coversions</label></br>
						<input type="number" class="scoure-counter" id="con1" name="points" step="1" v-model="conversion1">
				</div>		
			</div>
			<div class="col-md-6 form-template">
				<div class="team-name">
					<b>{{team2_name}}</b>
				</div>
				<div class="form-group" v-if="byehandling">
					<label>Tries</label></br>
					<input type="number" class="scoure-counter" id="point2" name="points" step="1" v-model="point2" @click="handleBounusPoint()">
				</div>
				<div class="form-group" v-if="byehandling">
					<label>Coversions</label></br>	
					<input type="number" class="scoure-counter" id="con1" name="points" step="1" v-model="conversion2">
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="btn-area">
				<button class="btn btn-primary justify-content-center" @click="calculateTotalPoint()">Finsh Game</button>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				point1 				: 0,
				point2 				: 0,
				conversion2			: 0,
				conversion1			: 0,
				bounus_point_team1	: 0,
				bounus_point_team2	: 0,
				total_point1		: 0,
				total_point2		: 0,
				tournament_id 		: "",
				team1_name 			: "",
				team2_name 			: "",
				game_id 			: "",
				team1_wins 			: 0,
				team2_wins 			: 0,
				byehandling 		: true
			}
		},
		
		created(){
			this.tournament_id 	= this.$route.params.tournmnt_id
			this.game_id		= this.$route.params.game_id
			this.team1_name		= this.$route.params.team1
			this.team2_name		= this.$route.params.team2

			this.byeshandler();
			
		},

		methods:{
			byeshandler(){
				if(this.team1_name == 'bye'){
					this.team2_wins = 1
					this.byehandling = false
				}else if(this.team2_name == 'bye'){
					this.team1_wins = 1
					this.byehandling = false
				}

				console.log("sssssss", this.team1_wins)
				console.log("sssssss", this.team2_wins)
			},

			handleBounusPoint()
			{
				
				if(this.point1 >= 3 && this.bounus_point_team2 != 6){
					this.bounus_point_team1 = 6
					this.bounus_point_team2 = 0
				}else if(this.point2 >= 3){
					this.bounus_point_team2 = 6
					this.bounus_point_team1 = 0
				}else{
					this.bounus_point_team1 = 0
					this.bounus_point_team2 = 0
				}
				// console.log("test1", this.bounus_point_team1)
				// console.log("test2", this.bounus_point_team2)
			},

			calculateTotalPoint()
			{
				this.total_point1 = this.point1 *5 + this.conversion1 * 3
				this.total_point2 = this.point2 *5 + this.conversion2 * 3

				if(this.total_point1 > this.total_point2){
					this.team1_wins = 1
					this.team2_wins = 0 
				}else if(this.total_point1 < this.total_point2){
					this.team1_wins = 0
					this.team2_wins = 1 
				}else if(this.total_point1 == this.total_point2){
					if(this.bounus_point_team1 > this.bounus_point_team2){
						this.team1_wins = 1
						this.team2_wins = 0
					}else if(this.bounus_point_team1 < this.bounus_point_team2){
						this.team1_wins = 0
						this.team2_wins = 1
					}else if(this.bounus_point_team1 == this.bounus_point_team2){
						if(this.point1 > this.point2){
							this.team1_wins = 1
							this.team2_wins = 0
						}else if(this.point1 < this.point2){
							this.team1_wins = 0
							this.team2_wins = 1
						}else if(this.point1 == this.point2){
							this.randomWin()
						}
					}
				}

				var team1_object = {
					'tournmnt_id'	: this.tournament_id,
					'team_name'		: this.team1_name,
					'game_id'		: this.game_id,
					'tries'			: this.point1,
					'conversions'	: this.conversion1,
					'bonus_point'	: this.bounus_point_team1,
					'total_point'	: this.total_point1,
					'wins'			: this.team1_wins
				}

				var team2_object = {
					'tournmnt_id'	: this.tournament_id,
					'team_name' 	: this.team2_name,
					'game_id'		: this.game_id,
					'tries'			: this.point2,
					'conversions'	: this.conversion2,
					'bonus_point'	: this.bounus_point_team2,
					'total_point'	: this.total_point2,
					'wins'			: this.team2_wins
				}

				

				var socre_object = {
					team1_object,
					team2_object
				}
				// console.log("sssssss", socre_object)
				this.axios.post(window.baseUrl + 'api/save_score',
					socre_object
				)
				.then(function(response){
					swal({
						title: "Successfuly Finished!",
						icon: "success",
						button: "Ok",
					})
					.then((status) => {
			  			this.$router.push({name:'ListTournament'})
					})
					
				})
				.catch(function (error) {
	    			console.log(error);
	  			})
				// console.log("test2", this.total_point2)
			},

			randomWin(){
				var random = Math.round(Math.random())
				var team1 = random
				
				if(team1 == 1){
					this.team1_wins = 1
					this.team2_wins = 0
				}else{
					this.team1_wins = 0
					this.team2_wins = 1
				}
			},
		}
	}
</script>
<style>
	scoure-counter{
		height: 70px;
	}
	team-name{
		font-size: 100px;
	}
</style>