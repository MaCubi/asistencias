@extends('partials.admin')


@section('content')


<div class="row d-flex flex-row">
    <div class="p-2">
        <h3 class="text-primary">Detalles de la Hora Extra
            <a href="{{ route('horaextra.edit',$horaextra->id) }}">
                <button class="btn btn-warning btn-circle btn-sm">
                    <i class="fa fw fa-edit"></i>
                </button>
            </a>
        </h3>

    </div>

    <div class="ml-auto p-2 d-flex align-items-center">
        <a href="{{ route('horaextra.index') }}">
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
                    {{ $horaextra->empleado->nombre }} {{ $horaextra->empleado->apellido }}
                </label>

                <br>

                <label class="control-label">
                    <strong>Entrada:</strong>
                    {{ $horaextra->start }}
                </label>

                <br>

                <label class="control-label">
                    <strong>Salida:</strong>
                    {{ $horaextra->end }}
                </label>

                <br>

                <label class="control-label">
                    <strong>Tiempo Trabajado:</strong>
                    @if ($horaextra->hora < 10)
                        0{{ $horaextra->hora }}
                    @else
                        {{ $horaextra->hora }}
                    @endif
                        :
                    @if ($horaextra->minuto < 10)
                        0{{ $horaextra->minuto }}
                    @else
                        {{ $horaextra->minuto }}
                    @endif
                </label>

            </div>


        </div>
    </div>
</div>









@endsection