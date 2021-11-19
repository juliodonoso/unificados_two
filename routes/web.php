<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//*************************************** Calidad ***************************************

// Periodo 

Route::get('/periodo', [App\Http\Controllers\PeriodController::class, 'index'])->name('periodo');
Route::get('/periodo/cerrar/{id}', [App\Http\Controllers\PeriodController::class, 'close'])->name('pclose');
Route::get('/periodo/abrir', [App\Http\Controllers\PeriodController::class, 'abrir'])->name('popen');

// Importacion

Route::get('/importar', [App\Http\Controllers\ProposalController::class, 'index'])->name('importreg');
Route::post('/carga', [App\Http\Controllers\ProposalController::class, 'create'])->name('Cargaprop');
Route::post('/mntobd', [App\Http\Controllers\ProposalController::class, 'destroy'])->name('Mnto'); // Borrar archivos cargados ---- los coloca en 

// Busqueda

Route::get('/buscar', [App\Http\Controllers\ProposalController::class, 'show'])->name('buscar');
Route::POST('/consulta', [App\Http\Controllers\ProposalController::class, 'showb'])->name('buscarP');
Route::get('/pdfmodal/{idx}/{lbuscar}/{lopcion}', [App\Http\Controllers\ProposalController::class, 'pdfmail'])->name('pdfmail');

// Edicion de Propuestas Actuales

Route::get('/edicion/{ldid}', [App\Http\Controllers\ProposalController::class, 'edit'])->name('editp');
Route::POST('/editsafe/{Nrocar}/{ldid}', [App\Http\Controllers\ProposalController::class, 'update'])->name('editupdate');
Route::POST('/borrando', [App\Http\Controllers\ProposalController::class, 'borrarc'])->name('borrarc');


// Importar y ver pdf de las propuestas
Route::get('/pdfimport', [App\Http\Controllers\ProposalController::class, 'pdfindex'])->name('pdfindex');
Route::POST('/cargarpdf', [App\Http\Controllers\ProposalController::class, 'pdfUP'])->name('pdfcarga');
Route::POST('/verpdf', [App\Http\Controllers\ProposalController::class, 'pdfsee'])->name('pdfsee');

// Exportar Excel
Route::get('/export/{lopcion}/{lbuscar}', [App\Http\Controllers\ProposalController::class, 'export'])->name('excel');
Route::get('/exportmov/{sep}/{lbuscar}/{lopcion}', [App\Http\Controllers\ProposalController::class, 'expDuplic'])->name('exlduplic');

// Duplicidad

Route::get('/duplicidad', [App\Http\Controllers\ProposalController::class, 'duplicidad'])->name('duplic');
Route::POST('/cargadupl', [App\Http\Controllers\ProposalController::class, 'verifduplic'])->name('Verifd');
Route::get('/pdf/{sep}/{lbuscar}/{lopcion}', [App\Http\Controllers\ProposalController::class, 'pdfproposal'])->name('pdf');

Route::POST('/filtrar', [App\Http\Controllers\ProposalController::class, 'filtrar'])->name('filtrar');

// Update Gestion

Route::get('/upgestion', [App\Http\Controllers\ProposalController::class, 'updategestion'])->name('upgestion')->middleware('period','auth');
Route::POST('/updategt', [App\Http\Controllers\ProposalController::class, 'updateexcel'])->name('Upgtexcel');
Route::get('/up/{sep}', [App\Http\Controllers\ProposalController::class, 'pdfupdate'])->name('pdfup');

// Mantenimiento 

//Usuarios

Route::get('/usuarioslist', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'usersindex'])->name('editusers');
Route::POST('/usuariosedit', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'edituser'])->name('usersedit');
Route::POST('/updateusers/{luserid}', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'upuser'])->name('upusers');

// Reportes 

// Gestion

Route::get('/repgestion', [App\Http\Controllers\ReportController::class, 'index'])->name('repgestion');

// Conceptos

Route::get('/repconceptos', [App\Http\Controllers\ReportController::class, 'indexConcep'])->name('repconcep');
Route::POST('/ExportarConceptos', [App\Http\Controllers\ReportController::class, 'expConcep'])->name('excelconcep');

// diario

Route::get('/repdiario', [App\Http\Controllers\ReportController::class, 'indexdiario'])->name('diario');
Route::POST('/gendiario', [App\Http\Controllers\ReportController::class, 'dayreport'])->name('gendiario');

// Supervisores

Route::get('/superv', [App\Http\Controllers\ReportController::class, 'superv'])->name('superv');
Route::POST('/gensup', [App\Http\Controllers\ReportController::class, 'gensup'])->name('gensup');

// Devoluciones x Supervisor

Route::get('/devsup', [App\Http\Controllers\ReportController::class, 'devsup'])->name('devsup');
Route::POST('/gendev', [App\Http\Controllers\ReportController::class, 'gendev'])->name('gendev');

// txt

Route::get('/txt', [App\Http\Controllers\ReportController::class, 'txt'])->name('txt');
Route::POST('/gentxt', [App\Http\Controllers\ReportController::class, 'gentxt'])->name('gentxt');

// Llamadas

Route::get('/gtllamadas', [App\Http\Controllers\CallController::class, 'index'])->name('call');
Route::POST('/calls', [App\Http\Controllers\CallController::class, 'filtradas'])->name('callsf');
Route::get('/llamar/{ldid}', [App\Http\Controllers\CallController::class, 'gestion'])->name('callgt');
Route::POST('/savecall/{Nrocar}/{ldid}', [App\Http\Controllers\CallController::class, 'grabacall'])->name('grabarcall');


// Sacs
Route::get('/sacs', [App\Http\Controllers\CallController::class, 'indexsacs'])->name('callsacs');
Route::POST('/callsacs', [App\Http\Controllers\CallController::class, 'filtsacs'])->name('callsfsacs');
Route::get('/llsacs/{ldid}', [App\Http\Controllers\CallController::class, 'gtsacs'])->name('gtsacs');
Route::POST('/savesacs/{Nrocar}/{ldid}', [App\Http\Controllers\CallController::class, 'grabacallsacs'])->name('grabarsacs');


// Auditorias 

Route::get('/Audit', [App\Http\Controllers\Auditcontroller::class, 'index'])->name('ingresoaudit');

// Route::get('/audito', [App\Http\Controllers\Auditcontroller::class, 'indexfil'])->name('filtrarindex');


Route::POST('/combos', [App\Http\Controllers\Auditcontroller::class, 'combos'])->name('combos');


Route::get('/newAudit', [App\Http\Controllers\Auditcontroller::class, 'create'])->name('NewAudit');
Route::POST('/saveing', [App\Http\Controllers\Auditcontroller::class, 'grabaudi'])->name('gingreso');

Route::post('/del', [App\Http\Controllers\Auditcontroller::class, 'destroy'])->name('delereg');

// Correos de alertas

Route::get('/alertas/{idx}', [App\Http\Controllers\MailController::class, 'sendmail'])->name('alertmail');

// Exportar Excel 

Route::get('/export', [App\Http\Controllers\Auditcontroller::class, 'export'])->name('excelaud');

// reportes de auditoria

Route::get('/sponsor/index', [App\Http\Controllers\Auditcontroller::class, 'repSindex'])->name('indexSponsor');
Route::POST('/reportes/sponsor', [App\Http\Controllers\Auditcontroller::class, 'repsponsor'])->name('sponsor');
Route::get('/exportsponsor', [App\Http\Controllers\Auditcontroller::class, 'exportsponsor'])->name('excelsponsor');


Route::get('/ejecut/index', [App\Http\Controllers\Auditcontroller::class, 'repEindex'])->name('indexejecut');
Route::POST('/Reportes/ejecutivos', [App\Http\Controllers\Auditcontroller::class, 'repejecut'])->name('ejecut');
Route::get('/exportejecutivos', [App\Http\Controllers\Auditcontroller::class, 'exportejecut'])->name('excelejecut');


Route::get('/concep', [App\Http\Controllers\Auditcontroller::class, 'repcindex'])->name('conceptos');
Route::POST('/conceptos', [App\Http\Controllers\Auditcontroller::class, 'resultcpt'])->name('concept');


Route::get('/pruebas', [App\Http\Controllers\testcontoller::class, 'pruebas'])->name('pruebas');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Mantenedor de Auditoria

// Operadores 

Route::get('/teleoperadores', [App\Http\Controllers\Auditcontroller::class, 'teleop'])->name('teleop');
Route::get('/newoper', [App\Http\Controllers\Auditcontroller::class, 'newop'])->name('newoper');
Route::POST('/grabarOper', [App\Http\Controllers\Auditcontroller::class, 'grabaroper'])->name('upoper');
Route::POST('/editopers', [App\Http\Controllers\Auditcontroller::class, 'editop'])->name('opersedit');
Route::POST('/grabeditopers', [App\Http\Controllers\Auditcontroller::class, 'Grabeditop'])->name('Grabeditop');
Route::POST('/histope', [App\Http\Controllers\Auditcontroller::class, 'histope'])->name('histope');


// Campañas

Route::get('/campañas', [App\Http\Controllers\Auditcontroller::class, 'cias'])->name('companias');
Route::get('/newcia', [App\Http\Controllers\Auditcontroller::class, 'newcia'])->name('newcia');
Route::POST('/grabarcia', [App\Http\Controllers\Auditcontroller::class, 'upcia'])->name('upcia');
Route::POST('/editcia', [App\Http\Controllers\Auditcontroller::class, 'editcia'])->name('ciaedit');
Route::POST('/grabeditcias', [App\Http\Controllers\Auditcontroller::class, 'Grabeditcia'])->name('Grabeditcia');

