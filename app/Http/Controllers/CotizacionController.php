<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class CotizacionController extends Controller
{
    public $proyecto;
    public $area;

    final public function salarioMinimoMensual()
    {
        return 1000000;
    }

    public function __construct($proyecto = null)
    {
        try {
            if ($proyecto == null) {
                return redirect()->route('proyectos');
            }
            $this->proyecto = (object)json_decode(Storage::disk('local')->get('public/proyectos/' . $proyecto . '.json'));
            echo json_encode($this->proyecto);
            $this->area = $this->proyecto->areas[0];
            echo "<br>";
            echo json_encode($this->area);
        } catch (\Exception $e) {
            $this->log($e);
        }
    }

    public function cotizar(&$unidad, &$comprador)
    {
        //
        $valorInmueble = $unidad->precio;
        $separacion = $unidad->separacion;
        $plazoYseparacion = $unidad->plazo + 1;
        $proporcionMinimaDeAportesCuotaInicial = $unidad->minima_cuota_inicial;

        //
        $ingresoMensual = $comprador->ingresos;
        //$egresos = 0.2 * $ingresoMensual;
        $totalSubsidio = $this->subsidio($ingresoMensual);
        $primasProyectadas = (
            $comprador->primas_proyectadas == 1
        ) ? (($ingresoMensual / 2) * $unidad->primas_para_proyectar) : 0;
        $cesantias = $comprador->cesantias;
        $cesantiasProyectadas = (
            $comprador->cesantias_proyectadas == 1
        ) ? (($ingresoMensual) * $unidad->cesantias_para_proyectar) : 0;
        $ahorros = $comprador->ahorros;
        $ahorrosProyectados = $comprador->ahorros_proyectados;

        //
        $preaprobacionCredito = $comprador->credito;

        //
        $totalAportes =
            $primasProyectadas
            + $cesantias
            + $cesantiasProyectadas
            + $ahorros
            + $ahorrosProyectados;

        //
        $saldoParaDiferir = $valorInmueble;
        $saldoParaDiferir -= $totalSubsidio;
        $saldoParaDiferir -= $totalAportes;

        //
        $cuotaInicialAportes =
            (
            ($totalAportes > 0) ?
                (
                ($totalAportes <= ($valorInmueble * ($proporcionMinimaDeAportesCuotaInicial / 2))) ?
                    $proporcionMinimaDeAportesCuotaInicial - ($totalAportes / $valorInmueble)
                    : $proporcionMinimaDeAportesCuotaInicial / 2
                ) : $proporcionMinimaDeAportesCuotaInicial
            ) * $valorInmueble;
        $preaprobacionCredito = (($saldoParaDiferir - $cuotaInicialAportes) < 0) ? 0 : ($saldoParaDiferir - $cuotaInicialAportes);

        //
        $saldoParaDiferir -= $preaprobacionCredito;
        $cuota = ($cuotaInicialAportes - $separacion) / ($plazoYseparacion - 1);

        //
        $total = [];
        $total["cuota"] = $cuota;
        $total["plazo"] = $plazoYseparacion - 1;
        $total["cuota_inicial"] = ($cuota * ($plazoYseparacion - 1)) + $separacion + $totalAportes;
        $total["proporcion_cuota_inial"] = ($cuotaInicialAportes + $totalAportes) / $valorInmueble;
        $total["subsidio"] = $totalSubsidio;
        $total["preaprobacionCredito"] = $preaprobacionCredito;
        $total["primasProyectadas"] = $primasProyectadas;
        $total["cesantias"] = $cesantias;
        $total["cesantiasProyectadas"] = $cesantiasProyectadas;
        $total["ahorros"] = $ahorros;
        $total["ahorrosProyectados"] = $ahorrosProyectados;
        $total["totalAportes"] = $total["cuota_inicial"] + $total["subsidio"];
        $total["total"] = $total["cuota_inicial"] + $total["preaprobacionCredito"] + $total["subsidio"];
        /*
                echo "<hr>";
                foreach ($total as $key => $value) {
                    echo "<h3>$key : " . money($value . '0')->toString() . "</h3>";
                }
                echo "<hr>";
                $total["total"] = $total["cuota_inicial"] + $total["preaprobacionCredito"] + $total["subsidio"];
                echo "<h3>Total: " . $total["total"] . "</h3>";
        */

        return (object)$total;

    }

    public function subsidio($ingresos, $condiciones = ['concurrente' => true])
    {
        if ($ingresos > ($this->salarioMinimoMensual() * 0) && $ingresos <= ($this->salarioMinimoMensual() * 2)) {
            if ($condiciones['concurrente']) {
                return
                    ($this->salarioMinimoMensual() * 30) +
                    ($this->salarioMinimoMensual() * 20);
            } else {
                return
                    ($this->salarioMinimoMensual() * 30);
            }
        } else if ($ingresos > ($this->salarioMinimoMensual() * 2) && $ingresos <= ($this->salarioMinimoMensual() * 4)) {
            return
                ($this->salarioMinimoMensual() * 20);
        } else {
            return 0;
        }
    }
}
