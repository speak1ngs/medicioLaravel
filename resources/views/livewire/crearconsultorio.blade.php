<div>
<x-header />
<x-body-wrapper>
<x-navigation-menu-list />
    <section id="register " class="home-section paddingtop-130 h-100 h-custom well">
	<div class="py-5">
		<div class="container well">
			<h2 class="fw-bolder display-2 text-center">Registrar Consultorio</h2>
			<hr>

			<div class="col-lg-12">
				<div class="row">
					<form>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-12 form-group">
									<label>Nombre:</label>
									<input type="text" placeholder="Ej:...San Martin" class="form-control" wire:model="inputNombre">
                                    <x-input-error for="inputNombre" />
								</div>
							</div>
                    
							<div class="form-group">
								<label>Instagram</label>
								<input type="text" placeholder="Ej:...instagram.com/idmuestra" class="form-control" wire:model="inputInsta">
                                <x-input-error for="inputCedula" />
								<label>Facebook</label>
								<input type="text" placeholder="Ej:...facebook.com/DevTalles" class="form-control" wire:model="inputFace">
                                <x-input-error for="inputRegistro" />
								<label>Twitter</label>
								<input type="text" placeholder="Ej:...twitter.com/DevTalles" class="form-control" wire:model="inputTwi">
                                <label>Sitio web</label>
								<input type="text" placeholder="Ej:...www.example.com" class="form-control" wire:model="inputWeb">
                                <label>Ubicación</label>
								<input type="text" placeholder="Ej:...https://goo.gl/maps/Zn7D5wYJMP81oufm7" class="form-control" wire:model="inputMap">

							</div>
							<div class="row">
								<div class="col-sm-4 form-group">
									<label for="inputState">Barrio</label>
									<select id="inputState" class="form-control" wire:model="inputBarr">
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
									<select id="inputState" class="form-control"  wire:model="inputCiud">
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
  
							</div>
	
							<div class="form-group">
								<label>Número de teléfono</label>
								<input type="text" placeholder="Ej:...09XX 111 111" class="form-control" wire:model="inputTelf" >
                                <x-input-error for="inputTelf"/>
                                <label>Intervalo de consulta:</label>
								<input type="text" placeholder="Ej:....15" class="form-control" wire:model="inputIntervalo" >
                                <x-input-error for="inputIntervalo"/>
                                <label>Ruc:</label>
								<input type="text" placeholder="Ej:....800000-5" class="form-control" wire:model="inputRuc" >
                                <x-input-error for="inputRuc"/>
							</div>

							<div class="form-group">
								<span class="control-fileupload">
									<label for="file">Sube una foto :</label>
									<input type="file" class="form-control" id="file" wire:model="inputFoto">
								</span>
							</div>

                            <div class="row">
								<div class="col-sm-4 form-group">
									<label for="inputState">Calle principal</label>
									<select id="inputState" class="form-control" wire:model="inputPrinc">
										<option selected>Seleccionar Calle</option>
										@if(count($calle)>=1)
										@foreach($calle as $barr )
											<option value="{{ $barr->id}}">{{$barr->descripcion}}</option>
										@endforeach
										@else
										<option selected>No hay calles</option>
										@endif
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label for="inputState">Calle secundaria</label>
									<select id="inputState" class="form-control"  wire:model="inputSecu">
                                    <option selected>Seleccionar Calle</option>
										@if(count($calle)>=1)
										@foreach($calle as $barr )
											<option value="{{ $barr->id}}">{{$barr->descripcion}}</option>
										@endforeach
										@else
										<option selected>No hay calles</option>
										@endif
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label for="inputState">Calle terciaria</label>
									<select id="inputState" class="form-control" wire:model="inputTerc">
                                    <option selected>Seleccionar Calle</option>
										@if(count($calle)>=1)
										@foreach($calle as $barr )
											<option value="{{ $barr->id}}">{{$barr->descripcion}}</option>
										@endforeach
										@else
										<option selected>No hay calles</option>
										@endif
									</select>
								</div>
							</div>
						
					</form>

				</div>
			</div>

			<button type="button" class="btn btn-skin btn-lg" wire:click="regConsul()">Registrar</button>
		</div>



	</div>



  

</section>
</x-body-wrapper>
<x-footer />

</div>
