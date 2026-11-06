@extends('main')
@section('titulo', 'Formulário de Reservas')
@section('conteudo')
    @php
        if (!empty($data->id)) {
            $action = route('reserva.update', $data->id);
        } else {
            $action = route('reserva.store');
        }

        $listaStatus = ['Pendente', 'Confirmada', 'Cancelada'];
    @endphp

    <h3 class="titulo mb-4">{{ !empty($data->id) ? 'Edite a' : 'Cadastre a' }} <span>Reserva</span></h3>

    <div class="cartao col-12 col-lg-8 mx-auto">
        <div class="cartao-topo">Preencha o formulário da reserva</div>
        <div class="cartao-corpo">
            <form action="{{ $action }}" method="post">
                @csrf
                @if (!empty($data->id))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="usuario_id">Cliente</label>
                        <select name="usuario_id" id="usuario_id" class="form-select">
                            <option value="">Selecione</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ old('usuario_id', $data->usuario_id ?? '') == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="sala_id">Sala</label>
                        <select name="sala_id" id="sala_id" class="form-select">
                            <option value="">Selecione</option>
                            @foreach ($salas as $sala)
                                <option value="{{ $sala->id }}"
                                    {{ old('sala_id', $data->sala_id ?? '') == $sala->id ? 'selected' : '' }}>
                                    {{ $sala->id }} - {{ $sala->tipo }} (até {{ $sala->capacidade }} pessoas)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="playlist_id">Playlist</label>
                        <select name="playlist_id" id="playlist_id" class="form-select">
                            <option value="">Selecione</option>
                            @foreach ($playlists as $playlist)
                                <option value="{{ $playlist->id }}"
                                    {{ old('playlist_id', $data->playlist_id ?? '') == $playlist->id ? 'selected' : '' }}>
                                    {{ $playlist->nome }}</option>
                            @endforeach
                        </select>
                        <small>Aparecem só as playlists que não estão em outra reserva</small>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="data_reserva">Data</label>
                        <input type="date" name="data_reserva" id="data_reserva" class="form-control"
                            value="{{ old('data_reserva', !empty($data->id) ? $data->data_reserva->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="horario_inicio">Início</label>
                        <input type="time" name="horario_inicio" id="horario_inicio" class="form-control"
                            value="{{ old('horario_inicio', !empty($data->id) ? substr($data->horario_inicio, 0, 5) : '') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="horario_fim">Fim</label>
                        <input type="time" name="horario_fim" id="horario_fim" class="form-control"
                            value="{{ old('horario_fim', !empty($data->id) ? substr($data->horario_fim, 0, 5) : '') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="quantidade_pessoas">Quantidade de pessoas</label>
                        <input type="number" name="quantidade_pessoas" id="quantidade_pessoas" class="form-control"
                            value="{{ old('quantidade_pessoas', $data->quantidade_pessoas ?? '') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Selecione</option>
                            @foreach ($listaStatus as $status)
                                <option value="{{ $status }}"
                                    {{ old('status', $data->status ?? '') == $status ? 'selected' : '' }}>
                                    {{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-4 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="menor_presente" id="menor_presente" class="form-check-input"
                                value="1"
                                {{ old('menor_presente', $data->menor_presente ?? false) ? 'checked' : '' }}>
                            <label for="menor_presente" class="form-check-label">Haverá menores de idade</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="motivo_cancelamento">Motivo do cancelamento</label>
                        <input type="text" name="motivo_cancelamento" id="motivo_cancelamento" class="form-control"
                            value="{{ old('motivo_cancelamento', $data->motivo_cancelamento ?? '') }}">
                        <small>Preencha somente se o status for Cancelada</small>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ url('reserva') }}" class="btn btn-indigo">Voltar</a>
                    <button type="submit" class="btn btn-violeta">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
