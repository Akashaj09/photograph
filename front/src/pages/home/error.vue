<style scoped>
	.txt{
		font-size: 80px;
		font-weight: bold;
		padding: 150px 0px 150px 0px;
	}
</style>
<template>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-sm-12 text-center txt">
			{{ message }}
		</div>
	</div>
</template>
<script>
	export default{
		name: 'errorpage',
		data(){
			return{
				message: "404 not found"
			}
		}
	}
</script>