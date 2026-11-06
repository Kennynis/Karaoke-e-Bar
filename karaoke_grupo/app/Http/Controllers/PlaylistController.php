<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    public function index()
    {
        $dados = Playlist::with('reserva.usuario')->get();

        return view('playlist.list')->with(['dados' => $dados]);
    }

    function create()
    {
        return view('playlist.form');
    }

    function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:120',
            'genero' => 'required|max:50',
            'link' => 'required|url:http,https|max:150',
            'capa' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'nome.required' => "O nome é obrigatório",
            'nome.max' => "O nome deve ter no máximo :max caracteres",
            'genero.required' => "O gênero é obrigatório",
            'genero.max' => "O gênero deve ter no máximo :max caracteres",
            'link.required' => "O link é obrigatório",
            'link.url' => "O link deve ser um endereço válido, começando com http ou https",
            'link.max' => "O link deve ter no máximo :max caracteres",
            'capa.image' => "O arquivo deve ser uma imagem",
            'capa.mimes' => "A capa deve ser PNG, JPG ou JPEG",
            'capa.max' => "A capa deve ter no máximo 2 MB",
        ]);
    }

    function salvarCapa($capa)
    {
        $nome_imagem = date('YmdHis') . "." . $capa->extension();
        $diretorio = "imagem/playlist/";

        $capa->storeAs($diretorio, $nome_imagem, 'public');

        return $diretorio . $nome_imagem;
    }

    function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $capa = $request->file('capa');

        if ($capa) {
            $data['capa'] = $this->salvarCapa($capa);
        }

        Playlist::create($data);

        return redirect('playlist')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Playlist::findOrFail($id);

        return view('playlist.form')->with(compact('data'));
    }

    function update(Request $request, $id)
    {
        $this->validateForm($request);

        $playlist = Playlist::findOrFail($id);
        $data = $request->all();
        $capa = $request->file('capa');

        if ($capa) {
            if ($playlist->capa) {
                Storage::disk('public')->delete($playlist->capa);
            }
            $data['capa'] = $this->salvarCapa($capa);
        }

        $playlist->update($data);

        return redirect('playlist')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->reserva) {
            return redirect('playlist')->with("error", "Não é possível remover a playlist
                    $playlist->nome, pois ela está associada a uma reserva!");
        }

        if ($playlist->capa) {
            Storage::disk('public')->delete($playlist->capa);
        }

        Playlist::destroy($id);

        return redirect('playlist')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:nome,genero',
        ], [
            'tipo.required' => "Selecione o campo da busca",
            'tipo.in' => "Campo de busca inválido",
        ]);

        if (!empty($request->valor)) {
            $dados = Playlist::with('reserva.usuario')->where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Playlist::with('reserva.usuario')->get();
        }

        return view('playlist.list', compact('dados'));
    }
}
