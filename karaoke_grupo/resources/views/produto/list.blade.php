@extends('main')
@section('titulo', 'Listagem de Produtos')
@section('conteudo')
    <h3 class="titulo mb-4">Nossos <span>Produtos</span></h3>

    <div class="cartao">
        <div class="cartao-topo">Listagem de produtos</div>
        <div class="cartao-corpo">
            <form action="{{ route('produto.search') }}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-3">
                        <label for="tipo">Buscar por</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="categoria">Categoria</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" id="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-violeta">Buscar</button>
                        <a href="{{ url('produto/create') }}" class="btn btn-indigo">Novo</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Alcoólico</th>
                            <th scope="col">Estoque</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <th scope='row'>{{ $item->id }}</th>
                                <td>
                                    @if ($item->imagem)
                                        <img src="{{ asset('storage/' . $item->imagem) }}" class="miniatura"
                                            alt="{{ $item->nome }}">
                                    @else
                                        <span class="sem-imagem">Sem imagem</span>
                                    @endif
                                </td>
                                <td>{{ $item->nome }}</td>
                                <td>{{ $item->categoria }}</td>
                                <td class="text-nowrap">R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                                <td>{{ $item->alcoolico ? 'Sim' : 'Não' }}</td>
                                <td>{{ $item->estoque }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class='btn btn-indigo btn-sm' title='Editar'
                                            href="{{ route('produto.edit', $item->id) }}">Editar</a>
                                        <form action="{{ route('produto.destroy', $item->id) }}" method="post">
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
