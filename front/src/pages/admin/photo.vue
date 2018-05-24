<style scoped>
	.post-title{
		min-height: 40px;
	}
	.post-title h2{

	}
	.post-description{
		padding: 10px 0px 20px 0px; 
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
			 
			<b-btn v-b-modal.emailmodal variant="outline-success" size="sm" class="btn-block mrb-10">Email</b-btn>
			<b-modal id="emailmodal" title="Send email" ref="emailmodal">
				<b-alert :variant="success" v-show="messages" show>{{ messages }}</b-alert>
				<b-form-group id="exampleInputGroup1"
				            label="Email address:"
				            label-for="exampleInput1">
				<b-form-input id="exampleInput1"
				              type="email"
				              v-model="emailid"
				              required
				              placeholder="Enter email">
				</b-form-input>
				</b-form-group>
				<b-form-group id="exampleInputGroup1"
				            label="From:"
				            label-for="exampleInput1">
				<b-form-input id="exampleInput1"
				              type="text"
				              :value="userStore.authUser.name"
				              v-model="sendername"
				              required
				              placeholder="Enter Name">
				</b-form-input>
				</b-form-group>
				<div slot="modal-footer" align="right" class="btn-group">
					<button class="btn btn-outline-success btn-sm" v-on:click="sendMail" :disabled="ds == 1">Send</button>
				</div>
		 	</b-modal>

		 	<social-sharing :url="url"
                      :title="photo.title"
                      :description="photo.shortDescription"
                      hashtags="#photographer"
                      inline-template>
				<div>
					<network network="facebook" class="btn btn-sm btn-outline-success">
						<i class="fa fa-facebook"></i> Facebook
					</network>
					<network network="googleplus" class="btn btn-sm btn-outline-success">
						<i class="fa fa-google-plus"></i> Google +
					</network>
					<network network="linkedin" class="btn btn-sm btn-outline-success">
						<i class="fa fa-linkedin"></i> LinkedIn
					</network>
					<network network="sms" class="btn btn-sm btn-outline-success">
				        Send as sms
				    </network>
				</div>
			</social-sharing>

			<div v-if="userStore.authUser && userStore.authUser.id == photo.admin">
				<div class="btn-group">
					<router-link :to="'/addphotos'" class="btn-link btn">Add new</router-link>
					<router-link :to="'/photo/'+photo.id+'/edit'" class="btn-link btn">Edit</router-link>
					<b-btn v-b-modal.modal1 variant="link">Delete</b-btn>
				</div>
				<b-modal id="modal1" title="Delete?" ok-variant="danger" size="sm" ok-title="Confirm" @ok="deleteData">
					<b-alert :variant="success" v-show="messages" show>{{ messages }}</b-alert>

				</b-modal>
			</div>
			<div class="post-description" align="justify" v-html="photo.description"> </div>
		</div>
	</div>
</template>
<script>
	import { publishphoto, getHeader, apiDomain, semdMailUrl } from '@/config'
	import { mapState } from 'vuex'
	export default{
		name: 'photo',
		data(){
			return {
				emailid: 'akashajaj09@gmail.com',
				url: document.URL,
				phts: '',
				domain: apiDomain,
				messages: '',
				success: '',
				sendername: '',
				photoUrl: "http://"+window.location.host+"/photo/"+this.$route.params.id,
				ds: 0
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
			sendMail: function(){
				this.ds = 1;
				axios.post(semdMailUrl, {email: this.emailid, sendername: this.sendername, url: this.photoUrl}, { headers: getHeader() })
					.then(response => {
						if(response.data.success){
							this.ds = 0;
							this.success = 'success'
							this.messages = response.data.message
						}else{
							this.ds = 0;
							this.success = 'danger'
							this.messages = response.data.message
						}
					}).catch(error => {
						console.log(error.response)
					});
			},
			getPhoto: function(id){
				axios.get(publishphoto+'/'+id, { headers: getHeader() })
					.then(response =>{
						this.phts = response.data;
					})
					.catch(errr => {
						console.log(errr.response)
					});
			},
			deleteData: function(event){
				event.preventDefault()
				axios.delete(publishphoto+'/'+this.$route.params.id, { headers: getHeader() })
					.then(response => {
						if(response.data.success){
							this.success = 'success'
							this.messages = response.data.message
							setTimeout(() => {
								this.$router.push({ path: '/dashboard' })
							}, 1000);
						}else{
							this.success = 'danger'
							this.messages = response.data.message
						}
					})
					.catch(err => {
						console.log(err.response)
					});
			}
		}
	}
</script>

<style>
	.mrb-10{
		margin-bottom: 10px;
	}
</style>