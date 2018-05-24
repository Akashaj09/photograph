<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12 offset-md-3">
          <div class="card fat">
            <div class="card-body">
              <h4 class="card-title">Login</h4>
              <form method="POST" @submit.prevent="login">

                <div class="form-group">
                  <label for="email">E-Mail Address</label>

                  <input id="email" type="email" class="form-control" name="email" v-model="email" value="" required="" autofocus="">
                </div>
                <br>
                <div class="form-group">
                  <label for="password">Password
                  </label>
                  <div style="position:relative">
                    <input id="password" type="password" class="form-control" name="password" v-model="password" required="" data-eye="" style="padding-right: 60px;"><input type="hidden" id="passeye-0">
                  </div>
                </div>
                <div v-show="error" class="text-danger text-center pd-10">
                  {{ error }}
                </div>
                <div v-show="loading" class="text-danger text-center pd-10">
                  <img src="../../assets/loader.gif" alt="" height="60">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" :disabled="disabled">
                    Login
                  </button>
                </div>
                <div class="margin-top20 text-center">
                  Don't have an account? <router-link v-bind:to="'/register'"> Create One</router-link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'vuex'
import { loginUrl, getHeader, userUrl } from '../../config'
import { clientId, clientSecret } from '../../env'
export default {
  name: 'Login',
  computed: {
    ...mapState({
      userStore: state => state.userStore
    })
  },
  data () {
    return {
      email: '',
      password: '',
      error: '',
      loading: '',
      disabled: false
    }
  },
  created(){
    if(this.userStore.email != null){
      this.email = this.userStore.email;
    }
    const userObj = JSON.parse(window.localStorage.getItem('authUser'))
    if(userObj != null){
     this.$router.push({ path: '/dashboard' })
    }
  },
  methods:{
    login: function(){

      this.loading = true
      this.disabled = true
      const postData = {
        grant_type: 'password',
        client_id: clientId,
        client_secret: clientSecret,
        username: this.email,
        password: this.password,
        scope: '',
        path: ''
      }
      const authUser = {};
      axios.post(loginUrl, postData)
        .then(response => {
          this.error = ''
          this.loading = false
          this.disabled = false
          if(response.data.errors){
            this.error = response.data.errors
          }else{
            authUser.access_token = response.data.access_token
            authUser.refresh_token = response.data.refresh_token
            window.localStorage.setItem('authUser', JSON.stringify(authUser))
            axios.get(userUrl, {headers: getHeader()})
            .then(response => {
              this.loading = false
              this.disabled = false
              authUser.email = response.data.email
              authUser.id = response.data.id
              authUser.name = response.data.name
              window.localStorage.setItem('authUser', JSON.stringify(authUser))
              this.$store.dispatch('setuserobj', authUser)
              this.path = JSON.parse(window.localStorage.getItem('fromLink'));
              if(this.path == null){
                this.$router.push({ name : 'dashboard' })
              }else{
                this.$router.push({ path : this.path })
              }
            });
          }
        }).catch(response => {
          this.loading = false
          this.disabled = false
          this.error = response.response.data.message;
        });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  label{
    font-size: 15px;
    color: #ccc;
  }
  .pd-10{
    padding: 10px;
  }
</style>
