<?php

use App\Http\Controllers\AvesController;
use App\Http\Controllers\FloraagricolaController;
use App\Http\Controllers\FloraController;
use App\Http\Controllers\FlorajardinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EspeciesController;
use App\Http\Controllers\AdminSpeciesController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioPostController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\PaisajeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PeligroExtincionController;
use App\Http\Controllers\FaunaController;
use App\Http\Controllers\PeligrosoController;
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\DatousuarioController;
use App\Http\Controllers\AnfibiosController;
use App\Http\Controllers\ArbolesController;
use App\Http\Controllers\MamiferosController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\MedicinaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\NuevoController;
use App\Http\Controllers\BitaController;



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/catalogo', [EspeciesController::class, 'index'])->name('catalogo.index');
Route::get('/especies/{id}', [EspeciesController::class, 'show'])->name('catalogo.show');
Route::get('/UsuarioPost', [UsuarioPostController::class, 'index'])->name('UsuarioPost.index');
Route::get('/UsuarioPost/create', [UsuarioPostController::class, 'create'])->name('UsuarioPost.create');
Route::post('/UsuarioPost', [UsuarioPostController::class, 'store'])->name('UsuarioPost.store');
Route::get('/mamiferos', [\App\Http\Controllers\MamiferosController::class, 'index'])->name('mamiferos.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['auth'])->group(function () {
    Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/favoritos', [FavoritoController::class, 'store'])->name('favoritos.store');
    Route::delete('/favoritos/{id}', [FavoritoController::class, 'destroy'])->name('favoritos.destroy');
    Route::get('/nueva-fauna', [FaunaController::class, 'create']);
    Route::get('/nuevaz', [PeligroExtincionController::class, 'create']);
    Route::get('/nuevaz', [PeligroExtincionController::class, 'index'])->name('peligro.index');
    Route::get('/veR', [AnfibiosController::class, 'index'])->name('anfibio.index');
    Route::get('/usar', [ArbolesController::class, 'index'])->name('arboles.index');
    Route::get('/mamiferos', [MamiferosController::class, 'index'])->name('mamiferos.index');
    Route::get('/aves', [AvesController::class, 'index'])->name('ave.index');
    Route::get('/flora', [FloraController::class, 'index'])->name('flora.index');
    Route::get('/agricola', [FloraagricolaController::class, 'index'])->name('agricola.index');
    Route::get('/jardin', [FlorajardinController::class, 'index'])->name('jardin.index');
    Route::get('/arboles', [ArbolesController::class, 'index'])->name('arboles.index');






});
Route::resource('arboles', ArbolesController::class);
Route::resource('Anfibio', AnfibiosController::class);
Route::resource('extintos', PeligroExtincionController::class);
Route::resource('fauna', FaunaController::class);
Route::resource('flora', FloraController::class);
Route::resource('/comentarios', ComentarioController::class);
Route::get('/comentarios/create/{id}', [ComentarioController::class, 'create'])->name('comentarios.create');
Route::get('/anfibio', [AnfibiosController::class, 'index'])->name('anfibio.index');
Route::get('/ave', [AnfibiosController::class, 'index'])->name('aves.index');

Route::resource('/paisajes', controller: PaisajeController::class);
Route::get('/index', [PaisajeController::class, 'index'])->name('paisajes.index_paisaje');

Route::resource('/peligrosos', PeligrosoController::class);
Route::get('/index', [PeligrosoController::class, 'index'])->name('peligrosos.index_peligroso');
Route::resource('/reportes', ReporteController::class);
Route::resource('/medicinas', MedicinaController::class);
Route::resource('/eventos', EventoController::class);
Route::resource('/nuevos', NuevoController::class);

Route::resource('/comidas', AlimentoController::class);

Route::resource('/informacion', DatousuarioController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/favoritos', [FavoritoController::class, 'store'])->name('favoritos.store');
    Route::delete('/favoritos/{id}', [FavoritoController::class, 'destroy'])->name('favoritos.destroy');
});

});

// Proteger rutas de admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
        Route::resource('especies', AdminSpeciesController::class)
        ->parameters(['especies' => 'species']) // Mapea "especies" al modelo Species
            ->names([
                'index' => 'especies.index',
                'create' => 'especies.create',
                'store' => 'especies.store',
                'edit' => 'especies.edit',
                'update' => 'especies.update',
                'destroy' => 'especies.destroy'
            ]);
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
});


Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
Route::get('/mis-likes', [LikeController::class, 'misLikes'])->name('likes.mislikes');





require __DIR__.'/auth.php';
