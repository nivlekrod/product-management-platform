<!-- Show Product Modal usando componente reutilizável -->
<x-modal id="showProductModal" title="Detalhes do Produto" max-width="6xl" top-offset="10" />

<script>
    let currentShowProductId = null;
    let showModalManager = null;

    function openShowModal(productId) {
        currentShowProductId = productId;
        
        if (!showModalManager) {
            showModalManager = new ModalManager('showProductModal', {
                onOpen: () => {
                    HistoryManager.pushModal('show', productId);
                },
                onClose: () => {
                    // Don't reset currentShowProductId if we're opening edit modal
                    if (typeof editOpenedFromShow === 'undefined' || !editOpenedFromShow) {
                        currentShowProductId = null;
                        HistoryManager.pushIndex();
                    }
                }
            });
        }
        
        showModalManager.open(`/produtos/${productId}`);
    }

    function closeShowModal() {
        if (showModalManager) {
            showModalManager.close();
        }
    }

    function deleteFromModal(productId) {
        if (!confirm('Tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.')) {
            return;
        }

        ProdutoAPI.delete(productId)
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
</script>
