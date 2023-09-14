<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="top-area">
		<div class="container">
			<div class="row">

			</div>
		</div>
	</div>
	<div class="container navigation">
		<div class="navbar-header page-scroll">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="/inicio">
				<img src="{{ mix('img/logo.png')}}" alt="" width="150" height="40" />
			</a>

		</div>
		<!-- 
				<div class="navbar-right hid" style="margin-top: 10px">
					<p class="text-right">
						<a href="#" class="btn btn-skin btn-lg"
							>Reservar Turno <i class="fa fa-angle-right"></i
						></a>
					</p>
				</div> -->

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right navbar-main-collapse ">
			<ul class="nav navbar-nav hid-burguer">
			@role('Invitado')
				<li><a >Usuario:Invitado</a></li>
				@endrole
				@role('Admin')
				<li><a href="/admfunc/registro-doctor">Registrar Doctor</a></li>
				<li><a href="/admfunc/crear-consult">Registrar Consultorio</a></li>
				<li><a href="/admfunc/alta-doctor">Alta Doctor</a></li>
				<li><a href="/admfunc/alta-consult">Alta Consultorio</a></li>
				<li><a href="/admfunc/calendario-doctor">Asignar horarios</a></li>
				<li><a href="/admfunc/edit-imp-doctor">Modificar Importe Doctor</a></li>
				<!-- <li><a href="/admfunc/edit-importe">Cargar monto de consulta</a></li> -->
				<li><a href="/admfunc/reservar-adm">Reservar Turno Admin</a></li>
				<li><a href="/admfunc/alta-reser-adm">Alta Turno Reservados Admin</a></li>
				<li><a href="/admfunc/crear-horarios">Crear horarios</a></li>
				<li><a href="/admfunc/create-rol">Crear roles</a></li>
				<li><a href="/admfunc/asig-permission">Asignar roles</a></li>

				@endrole
				
				@role('Paciente')
				
				<li><a href="/paciente/profile">Perfil</a></li>
				<li><a href="/paciente/turnos-reservados">Turnos reservados</a></li>
				<li><a href="/paciente/reservar">Reservar Turno</a></li>

				@endrole
				
				@role('Admin|Blogger')
				<li><a href="/post/crear">Crear post</a></li>
				<li><a href="/post/alta">Dar de alta post</a></li>
				@endrole
				@role('Admin|Blogger|Doctor|Paciente')
				<li><a href="/cambiar-pass">Cambiar Contraseña</a></li>
				@endrole
				<!-- <li><a href="/cambiar-correo">Cambiar Correo</a></li> -->
				@role('Doctor')
				<li><a href="/doctor/agenda">Citas programadas</a></li>
				@endrole
				<!-- <li><a href="/consultorio/agenda">Citas programadas consultorio</a></li>
				<li><a href="/admfunc/historial-cita">Historial de citas</a></li> -->
				<li>  <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Cerrar Sesión') }}
                                </x-dropdown-link>
                            </form>
						</li>
			</ul>



			<ul class="nav navbar-nav hid-dropdown">

				<li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <b class="caret"></b></a>
					<ul class="dropdown-menu">
					@role('Invitado')
				<li><a >Usuario:Invitado</a></li>
				@endrole
					@role('Admin')
					<li><a href="/admfunc/registro-doctor">Registrar Doctor</a></li>
					<li><a href="/admfunc/crear-consult">Registrar Consultorio</a></li>
					<li><a href="/admfunc/alta-doctor">Alta Doctor</a></li>
					<li><a href="/admfunc/alta-consult">Alta Consultorio</a></li>
					<li><a href="/admfunc/calendario-doctor">Asignar horarios</a></li>
					<li><a href="/admfunc/edit-imp-doctor">Modificar Importe Doctor</a></li>
					<!-- <li><a href="/admfunc/edit-importe">Cargar monto de consulta</a></li> -->
					<li><a href="/admfunc/reservar-adm">Reservar Turno Admin</a></li>
					<li><a href="/admfunc/alta-reser-adm">Alta Turno Reservados Admin</a></li>
					<li><a href="/admfunc/crear-horarios">Crear horarios</a></li>
					<li><a href="/admfunc/create-rol">Crear roles</a></li>
					<li><a href="/admfunc/asig-permission">Asignar roles</a></li>

					@endrole
					
					@role('Paciente')
					
					<li><a href="/paciente/profile">Perfil</a></li>
					<li><a href="/paciente/turnos-reservados">Turnos reservados</a></li>
					<li><a href="/paciente/reservar">Reservar Turno</a></li>

					@endrole
					
					@role('Admin|Blogger')
					<li><a href="/post/crear">Crear post</a></li>
					<li><a href="/post/alta">Dar de alta post</a></li>
					@endrole
					@role('Admin|Blogger|Doctor|Paciente')
				<li><a href="/cambiar-pass">Cambiar Contraseña</a></li>
				@endrole
					<!-- <li><a href="/cambiar-correo">Cambiar Correo</a></li> -->
					@role('Doctor')
					<li><a href="/doctor/agenda">Citas programadas</a></li>
					@endrole
					<!-- <li><a href="/consultorio/agenda">Citas programadas consultorio</a></li>
					<li><a href="/admfunc/historial-cita">Historial de citas</a></li> -->
						<li>  <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Cerrar Sesión') }}
                                </x-dropdown-link>
                            </form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>