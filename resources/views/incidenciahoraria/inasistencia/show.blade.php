@extends('partials.admin')


@section('content')


<div class="row d-flex flex-row">
    <div class="p-2">
        <h3 class="text-primary">Detalles de la Inasistencia
            <a href="{{ route('incidenciahoraria.edit',$incidenciahoraria->id) }}">
                <button class="btn btn-warning btn-circle btn-sm">
                    <i class="fa fw fa-edit"></i>
                </button>
            </a>
        </h3>

    </div>

    <div class="ml-auto p-2 d-flex align-items-center">
        <a href="{{ route('incidenciahoraria.index',3) }}">
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
                    <strong>Empleado:</strong>
                    {{ $incidenciahoraria->empleado->nombre }} {{ $incidenciahoraria->empleado->apellido }}
                </label>

                <br>

                <label class="control-label">
                    <strong>Fecha:</strong>
                    {{ $incidenciahoraria->fecha }}
                </label>

                <br>

                <label class="control-label">
                    <strong>Justificada:</strong>
                    @if ($incidenciahoraria->justificacion)
                        Si
                    @else
                        No
                    @endif                    
                </label>

                <br>

                <label class="control-label">
                    <strong>Descripción:</strong>
                    {{ $incidenciahoraria->descripcion }}
                </label>

            </div>


        </div>
    </div>
</div>









@endsection