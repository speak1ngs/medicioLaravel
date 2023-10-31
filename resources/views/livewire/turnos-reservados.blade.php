<div>
<x-header />
<x-body-wrapper >
<x-navigation-menu-list />

	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">

				<div class="col-md-12">
					<h4 class="text-center">Turnos reservados </h4>
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

						<table id="mytable" class="table table-bordered table-striped">

							<thead>
                            <th>Profesional</th>
						    <th>Especialidad</th>
						    <th>Reserva</th>
						    <th>Calificar</th>
							<th>Estado</th>
							</thead>
							<tbody>


								@if(sizeof($db) >= 1)
								
								
								@foreach($db as $data)
									@if($data->idcit == '1')
										@if($data->dias_laborales <= $today)
												@if($data->horarios <= $hour)
														{{ $this->changeStateEnd($data->id)}}
												@endif
										@endif
							
										
									@endif
									@if($data->dias_laborales >= $dateStart && $data->dias_laborales <= $dateFilter)
											@if($data->idcit != '3' && $data->idcit!='4')
														@if(empty($data->calId))
															<tr>
																<td>{{ $data->nombres }} </td>
																<td>{{ $data->especialidad }}</td>
																<td><a href="#" data-title="detailDate" data-toggle="modal"
																		data-target="#detailDate" wire:click.prevent="sendData('{{ json_encode($data, true)}}')" wire:ignore>Ver detalle</a></td>
																<td>
																	
																		<span data-title="calf" data-toggle="modal" data-target="#calf"
																	data-dismiss="modal" wire:click.prevent="instanData('{{ $data->id }}','{{ $data->nombres }}', '{{ $data->idpac }}')" wire:ignore.self> 
																	<a href="#">Calificar</a>
																	</span>
																	<td>
																		{{$data->descripcion}}
																	</td>

																</td>
													
														@endif
											@endif
										@endif
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

					<div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Calificar al Profesional </h4>
						<h6> {{ $nom }}</h6>
							<div class="row">
								<h5 class="text-center">Deje un comentario:</h5>
								<div class="form-group text-center">
									<textarea class="form-control div-wid " id="message-text" wire:model.defer="inputComent"></textarea>
								</div>
								<div class="form-group ">
								<h5 class="text-center bottom-p">Calificar:</h5>
									<div class="rate  div-star">
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
							data-title="{{ $control }}" data-toggle="modal" 
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
						<p class="text-center">Gracias por tu comentario {{ $control }}!!</p>
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



	<div class="container" >
			<div class="modal fade" id="detailDate" tabindex="-1" role="dialog" aria-labelledby="detailDate" aria-hidden="true" wire:ignore.self>
				<div class="modal-dialog modal-content-scroll" role="document">
					<div class="modal-content">
					
						@if(!empty($datTemp))

						
						
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign()">
								<span class="glyphicon glyphicon-remove" aria-hidden="true" ></span>
							</button>
							<h4 class="modal-title custom_align" id="Heading">Reserva</h4>
						</div>
						<div class="modal-body">

						<div class="row">
									<h6 class="modal-title custom_align" id="Heading">Información del Profesional:</h6>

									<div class="form-group">
										<div class="col-md-12">
											<p class="text-center bottom-p">Doctor: <strong> {{ $datTemp[0]['doctor']}} </strong></p>
										</div>
										
										<h6 class="modal-title custom_align" id="Heading">Información del consultorio:</h6>

										<div class="form-group">
											<div class="col-md-12">
												<p class="text-center bottom-p">Consultorio: <strong> {{ $datTemp[0]['consul_nomb']}} </strong></p>
												<p class="text-center bottom-p">Telf: <strong> {{ $datTemp[0]['consult_telf']}} </strong></p>
												<p class="text-center bottom-p">Ciudad: <strong> {{ $datTemp[0]['ciudad']}} </strong></p>
												<p class="text-center bottom-p">Ubicación: <strong> <a href="{{ $datTemp[0]['ubi'] }}">Google Map</a> </strong></p>

											</div>


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



	<script>
    



   
	const stars = document.querySelectorAll('.stars-1 i');

	// Loop through the "stars" NodeList
	stars.forEach((star, index1) => {
		// Add an event listener that runs a function when the "click" event is triggered
		star.addEventListener("click", () => {
			// Loop through the "stars" NodeList Again
			stars.forEach((star, index2) => {
				// Add the "active" class to the clicked star and any stars with a lower index
				// and remove the "active" class from any stars with a higher index
				index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
			});
			$('#Reservar').modal('show');
		});
	});
	</script>

    
</section>


</x-body-wrapper>
<x-footer />


</div>
