<div>
<a  data-title="confirmModal"
											data-toggle="modal" data-target="#confirmModal" data-dismiss="modal" class="flotante-turn hid" target="_blank">
				<i class="fa fa-calendar my-flotante-turn"></i>
			</a>

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="top-area">
		<!-- <div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<p class="bold text-left">Monday - Saturday, 8am to 10pm </p>
				</div>
				<div class="col-sm-6 col-md-6">
					<p class="bold text-right">Call us now +62 008 65 001</p>
				</div>
				<di>
				<center><a href="https://websmultimedia.com/contador-de-visitas-gratis">
						<img style="border: 0px solid; display: inline;" alt="contador de visitas"
							src="https://websmultimedia.com/contador-de-visitas.php?id=9505"></a>
				</center>
			</div>
		</div> -->
	</div>
	<div class="container navigation">
		<div class="row">

			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand" href="/">
					<img src="{{ mix('img/logo.png')}}" alt="" width="150" height="40" />
				</a>
			</div>


			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#intro">Inicio</a></li>
					<!-- <li><a href="registro.php">Registro</a></li> -->
					<li><a href="{{ env('APP_URL') . '/#boxes'}}">Servicios</a></li>
					<li><a href="{{ env('APP_URL') . '/#service'}}" >Objetivos</a></li>
					<li><a href="{{ env('APP_URL') . '/#doctor' }}" >Profesionales</a></li>
					<li><a href="{{ env('APP_URL') . '/#blog'   }}" >Blog</a></li>
					<!-- <li><a href="#facilities">Facilities</a></li>
					<li><a href="#pricing">Pricing</a></li> -->
					<!--<li class="dropdown">
						 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
					class="badge custom-badge red pull-right">Extra</span>More <b class="caret"></b></a>
					<ul class="dropdown-menu"> 
						<li><a href="/inicio">Home CTA</a></li>
						<li><a href="index-form.html">Home Form</a></li>
						<li><a href="index-video.html">Home video</a></li>
					</ul>
					</li> -->
					<!-- <li class="hid">
					
						 <div class="navbar-right hid" style="margin-top: 10px">
							<p class="text-right">
									<a href="./login.php" class="btn btn-skin btn-xs" >Reservar <i
								class="fa fa-angle-right"></i></a>
							</p>
						</div> 
					</li> -->
					<div class="navbar-right hid" style="margin-top: 10px">
							<p class="text-right">
									<a class="btn btn-skin btn-xs"  data-title="confirmModal"
											data-toggle="modal" data-target="#confirmModal" data-dismiss="modal">Reservar Turno <i
								class="fa fa-angle-right"></i></a>
							</p>
						</div> 
				</ul>
			</div>

		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>

    <div class="container">
		<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal"
			aria-hidden="true" >
			<div class="modal-dialog " role="document">

				<div class="modal-content ">
				
						<div class="alert alert-warning modal-title">
								<button type="button" class="close " data-dismiss="modal" aria-hidden="true" ><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						
							
									<span>Desea acceder como?</span>
							
                     
							
							
							<div class="mt-5">
								<a class="btn btn-primary btn-lg" wire:click="logGuest()" data-dismiss="modal">INVITADO</a>	
								<a class="btn btn-success btn-lg" wire:click="logUser()" data-dismiss="modal"
								>USUARIOS</a>
										
							</div>
					</div>
				
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>
</div>
