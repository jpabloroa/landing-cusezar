<?php

namespace App\Http\Controllers;

use App\Http\Tools\HTML5Renderer;
use App\Models\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservaController extends Controller
{

    protected $config = [
        'views_file' => 'views-default',
        'params_file' => 'params-default'
    ];
    private $cotizador;

    private $params;

    private $views;

    private $prospecto;

    public function __call($method, $parameters)
    {
        try {
            $request = $parameters[0];

            if (!session()->has('_views')) {
                $this->views = (object)json_decode(Storage::disk('local')->get('public/json-layouts/' . $this->config['views_file'] . '.json'));
                $this->params = (object)json_decode(Storage::disk('local')->get('public/json-layouts/' . $this->config['params_file'] . '.json'));
                session()->put('_views', $this->views);
                session()->put('_params', $this->params);

            } else {
                $this->views = session()->get('_views');
                $this->params = session()->get('_params');
                $this->cotizador = new CotizacionController(session()->get('proyecto'));
                session()->put('_cotizador', $this->cotizador);
                $this->cotizador = session()->get('_cotizador');
            }
            if (isset($parameters[1])) {
                $this->cotizador = new CotizacionController($parameters[1]  );
                //session()->put('_cotizador', $this->cotizador);

                //} else {
                //$this->cotizador = session()->get('_cotizador');
            }
            return $this->{$method}($request);
        } catch
        (\Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            $this->log($e);
        }
    }

    public function nueva_reserva(Request $request)
    {
        $request->session()->put('nombres', $request->nombres);
        $request->session()->put('apellidos', $request->apellidos);
        $request->session()->put('cedula', $request->cedula);
        $request->session()->put('celular', $request->celular);
        $request->session()->put('correo', $request->correo);
        $request->session()->put('estado_civil', $request->estado_civil);
        $request->session()->put('toma_subsidio', $request->toma_subsidio);
        $request->session()->put('caja_compensacion', $request->caja_compensacion);
        $request->session()->put('actividad', $request->actividad);
        $request->session()->put('ingresos', $request->ingresos);
        $request->session()->put('gastos', $request->gastos);
        $request->session()->put('cuota_esperada', $request->cuota_esperada);
        $request->session()->put('proyecta_primas', $request->proyecta_primas);
        $request->session()->put('cesantias', $request->cesantias);
        $request->session()->put('proyecta_cesantías', $request->proyecta_cesantias);
        $request->session()->put('ahorros', $request->ahorros);
        $request->session()->put('activos', $request->activos);
        $request->session()->put('pasivos', $request->pasivos);
        $request->session()->put('credito', $request->credito);
        $request->session()->put('documentos_cliente', $request->documentos);
    }

    private function vista(Request $request)
    {
        try {

            $content = '';
            $renderer = new HTML5Renderer();

            if (!is_null($request->get('vista'))) {
                $content = $renderer->input($request->get('vista'), $this->params[$request->get('vista')]);
                return view('reserva.template', compact('content'));
            }

            //
            foreach ($this->views as $view) {
                //
                if (!$request->session()->has($view->views)) {
                    foreach ($view->views as $query) {
                        if (property_exists($this->params, $query)) {
                            $content .= $renderer->input($query, (array)$this->params->{$query});
                        }
                    }
                    $title = $view->title;
                    return view('reserva.template', compact('title', 'content'));
                }
            }
        } catch (\Exception $e) {
            $this->log($e);
        }
    }

    private function reservar(Request $request)
    {
        try {

            //
            $this->prospecto = new Prospecto();

            //
            if (
                $request->get('submit') && $request->get('submit') == 1
            ) {

                //
                $client = (object)$request->session()->all();

                //
                if ($request->session()->has('clientArray')) {
                    $clientArray = $request->session()->get('clientArray');
                }

                //
                $clientArray[] = $client;

                //
                $request->session()->put('clientArray', $clientArray);

                //
                return redirect()->route('cotizar');

            } else {

                //
                $renderer = new HTML5Renderer();

                //
                foreach ($this->prospecto->getFillable() as $attribute) {
                    if (!$request->session()->has($attribute)) {
                        $request->session()->put($attribute, $request->{$attribute});
                    }
                }

                //
                return redirect()->route('reservar');
            }
        } catch (\Exception $e) {
            $this->log($e);
        }
    }

    /*
    public function nueva_reserva()
    {

    }
    */

    private function cotizar(Request $request)
    {
        try {

            //
            if (!$request->session()->has('clientArray')) {
                //
                return redirect()->route('reservar');
            }

            //
            $clientArray = $request->session()->get('clientArray');
            $comprador = $clientArray[0];

            $cotizador = $this->cotizador;

            $unidad = $cotizador->area;
            $cotizacion = $cotizador->cotizar($unidad, $comprador);

            return view('reserva.cotizador', compact('comprador', 'cotizador', 'cotizacion'));
        } catch (\Exception $e) {
            $this->log($e);
        }
    }
}
