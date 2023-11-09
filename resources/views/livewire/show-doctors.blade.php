<div>
<section id="doctor" class="home-section bg-gray paddingbot-60">
	<div class="container marginbot-50">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h2 class="h-bold">Profesionales</h2>
						<p>
							Nuestros mejores profesionales según nuestros usuarios.
						</p>
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>
	</div>
   
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div id="filters-container" class="cbp-l-filters-alignLeft">
					<div
						data-filter="*"
						class="cbp-filter-item-active cbp-filter-item"
					>
						All (
						<div class="cbp-filter-counter"></div>
						)
					</div>

                    @foreach($especialidades as $da)
                    <div data-filter=".{{ $da->descripcion}}" class="cbp-filter-item">
                    {{ $da->descripcion}} (
						<div class="cbp-filter-counter"></div>
						)
					</div>

                    @endforeach


				</div>
                @if(!empty($doctores))
				
				<div id="grid-container" class="cbp-l-grid-team">
					<ul>
                        @foreach($doctores as $doc)
						
						<li class="cbp-item {{ $doc->descripcion }}">
							<a
							
                                href="{{ route('show-doc', $doc->id) }}" 
								class="cbp-caption cbp-singlePage "
							>
								<div class="cbp-caption-defaultWrap">
									<img src="{{ mix('./public/storage/'. $doc->foto_url)}}" alt="" width="100%" />
								</div>
								<div class="cbp-caption-activeWrap">
									<div class="cbp-l-caption-alignCenter">
										<div class="cbp-l-caption-body">
											<div class="cbp-l-caption-text">VER PERFIL</div>
											<div>
											<span class = "{{ $doc->VAL >= 1 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->VAL >= 2 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->VAL >= 3 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->VAL >= 4 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->VAL >= 5 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  	
											</div>
										</div>
									</div>
								</div>
							</a>
			
		
		
							<a
                            href="{{ route('show-doc', $doc->id) }}" 
								class="cbp-singlePage cbp-l-grid-team-name text-rtn"
								>{{ $doc->nombre . ' ' . $doc->apellido }}</a
							>
							<div class="cbp-l-grid-team-position">{{ $doc->descripcion }}
							</div>
					
						
							
			
						</li>
						
                        @endforeach
						
					</ul>
				</div>
				@else
				<ul>
					<li>
						<a>Próximamente tendremos profesionales</a>
					</li>
				</ul>
				@endif
			</div>
		</div>
	</div>
</section>
</div>
