<div wire:key="{{ $iden }}">

    @foreach($dat as $doc)
    <div class="cbp-l-member-img">
        <img src="{{ mix('./public/storage/'. $doc['foto_url'])}}" alt="">
    </div>
        <div class="cbp-l-member-info">
            <div class="cbp-l-member-name">{{ $doc['personas']->nombre . ' ' . $doc['personas']->apellido }}</div>
            <div class="cbp-l-member-position">
											<span class = "{{ $doc->calificacion >= 1 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->calificacion >= 2 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->calificacion >= 3 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->calificacion >= 4 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  
											<span class = "{{ $doc->calificacion >= 5 ? 'fa fa-star checked' :  'fa fa-star-o' }}"></span>  	
											</div>
            <div class="cbp-l-member-position">{{ $doc->calendarios_doctores->first()->especialidad->descripcion }}</div>
            <div class="cbp-l-member-desc">
                {{ $doc->descripcion }}
        </div>
    </div>
    @endforeach
</div>
