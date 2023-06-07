<div>

<x-header/>
	<x-body-wrapper>
		<x-navigation-menu/>
        <section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">
		<h3 class="mb-0 text-center">Crear horarios</h3>
		<hr>

		<div class="row">
			<div class="col-md-4">
			<label for="inputCedula">Cedula</label>
				<input type="text" class="form-control" id="inputCedula" placeholder="Cedula del medico" wire:model="inputCedula">
			</div>
			<div class="col-md-4">
		
			<label for="inputStat">Especialidades</label>
					<select id="inputStat" class="form-control" wire:model="inputEspecialidades">
												<option selected value="">Seleccionar Especialidad</option>
										
											</select>
			</div>
			<div class="col-md-4">
				<label for="">Mostrar</label>
						<select id="inputCant" class="form-control" wire:model="inputCan">
								
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
			<div class="row g-2 hidden-md-up "  wire:ignore.self>
            @if(count($do) >=1)
					
                    <div class="row " >
		

						<div class="col-md-12">
							<h4 class="text-center">Calendario del Profesional</h4>
							<div class="table-responsive">

								<table id="mytable" class="table table-bordred table-striped">

									<thead>
										<th>Profesional</th>
										<th>Especialidad</th>
										<th>Consultorio</th>
										<th>Dias</th>
										<th>Horario</th>
										<th>Opciones</th>
									</thead>
									<tbody>
													
									@if(!empty($do))
				
							
										
									@foreach($do as $detail)
                                                <tr>

                                                    <td>{{ 'Dr. ' .  $detail->nombre . ' ' . $detail->apellido }} </td>
                                                    <td>{{  $detail->descripcion }} </td>
                                                    <td>{{  $detail->consultorio }} </td>
                                                    <td>{{  $detail->dias }} </td>
                                                    <td>{{ 'De: ' . $detail->horario_inicio . ' a ' . $detail->horario_fin }} </td>
                                                    <td>
                                                        <p data-placement="top" data-toggle="tooltip" title="Generar Horas"><button
                                                                class="btn btn-primary btn-xs" data-title="Generar Horas" data-toggle="modal"
                                                                data-target="#Asignar" wire:click="arrReceive('{{ json_encode( $detail, true) }}' )"><span class="fa fa-calendar"></span></button>
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforeach

                                    @else
							
									<tr>
									<td><label for="">No hay datos a mostrar</label></td>
									</tr>
									@endif
									</tbody>	

								</table>

					
							</div>

						</div>
					</div>
	
				

					@if($do->hasPages())
						<div class="divpag">
							{{ $do->link()}}
						</div>
			@endif
				@else
					<label for="">No hay registro a mostrar</label>
				@endif
			</div>
		</div>
	</div>

    <div class="container"  >
		<div class="modal fade" id="Asignar" tabindex="-1" role="dialog" aria-labelledby="Generar Horas" aria-hidden="true"  wire:ignore.self >
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-scroll">
               
					
					@if($datTrans)
					<div class="modal-header">
						
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign" ><span
						class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align text-center" id="Heading">{{ 'Dr. ' .  $datTrans[0]["nombre"] }}</h4>
					</div>
					
					<div class="modal-body">
						<label class="text-left">Meses disponibles:</label>
							<div class="frb-group">
								<div class="row center-block">
									@foreach($meses as $arr)
									<div class="col-md-4">
										<div class="frb frb-success">
											<input type="checkbox" id="checkbox-{{ $arr}}1" name="checkbox-{{ $arr}}1"  wire:model.defer="inputMes" value="{{ $arr }}">
											<label for="checkbox-{{ $arr}}1">
									
												<span class="frb-description">{{ $arr}}</span>
											</label>
										</div>

									</div>
									@endforeach
								</div>
							</div>


						
						<label class="text-left">Dias laborales disponibles:</label>
						<div class="frb-group">
							<div class="row center-block">
								@foreach($dias as $arr)
								<div class="col-md-4">
									<div class="frb frb-success">
										<input type="checkbox" id="checkbox-{{ $arr}}" name="checkbox-{{ $arr}}"  wire:model.defer="inputDias" value="{{ $arr}}" >
										<label for="checkbox-{{ $arr}}">
								
											<span class="frb-description">{{ $arr}}</span>
										</label>
									</div>

								</div>
								@endforeach
							</div>
						</div>

						
					<div class="modal-footer ">
						<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
							data-title="asigTime" data-toggle="modal" data-target=""
							data-dismiss="modal" wire:click="genDay()"><span class="glyphicon glyphicon-ok-sign"></span>Generar Turnos</button>
					</div>
					@else
					<label for="">Error al asignar horarios</label>
					@endif
				</div>
			
			</div>
		
		</div>
	</div>
	
	<div class="frb-group" @if( $open_day === true )
											style="display: true;"
											@else
											style="display: none;"
											@endif>
											<label for="">Dias disponibles:</label>
											<div class="row">
											@if(!empty($diasDisp))
															@foreach($diasDisp as $da)
												<div class="col-md-4">
													<div class="frb frb-success">	
													
															<input type="radio" id="radio-button-{{ $da['horarios']}}" name="radio-button{{$da['horarios']}}" value="{{ $da['horarios']}}" wire:model.defer="inputDayse" 
															wire:click="calcHoras">
															<span class="frb-description">{{ $da['dias_laborales']}}</span>

															<label for="radio-button-{{ $da['horarios']}}">
																	<span class="frb-description">{{ $da['horarios']}}</span>
																</label>
													</div>
												</div>
												
												@endforeach
											@else
												@foreach($inputDias as $dias)
													<label for="">{{ $dias }}</label>
												@endforeach
											@endif
													

											</div>
										</div>
				
						
					</div>



	</section>
	
	</x-body-wrapper>
	<x-footer />



</div>
