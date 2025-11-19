// Ensure ModalManager is available globally
window.ModalManager = {
    open({ module, key, data = {}, onSubmit = null, onShown = null, onClose = null }) {
        let abortController = null; // Store the controller at module level

        // Abort the previous request if it exists
        if (abortController) {
            abortController.abort();
        }

        // Create a new controller for this request
        abortController = new AbortController();

        fetch(`/admin/ajax/modal/${module}/${key}?${new URLSearchParams(data).toString()}`, {
            signal: abortController.signal
        })
        .then(res => {
            if (!res.ok) throw new Error('Modal fetch failed');
            return res.json();
        })
        .then(modal => {
            const wrapper = document.getElementById('global-modal-container');

            const modalHeader = modal.header === true
                ? `<div class="modal-header">
                    <h5 class="modal-title">${modal.title}</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>`
                : '';

            wrapper.innerHTML = `
                <div class="modal fade" id="modal-dynamic" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-${modal.size}">
                        <div class="modal-content">
                            ${modalHeader}
                            ${modal.html}
                        </div>
                    </div>
                </div>
            `;

            const modalEl = document.getElementById('modal-dynamic');
            const bsModal = new bootstrap.Modal(modalEl);
            bsModal.show();

            modalEl.addEventListener('shown.bs.modal', () => {
                if (typeof onShown === 'function') onShown(modalEl);
            });

            modalEl.querySelectorAll('[data-modal-submit]').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    if (typeof onSubmit === 'function') onSubmit(modalEl);
                });
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                if (typeof onClose === 'function') onClose(modalEl);
            });

        })
        .catch(error => {
            if (error.name !== 'AbortError') {
                console.error('Modal fetch error:', error);
            }
        });
    }
};
