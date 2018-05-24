<style scoped>
	.post-title{
		min-height: 40px;
	}
	.post-title h2{

	}
	.post-description{
		padding: 10px 0px 20px 0px; 
	}
	.post-image img {
	    pointer-events: none;
	}
</style>
<template>
	<div class="row">
		<div class="col-md-8 col-sm-8 col-xs-12" v-for="photo in phts">
			<div class="post-title">
				<h2>{{ photo.title }}</h2>
			</div>
			<div class="post-image">
			  	<img :src="domain+photo.image" class="responsive">
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12"  v-for="photo in phts">
			<label class="btn-block text-center bg-success pd-10 cl-wht">Activity</label>
			 <social-sharing :url="url"
                      :title="photo.title"
                      :description="photo.shortDescription"
                      hashtags="#photographer"
                      inline-template>
				<div>
					<div>
						<network network="email" class="btn btn-sm btn-outline-success">
					        <i class="fa fa-envelope"></i> Email
					    </network>
						<network network="facebook" class="btn btn-sm btn-outline-success">
							<i class="fa fa-facebook"></i> Facebook
						</network>
						<network network="googleplus" class="btn btn-sm btn-outline-success">
							<i class="fa fa-google-plus"></i> Google +
						</network>
						<network network="linkedin" class="btn btn-sm btn-outline-success">
							<i class="fa fa-linkedin"></i> LinkedIn
						</network>
					</div>
				</div>
			</social-sharing>
			<div class="post-description" align="justify" v-html="photo.description"> </div>

			<div>
				<a @click="confirmed" class="btn btn-outline-success btn-sm btn-block" v-if="userStore.authUser && userStore.authUser.access_token" :href="domain+photo.image" :download="photo.title">Download</a>
				<b-link v-else v-bind:to="'/login'" class="btn btn-outline-success btn-sm btn-block">Login to download the image</b-link>
			</div>
		</div>
	</div>
</template>
<script>
	import { photo, getHeader, apiDomain, confirmInvite } from '@/config'
	import { mapState } from 'vuex'
	export default{
		name: 'photo',
		data(){
			return {
				url: document.URL,
				phts: '',
				domain: apiDomain
			}
		},
		computed: {
			...mapState({
				userStore: state => state.userStore 
			})
		},
		created(){
			this.getPhoto(this.$route.params.id)
		},
		methods: {
			getPhoto: function(id){
				axios.get(photo+'/'+id)
					.then(response =>{
						this.phts = response.data;
					})
					.catch(errr => {
						console.log(errr.response)
					});
			},
			confirmed(event){
				axios.post(confirmInvite, { id: this.$route.params.id }, { headers: getHeader() })
				.then(response => {
					console.log(response)
				}).catch(error => {
					console.log(error.response)
				});
			}
		}
	}
</script>