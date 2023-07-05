<div>
<x-header />
<x-body-wrapper >
	<x-navigation-menu />
	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">


			<div class="container well">
			<h3 class="mb-0 text-center"> Reservar turno</h3>
			
			<h5> Filtrar busqueda:</h5>
			<hr>
				

				<div class="row">
					<div class="col-md-3  align-items-start">
					<label for="inputCedula">Profesional</label>
						<input type="text" class="form-control" id="inputCedula" placeholder="Nombre del medico" wire:model="inputNombre" wire:click="resetShowEntries">
					</div>
				
					<div class="col-md-3 align-self-center">
					<label for="inputHorarioIni">Horario Inicial</label>
					
					<select id="inputHorarioIni" class="form-control" wire:model="inputHorarioIni" wire:click="resetShowEntries">
												<option selected value="">Seleccionar Horario</option>
											@if(count($hourStart) >= 1)
													@foreach($hourStart as $especial )
														<option value="{{ $especial['horario_inicio']}}">{{ $especial['horario_inicio'] }}</option>
												@endforeach
											@else
											<option>No hay horario de inicio</option>
											@endif
											</select>
					</div>
					<div class="col-md-3 align-self-center">
					<label for="inputHorarioFin">Horario Fin</label>
					
					<select id="inputHorarioFin" class="form-control" wire:model="inputHorarioFin" wire:click="resetShowEntries">
												<option selected value="">Seleccionar Horario</option>
											@if(count($hourEnd) >= 1)
													@foreach($hourEnd as $especial )
														<option value="{{ $especial['horario_inicio']}}">{{ $especial['horario_fin'] }}</option>
												@endforeach
											@else
											<option>No hay horario de inicio</option>
											@endif
											</select>
					</div>
		
				</div>
				<div class="row">
					<div class="col-md-3 align-items-start">
					<label for="inputState">Especialidades</label>
					
					<select id="inputStat" class="form-control" wire:model="inputEspecialidades" wire:click="resetShowEntries">
												<option selected value="">Seleccionar Especialidad</option>
											@if(count($especialidades) >= 1)
													@foreach($especialidades as $especial )
														<option value="{{ $especial->id}}">{{$especial->descripcion}}</option>
												@endforeach
											@else
											<option>No hay Especialidades</option>
											@endif
											</select>
					</div>

					<div class="col-md-3 align-self-center">
						<label for="inputCiudades">Ciudades</label>
						<select id="inputCiudades" class="form-control" wire:model="inputCiudades" wire:click="resetShowEntries">
												<option selected value="">Seleccionar Ciudades</option>
											@if(count($ciudades) >= 1)
													@foreach($ciudades as $especial )
														<option value="{{ $especial->id}}">{{$especial->descripcion}}</option>
												@endforeach
											@else
											<option>No hay Ciudades</option>
											@endif
											</select>
					</div>

					<div class="col-md-3 align-self-center">
						<label for="inputDayWeek">Dias</label>
						<select id="inputDayWeek" class="form-control" wire:model="inputDayWeek" wire:click="resetShowEntries">
												<option selected value="">Seleccionar Dias</option>
											@if(count($day) >= 1)
													@foreach($day as $especial )
														<option value="{{ $especial['id']}}">{{$especial['dayWeek']}}</option>
												@endforeach
											@else
											<option>No hay Dias</option>
											@endif
											</select>
					</div>


					<div class="col-md-3 align-selft-center">
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
					@dump($do)
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

				
				@if(!empty($nom))
	
					<div class="row mb-4 align-items-center flex-lg-row-reverse"  wire:ignore>
						<div class="col-md-6 col-xl-5">
							<div class="lc-block mb-3">
								<div editable="rich">
									<h1 class="fw-bolder display-2">{{'Dr. ' . $nom . ' ' . $apell }}</h1>
								</div>
							</div>

		
							<div class="lc-block mb-4">
								<div editable="rich">
									<label for="">Informacion del Profesional:</label>
									<p class="lead">{{ $descrip }}</p>

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
					
				@else
				<label for="">No hay datos del doctor</label>
				@endif
					<hr>
					
					<div class="row " >

		

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
													
									@if(!empty($calenShow))
				
							
										
									@foreach($calenShow as $calen)
                                                <tr>

                                                    <td>{{ 'Dr. ' .  $calen['nombre'] . ' ' . $calen['apellido'] }} </td>
                                                    <td>{{  $calen['especialidades'] }} </td>
                                                    <td>{{  $calen['consultorio'] }} </td>
                                                    <td>{{  $calen['dias'] }} </td>
                                                    <td>{{ 'De: ' . $calen['horario_inicio'] . ' a ' . $calen['horario_fin'] }} </td>
                                                    <td>
                                                        <p data-placement="top" data-toggle="tooltip" title="reservar"><button
                                                                class="btn btn-primary btn-xs" data-title="Reservar" data-toggle="modal"
                                                                data-target="#Reservar" wire:click="arrReceive( {{ $calen['calenId'] }})"><span class="fa fa-calendar"></span></button>
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
				<div class="modal fade" id="Reservar" tabindex="-1" role="dialog" aria-labelledby="Reservar" aria-hidden="true"   wire:ignore.self>
					<div class="modal-dialog" role="document" >
						<div class="modal-content modal-content-scroll">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="resetModalEntries"><span
										class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
								<h4 class="modal-title custom_align" id="Heading">Horarios disponibles</h4>
							</div>
							<div class="modal-body" >
							
									<label for="inpuTDias">Dias:</label>
									<select id="inputDias" class="form-control" wire:model.defer="inputDias" wire:click="showDatesOfWeek(1)">
											<option selected value="">Seleccionar Día</option>
											
											@if( !empty($dias))
											
													@foreach($dias as $ar )
														<option value="{{ $ar}}" >{{ $ar}}</option>
												@endforeach
											@else
											<option>No hay Año</option>
											@endif
									</select>
										
									<div>
						


									@if(!empty($arrDay))
									<label class="text-left"
									@if($open_day===true)
									style="display: true;"
									@else
									style="display: none;"
									@endif
									>Fechas disponibles:</label >
									<div class="frb-group">
										<div class="row center-block">
										@foreach($arrDay as $arr)
                                            <div class="col-md-4">
                                                <div class="frb frb-success">
                                                    <input type="radio" id="radio-button-{{$arr['dias_laborales'] }}-1" name="radio-button"  wire:model.defer="inputMes"  value="{{ $arr['dias_laborales'] }}" wire:click="showHoursOfWeek()">
                                                    <label for="radio-button-{{$arr['dias_laborales'] }}-1">
                                                        <span class="frb-description">{{ $arr['dias_laborales']}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
										</div>	
									</div>
									@endif

									@if(!empty($arryHour))
                                    <label class="text-left">Horarios disponibles:</label>
                                    <div class="frb-group">
                                        <div class="row center-block">
                                        @foreach($arryHour as $arr)
                                            <div class="col-md-4">
												
                                                <div class="frb frb-success">
                                                    <input type="radio" id="radio-button-{{ $arr['horarios']}}-1" name="radio-button1"    value="{{  $arr['id'] }}" wire:model.defer="inputHour" >
                                                    <label for="radio-button-{{ $arr['horarios']}}-1">
                                                        <span class="frb-description">{{ $arr['horarios']}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>  
                                    </div>
                                    @endif

										@if (session()->has('message'))

											<div class="alert alert-success">

												{{ session('message') }}

											</div>

										@endif

									</div>
										
									
									
									
									
									<div class="modal-footer ">
										<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
											data-title="pagarReserva" data-toggle="modal" data-target="{{ $alert }}"
											data-dismiss="modal" wire:click.prevent="reserTime()"><span class="glyphicon glyphicon-ok-sign"></span>Reservar</button>
									</div>
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
								<p class="text-center">Un operador se comunicara con usted para confirmar
													su horario!!.</p>
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

