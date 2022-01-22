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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/pruebas', function () {
    return view('pruebas');
});

Route::post('/sapoloco', function (\Illuminate\Http\Request $request) {
    $array = $request->session()->get('valor');
    $array[] = $request->valor;
    $request->session()->put('valor', $array);

    if ($request->session()->has('valor')) {
        echo '<h1>Valores de session: ' . count($array) . '</h1>';
        foreach ($array as $key => $val) {
            echo '<h1>' . $key . '- ' . $val . '</h1>';
        }
    }
    echo '<hr>';
    echo '<h1>Valor recibido : ' . $request->valor . '</h1>';


    echo '<hr><a href="/pruebas">Volver</a>';
    echo '<hr><a href="/reset">reset</a>';
});

Route::get('/reset', function () {
    session()->put('valor');
    echo '<a href="/pruebas">Volver</a>';
});

Route::get('/dump', function () {
    return var_dump(session()->all());
});

Route::get('/firmar', function (\Illuminate\Http\Request $request) {

    $nombre = explode(' ', strtoupper($request->get('nombre')));

    $fileManager = new \App\Http\Tools\FileManager();

    $fileManager->imagesDirectory = 'public/formatos';

    $origen = imagecreatefromjpeg(__DIR__ . '/../storage/disk/formatos/conocimiento/0.jpg');
    $im = imagecreate(20, 20);

    $fuente = 'C:\xampp\htdocs\proyectos\landing-cusezar\storage\disk\formatos\fuentes\tahoma.ttf';

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


Route::get('/reservar', [\App\Http\Controllers\ReservaController::class, 'vista'])->name('reservar');
Route::post('/reservar', [\App\Http\Controllers\ReservaController::class, 'reservar']);
Route::get('/cotizar', [\App\Http\Controllers\ReservaController::class, 'cotizar'])->name('cotizar');

require __DIR__ . '/auth.php';
