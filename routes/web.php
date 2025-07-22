<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvesController;
use App\Http\Controllers\FloraagricolaController;
use App\Http\Controllers\FloraController;
use App\Http\Controllers\FlorajardinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EspeciesController;
use App\Http\Controllers\AdminSpeciesController;
use App\Http\Controllers\ComentarioController;
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
use App\Http\Controllers\BitaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnfermedadPlantaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\NuevoController;
use App\Http\Controllers\BitaController;
use App\Http\Controllers\EnfermedadController;


// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard (protegido)
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

// Público general
Route::get('/catalogo', [EspeciesController::class, 'index'])->name('catalogo.index');
Route::get('/especies/{id}', [EspeciesController::class, 'show'])->name('catalogo.show');
Route::get('/UsuarioPost', [UsuarioPostController::class, 'index'])->name('UsuarioPost.index');
Route::get('/UsuarioPost/create', [UsuarioPostController::class, 'create'])->name('UsuarioPost.create');
Route::post('/UsuarioPost', [UsuarioPostController::class, 'store'])->name('UsuarioPost.store');
Route::get('/mamiferos', [MamiferosController::class, 'index'])->name('mamiferos.index');

// Likes (públicos, pero requieren auth)
Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
Route::get('/mis-likes', [LikeController::class, 'misLikes'])->name('likes.mislikes');
Route::resource('eventos', EventoController::class);
Route::resource('/nuevos', NuevoController::class);

// Recursos
Route::resources([
    'bitaco' => BitaController::class,
    'arboles' => ArbolesController::class,
    'Anfibio' => AnfibiosController::class,
    'extintos' => PeligroExtincionController::class,
    'fauna' => FaunaController::class,
    'flora' => FloraController::class,
    'comentarios' => ComentarioController::class,
    'paisajes' => PaisajeController::class,
    'peligrosos' => PeligrosoController::class,
    'reportes' => ReporteController::class,
    'medicinas' => MedicinaController::class,
    'comidas' => AlimentoController::class,
    'informacion' => DatousuarioController::class,
    'enfermedades' => EnfermedadPlantaController::class,
]);

// Crear comentario desde especie específica
Route::get('/comentarios/create/{id}', [ComentarioController::class, 'create'])->name('comentarios.create');

// Duplicadas (ojo con posibles errores)
Route::get('/anfibio', [AnfibiosController::class, 'index'])->name('anfibio.index');
Route::get('/ave', [AnfibiosController::class, 'index'])->name('aves.index'); // 👈 revisar esta lógica

// Rutas autenticadas
Route::middleware('auth')->group(function () {
    // Perfil de usuario
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Favoritos
    Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/favoritos', [FavoritoController::class, 'store'])->name('favoritos.store');
    Route::delete('/favoritos/{id}', [FavoritoController::class, 'destroy'])->name('favoritos.destroy');

    // Publicaciones
    Route::get('/nueva-fauna', [FaunaController::class, 'create']);
    Route::get('/nuevaz', [PeligroExtincionController::class, 'index'])->name('peligro.index');

    // Índices por categoría
    Route::get('/veR', [AnfibiosController::class, 'index'])->name('anfibio.index');
    Route::get('/usar', [ArbolesController::class, 'index'])->name('arboles.index');
    Route::get('/aves', [AvesController::class, 'index'])->name('ave.index');
    Route::get('/flora', [FloraController::class, 'index'])->name('flora.index');
    Route::get('/agricola', [FloraagricolaController::class, 'index'])->name('agricola.index');
    Route::get('/jardin', [FlorajardinController::class, 'index'])->name('jardin.index');
    Route::get('/arboles', [ArbolesController::class, 'index'])->name('arboles.index');
  Route::get('/bitacora', [BitaController::class, 'bita'])->name('bitacora.bita');


    // Tienda y cursos
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');





});
Route::resource('bitaco', BitaController::class);

Route::resource('arboles', ArbolesController::class);
Route::resource('Anfibio', AnfibiosController::class);
Route::resource('extintos', PeligroExtincionController::class);
Route::resource('fauna', FaunaController::class);
Route::resource('flora', FloraController::class);
Route::resource('/comentarios', ComentarioController::class);
Route::get('/comentarios/create/{id}', [ComentarioController::class, 'create'])->name('comentarios.create');

// Duplicadas pero con nombres diferentes
Route::get('/anfibio', [AnfibiosController::class, 'index'])->name('anfibio.index');
Route::get('/ave', [AnfibiosController::class, 'index'])->name('aves.index'); // Posible error, revisa

// Rutas de paisajes
Route::resource('/paisajes', PaisajeController::class);
Route::get('/index', [PaisajeController::class, 'index'])->name('paisajes.index_paisaje');

// Rutas de peligrosos
Route::resource('/peligrosos', PeligrosoController::class);
Route::get('/index', [PeligrosoController::class, 'index'])->name('peligrosos.index_peligroso');

// Otros recursos
Route::resource('/reportes', ReporteController::class);
Route::resource('eventos', EventoController::class);
Route::resource('/medicinas', MedicinaController::class);
Route::resource('/nuevos', NuevoController::class);

Route::resource('/comidas', AlimentoController::class);
Route::resource('/informacion', DatousuarioController::class);

// Likes
Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
Route::get('/mis-likes', [LikeController::class, 'misLikes'])->name('likes.mislikes');

// Explorar usuarios
Route::middleware(['auth'])->group(function () {
    Route::get('/explorar-usuarios', [UserController::class, 'explorar'])->name('usuarios.explorar');
});

// Panel Admin
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('especies', AdminSpeciesController::class)->parameters([
        'especies' => 'species',
    ])->names([
        'index' => 'especies.index',
        'create' => 'especies.create',
        'store' => 'especies.store',
        'edit' => 'especies.edit',
        'update' => 'especies.update',
        'destroy' => 'especies.destroy',
    ]);

    // Vista admin adicional
    Route::get('/usuarios', [AdminController::class, 'verUsuarios'])->name('usuarios');
    Route::get('/users', [UserController::class, 'index'])->name('users');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
});


Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
Route::get('/mis-likes', [LikeController::class, 'misLikes'])->name('likes.mislikes');


Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/nuevos', [NuevoController::class, 'index'])->name('nuevos.index');
Route::get('/enfermedades', [EnfermedadController::class, 'index'])->name('enfermedades.index');
Route::get('/bitacora', [BitaController::class, 'bita'])->name('bitacora.bita');
Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
Route::get('/nuevos/create', [NuevoController::class, 'create'])->name('nuevos.create');


require __DIR__.'/auth.php';
