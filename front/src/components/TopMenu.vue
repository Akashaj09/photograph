<style scoped>
	.nav-item:hover{
		list-style: none;
		color: #f6f6f6;
		text-decoration: none;
	}
	.nav-item{
		list-style: none;
		color: #f6f6f6;
		text-decoration: none;
	}
</style>
<template>
	<div>
		<b-navbar toggleable="md" type="dark" variant="dark">

			<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

			<b-navbar-brand href="#"><b-link v-bind:to="'/'" class="nav-item">Home</b-link></b-navbar-brand>

			<b-collapse is-nav id="nav_collapse">

				<b-navbar-nav  v-show="userStore.authUser">
					<b-nav-item href="#" v-if="$route.name == 'dashboard'"><b-link v-bind:to="'/addphotos'" class="nav-item">Publish photo</b-link></b-nav-item>
					<b-nav-item href="#" v-else><b-link v-bind:to="'/dashboard'" class="nav-item">Dashboard</b-link></b-nav-item>
				</b-navbar-nav>

				<!-- Right aligned nav items -->
				<b-navbar-nav class="ml-auto">
					<b-nav-item href="#"><b-link v-bind:to="'/login'" class="nav-item" v-show="userStore.authUser == null">Login</b-link></b-nav-item>
					<b-nav-item-dropdown right v-if="userStore.authUser">
						<!-- Using button-content slot -->
						<template slot="button-content">
							<em>{{ userStore.authUser.name }}</em>
						</template>
						<b-dropdown-item href="#" @click="logout">Signout</b-dropdown-item>
					</b-nav-item-dropdown>
				</b-navbar-nav>

			</b-collapse>
		</b-navbar>
		<br>
	</div>
</template>

<script>
	import { mapState } from 'vuex'
	export default{
		name: "TopMenu",
		data(){
			return {

			}
		},
		computed: {
			...mapState({
				userStore: state => state.userStore
			})
		},
		methods: {
			logout: function(){
				window.localStorage.removeItem('authUser')
				this.$store.dispatch('clearAuth')
				this.$router.push({ path: '/' })
			}
		},
		created(){

		}
	}
</script>