<template>
	<div class="container">
		<nav-bar></nav-bar>
		<h3>{{tournmnt_name}}</h3>
		<div class="data-table teams-detial-table">
			<!-- <datatable :columns="columns" :data="rows"></datatable> -->
			<data-table :data="gridData" :columns-to-display="gridColumns" :display-names="displayNames" :items-per-page="10">
			</data-table>
			<!-- <v-for>{{gridData}}</v-for> -->
			<!-- <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config" :actions="actions"
                                @on-download="onDownload">
        	</vue-bootstrap4-table> -->
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				tournmnt_id : "",
				gridData	: [[]],
				gridColumns	:[	
								'team',
								'team_wins',
							],
				displayNames: {
								'team'			: 'Team',
								'team_wins'		: 'Wins',
							},
				tournmnt_name: ""
			}
		},

		created(){
			this.tournmnt_id 	= this.$route.params.tournmnt_id
			this.tournmnt_name	= this.$route.params.tournmnt_name
			if(typeof this.tournmnt_id !== 'undefined'){
				this.getTeams()
			}else{
				this.$router.push({name:'ListTournament'})
			}
			
			// this.getLeaderBoard()

		},

		methods:{
			getLeaderBoard(teams_array)
			{
				var _t = this
				var req_object ={
					tournmnt_id	: this.tournmnt_id,
					teams 		: teams_array
				}

				this.axios.post('http://sportapp.com/api/get_leaderboard',
					req_object
				)
				.then(function(response){
					// console.log("ttttttttt",response.data.data)
					_t.setTableData(response.data)
									
				})
				.catch(function (error) {
	    			console.log(error);
	  			})
			},

			getTeams(){
				var _t = this
				var data_object = {
					'tournmnt_id' :this.tournmnt_id 
				}

				this.axios.post('http://sportapp.com/api/get_tournmnt_teams',
					data_object
				)
				.then(function(response){
					var teams_array = response.data
					_t.getLeaderBoard(teams_array)
									
				})
				.catch(function (error) {
	    			console.log(error);
	  			})
			},

			setTableData(response){
				var _t = this
				_t.gridData = response.data
			}
		}
	}
</script>
<style>
body {
  font-family: Helvetica Neue, Arial, sans-serif;
  font-size: 14px;
  color: #444;
}

table {
  margin-top: 20px;
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
  width:100%;
}

th {
  background-color: #42b983;
  color: rgba(255, 255, 255, 0.66);
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th,
td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}

.previousPage {
  position: relative;
}
.previousPage:before {
  content: "\f104";
  font-family: FontAwesome;
  position: absolute;
}
 
.nextPage {
  position: relative;
}
.nextPage:before {
  content: "\f105";
  font-family: FontAwesome;
  position: absolute;
  left: 5px;
}

</style>