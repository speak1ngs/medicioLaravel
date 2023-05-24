<div>
<x-header />
<x-body-wrapper >
	<x-navigation-menu />
	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">


			<div class="container well">
				<h3 class="mb-0"> Reservar turno</h3>
				<hr>


				<div class="input-group mb-3">

					<div class="input-group-prepend">
						<h5> Filtros</h5>
						<div class="input-group-text">
							<input type="checkbox" aria-label="Checkbox for following text input">
							<span>Especialidad</span>
							<input type="checkbox" aria-label="Checkbox for following text input">
							<span>Barrio</span>
							<input type="checkbox" aria-label="Checkbox for following text input">
							<span>Ubicacion</span>
							<input type="checkbox" aria-label="Checkbox for following text input">
							<span>Medico</span>
						</div>
					</div>
				</div>

			</div>


			<div class="container well">

				<label for="inputCedula">Profesional</label>

				<div class="row">
					<div class="col-md-4  align-items-start">

						<input type="text" class="form-control" id="inputCedula" placeholder="Nombre del medico" wire:model="inputNombre" wire:click="resetShowEntries">
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 align-items-start">
					<label for="inputState">Especialidades</label>
					
					<select id="inputStat" class="form-control" wire:model="inputEspecialidades" wire:click="resetShowEntries">
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

					<div class="col-md-4 align-self-center">
						<label for="inputState">Barrio</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>...</option>
						</select>
					</div>
					<div class="col-md-4 align-selft-center">
					<label for="">Mostrar</label>
						<select id="inputCant" class="form-control" wire:model="can" wire:click="resetShowEntries">
								
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
										<img class="card-img-top img-responsive img-thumbnail" alt="100%x180" src="{{ mix('./img/team/1.jpg')}}" data-holder-rendered="true"
											style="height: 180px; width: 100%; display: block;">
										<div class="card-block">
											<h4 class="card-title"> {{ 'Dr. ' .  $doctor->nombre . ' ' . $doctor->apellido}}</h4>

											<p class="card-text"><strong>Información:</strong> {{ $doctor->descripcion }}</p>

											<p class="card-text"> <strong> Especialidades:</strong> {{ $doctor->especialidades }}</p>
											<a href="#" class="btn btn-primary btn-sm" 	data-title="Asignar" data-toggle="modal" data-target="#Asignar"
									data-dismiss="modal" wire:click="asig({{ $doctor->cedula }})">Ver calendario</a>
										</div>
									</div>
								</div>
							@endforeach

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


			<div class="py-5">
				<div class="container well"  @if( $open_calendar === true )
				style="display: true;"
				@else
				style="display: none;"
				@endif
				>
				@if($nom)
				@foreach($nom as $no)
					<div class="row mb-4 align-items-center flex-lg-row-reverse">
						<div class="col-md-6 col-xl-5">
							<div class="lc-block mb-3">
								<div editable="rich">
									<h1 class="fw-bolder display-2">{{'Dr. ' . $no->nomb . ' ' . $no->apell }}</h1>
								</div>
							</div>

		
							<div class="lc-block mb-4">
								<div editable="rich">
									<label for="">Informacion del Profesional:</label>
									<p class="lead">{{ $no->descripcion}}</p>

								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-7 mb-4 mb-lg-0 text-center">

							<div class="lc-block position-relative img-thumbnail ">
								<!-- <img class="img-fluid rounded shadow" src="{{ mix('./img/team/1.jpg')}}"> -->
								<img class="card-img-top " alt="100%x180" src="{{ mix('./img/team/1.jpg')}}" data-holder-rendered="true"
									style="height: 180px; width: 100%; display: block;">
							</div>
						</div>

					</div>
					@endforeach
				@else
				<label for="">No hay datos del doctor</label>
				@endif
					<hr>
				
					<div class="row ">

			@dump($timeDoc )


						<div class="col-md-12">
							<h4 class="text-center">Calendario del Profesional</h4>
							<div class="table-responsive">

								<table id="mytable" class="table table-bordred table-striped">

									<thead>
										<th>Nombre Apellido</th>
										<th>Especialidad</th>
										<th>Consultorio</th>
										<th>Dias</th>
										<th>Horario</th>
										<th>Reservar</th>
									</thead>
									<tbody>
									@if($calenShow)
									@foreach($calenShow as $calen)
										<tr>

											<td>{{ 'Dr. ' .  $calen->nombre . ' ' . $calen->apellido }} </td>
											<td>{{  $calen->especialidades }} </td>
											<td>{{  $calen->consultorio }} </td>
											<td>{{  $calen->dias }} </td>
											<td>{{ 'De: ' . $calen->horario_inicio . ' a ' . $calen->horario_fin }} </td>
											<td>
												<p data-placement="top" data-toggle="tooltip" title="reservar"><button
														class="btn btn-primary btn-xs" data-title="Reservar" data-toggle="modal"
														data-target="#Reservar"><span class="fa fa-calendar"></span></button>
												</p>
											</td>
										</tr>
									@endforeach
									@else
									<label for="">No hay datos a mostrar</label>
									@endif
									</tbody>	

								</table>

								<div class="clearfix"></div>
								<ul class="pagination pull-right">
									<li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a>
									</li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
								</ul>

							</div>

						</div>
					</div>
				</div>




			</div>

			<div class="container">
				<div class="modal fade" id="Reservar" tabindex="-1" role="dialog" aria-labelledby="Reservar" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content modal-content-scroll">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
										class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
								<h4 class="modal-title custom_align" id="Heading">Horarios disponibles fecha:21/03/2023</h4>
							</div>
							<div class="modal-body">
								<div class="frb-group">
									<div class="row center-block">
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-1" name="radio-button" value="0">
												<label for="radio-button-1">
													<span class="frb-description">08:15</span>
												</label>
											</div>

										</div>
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-2" name="radio-button" value="1">
												<label for="radio-button-2">
													<span class="frb-description">08:45</span>
												</label>
											</div>

										</div>
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-3" name="radio-button" value="3">
												<label for="radio-button-3">
													<span class="frb-description">09:15</span>
												</label>
											</div>

										</div>
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-4" name="radio-button" value="4">
												<label for="radio-button-4">
													<span class="frb-description">09:45</span>
												</label>
											</div>

										</div>
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-5" name="radio-button" value="5">
												<label for="radio-button-5">
													<span class="frb-description">10:15</span>
												</label>
											</div>

										</div>
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-6" name="radio-button" value="6">
												<label for="radio-button-6">
													<span class="frb-description">10:45</span>
												</label>
											</div>

										</div>
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-7" name="radio-button" value="7">
												<label for="radio-button-7">
													<span class="frb-description">11:15</span>
												</label>
											</div>

										</div>
										<div class="col-md-3">
											<div class="frb frb-success">
												<input type="radio" id="radio-button-8" name="radio-button" value="8">
												<label for="radio-button-8">
													<span class="frb-description">11:45</span>
												</label>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer ">
								<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
									data-title="pagarReserva" data-toggle="modal" data-target="#pagarReserva"
									data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Reservar</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			</div>



			<div class="container">
				<div class="modal fade" id="pagarReserva" tabindex="-1" role="dialog" aria-labelledby="pagarReserva"
					aria-hidden="true">
					<div class="modal-dialog modal-content-scroll" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
										class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
								<h4 class="modal-title custom_align" id="Heading">Abonar consulta</h4>
							</div>
							<div class="modal-body">
								<main class="page payment-page">
									<section class="payment-form dark">
										<form>
											<div class="products">
												<h3 class="title">Checkout</h3>
												<div class="item">
													<span class="price">$200</span>
													<p class="item-name">Product 1</p>
													<p class="item-description">Lorem ipsum dolor sit amet</p>
												</div>
												<div class="item">
													<span class="price">$120</span>
													<p class="item-name">Product 2</p>
													<p class="item-description">Lorem ipsum dolor sit amet</p>
												</div>
												<div class="total">Total<span class="price">$320</span></div>
											</div>
											<div class="card-details">
												<h3 class="title">Credit Card Details</h3>
												<div class="row">
													<div class="form-group col-sm-7">
														<label for="card-holder">Card Holder</label>
														<input id="card-holder" type="text" class="form-control"
															placeholder="Card Holder" aria-label="Card Holder"
															aria-describedby="basic-addon1">
													</div>
													<div class="form-group col-sm-5">
														<label for="">Expiration Date</label>
														<div class="input-group expiration-date">
															<input type="text" class="form-control" placeholder="MM"
																aria-label="MM" aria-describedby="basic-addon1">
															<span class="date-separator">/</span>
															<input type="text" class="form-control" placeholder="YY"
																aria-label="YY" aria-describedby="basic-addon1">
														</div>
													</div>
													<div class="form-group col-sm-8">
														<label for="card-number">Card Number</label>
														<input id="card-number" type="text" class="form-control"
															placeholder="Card Number" aria-label="Card Holder"
															aria-describedby="basic-addon1">
													</div>
													<div class="form-group col-sm-4">
														<label for="cvc">CVC</label>
														<input id="cvc" type="text" class="form-control" placeholder="CVC"
															aria-label="Card Holder" aria-describedby="basic-addon1">
													</div>
												</div>
											</div>
										</form>

									</section>
								</main>
							</div>
							<div class="modal-footer ">
								<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
									class="glyphicon glyphicon-ok-sign" data-title="failPayment" data-toggle="modal"
									data-dismiss="modal" data-target="#failPayment"><span></span>Reservar</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			</div>

			<!-- reserva exitosa -->

			<div class="container">
				<div class="modal fade" id="paymentCheck" tabindex="-1" role="dialog" aria-labelledby="paymentCheck"
					aria-hidden="true">
					<div class="modal-dialog modal-confirm" role="document">
						<div class="modal-content ">
							<div class="modal-header">
								<div class="icon-box">
									<i class="material-icons">&#xE876;</i>
								</div>
								<h4 class="modal-title w-100">Reserva Exitosa!</h4>
							</div>
							<div class="modal-body">
								<p class="text-center">Tu horario ha sido confirmado!!.</p>
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



			<!-- reserva fallida  -->
			<div class="container">
				<div class="modal fade" id="failPayment" tabindex="-1" role="dialog" aria-labelledby="failPayment"
					aria-hidden="true">
					<div class="modal-dialog modal-confirm-red" role="document">
						<div class="modal-content ">
							<div class="modal-header">
								<div class="icon-box-red">
									<span class="material-symbols-outline">
										disabled_by_default
									</span>
								</div>
								<h4 class="modal-title w-100">Reserva fallida!</h4>
							</div>
							<div class="modal-body">
								<p class="text-center">El horario que eligio ya esta ocupado!!.</p>
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



		</section>
		</x-body-wrapper>
		<x-footer />

</div>

