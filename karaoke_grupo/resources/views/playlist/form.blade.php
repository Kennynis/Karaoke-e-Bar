@extends('main')
@section('titulo', 'Formulário de Playlists')
@section('conteudo')
    @php
        if (!empty($data->id)) {
            $action = route('playlist.update', $data->id);
        } else {
            $action = route('playlist.store');
        }
    @endphp

    <h3 class="titulo mb-4">{{ !empty($data->id) ? 'Edite a' : 'Cadastre a' }} <span>Playlist</span></h3>

    <div class="cartao col-12 col-lg-8 mx-auto">
        <div class="cartao-topo">Preencha o formulário da playlist</div>
        <div class="cartao-corpo">
            <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (!empty($data->id))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                            value="{{ old('nome', $data->nome ?? '') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="genero">Gênero</label>
                        <input type="text" name="genero" id="genero" class="form-control"
                            value="{{ old('genero', $data->genero ?? '') }}">
                    </div>
                    <div class="col-12">
                        <label for="link">Link</label>
                        <input type="url" name="link" id="link" class="form-control" placeholder="https://"
                            value="{{ old('link', $data->link ?? '') }}">
                    </div>
                    <div class="col-12">
                        <label for="capa">Capa</label>
                        @if (!empty($data->capa))
                            <div><img src="{{ asset('storage/' . $data->capa) }}" class="imagem-form mb-2"
                                    alt="{{ $data->nome }}"></div>
                        @endif
                        <input type="file" name="capa" id="capa" class="form-control">
                        <small>PNG, JPG ou JPEG de até 2 MB</small>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ url('playlist') }}" class="btn btn-indigo">Voltar</a>
                    <button type="submit" class="btn btn-violeta">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
