@extends('main')
@section('titulo', 'Formulário de Usuários')
@section('conteudo')
    @php
        if (!empty($data->id)) {
            $action = route('usuario.update', $data->id);
        } else {
            $action = route('usuario.store');
        }

        $tipos = ['Cliente', 'Funcionário'];
    @endphp

    <h3 class="titulo mb-4">{{ !empty($data->id) ? 'Edite o' : 'Cadastre o' }} <span>Usuário</span></h3>

    <div class="cartao col-12 col-lg-8 mx-auto">
        <div class="cartao-topo">Preencha o formulário do usuário</div>
        <div class="cartao-corpo">
            <form action="{{ $action }}" method="post">
                @csrf
                @if (!empty($data->id))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-12">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                            value="{{ old('nome', $data->nome ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00"
                            value="{{ old('cpf', $data->cpf ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="data_nascimento">Data de nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                            value="{{ old('data_nascimento', !empty($data->id) ? $data->data_nascimento->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-12">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" class="form-control"
                            value="{{ old('endereco', $data->endereco ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control"
                            value="{{ old('telefone', $data->telefone ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $data->email ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control">
                        @if (!empty($data->id))
                            <small>Deixe em branco para manter a senha atual</small>
                        @endif
                    </div>
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
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ url('usuario') }}" class="btn btn-indigo">Voltar</a>
                    <button type="submit" class="btn btn-violeta">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
