@extends('main')
@section('titulo', 'Formulário de Salas')
@section('conteudo')
    @php
        if (!empty($data->id)) {
            $action = route('sala.update', $data->id);
        } else {
            $action = route('sala.store');
        }

        $tipos = ['Pequena', 'Média', 'Grande'];
        $listaStatus = ['Disponível', 'Ocupada', 'Manutenção'];
    @endphp

    <h3 class="titulo mb-4">{{ !empty($data->id) ? 'Edite a' : 'Cadastre a' }} <span>Sala</span></h3>

    <div class="cartao col-12 col-lg-8 mx-auto">
        <div class="cartao-topo">Preencha o formulário da sala</div>
        <div class="cartao-corpo">
            <form action="{{ $action }}" method="post">
                @csrf
                @if (!empty($data->id))
                    @method('PUT')
                @endif

                <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="">Selecione</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo }}"
                                    {{ old('tipo', $data->tipo ?? '') == $tipo ? 'selected' : '' }}>
                                    {{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="capacidade">Capacidade</label>
                        <input type="number" name="capacidade" id="capacidade" class="form-control"
                            value="{{ old('capacidade', $data->capacidade ?? '') }}">
                        <small>Pequena até 5, Média até 12, Grande até 25</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="preco_hora">Preço por hora</label>
                        <input type="number" step="0.01" name="preco_hora" id="preco_hora" class="form-control"
                            value="{{ old('preco_hora', $data->preco_hora ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6">
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
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ url('sala') }}" class="btn btn-roxo">Voltar</a>
                    <button type="submit" class="btn btn-amarelo">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
