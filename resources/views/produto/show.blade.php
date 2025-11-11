@extends('layouts.produto-page')

@section('title', $produto->nome . ' - Detalhes do Produto')
@section('breadcrumb-label', $produto->nome)
@section('container-width', 'max-w-6xl')

@section('content')
    @include('produto.show-content')
@endsection
