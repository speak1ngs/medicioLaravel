<div>
    <x-header />
    <x-body-wrapper >
    <x-navigation-menu-list />
        <section id="register " class="home-section paddingtop-130 h-100 h-custom well">
        <div class="container well ">
                        <h2 class="text-center">Crear Rol</h2>
                        <hr>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Ingresar Rol:</label>
                                        <input type="text" placeholder="Ej:..Invitado" class="form-control" wire:model="rol">
                                    </div>
                                    <button class="btn btn-skin bt-lg form-control center-block top-button" wire:click="createRol"                
                            >Crear Rol <i class="glyphicon glyphicon-ok-sign"></i></button>
                                </div>

            
                    </div>
        </div>
    </x-body-wrapper>
    <x-footer />
  
</div>
