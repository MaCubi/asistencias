<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jornada;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }

    public function marcar()
    {
        $asistencia = Asistencia::where('verify', true)->first();

        if ($asistencia == null) {
            return view("asistencia/marcar");
        }else{
            return view("asistencia/marcar", ['asistencia' => $asistencia]);
        }
    }

    public function add()
    {
        
        $asistencia = Asistencia::where('verify', true)->first();
        $now = Carbon::now('GMT-3');
        $nowtitle = Carbon::now('GMT-3')->format('d-m-Y');
        $user = Auth::user();

        $horita = Carbon::now('GMT-3')->format('H:i');

        if($horita >= '12:00'){
            $jornada = Jornada::where('horario_id', $user->empleado->horario_id)->where('periodo', false)->first();
        }else{
            $jornada = Jornada::where('horario_id', $user->empleado->horario_id)->where('periodo', true)->first();
        };




        //aca tendria que estar la busqueda de los horarios del usuario registrado

        if ($asistencia == null) {
            $asistencia = new Asistencia();            
            

            if($horita > $jornada->entrada){
                $asistencia->title = 'Asistencia TARDE'.' '.$nowtitle.' '.$horita.' '.$jornada->entrada;
            }else{
                $asistencia->title = 'Asistencia'.' '.$nowtitle.$horita.$jornada->entrada;
            }
            
            $asistencia->verify = true;
            
            $asistencia->start = $now;
            $asistencia->end = $now;
            $asistencia->hora = 0;
            $asistencia->minuto = 0;
            
            $asistencia->tipoasistencia_id = 1;
            $asistencia->empleado_id = $user->empleado_id;
    
            $asistencia->save();
    
            return Redirect::to("asistencia/marcar")->with('status','Entrada Marcada');
        }else{
            
            $asistencia->verify = false;
            $asistencia->end = $now;

            //TESTEO DE CALCULO
            // $datetime = new Carbon('2021-11-27 19:53:50');
            // $asistencia->end = $datetime;

            $time = new Carbon($asistencia->start);

            $asistencia->hora = $time->diffInHours($asistencia->end);
            $asistencia->minuto = $time->diffInMinutes($asistencia->end);

            if ($asistencia->hora != 0) {
                $asistencia->minuto = $asistencia->minuto - (60 * $asistencia->hora);
            }
            

            $asistencia->save();




            return Redirect::to("asistencia/marcar")->with('status','Salida Marcada');

        }


    }
}
