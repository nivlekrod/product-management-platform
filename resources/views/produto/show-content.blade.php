<!-- Product Details Content for Modal -->
<div class="space-y-6">
    <!-- Breadcrumb and Product ID -->
    <div class="mb-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $produto->nome }}</h3>
                <p class="text-gray-600">Produto ID: <span class="font-medium text-gray-900">#{{ $produto->id }}</span></p>
            </div>
            <div class="flex gap-3">
                <button onclick="editOpenedFromShow = true; closeShowModal(); openEditModal({{ $produto->id }});" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Editar
                </button>
                <button onclick="deleteFromModal({{ $produto->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Excluir
                </button>
            </div>
        </div>
    </div>

    <!-- Grid principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Coluna principal (2/3) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Card de Informações Principais -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informações Principais
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Preço -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 border border-blue-200">
                            <label class="block text-xs font-semibold text-blue-700 uppercase tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Preço
                            </label>
                            <p class="text-3xl font-bold text-blue-900">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        </div>

                        <!-- Quantidade -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-5 border border-green-200">
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Quantidade em Estoque
                            </label>
                            <p class="text-3xl font-bold text-green-900">{{ $produto->quantidade }}</p>
                            <p class="text-sm text-green-600 mt-1">unidades disponíveis</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Descrição -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Descrição do Produto
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed text-justify">{{ $produto->descricao }}</p>
                </div>
            </div>
        </div>

        <!-- Coluna lateral (1/3) -->
        <div class="space-y-6">
            <!-- Card de Datas -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Datas
                    </h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="border-l-4 border-green-500 pl-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                            Data de Cadastro
                        </label>
                        <p class="text-lg font-bold text-gray-900">{{ $produto->created_at->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-600">às {{ $produto->created_at->format('H:i') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $produto->created_at->diffForHumans() }}</p>
                    </div>
                    
                    <div class="border-l-4 border-purple-500 pl-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                            Última atualização
                        </label>
                        <p class="text-lg font-bold text-gray-900">{{ $produto->updated_at->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-600">às {{ $produto->updated_at->format('H:i') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $produto->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Card de Status -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Status do Produto
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-center">
                        @if($produto->quantidade > 10)
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100 mb-3">
                                    <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <p class="text-xl font-bold text-green-900">Estoque OK</p>
                                <p class="text-sm text-gray-600 mt-1">Produto disponível</p>
                            </div>
                        @elseif($produto->quantidade > 0)
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-yellow-100 mb-3">
                                    <svg class="w-12 h-12 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <p class="text-xl font-bold text-yellow-900">Estoque Baixo</p>
                                <p class="text-sm text-gray-600 mt-1">Reabastecer em breve</p>
                            </div>
                        @else
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-100 mb-3">
                                    <svg class="w-12 h-12 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <p class="text-xl font-bold text-red-900">Esgotado</p>
                                <p class="text-sm text-gray-600 mt-1">Produto indisponível</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
