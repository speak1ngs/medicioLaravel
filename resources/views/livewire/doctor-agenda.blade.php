<div>
<x-header />
<x-body-wrapper >
	<x-navigation-menu />
	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">

				<div class="col-md-12">
					<h4 class="text-center">Citas programadas </h4>
					<div class="table-responsive">
							<div class="form-group col-md-1 ">
								<label for="">Mostrar</label>
								<select id="inputState" class="form-control" wire:model="cant">
										
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
								</select>
							</div>

						<table id="mytable" class="table table-bordred table-striped">

							<thead>
								<th>Pacientes</th>
								<th>Fecha</th>
								<th>Horario</th>
								<th>Consultorio</th>
								<th>Calificar Paciente</th>
								<th>Asistencia</th>
							</thead>
							<tbody>


								<tr>
									@if(!empty($db))
										@foreach($db as $data)
									<td>{{ $data->nombres }} </td>
									<td>{{ $data->dias_laborales}}</td>
									<td>{{ $data->horarios}}</td>
									<td>{{ $data->consul_nomb }}</td>
									<td>
										
										<span data-title="calf" data-toggle="modal" data-target="#calf"
									data-dismiss="modal" wire:click.prevent="instanData('{{ $data->id }}','{{ $data->nombres }}', '{{ $data->idpac }}')" wire:ignore.self>Calificar</span>
							

									</td>
									<td>
										<div class="row">
											<div class="col-sm-4 bottom-p">
												<p data-placement="top" data-toggle="tooltip" title="ausente" class="bottom-p">
													<button class="btn btn-danger btn-xs" data-title="confirmModal" data-toggle="modal" data-target="#confirmModal"
							data-dismiss="modal" wire:click.prevent="ausente('{{ $data->id }}','{{ $data->nombres }}')"><span
															class="fa fa-remove"></span></button>
												</p>
											</div>
											<div class="col-sm-4 bottom-p">
												<p data-placement="top" data-toggle="tooltip" title="presente" class="bottom-p">
													<button class="btn btn-success btn-xs"
													data-title="confirmModal" data-toggle="modal" data-target="#confirmModal"
							data-dismiss="modal" wire:click.prevent="presente('{{ $data->id }}','{{ $data->nombres }}')"
													><span
															class="fa fa-check-square-o"></span></button>
												</p>

											</div>
										</div>

									</td>
										@endforeach
									@else
										<td> No hay datos a mostrar</td>
									@endif
								</tr>



							</tbody>
						
						</table>
						@if($db->hasPages())
						<div class="divpag">
							{{ $db->link()}}
						</div>
						@endif
						

					</div>

				</div>
	</div>
	
	<!-- cuadro para dejar comentario -->
	<div class="container" >
		<div class="modal fade" id="calf" tabindex="-1" role="dialog" aria-labelledby="calf" aria-hidden="true" wire:ignore.self>
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-scroll">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Calificar al Paciente </h4>
						<h6> {{ $nom }}</h6>
					</div>
					<div class="modal-body">
							<div class="row">
								<h5 class="text-center">Deje un comentario:</h5>
								<div class="form-group">
									<textarea class="form-control col-sm-8" id="message-text" wire:model.defer="inputComent"></textarea>
								</div>
								<div class="form-group text-center">
								<h5 class="text-left bottom-p">Calificar:</h5>
									<div class="rate ">
										@foreach(range(5,1) as $id )
											<input type="radio" id="star{{$id}}" name="rate" value="{{$id}}"  wire:model.defer="inputRating"/>
											<label for="star{{$id}}" title="{{$id}}">{{$id}} stars</label>
										@endforeach
									
									</div>
									
								</div>

							</div>
				
							
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-warning btn-lg" style="width: 100%;" wire:click="calificar()"
							data-title="{{ $control }}" data-toggle="modal" data-target="#{{ $control }}"
							data-dismiss="modal"  ><span class="glyphicon glyphicon-ok-sign" ></span>Calificar</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>


	<!-- se guardo el review -->

	<div class="container">
		<div class="modal fade" id="successComent" tabindex="-1" role="dialog" aria-labelledby="successComent"
			aria-hidden="true"  wire:ignore.self>
			<div class="modal-dialog modal-confirm" role="document">
				<div class="modal-content ">
					<div class="modal-header">
						<div class="icon-box">
							<i class="material-icons">&#xE876;</i>
						</div>
						<h4 class="modal-title w-100">Profesional Calificado!</h4>
					</div>
					<div class="modal-body">
						<p class="text-center">Gracias por tu comentario !!</p>
					</div>
					@if (session()->has('message'))

					<div class="alert alert-success">

						{{ session('message') }}

					</div>

					@endif
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
		<div class="modal fade" id="failComment" tabindex="-1" role="dialog" aria-labelledby="failComment"
			aria-hidden="true" wire:ignore.self>
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
						@if (session()->has('message'))

							<div class="alert alert-success">

								{{ session('message') }}

							</div>

							@endif
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


	<div class="container">
		<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal"
			aria-hidden="true" >
			<div class="modal-dialog " role="document">
				<div class="modal-content ">
				
									
						<div class="alert alert-warning modal-title">
						<button type="button" class="close " data-dismiss="modal" aria-hidden="true"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
								<br>
							<span>El paciente estuvo {{ $statPaciente }}?</span>
							
							<div class="mt-5">
								<button class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>	
								<button class="btn btn-success btn-lg" data-dismiss="modal" wire:click="setStatDate">Confirmar</button>
										
							</div>
					</div>
				
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>


    
</section>
</x-body-wrapper>
<x-footer />
</div>
