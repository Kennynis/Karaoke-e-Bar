@extends('main')
@section('titulo', 'Formulário de Produtos')
@section('conteudo')
    @php
        if (!empty($data->id)) {
            $action = route('produto.update', $data->id);
        } else {
            $action = route('produto.store');
        }

        $categorias = ['Comida', 'Bebida'];
    @endphp

    <h3 class="titulo mb-4">{{ !empty($data->id) ? 'Edite o' : 'Cadastre o' }} <span>Produto</span></h3>

    <div class="cartao col-12 col-lg-8 mx-auto">
        <div class="cartao-topo">Preencha o formulário do produto</div>
        <div class="cartao-corpo">
            <form action="{{ $action }}" method="post" enctype="multipart/form-data">
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
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">Selecione</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria }}"
                                    {{ old('categoria', $data->categoria ?? '') == $categoria ? 'selected' : '' }}>
                                    {{ $categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="preco">Preço</label>
                        <input type="number" step="0.01" name="preco" id="preco" class="form-control"
                            value="{{ old('preco', $data->preco ?? '') }}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="estoque">Estoque</label>
                        <input type="number" name="estoque" id="estoque" class="form-control"
                            value="{{ old('estoque', $data->estoque ?? '') }}">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" name="alcoolico" id="alcoolico" class="form-check-input" value="1"
                                {{ old('alcoolico', $data->alcoolico ?? false) ? 'checked' : '' }}>
                            <label for="alcoolico" class="form-check-label">Bebida alcoólica</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="imagem">Imagem</label>
                        @if (!empty($data->imagem))
                            <div><img src="{{ asset('storage/' . $data->imagem) }}" class="imagem-form mb-2"
                                    alt="{{ $data->nome }}"></div>
                        @endif
                        <input type="file" name="imagem" id="imagem" class="form-control">
                        <small>PNG, JPG ou JPEG de até 2 MB</small>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ url('produto') }}" class="btn btn-indigo">Voltar</a>
                    <button type="submit" class="btn btn-violeta">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
