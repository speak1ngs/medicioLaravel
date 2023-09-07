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
                        data-title="{{ $control }}" data-toggle="modal" data-target="#{{ $control }}"
							data-dismiss="modal"
                        
                        >Crear post <i class="glyphicon glyphicon-ok-sign"></i></button>
                    </div>

                </div>
        </section>

        <div class="container">
		<div class="modal fade" id="successComent" tabindex="-1" role="dialog" aria-labelledby="successComent"
			aria-hidden="true"  wire:ignore.self>
			<div class="modal-dialog modal-confirm" role="document">
				<div class="modal-content ">
					<div class="modal-header">
						<div class="icon-box">
							<i class="material-icons">&#xE876;</i>
						</div>
						<h4 class="modal-title w-100">Post creado!</h4>
					</div>
					<div class="modal-body">
						<p class="text-center">Dar de alta!</p>
					</div>
					@if (session()->has('message'))

					<div class="alert alert-success">

						{{ session('message') }}

					</div>

					@endif
					<div class="modal-footer">
						<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>

	<!-- comentario fallido  -->

	<div class="container">
		<div class="modal fade" id="failComment" tabindex="-1" role="dialog" aria-labelledby="failComment"
			aria-hidden="true" wire:ignore.self>
			<div class="modal-dialog modal-confirm-red" role="document">
				<div class="modal-content ">
					<div class="modal-header">
						<div class="icon-box-red">
							<span class="material-symbols-outline">
								disabled_by_default
							</span>
						</div>
						<h4 class="modal-title w-100">Error!</h4>
					</div>
					<div class="modal-body">
						<p class="text-center">Intente nuevamente</p>
						@if (session()->has('message'))

							<div class="alert alert-success">

								{{ session('message') }}

							</div>

							@endif
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



</x-body-wrapper>
<x-footer />
</div>
