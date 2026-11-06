<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\ItemCompra;
use App\Models\Produto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $dados = Compra::with(['usuario', 'itens.produto'])->get();

        return view('compra.list')->with(['dados' => $dados]);
    }

    function create()
    {
        $usuarios = Usuario::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();

        return view('compra.form')->with(compact('usuarios', 'produtos'));
    }

    function validateForm(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'data_compra' => 'required|date',
            'itens' => 'required|array',
            'itens.*' => 'nullable|integer|min:0',
        ], [
            'usuario_id.required' => "O cliente é obrigatório",
            'usuario_id.exists' => "O cliente selecionado não existe",
            'data_compra.required' => "A data é obrigatória",
            'data_compra.date' => "A data deve ser válida",
            'itens.required' => "Informe a quantidade de pelo menos um produto",
            'itens.array' => "Os produtos informados são inválidos",
            'itens.*.integer' => "A quantidade deve ser um número inteiro",
            'itens.*.min' => "A quantidade não pode ser negativa",
        ]);
    }

    function verificarEstoque(Request $request, $anteriores = [])
    {
        $total = 0;

        foreach (Produto::All() as $produto) {
            $quantidade = (int) ($request->itens[$produto->id] ?? 0);
            $disponivel = $produto->estoque + ($anteriores[$produto->id] ?? 0);
            $total += $quantidade;

            if ($quantidade > $disponivel) {
                return "Estoque insuficiente de $produto->nome. Disponível: $disponivel";
            }
        }

        if ($total == 0) {
            return "Informe a quantidade de pelo menos um produto";
        }

        return null;
    }

    function salvarItens(Request $request, Compra $compra)
    {
        $valorTotal = 0;

        foreach (Produto::All() as $produto) {
            $quantidade = (int) ($request->itens[$produto->id] ?? 0);

            if ($quantidade > 0) {
                ItemCompra::create([
                    'compra_id' => $compra->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidade,
                ]);

                $produto->decrement('estoque', $quantidade);
                $valorTotal += $produto->preco * $quantidade;
            }
        }

        $compra->update(['valor_total' => $valorTotal]);
    }

    function devolverEstoque(Compra $compra)
    {
        foreach ($compra->itens as $item) {
            $item->produto->increment('estoque', $item->quantidade);
        }

        $compra->itens()->delete();
    }

    function store(Request $request)
    {
        $this->validateForm($request);

        $erro = $this->verificarEstoque($request);

        if ($erro) {
            return back()->withInput()->with("error", $erro);
        }

        $compra = Compra::create([
            'usuario_id' => $request->usuario_id,
            'data_compra' => $request->data_compra,
            'valor_total' => 0,
        ]);

        $this->salvarItens($request, $compra);

        return redirect('compra')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Compra::with('itens')->findOrFail($id);
        $usuarios = Usuario::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();
        $quantidades = $data->itens->pluck('quantidade', 'produto_id');

        return view('compra.form')->with(compact('data', 'usuarios', 'produtos', 'quantidades'));
    }

    function update(Request $request, $id)
    {
        $this->validateForm($request);

        $compra = Compra::with('itens.produto')->findOrFail($id);
        $anteriores = $compra->itens->pluck('quantidade', 'produto_id');

        $erro = $this->verificarEstoque($request, $anteriores);

        if ($erro) {
            return back()->withInput()->with("error", $erro);
        }

        $this->devolverEstoque($compra);

        $compra->update([
            'usuario_id' => $request->usuario_id,
            'data_compra' => $request->data_compra,
        ]);

        $this->salvarItens($request, $compra);

        return redirect('compra')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        $compra = Compra::with('itens.produto')->findOrFail($id);

        $this->devolverEstoque($compra);

        $compra->delete();

        return redirect('compra')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:usuario,data_compra',
        ], [
            'tipo.required' => "Selecione o campo da busca",
            'tipo.in' => "Campo de busca inválido",
        ]);

        $busca = Compra::with(['usuario', 'itens.produto']);

        if (!empty($request->valor)) {
            if ($request->tipo == 'usuario') {
                $busca->whereHas('usuario', function ($query) use ($request) {
                    $query->where('nome', 'like', "%$request->valor%");
                });
            } else {
                $busca->where($request->tipo, 'like', "%$request->valor%");
            }
        }

        $dados = $busca->get();

        return view('compra.list', compact('dados'));
    }
}
