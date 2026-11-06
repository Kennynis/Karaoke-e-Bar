@extends('main')
@section('titulo', 'Listagem de Usuários')
@section('conteudo')
    <h3 class="titulo mb-4">Nossos <span>Usuários</span></h3>

    <div class="cartao">
        <div class="cartao-topo">Listagem de usuários</div>
        <div class="cartao-corpo">
            <form action="{{ route('usuario.search') }}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-3">
                        <label for="tipo">Buscar por</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                            <option value="email">E-mail</option>
                            <option value="tipo">Tipo</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" id="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-violeta">Buscar</button>
                        <a href="{{ url('usuario/create') }}" class="btn btn-indigo">Novo</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <th scope='row'>{{ $item->id }}</th>
                                <td>{{ $item->nome }}</td>
                                <td class="text-nowrap">{{ $item->cpf }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="text-nowrap">{{ $item->telefone }}</td>
                                <td>{{ $item->data_nascimento->format('d/m/Y') }}</td>
                                <td>{{ $item->tipo }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class='btn btn-indigo btn-sm' title='Editar'
                                            href="{{ route('usuario.edit', $item->id) }}">Editar</a>
                                        <form action="{{ route('usuario.destroy', $item->id) }}" method="post">
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
