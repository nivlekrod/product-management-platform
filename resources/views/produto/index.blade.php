<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestão de Produtos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Gestão de Produtos</h1>
                <a href="{{ route('produto.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center gap-2" onclick="event.preventDefault(); openCreateModal();">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Novo Produto
                </a>
            </div>

            <!-- Success Message -->
            <div id="successMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span id="successMessageText"></span>
            </div>

            <!-- Error Message -->
            <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span id="errorMessageText"></span>
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>

            <!-- Products Table Container -->
            <div id="productsTableContainer" class="hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Products will be loaded here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Nenhum produto cadastrado</h3>
                <p class="mt-1 text-sm text-gray-500">Comece criando um novo produto.</p>
                <div class="mt-6">
                    <a href="{{ route('produto.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700" onclick="event.preventDefault(); openCreateModal();">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Novo Produto
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('produto.edit-modal')
    @include('produto.create-modal')
    @include('produto.show-modal')

    <script>
        // Setup CSRF token for all AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Global flag to track if edit modal was opened from show modal
        let editOpenedFromShow = false;
        
        // Helper function to get stock status HTML
        function getStockStatusHtml(quantity) {
            if (quantity === 0) {
                return '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Esgotado</span>';
            } else if (quantity < 10) {
                return '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Estoque Baixo</span>';
            } else {
                return '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Em Estoque</span>';
            }
        }

        // Helper function to get quantity color class
        function getQuantityColorClass(quantity) {
            return quantity < 10 ? 'text-red-600' : 'text-green-600';
        }

        // Global function to open edit modal from show modal
        function openEditModalFromShow(productId) {
            closeShowModal();
            editOpenedFromShow = true; // Set flag that edit was opened from show
            openEditModal(productId);
        }

        // Load products on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadProdutos();
            
            // Check URL on page load to open modal if needed
            checkUrlAndOpenModal();
        });
        
        // Handle browser back/forward buttons
        window.addEventListener('popstate', function(event) {
            checkUrlAndOpenModal();
        });
        
        // Function to check URL and open appropriate modal
        function checkUrlAndOpenModal() {
            const path = window.location.pathname;
            const match = path.match(/^\/produtos\/(\d+)$/);
            
            if (match) {
                const productId = match[1];
                const state = history.state;
                
                // Close all modals first
                closeAllModals();
                
                // Open the appropriate modal based on state or default to show
                if (state && state.modal === 'edit') {
                    openEditModal(productId);
                } else {
                    openShowModal(productId);
                }
            } else if (path === '/produtos/create') {
                closeAllModals();
                openCreateModal();
            } else {
                // Close all modals if we're on /produtos
                closeAllModals();
            }
        }
        
        // Function to close all modals without updating URL
        function closeAllModals() {
            const editModal = document.getElementById('editProductModal');
            const showModal = document.getElementById('showProductModal');
            const createModal = document.getElementById('createProductModal');
            
            if (editModal) editModal.classList.add('hidden');
            if (showModal) showModal.classList.add('hidden');
            if (createModal) createModal.classList.add('hidden');
        }

        // Function to load produtos via AJAX
        function loadProdutos() {
            const loadingState = document.getElementById('loadingState');
            const tableContainer = document.getElementById('productsTableContainer');
            const emptyState = document.getElementById('emptyState');
            
            loadingState.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            emptyState.classList.add('hidden');

            fetch('/produtos/list', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                loadingState.classList.add('hidden');
                
                if (data.produtos && data.produtos.length > 0) {
                    renderProdutos(data.produtos);
                    tableContainer.classList.remove('hidden');
                } else {
                    emptyState.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                loadingState.classList.add('hidden');
                showError('Erro ao carregar os produtos.');
            });
        }

        // Function to render produtos in the table
        function renderProdutos(produtos) {
            const tbody = document.getElementById('productsTableBody');
            tbody.innerHTML = '';

            produtos.forEach(produto => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50 transition duration-150';
                tr.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${produto.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${escapeHtml(produto.nome)}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                        ${escapeHtml(produto.descricao.substring(0, 50))}${produto.descricao.length > 50 ? '...' : ''}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-green-600">
                            R$ ${formatPrice(produto.preco)}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <button onclick="updateQuantity(${produto.id}, -1)" class="flex items-center justify-center w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded transition duration-150 font-bold text-sm">
                                −
                            </button>
                            <span id="quantity-${produto.id}" class="text-sm font-semibold ${getQuantityColorClass(produto.quantidade)} min-w-[30px] text-center">
                                ${produto.quantidade}
                            </span>
                            <button onclick="updateQuantity(${produto.id}, 1)" class="flex items-center justify-center w-7 h-7 bg-green-500 hover:bg-green-600 text-white rounded transition duration-150 font-bold text-sm">
                                +
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${getStockStatusHtml(produto.quantidade)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex gap-2">
                            <button onclick="openShowModal(${produto.id})" class="text-green-600 hover:text-green-900 transition duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button onclick="openEditModal(${produto.id})" class="text-yellow-600 hover:text-yellow-900 transition duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button onclick="deleteProduto(${produto.id})" class="text-red-600 hover:text-red-900 transition duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Function to delete produto via AJAX
        function deleteProduto(produtoId) {
            if (!confirm('Tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.')) {
                return;
            }

            fetch(`/produtos/${produtoId}`, {
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
                    showSuccess(data.message || 'Produto deletado com sucesso.');
                    loadProdutos(); // Reload the products list
                } else {
                    showError(data.message || 'Erro ao deletar o produto.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Erro ao deletar o produto.');
            });
        }

        // Function to update quantity via AJAX
        function updateQuantity(produtoId, change) {
            const quantitySpan = document.getElementById(`quantity-${produtoId}`);
            const currentQuantity = parseInt(quantitySpan.textContent);
            const newQuantity = currentQuantity + change;

            // Don't allow negative quantities
            if (newQuantity < 0) {
                return;
            }

            // Optimistic UI update
            quantitySpan.textContent = newQuantity;
            quantitySpan.className = `text-sm font-semibold ${getQuantityColorClass(newQuantity)} min-w-[30px] text-center`;

            // Update status badge in the same row
            const row = quantitySpan.closest('tr');
            const statusCell = row.cells[5]; // Status column is the 6th cell (index 5)
            statusCell.innerHTML = getStockStatusHtml(newQuantity);

            // Send update to server using centralized API
            ProdutoAPI.updateQuantity(produtoId, newQuantity)
                .then(data => {
                    if (!data.success) {
                        // Revert on error
                        quantitySpan.textContent = currentQuantity;
                        quantitySpan.className = `text-sm font-semibold ${getQuantityColorClass(currentQuantity)} min-w-[30px] text-center`;
                        statusCell.innerHTML = getStockStatusHtml(currentQuantity);
                        showError(data.message || 'Erro ao atualizar quantidade.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Revert on error
                    quantitySpan.textContent = currentQuantity;
                    quantitySpan.className = `text-sm font-semibold ${getQuantityColorClass(currentQuantity)} min-w-[30px] text-center`;
                    statusCell.innerHTML = getStockStatusHtml(currentQuantity);
                    showError('Erro ao atualizar quantidade.');
                });
        }

        // Helper functions
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatPrice(price) {
            return parseFloat(price).toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function showSuccess(message) {
            const successMessage = document.getElementById('successMessage');
            const successMessageText = document.getElementById('successMessageText');
            successMessageText.textContent = message;
            successMessage.classList.remove('hidden');
            
            setTimeout(() => {
                successMessage.classList.add('hidden');
            }, 5000);
        }

        function showError(message) {
            const errorMessage = document.getElementById('errorMessage');
            const errorMessageText = document.getElementById('errorMessageText');
            errorMessageText.textContent = message;
            errorMessage.classList.remove('hidden');
            
            setTimeout(() => {
                errorMessage.classList.add('hidden');
            }, 5000);
        }
    </script>
</body>
</html>
