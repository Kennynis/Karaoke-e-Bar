<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index()
    {
        $dados = Sala::All();

        return view('sala.list')->with(['dados' => $dados]);
    }

    function create()
    {
        return view('sala.form');
    }


    function validateForm(Request $request)
    {
        $limites = ['Pequena' => 5, 'Média' => 12, 'Grande' => 25];
        $maximo = $limites[$request->tipo] ?? 25;

        $request->validate([
            'tipo' => 'required|in:Pequena,Média,Grande',
            'capacidade' => "required|integer|min:1|max:$maximo",
            'preco_hora' => 'required|numeric|min:0',
            'status' => 'required|in:Disponível,Ocupada,Manutenção',
        ], [
            'tipo.required' => "O tipo é obrigatório",
            'tipo.in' => "O tipo deve ser Pequena, Média ou Grande",
            'capacidade.required' => "A capacidade é obrigatória",
            'capacidade.integer' => "A capacidade deve ser um número inteiro",
            'capacidade.min' => "A capacidade deve ser de pelo menos :min pessoa",
            'capacidade.max' => "A capacidade máxima desta sala é de :max pessoas",
            'preco_hora.required' => "O preço por hora é obrigatório",
            'preco_hora.numeric' => "O preço por hora deve ser numérico",
            'preco_hora.min' => "O preço por hora não pode ser negativo",
            'status.required' => "O status é obrigatório",
            'status.in' => "O status deve ser Disponível, Ocupada ou Manutenção",
        ]);
    }

    function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = $request->all();

        Sala::create($data);

        return redirect('sala')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Sala::findOrFail($id);

        return view('sala.form')->with(compact('data'));
    }

    function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = $request->all();

        Sala::findOrFail($id)->update($data);

        return redirect('sala')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        $sala = Sala::findOrFail($id);

        if ($sala->reservas->count() > 0) {
            return redirect('sala')->with("error", "Não é possível remover a
                    sala $sala->id, pois existem reservas associadas a ela!");
        }
        Sala::destroy($id);

        return redirect('sala')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:tipo,capacidade,status',
        ], [
            'tipo.required' => "Selecione o campo da busca",
            'tipo.in' => "Campo de busca inválido",
        ]);

        if (!empty($request->valor)) {
            $dados = Sala::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Sala::All();
        }

        return view('sala.list', compact('dados'));
    }
}
