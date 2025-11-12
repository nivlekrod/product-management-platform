<x-modal id="editProductModal" title="Editar Produto" max-width="4xl" top-offset="10" />

<script>
    let currentEditProductId = null;
    let editModalManager = null;

    function openEditModal(productId) {
        currentEditProductId = productId;
        
        if (!editModalManager) {
            editModalManager = new ModalManager('editProductModal', {
                onOpen: () => {
                    HistoryManager.pushModal('edit', productId);
                },
                onClose: () => {
                    if (typeof editOpenedFromShow !== 'undefined' && editOpenedFromShow && currentShowProductId) {
                        console.log('Reopening show modal for product:', currentShowProductId);
                        openShowModal(currentShowProductId);
                    } else {
                        HistoryManager.pushIndex();
                        if (typeof currentShowProductId !== 'undefined') {
                            currentShowProductId = null;
                        }
                    }
                    
                    currentEditProductId = null;
                    if (typeof editOpenedFromShow !== 'undefined') {
                        editOpenedFromShow = false;
                    }
                }
            });
        }
        
        editModalManager.open(`/produtos/${productId}/edit`);
    }

    function closeEditModal() {
        console.log('closeEditModal called, editOpenedFromShow:', editOpenedFromShow, 'currentEditProductId:', currentEditProductId);
        if (editModalManager) {
            editModalManager.close();
        }
    }
</script>
