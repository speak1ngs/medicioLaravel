<div>
<x-header/>
	<x-body-wrapper>
	<x-navigation-menu-list />
		
<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">
		<h3 class="mb-0 text-center">Asignar horarios</h3>
		<hr>

		<div class="row">
			<div class="col-md-4">
			<label for="inputCedula">Cedula</label>
				<input type="text" class="form-control" id="inputCedula" placeholder="Cedula del medico" wire:model="inputCedula">
			</div>
			<div class="col-md-4">
		
			<label for="inputEspecialidades">Especialidades</label>
					<select id="inputEspecialidades" class="form-control" wire:model="inputEspecialidades">
												<option selected value="">Seleccionar Especialidad</option>
											@if(count($especialidades) >= 1)
													@foreach($especialidades as $especial )
														<option value="{{ $especial->descripcion}}">{{$especial->descripcion}}</option>
												@endforeach
											@else
											<option>No hay Especialidades</option>
											@endif
											</select>
			</div>
			<div class="col-md-4">
				<label for="">Mostrar</label>
						<select id="inputCant" class="form-control" wire:model="can">
								
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
						</select>
			</div>
		</div>
	</div>

	<div class="py-5">
		<div class="container well">
			<div class="row g-2 hidden-md-up ">
				@if(count($do) >=1)
					@foreach($do as $doctor)	
						<div class="col-sm-3 well bg-white">
							<div class="card card-block">
								<img class="card-img-top img-responsive img-thumbnail" alt="100%x180" src="{{  mix('./public/storage/'. $doctor->foto_url) }}" data-holder-rendered="true"
									style="height: 180px; width: 100%; display: block;">
								<div class="card-block">
									<h6 class="text-resp" > {{ 'Dr. ' .  $doctor->nombre . ' ' . $doctor->apellido}}</h6>


									<!-- <p class="card-text"> <strong> Especialidades:</strong> {{ $doctor->especialidades }}</p> -->
							
								</div>
								<div class="card-block">
								<a href="#" class="btn btn-primary btn-sm form-control" 	data-title="Asignar" data-toggle="modal" data-target="#Asignar"
							data-dismiss="modal" wire:click="asig({{ $doctor->cedula }})">Asignar Horario</a>
								</div>
							</div>
						</div>
					@endforeach
			
				
				@else
					<label for="">No hay registro a mostrar</label>
				@endif

				
			</div>
			@if($do->hasPages())
					
				<div class="divpag">
				{{ $do->links()}}

				</div>
				
				
	@endif	
		</div>

	</div>
	
	
	<div class="container"  >
		<div class="modal fade" id="Asignar" tabindex="-1" role="dialog" aria-labelledby="Asignar" aria-hidden="true" >
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-scroll">
			
					@if($nom)
					<div class="modal-header">
						
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign" ><span
						class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h6 class="modal-title custom_align text-center" id="Heading">{{ 'Dr. ' . $nom }}</h6>
					</div>
					
					<div class="modal-body">
						<label class="text-left">Asignar meses:</label>
							<div class="frb-group">
								<div class="row center-block">
									@foreach($arryMonth as $arr)
									@if($arr['id'] >= date('n'))
									<div class="col-md-4">
										<div class="frb frb-success">
											<input type="checkbox" id="checkbox-{{ $arr['id']}}1" name="checkbox-{{ $arr['id']}}1"  wire:model.defer="inputMes" value="{{ $arr['month']}}">
											<label for="checkbox-{{ $arr['id']}}1">
									
												<span class="frb-description">{{ $arr['month']}}</span>
											</label>
										</div>

									</div>
									@endif
									@endforeach
								</div>
							</div>


						
						<label class="text-left">Dias de la semana:</label>
						<div class="frb-group">
							<div class="row center-block">
								@foreach($arryDay as $arr)
								<div class="col-md-4">
									<div class="frb frb-success">
										<input type="checkbox" id="checkbox-{{ $arr['id']}}" name="checkbox-{{ $arr['id']}}"  wire:model.defer="inputDias" value="{{ $arr['day']}}">
										<label for="checkbox-{{ $arr['id']}}">
								
											<span class="frb-description">{{ $arr['day']}}</span>
										</label>
									</div>

								</div>
								@endforeach
							</div>
						</div>
						<label>Horario de atención</label>
						<p class="text-left bottom-p">Horario de inicio:</p>
						<input type="time" class="form-control" wire:model.defer="inputTimeStart">
						<p class="text-left bottom-p">Horario de fin:</p>
						<input type="time" class="form-control" wire:model.defer="inputTimeEnd">
				
						<p class="text-left bottom-p">Importe consulta:</p>
						<input type="text" class="form-control" wire:model.defer="inputImporte">
						<label for="inputESp">Consultorios</label>
							<select id="inputESp" class="form-control" wire:model.defer="inputConsultorios">
														<option selected>Seleccionar Consultorio</option>
													
													@if(count($consultorios) >= 1)
															@foreach($consultorios as $consul )
																<option value="{{ $consul->id}}">{{$consul->nombre}}</option>
														@endforeach
													@else
													<option>No hay Consultorios</option>
													@endif
							</select>
					<label for="inputEspecialidad">Especialidades</label>
					<select id="inputEspecialidad" class="form-control" wire:model.defer="inputEspecialidad">
												<option selected value="">Seleccionar Especialidad</option>
											@if(count($espeAsig) >= 1)
													@foreach($espeAsig as $especial )
														<option value="{{ $especial->id}}">{{$especial->descripcion}}</option>
												@endforeach
											@else
											<option>No hay Especialidades</option>
											@endif
											</select>
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
							data-title="asigTime" data-toggle="modal" data-target="{{ $control }}"
							data-dismiss="modal" wire:click="asignCalendar()"><span class="glyphicon glyphicon-ok-sign"></span>Asignar</button>
					</div>
					@else
					<label for="">Error al asignar horarios</label>
					@endif
				</div>
			
			</div>
		
		</div>
	</div>




	</section>
	
	</x-body-wrapper>
	<x-footer />
</div>

