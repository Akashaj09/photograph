<template>
	<div>
		<div class="row">
			<div class="col-md-12 text-center" v-show="loading">
                <img src="../../assets/loader.gif" alt="" height="60">
            </div>
			<div class="col-md-4 col-xs-6 col-sm-6 col-lg-4" v-for="photo in photos">
				<b-link v-bind:to="'/photo/'+photo.id">
					<div class="post">
					  	<img :src="domain+photo.image" class="responsive">
					  	<div class="post-s">
					    	<p>{{ photo.title }}</p>
						</div>
					</div>
				</b-link>
				<br>
			</div>
		</div>
		<div class="row">
            <div class="col-md-12 text-center">
                <ul class="pagination">
                    <li class="page-item"><b-link v-bind:to="'/home/2'" v-show="next" class="page-link">Next</b-link></li>
                </ul>
            </div>
        </div>
	</div>
</template>

<script>
	import { photos, apiDomain } from '@/config'
	export default {
		name: 'About',
		data () {
			return {
			 	photos: '',
			 	domain: apiDomain,
			 	loading: true,
			 	next: '',
			}
		},
		created(){
			this.getImage()
		},
		methods: {
			getImage(){
				axios.get(photos).then(response => {
					this.loading = false;
					this.photos = response.data.data;
					this.next = response.data.next_page_url;
				}).catch(error => {
					console.log(error.response)
				});
			}
		}
	}
</script>