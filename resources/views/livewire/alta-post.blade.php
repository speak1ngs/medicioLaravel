

<div>
<x-header />
<x-body-wrapper >
<x-navigation-menu-list />
	
<section id="register " class="home-section paddingtop-130 h-100 h-custom well">


<div class="container well">

	<div class="col-md-12">
		<h4 class="text-center">Activar post </h4>
		<div class="table-responsive">
							<div class="form-group col-md-1 ">
								<label for="">Mostrar</label>
								<select id="inputState" class="form-control" wire:model="cant">
										
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="">Buscar por titulo </label>
								<input type="text" class="form-control" wire:model="search">
							</div>
							<div class="form-group col-md-3 ">
								<label for="">Filtrar estado</label>
								<select id="inputStat" class="form-control" wire:model="inputState">
												<option selected value="">Seleccionar estado</option>
											@if(count($state) >= 1)
													@foreach($state as $especial )
														<option value="{{ $especial->id }}">{{$especial->descripcion}}</option>
												@endforeach
											@else
											<option>No hay estados</option>
											@endif
											</select>
							</div>
			<table id="mytable" class="table table-bordered table-striped">
		
				<thead>
					<th>Titulo</th>
					<th>Fecha creacion</th>
					<th>Estado</th>
					<th>Desactivar</th>
					<th>Activar</th>
				</thead>
				<tbody>
				@if(!empty($db))
				
				@foreach($db as $data)
					<tr>
					
						<td>{{ $data->titulo}}</td>
						<td>{{ date('d-m-Y',strtotime($data->created_at)) }}</td>
						<td>{{ $data->estado }}</td>
						<td>
							<div class="row">
								<div class="form-group col-sm-4 bottom-p text-center">
									<p data-placement="top" data-toggle="tooltip" title="Desactivar"
										class="bottom-p">
										<button class="btn btn-danger btn-xs" data-title="confirmModal" wire:ignore.self
											data-toggle="modal" data-target="#confirmModal" wire:click="dataSet('{{ $data->id }}', 'desactivar')">
											<span class="fa fa-remove"></span>
										</button>
									</p>
								</div>

							</div>

						</td>
						<td>
							<div class="row">
				
								<div class="form-group col-sm-4 bottom-p text-center" >
									<p data-placement="top" data-toggle="tooltip" title="Activar" class="bottom-p">
										<button class="btn btn-success btn-xs" data-title="previewPost"
											data-toggle="modal" data-target="#previewPost"  wire:click="dataSet( '{{ $data->id }}','activar')"> 
											<span class="fa fa-check-square-o"></span>
										</button>
									</p>

								</div>
							</div>
						</td>
					
					</tr>
					@endforeach
					@else
						<tb>
							<span>No hay posts</span>
						</tb>
					@endif



				</tbody>

			</table>

			@if($db->hasPages())
						<div class="divpag">
							{{ $db->links()}}
						</div>
			@endif

		</div>

	</div>
</div>

<!-- se guardo el review -->

<div class="container">
	<div class="modal fade" id="previewPost" tabindex="-1" role="dialog" aria-labelledby="previewPost"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content ">
				<div class="modal-header">
				<button type="button" class="close " data-dismiss="modal" aria-hidden="true" wire:click="resetData()"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<label>{{ $inputTitle }}</label>
				</div>
				<div class="modal-body">
					<img src="{{  mix('./public/storage/'. $inputFotoUrl )}}" alt="foto post" class="card-img-top img-thumbnail" alt="" height="350"  style="auto:compress; cs:tinysrgb;" width="50%">
					<p>{{ substr( $inputBody,0,100) }}</p>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-md-6">
							<button class="btn btn-warning btn-block" data-dismiss="modal" data-title="editPost"
								data-toggle="modal" data-target="#editPost" >Editar</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-success btn-block" data-dismiss="modal" wire:click="setPost()"
							
								data-toggle="modal" 
							>Activar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>

<div class="container">
	<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="editPost" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog" role="document">
			<div class="modal-content ">
				<div class="modal-header">
				<button type="button" class="close " data-dismiss="modal" aria-hidden="true" wire:click="resetData()"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<label>Titulo:</label>
					<input type="text" value="{{ $inputTitle }}"  class="form-control" wire:model.defer="inputTitle"></input>
				</div>
				<div class="modal-body">
					<label for="">Foto del post:</label>
					<input type="file" id="exampleInputFile" accept=".jpg, .jpeg, .png" value="{{$inputFotoUrl}}" wire:model.defer="inputFotoUrlNew">
					<label for="">Contenido del post:</label>
					<textarea
						class="form-control" wire:model.defer="inputBody" value="inputBody" > </textarea>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" 
								data-toggle="modal"  wire:click="editData()">Editar y Activar <i class="glyphicon glyphicon-ok-sign"></i></button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>


	<div class="container">
		<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal"
			aria-hidden="true" >
			<div class="modal-dialog " role="document">
				<div class="modal-content ">
				
									
						<div class="alert alert-warning modal-title">
						<button type="button" class="close " data-dismiss="modal" aria-hidden="true" wire:click="resetData()"><span
								class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
								<br>
							<span>Desea {{ $statPost }} el post?</span>
							
							<div class="mt-5">
								<button class="btn btn-danger btn-lg" data-dismiss="modal"  wire:click="resetData()">Cancelar</button>	
								<button class="btn btn-success btn-lg" wire:click="setPost()" data-dismiss="modal" 
								data-dismiss="modal"
								data-toggle="modal" 
								>Confirmar</button>
										
							</div>
					</div>
				
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>



	<script>
// Get a reference to our file input
// const fileInput = document.querySelector('input[type="file"]');
// const fil= @js($inputFotoUrl);

// console.log(fil);
// // Create a new File object
// const myFile = new File(['Selecciona un Archivo'], fil.files[0], {
// 	type: 'text/plain',
// 	lastModified: new Date(),
// });

// Now let's create a DataTransfer to get a FileList
// const dataTransfer = new DataTransfer();
// dataTransfer.items.add(myFile);
// fileInput.files = dataTransfer.files;
</script>




</section>
</x-body-wrapper>
<x-footer />
</div>
