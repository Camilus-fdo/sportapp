<template>
	<div class="container">
		<nav-bar></nav-bar>	
		<div class="container form-template col-md-6">
			<h1>Teams Registration</h1>
			<form>
				<div class="form-group">
				    <label for="exampleInputEmail1">Name</label>
				    <input type="text" class="form-control" id="name" v-model="name">
			  	</div>
			  	<div class="form-group">
				    <label for="exampleInputEmail1">Logo</label>
				    <input type="file" class="form-control" id="logo" @change="changeImage($event)">
			  	</div>
			  	<button type="submit" class="btn btn-primary" v-on:click.prevent="teamRegistration()">Register</button>
			  	<div class="errors">
		  			<ul  v-for="error in errors">
			  			<li  v-for="e in error">
			  				{{e}}
			  			</li>
		  			</ul>
		  		</div>
			</form>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				id 		: "",
				name 	: "",
				logo 	: "",
				errors 	: "",
			}
		},

		created(){

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

			teamRegistration()
			{
				var data_object = {
					'id'	: this.id,
					'name'	: this.name,
					'logo'	: this.logo
				}

				this.axios.post(window.baseUrl + '/api/create_team',
					data_object
				)
				.then(response=> {
					var status = response.data.success
					if(status){
						swal({
							title: "Successfuly Inserted!",
							icon: "success",
							button: "Ok",
						})
						.then((status) => {
		  					this.$router.push({name:'CreateTeam'})
						})
					}
					
				})
				.catch(error => {
    				this.errors = error.response.data.errors
				});
			}
		}	
	}
	
</script>