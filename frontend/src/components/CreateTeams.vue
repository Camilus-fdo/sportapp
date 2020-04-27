<template>
	<div class="std-reg-form-1">		
		<div class="container std-reg-form-1">
			<h1>Teams Registration</h1>
			<form>
				<div class="form-group">
				    <label for="exampleInputEmail1">ID</label>
				    <input type="text" class="form-control" id="name" v-model="id">
			  	</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">Name</label>
				    <input type="text" class="form-control" id="name" v-model="name">
			  	</div>
			  	<div class="form-group">
				    <label for="exampleInputEmail1">Logo</label>
				    <input type="file" class="form-control" id="logo" @change="changeImage($event)">
			  	</div>
			  	<button type="submit" class="btn btn-primary" v-on:click.prevent="teamRegistration()">Register</button>
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

				this.axios.post('http://sportapp.com/api/create_team',
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
		  					// this.$router.push({name:'StdReg1'})
						})
					}
					
				})
				.catch(error => {
    				console.log(error.response)
				});
			}
		}	
	}
	
</script>