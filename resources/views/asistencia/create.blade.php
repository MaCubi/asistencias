@extends('partials.admin')

@section('content')

<div class="row d-flex flex-row">
    <div class="p-2">
        <h3 class="text-primary">Registrar una Asistencia</h3>
    </div>
    <div class="ml-auto p-2 d-flex align-items-center">
        <a href="{{ route('asistencia.indexall') }}">
            <button class="btn btn-info btn-circle"><i class="fa fw fa-arrow-left"></i></button>
        </a>
    </div>
</div>

<!-- Formulario para dar de alta una asistencia -->
<form action="{{ route('asistencia.store') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-body">

            <!-- Select de Empleados -->
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="empleado_id">Empleado</label>
                    <select class="form-control form-control-sm" name="empleado_id" id="empleado_id">
                        @foreach ($empleados as $empleado)
                        <option {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}
                            value="{{ $empleado->id}}"> 
                                {{ $empleado->nombre}} {{ $empleado->apellido}}
                        </option>
                        @endforeach
                    </select>
            
                    @error('empleado_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
            
                </div>
            </div>
    
            {{-- Hora de entrada --}}
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="start">Entrada</label>
                        <input class="form-control form-control-sm" type="datetime-local" name="start" id="start" required autofocus
                        autocomplete="off" value="{{ old('start')}}" max="<?php $hoy=date("Y-m-d\TH:i"); echo $hoy;?>">
            
                    @error('start')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
            
                </div>
            
            </div>

            {{-- Hora de salida --}}
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="end">Salida</label>
                    <input class="form-control form-control-sm" type="datetime-local" name="end" id="end" required autofocus
                        autocomplete="off" value="{{ old('end')}}" max="<?php $hoy=date("Y-m-d\TH:i"); echo $hoy;?>">
            
                    @error('end')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
            
                </div>
            </div>

            <!-- Boton de guardar -->
            <div class="row col-md-6 mb-3">
                <input class="btn btn-primary" type="submit" value="Guardar">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#empleado_id').select2();        
        });
    
        $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
      });
    </script>

</form>

@endsection