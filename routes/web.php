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

Route::get('/', function (\Illuminate\Http\Request $request) {
    $request->session()->flush();
    //return view('welcome');
    return redirect()->route('reservar');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

Route::get('/pruebas', [\App\Http\Controllers\ReservaController::class, 'hola']
//function () {
//return view('pruebas');
//}
);

Route::get('/dump', function (\Illuminate\Http\Request $request) {
    //$request->session()->regenerate();
    //$request->session()->put('perico', 'ola');

});

Route::get('/firmar', function (\Illuminate\Http\Request $request) {

    $nombre = explode(' ', strtoupper($request->get('nombre')));

    $fileManager = new \App\Http\Tools\FileManager();

    $fileManager->imagesDirectory = 'public/formatos';

    $origen = imagecreatefromjpeg(__DIR__ . '/../storage/app/public/formatos/conocimiento/0.jpg');
    $im = imagecreate(20, 20);

    $fuente = 'C:\xampp\htdocs\proyectos\landing-cusezar\storage\app\public\formatos\fuentes\tahoma.ttf';

    $size = 20;

    if (count($nombre) >= 2) {

        imagettftext($origen, $size, 0, 920, 460, imagecolorallocate($im, 0, 0, 0), $fuente, $nombre[0] . ' ' . $nombre[1]);//nombres
        imagettftext($origen, $size, 0, 190, 460, imagecolorallocate($im, 0, 0, 0), $fuente, $nombre[2]);//apellidos
        imagettftext($origen, $size, 0, 590, 460, imagecolorallocate($im, 0, 0, 0), $fuente, $nombre[3]);
    }

    //
    ob_start();

    // generate the byte stream
    imagejpeg($origen, NULL, 100);

    // and finally retrieve the byte stream
    $rawImageBytes = ob_get_clean();

    header('Content-type: image/jpeg');
    echo $rawImageBytes;
    //echo "<img alt='Documento' src='data:image/jpeg;base64," . base64_encode($origen) . "'>";

});

Route::get('/proyectos', function () {
    return view('reserva.proyectos');
});

Route::get('/reservar', [\App\Http\Controllers\ReservaController::class, 'vista'])->name('reservar');
Route::post('/reservar', [\App\Http\Controllers\ReservaController::class, 'reservar']);
Route::get('/cotizar/{proyecto}', [\App\Http\Controllers\ReservaController::class, 'cotizar'])->name('cotizar');

require __DIR__ . '/auth.php';
