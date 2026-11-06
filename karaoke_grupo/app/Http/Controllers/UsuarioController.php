<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $dados = Usuario::All();

        return view('usuario.list')->with(['dados' => $dados]);
    }

    function create()
    {
        return view('usuario.form');
    }

    function validateForm(Request $request, $id = 'NULL')
    {
        $regraSenha = $id == 'NULL' ? 'required|min:6|max:50' : 'nullable|min:6|max:50';

        $request->validate([
            'nome' => 'required|max:120',
            'cpf' => "required|size:14|unique:usuarios,cpf,$id",
            'endereco' => 'required|max:150',
            'data_nascimento' => 'required|date|before:today',
            'telefone' => 'required|max:20',
            'email' => "required|email|max:120|unique:usuarios,email,$id",
            'senha' => $regraSenha,
            'tipo' => 'required|in:Cliente,Funcionário',
        ], [
            'nome.required' => "O nome é obrigatório",
            'nome.max' => "O nome deve ter no máximo :max caracteres",
            'cpf.required' => "O CPF é obrigatório",
            'cpf.size' => "O CPF deve estar no formato 000.000.000-00",
            'cpf.unique' => "Este CPF já está cadastrado",
            'endereco.required' => "O endereço é obrigatório",
            'endereco.max' => "O endereço deve ter no máximo :max caracteres",
            'data_nascimento.required' => "A data de nascimento é obrigatória",
            'data_nascimento.date' => "A data de nascimento deve ser uma data válida",
            'data_nascimento.before' => "A data de nascimento deve ser anterior a hoje",
            'telefone.required' => "O telefone é obrigatório",
            'telefone.max' => "O telefone deve ter no máximo :max caracteres",
            'email.required' => "O e-mail é obrigatório",
            'email.email' => "O e-mail deve ser válido",
            'email.max' => "O e-mail deve ter no máximo :max caracteres",
            'email.unique' => "Este e-mail já está cadastrado",
            'senha.required' => "A senha é obrigatória",
            'senha.min' => "A senha deve ter pelo menos :min caracteres",
            'senha.max' => "A senha deve ter no máximo :max caracteres",
            'tipo.required' => "O tipo é obrigatório",
            'tipo.in' => "O tipo deve ser Cliente ou Funcionário",
        ]);
    }

    function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $data['senha'] = Hash::make($request->senha);

        Usuario::create($data);

        return redirect('usuario')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Usuario::findOrFail($id);

        return view('usuario.form')->with(compact('data'));
    }

    function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $this->validateForm($request, $usuario->id);

        $data = $request->all();

        if (!empty($request->senha)) {
            $data['senha'] = Hash::make($request->senha);
        } else {
            unset($data['senha']);
        }

        $usuario->update($data);

        return redirect('usuario')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->reservas->count() > 0 || $usuario->compras->count() > 0) {
            return redirect('usuario')->with("error", "Não é possível remover o usuário
                    $usuario->nome, pois existem reservas ou compras associadas a ele!");
        }
        Usuario::destroy($id);

        return redirect('usuario')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:nome,cpf,email,tipo',
        ], [
            'tipo.required' => "Selecione o campo da busca",
            'tipo.in' => "Campo de busca inválido",
        ]);

        if (!empty($request->valor)) {
            $dados = Usuario::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Usuario::All();
        }

        return view('usuario.list', compact('dados'));
    }
}
