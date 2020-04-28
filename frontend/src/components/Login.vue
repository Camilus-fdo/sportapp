<template>
	<div class="row justify-content-center">
		<div class="form-template form-login">
				<h3 class="login-title">Sign in</h3>
			    <div v-if="loggingIn" class="container-loading">
			      Loding...
			    </div>
			    <div class="errors" v-if="errorMessage">
			    	{{loginMessage}}
			    	<!-- <ul v-for="messages in loginMessage">
			    		<li v-for="message in messages">
			    			{{ message }}
			    		</li>
			    	</ul> -->
				</div>
			    <!-- <p v-if="accessToken">Login successful</p> -->
			    <form @submit.prevent="loginSubmit">
					<div class="form-group">
					    <label>User Name</label>
					    <input type="email" class="form-control" v-model="email">
				  	</div>
					<div class="form-group">
					    <label>Password</label>
					    <input type="password" class="form-control" v-model="password">
				  	</div>
					<button type="submit" class="btn btn-primary login-button">Login</button>
				</form>
			
	  	</div>
	</div>
</template>
<script>
	import { mapState, mapActions } from 'vuex';

	export default{
		data(){
			return{
				email 		: '',
				password 	: '',
			}
		},

		created() {
			this.fetchAccessToken();
		},

		computed: {
			
			...mapState([
				'loggingIn',
				'loginMessage',
        		'errorMessage',
        		'loginSuccessful',
				])
		
		},

		methods: {
			...mapActions([
				'doLogin',
				'fetchAccessToken'
				]),

			loginSubmit() {
				this.doLogin({
					email : this.email,
					password : this.password
				})
			},

		},


	}
</script>
<style>
 
</style>