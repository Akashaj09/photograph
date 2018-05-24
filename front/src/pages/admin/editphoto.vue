<template>
	<div class="row">
		<div class="col-md-9">
			<b-form @submit.prevent="editPhoto" enctype="multipart/form-data">
				<b-alert variant="success" v-show="messages" show>Edited successfully</b-alert>
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
				            label="Visibility:"
				            label-for="vs">
				<b-form-checkbox id="vs"
                     v-model="photo.status"
                     value="1"
                     unchecked-value="0" checked="1">Visible
			    </b-form-checkbox>
				</b-form-group>
				<div class="col-md-12 text-danger" v-show="errors">
					<p v-for='err in errors'>{{ err[0] }}</p>
				</div>
				<b-button type="submit" variant="outline-success">Submit</b-button>
				</b-form>
		</div>
		<div class="col-md-3">
			<label>Rules</label>
		</div>
	</div>
</template>
<script>
	import { publishphoto, getHeader } from '@/config'
	export default{
		name: 'edit',
		data(){
			return {
				photo: {
					id: '',
					title: '',
					description: '',
					status: 0
				},
				errors: '',
				messages: ''
			}
		},
		methods: {
			editPhoto: function(){

				axios.put(publishphoto+'/'+this.$route.params.id, this.photo, { headers: getHeader() })
					.then(response => {
						if(response.data.success){
							//displaying message
							this.messages = true

							//waiting for some momment
							setTimeout(() => {
								this.$router.push({ path: `/photos/${ this.photo.id }` });
							}, 1000);
						}else{

						}
					}).catch(err => {
						this.errors = err.response.data.errors;
					});
			},
			getPhoto: function(id){
				axios.get(publishphoto+'/'+id, { headers: getHeader() })
					.then(response =>{
						this.photo.id = response.data[0].id
						this.photo.title = response.data[0].title
						this.photo.description = response.data[0].description
					})
					.catch(errr => {
						console.log(errr.response)
					});
			}
		},
		created(){
			this.getPhoto(this.$route.params.id)
		}
	}
</script>