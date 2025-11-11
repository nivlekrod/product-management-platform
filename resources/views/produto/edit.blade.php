    {{-- edit.blade.php (10 linhas em vez de 27) --}}
         @extends('layouts.produto-page')

         @section('title', 'Editar Produto - ' . $produto->nome)
         @section('breadcrumb-label', 'Editar Produto')
         @section('page-title', 'Editar Produto')

         @section('content')
             @include('produto.edit-form')
         @endsection

         @push('scripts')
         <script>
             // Check if we should return to show page instead of index
             const returnToShow = sessionStorage.getItem('returnToShow');
             if (returnToShow == '{{ $produto->id }}') {
                 // Override closeEditModal to return to show page
                 const originalCloseEdit = window.closeEditModal;
                 window.closeEditModal = function() {
                     sessionStorage.removeItem('returnToShow');
                     window.location.href = `/produtos/${returnToShow}`;
                 };
             }
         </script>
         @endpush