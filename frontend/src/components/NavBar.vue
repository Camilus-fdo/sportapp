<template>
	<nav class="navbar navbar-expand-lg navbar-light bg-faded">
	  	<a class="navbar-brand" href="#">SPORT APP</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
		    <div class="navbar-nav">
			  	<a class="nav-item nav-link active">
			  		<router-link to="/list_tournaments">Home <span class="sr-only">(current)</span></router-link>
			  	</a>
			  	<a class="nav-item nav-link">
			  		<router-link to="/create_tournament">New Tournament</router-link>
			  	</a>
			  	<a class="nav-item nav-link">
			  		<router-link to="/create_team">New Team</router-link>
			  	</a>
			  	<!-- <a class="nav-item nav-link" href="#">Pricing</a> -->
			  	<!-- <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
	    	</div>
  		</div>
	</nav>
</template>
<script>
	
</script>
<style>

</style>