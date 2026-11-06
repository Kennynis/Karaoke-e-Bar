@extends('main')
@section('titulo', 'Listagem de Reservas')
@section('conteudo')
    <h3 class="titulo mb-4">Nossas <span>Reservas</span></h3>

    <div class="cartao">
        <div class="cartao-topo">Listagem de reservas</div>
        <div class="cartao-corpo">
            <form action="{{ route('reserva.search') }}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-3">
                        <label for="tipo">Buscar por</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="usuario">Cliente</option>
                            <option value="playlist">Playlist</option>
                            <option value="data_reserva">Data (aaaa-mm-dd)</option>
                            <option value="status">Status</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" id="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-violeta">Buscar</button>
                        <a href="{{ url('reserva/create') }}" class="btn btn-indigo">Novo</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Sala</th>
                            <th scope="col">Playlist</th>
                            <th scope="col">Data</th>
                            <th scope="col">Horário</th>
                            <th scope="col">Pessoas</th>
                            <th scope="col">Menores</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <th scope='row'>{{ $item->id }}</th>
                                <td>{{ $item->usuario->nome }}</td>
                                <td class="text-nowrap">{{ $item->sala->id }} - {{ $item->sala->tipo }}</td>
                                <td>{{ $item->playlist->nome ?? 'Sem playlist' }}</td>
                                <td>{{ $item->data_reserva->format('d/m/Y') }}</td>
                                <td class="text-nowrap">{{ substr($item->horario_inicio, 0, 5) }} às {{ substr($item->horario_fim, 0, 5) }}</td>
                                <td>{{ $item->quantidade_pessoas }}</td>
                                <td>{{ $item->menor_presente ? 'Sim' : 'Não' }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class='btn btn-indigo btn-sm' title='Editar'
                                            href="{{ route('reserva.edit', $item->id) }}">Editar</a>
                                        <form action="{{ route('reserva.destroy', $item->id) }}" method="post">
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
