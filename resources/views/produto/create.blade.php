   {{-- create.blade.php (10 linhas em vez de 27) --}}
     @extends('layouts.produto-page')

     @section('title', 'Cadastrar Produto')
     @section('breadcrumb-label', 'Cadastrar Produto')
     @section('page-title', 'Cadastrar Novo Produto')

     @section('content')
         @include('produto.create-form')
     @endsection
