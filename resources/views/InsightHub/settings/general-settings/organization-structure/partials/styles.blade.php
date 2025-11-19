<style>
    .top-heading {
        color: #2E2F38;
        font-size: 32.5px;
        font-weight: 600;
        line-height: 39px;
    }

    .custom-text-muted {
        color: #727790;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
    }

    .settings-card {
        padding: 24px;
        border-radius: 8px;
        border-right: 1px solid #F1F1F4;
        border-bottom: 1px solid #F1F1F4;
        border-left: 1px solid #F1F1F4;
        background: #FFF;
        box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.03);
    }

    .page-heading {
        color: #2E2F38;
        font-size: 32px;
        font-weight: 600;
    }

    .search-box {
        border: 1px solid #C8CFD9;
        border-radius: 8px;
        padding: 8px 14px;
        width: 250px;
    }

    .custom-btn {
        display: flex;
        height: 48px;
        padding: 8px 16px;
        justify-content: center;
        align-items: center;
        border-radius: 4px;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        line-height: 20px;
    }

    .custom-btn.orange-fill {
        background: #F7941C;
        color: #FFF;
        border: none;
    }

    .custom-btn.grey-outline {
        background: #fff;
        color: #727790;
        border: 1px solid #858BA6;
    }

    .os-table thead {
        background: #F5F7F8;
        color: #2E2F38;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
    }

    .os-table td,
    .os-table th {
        vertical-align: middle !important;
        color: #2E2F38 !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        line-height: 20px;
        border-bottom: 1px solid #ECF0F3 !important;
    }

    .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 470px;
    }

    .action-icons iconify-icon {
        color: #2E2F38;
    }

    .pagination .page-link {
        display: flex;
        width: 51px;
        height: 51px;
        padding: 16px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        color: #2E2F38;
        border: 1px solid #ECF0F3;
        margin: 0 4px;
        padding: 6px 12px;
        background: #FFF;
    }

    .pagination .active>.page-link {
        background: #F7941C;
        border-color: #F7941C;
        color: #FFF;
    }

    .results-select {
        border-radius: 8px;
        border: 1px solid #D0D5DD;
        padding: 6px;
    }

    .feedback-message {
        display: flex;
        border-radius: 8px;
        border: 1px solid #BBECC5;
        background: #DDF5E2;
        padding: 24px;
    }

    .feedback-message p {
        color: #19622A;
        font-size: 16px;
        font-weight: 400;
        line-height: 21px;
    }

    .feedback-message .icon {
        color: #727790;
    }

    .table:not(.table-bordered) td:first-child,
    .table:not(.table-bordered) th:first-child,
    .table:not(.table-bordered) tr:first-child,
    .table:not(.table-bordered) td:last-child,
    .table:not(.table-bordered) th:last-child,
    .table:not(.table-bordered) tr:last-child,
    .table:not(.table-bordered) tbody tr:last-child td,
    .table:not(.table-bordered) tbody tr:last-child th,
    .table:not(.table-bordered) tfoot tr:last-child td,
    .table:not(.table-bordered) tfoot tr:last-child th {
        padding-left: 9.750px;
        padding-right: 16px;
        border: 0;
        border-bottom: 1px solid #ECF0F3 !important;
    }

    input:focus-visible {
        outline: none;
    }

    .table-border {
        border-radius: 4px;
        border: 1px solid #ECF0F3;
    }

    .thead-icon {
        color: #C8CFD9;
    }

    .thead-icon:hover,
    .thead-icon:active {
        color: #F7941C;
    }

    .modal-body {
        background: #FCFCFC;
    }

    .delete-modal {
        border-radius: 12px;
        position: relative;
        text-align: center;
    }

    .delete-modal h5 {
        color: #2E2F38;
        font-size: 22.75px;
        font-weight: 600;
        line-height: 27.3px;
        margin-top: 12px;
        margin-bottom: 8px;
    }

    .delete-modal p {
        color: #727790;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        margin-bottom: 20px;
    }

    .warning-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 3px solid #F24130;
        color: #F24130;
        font-size: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-close-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        border: none;
        background: none;
        font-size: 22px;
        color: #727790;
        cursor: pointer;
    }

    .modal-custom-btn {
        display: flex;
        height: 48px;
        padding: 12px 16px;
        justify-content: center;
        align-items: center;
        flex: 1 0 0;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
    }

    .modal-cancel-btn {
        background: #FFF;
        color: #2E2F38;
        border: 1px solid #858BA6;
    }

    .modal-confirm-btn {
        background: #F24130;
        color: #FFF;
        border: 1px solid #F24130;
    }

    .sub-tab {
        border-radius: 8px;
        border: 1px solid #F7941C;
    }

    .nav-pills .nav-link {
        padding: 8px 16px;
        border-radius: 8px;
        color: #F7941C;
        font-size: 16px;
        font-weight: 600;
        border-radius: 0;
    }

    .nav-pills .nav-link.active {
        background: #F7941C;
        color: #fff !important;
    }

    .empty-state {
        text-align: center;
        display: flex;
        padding: 48px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        border: 1px dashed #C8CFD9;
    }

    .empty-state h5 {
        color: #2E2F38;
        font-size: 20px;
        font-weight: 600;
    }

    .empty-icon {
        margin: auto;
        display: flex;
        width: 48px;
        height: 48px;
        padding: 12px;
        justify-content: center;
        align-items: center;
        border-radius: 100px;
        background: #F5F7F8;
    }

    /* Validation styles */
    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .invalid-feedback.d-block {
        display: block !important;
    }
</style>
