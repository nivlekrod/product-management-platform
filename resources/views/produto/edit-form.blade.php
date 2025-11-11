<!-- Success Message -->
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<!-- Error Messages -->
@if ($errors->any())
    <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-semibold mb-2">Ops! Há alguns erros no formulário:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<!-- Form -->
<form action="{{ route('produto.update', $produto->id) }}" method="POST" class="space-y-6" id="editProductForm">
    @csrf
    @method('PUT')

    <!-- Nome -->
    <div>
        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
            Nome do Produto <span class="text-red-500">*</span>
        </label>
        <input 
            type="text" 
            name="nome" 
            id="nome" 
            value="{{ old('nome', $produto->nome) }}"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('nome') border-red-500 @enderror"
            placeholder="Digite o nome do produto"
        />
        @error('nome')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Descrição -->
    <div>
        <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">
            Descrição <span class="text-red-500">*</span>
        </label>
        <textarea 
            name="descricao" 
            id="descricao" 
            rows="4"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('descricao') border-red-500 @enderror"
            placeholder="Descreva o produto"
        >{{ old('descricao', $produto->descricao) }}</textarea>
        @error('descricao')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Grid: Preço e Quantidade -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Preço -->
        <div>
            <label for="preco" class="block text-sm font-medium text-gray-700 mb-2">
                Preço (R$) <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">R$</span>
                </div>
                <input 
                    type="number" 
                    name="preco" 
                    id="preco" 
                    value="{{ old('preco', $produto->preco) }}"
                    step="0.01"
                    min="0"
                    required
                    class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('preco') border-red-500 @enderror"
                    placeholder="0,00"
                />
            </div>
            @error('preco')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Quantidade -->
        <div>
            <label for="quantidade" class="block text-sm font-medium text-gray-700 mb-2">
                Quantidade em Estoque <span class="text-red-500">*</span>
            </label>
            <input 
                type="number" 
                name="quantidade" 
                id="quantidade" 
                value="{{ old('quantidade', $produto->quantidade) }}"
                min="0"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('quantidade') border-red-500 @enderror"
                placeholder="0"
            />
            @error('quantidade')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Info Helper -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div class="text-sm text-blue-700">
                <p class="mb-1">Produto cadastrado em: <span class="font-semibold">{{ $produto->created_at->format('d/m/Y H:i') }}</span></p>
                <p>Última atualização: <span class="font-semibold">{{ $produto->updated_at->format('d/m/Y H:i') }}</span></p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 pt-4 border-t border-gray-200">
        <button 
            type="submit"
            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow-md"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Salvar Alterações
        </button>
        
        <button 
            type="button"
            onclick="closeEditModal()"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Cancelar
        </button>
    </div>
</form>

<!-- Delete Section -->
<div class="mt-8 pt-6 border-t border-gray-200">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Zona de Perigo</h3>
    <p class="text-sm text-gray-600 mb-4">Ao deletar o produto, todos os dados serão removidos permanentemente.</p>
    <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.');" id="deleteProductForm">
        @csrf
        @method('DELETE')
        <button 
            type="submit"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Deletar Produto
        </button>
    </form>
</div>

<script>
// Handle form submission in modal context
if (window.location.pathname.includes('/produtos') && !window.location.pathname.includes('/edit')) {
    const editForm = document.getElementById('editProductForm');
    const deleteForm = document.getElementById('deleteProductForm');
    
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const actionUrl = this.action;
            
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof editOpenedFromShow !== 'undefined') {
                        editOpenedFromShow = false; // Reset flag after successful save
                    }
                    closeEditModal();
                    if (typeof showSuccess === 'function') {
                        showSuccess(data.message || 'Produto atualizado com sucesso.');
                    }
                    if (typeof loadProdutos === 'function') {
                        loadProdutos();
                    }
                } else {
                    if (typeof showError === 'function') {
                        showError(data.message || 'Erro ao atualizar o produto.');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof showError === 'function') {
                    showError('Erro ao atualizar o produto.');
                }
            });
        });
    }
    
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!confirm('Tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.')) {
                return;
            }
            
            const formData = new FormData(this);
            const actionUrl = this.action;
            
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof editOpenedFromShow !== 'undefined') {
                        editOpenedFromShow = false; // Reset flag after successful delete
                    }
                    closeEditModal();
                    if (typeof showSuccess === 'function') {
                        showSuccess(data.message || 'Produto deletado com sucesso.');
                    }
                    if (typeof loadProdutos === 'function') {
                        loadProdutos();
                    }
                } else {
                    if (typeof showError === 'function') {
                        showError(data.message || 'Erro ao deletar o produto.');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof showError === 'function') {
                    showError('Erro ao deletar o produto.');
                }
            });
        });
    }
}
</script>
