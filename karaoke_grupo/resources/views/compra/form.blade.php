@extends('main')
@section('titulo', 'Formulário de Compras')
@section('conteudo')
    @php
        if (!empty($data->id)) {
            $action = route('compra.update', $data->id);
        } else {
            $action = route('compra.store');
        }
    @endphp

    <h3 class="titulo mb-4">{{ !empty($data->id) ? 'Edite a' : 'Cadastre a' }} <span>Compra</span></h3>

    <div class="cartao col-12 col-lg-8 mx-auto">
        <div class="cartao-topo">Preencha o formulário da compra</div>
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
                        <label for="data_compra">Data</label>
                        <input type="date" name="data_compra" id="data_compra" class="form-control"
                            value="{{ old('data_compra', !empty($data->id) ? $data->data_compra->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Estoque</th>
                                <th scope="col">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>
                                    <td class="text-nowrap">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                    <td>{{ $produto->estoque }}</td>
                                    <td>
                                        <input type="number" min="0" name="itens[{{ $produto->id }}]"
                                            class="form-control campo-quantidade" aria-label="Quantidade de {{ $produto->nome }}"
                                            value="{{ old('itens.' . $produto->id, $quantidades[$produto->id] ?? '') }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ url('compra') }}" class="btn btn-indigo">Voltar</a>
                    <button type="submit" class="btn btn-violeta">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
