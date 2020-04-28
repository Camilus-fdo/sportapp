<template>
	<div class="container">
		<div class="container form-template col-md-6">
			<h1>Organizer Registration</h1>
			<form>
				<div class="form-group">
				    <label for="exampleInputEmail1">Name</label>
				    <input type="text" class="form-control" id="name" v-model="name">
			  	</div>
			  	<div class="form-group">
				    <label for="exampleInputEmail1">Email</label>
				    <input type="email" class="form-control" id="email" v-model="email">
			  	</div>
			  	<div class="form-group">
				    <label for="exampleInputEmail1">Password</label>
				    <input type="password" class="form-control" id="password" v-model="password">
			  	</div>
			  	<div class="form-group">
				    <label for="exampleInputEmail1">Confirm Password</label>
				    <input type="password" class="form-control" id="c_password" v-model="c_password">
			  	</div>
			  	<button class="btn btn-primary login-button" v-on:click.prevent="registration()">Register</button>
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
				name  		: "",
				email 		: "",
				password 	: "",
				c_password 	: "",
				errors 		: "",
			}
		},

		created(){

		},

		methods:{
			registration()
			{
				var data_object = {
					'name'		: this.name,
					'email'		: this.email,
					'password'	: this.password,
					'c_password': this.c_password
				}

				this.axios.post(window.baseUrl + 'api/register',
					data_object
				)
				.then(response=> {
					var status = response.data.success
					if(status){
						swal({
							title: "Successfuly Registerd!",
							icon: "success",
							button: "Ok",
						})
						.then((status) => {
		  					this.$router.push({name:'Login'})
						})
					}
					
				})
				.catch(error => {
    				this.errors = error.response.data.errors
				});
			}
		},
	}
</script>
<style>
	.errors{
		background-color: #ff6666;
	}
</style>