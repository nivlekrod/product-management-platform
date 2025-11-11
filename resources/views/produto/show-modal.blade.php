<!-- Modal Show Product -->
<div id="showProductModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-6xl shadow-lg rounded-lg bg-white my-10">
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Detalhes do Produto</h2>
            <button onclick="closeShowModal()" class="text-gray-600 hover:text-gray-900 transition duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div id="showModalContent" class="mb-6">
            <!-- Content will be loaded dynamically -->
            <div class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentShowProductId = null;

    function openShowModal(productId) {
        currentShowProductId = productId;
        const modal = document.getElementById('showProductModal');
        const modalContent = document.getElementById('showModalContent');
        
        modal.classList.remove('hidden');
        
        // Fetch product data
        fetch(`/produtos/${productId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => response.text())
        .then(html => {
            modalContent.innerHTML = html;
        })
        .catch(error => {
            modalContent.innerHTML = `
                <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <p>Erro ao carregar os dados do produto.</p>
                </div>
            `;
        });
    }

    function closeShowModal() {
        document.getElementById('showProductModal').classList.add('hidden');
        currentShowProductId = null;
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
                closeShowModal();
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
    }

    // Close modal when clicking outside
    document.getElementById('showProductModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeShowModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const showModal = document.getElementById('showProductModal');
            if (showModal && !showModal.classList.contains('hidden')) {
                closeShowModal();
            }
        }
    });
</script>
