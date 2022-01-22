<?php

namespace App\Http\Tools;

class Cotizacion
{
    final public function salarioMinimoMensual()
    {
        return 1000000;
    }

    public function __construct()
    {
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
