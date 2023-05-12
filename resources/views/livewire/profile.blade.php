<div>
<x-header/>
	<x-body-wrapper >
	
			<x-navigation-menu />
			<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">
		<div class="row">
			<div class="align-items-center flex-lg-row-reverse text-center">
				<div editable="rich">
					<h1 class="fw-bolder display-2 ">Paciente Fulano</h1>
				</div>
          
				<div class="text-center">

					<div class="img-thumbnail">

						<img class="card-img-top" alt="100%x180" src="{{ mix('./img/team/1.jpg')}}" data-holder-rendered="true"
							style="height: 180px; width: 100%; display: block;">
					</div>
				</div>

			</div>
			<hr>

			<div class="col-sm-6 form-group">
				<label>Nombres</label>
				<input type="text" placeholder="Enter First Name Here.." wire:model="inputNombre"  @if ($value ==="false")
disabled
@else
regular
@endif
class="form-control">
			</div>
			<div class="col-sm-6 form-group">
				<label>Apellidos</label>
				<input type="text" placeholder="Enter Last Name Here.." @if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputApellido" class="form-control">
			</div>

		</div>
		<div class="row">
			<div class="col-sm-4 form-group">
            <label for="inputState">Barrio</label>
                <select id="inputState" class="form-control"@if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputBarrio">
                                                            @if($inputBarrio)
                                                            <option selected>{{ $inputBarrio[0]->descripcion}}</option>

                                                            @else
                                                            <option selected>Seleccionar Barrio</option>
                                                            @endif
                                                          
                                                            @if(count($barrio)>=1)
                                                            @foreach($barrio as $barr )
                                                                @if($barr->descripcion != $inputBarrio[0]->descripcion)
                                                                <option value="{{ $barr->id}}">{{$barr->descripcion}}</option>
                                                                @endif
                                                            @endforeach
                                                            @else
                                                            <option selected>No hay Barrio</option>
                                                            @endif
                                                            </select>
                         
            
            
            
            </div>
			<div class="col-sm-4 form-group">
				<label for="inputState">Ciudad</label>
				<select id="inputState" class="form-control" @if ($value ==="false")
disabled
@else
regular
@endif  wire:model="inputCiudad">
                                                        @if($inputCiudad)
                                                            <option selected>{{ $inputCiudad[0]->descripcion}}</option>

                                                            @else
                                                            <option selected>Seleccionar Barrio</option>
                                                            @endif
                                                          
										@if(count($ciudad)>=1)
										@foreach($ciudad as $ciuda )
                                        @if($ciuda->descripcion != $inputCiudad[0]->descripcion)
                                                                <option value="{{ $ciuda->id}}">{{$ciuda->descripcion}}</option>
                                                                @endif
										@endforeach
										@else
										<option>No hay Ciudad</option>
										@endif
				</select>
			</div>
			<div class="col-sm-4 form-group">
				<label for="inputState">Pais</label>
				<select id="inputState" class="form-control" @if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputPais">
                                                            @if($inputPais)
                                                            <option selected>{{ $inputPais[0]->descripcion}}</option>

                                                            @else
                                                            <option selected>Seleccionar Barrio</option>
                                                            @endif
									@if(count($pais) >= 1)
											@foreach($pais as $pai )
                                                             @if($pai->descripcion != $inputPais[0]->descripcion)
                                                                <option value="{{ $pai->id}}">{{$pai->descripcion}}</option>
                                                                @endif
										@endforeach
									@else
									<option>No hay Pais</option>
									@endif
									</select>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4 form-group">
                <label>Fecha de nacimiento</label>
                <input type="date" wire:model="inputNac" class="form-control" @if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputNac">
			</div>
            <div class="col-sm-4 form-group">
                <label>Edad</label>
	    		<input type="text" placeholder="Enter Phone Number Here.." wire:model="inputEdad" class="form-control" @if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputEdad">
            </div>
            <div class="col-sm-4 form-group">
                <label>Cedula</label>
                <input type="text" placeholder="Enter Last Name Here.." class="form-control" @if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputCedula">
            </div>

        
        </div>

		<div class="form-group">
			<label>Número de teléfono</label>
			<input type="text" placeholder="Enter Phone Number Here.." class="form-control" @if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputTelf">
		</div>

		<div class="form-group">

			<label class="form-label" for="customFile">Sube una foto: </label>
			<input type="file" class="form-control" id="customFile" @if ($value ==="false")
disabled
@else
regular
@endif wire:model="inputPhoto" value="{{ $inputPhoto}}">



			</form>


		</div>





		<button type="button" class="btn btn-skin btn-lg" wire:click.defer="$set('value', true)">Editar</button>
	
		<button type="button" class="btn btn-skin btn-lg" @if ($value ==="false")
disabled
@else
regular
@endif wire:click="edit()">Guardar</button>

	</div>






</section>
	</x-body-wrapper>
<x-footer />
</div>
