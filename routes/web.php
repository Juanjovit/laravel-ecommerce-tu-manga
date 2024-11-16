<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






//Home
Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('home');

//Perfil
Route::get('/perfil/{id}', [\App\Http\Controllers\HomeController::class, 'perfil'])
    ->name('perfil')
    ->middleware(['verificar-usuario']);
Route::get('perfil/{id}/editar-password', [\App\Http\Controllers\AuthController::class, 'editarPassword'])
    ->name('editarPassword')
    ->middleware(['verificar-usuario']);
Route::post('perfil/{id}/editar-password', [\App\Http\Controllers\AuthController::class, 'processEditarPassword'])
    ->name('processEditarPassword')
    ->middleware(['verificar-usuario']);
Route::get('perfil/{id}/compra/{compra_id}', [\App\Http\Controllers\HomeController::class, 'verCompra'])
    ->name('verCompra')
    ->middleware(['verificar-usuario']);


//Auth
Route::get('iniciar-sesion', [\App\Http\Controllers\AuthController::class, 'formLogin'])
    ->name('auth.formLogin');
Route::post('iniciar-sesion', [\App\Http\Controllers\AuthController::class, 'processLogin'])
    ->name('auth.processLogin');
Route::post('cerrar-sesion', [\App\Http\Controllers\AuthController::class, 'processLogout'])
    ->name('auth.processLogout');    

Route::get('registrarse', [\App\Http\Controllers\AuthController::class, 'formRegister'])
    ->name('auth.formRegister');
Route::post('registrarse', [\App\Http\Controllers\AuthController::class, 'processRegister'])
    ->name('auth.processRegister');

//Shop
Route::get('/shop', [\App\Http\Controllers\MangasController::class, 'shop'])
    ->name('shop');

Route::get('/series', [\App\Http\Controllers\MangasController::class, 'series'])
    ->name('series');    

Route::get('/noticias', [\App\Http\Controllers\NewsController::class, 'noticias'])
    ->name('noticias');


Route::get('/shop/mangas/{id}', [\App\Http\Controllers\MangasController::class, 'mangaById'])
    ->name('mangas');

Route::get('/noticias/{id}', [\App\Http\Controllers\NewsController::class, 'noticiaById'])
    ->name('noticiaById');

Route::get('/series/{id}', [\App\Http\Controllers\MangasController::class, 'serieById'])
    ->name('serieById');    


//Admin
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['verificar-admin']);

Route::get('/admin/mangas', [\App\Http\Controllers\AdminController::class, 'mangasDashboard'])
    ->name('admin.mangas')
    ->middleware(['verificar-admin']);

Route::get('/admin/series', [\App\Http\Controllers\AdminController::class, 'seriesDashboard'])
    ->name('admin.series')
    ->middleware(['verificar-admin']);

Route::get('/admin/noticias', [\App\Http\Controllers\AdminController::class, 'noticiasDashboard'])
    ->name('admin.noticias')
    ->middleware(['verificar-admin']);

Route::get('/admin/mangas/eliminados', [\App\Http\Controllers\AdminController::class, 'trash'])
    ->name('admin.trashed.mangas.index')
    ->middleware(['verificar-admin']);

Route::get('/admin/usuarios', [\App\Http\Controllers\AdminController::class, 'usuariosDashboard'])
    ->name('admin.usuarios')
    ->middleware(['verificar-admin']);

Route::get('/admin/usuario/{id}', [\App\Http\Controllers\AdminController::class, 'usuarioDetalle'])
    ->name('admin.usuarioDetalle')
    ->middleware(['verificar-admin']);



//Admin Mangas
Route::get('admin/mangas/nuevo', [\App\Http\Controllers\AdminController::class, 'formNew'])
    ->name('admin.formNew')
    ->middleware(['verificar-admin']);


Route::get('admin/mangas/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'confirmDelete'])
    ->name('admin.confirmDelete')
    ->middleware(['verificar-admin']);

Route::post('admin/mangas/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'processDelete'])
    ->name('admin.processDelete')
    ->middleware(['verificar-admin']);


Route::get('admin/mangas/{id}/editar', [\App\Http\Controllers\AdminController::class, 'formUpdate'])
    ->name('admin.formUpdate')
    ->middleware(['verificar-admin']);

Route::post('admin/mangas/{id}/editar', [\App\Http\Controllers\AdminController::class, 'processUpdate'])
    ->name('admin.processUpdate')
    ->middleware(['verificar-admin']);


Route::post('admin/mangas/nuevo', [\App\Http\Controllers\AdminController::class, 'processNew'])
    ->name('admin.processNew')
    ->middleware(['verificar-admin']);


Route::get('admin/mangas/eliminados/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'confirmTrashDeleteManga'])
    ->name('admin.trashed.mangas.confirmTrashDeleteManga')
    ->middleware(['verificar-admin']);

Route::post('admin/mangas/eliminados/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'processTrashDeleteManga'])
    ->name('admin.trashed.mangas.processTrashDeleteManga')
    ->middleware(['verificar-admin']);


//Admin noticias
Route::get('admin/noticias/nuevo', [\App\Http\Controllers\AdminController::class, 'formNewNoticia'])
    ->name('admin.formNewNoticia')
    ->middleware(['verificar-admin']);

Route::post('admin/noticias/nuevo', [\App\Http\Controllers\AdminController::class, 'processNewNoticia'])
    ->name('admin.processNewNoticia')
    ->middleware(['verificar-admin']);


Route::get('admin/noticias/{id}/editar', [\App\Http\Controllers\AdminController::class, 'formUpdateNoticia'])
    ->name('admin.formUpdateNoticia')
    ->middleware(['verificar-admin']);

Route::post('admin/noticias/{id}/editar', [\App\Http\Controllers\AdminController::class, 'processUpdateNoticia'])
    ->name('admin.processUpdateNoticia')
    ->middleware(['verificar-admin']);


Route::get('admin/noticias/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'confirmDeleteNoticia'])
    ->name('admin.confirmDeleteNoticia')
    ->middleware(['verificar-admin']);

Route::post('admin/noticias/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'processDeleteNoticia'])
    ->name('admin.processDeleteNoticia')
    ->middleware(['verificar-admin']);


Route::get('/admin/noticias/eliminados', [\App\Http\Controllers\AdminController::class, 'trashNoticia'])
    ->name('admin.trashed.noticias.index')
    ->middleware(['verificar-admin']);

Route::get('admin/noticias/eliminados/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'confirmTrashDeleteNoticia'])
    ->name('admin.trashed.noticias.confirmTrashDeleteNoticia')
    ->middleware(['verificar-admin']);

Route::post('admin/noticias/eliminados/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'processTrashDeleteNoticia'])
    ->name('admin.trashed.noticias.processTrashDeleteNoticia')
    ->middleware(['verificar-admin']);


//Admin series
Route::get('admin/series/nuevo', [\App\Http\Controllers\AdminController::class, 'formNewSerie'])
    ->name('admin.formNewSerie')
    ->middleware(['verificar-admin']);

Route::post('admin/series/nuevo', [\App\Http\Controllers\AdminController::class, 'processNewSerie'])
    ->name('admin.processNewSerie')
    ->middleware(['verificar-admin']);

Route::get('admin/series/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'confirmDeleteSerie'])
    ->name('admin.confirmDeleteSerie')
    ->middleware(['verificar-admin']);

Route::post('admin/series/{id}/eliminar', [\App\Http\Controllers\AdminController::class, 'processDeleteSerie'])
    ->name('admin.processDeleteSerie')
    ->middleware(['verificar-admin']);

Route::get('admin/series/{id}/editar', [\App\Http\Controllers\AdminController::class, 'formUpdateSerie'])
    ->name('admin.formUpdateSerie')
    ->middleware(['verificar-admin']);

Route::post('admin/series/{id}/editar', [\App\Http\Controllers\AdminController::class, 'processUpdateSerie'])
    ->name('admin.processUpdateSerie')
    ->middleware(['verificar-admin']);





//Carrito
Route::get('/carrito', [\App\Http\Controllers\CartController::class, 'index'])
    ->name('carrito.index');
Route::post('carrito/add/{id}', [\App\Http\Controllers\CartController::class, 'add'])
    ->name('carrito.add');
Route::post('carrito/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove'])
    ->name('carrito.remove');
Route::post('carrito/update/{id}', [\App\Http\Controllers\CartController::class, 'update'])
    ->name('carrito.update');





//MercadoPago
Route::get('/checkout', [\App\Http\Controllers\MercadoPagoController::class, 'show'])
        ->name('mercadopago.show')
        ->middleware(['verificar-login']);
Route::get('checkout/success', [\App\Http\Controllers\MercadoPagoController::class, 'processSuccess'])
        ->name('mercadopago.success');
Route::get('checkout/pending', [\App\Http\Controllers\MercadoPagoController::class, 'processPending'])
        ->name('mercadopago.pending');
Route::get('checkout/failure', [\App\Http\Controllers\MercadoPagoController::class, 'processFailure'])
        ->name('mercadopago.failure');
