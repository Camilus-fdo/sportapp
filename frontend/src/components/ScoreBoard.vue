<template>
	<div class="container">
		<div class="row">
			
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="team-name">
					{{team1_name}}
				</div>
				<input type="number" class="scoure-counter" id="point1" name="points" step="1" v-model="point1" @click="handleBounusPoint()">
				<input type="number" class="scoure-counter" id="con1" name="points" step="1" v-model="conversion1">
			</div>
			<div class="col-md-6">
				<div class="team-name">
					{{team2_name}}
				</div>
				<input type="number" class="scoure-counter" id="point2" name="points" step="1" v-model="point2" @click="handleBounusPoint()">
				<input type="number" class="scoure-counter" id="con1" name="points" step="1" v-model="conversion2">
			</div>
			{{point1}} vs {{point2}}
		</div>
		<div class="row">
			<button @click="calculateTotalPoint()">Done</button>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				point1 				: "",
				point2 				: "",
				conversion2			: "",
				conversion1			: "",
				bounus_point_team1	: "",
				bounus_point_team2	: "",
				total_point1		: "",
				total_point2		: "",
				tournament_id 		: "",
				team1_name 			: "Argentina",
				team2_name 			: "Brazil",
				game_id 			: "1"
			}
		},
		
		created(){
			this.tournament_id 	= this.$route.params.tournmnt_id
			this.game_id		= this.$route.params.game_id
			this.team1_name		= this.$route.params.team1
			this.team2_name		= this.$route.params.team2
		},

		methods:{
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
				console.log("test1", this.bounus_point_team1)
				console.log("test2", this.bounus_point_team2)
			},

			calculateTotalPoint()
			{
				this.total_point1 = this.point1 *5 + this.conversion1 * 3
				this.total_point2 = this.point2 *5 + this.conversion2 * 3

				var team1_object = {
					'tournmnt_id'	: this.tournament_id,
					'team_name'		: this.team1_name,
					'game_id'		: this.game_id,
					'tries'			: this.point1,
					'conversions'	: this.conversion1,
					'bonus_point'	: this.bounus_point_team1,
					'total_point'	: this.total_point1
				}

				var team2_object = {
					'tournmnt_id'	: this.tournament_id,
					'team_name' 	: this.team2_name,
					'game_id'		: this.game_id,
					'tries'			: this.point2,
					'conversions'	: this.conversion2,
					'bonus_point'	: this.bounus_point_team2,
					'total_point'	: this.total_point2
				}

				var socre_object = {
					team1_object,
					team2_object
				}
				console.log("test1", socre_object)

				this.axios.post('http://sportapp.com/api/save_score',
					socre_object
				)
				.then(function(response){
					swal({
						title: "Successfuly Added!",
						icon: "success",
						button: "Ok",
					})
					
				})
				.catch(function (error) {
	    			console.log(error);
	  			})
				// console.log("test2", this.total_point2)
			},
		}
	}
</script>
<style>
	scoure-counter{
		height: 70px;
	}
	team-name{
		font: 70px;
	}
</style>