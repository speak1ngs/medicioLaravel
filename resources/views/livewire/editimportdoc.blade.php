<div>
<x-header />
<x-body-wrapper>
	<x-navigation-menu-list />
	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	

<div class="container well">


	<div class="col-md-12">
		<h4 class="text-center">Editar Importe </h4>
		<div class="table-responsive">
				<div class="form-group col-md-3">
						<label for="">Mostrar</label>
						<select id="inputState" class="form-control" wire:model="cant">
								
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
						</select>
					</div>
					<div class="form-group col-md-8">
						<label for="">Buscar por cedula</label>
						<input type="text" class="form-control" wire:model="search">
					</div>

		@if(!empty($datos))
			<table id="mytable" class="table table-bordered table-striped">
              
				<thead>
					<th>Profesional</th>
					<th>Especialidad</th>
                    <th>Importe</th>
					<th>Cedula</th>
					<th>Modificar</th>
				</thead>
				<tbody>
				
					@foreach($datos as $dato)
					<tr>
					<td>{{ $dato->persnom . ' ' . $dato->persapell }}</td>
                        <td>{{ $dato->descripcion }}</td>
                        <td>{{ $dato->costo_consulta}}</td>
                        <td>{{ $dato->cedula }}</td>
                        <td>
                    
                                        <button class="btn btn-success btn-xs" data-title="doctorActive"
                                            data-toggle="modal" data-target="#asgiOp"  wire:click.prevent="sendData('{{ $dato->idcalen }}', '{{  $dato->persnom . ' ' . $dato->persapell  }}','{{ $dato->descripcion  }}')" ><span
                                                class="fa fa-check-square-o"></span>IMPORTE</button>
                    
                        </td>
				

					</tr>

				@endforeach
					

				</tbody>

			</table>
			@if($datos->hasPages())
			<div class="divpag">
				 {{ $datos->links()}}
			</div>
			@endif
		@else
			<div class="divpag">
					<label for="">

						No existe ningun registro coincidente
					</label>
			</div>
		@endif

		</div>

	</div>
</div>

<div class="container">
			<div class="modal fade" id="asgiOp" tabindex="-1" role="dialog" aria-labelledby="asgiOp" aria-hidden="true" wire:ignore.self>
				<div class="modal-dialog modal-content-scroll" role="document">
					<div class="modal-content">
						@if(!empty($nameDoc))

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign()">
								<span class="glyphicon glyphicon-remove" aria-hidden="true" ></span>
							</button>
							<h4 class="modal-title custom_align" id="Heading">Cambiar Importe</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<p class="text-center">Profesional: {{ $nameDoc }} <strong> </strong></p>
									</div>

									<div class="col-md-12">
										<label for="opNumber" class="text-left">Introduzca el nuevo importe:</label>
										<input type="text" class="form-control" id="opNumber" wire:model.defer="inputImport"
											placeholder="200000">
									</div>

								
								</div>
							</div>

						</div>
						<div class="modal-footer ">
							<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
								class="glyphicon glyphicon-ok-sign" 
								data-dismiss="modal" wire:click.prevent="upImport()" ><span></span>Modificar</button>
						</div>
						@else
							<div>
								<label for=""> No hay datos para mostrar</label>
							</div>
						@endif

					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</div>

 


</section>
</x-body-wrapper>
<x-footer/>

</div>
