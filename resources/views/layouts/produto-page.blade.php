<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Produto') - Sistema</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 @yield('container-width', 'max-w-4xl')">
        <!-- Header com breadcrumb -->
        <div class="mb-6">
            <nav class="flex items-center text-sm text-gray-600 mb-4">
                <a href="{{ route('produto.index') }}" class="hover:text-blue-600 transition-colors">Produtos</a>
                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">@yield('breadcrumb-label')</span>
            </nav>
            @hasSection('page-title')
                <h1 class="text-3xl font-bold text-gray-900">@yield('page-title')</h1>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            @yield('content')
        </div>
    </div>
    
    <script>
        // Define functions for standalone pages (not in modal context)
        let editOpenedFromShow = false;

        function closeShowModal() {
            window.location.href = '{{ route("produto.index") }}';
        }

        function openEditModal(productId) {
            // Check if we came from show page
            const referrer = document.referrer;
            if (referrer && referrer.includes(`/produtos/${productId}`) && !referrer.includes('/edit')) {
                // Store that we came from show page
                sessionStorage.setItem('returnToShow', productId);
            }
            window.location.href = `/produtos/${productId}/edit`;
        }

        function deleteFromModal(productId) {
            if (!confirm('Tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.')) {
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/produtos/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("produto.index") }}';
                } else {
                    alert(data.message || 'Erro ao deletar o produto.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao deletar o produto.');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
