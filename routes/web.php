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

Route::get('/Periodo', [App\Http\Controllers\PeriodController::class, 'index'])->name('periodo');
Route::get('/Periodo/cerrar/{id}', [App\Http\Controllers\PeriodController::class, 'close'])->name('pclose');
Route::get('/Periodo/abrir', [App\Http\Controllers\PeriodController::class, 'abrir'])->name('popen');

// Importacion

Route::get('/importar', [App\Http\Controllers\ProposalController::class, 'index'])->name('Importreg');
Route::post('/Carga', [App\Http\Controllers\ProposalController::class, 'create'])->name('Cargaprop');
Route::post('/MntoBD', [App\Http\Controllers\ProposalController::class, 'destroy'])->name('Mnto'); // Borrar archivos cargados ---- los coloca en 

// Busqueda

Route::get('/buscar', [App\Http\Controllers\ProposalController::class, 'show'])->name('buscar');
Route::POST('/consulta', [App\Http\Controllers\ProposalController::class, 'showb'])->name('buscarP');
Route::get('/pdfmodal/{idx}/{lbuscar}/{lopcion}', [App\Http\Controllers\ProposalController::class, 'pdfmail'])->name('pdfmail');

// Edicion de Propuestas Actuales

Route::get('/Edicion/{ldid}', [App\Http\Controllers\ProposalController::class, 'edit'])->name('editp');
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
Route::POST('/CargaDupl', [App\Http\Controllers\ProposalController::class, 'verifduplic'])->name('Verifd');
Route::get('/pdf/{sep}/{lbuscar}/{lopcion}', [App\Http\Controllers\ProposalController::class, 'pdfproposal'])->name('pdf');

Route::POST('/filtrar', [App\Http\Controllers\ProposalController::class, 'filtrar'])->name('filtrar');

// Update Gestion

Route::get('/upgestion', [App\Http\Controllers\ProposalController::class, 'updategestion'])->name('upgestion')->middleware('period','auth');
Route::POST('/updategt', [App\Http\Controllers\ProposalController::class, 'updateexcel'])->name('Upgtexcel');
Route::get('/up/{sep}', [App\Http\Controllers\ProposalController::class, 'pdfupdate'])->name('pdfup');


// Mantenimiento 

//Usuarios

Route::get('/Usuarioslist', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'usersindex'])->name('editusers');
Route::POST('/Usuariosedit', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'edituser'])->name('usersedit');
Route::POST('/updateusers/{luserid}', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'upuser'])->name('upusers');

Route::get('/pruebas', [App\Http\Controllers\HomeController::class, 'pruebas'])->name('pruebas');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Reportes 

// Gestion

Route::get('/Repgestion', [App\Http\Controllers\ReportController::class, 'index'])->name('repGestion');

// Conceptos

Route::get('/Repconceptos', [App\Http\Controllers\ReportController::class, 'indexConcep'])->name('repconcep');
Route::POST('/ExportarConceptos', [App\Http\Controllers\ReportController::class, 'expConcep'])->name('excelconcep');

// diario

Route::get('/Repdiario', [App\Http\Controllers\ReportController::class, 'indexdiario'])->name('diario');
Route::POST('/gendiario', [App\Http\Controllers\ReportController::class, 'dayreport'])->name('gendiario');

// Supervisores

Route::get('/Superv', [App\Http\Controllers\ReportController::class, 'superv'])->name('superv');
Route::POST('/gensup', [App\Http\Controllers\ReportController::class, 'gensup'])->name('gensup');

// Devoluciones x Supervisor

Route::get('/devsup', [App\Http\Controllers\ReportController::class, 'devsup'])->name('devsup');
Route::POST('/gendev', [App\Http\Controllers\ReportController::class, 'gendev'])->name('gendev');



// txt

Route::get('/txt', [App\Http\Controllers\ReportController::class, 'txt'])->name('txt');
Route::POST('/gentxt', [App\Http\Controllers\ReportController::class, 'gentxt'])->name('gentxt');






// Llamadas


Route::get('/gtllamadas', [App\Http\Controllers\CallController::class, 'index'])->name('call');
Route::POST('/callS', [App\Http\Controllers\CallController::class, 'filtradas'])->name('callsf');
Route::get('/llamar/{ldid}', [App\Http\Controllers\CallController::class, 'gestion'])->name('callgt');
Route::POST('/savecall/{Nrocar}/{ldid}', [App\Http\Controllers\CallController::class, 'grabacall'])->name('grabarcall');


// Sacs
Route::get('/sacs', [App\Http\Controllers\CallController::class, 'indexsacs'])->name('callsacs');
Route::POST('/callSacs', [App\Http\Controllers\CallController::class, 'filtsacs'])->name('callsfsacs');
Route::get('/llsacs/{ldid}', [App\Http\Controllers\CallController::class, 'gtsacs'])->name('gtsacs');
Route::POST('/savesacs/{Nrocar}/{ldid}', [App\Http\Controllers\CallController::class, 'grabacallsacs'])->name('grabarsacs');






// Auditorias 

Route::get('/Audit', [App\Http\Controllers\AuditController::class, 'index'])->name('ingresoAudit');
Route::get('/newAudit', [App\Http\Controllers\AuditController::class, 'create'])->name('NewAudit');
Route::POST('/saveing', [App\Http\Controllers\AuditController::class, 'grabaudi'])->name('gingreso');

// Correos de alertas

Route::get('/alertas/{idx}', [App\Http\Controllers\MailController::class, 'sendmail'])->name('alertmail');







