<template>
	<div class="row">
		<div class="col-md-9">
			<b-form @submit.prevent="publishphoto" enctype="multipart/form-data">
				<b-alert variant="success" v-show="messages" show>Added successfully</b-alert>
				<b-form-group
				            label="Photo title:"
				            label-for="title">
				<b-form-input id="title"
				              type="text"
				              v-model="photo.title"
				              required
				              placeholder="Photo title">
				</b-form-input>
				</b-form-group>
				<b-form-group
				            label="Photo Description:"
				            label-for="description">
					<b-form-textarea id="textarea1"
							v-model="photo.description"
							placeholder="Enter something"
							:rows="3"
							:max-rows="6">
				    </b-form-textarea>
				</b-form-group>
				<b-form-group
				            label="Image:"
				            label-for="file">
					<b-form-file id="file" v-model="photo.file" placeholder="Choose a file..."></b-form-file>
				</b-form-group>
				<b-form-group
				            label="Visibility:"
				            label-for="vs">
				<b-form-checkbox id="vs"
                     v-model="photo.status"
                     value="1"
                     unchecked-value="0">Visible
			    </b-form-checkbox>
				</b-form-group>
				<div class="col-md-12 text-danger" v-show="errors">
					<p v-for='err in errors'>{{ err[0] }}</p>
				</div>
				<b-button type="submit" variant="outline-success">Submit</b-button>
				</b-form>
		</div>
		<div class="col-md-3" order-sm="1">
			<label>Rules</label>
		</div>
	</div>
</template>
<script>
	import { publishphoto, getHeader } from '@/config'
	export default{
		name: 'publishphoto',
		data(){
			return {
				photo: {
					title: 'A title',
					description: 'No description',
					file: '',
					status: ''
				},
				errors: '',
				messages: ''
			}
		},
		components: {

		},
		methods: {
			publishphoto: function(){
				this.messages = false
				var formData = new FormData();
				var imagefile = this.photo.file;
				formData.append("image", imagefile);
				formData.append("title", this.photo.title);
				formData.append("description", this.photo.description);
				formData.append("status", this.photo.status);
				axios.post(publishphoto, formData, { headers: getHeader() })
					.then(response => {
						if(response.data.success){
							//displaying message
							this.messages = true

							//waiting for some momment
							setTimeout(() => {
								this.$router.push({ path: `/photos/${ response.data.lastId }` });
							}, 1000);
						}else{

						}
					}).catch(err => {
						this.errors = err.response.data.errors;
					});
			}
		},
		created(){
			const userObj = JSON.parse(window.localStorage.getItem('authUser'))
	        if(userObj == null){
	         this.$router.push({ path: '/login' })
	        }
		}
	}
</script>