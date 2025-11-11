class ModalManager {
    constructor(modalId, options = {}) {
        this.modalId = modalId;
        this.contentId = `${modalId}Content`;
        this.modal = document.getElementById(modalId);
        this.modalContent = document.getElementById(this.contentId);
        this.options = {
            fetchUrl: options.fetchUrl || null,
            onClose: options.onClose || null,
            onOpen: options.onOpen || null,
            ...options
        };
        
        this.setupEventListeners();
    }

    setupEventListeners() {
        this.modal?.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.close();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !this.modal.classList.contains('hidden')) {
                this.close();
            }
        });
    }

    open(fetchUrl = null) {
        this.modal.classList.remove('hidden');
        
        if (this.options.onOpen) {
            this.options.onOpen();
        }

        const url = fetchUrl || this.options.fetchUrl;
        if (url) {
            this.loadContent(url);
        }
    }

    close() {
        this.modal.classList.add('hidden');
        
        if (this.options.onClose) {
            this.options.onClose();
        }
    }

    loadContent(url) {
        this.showLoading();

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => response.text())
        .then(html => {
            this.modalContent.innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading modal content:', error);
            this.showError('Erro ao carregar os dados.');
        });
    }

    showLoading() {
        this.modalContent.innerHTML = `
            <div class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        `;
    }

    showError(message = 'Erro ao carregar os dados do produto.') {
        this.modalContent.innerHTML = `
            <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <p>${message}</p>
            </div>
        `;
    }

    setContent(html) {
        this.modalContent.innerHTML = html;
    }
}

const ProdutoAPI = {
    csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),

    async delete(productId) {
        const response = await fetch(`/produtos/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken
            }
        });
        return response.json();
    },

    async updateQuantity(productId, quantity) {
        const response = await fetch(`/produtos/${productId}/quantidade`, {
            method: 'PATCH',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({ quantidade: quantity })
        });
        return response.json();
    }
};

const HistoryManager = {
    pushModal(type, productId = null) {
        const urls = {
            create: '/produtos/create',
            edit: `/produtos/${productId}/edit`,
            show: `/produtos/${productId}`,
            index: '/produtos'
        };
        
        const state = { modal: type };
        if (productId) state.productId = productId;
        
        history.pushState(state, '', urls[type] || urls.index);
    },

    pushIndex() {
        history.pushState({ modal: null }, '', '/produtos');
    }
};

window.ModalManager = ModalManager;
window.ProdutoAPI = ProdutoAPI;
window.HistoryManager = HistoryManager;

