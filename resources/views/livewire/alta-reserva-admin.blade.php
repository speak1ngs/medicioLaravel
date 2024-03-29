<div>
	<x-header/>
	<x-body-wrapper>
	<x-navigation-menu-list />
		<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">
		<h4 class="text-center">Alta Turno Admin </h4>
		<hr>
		<div class="table-responsive" >
		<div class="form-group col-md-1 ">
								<label for="">Mostrar</label>
								<select id="inputState" class="form-control" wire:model="cant">
										
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="">Buscar por titulo </label>
								<input type="text" class="form-control" wire:model="search">
							</div>
							<div class="form-group col-md-4">
								<label for="">Buscar por Cédula </label>
								<input type="text" class="form-control" wire:model="searchCI">
							</div>


			<table id="mytable" class="table table-striped table-bordered" style="width:100%" wire:ignore>
				<thead>
					<tr>
						<th>Paciente</th>
						<th>Reserva</th>
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
						<td><a class="pointer"   wire:click.prevent="sendDataDetail('{{ json_encode($data, true)}}')" wire:ignore.self>Detalle Turno</a></td>
						<td>{{$data->descripcion}}</td>
						<td>
							<div class="row">
								<div class="form-group col-sm-6 bottom-p text-center">
									<p data-placement="top" data-toggle="tooltip" title="Cancelar" class="bottom-p">
										<button class="btn btn-danger btn-xs" 
											><span
												class="fa fa-remove" wire:click.prevent="dataSet({{ $data->id }}, {{ $data->idCalenDet}} , '{{ $data->nombres }}')" wire:ignore.self></span></button>
									</p>
								</div>

							</div>

						</td>
						<td>
							<div class="row">

								<div class="form-group col-sm-6 bottom-p text-center">
									<p data-placement="top" data-toggle="tooltip" title="Activar" class="bottom-p">
										<button class="btn btn-success btn-xs" data-title="asgiOp" data-toggle="modal"
											data-target="#asgiOp" wire:click.prevent="sendData('{{ json_encode($data, true)}}')" wire:ignore><span class="fa fa-check-square-o"></span></button>
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

							<h6 class="modal-title custom_align" id="Heading">Información del Paciente:</h6>
						<div class="row">
									
									<div class="form-group">
									<div class="col-md-12">
										<p class="text-center bottom-p">Paciente: <strong> {{ $datTemp[0]['nombres']}} </strong></p>
										<p class="text-center bottom-p">Telf: <strong> {{ $datTemp[0]['telefono_paciente']}} </strong></p>

									</div>
									</div>
									<h6 class="modal-title custom_align" id="Heading">Información del Doctor:</h6>

									<div class="form-group">
									<div class="col-md-12">
										<p class="text-center bottom-p">Doctor: <strong> {{ $datTemp[0]['doctor']}} </strong></p>
										<p class="text-center bottom-p">Telf: <strong> {{ $datTemp[0]['telefono_doctor']}} </strong></p>
									</div>
									<h6 class="modal-title custom_align" id="Heading">Información del consultorio:</h6>

									<div class="form-group">
									<div class="col-md-12">
										<p class="text-center bottom-p">Doctor: <strong> {{ $datTemp[0]['consul_nomb']}} </strong></p>
										<p class="text-center bottom-p">Telf: <strong> {{ $datTemp[0]['consult_telf']}} </strong></p>
										<p class="text-center bottom-p">Ciudad: <strong> {{ $datTemp[0]['ciudad']}} </strong></p>
										<p class="text-center bottom-p">Ubicación: <strong> <a href="{{ $datTemp[0]['ubi'] ? $datTemp[0]['ubi'] : '#'  }}">{{ $datTemp[0]['ubi'] ?  'Google Map' : 'No tiene Ubicación' }}</a> </strong></p>

									</div>
									<h6 class="modal-title custom_align" id="Heading">Detalle:</h6>
										<div class="form-group">
											<div class="col-md-12">
												<p class="text-center bottom-p">Fecha: <strong> {{ date('d-m-Y', strtotime($datTemp[0]['dias_laborales'])) }} </strong></p>
												<p class="text-center bottom-p">Horario: <strong> {{ $datTemp[0]['horarios']}} </strong></p>
											</div>


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
		<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal"
			aria-hidden="true" >
			<div class="modal-dialog " role="document">
				<div class="modal-content ">
				
									
						<div class="alert alert-warning modal-title">
						<button type="button" class="close " data-dismiss="modal" aria-hidden="true" wire:click="resetData()"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
								<br>
							<span>Desea cancelar la reserva de {{ $namPac }}?</span>
							
							<div class="mt-5">
								<button class="btn btn-danger btn-lg" data-dismiss="modal"  wire:click="resetData()">Cancelar</button>	
								<button class="btn btn-success btn-lg" wire:click.prevent="cancelCita()" data-dismiss="modal" data-title="reservaActive"
											data-toggle="modal" data-target="{{ $alert }}"
								>Confirmar</button>
										
							</div>
					</div>
				
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>


		<div class="container"  wire:ignore.self>
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
										<label for="inputMethodPay">Medio de pago</label>
										
										<select id="inputMethodPay" class="form-control" wire:model.defer="inputMethod">
										<option selected>Seleccionar metodo</option>
											
											@if(!empty($paymentMethod))						
											
												@foreach($paymentMethod as $pay)
												<option value="{{ $pay->id }}">{{ $pay->descripcion }}</option>
												@endforeach
											@else
												<option selected >no hay datos para mostrar</option>
											
											@endif
										</select>
									
									</div>
								</div>
							</div>

						</div>
						<div class="modal-footer ">
							<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
								class="glyphicon glyphicon-ok-sign" data-toggle="modal"
								data-dismiss="modal" wire:click.prevent="activeDate()" ><span></span>Activar</button>
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


	</div>

	<script>
	window.addEventListener('openblogRead', event => {
		$("#confirmModal").modal('show');
	})

	window.addEventListener('closeblogRead', event => {
		$("#confirmModal").modal('hide');
	})

	window.addEventListener('openDetail', event => {
		$("#detailDate").modal('show');
	})

	window.addEventListener('closeDetail', event => {
		$("#detailDate").modal('hide');
	})
</script>

</section>
	</x-body-wrapper>
	<x-footer/>

</div>