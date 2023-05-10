<div>
<x-header />
<x-body-wrapper>
	<x-navigation-menu/>
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
							</div>
							<div class="row">
								<div class="col-sm-4 form-group">
									<label for="inputState">Barrio</label>
									<select id="inputState" class="form-control" wire:model="inputBarrio">
										<option selected>Choose...</option>
										<option>...</option>
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label for="inputState">Ciudad</label>
									<select id="inputState" class="form-control"  wire:model="inputCiudad">
										<option selected>Choose...</option>
										<option>...</option>
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label for="inputState">Pais</label>
									<select id="inputState" class="form-control" wire:model="inputPais">
										<option selected>Choose...</option>
										<option>...</option>
									</select>
								</div>
							</div>
						

							<div class="row">
                                <div class="col-sm-6 from-group">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date" wire:model="inputNac" class="form-control" wire:model="inputFechNac">
                                </div>
                                <div class="col-sm-6 from-group">
                                            <label>Registro Fecha de Expiracion</label>
                                            <input type="date" wire:model="inputNac" class="form-control" wire:model="inputFechaExpReg">
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
									<input type="file" class="form-control" id="file" wire:model="inputPhoto">
								</span>
							</div>

							<div class="form-group">
								<label for="descript">Modificar descripcion</label>
								<textarea name="text-description" id="descript" class="form-control"cols="120" rows="5" wire:model="inputDescrip"></textarea>
							</div>
							<div class="form-group">
								<label for="inputState">Seleccionar consultorio</label>
								<select id="inputState" class="form-control" wire:model="inputConsultorio">
									<option selected>Choose...</option>
									<option>...</option>
								</select>
							</div>

                            <div class="form-group">
                            <label for="Especialidades"></label>
                            <div class="row center-block">
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
                                    Especial: {{ var_export($inputEspecial)}}
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
