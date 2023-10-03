<div>
<x-header />
	<x-body-wrapper >
		<livewire:navbar />
        <section id="register " class="home-section paddingtop-130 h-100 h-custom well">


<div class="container well"  >
    <h2 class="text-center">Registro paciente</h2>
    <form>
        <div class="form-row">
            <hr>
            <div class="form-group col-md-6">
                <label>Nombre</label>
                <input type="text" class="form-control"  wire:model="inputNombre" placeholder="Nombre">
                <x-input-error for="inputNombre" />
            </div>
            <div class="form-group col-md-6">
                <label for="inputApellido">Apellido</label>
                <input type="text" class="form-control" id="inputApellido" wire:model="inputApellido" placeholder="Apellido">
                <x-input-error for="inputApellido" />
            </div>
            <div class="form-group col-md-6">
                <label for="inputCedula">Cedula</label>
                <input type="text" class="form-control" id="inputCedula" wire:model="inputCedula" placeholder="Cedula">
                <x-input-error for="inputCedula" />
                
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" wire:model="inputEmail" placeholder="Email">
                <x-input-error for="inputEmail" />
       
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword" wire:model="inputPassword" placeholder="Password">
                <x-input-error for="inputPassword" />
           
            </div>
            <div class="form-group col-md-6">
                <label for="inputTelf">Telefono</label>
                <input type="text" class="form-control" id="inputTelf" wire:model="inputTelf" placeholder="Telefono">
                <x-input-error for="inputTelf" />
         
            </div>

            <div class="form-group col-md-6">
                <label for="inputEdad">Edad</label>
                <input type="number" class="form-control" id="inputEdad" wire:model="inputEdad" placeholder="Edad">
            </div>

        <div class="form-group col-md-6">
            <label>Fecha de nacimiento</label>
            <input type="date" wire:model="inputNac" class="form-control">
        </div>


                            <div class="form-group col-md-4">
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
                            <div class="form-group col-md-4">
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
        <div class="form-group col-md-4">
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



        <div class="form-group col-md-12">
            <span class="control-fileupload">
                <label for="file">Sube una foto :</label>
                <input type="file" wire:model="inputPhoto" class="form-control" id="{{ $idpho }}">
                <x-input-error for="inputPhoto" />


            </span>
        </div>



    </form>
                <div class="form-group col-md-8">

                    <button type="submit" class="btn btn-skin btn-lg right" wire:click="guardar()" wire:target="guardar()">Registrarme</button>
                    
                </div>
    </div>








</section>
	</x-body-wrapper>
<x-footer /> 

</div>
