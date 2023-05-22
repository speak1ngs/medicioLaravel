<div>
<x-header />
	<x-body-wrapper>
			<x-navigation-menu />
			<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

            <div class="py-5">
                    <div class="container well ">
                        <h2 class="text-center">Importes consulta</h2>

                        <div class="row bottom-password">

                            <div class="col-lg-6">
                            <div class="form-group">
                                    <label for="">Consultorio</label>
                                    <select id="inputState" class="form-control" wire:model="consultorio">
                                            <option selected>Seleccionar consultorio</option>
                                            @if(count($consu) >= 1)
                                                @foreach($consu as $con)
                                                    <option value="{{ $con->id }}">{{ $con->nombre }}</option>

                                                @endforeach
                                            @else
                                            <label">
                                                <span>No hay consultorios cargados</span>
                                            </label>>
                                            @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Importe consultas</label>
                                    <input type="text" placeholder="Gs.100.000.." class="form-control">
                                </div>
                            </div>


                        </div>

                

                        <button type="button" class="btn btn-skin btn-lg">Guardar</button>
                    </div>





                </div>



</section>
	</x-body-wrapper>
<x-footer/>
</div>
