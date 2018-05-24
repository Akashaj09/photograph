<template>
	<div>
		<div class="row">
	        <div class="col-md-12 text-center" v-show="loading">
	            <img src="../../assets/loader.gif" alt="" height="60">
	        </div>
	        <div class="col-md-4 col-xs-6 col-sm-6 col-lg-4" v-for="photo in photos.data">
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
	                <li class="page-item"><router-link v-bind:to="prevurl" v-show="prev" class="page-link">Prev</router-link></li>
	                <li class="page-item"><router-link v-bind:to="nexturl" v-show="next" class="page-link">Next</router-link></li>
	            </ul>
	        </div>
	    </div>
	</div>
</template>
<script>
	import { photos, getHeader, apiDomain } from '@/config'
	export default{
		name: 'userphotos',
		created(){
			this.getData(this.$route.params.pagenum)
		},
		updated(){ 
			if(this.$route.params.pagenum == this.last){
				this.next = ''
			}else{
				this.next = parseInt(this.$route.params.pagenum)+1;
			}
			this.prev = this.$route.params.pagenum-1;
			this.prevurl = '/home/'+this.prev;
			this.nexturl = '/home/'+this.next;

		},
		data(){
			return {
				photos: '',
				loading: true,
				next: '',
				prev: '',
				domain: apiDomain,
				last: '',
				prevurl: '',
				nexturl: ''
			}
		},
		methods: {
			getData: function(pagenum){
				axios.get(photos+'?page='+pagenum)
					.then(response => {
						this.photos = response.data;
						this.last = response.data.last_page;
						this.loading = false;
					})
					.catch(err => {
						console.log(err.response)
					})
			}
		},
		watch: {
			'$route' (to, from) {
				loading: true
		    	this.getData(this.$route.params.pagenum)
		    }
		}
	}
</script>