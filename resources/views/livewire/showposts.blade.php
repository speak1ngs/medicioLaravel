<div>
<section id="blog" class="home-section paddingtop-40">
	<div class="container">
		<div class="row">
   
			<div class="col-lg-6 col-lg-offset-3 text-center">
				<h2>
					<span class="ion-minus"></span>Publicaciones Médicas<span class="ion-minus"></span>
				</h2>
				<p>Aquí puede ver información útil y la más actualizada referente al mundo de la medicina. </p><br>
			</div>
		</div>
		
		<div class="row">
			<div id="slider" class="carousel slide"
			@if(!empty($db))
			
			@if(count($db) >= 10)
				data-ride="carousel"
			@endif
			@endif
			 >
				@if(!empty($db))
					@if(count($db) >=1)
					<ol class="carousel-indicators">
					@if ($db->onFirstPage())
						<li data-target="#slider" data-slide-to="0" class="active" wire:click="previousPage()"></li>
					@else
					<li data-target="#slider" data-slide-to="0" class="active" wire:click="previousPage()"></li>

					@endif
						<!-- <li data-target="#slider" data-slide-to="1"></li> -->
						@if ($db->hasMorePages())
						<li data-target="#slider" data-slide-to="{{ sizeof($db)+1 }}" wire:click="nextPage()"class="active"></li>
						@endif
					</ol>
					@endif
				@endif

				<!-- Carousel items -->
				<div class="carousel-inner">

					<div class="item active">
						<div class="row">
						
						@if(!empty($db))
							@if(count($db) == 10)
								@for ($i = 0; $i < sizeof($db); $i++)
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
										<div class="card text-center well">
										

											<img class="card-img-top"
												src="{{  mix('./public/storage/'. $db[$i]->foto_url) }}"
												alt=""   style="auto:compress; cs:tinysrgb;"  width="100%">
											<div class="card-block">
												<h6 class="card-title">{{ substr($db[$i]->titulo,0,20) . '...' }}</h6>
												<p class="card-text line-clamp"> {{  substr($db[$i]->body,0,60) }} </p>
												<a class="btn btn-skin btn-sm" wire:click="setData('{{ $db[$i]->id }}')"  >Leer más</a>
											</div>
										</div>
									</div>
								@endfor
							@elseif( count($db) >= 1 && count($db) <=5)
								@for ($i = 0; $i < sizeof($db); $i++)
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
										<div class="card text-center well">
									

											<img class="card-img-top"
												src="{{  mix('./public/storage/'. $db[$i]->foto_url) }}"
												alt=""   style="auto:compress; cs:tinysrgb; width:100%; height:200px" >
											<div class="card-block">
												<h6 class="card-title">{{ substr($db[$i]->titulo,0,20) . '...'}}</h6>
												<p class="card-text line-clamp">{{  substr($db[$i]->body,0,20) }}</p>
												<a class="btn btn-skin btn-sm" wire:click="setData('{{ $db[$i]->id }}')"  >Leer más</a>
											</div>
										</div>
									</div>
					
								@endfor

						@endif
				
					

						@else
							<a href="">no hay post a mostrar</a>
						@endif
						</div> <!-- row -->
					</div> <!-- item -->

					<div class="item">
						<div class="row">

						@if(!empty($db))
							@if(count($db) ==10)
								@for ($i = 5; $i < 9; $i++)
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
										<div class="card  text-center well">
											<img class="card-img-top center-block"
												src="{{  mix('./public/storage/'. $db[$i]->foto_url) }}"
												alt=""   style="auto:compress; cs:tinysrgb;">
											<div class="card-block">
												<h6 class="card-title">{{ substr($db[$i]->titulo,0,20) . '...' }}</h6>
												<p class="card-text line-clamp">{{ substr($db[$i]->body,0,60)}}</p>
												<a class="btn btn-skin btn-sm"  wire:click="setData('{{ $db[$i]->id }}')">Leer más</a>
											</div>
										</div>
									</div>
								@endfor
			
							@endif
				
					

						@else
							<span >no hay post a mostrar</span>
						@endif

						</div> <!-- row -->
					</div> <!-- item -->


				</div>

			</div>


		</div>

	</div>

	<div class="container" >
		<div class="modal fade" id="blogRead" tabindex="-1" role="dialog" aria-labelledby="blogRead" aria-hidden="true"  >
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-scroll">
				
						@if(!empty($titulo))
					
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="unsetData">
								<span
									class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
							<h4 class="modal-title custom_align text-center" id="Heading">{{ $titulo }}</h4>
						</div>
						<div class="modal-body">
						
								<div class="row mb-4 align-items-center flex-lg-row-reverse">
									<div class="col-md-6 col-xl-5">
										<div class="lc-block mb-4">
											<div editable="rich">

												<p class="text-left">
													{{ $bod }}
												</p>

											</div>
										</div>
									</div>
									<div class="col-md-6 col-xl-7 mb-4 mb-lg-0 ">

										<div class="lc-block position-relative img-thumbnail">
											<!-- <img class="img-fluid rounded shadow" src="./img/team/1.jpg"> -->
											<img class="card-img-top" alt="100%x180" src="{{ mix('./public/storage/'. $photo)}}"
												data-holder-rendered="true"
												style="height: 180px; width: 100%; display: block;">
										</div>
									</div>

								</div>
								
						</div>
					<!-- /.modal-content -->
					@else
					<span> no hay texto</span>
					@endif
					
				</div>
			
				<!-- /.modal-dialog -->
			
			</div>
		</div>


</section>
</div>

<script>
	window.addEventListener('openblogRead', event => {
		$("#blogRead").modal('show');
	})

	window.addEventListener('closeblogRead', event => {
		$("#blogRead").modal('hide');
	})
</script>


