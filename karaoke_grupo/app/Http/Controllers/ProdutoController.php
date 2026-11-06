<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        $dados = Produto::All();

        return view('produto.list')->with(['dados' => $dados]);
    }

    function create()
    {
        return view('produto.form');
    }

    function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:120',
            'preco' => 'required|numeric|min:0|max:99999',
            'categoria' => 'required|in:Comida,Bebida',
            'estoque' => 'required|integer|min:0|max:99999',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'nome.required' => "O nome é obrigatório",
            'nome.max' => "O nome deve ter no máximo :max caracteres",
            'preco.required' => "O preço é obrigatório",
            'preco.numeric' => "O preço deve ser numérico",
            'preco.min' => "O preço não pode ser negativo",
            'preco.max' => "O preço deve ser de no máximo :max",
            'categoria.required' => "A categoria é obrigatória",
            'categoria.in' => "A categoria deve ser Comida ou Bebida",
            'estoque.required' => "O estoque é obrigatório",
            'estoque.integer' => "O estoque deve ser um número inteiro",
            'estoque.min' => "O estoque não pode ser negativo",
            'estoque.max' => "O estoque deve ser de no máximo :max",
            'imagem.image' => "O arquivo deve ser uma imagem",
            'imagem.mimes' => "A imagem deve ser PNG, JPG ou JPEG",
            'imagem.max' => "A imagem deve ter no máximo 2 MB",
        ]);
    }

    function salvarImagem($imagem)
    {
        $nome_imagem = date('YmdHis') . "." . $imagem->extension();
        $diretorio = "imagem/produto/";

        $imagem->storeAs($diretorio, $nome_imagem, 'public');

        return $diretorio . $nome_imagem;
    }

    function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $data['alcoolico'] = $request->categoria == 'Bebida' && $request->has('alcoolico');
        $imagem = $request->file('imagem');

        if ($imagem) {
            $data['imagem'] = $this->salvarImagem($imagem);
        }

        Produto::create($data);

        return redirect('produto')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Produto::findOrFail($id);

        return view('produto.form')->with(compact('data'));
    }

    function update(Request $request, $id)
    {
        $this->validateForm($request);

        $produto = Produto::findOrFail($id);
        $data = $request->all();
        $data['alcoolico'] = $request->categoria == 'Bebida' && $request->has('alcoolico');
        $imagem = $request->file('imagem');

        if ($imagem) {
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }
            $data['imagem'] = $this->salvarImagem($imagem);
        }

        $produto->update($data);

        return redirect('produto')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->itemCompras->count() > 0 || $produto->itemReservas->count() > 0) {
            return redirect('produto')->with("error", "Não é possível remover o produto
                    $produto->nome, pois existem compras ou reservas associadas a ele!");
        }

        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        Produto::destroy($id);

        return redirect('produto')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:nome,categoria',
        ], [
            'tipo.required' => "Selecione o campo da busca",
            'tipo.in' => "Campo de busca inválido",
        ]);

        if (!empty($request->valor)) {
            $dados = Produto::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Produto::All();
        }

        return view('produto.list', compact('dados'));
    }
}
