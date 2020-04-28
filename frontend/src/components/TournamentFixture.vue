<template>
	<div class="container">
		<div class="row">
			{{tournmnt_name}}
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="data-table teams-detial-table">
				<!-- <datatable :columns="columns" :data="rows"></datatable> -->
				<data-table :data="gridData" :columns-to-display="gridColumns" :display-names="displayNames" :items-per-page="10">
					<template slot="more_details" scope="props">
						<i v-if="props.entry.status == 0" @click="viewDetails(props.entry.id, props.entry.home, props.entry.away)" class="fa fa-info-circle fa-lg"></i>
						<i v-if="props.entry.status == 1">Game Ended</i>
	    			</template>
				</data-table>
				<!-- <v-for>{{gridData}}</v-for> -->
				<!-- <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config" :actions="actions"
	                                @on-download="onDownload">
	        	</vue-bootstrap4-table> -->
	  			</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				tournmnt_id 	: "6",
				searchQuery 	: "",
				gridData		: [[]],
				gridColumns		:[	
									'id',
									'home',
									'away',
									'more_details'
								],
				displayNames 	: {
									'id'			: 'id',
									'home'			: 'Home',
									'away'			: 'Away',
									'more_details' 	: 'Action'
								},
			}
		},

		created(){
			this.tournmnt_id 	= this.$route.params.tournmnt_id
			this.tournmnt_name	= this.$route.params.tournmnt_name
			if(typeof this.tournmnt_id !== 'undefined'){
				this.getFixtures()
			}else{
				this.$router.push({name:'ListTournament'})
			}
			
		},

		methods:{
			getFixtures()
			{
				var _t = this
				var data_object = {
					'id'	: this.tournmnt_id,
					}
				this.axios.post('http://sportapp.com/api/get_fixture',
					data_object
				)
				.then(function(response){
					_t.setTableData(response)
					
				})
				.catch(function (error) {
	    			console.log(error);
	  			})
			},

			setTableData(response)
			{
				var _t = this
				_t.gridData = response.data
				// console.log("test", _t.gridData)
			},

			viewDetails(id, team1, team2)
			{
				this.$router.push({name:'ScoreBoard', params:{tournmnt_id:this.tournmnt_id, game_id:id,team1:team1, team2:team2}})
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