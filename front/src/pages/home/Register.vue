<template>
  <div>
    <div class="container">
      <pre>{{ userStore.code }}</pre>
      <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 offset-md-3">
          <div class="card fat">
            <div class="card-body">
              <h4 class="card-title">Register</h4>
              <form method="POST" @submit.prevent="register">

                <div class="form-group">
                  <label for="Name">Full Name</label>
                  <input id="fullname" v-model="user.name" placeholder="Full name" type="text" class="form-control" required="" name="name" autofocus="">
                </div>

                <div class="form-group">
                  <label for="email">E-Mail Address</label>

                  <input id="email" type="email" v-model="user.email"m placeholder="Email" class="form-control" required="" name="email" autofocus="">
                </div>

                <div class="form-group">
                  <label for="password">Password </label>
                  <div style="position:relative">
                    <label class="text-danger" v-show="status">{{ status }}</label>
                    <input id="password"  v-model="user.password" @keyup="checkpassword" placeholder="Password" type="password" class="form-control" name="password" required="" style="padding-right: 60px;">
                    <label class="text-danger" v-show="passlength">{{ passlength }}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Retype Password</label>
                  <div style="position:relative">
                    <label class="text-danger" v-show="status">{{ status }}</label>
                    <input id="rpassword" type="password" placeholder="Retype Password" v-model="user.rpassword" @keyup="checkpassword" class="form-control" name="rpassword" required="" style="padding-right: 60px;">
                  </div>
                </div>
                <div class="form-group no-margin text-danger text-center" v-show='error' v-for="err in error">
                  {{ err[0] }}
                </div>
                <div class="form-group no-margin text-success text-center" v-show='success'>
                  {{ success }} <router-link :to="'/login'">login here</router-link>
                </div>
                <div v-show="loading" class="text-danger text-center pd-10">
                  <img src="../../assets/loader.gif" alt="" height="60">
                </div>
                <div class="form-group no-margin">
                  <button type="submit" class="btn btn-primary btn-block" :disabled="disabled">
                    Register
                  </button>
                </div>
                <div class="margin-top20 text-center">
                  Already have an account? <router-link v-bind:to="'/login'"> Login Here</router-link>
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
import { mapState } from 'vuex'
import { registerUrl } from '../../config'
export default {
  name: 'Login',
  data () {
    return {
      user: {
        name: '',
        email: '',
        password: '',
        rpassword: ''
      },
      status: '',
      passlength: '',
      error: '',
      success: '',
      loading: '',
      disabled: false
    }
  },
  computed: {
    ...mapState({
      userStore: state => state.userStore
    })
  },
  methods: {
    checkpassword : function () {
      if(this.user.password.length < 6){
        this.passlength = "Must be six charecter";
      }else{
        this.passlength = ''
        if(this.user.rpassword.length >= 6){
          if(this.password != this.rpassword){
            this.status = 'Password not matched'
          }else{
            this.status = '';
          }
        }
      }
    },
    register: function(){
      this.error = '';
      this.loading = true
      this.disabled = true
      if(this.status == ''){
        axios.post(registerUrl, this.user)
          .then(response => {
            if(response.data.success){
              this.$router.push({ path: `/activate/${this.user.email}` });
            }else{
              this.error = response.data.message;
            }
          })
          .catch(err=>{
            this.loading = false
            this.disabled = false
            this.error = err.response.data.errors;
          });
      }
    }
  },
  created(){
    const userObj = JSON.parse(window.localStorage.getItem('authUser'))
    if(userObj != null){
     this.$router.push({ path: '/dashboard' })
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
</style>
