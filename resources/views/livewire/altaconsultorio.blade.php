<div>
<x-header />
<x-body-wrapper>
<x-navigation-menu-list />
	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	

<div class="container well">


	<div class="col-md-12">
		<h4 class="text-center">Alta Consultorio </h4>
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
					<div class="form-group col-md-4">
						<label for="">Buscar por nombre</label>
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

		@if(count($datos))
			<table id="mytable" class="table table-bordered table-striped">
			
				<thead>
					<th>Consultorio</th>
					<th>Estado</th>
					<th>Desactivar</th>
					<th>Activar</th>
				</thead>
				<tbody>
				@foreach($datos as $dato)
					<tr>

						<td>{{ $dato->nombre }}</td>
						<td>{{ $dato->estado }}</td>

						<td>
							<div class="row" >
								<div class="form-group col-sm-4 bottom-p text-center">
									<p data-placement="top" data-toggle="tooltip" title="Desactivar"
										class="bottom-p">
										<button class="btn btn-danger btn-xs" data-title="doctorActive"
											data-toggle="modal"  wire:click="upState({{ $dato->id}}, 1)" ><span
												class="fa fa-remove"></span></button>
									</p>
								</div>

							</div>

						</td>
						<td>
					
										<button class="btn btn-success btn-xs" data-title="doctorActive"
											data-toggle="modal"   wire:click="upState({{ $dato->id}}, 2)" ><span
												class="fa fa-check-square-o"></span></button>
					
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

<!-- se guardo el review -->

<div class="container">
	<div class="modal fade" id="doctorActive" tabindex="-1" role="dialog" aria-labelledby="doctorActive"
		aria-hidden="true">
		<div class="modal-dialog modal-confirm" role="document">
			<div class="modal-content ">
				<div class="modal-header">
					<div class="icon-box">
						<i class="material-icons">&#xE876;</i>
					</div>
					<h4 class="modal-title w-100">Profesional {{ $stat }}</h4>
				</div>

				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" wire:click="$emit('render')">OK</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>

<!-- comentario fallido  -->

<div class="container">
	<div class="modal fade" id="failAlt" tabindex="-1" role="dialog" aria-labelledby="failAlt" aria-hidden="true">
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



</section>
</x-body-wrapper>
<x-footer/>

</div>
