@extends('layouts.app')

@section('content')
    <h1>Categorias</h1>
    <a href="{{ route('categorias.create') }}">Adicionar Categoria</a>
    <ul>
        @foreach($categorias as $categoria)
            <li>{{ $categoria->nome }}</li>
        @endforeach
    </ul>
@endsection
