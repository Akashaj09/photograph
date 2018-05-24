<template>
	<div>
		<div class="row">
			<div class="col-md-12">
				<small>We have sended a activation code in your email please confirm the pin</small>
				<b-alert show variant="danger" v-show="form.error">{{ form.error }}</b-alert>
				<b-form @submit.prevent="activateUser">
					<b-form-group id="exampleInputGroup2"
					            label="Activation code:"
					            label-for="exampleInput2">
					<b-form-input id="exampleInput2"
					              type="text"
					              v-model="form.code"
					              required
					              placeholder="Activation code">
					</b-form-input>
					</b-form-group>
					<b-button type="submit" variant="primary">Submit</b-button>
					</b-form>
			</div>
		</div>
	</div>
</template>
<script>
	import { mapState } from 'vuex'
	import { activateUrl } from '@/config'
	export default{
		name: 'Activate',
		data(){
			return {
				form: {
					code: '',
					error: ''
				}
			}
		},
		computed: {
			...mapState({
				userStore: state => state.userStore 
			})
		},
		created(){
			const userObj = JSON.parse(window.localStorage.getItem('authUser'))
		    if(userObj != null){
		     this.$router.push({ path: '/dashboard' })
		    }
		},
		methods: {
			activateUser: function() {
				this.form.error = '';
				var email = this.$route.params.email
				if(this.form.code.length >= 6){
					axios.post(activateUrl, { code: this.form.code, email: email })
						.then(response => {
							if(response.data.success){
								this.$store.dispatch('setEmail', email)
								this.$router.push({ path: '/login' })
							}else{
								this.form.error = response.data.message;
							}
						})
						.catch(err => {
							console.log(err.response)
						});
				}else{
					this.form.error = 'Activation code length is six digit'
				}
			}
		}
	}
</script>