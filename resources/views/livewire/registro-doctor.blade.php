<div>
<x-header />
<x-body-wrapper>
<x-navigation-menu-list />
    <section id="register " class="home-section paddingtop-130 h-100 h-custom well">
	<div class="py-5">
		<div class="container well">
			<h2 class="fw-bolder display-2 text-center">Registrar Doctor</h2>
			<hr>

			<div class="col-lg-12">
				<div class="row">
					<form>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-6 form-group">
									<label>Nombres</label>
									<input type="text" placeholder="Enter First Name Here.." class="form-control" wire:model="inputNombre">
                                    <x-input-error for="inputNombre" />
								</div>
								<div class="col-sm-6 form-group">
									<label>Apellidos</label>
									<input type="text" placeholder="Enter Last Name Here.." class="form-control" wire:model="inputApellido">
                                    <x-input-error for="inputApellido" />
                                </div>

							</div>
							<div class="form-group">
								<label>Cedula</label>
								<input type="text" placeholder="Enter Last Name Here.." class="form-control" wire:model="inputCedula">
                                <x-input-error for="inputCedula" />
								<label>Registro Medico</label>
								<input type="text" placeholder="Enter Last Name Here.." class="form-control" wire:model="inputRegistro">
                                <x-input-error for="inputRegistro" />
								<label>Edad</label>
								<input type="number" placeholder="Enter Last Name Here.." class="form-control" wire:model="inputEdad">
                            
							</div>
							<div class="row">
								<div class="col-sm-4 form-group">
									<label for="inputState">Barrio</label>
									<select id="inputState" class="form-control" wire:model="inputBarrio">
										<option selected>Seleccionar Barrio</option>
										@if(count($barrio)>=1)
										@foreach($barrio as $barr )
											<option value="{{ $barr->id}}">{{$barr->descripcion}}</option>
										@endforeach
										@else
										<option selected>No hay Barrio</option>
										@endif
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label for="inputState">Ciudad</label>
									<select id="inputState" class="form-control"  wire:model="inputCiudad">
										<option selected>Seleccionar Ciudad</option>
										@if(count($ciudad)>=1)
										@foreach($ciudad as $ciuda )
											<option value="{{ $ciuda->id}}">{{$ciuda->descripcion}}</option>
										@endforeach
										@else
										<option>No hay Ciudad</option>
										@endif
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label for="inputState">Pais</label>
									<select id="inputState" class="form-control" wire:model="inputPais">
										<option selected>Seleccionar Pais</option>
									@if(count($pais) >= 1)
											@foreach($pais as $pai )
												<option value="{{ $pai->id}}">{{$pai->descripcion}}</option>
										@endforeach
									@else
									<option>No hay Pais</option>
									@endif
									</select>
								</div>
							</div>
						

							<div class="row">
                                <div class="col-sm-6 from-group">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date"  class="form-control" wire:model="inputFechNac">
                                </div>
                                <div class="col-sm-6 from-group">
                                            <label>Registro Fecha de Expiracion</label>
                                            <input type="date"  class="form-control" wire:model="inputFechaExpReg">
                                </div>
							</div>
	
							<div class="form-group">
								<label>Número de teléfono laboral</label>
								<input type="text" placeholder="Enter Phone Number Here.." class="form-control" wire:model="inputTelfLab" >
                                <x-input-error for="inputTelfLab"/>
							</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" placeholder="Enter Email Address Here.." class="form-control" wire:model="inputEmail">
                                <x-input-error for="inputEmail" />
							</div>
                            <div class="form-group">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword" wire:model="inputPass" placeholder="Password">
                                <x-input-error for="inputPass" />
                            </div>
							<div class="form-group">
								<span class="control-fileupload">
									<label for="file">Sube una foto :</label>
									<input type="file" class="form-control" id="{{ $idpho }}" wire:model="inputPhoto">
								</span>
							</div>

							<div class="form-group">
								<label for="descript">Descripcion:</label>
								<textarea name="text-description" id="descript" class="form-control"cols="120" rows="5" wire:model="inputDescrip"></textarea>
							</div>

                            <div class="form-group">
                            <label for="Especialidades">Especialidades:</label>
                            <div class="row center-block">
								@if(count($especialidades) >= 1)
                                @foreach($especialidades as $especial )    
                                
                                <div class="col-xs-3">
                                    <div class="frb frb-success">
                                            <input type="checkbox" id="checkbox-{{ $especial->id }}" wire:model="inputEspecial" value="{{ $especial->descripcion}}">
                                            <label for="checkbox-{{ $especial->id }}">
                                                <span class="frb-title">{{ $especial->descripcion}}</span>
                                            </label>
                                        
                                        </div>
                                    </div>    
                               
                                
                                @endforeach
								@else
								<label">
                                                <span>No hay especialidades cargadas</span>
                                            </label>>
								@endif
                                </div>
                    
                            </div>
                          
                  
                     
                                            
                                        
					</form>

				</div>
			</div>

			<button type="button" class="btn btn-skin btn-lg" wire:click="guardar()">Registrar</button>
		</div>



	</div>



  

</section>
</x-body-wrapper>
<x-footer />

</div>
