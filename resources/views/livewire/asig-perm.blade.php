<div>
    <x-header />
    <x-body-wrapper >
    <x-navigation-menu-list />
        <section id="register " class="home-section paddingtop-130 h-100 h-custom well">
                    <div class="container well">

                        <div class="col-md-12">
                        <h4 class="text-center">Asignar rol </h4>
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
                                        <label for="">Buscar por nombre</label>
                                        <input type="text" class="form-control" wire:model="search">
                                    </div>

                                        @if(!empty($user))
                                    <table id="mytable" class="table table-bordered table-striped">
                                    
                                        <thead>
                                            <th>Nombre y Apellido </th>
                                            <th>Email</th>
                                            <th>Tipo</th>           
                                            <th>Asignar</th>
                                            <th>Revocar</th>
                                        </thead>
                                        <tbody>
                                
                                    @foreach($user as $dato)


                                    <tr>
                                            <td>{{ $dato->personas->nombre . ' ' . $dato->personas->apellido}}</td>
                                            <td>{{ $dato->email}}</td>
                                            <td>{{ sizeof($dato->getRoleNames()) === 0 ? 'SIN ROL' :  $dato->getRoleNames() }}</td>
                                            <td>
                                        
                                                            <button class="btn btn-success btn-xs" data-title="asigRol"
                                                                data-toggle="modal" data-target="#Asignar"  wire:click="showUser('{{$dato->id}}','{{$dato->personas->nombre . ' ' . $dato->personas->apellido}}', {{ $dato->getRoleNames() }})" ><span
                                                                    class="fa fa-check-square-o">Asignar Rol</span></button>
                                        
                                            </td>
                                            <td>
                                        
                                        <button class="btn btn-danger btn-xs" data-title="asigRol"
                                            data-toggle="modal" data-target="#Quitar"  wire:click="revokeRolUser('{{$dato->id}}','{{$dato->personas->nombre . ' ' . $dato->personas->apellido}}', {{ $dato->getRoleNames() }})" ><span
                                                class="fa fa-check-square-o">Quitar Rol</span></button>
                    
                        </td>

                                        </tr>


                                            @endforeach
                                                

                                            </tbody>

                                        </table>
                                        @if($user->hasPages())
                                        <div class="divpag">
                                            {{ $user->links()}}
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

        
        <section >



        <div class="container"  >
            <div class="modal fade" id="Asignar" tabindex="-1" role="dialog" aria-labelledby="Asignar Rol" aria-hidden="true"  wire:ignore.self >
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-scroll">
    
                    @if($Rol)
    
                        <div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign" ><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align text-center" id="Heading">{{ $nameUser  }}</h4>
                        </div>

                        <div class="modal-body">
                            <label class="text-left">Roles disponibles:</label>
                                <div class="frb-group">
                                    <div class="row center-block">
                                    @foreach($Rol as $arr )
                                        <div class="col-md-4">
                                            <div class="frb frb-success">
                                                <input type="checkbox" id="checkbox-{{ $arr['id']}}1" name="checkbox-{{ $arr['id']}}1"  wire:model.defer="inputRol" value="{{ $arr['id'] }}">
                                                <label for="checkbox-{{ $arr['id']}}1">
                                        
                                                    <span class="frb-description">{{ $arr['name']}}</span>
                                                </label>
                                            </div>

                                        </div>
                                        @endforeach
                
                                    </div>
                                </div>
                            
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
                                data-title="asigTime" data-toggle="modal" data-target=""
                                data-dismiss="modal" wire:click="asigRol()"><span class="glyphicon glyphicon-ok-sign"></span>Asignar Rol</button>
                        </div>
                        @else
                        <label for="">Error al asignar rol</label>
                        @endif
                    </div>
                
                </div>
            
            </div>
	    </div>


        <div class="container"  >
            <div class="modal fade" id="Quitar" tabindex="-1" role="dialog" aria-labelledby="Quitar Rol" aria-hidden="true"  wire:ignore.self >
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-scroll">
                  
                    @if($RolRevoke)
    
                        <div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="closeModalAsign" ><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align text-center" id="Heading">{{ $nameUser  }}</h4>
                        </div>

                        <div class="modal-body">
                            <label class="text-left">Roles disponibles:</label>
                                <div class="frb-group">
                                    <div class="row center-block">
                                    @foreach($RolRevoke as $arr => $val)
                                        <div class="col-md-4">
                                            <div class="frb frb-success">
                                                <input type="checkbox" id="checkbox-{{ $val['id']}}1" name="checkbox-{{ $val['id']}}1"  wire:model.defer="inputRevoke" value="{{ $val['id'] }}">
                                                <label for="checkbox-{{ $val['id']}}1">
                                        
                                                    <span class="frb-description">{{ $val['name']}}</span>
                                                </label>
                                            </div>

                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"
                                data-title="asigTime" data-toggle="modal" data-target=""
                                data-dismiss="modal" wire:click="revokeRol()"><span class="glyphicon glyphicon-ok-sign"></span>Revocar Rol</button>
                        </div>
                        @else
                        <label for="">Error al asignar rol</label>
                        @endif
                    </div>
                
                </div>
            
            </div>
	    </div>
    </x-body-wrapper>
    <x-footer />
</div>
