<div>
<x-header />
<x-body-wrapper >
	<x-navigation-menu />
	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">

				<div class="col-md-12">
					<h4>Citas programadas </h4>
					<div class="table-responsive">


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
									data-dismiss="modal" wire:click.prevent="instanData('{{ $data->id }}','{{ $data->nombres }}')">Calificar</span>
							

									</td>
									<td>
										<div class="row">
											<div class="col-sm-4 bottom-p">
												<p data-placement="top" data-toggle="tooltip" title="ausente" class="bottom-p">
													<button class="btn btn-danger btn-xs"><span
															class="fa fa-remove"></span></button>
												</p>
											</div>
											<div class="col-sm-4 bottom-p">
												<p data-placement="top" data-toggle="tooltip" title="presente" class="bottom-p">
													<button class="btn btn-success btn-xs"><span
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
						<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
							data-title="successComent" data-toggle="modal" data-target="#successComent"
							data-dismiss="modal" wire:click="calificar()" ><span class="glyphicon glyphicon-ok-sign" ></span>Calificar</button>
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
			aria-hidden="true">
			<div class="modal-dialog modal-confirm" role="document">
				<div class="modal-content ">
					<div class="modal-header">
						<div class="icon-box">
							<i class="material-icons">&#xE876;</i>
						</div>
						<h4 class="modal-title w-100">Profesional Calificado!</h4>
					</div>
					<div class="modal-body">
						<p class="text-center">Gracias por tu comentario!!</p>
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
		<div class="modal fade" id="failComment" tabindex="-1" role="dialog" aria-labelledby="failComment"
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
