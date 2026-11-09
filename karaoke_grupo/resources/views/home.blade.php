@extends('main')
@section('conteudo')
    <div class="text-center py-5">
        <h1 class="chamada">cante a <span>SUA</span> Playlist</h1>
        <p class="col-md-8 mx-auto mt-4">O lugar perfeito para reunir amigos, cantar suas músicas favoritas e criar
            momentos inesquecíveis.</p>
        <hr class="col-md-8 mx-auto my-5">
        <a href="{{ url('sala') }}" class="btn btn-amarelo">Ver as salas</a>
    </div>
@stop
