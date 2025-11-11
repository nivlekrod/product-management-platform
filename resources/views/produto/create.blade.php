@extends('layouts.produto-page')

@section('title', 'Cadastrar Produto')
@section('breadcrumb-label', 'Cadastrar Produto')
@section('page-title', 'Cadastrar Novo Produto')

@section('content')
    @include('produto.create-form')
@endsection
