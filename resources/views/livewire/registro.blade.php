 

<div>
<x-header />
	<x-body-wrapper >
		<x-nav-bar /> 
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
                <label for="inputAddress">Calle principal</label>
                <input type="text" class="form-control" id="inputAddress" wire:model="inputAddress">
                <x-input-error for="inputAddress" />

            </div>
            <div class="form-group col-md-6">

                <label for="inputAddress2">Calle secundaria</label>
                <input type="text" class="form-control" id="inputAddress2"
                wire:model="inputAddress2">
          

                

            </div>

            <div class="form-group col-md-6">

                <label for="inputAddress3">Calle terciaria</label>
                <input type="text" class="form-control" id="inputAddress3"
                wire:model="inputAddress3">
            </div>
        </div>



        <div class="form-group col-md-4">
            <label for="inputCiudad">Ciudad</label>
            <select id="inputCiudad" wire:model="inputCiudad" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputBarrio">Barrio</label>
            <select id="inputBarrio" wire:model="inputBarrio" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputPais">Pais</label>
            <select id="inputPais" wire:model="inputPais" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
        <div class="from-group col-md-4">
            <label>Fecha de nacimiento</label>
            <input type="date" wire:model="inputNac" class="form-control">
        </div>


        <div class="form-group col-md-12">
            <span class="control-fileupload">
                <label for="file">Sube una foto :</label>
                <input type="file" wire:model="inputPhoto" class="form-control" id="file">
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
