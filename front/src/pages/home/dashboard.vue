<template>
    <div>
        <div class="row">
            <div class="col-md-12 text-center" v-show="loading">
                <img src="../../assets/loader.gif" alt="" height="60">
            </div>
            <div class="col-md-4 col-xs-6 col-sm-6 col-lg-4" v-for="photo in photos.data">
                <b-link v-bind:to="'/photos/'+photo.id">
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
                    <li class="page-item"><b-link v-bind:to="'/userphotos/2'" v-show="next" class="page-link">Next</b-link></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import { publishphoto, getHeader, apiDomain } from '@/config'
    export default{
        name: 'dashboard',
        data(){
            return {
                photos: '',
                domain: apiDomain,
                next: '',
                loading: true
            }
        },
        created(){
            const userObj = JSON.parse(window.localStorage.getItem('authUser'))
            if(userObj == null){
             this.$router.push({ path: '/login' })
            }
            axios.get(publishphoto, {headers: getHeader()}).
                then(response => {
                    this.photos = response.data;
                    this.loading = false;
                    this.next = response.data.next_page_url;
                }).catch(err => {
                    console.log(err.response);
                });
        },
        components: {
            
        }
    } 
</script>
