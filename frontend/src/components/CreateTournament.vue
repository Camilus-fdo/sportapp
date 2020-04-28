<template>
	<div class="container">
		<nav-bar></nav-bar>
		<h1>Tournament Registration</h1>
		<div class="row">
			<div class="col-md-6 form-template">
				<form>
					<div class="form-group">
					    <label for="exampleInputEmail1">Name</label>
					    <input type="text" class="form-control" id="name" v-model="name">
				  	</div>
				  	<div class="form-group">
					    <label for="exampleInputEmail1">Logo</label>
					    <input type="file" class="form-control" id="logo" @change="changeImage($event)">
				  	</div>
				  	<button type="submit" class="btn btn-primary" v-on:click.prevent="tournamentRegistration()">Register</button>
				  	<div class="errors">
			  			<ul  v-for="error in errors">
				  			<li  v-for="e in error">
				  				{{e}}
				  			</li>
			  			</ul>
			  		</div>
				</form>
			</div>
			<div class="col-md-6">
				<div class="data-table teams-detial-table">
					<data-table :data="gridData" :filter-key="searchQuery" :columns-to-display="gridColumns" :display-names="displayNames" :items-per-page="6">
						<template slot="more_details" scope="props">
	    					<i @click="addToTournaments(props.entry.id)" class="fa fa-plus"></i>
		    			</template>
					</data-table>
	  			</div>
			</div>
		</div>
		<div class="row">
			<table class="table table-striped table-hover">
			    <tbody>
			      	<tr v-for="(team,index) in checkedTeams">
			      		<td v-for="(value,index) in team">
			        		{{value}}
			        	</td>
			        	<td>
			        		<i class="fa fa-times fa-lg" @click="removeTeams(index)"></i>
			         	</td>
			      	</tr>
			    </tbody>
		  	</table>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				searchQuery 	: "",
				name 			: "",
				logo 			: "",
				gridData		: [[]],
				gridColumns		:[	
									'id',
									'name',
									'more_details'
								],
				displayNames 	: {
									'id'			: 'id',
									'name'			: 'name',
									'more_details' 	: 'Action'
								},
				checkedTeams 	:[],
				errors 			: "",
				teamIds 		: [],
				errors 			: []
			}
		},

		created(){
			this.getTeams()
		},

		methods:{
			changeImage(e)
			{
				var reader = new FileReader()

				reader.readAsDataURL(e.target.files[0]);
				reader.onload = (e) => {
                    this.logo = e.target.result
                };
                
				
			},

			tournamentRegistration()
			{
				if(this.checkedTeams.length == 5){
					var data_object = {
					'name'	: this.name,
					'logo'	: this.logo,
					'teams' : this.teamIds
					}

					this.axios.post(window.baseUrl + 'api/create_tournament',
						data_object
					)
					.then(response=> {
						var status = response.data.success
						if(status){
							swal({
								title: "Successfuly Created!",
								icon: "success",
								button: "Ok",
							})
							.then((status) => {
			  					this.$router.push({name:'ListTournament'})
							})
						}
						
					})
					.catch(error => {
	    				this.errors = error.response.data.errors
					});
				}else{
					swal({
						title: 'Tournamnet must have 5 Teams',
						icon: 'error',
						confirmButtonText: 'Cool'
					})
				}
				
			},

			getTeams()
			{
				var _t = this
				this.axios.get('http://sportapp.com/api/all_teams')
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

			addToTournaments(id)
			{
				this.checkedTeams.push(this.gridData[id-1])
				this.teamIds.push(id)
				// this.gridData.splice(id-1, 1)
				console.log("sssss",this.teamIds)
			},

			removeTeams(id)
			{
				this.checkedTeams.splice(id,1)
				this.teamIds.splice(id,1)
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