@extends('insighthub.layout.app')

@section('title', 'Company Values')

@section('styles')
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
            line-height: 21px;
        }

        .text-truncate {
            display: -webkit-box;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            align-self: stretch;
            max-width: 770px;
        }

        .empty-state {
            text-align: center;
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

        .settings-card {
            padding: 24px;
            border-radius: 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.03);
        }

        .settings-card h6 {
            color: #2E2F38;
            font-size: 20px;
            font-weight: 600;
        }

        .field-label {
            color: #727790;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 21.5px;
        }

        .field-value {
            color: #2E2F38;
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
            margin-bottom: 44px;
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

    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Company Values
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Company Values</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3 " style="display:none;">
                <p id="feedbackText" class="text-center fw-medium m-0"></p>
                <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer" id="closeIcon"></iconify-icon>
            </div>
            @if(session('success'))
                <script>window.__serverFeedback = {!! json_encode(session('success')) !!};</script>
            @endif
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            @include('insighthub.settings.index')

            <!-- ✅ Tab Content -->
            <div class="tab-content">

                @if(session('success'))
                    <script>window.__serverFeedback = {!! json_encode(session('success')) !!};</script>
                @endif
                <div class="tab-pane fade show active" id="values" role="tabpanel">
                    <div class="empty-state">
                        <h4 class="m-0 top-heading my-8 text-start">Company Values</h4>
                        <div class="settings-card">

                            <div class="empty-icon mb-5">
                                <iconify-icon icon="mage:file-2" width="20" height="20"></iconify-icon>
                            </div>

                            <h5 class="m-0">No Company Values Yet</h5>

                            <p class="custom-text-muted mx-auto mb-5" style="max-width: 500px;">
                                Start by adding your company’s core values to help define your culture and guide your team.
                            </p>

                            <button class="custom-btn orange-fill m-auto" onclick="window.location='{{ route('insighthub.settings.company-values.create') }}'">
                                <span class="me-2 d-flex align-items-center"><iconify-icon icon="ic:round-plus"
                                        width="20" height="20"></iconify-icon></span> Add Company Value
                            </button>
                        </div>
                    </div>

                    <div class="main-state" style="display:none;">
                        <div class="d-flex align-items-center justify-content-between my-8">
                            <h4 class="m-0 top-heading text-start">Company Values</h4>

                            <!-- make this a link to your add page -->
                            <a class="custom-btn orange-fill"
                            href="/insighthub/settings/company-values/create">
                            <span class="me-2 d-flex align-items-center">
                                <iconify-icon icon="ic:round-plus" width="20" height="20"></iconify-icon>
                            </span>
                            Add Company Value
                            </a>
                        </div>

                        <!-- 🔹 create an empty div for dynamic values -->
                        <div id="valuesList"></div>
                    </div>
                </div>

                <!-- ✅ Organization Structure -->
                <div class="tab-pane fade" id="structure" role="tabpanel">
                    <div class="settings-card">
                        <h4>Organization Structure</h4>
                        <p class="custom-text-muted">Employee departments, hierarchy, onboarding processes...</p>
                    </div>
                </div>

                <!-- ✅ Email Templates -->
                <div class="tab-pane fade" id="email" role="tabpanel">
                    <div class="settings-card">
                        <h4>Email Templates</h4>
                        <p class="custom-text-muted">Setup onboarding and notification templates...</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCompanyValue" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content delete-modal p-6">

                <!-- Warning Icon -->
                <div class="d-flex justify-content-center">
                        <span><iconify-icon icon="ep:warning" width="70" height="70" style="color: #F24130;"></iconify-icon></span>
                </div>

                <!-- Title -->
                <h5>Delete Company Value?</h5>

                <!-- Message -->
                <p>
                    You’re about to delete this company value from the system.
                    This action can’t be undone. Are you sure you want to proceed?
                </p>

                <!-- Buttons -->
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="modal-custom-btn modal-cancel-btn"
                        data-bs-dismiss="modal">Cancel</button>

                    <button type="button" class="modal-custom-btn modal-confirm-btn" id="confirmDeleteBtn">
                        Confirm
                    </button>
                </div>

                <!-- Close icon -->
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">&times;</button>
            </div>
        </div>
    </div>


@endsection

{{-- @section('scripts')
    <script>
        const deleteModal = document.getElementById('deleteCompanyValue');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        const deleteText = document.getElementById('deleteConfirmText');

        let deleteId = null;

        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
            const valueName = button.getAttribute('data-name');

            deleteText.innerHTML = `Are you sure you want to delete <strong>${valueName}</strong>?`;

            confirmBtn.onclick = () => {
                console.log("Deleting ID:", deleteId);
                // ✅ Later: AJAX or Form submit for actual delete
            };
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    fetchCompanyValues();

    function fetchCompanyValues() {
        $.ajax({
            url: "/InsightHub/settings/company-values",
            method: "GET",
            success: function (response) {
                const container = $(".main-state");
                container.empty();

                if (response.data.data.length === 0) {
                    $(".empty-state").show();
                    $(".main-state").hide();
                } else {
                    $(".empty-state").hide();
                    $(".main-state").show();

                    response.data.data.forEach(value => {
                        container.append(`
                            <div class="settings-card d-flex justify-content-between align-items-between mb-3">
                                <div>
                                    <h6>${value.company_value_name}</h6>
                                    <p class="custom-text-muted m-0 text-truncate">
                                        ${value.company_value_description}
                                    </p>
                                </div>
                                <div class="action-icons d-flex align-items-center gap-10">
                                    <a href="/insighthub/settings/general-settings/company-values/view-company-values?id=${value.id}">
                                        <iconify-icon icon="solar:eye-outline" width="20" height="20" class="cursor-pointer"></iconify-icon>
                                    </a>
                                    <a href="/insighthub/settings/general-settings/company-values/edit-company-values?id=${value.id}">
                                        <iconify-icon icon="lucide:edit" width="20" height="20" class="cursor-pointer"></iconify-icon>
                                    </a>
                                    <iconify-icon icon="gg:trash" width="20" height="20" class="cursor-pointer"
                                        style="color: #F24130;"
                                        data-id="${value.id}"
                                        data-name="${value.company_value_name}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteCompanyValue">
                                    </iconify-icon>
                                </div>
                            </div>
                        `);
                    });
                }
            },
            error: function (err) {
                console.error("Failed to fetch company values:", err);
            }
        });
    }
});


$('#confirmDeleteBtn').on('click', function () {
    if (!deleteId) return;

    $.ajax({
        url: `/admin/settings/company-values/${deleteId}`,
        method: "DELETE",
        success: function () {
            $('#deleteCompanyValue').modal('hide');
            toastr.success("Company Value deleted successfully!");
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        error: function () {
            toastr.error("Failed to delete company value!");
        }
    });
});

    </script>

@endsection --}}

@section('scripts')
<script>
$(function () {
  // start with both hidden; show one after fetch
  $('.empty-state').hide();
  $('.main-state').hide();

    // helper to show top feedback message dynamically
    function showFeedback(message, type = 'success') {
        try {
            const container = $('#feedbackMessage');
            const text = $('#feedbackText');
            if (!container.length || !text.length) return;
            const prefix = type === 'success' ? '<b>Success!</b> ' : (type === 'error' ? '<b>Error!</b> ' : '');
            text.html(prefix + escapeHtml(message));
            container.stop(true, true).show().css('display', 'flex');
            setTimeout(() => { container.fadeOut(); }, 4000);
        } catch (e) { console.error('showFeedback error', e); }
    }

    // allow manual close
    $(document).on('click', '#closeIcon', function () { $('#feedbackMessage').hide(); });

  fetchCompanyValues();

  function fetchCompanyValues() {
    $.ajax({
      url: '/insighthub/settings/company-values',
      method: 'GET',
      success: function (response) {
        // be tolerant of both shapes: {data:[...]} or {data:{data:[...]}}
        const list = ($('#valuesList'));
        list.empty();

        const rows =
          (response?.data?.data ?? response?.data ?? []);

        if (!rows.length) {
          $('.empty-state').show();
          $('.main-state').hide();
          return;
        }

        $('.empty-state').hide();
        $('.main-state').show();

        rows.forEach(v => {
          list.append(`
            <div class="settings-card d-flex justify-content-between align-items-between mb-3">
              <div>
                <h6>${escapeHtml(v.company_value_name ?? '')}</h6>
                <p class="custom-text-muted m-0 text-truncate">
                  ${escapeHtml(v.company_value_description ?? '')}
                </p>
              </div>

              <div class="action-icons d-flex align-items-center gap-10">
                <a href="/insighthub/settings/company-values/${v.id}/show">
                  <iconify-icon icon="solar:eye-outline" width="20" height="20"></iconify-icon>
                </a>
                <a href="/insighthub/settings/company-values/${v.id}/edit">
                  <iconify-icon icon="lucide:edit" width="20" height="20"></iconify-icon>
                </a>
                <a href="#" class="delete-trigger" data-id="${v.id}" data-name="${escapeHtml(v.company_value_name ?? '')}"
                   data-bs-toggle="modal" data-bs-target="#deleteCompanyValue">
                  <iconify-icon icon="gg:trash" width="20" height="20" style="color:#F24130"></iconify-icon>
                </a>
              </div>
            </div>
          `);
        });
      },
      error: function (xhr) {
        console.error('Error fetching values:', xhr.responseText || xhr.statusText);
        $('.empty-state').show();
        $('.main-state').hide();
      }
    });
  }

  // --- Delete handling (event delegation for dynamic items)
  let deleteId = null;
  $(document).on('click', '.delete-trigger', function () {
    deleteId = $(this).data('id');
  });

  $('#confirmDeleteBtn').on('click', function () {
    if (!deleteId) return;
    $.ajax({
            url: `/insighthub/settings/company-values/${deleteId}`,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            success: function (response) {
                // hide modal and show banner feedback
                try { $('#deleteCompanyValue .modal-close-btn').trigger('click'); } catch (e) {}
                const msg = response && response.message ? response.message : 'Company Value deleted successfully!';
                showFeedback(msg, 'success');
                fetchCompanyValues();
            },
            error: function (xhr) {
                const msg = (xhr && xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Failed to delete company value!';
                showFeedback(msg, 'error');
            }
    });
  });

  // small helper to avoid layout issues with raw HTML
  function escapeHtml(s) {
    return String(s)
      .replace(/&/g,'&amp;')
      .replace(/</g,'&lt;')
      .replace(/>/g,'&gt;')
      .replace(/"/g,'&quot;')
      .replace(/'/g,'&#39;');
  }

    // show any server-provided feedback or URL param feedback on load
    try {
        const params = new URLSearchParams(window.location.search);
        const successParam = params.get('success') || params.get('feedback');
        if (typeof window.__serverFeedback !== 'undefined' && window.__serverFeedback) {
            showFeedback(window.__serverFeedback, 'success');
            window.__serverFeedback = null;
            history.replaceState(null, '', window.location.pathname);
        } else if (successParam) {
            showFeedback(successParam, 'success');
            params.delete('success'); params.delete('feedback');
            const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            history.replaceState(null, '', newUrl);
        }
    } catch (e) { /* ignore */ }
});
</script>


@endsection

