@extends('partials.admin')



@section('content')
<div class="row d-flex flex-row">
    <div class="p-2">
        <h3 class="text-primary">Listado de Empleados</h3>
    </div>
</div>

{{-- <a class="btn btn-success mt-3 mb-3" href="{{ route('empresa.create') }}">Crear</a> --}}


@include('partials.session-status')
@include('partials.session-error')
<p class="alert alert-info d-none d-sm-block animated fadeIn" >
    Desde aquí, podrá <strong>crear, editar</strong> o <strong>dar de baja</strong> un Empleado.
</p>
<table class="table table-bordered table-hover table-responsive-sm shadow table-sm">
    <thead class="bg-dark text-white">
        <tr>
            <td>
                Id
            </td>
            <td>
                Nombre Completo
            </td>
            <td>
                DNI
            </td>
            <td>
                Puesto    
            </td>
            <td>
                Estado    
            </td>           
            <td>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('empleado.create') }}" >
                        <button class="btn btn-success btn-sm" type="button"><i class="fa fw fa-plus"></i> Nuevo</button>
                    </a>
                </div>
            </td>
        </tr>
    </thead>
    <tbody>
        @if($empleados->count() == 0)
            <td style="background-color:gainsboro" colspan="5">No hay empleados registrados</td>
        @else
        @foreach ( $empleados as $empleado)
        @if ($empleado->alta == true)
            <tr>
        @else
            <tr style="background-color:gainsboro">
        @endif
       
            <td>
                {{ $empleado->id }}
            </td>
            <td>
                {{ $empleado->nombre }} {{$empleado->apellido}}
            </td>
            <td>
                {{ $empleado->dni }}
            </td>
            <td>
                {{ $empleado->puesto->nombre }}
            </td>
            @if ( $empleado->alta == true)
            <td>
                <b style="color: green">Alta</b>
            </td>
            @else
            <td>
                <b style="color: red">Baja</b>
            </td>
            @endif


            <td>
                <div class="d-flex justify-content-center">
                <a href="{{ route('empleado.show', $empleado->id)}}" class="btn btn-primary mr-2 btn-sm"><i class="fa fw fa-info"></i> Ver</a>
                <a href="{{ route('empleado.edit', $empleado->id)}}" class="btn btn-warning mr-2 btn-sm"><i class="fa fw fa-edit"></i> Editar</a>
                
                @if ($empleado->alta)
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{ $empleado->id }}"><i class="fas fa-user-slash"></i> Baja</button>
                @else
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#altaModal" data-id="{{ $empleado->id }}"><i class="fas fa-user"></i> Alta</button>
                @endif
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

{{ $empleados->links() }}

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
                <p>¿Seguro que desea dar de baja el empleado seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form  id="formDelete" action="{{ route('empleado.destroy',0) }}" method="POST" data-action="{{ route('empleado.destroy',0) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fas fa-user-slash"></i> Dar de Baja</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="altaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <p>¿Seguro que desea dar de alta el empleado seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form  id="formAlta" action="{{ route('empleado.alta',0) }}" method="POST" data-action="{{ route('empleado.alta',0) }}">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fas fa-user"></i> Dar de Alta</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
  modal.find('.modal-title').text('Vas a dar de baja el empleado con el id: ' + id)

})


$('#altaModal').on('show.bs.modal', function (event) {  
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  action2 = $('#formAlta').attr('data-action').slice(0,-1)
  action2 += id
  console.log(action2)

  $('#formAlta').attr('action', action2)  
  
  var modal2 = $(this)
  modal2.find('.modal-title').text('Vas a dar de alta el empleado con el id: ' + id)
})
}

// window.onload = function() {
    
// }

</script>

@endsection