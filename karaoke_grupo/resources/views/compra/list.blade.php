@extends('main')
@section('titulo', 'Listagem de Compras')
@section('conteudo')
    <h3 class="titulo mb-4">Nossas <span>Compras</span></h3>

    <div class="cartao">
        <div class="cartao-topo">Listagem de compras</div>
        <div class="cartao-corpo">
            <form action="{{ route('compra.search') }}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-3">
                        <label for="tipo">Buscar por</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="usuario">Cliente</option>
                            <option value="data_compra">Data (aaaa-mm-dd)</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" id="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-violeta">Buscar</button>
                        <a href="{{ url('compra/create') }}" class="btn btn-indigo">Novo</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Data</th>
                            <th scope="col">Produtos</th>
                            <th scope="col">Valor total</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <th scope='row'>{{ $item->id }}</th>
                                <td>{{ $item->usuario->nome }}</td>
                                <td>{{ $item->data_compra->format('d/m/Y') }}</td>
                                <td>
                                    @foreach ($item->itens as $itemCompra)
                                        <div>{{ $itemCompra->quantidade }}x {{ $itemCompra->produto->nome }}</div>
                                    @endforeach
                                </td>
                                <td class="text-nowrap">R$ {{ number_format($item->valor_total, 2, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class='btn btn-indigo btn-sm' title='Editar'
                                            href="{{ route('compra.edit', $item->id) }}">Editar</a>
                                        <form action="{{ route('compra.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='btn btn-violeta btn-sm' title='Excluir'
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
