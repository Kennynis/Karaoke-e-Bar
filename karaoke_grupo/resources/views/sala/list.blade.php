@extends('main')
@section('titulo', 'Listagem de Salas')
@section('conteudo')
    <h3 class="titulo mb-4">Nossas <span>Salas</span></h3>

    <div class="cartao">
        <div class="cartao-topo">Listagem de salas</div>
        <div class="cartao-corpo">
            <form action="{{ route('sala.search') }}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-3">
                        <label for="tipo">Buscar por</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="tipo">Tipo da sala</option>
                            <option value="capacidade">Capacidade</option>
                            <option value="status">Status</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" id="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-roxo">Buscar</button>
                        <a href="{{ url('sala/create') }}" class="btn btn-amarelo">Novo</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-dark table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Capacidade</th>
                            <th scope="col">Preço por hora</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <th scope='row'>{{ $item->id }}</th>
                                <td>{{ $item->tipo }}</td>
                                <td>{{ $item->capacidade }}</td>
                                <td class="text-nowrap">R$ {{ number_format($item->preco_hora, 2, ',', '.') }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class='btn btn-amarelo btn-sm' title='Editar'
                                            href="{{ route('sala.edit', $item->id) }}">Editar</a>
                                        <form action="{{ route('sala.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='btn btn-roxo btn-sm' title='Excluir'
                                                onclick="return confirm('Deseja Excluir?')">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
