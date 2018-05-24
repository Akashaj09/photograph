<template>
  <div>
    <TopMenu></TopMenu>
    <div class="container">
      <router-view></router-view>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import TopMenu from './components/TopMenu.vue'
import Footer from './components/footer'

export default {
  name: 'app',
  components: {
    TopMenu,
    Footer
  },
  computed: {
    ...mapState({
      userStore: state => state.userStore
    })
  },
  created(){
    const userObj = JSON.parse(window.localStorage.getItem('authUser'))
    this.$store.dispatch('setuserobj', userObj)
  }
}
</script>

<style>
.responsive {
    width: 100%;
    max-width: 100%;
    height: auto;
}
.post img {
    pointer-events: none;
    width: 100%;
}

.post{
  width: 100%;
  height: auto;
  max-height: 240px;
  position: relative;
  cursor: pointer;
  overflow: hidden;
}
.post:hover .post-s{
  width: 100%;
}
.post img {
  display: block;
  height: auto;
}
.post-s{
  width: 0px;
  height: 100%;
  background: rgba(103, 58, 183, 0.71);
  position: absolute;
  top: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  transition: 0.4s ease;
}
.post-s p{
  color: white;
  font-size: 16px;
  border: 2px solid white;
  padding: 10px 10px;
}
.pd-10{
  padding: 10px;
}
.cl-wht{
  color: #fff;
}
</style>
