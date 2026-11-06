@extends('main')
@section('titulo', 'Listagem de Playlists')
@section('conteudo')
    <h3 class="titulo mb-4">Nossas <span>Playlists</span></h3>

    <div class="cartao">
        <div class="cartao-topo">Listagem de playlists</div>
        <div class="cartao-corpo">
            <form action="{{ route('playlist.search') }}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-3">
                        <label for="tipo">Buscar por</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="genero">Gênero</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" id="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-violeta">Buscar</button>
                        <a href="{{ url('playlist/create') }}" class="btn btn-indigo">Novo</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Capa</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Gênero</th>
                            <th scope="col">Link</th>
                            <th scope="col">Reserva</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <th scope='row'>{{ $item->id }}</th>
                                <td>
                                    @if ($item->capa)
                                        <img src="{{ asset('storage/' . $item->capa) }}" class="miniatura"
                                            alt="{{ $item->nome }}">
                                    @else
                                        <span class="sem-imagem">Sem capa</span>
                                    @endif
                                </td>
                                <td>{{ $item->nome }}</td>
                                <td>{{ $item->genero }}</td>
                                <td>
                                    @if ($item->link)
                                        <a href="{{ $item->link }}" target="_blank" rel="noopener">Abrir</a>
                                    @endif
                                </td>
                                <td>{{ $item->reserva ? 'Nº ' . $item->reserva->id . ' - ' . $item->reserva->usuario->nome : 'Livre' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class='btn btn-indigo btn-sm' title='Editar'
                                            href="{{ route('playlist.edit', $item->id) }}">Editar</a>
                                        <form action="{{ route('playlist.destroy', $item->id) }}" method="post">
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
