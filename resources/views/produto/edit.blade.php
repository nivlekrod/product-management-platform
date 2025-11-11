@extends('layouts.produto-page')

@section('title', 'Editar Produto - ' . $produto->nome)
@section('breadcrumb-label', 'Editar Produto')
@section('page-title', 'Editar Produto')

@section('content')
    @include('produto.edit-form')
@endsection

@push('scripts')
    <script>
        const returnToShow = sessionStorage.getItem('returnToShow');
        if (returnToShow == '{{ $produto->id }}') {
            const originalCloseEdit = window.closeEditModal;
            window.closeEditModal = function() {
                sessionStorage.removeItem('returnToShow');
                window.location.href = `/produtos/${returnToShow}`;
            };
        }
    </script>
@endpush
