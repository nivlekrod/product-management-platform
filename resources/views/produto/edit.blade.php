<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - {{ $produto->nome }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header com breadcrumb -->
        <div class="mb-6">
            <nav class="flex items-center text-sm text-gray-600 mb-4">
                <a href="{{ route('produto.index') }}" class="hover:text-blue-600 transition-colors">Produtos</a>
                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">Editar Produto</span>
            </nav>
            <h1 class="text-3xl font-bold text-gray-900">Editar Produto</h1>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            @include('produto.edit-form')
        </div>
    </div>
</body>
</html>
