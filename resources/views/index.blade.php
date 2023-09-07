<x-header />
			<div>
			<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

			<!-- BOTONES FLOTANTES -->
			<a href="https://api.whatsapp.com/send?phone={{env('PHONE')}}&text=Hola provengo del sitio web necesito ayuda."
				class="flotante" target="_blank">
				<i class="fa fa-whatsapp my-flotante"></i>
			</a>

			<!-- <a href="#" class="flotante-turn hid" target="_blank">
				<i class="fa fa-calendar my-flotante-turn"></i>
			</a> -->

			<div id="wrapper">
				<livewire:navbar />
				<x-intro-empresa />
				<x-servicio-pasos />
				<x-servicios />
					<livewire:show-doctors/>
					<livewire:showposts />
					@livewireScripts
				<x-partners />
				<!-- nav-bar
				<?php
					//  include('./nav-bar.php');
					//  Section: intro breve resenha de la empresa
					// include('./intro-empresa.php');
			
					//  Section: proceso de acceder a un servicios pasos
					//  include('./servicio-pasos.php');
					//  /Section: atencion o pongase en contacto
			
					//  Section: services
					// include('./servicios.php');
					//  Section: doctors
					// include('./doctores.php');
					// section: blog

					// include('./blog.php');
			
					//  Section: especialidades
			
					//  Section: testimonial
			
					//  Section: pricing
			
					//  Section: partners
					// include('./partners.php');
					
					// footer 
				?> -->
			</div>

			<script>

			let modifHomeZ = document.getElementsByClassName("home-section");

			jq(document).ready(function(){
			$("#blogRead").on('show.bs.modal', function() {
				modifHomeZ.partner.style.zIndex = "0";
				
			});


			$("#blogRead").on('hide.bs.modal', function() {
				modifHomeZ.partner.style.zIndex = "120";
				
			});


			});

			</script>


			</body>
			</div>

		

		
<x-footer />