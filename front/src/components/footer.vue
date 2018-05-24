<template>
	<div>
		<footer class="page-footer font-small stylish-color-dark pt-4 mt-4">
			<div class="container text-center text-md-left">

				 <!-- Footer links -->
				<div class="row text-center text-md-left mt-3 pb-3">

				      <!--First column-->
				     <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
				          <h6 class="text-uppercase mb-4 font-weight-bold">Photgrapher haven</h6>
				          <p>Sahre photo and invite your friends to download it.</p>
				      </div>
				      <!--/.First column-->

				      <hr class="w-100 clearfix d-md-none">

				      <!--Second column-->
				      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
				          <h6 class="text-uppercase mb-4 font-weight-bold">Category</h6>
				          <p><a><b-link v-bind:to="'/dashboard'" class="nav-item">Dashboard</b-link></a></p>
				          <p><a><b-link v-bind:to="'/addphotos'" class="nav-item">Publish photo</b-link></a></p>
				      </div>
				      <!--/.Second column-->

				      <hr class="w-100 clearfix d-md-none">

				      <!--Third column-->
				      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
				          <h6 class="text-uppercase mb-4 font-weight-bold">Top Chart</h6>
				          <!-- <p><a href="#!">Your Account</a></p>
				          <p><a href="#!">Become an Affiliate</a></p>
				          <p><a href="#!">Shipping Rates</a></p>
				          <p><a href="#!">Help</a></p> -->
				      </div>
				      <!--/.Third column-->

				      <hr class="w-100 clearfix d-md-none">

				      <!--Fourth column-->
				      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
				          <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
				          <p><i class="fa fa-home mr-3"></i> Feni, Chittagong, Bangladesh</p>
				          <p><i class="fa fa-envelope mr-3"></i> akashajaj09@gmail.com</p>
				          <p><i class="fa fa-phone mr-3"></i> +880 1783508995</p>
				          <p><i class="fa fa-print mr-3"></i> +880 1620216043</p>
				      </div>
				      <!--/.Fourth column-->

				  </div>
				  <!-- Footer links -->

				  <hr>

				  <div class="row py-3 d-flex align-items-center">

				      <!--Grid column-->
				      <div class="col-md-8 col-lg-8">

				          <!--Copyright-->
				          <p class="text-center text-md-left grey-text">© 2018 Copyright: <a target="_blank" href="https://www.facebook.com/shajal.raihan.73"><strong> Parvej Ahammad</strong></a></p>
				          <!--/.Copyright-->

				      </div>
				      <!--Grid column-->

				      <!--Grid column-->
				      <div class="col-md-4 col-lg-4 ml-lg-0">

				          <!--Social buttons-->
				          <div class="text-center text-md-right">
				              <ul class="list-unstyled list-inline">
			                  <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fa fa-facebook"></i></a></li>
			                  <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fa fa-twitter"></i></a></li>
			                  <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fa fa-google-plus"></i></a></li>
			                  <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i class="fa fa-linkedin"></i></a></li>
				            </ul>
				        </div>
				    </div>
				</div>
			</div>
		</footer>
	</div>
</template>
<script>
	export default{
		name: 'Footer',
		data(){
			return{

			}
		}
	}
</script>
<style>
	.stylish-color-dark{
		background: #3e4551;
		color: #fff;
	}
</style>