@extends('partials.admin')


@section('content')


<div class="row d-flex flex-row">
    <div class="p-2">
        <h3 class="text-primary">{{ $horario->nombre }}
            <a href="{{ route('horario.edit',$horario->id) }}">
                <button class="btn btn-warning btn-circle btn-sm">
                    <i class="fa fw fa-edit"></i>
                </button>
            </a>
        </h3>

    </div>

    <div class="ml-auto p-2 d-flex align-items-center">
        <a href="{{ route('horario.index') }}">
            <button class="btn btn-info btn-circle"><i class="fa fw fa-arrow-left"></i></button>
        </a>
    </div>

</div> <!-- fin de row -->
@include('partials.session-status')
<div class="row py-2">
    <div class="col-md-12">
        <div class="card shadow border-bottom-info">
            <div class="card-body">
                <label class="control-label">
                    <strong>Nombre:</strong>
                    {{ $horario->nombre }}
                </label>

                <br>

                <label class="control-label">
                    <strong>Categoría:</strong>
                    {{ $horario->categoria->nombre }}
                </label>

                <br>

                <label class="control-label">
                    <strong>Tolerancia:</strong>
                    {{ $horario->tolerancia }} minutos
                </label>

                <hr>

                <table class="table table-bordered table-hover table-responsive-sm shadow table-sm">
                    <thead class="bg-dark text-white">
                        <tr>
                            <td>
                                Entrada
                            </td>
                            <td>
                                Salida    
                            </td>
                            <td>
                                Periodo
                            </td>          
                            <td>
                                <div class="d-flex justify-content-center">
                                    {{-- <a href="{{ route('jornada.create') }}" >                                         --}}
                                        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#createModal"><i class="fa fw fa-plus"></i> Nueva Jornada</button>
                                    {{-- </a> --}}
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                       @if($horario->jornadas->count() == 0)
                            <td style="background-color:gainsboro" colspan="4">No Hay Jornadas Agregadas</td>
                       @else
                       @foreach ( $horario->jornadas as $jornada)
                       <tr>
                            <td>
                                {{ $jornada->entrada }}
                            </td>
                            <td>
                                {{ $jornada->salida }}
                            </td>
                            <td>
                                @if ($jornada->periodo == 1)
                                    Mañana
                                @else
                                    Tarde
                                @endif                               
                            </td>
                
                            <td>
                                <div class="d-flex justify-content-center">                
                                <a href="{{ route('jornada.edit', $jornada->id)}}" class="btn btn-warning mr-2 btn-sm"><i class="fa fw fa-edit"></i> Editar</a>
                                
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{ $jornada->id }}"><i class="fas fa-trash"></i> Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif


                    </tbody>
                </table>

            </div>

            
        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Nueva Jornada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formCreate" action="{{ route('jornada.add', $horario) }}" method="POST" data-action="{{ route('jornada.add', $horario) }}">
                    @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="entrada">Entrada</label>
                        <input class="form-control form-control-sm" type="time" name="entrada" id="entrada"  required autofocus autocomplete="off"> 
                    
                        @error('entrada')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror   
                    
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="salida">Salida</label>
                        <input class="form-control form-control-sm" type="time" name="salida" id="salida"  required autofocus autocomplete="off"> 
                    
                        @error('salida')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror   
                    
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="salida">Salida</label>
                        <input class="form-control form-control-sm" type="time" name="salida" id="salida"  required autofocus autocomplete="off"> 
                    
                        @error('salida')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror   
                    
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
                   
                    
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- fin de row -->


@endsection