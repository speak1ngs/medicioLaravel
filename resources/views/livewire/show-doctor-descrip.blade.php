<div>

    @foreach($dat as $doc)
    <div class="cbp-l-member-img">
        <img src="{{ mix('./public/storage/'. $doc['foto_url'])}}" alt="">
    </div>
        <div class="cbp-l-member-info">
            <div class="cbp-l-member-name">{{ $doc['persona']->nombre . ' ' . $doc['persona']->apellido }}</div>
            <div class="cbp-l-member-position">{{ $doc->calendarios_doctores->first()->especialidad->descripcion }}</div>
            <div class="cbp-l-member-desc">
                {{ $doc->descripcion }}
        </div>
    </div>
    @endforeach
</div>