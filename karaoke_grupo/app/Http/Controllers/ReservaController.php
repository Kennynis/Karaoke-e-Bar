<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Reserva;
use App\Models\Sala;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $dados = Reserva::with(['sala', 'usuario', 'playlist'])->get();

        return view('reserva.list')->with(['dados' => $dados]);
    }

    function create()
    {
        $salas = Sala::All();
        $usuarios = Usuario::orderBy('nome')->get();
        $playlists = Playlist::doesntHave('reserva')->orderBy('nome')->get();

        return view('reserva.form')->with(compact('salas', 'usuarios', 'playlists'));
    }

    function validateForm(Request $request, $id = 'NULL')
    {
        $regraData = $id == 'NULL' ? 'required|date|after_or_equal:today' : 'required|date';

        $request->validate([
            'sala_id' => 'required|exists:salas,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'playlist_id' => "required|exists:playlists,id|unique:reservas,playlist_id,$id",
            'data_reserva' => $regraData,
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fim' => 'required|date_format:H:i|after:horario_inicio',
            'quantidade_pessoas' => 'required|integer|min:1',
            'status' => 'required|in:Pendente,Confirmada,Cancelada',
            'motivo_cancelamento' => 'required_if:status,Cancelada|nullable|max:225',
        ], [
            'sala_id.required' => "A sala é obrigatória",
            'sala_id.exists' => "A sala selecionada não existe",
            'usuario_id.required' => "O cliente é obrigatório",
            'usuario_id.exists' => "O cliente selecionado não existe",
            'playlist_id.required' => "A playlist é obrigatória",
            'playlist_id.exists' => "A playlist selecionada não existe",
            'playlist_id.unique' => "Esta playlist já está em outra reserva",
            'data_reserva.required' => "A data é obrigatória",
            'data_reserva.date' => "A data deve ser válida",
            'data_reserva.after_or_equal' => "A data da reserva não pode estar no passado",
            'horario_inicio.required' => "O horário de início é obrigatório",
            'horario_inicio.date_format' => "O horário de início deve estar no formato 00:00",
            'horario_fim.required' => "O horário de fim é obrigatório",
            'horario_fim.date_format' => "O horário de fim deve estar no formato 00:00",
            'horario_fim.after' => "O horário de fim deve ser depois do início",
            'quantidade_pessoas.required' => "A quantidade de pessoas é obrigatória",
            'quantidade_pessoas.integer' => "A quantidade de pessoas deve ser um número inteiro",
            'quantidade_pessoas.min' => "A quantidade deve ser de pelo menos :min pessoa",
            'status.required' => "O status é obrigatório",
            'status.in' => "O status deve ser Pendente, Confirmada ou Cancelada",
            'motivo_cancelamento.required_if' => "Informe o motivo do cancelamento",
            'motivo_cancelamento.max' => "O motivo deve ter no máximo :max caracteres",
        ]);
    }

    function verificarSala(Request $request, $id = 0)
    {
        if ($request->status == 'Cancelada') {
            return null;
        }

        $sala = Sala::find($request->sala_id);

        if ($sala->status == 'Manutenção') {
            return "Esta sala está em manutenção";
        }

        if ($request->quantidade_pessoas > $sala->capacidade) {
            return "Esta sala comporta no máximo $sala->capacidade pessoas";
        }

        $ocupada = Reserva::where('sala_id', $sala->id)
            ->where('data_reserva', $request->data_reserva)
            ->where('status', '!=', 'Cancelada')
            ->where('id', '!=', $id)
            ->where('horario_inicio', '<', $request->horario_fim)
            ->where('horario_fim', '>', $request->horario_inicio)
            ->exists();

        if ($ocupada) {
            return "Esta sala já está reservada nesse horário";
        }

        return null;
    }

    function store(Request $request)
    {
        $this->validateForm($request);

        $erro = $this->verificarSala($request);

        if ($erro) {
            return back()->withInput()->with("error", $erro);
        }

        $data = $request->all();
        $data['menor_presente'] = $request->has('menor_presente');
        $data['data_cancelamento'] = $request->status == 'Cancelada' ? now() : null;
        $data['motivo_cancelamento'] = $request->status == 'Cancelada' ? $request->motivo_cancelamento : null;

        Reserva::create($data);

        return redirect('reserva')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Reserva::findOrFail($id);
        $salas = Sala::All();
        $usuarios = Usuario::orderBy('nome')->get();
        $playlists = Playlist::doesntHave('reserva')
            ->orWhere('id', $data->playlist_id)
            ->orderBy('nome')
            ->get();

        return view('reserva.form')->with(compact('data', 'salas', 'usuarios', 'playlists'));
    }

    function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);

        $this->validateForm($request, $reserva->id);

        $erro = $this->verificarSala($request, $reserva->id);

        if ($erro) {
            return back()->withInput()->with("error", $erro);
        }

        $data = $request->all();
        $data['menor_presente'] = $request->has('menor_presente');
        $data['data_cancelamento'] = $request->status == 'Cancelada' ? ($reserva->data_cancelamento ?? now()) : null;
        $data['motivo_cancelamento'] = $request->status == 'Cancelada' ? $request->motivo_cancelamento : null;

        $reserva->update($data);

        return redirect('reserva')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        Reserva::findOrFail($id)->delete();

        return redirect('reserva')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:usuario,playlist,data_reserva,status',
        ], [
            'tipo.required' => "Selecione o campo da busca",
            'tipo.in' => "Campo de busca inválido",
        ]);

        $busca = Reserva::with(['sala', 'usuario', 'playlist']);

        if (!empty($request->valor)) {
            if ($request->tipo == 'usuario') {
                $busca->whereHas('usuario', function ($query) use ($request) {
                    $query->where('nome', 'like', "%$request->valor%");
                });
            } elseif ($request->tipo == 'playlist') {
                $busca->whereHas('playlist', function ($query) use ($request) {
                    $query->where('nome', 'like', "%$request->valor%");
                });
            } else {
                $busca->where($request->tipo, 'like', "%$request->valor%");
            }
        }

        $dados = $busca->get();

        return view('reserva.list', compact('dados'));
    }
}
