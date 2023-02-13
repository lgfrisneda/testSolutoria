<?php

namespace Tests\Feature;

use App\Models\FinancialIndicator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FinancialIndicatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_financial_indicators_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('financialIndicators.index'));
        $financialIndicators = FinancialIndicator::factory(3)->create();

        $response->assertOk();
        $this->assertCount(3, $financialIndicators);
    }

    public function test_new_financial_indicator_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post(route('financialIndicators.store', [
            'name' => 'UNIDAD DE FOMENTO (UF) CREATED',
            'code' => 'UF',
            'unit' => 'Pesos',
            'value' => 1234.56,
            'date' => date('Y-m-d'),
            'time' => null,
            'origin' => 'mindicador.cl'
        ]));

        $allFinancialIndicators = FinancialIndicator::all();
        $oneFinancialIndicator = $allFinancialIndicators->last();

        $response->assertOk();
        $response->assertSessionHasNoErrors();
        $this->assertCount(1, $allFinancialIndicators);
        $this->assertEquals('UNIDAD DE FOMENTO (UF) CREATED', $oneFinancialIndicator->name);
    }

    public function test_financial_indicator_can_be_updated()
    {
        $this->withoutExceptionHandling();

        FinancialIndicator::factory(1)->create();
        $financialIndicator = FinancialIndicator::first();

        $response = $this->put(route('financialIndicators.update', $financialIndicator->id), [
            'name' => 'UNIDAD DE FOMENTO (UF) UPDATED',
            'code' => 'UF',
            'unit' => 'Pesos',
            'value' => 1234.56,
            'date' => date('Y-m-d'),
            'time' => null,
            'origin' => 'mindicador.cl'
        ]);

        $response->assertOk();
        $response->assertSessionHasNoErrors();

        $financialIndicator = $financialIndicator->fresh();

        $this->assertEquals('UNIDAD DE FOMENTO (UF) UPDATED', $financialIndicator->name);
    }

    public function test_financial_indicator_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        FinancialIndicator::factory(1)->create();
        $financialIndicator = FinancialIndicator::first();

        $response = $this->delete(route('financialIndicators.destroy', $financialIndicator->id));

        $financialIndicators = FinancialIndicator::all();

        $this->assertCount(0, $financialIndicators);
    }
}
