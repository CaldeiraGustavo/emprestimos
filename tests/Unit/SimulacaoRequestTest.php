<?php 
namespace Tests\Unit;

use App\Http\Requests\SimulacaoRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class SimulacaoRequestTest extends TestCase
{    
    use DatabaseTransactions;
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request =  new SimulacaoRequest();

    }

    public function testDeveriaConterTodasRegrasEsperadas()
    {
        $this->assertEquals(
            [
                'valor_emprestimo'  => ['required', 'numeric'],
                'instituicoes'      => ['nullable', 'array'],
                'convenios'         => ['nullable', 'array'],
                'parcela'           => ['nullable', 'numeric'],
            ], $this->request->rules()
        );
    }

    public function testDeveriaConterTodasMensagensEsperadas()
    {
        $this->assertEquals(
            [
                'required' => 'O parâmetro :attribute é obrigatório.',
                'valor_emprestimo.required' => 'O valor do empréstimo é obrigatório',
                'array' => 'O parâmetro :attribute deve ser um array.',
                'numeric' => 'O parâmetro :attribute deve ser um valor numérico.',
            ], $this->request->messages()
        );
    }

    public function testDeveriaAceitarDadosValidos()
    {
        $dadosValidos = [
            "valor_emprestimo" => "130.59",
            "instituicoes"=> ["PAN"],
            "convenios" => ["INSS"],
            "parcela"=> "1"
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertFalse($validator->fails());
    }

    public function testDeveriaAceitarApenasValor()
    {
        $dadosValidos = [
            "valor_emprestimo" => "130.59"
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertFalse($validator->fails());
    }

    public function testDeveriaFalharValorNaoInformado()
    {
        $dadosValidos = [
            "instituicoes"=> ["PAN"],
            "convenios" => ["INSS"],
            "parcela"=> "1"
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertTrue($validator->fails());
        $this->assertContains('valor_emprestimo', $validator->errors()->keys());
    }

    public function testDeveriaFalharValorInvalido()
    {
        $dadosValidos = [
            "valor_emprestimo" => "teste",
            "instituicoes"=> ["PAN"],
            "convenios" => ["INSS"],
            "parcela"=> "1"
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertTrue($validator->fails());
        $this->assertContains('valor_emprestimo', $validator->errors()->keys());
    }

    public function testDeveriaFalharInstituicoesInvalido()
    {
        $dadosValidos = [
            "valor_emprestimo" => "13.99",
            "instituicoes"=> "PAN",
            "convenios" => ["INSS"],
            "parcela"=> "1"
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertTrue($validator->fails());
        $this->assertContains('instituicoes', $validator->errors()->keys());
    }

    public function testDeveriaFalharConvenioInvalido()
    {
        $dadosValidos = [
            "valor_emprestimo" => "13.99",
            "instituicoes"=> ["PAN"],
            "convenios" => "INSS",
            "parcela"=> "1"
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertTrue($validator->fails());
        $this->assertContains('convenios', $validator->errors()->keys());
    }

    public function testDeveriaFalharParcelaInvalida()
    {
        $dadosValidos = [
            "valor_emprestimo" => "13.99",
            "instituicoes"=> ["PAN"],
            "convenios" => ["INSS"],
            "parcela"=> "parcela"
        ];
        $validator = Validator::make($dadosValidos, $this->request->rules());
        $this->assertTrue($validator->fails());
        $this->assertContains('parcela', $validator->errors()->keys());
    }
}
