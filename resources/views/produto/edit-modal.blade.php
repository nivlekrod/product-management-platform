<!-- Modal Edit Product -->
<div id="editProductModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-lg bg-white">
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Editar Produto</h2>
            <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-900 transition duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div id="editModalContent" class="mb-6">
            <!-- Content will be loaded dynamically -->
            <div class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentEditProductId = null;

    function openEditModal(productId) {
        currentEditProductId = productId;
        const modal = document.getElementById('editProductModal');
        const modalContent = document.getElementById('editModalContent');
        
        modal.classList.remove('hidden');
        
        // Fetch product data
        fetch(`/produtos/${productId}/edit`, {
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

    function closeEditModal() {
        document.getElementById('editProductModal').classList.add('hidden');
        currentEditProductId = null;
    }

    // Close modal when clicking outside
    document.getElementById('editProductModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditModal();
        }
    });
</script>
