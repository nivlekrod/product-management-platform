<x-modal id="createProductModal" title="Cadastrar Novo Produto" max-width="4xl" top-offset="10" />

<script>
    let createModalManager = null;

    function openCreateModal() {
        if (!createModalManager) {
            createModalManager = new ModalManager('createProductModal', {
                onOpen: () => {
                    HistoryManager.pushModal('create');
                },
                onClose: () => {
                    HistoryManager.pushIndex();
                }
            });
        }
        createModalManager.open('/produtos/create');
    }

    function closeCreateModal() {
        if (createModalManager) {
            createModalManager.close();
        }
    }
</script>
