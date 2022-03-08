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

                {{-- jornadas --}}
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
                                Dias
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
                                @if ($jornada->isLunes == true)
                                    Lu                                
                                @endif  
                                @if ($jornada->isMartes == true)
                                    Ma                          
                                @endif 
                                @if ($jornada->isMiercoles == true)
                                    Mi                                 
                                @endif 
                                @if ($jornada->isJueves == true)
                                    Ju                                
                                @endif 
                                @if ($jornada->isViernes == true)
                                    Vi                                
                                @endif 
                                @if ($jornada->isSabado == true)
                                    Sa                                 
                                @endif 
                                @if ($jornada->isDomingo == true)
                                    Do                                 
                                @endif                              
                            </td>
                
                            <td>
                                <div class="d-flex justify-content-center">                
                                {{-- <a href="{{ route('jornada.edit', $jornada->id)}}" class="btn btn-warning mr-2 btn-sm"><i class="fa fw fa-edit"></i> Editar</a> --}}
                                <button class="btn btn-warning btn-detail open_modal mr-2 btn-sm" value="{{$jornada->id}}"><i class="fa fw fa-edit"></i> Editar</button>
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
    <div class="modal-dialog" role="document">
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
                        <input class="form-control form-control-sm" type="time" name="entrada" id="entrada"  required autofocus> 
                    
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
                <div class="row">                    
                        <div class="form-group col-md-3 mb-3">
                            {{-- @if ($tipoevento->general == true)
                                <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                            @else --}}
                                <input class="col-form-check-input" type="checkbox" name="isLunes" id="isLunes">
                            {{-- @endif --}}
                            <label class="col-form-check-label " for="isLunes">
                                Lunes
                            </label>
                        
                        </div>
                        <div class="form-group col-md-3 mb-3">
                            {{-- @if ($tipoevento->general == true)
                                <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                            @else --}}
                                <input class="col-form-check-input" type="checkbox" name="isMartes" id="isMartes">
                            {{-- @endif --}}
                            <label class="col-form-check-label " for="isMartes">
                                Martes
                            </label>
                        
                        </div>         
                        
                        <div class="form-group col-md-3 mb-3">
                            {{-- @if ($tipoevento->general == true)
                                <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                            @else --}}
                                <input class="col-form-check-input" type="checkbox" name="isMiercoles" id="isMiercoles">
                            {{-- @endif --}}
                            <label class="col-form-check-label " for="isMiercoles">
                                Miercoles
                            </label>
                        
                        </div>  
                
                </div>
                

                <div class="row">                    
                    <div class="form-group col-md-3 mb-3">
                        {{-- @if ($tipoevento->general == true)
                            <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                        @else --}}
                            <input class="col-form-check-input" type="checkbox" name="isJueves" id="isJueves">
                        {{-- @endif --}}
                        <label class="col-form-check-label " for="isJueves">
                            Jueves
                        </label>
                    
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{-- @if ($tipoevento->general == true)
                            <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                        @else --}}
                            <input class="col-form-check-input" type="checkbox" name="isViernes" id="isViernes">
                        {{-- @endif --}}
                        <label class="col-form-check-label " for="isViernes">
                            Viernes
                        </label>
                    
                    </div>         
                    
                    <div class="form-group col-md-3 mb-3">
                        {{-- @if ($tipoevento->general == true)
                            <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                        @else --}}
                            <input class="col-form-check-input" type="checkbox" name="isSabado" id="isSabado">
                        {{-- @endif --}}
                        <label class="col-form-check-label " for="isSabado">
                            Sabado
                        </label>
                    
                    </div>  
            
            </div>

            <div class="row">

                <div class="form-group col-md-3 mb-3">
                    {{-- @if ($tipoevento->general == true)
                        <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                    @else --}}
                        <input class="col-form-check-input" type="checkbox" name="isDomingo" id="isDomingo">
                    {{-- @endif --}}
                    <label class="col-form-check-label " for="isDomingo">
                        Domingo
                    </label>
                
                </div>  

            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                   
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Editar Jornada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @isset($jornada)    
                                   
                <form  id="formEdit" action="{{ route('jornada.update2', $jornada) }}" method="POST" data-action="{{ route('jornada.update2', $jornada) }}">
                    @method('PUT')
                    @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="entradaEdit">Entrada</label>
                        <input class="form-control form-control-sm" type="time" name="entradaEdit" id="entradaEdit"  required autofocus> 
                    
                        @error('entradaEdit')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror   
                    
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="salidaEdit">Salida</label>
                        <input class="form-control form-control-sm" type="time" name="salidaEdit" id="salidaEdit"  required autofocus autocomplete="off"> 
                    
                        @error('salidaEdit')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror   
                    
                    </div>
                </div>
                <div class="row">                    
                        <div class="form-group col-md-3 mb-3">
                            {{-- @if ($tipoevento->general == true)
                                <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                            @else --}}
                                <input class="col-form-check-input" type="checkbox" name="isLunesEdit" id="isLunesEdit">
                            {{-- @endif --}}
                            <label class="col-form-check-label " for="isLunesEdit">
                                Lunes
                            </label>
                        
                        </div>
                        <div class="form-group col-md-3 mb-3">
                            {{-- @if ($tipoevento->general == true)
                                <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                            @else --}}
                                <input class="col-form-check-input" type="checkbox" name="isMartesEdit" id="isMartesEdit">
                            {{-- @endif --}}
                            <label class="col-form-check-label " for="isMartesEdit">
                                Martes
                            </label>
                        
                        </div>         
                        
                        <div class="form-group col-md-3 mb-3">
                            {{-- @if ($tipoevento->general == true)
                                <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                            @else --}}
                                <input class="col-form-check-input" type="checkbox" name="isMiercolesEdit" id="isMiercolesEdit">
                            {{-- @endif --}}
                            <label class="col-form-check-label " for="isMiercolesEdit">
                                Miercoles
                            </label>
                        
                        </div>  
                
                </div>
                

                <div class="row">                    
                    <div class="form-group col-md-3 mb-3">
                        {{-- @if ($tipoevento->general == true)
                            <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                        @else --}}
                            <input class="col-form-check-input" type="checkbox" name="isJuevesEdit" id="isJuevesEdit">
                        {{-- @endif --}}
                        <label class="col-form-check-label " for="isJuevesEdit">
                            Jueves
                        </label>
                    
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{-- @if ($tipoevento->general == true)
                            <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                        @else --}}
                            <input class="col-form-check-input" type="checkbox" name="isViernesEdit" id="isViernesEdit">
                        {{-- @endif --}}
                        <label class="col-form-check-label " for="isViernesEdit">
                            Viernes
                        </label>
                    
                    </div>         
                    
                    <div class="form-group col-md-3 mb-3">
                        {{-- @if ($tipoevento->general == true)
                            <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                        @else --}}
                            <input class="col-form-check-input" type="checkbox" name="isSabadoEdit" id="isSabadoEdit">
                        {{-- @endif --}}
                        <label class="col-form-check-label " for="isSabadoEdit">
                            Sabado
                        </label>
                    
                    </div>  
            
            </div>

            <div class="row">

                <div class="form-group col-md-3 mb-3">
                    {{-- @if ($tipoevento->general == true)
                        <input class="col-form-check-input" type="checkbox" name="general" id="general" checked>
                    @else --}}
                        <input class="col-form-check-input" type="checkbox" name="isDomingoEdit" id="isDomingoEdit">
                    {{-- @endif --}}
                    <label class="col-form-check-label " for="isDomingoEdit">
                        Domingo
                    </label>
                
                </div>
                <input type="hidden" id="jornada_id" name="jornada_id" value="0">
  

            </div>
            @endisset
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                   
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Seguro que desea borrar el registro seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form  id="formDelete" action="{{ route('jornada.destroy',0) }}" method="POST" data-action="{{ route('jornada.destroy',0) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- fin de row -->


<script>
    window.onload = function() {
    $('#deleteModal').on('show.bs.modal', function (event) {  
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  action = $('#formDelete').attr('data-action').slice(0,-1)
  action += id
  console.log(action)

  $('#formDelete').attr('action', action)
  
  
  var modal = $(this)
  modal.find('.modal-title').text('Vas a borrar la Jornada con el id: ' + id)
})
}



$(document).ready(function () {
    $(document).on('click','.open_modal', function() {
        var jornada_id = $(this).val();
        
        // var op = " ";
        $.ajax({
            type: 'get',
            url: '{!!URL::to('/jornada/editmodal')!!}',
            data: {'id':jornada_id},
            success: function(data){
                console.log(data);
                $('#jornada_id').val(data.id);
                $('#entradaEdit').val(data.entrada);
                $('#salidaEdit').val(data.salida);
                if(data.isLunes == 1){
                    $('#isLunesEdit').prop("checked", true);
                }else{
                    $('#isLunesEdit').prop("checked", false);
                }
                if(data.isMartes == 1){
                    $('#isMartesEdit').prop("checked", true);
                }else{
                    $('#isMartesEdit').prop("checked", false);
                }
                if(data.isMiercoles == 1){
                    $('#isMiercolesEdit').prop("checked", true);
                }else{
                    $('#isMiercolesEdit').prop("checked", false);
                }
                if(data.isJueves == 1){
                    $('#isJuevesEdit').prop("checked", true);
                }else{
                    $('#isJuevesEdit').prop("checked", false);
                }
                if(data.isViernes == 1){
                    $('#isViernesEdit').prop("checked", true);
                }else{
                    $('#isViernesEdit').prop("checked", false);
                }
                if(data.isSabado == 1){
                    $('#isSabadoEdit').prop("checked", true);
                }else{
                    $('#isSabadoEdit').prop("checked", false);
                }
                if(data.isDomingo == 1){
                    $('#isDomingoEdit').prop("checked", true);
                }else{
                    $('#isDomingoEdit').prop("checked", false);
                }

                $('#editModal').modal('show');
            },
            error: function(){
                console.log('success');
            },
        });
    });
});

</script>


@endsection