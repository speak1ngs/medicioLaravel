<div>
<x-header />
<x-body-wrapper >
<x-navigation-menu-list />
        <section id="register " class="home-section paddingtop-130 h-100 h-custom well">
            
                <div class="container well ">
                    <h2 class="text-center">Crear post</h2>
                    <hr>


                    <div class="row">

						@if($this->inputPhoto)
							<img src="{{ $inputPhoto->temporaryUrl()}}" alt="" class="text-center">
						@endif

                        <label>Suba una foto: </label>
                        <input type="file" class="form-control" wire:model="inputPhoto" id="{{ $iden }}">

                        <label >Titulo: </label>
                        <input type="text" placeholder="Ej:Cura para una nueva enfermedad..." class="form-control" wire:model="inputTittle">

                        <label>Contenido de la publicacion:</label>
                        <textarea name="" id="" cols="10" rows="10" class="form-control" wire:model="inputContent"></textarea>


                        <button class="btn btn-skin bt-lg form-control top-button" wire:click="setPost"
                     data-toggle="modal" data-dismiss="modal"               
                        >Crear post <i class="glyphicon glyphicon-ok-sign"></i></button>
                    </div>

                </div>
        </section>





</x-body-wrapper>
<x-footer />
</div>
