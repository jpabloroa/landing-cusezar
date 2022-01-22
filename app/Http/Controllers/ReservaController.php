<?php

namespace App\Http\Controllers;

use App\Http\Tools\HTML5Renderer;
use App\Models\Prospecto;
use Illuminate\Http\Request;

class ReservaController extends Controller
{

    public function nueva_reserva(Request $request)
    {
        $nombre = $request->session()->get('nombres');
        $apellido = $request->session()->get('apellidos');
        $nombre = $request->session()->get('cedula');
        $nombre = $request->session()->get('celular');
        $nombre = $request->session()->get('correo');
        $paso = $request->session()->get('paso');
        $array[] = $request->valor;
        $request->session()->put('nombre',);

        if ($request->session()->has('nombre')) {
            echo '<h1>Valores de session: ' . count($array) . '</h1>';
            foreach ($array as $key => $val) {
                echo '<h1>' . $key . '- ' . $val . '</h1>';
            }
        }


        switch ($paso) {
            case 0:
                break;
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
            default:
                $request->session()->put('nombres', $request->nombres);
                $request->session()->put('apellidos', $request->apellidos);
                $paso++;
                break;
        }

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
        $this->nueva_vista($paso);
    }

    private $prospecto;

    private $properties = [
        'nombre_1' => [
            'title' => 'Primer nombre',
            'type' => 'text',
            'placeholder' => '',
            'value' => '',
        ],
        'nombre_2' => [
            'title' => 'Segundo nombre',
            'type' => 'text',
            'placeholder' => '',
            'value' => ''
        ],
        'apellido_1' => [
            'title' => 'Primer apellido',
            'type' => 'text',
            'placeholder' => '',
            'value' => ''
        ],
        'apellido_2' => [
            'title' => 'Segundo apellidos',
            'type' => 'text',
            'placeholder' => '',
            'value' => ''
        ],
        'cedula' => [
            'title' => 'Numero de identificacion',
            'type' => 'text',
            'placeholder' => 'C.C.:',
            'value' => ''
        ],
        'celular' => [
            'title' => 'Celular',
            'type' => 'text',
            'placeholder' => '+57',
            'value' => ''
        ],
        'correo' => [
            'title' => 'Correo electrónico',
            'type' => 'email',
            'placeholder' => 'sucorreo@ejemplo.com',
            'value' => ''
        ],
        'estado_civil' => [
            'title' => 'Estado Civil',
            'type' => 'radios',
            'values' => [
                'soltero' => 'Soltero(a) sin unión marital de hecho',
                'union_libre' => 'Soltero(a) con unión marital de hecho',
                'casado' => 'Casado(a) con unión marital vigente'
            ]
        ],
        'aplica_subsidio' => [
            'title' => '¿Desea aplicar a subsidio?',
            'type' => 'radios',
            'values' => [
                1 => 'Si',
                0 => 'No'
            ]
        ],
        'caja_compensacion' => [
            'title' => 'Caja de compensación',
            'type' => 'radios',
            'values' => [
                'compensar' => 'Compensar',
                'colsubsidio' => 'Colsubsidio',
                'cafam' => 'Cafam',
                'comfacundi' => 'Caja de compensación de Cundinamarca'
            ]
        ],
        'actividad' => [
            'title' => 'Seleccione su actividad económica',
            'type' => 'radios',
            'values' => [
                'empleado' => 'Empleado',
                'independiente' => 'Independiente'
            ]
        ],
        'ingresos' => [
            'title' => 'Ingreso mensual $COP',
            'type' => 'currency',
            'placeholder' => '0',
            'value' => '0'
        ],
        'gastos' => [
            'title' => 'Egresos mensuales',
            'type' => 'currency',
            'placeholder' => '0',
            'value' => '0'
        ],
        'primas_proyectadas' => [
            'title' => '¿Proyectar primas?',
            'type' => 'radios',
            'values' => [
                1 => 'Si',
                0 => 'No'
            ]
        ],
        'cesantias' => [
            'title' => 'Saldo actual en cesantías',
            'type' => 'currency',
            'placeholder' => '0',
            'value' => '0'
        ],
        'cesantias_proyectadas' => [
            'title' => '¿Proyectar cesantías?',
            'type' => 'radios',
            'values' => [
                1 => 'Si',
                0 => 'No'
            ]
        ],
        'ahorros' => [
            'title' => 'Ahorros adicionales',
            'type' => 'currency',
            'placeholder' => '0',
            'value' => '0'
        ],
        'ahorros_proyectados' => [
            'title' => '¿Proyectar ahorros?',
            'type' => 'radios',
            'values' => [
                1 => 'Si',
                0 => 'No'
            ]
        ],
        'activos' => [
            'title' => 'Activos',
            'type' => 'currency',
            'placeholder' => '0',
            'value' => '0'
        ],
        'pasivos' => [
            'title' => 'Pasivos',
            'type' => 'currency',
            'placeholder' => '0',
            'value' => '0'
        ],
        'credito' => [
            'title' => 'Preaprobación',
            'type' => 'currency',
            'placeholder' => '0',
            'value' => '0'
        ],
        'submit' => [
            'type' => 'submit'
        ]
    ];

    private $views = [
        [
            'title' => '',
            'views' => [
                'nombre_1',
                'nombre_2',
                'apellido_1',
                'apellido_2',
            ],
            'to' => ''
        ],
        [
            'title' => '',
            'views' => [
                'cedula',
                'celular',
                'correo',
                'estado_civil',
            ],
            'to' => ''
        ]
        ,
        [
            'title' => '',
            'views' => [
                'aplica_subsidio',
                'caja_compensacion',
            ],
            'to' => ''
        ],
        [
            'title' => '',
            'views' => [
                'actividad',
                'ingresos',
                'gastos',
                'primas_proyectadas',
                'cesantias',
                'cesantias_proyectadas',
                'ahorros',
                'ahorros_proyectados',
            ],
            'to' => ''
        ],
        [
            'title' => '',
            'views' => [
                'activos',
                'pasivos',
                'credito',
                'submit'
            ],
            'to' => ''
        ]
    ];

    public function vista(Request $request)
    {

        $content = '';
        $renderer = new HTML5Renderer();

        if (!is_null($request->get('vista'))) {
            $content = $renderer->input($request->get('vista'), $this->properties[$request->get('vista')]);
            return view('reserva.template', compact('content'));
        }

        //
        foreach ($this->views as $templates) {

            //
            foreach ($templates['views'] as $view) {

                //
                if (!$request->session()->has($view)) {
                    foreach ($templates['views'] as $query) {
                        $content .= $renderer->input($query, $this->properties[$query]);
                    }

                    $title = $templates['title'];

                    return view('reserva.template', compact('title', 'content'));
                }
            }
        }
    }

    public function reservar(Request $request)
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
                $request->session()->flush();
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
            return 'Error:' . $e->getMessage();
        }
    }

    /*
    public function nueva_reserva()
    {

    }
    */

    public function cotizar(Request $request)
    {
        /*
        if (!$request->session()->has('clientArray')) {
            //
            return redirect()->route('reservar');
        }
        */
        $clientArray = $request->session()->get('clientArray');

        $cotizador = new CotizacionController('launiondelamarlene');

        $unidad = $cotizador->proyecto->areas[0];

        $comprador = $clientArray[0];

        $cotizacion = $cotizador->cotizar($unidad, $comprador);

        return view('reserva.cotizador', compact('comprador', 'cotizador', 'unidad', 'cotizacion'));
    }
}
