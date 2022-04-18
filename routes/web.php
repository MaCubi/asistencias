<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HoraExtraController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\TipoEventoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IncidenciaHorariaController;


Route::get('/', function () {    
    if (Auth::user() != null) {
        return view('partials.admin');
    }else{
        return view('auth.login');
    }
    
});



Route::get('/admin', function () {
    return view('partials.admin');
});

Route::post('/registrar', [RegisterController::class, 'register'])->name('register.registrar');


//Inasistencia Automatica
Route::get('/inasistencia/add', [IncidenciaHorariaController::class, 'add'])->name('inasistencia.add');

//Empleados
Route::put('/empleadoalta/{empleado}', [EmpleadoController::class, 'alta'])->name('empleado.alta');
Route::get('/empleado/createfind', [EmpleadoController::class, 'createfind'])->name('empleado.createfind');
//Asistencias
Route::get('/asistencia/add', [AsistenciaController::class, 'add'])->name('asistencia.add');
Route::get('/asistencia/marcar', [AsistenciaController::class, 'marcar'])->name('asistencia.marcar');
Route::get('/jornada/editmodal', [JornadaController::class, 'editModal'])->name('jornada.editModal');

//PDF
Route::post('/generate-pdf', [PDFController::class, 'generatePDF'])->name('pdf.generar');
Route::get('/reporte/seleccionar-empleado', [PDFController::class, 'seleccionarEmpleado'])->name('pdf.seleccionar');

//Mis horarios personales
Route::get('/horario/mis_horarios',[HorarioController::class,'indexPersonal'])->name('horario.index_personal');

//Rutas Resource
Route::resource('/empresa', EmpresaController::class);
Route::resource('/area', AreaController::class);
Route::resource('/departamento', DepartamentoController::class);
Route::resource('/puesto', PuestoController::class);
Route::resource('/empleado', EmpleadoController::class);
Route::resource('/tipoevento', TipoEventoController::class);
Route::resource('/horario', HorarioController::class);
Route::resource('/jornada', JornadaController::class);
Route::resource('/horaextra', HoraExtraController::class);
Route::resource('/asistencia', AsistenciaController::class);
Route::resource('/user', UserController::class);
Route::resource('/role', RoleController::class);

//Rutas de Eventos/Incidencias
Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('event.destroy');
Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
Route::get('/event/create2', [EventController::class, 'create2'])->name('event.create2');
Route::get('/event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::put('/event/{event}', [EventController::class, 'update'])->name('event.update');
Route::get('/event/mostrar', [EventController::class, 'mostrar'])->name('event.mostrar');
Route::get('/event/personal', [EventController::class, 'personal'])->name('event.personal');
Route::get('/eventper', [EventController::class, 'indexper'])->name('event.indexper');
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/events', [EventController::class, 'index2'])->name('event.index2');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
Route::post('/event/editar/{id}', [EventController::class, 'editar'])->name('event.editar');
Route::get('/eventpersonal', [EventController::class, 'indexPersonal'])->name('event.indexpersonal');
Route::get('/eventpersonal/{event}', [EventController::class, 'showPersonal'])->name('event.showpersonal');

//Rutas de incidencias personales
Route::delete('/event2/{event}', [EventController::class, 'destroy2'])->name('event.destroy2');
Route::post('/event/store2', [EventController::class, 'store2'])->name('event.store2');
Route::get('/event/{event}/edit2', [EventController::class, 'edit2'])->name('event.edit2');
Route::put('/event2/{event}', [EventController::class, 'update2'])->name('event.update2');
Route::get('/events2', [EventController::class, 'index3'])->name('event.index3');
Route::get('/event2/{event}', [EventController::class, 'show2'])->name('event.show2');
Route::post('/event/editar/{id}', [EventController::class, 'editar'])->name('event.editar');
Route::get('/eventsall', [EventController::class, 'allIndex'])->name('event.all_index');
Route::get('/eventsall/{event}', [EventController::class, 'showAll'])->name('event.show_all');


//Route::get('/asistencia/marcar/{}', [AsistenciaController::class, 'marcar'])->name('asistencia.marcar');


//Horarios
//Route::get('/horarios-personal', [HorarioController::class, 'indexPersonal'])->name('horario.index_personal');


//Jornada
Route::post('/jornada/add/{horario}', [JornadaController::class, 'add'])->name('jornada.add');
Route::put('/jornada/update2/{jornada}', [JornadaController::class, 'update2'])->name('jornada.update2');




//IncidenciaHoraria-tardanza
Route::get('/incidencia-horaria-personal/index/{flag}', [IncidenciaHorariaController::class, 'indexPersonal'])->name('incidenciahoraria.index_personal');

Route::get('/incidencia-horaria/index/{flag}', [IncidenciaHorariaController::class, 'index'])->name('incidenciahoraria.index');
Route::get('/incidencia-horaria/create/{flag}', [IncidenciaHorariaController::class, 'create'])->name('incidenciahoraria.create');
Route::delete('/incidencia-horaria/{incidenciahoraria}', [IncidenciaHorariaController::class, 'destroy'])->name('incidenciahoraria.destroy');
Route::post('/incidencia-horaria/store', [IncidenciaHorariaController::class, 'store'])->name('incidenciahoraria.store');
Route::get('/incidencia-horaria/{incidenciahoraria}/edit', [IncidenciaHorariaController::class, 'edit'])->name('incidenciahoraria.edit');
Route::put('/incidencia-horaria/{incidenciahoraria}', [IncidenciaHorariaController::class, 'update'])->name('incidenciahoraria.update');
Route::get('/incidencia-horaria-personal/{incidenciahoraria}', [IncidenciaHorariaController::class, 'personal'])->name('incidenciahoraria.personal');
Route::get('/incidencia-horaria/{incidenciahoraria}', [IncidenciaHorariaController::class, 'show'])->name('incidenciahoraria.show');

//IncidenciaHoraria-retiros tempranos

//Ruta de Asistencias
// Index personal
Route::get('/mis-asistencias',[AsistenciaController::class, 'index'])->name('asistencia.index');
// Index general
Route::get('/lista-asistencias',[AsistenciaController::class,'indexAll'])->name('asistencia.indexall');
Route::get('/asistencia/{id}',[AsistenciaController::class, 'show'])->name('asistencia.show');
Route::get('/lista-asistencias/create',[AsistenciaController::class,'create'])->name('asistecia.create');
Route::post('lista-asistencias/store',[AsistenciaController::class,'store'])->name('asistencia.store');
Route::get('lista-asistencias/{asistencia}/edit',[AsistenciaController::class,'edit'])->name('asistencia.edit');
Route::put('lista-asistencias/{asistencia}',[AsistenciaController::class,'update'])->name('asistencia.update');
Route::delete('lista-asistencias/{asistencia}',[AsistenciaController::class,'destroy'])->name('asistencia.destroy');

//Horas Extras
Route::get('/horas-extras-personal', [HoraExtraController::class, 'indexPersonal'])->name('horaextra.index_personal');








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
