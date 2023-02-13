<?php

namespace Database\Seeders;

use App\Models\FinancialIndicator;
use Illuminate\Database\Seeder;
use File;

class FinancialIndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datajson = File::get('database/data/data.json');
        $data = json_decode($datajson);

        foreach($data as $key => $value){
            FinancialIndicator::create([
                'id' => $value->id,
                'name' => $value->nombreIndicador,
                'code' => $value->codigoIndicador,
                'unit' => $value->unidadMedidaIndicador,
                'value' => $value->valorIndicador,
                'date' => $value->fechaIndicador,
                'time' => $value->tiempoIndicador,
                'origin' => $value->origenIndicador,
            ]);
        }
    }
}
