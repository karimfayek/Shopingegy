


 
	
  
    <script>
      var headings = @json($heading);
 </script>
 
   
		<!-- Back Top button -->
		<div class="back-top button-show">
			<i class="arrow_carrot-up"></i>
		</div>

		<!-- Search -->
		
	
		<div id="quickview-container" >
            
        </div>




		<!-- Page Loader
		<div class="page-preloader">
	    	<div class="loader">
	    		<div></div>
	    		<div></div>
	    	</div>
	    </div> -->
		<script>
			var headings = @json($heading);
			var translations = @json($translations);
	   </script>
		<!-- Dependency Scripts 
		<script src="/js/popper.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/slick.min.js"></script>
		<script src="/js/jquery.mmenu.all.min.js"></script>
		 Site Scripts -->
		<script src="/js/jquery.min.js"></script>
		@stack('scripts')
		<script src="/js/main.js"></script>
		

