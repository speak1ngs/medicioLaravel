<div>
	<x-header/>
	<x-body-wrapper>
		<x-navigation-menu />
		<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">
		<h4 class="text-center">Alta Turno Admin </h4>
		<hr>
		<div class="table-responsive">

			<table id="example" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Paciente</th>
						<th>Reserva</th>
						<th>Horario</th>
						<th>Estado</th>
						<th>Cancelar turno</th>
						<th>Activar Turno</th>
					</tr>
				</thead>

			
				
				<tbody>
				@if(!empty($db))
					@foreach($db as $data)
					<tr>
						<td>{{$data->nombres}}</td>
						<td  data-title="detailDate" data-toggle="modal"
											data-target="#detailDate" wire:click.prevent="sendData('{{ json_encode($data, true)}}')" wire:ignore.self><a >{{$data->dias_laborales}}</a></td>
						<td >{{$data->horarios}}</td>
						<td>{{$data->descripcion}}</td>
						<td>
							<div class="row">
								<div class="form-group col-sm-6 bottom-p text-center">
									<p data-placement="top" data-toggle="tooltip" title="Cancelar" class="bottom-p">
										<button class="btn btn-danger btn-xs" data-title="reservaActive"
											data-toggle="modal" data-target="{{ $alert }}"><span
												class="fa fa-remove" wire:click.prevent="cancelCita({{ $data->id }}, {{ $data->idCalenDet}})" ></span></button>
									</p>
								</div>

							</div>

						</td>
						<td>
							<div class="row">

								<div class="form-group col-sm-6 bottom-p text-center">
									<p data-placement="top" data-toggle="tooltip" title="Activar" class="bottom-p">
										<button class="btn btn-success btn-xs" data-title="asgiOp" data-toggle="modal"
											data-target="#asgiOp" wire:click="sendData('{{ json_encode($data, true)}}')" wire:ignore.self><span class="fa fa-check-square-o"></span></button>
									</p>

								</div>
							</div>
						</td>
					</tr>
					@endforeach
				@else
					<tr>
						<td>
							<label for="">No hay datos para mostrar</label>
						</td>
					</tr>
				@endif
					
				</tbody>
				
			</table>
		</div>
		<div class="container">
			<div class="modal fade" id="detailDate" tabindex="-1" role="dialog" aria-labelledby="detailDate" aria-hidden="true">
				<div class="modal-dialog modal-content-scroll" role="document">
					<div class="modal-content">
						@if(!empty($datTemp))
						
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign()">
								<span class="glyphicon glyphicon-remove" aria-hidden="true" ></span>
							</button>
							<h4 class="modal-title custom_align" id="Heading">Detalle del Turno</h4>
						</div>
						<div class="modal-body">

							<h6 class="modal-title custom_align" id="Heading">Informacion del Paciente:</h6>
						<div class="row">
									
									<div class="form-group">
									<div class="col-md-12">
										<p class="text-center bottom-p">Paciente: <strong> {{ $datTemp[0]['nombres']}} </strong></p>
										<p class="text-center bottom-p">Telf: <strong> {{ $datTemp[0]['telefono_paciente']}} </strong></p>

									</div>
									</div>
									<h6 class="modal-title custom_align" id="Heading">Informacion del Doctor:</h6>

									<div class="form-group">
									<div class="col-md-12">
										<p class="text-center bottom-p">Doctor: <strong> {{ $datTemp[0]['doctor']}} </strong></p>
										<p class="text-center bottom-p">Telf: <strong> {{ $datTemp[0]['telefono_doctor']}} </strong></p>
									</div>
									<h6 class="modal-title custom_align" id="Heading">Informacion del consultorio:</h6>

									<div class="form-group">
									<div class="col-md-12">
										<p class="text-center bottom-p">Doctor: <strong> {{ $datTemp[0]['consul_nomb']}} </strong></p>
										<p class="text-center bottom-p">Telf: <strong> {{ $datTemp[0]['consult_telf']}} </strong></p>
										<p class="text-center bottom-p">Ciudad: <strong> {{ $datTemp[0]['ciudad']}} </strong></p>
										<p class="text-center bottom-p">Ubicacion: <strong> Agregar link de la Ubicacion </strong></p>

									</div>


									</div>


									
							
								
							</div>
						
						</div>
				
						@else
							<div>
								<label for=""> No hay datos para mostrar</label>
							</div>
						@endif

					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</div>




		<div class="container">
			<div class="modal fade" id="asgiOp" tabindex="-1" role="dialog" aria-labelledby="asgiOp" aria-hidden="true">
				<div class="modal-dialog modal-content-scroll" role="document">
					<div class="modal-content">
						@if(!empty($datTemp))

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign()">
								<span class="glyphicon glyphicon-remove" aria-hidden="true" ></span>
							</button>
							<h4 class="modal-title custom_align" id="Heading">Asociar Operacion</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<p class="text-center">Paciente: <strong> {{ $datTemp[0]['nombres']}} </strong></p>
									</div>

									<div class="col-md-12">
										<label for="opNumber" class="text-left">Introduzca Nro de transaccion:</label>
										<input type="text" class="form-control" id="opNumber" wire:model.defer="inputOpNumber"
											placeholder="Op. 1239182731">
									</div>

									<div class="col-md-12">
										<label for="inputState">Medio de pago</label>
										
										<select id="inputState" class="form-control" wire:model.defer="inputTypeMethod">
											@if(!empty($paymentMethod))						
											<option selected value="">Seleccionar metodo</option>
											@foreach($paymentMethod as $pay)
											<option value="{{ $pay->id }}">{{ $pay->descripcion }}</option>
											@endforeach
											@else
												<option value="">no hay datos para mostrar</option>
											
											@endif
										</select>
									
									</div>
								</div>
							</div>

						</div>
						<div class="modal-footer ">
							<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
								class="glyphicon glyphicon-ok-sign" data-title="reservaActive" data-toggle="modal"
								data-dismiss="modal" data-target="{{ $alert }}" wire:click.prevent="activeDate()" ><span></span>Activar</button>
						</div>
						@else
							<div>
								<label for=""> No hay datos para mostrar</label>
							</div>
						@endif

					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</div>


		<!-- se guardo el review -->

		<div class="container">
			<div class="modal fade" id="reservaActive" tabindex="-1" role="dialog" aria-labelledby="reservaActive"
				aria-hidden="true">
				<div class="modal-dialog modal-confirm" role="document">
					<div class="modal-content ">
						<div class="modal-header">
							<div class="icon-box">
								<i class="material-icons">&#xE876;</i>
							</div>
							<h4 class="modal-title w-100">{{ $detail }}!</h4>
						</div>

						<div class="modal-footer">
							<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</div>

		<!-- comentario fallido  -->

		<div class="container">
			<div class="modal fade" id="failAlt" tabindex="-1" role="dialog" aria-labelledby="failAlt"
				aria-hidden="true">
				<div class="modal-dialog modal-confirm-red" role="document">
					<div class="modal-content ">
						<div class="modal-header">
							<div class="icon-box-red">
								<span class="material-symbols-outline">
									disabled_by_default
								</span>
							</div>
							<h4 class="modal-title w-100">Error!</h4>
						</div>
						<div class="modal-body">
							<p class="text-center">Intente nuevamente</p>
						</div>
						<div class="modal-footer">
							<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</div>
	</div>

</section>
	</x-body-wrapper>
	<x-footer/>

</div>