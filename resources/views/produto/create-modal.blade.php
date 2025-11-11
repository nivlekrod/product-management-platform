<!-- Modal Create Product -->
<div id="createProductModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-lg bg-white">
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Cadastrar Novo Produto</h2>
            <button onclick="closeCreateModal()" class="text-gray-600 hover:text-gray-900 transition duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div id="createModalContent" class="mb-6">
            <!-- Content will be loaded dynamically -->
            <div class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function openCreateModal() {
        const modal = document.getElementById('createProductModal');
        const modalContent = document.getElementById('createModalContent');
        
        modal.classList.remove('hidden');
        
        // Update URL
        history.pushState({ modal: 'create' }, '', '/produtos/create');
        
        // Fetch create form
        fetch('/produtos/create', {
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
                    <p>Erro ao carregar o formulário.</p>
                </div>
            `;
        });
    }

    function closeCreateModal() {
        document.getElementById('createProductModal').classList.add('hidden');
        
        // Restore URL to produtos list
        history.pushState({ modal: null }, '', '/produtos');
    }

    // Close modal when clicking outside
    document.getElementById('createProductModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCreateModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const createModal = document.getElementById('createProductModal');
            if (createModal && !createModal.classList.contains('hidden')) {
                closeCreateModal();
            }
        }
    });
</script>
