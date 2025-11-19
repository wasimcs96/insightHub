<div class="mt-25">
    <div class="d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-sm btn-primary mb-3 add-option-btn">
            <i class="fas fa-plus-circle"></i> {{ trans('Add Technical Option') }}
        </button>
    </div>
</div>

<div id="options-container" class="mb-4">
    <!-- Option inputs will be appended here -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const optionsContainer = document.getElementById('options-container');
        const addOptionBtn = document.querySelector('.add-option-btn');
        
        let optionCount = 1; // Initialize option count
        
        addOptionBtn.addEventListener('click', function () {
            if (optionCount <= 4) { // Only allow up to 4 options
                const optionHtml = `
                    <div class="form-group d-flex align-items-center mb-3 option-item">
                        <label for="options[${optionCount}]" class="mr-3 mb-0 font-weight-bold">{{ trans('Option ') }}${optionCount}</label>
                        <input type="text" class="form-control mr-3" name="options[${optionCount}]" placeholder="{{ trans('Enter option text') }}" required>
                        <div class="form-check mr-3">
                            <input type="radio" class="form-check-input" name="correct_answer" value="${optionCount}">
                            <label class="form-check-label">{{ trans('Correct') }}</label>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-option-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                const optionSet = document.createElement('div');
                optionSet.classList.add('option-wrapper');
                optionSet.innerHTML = optionHtml;
                optionsContainer.appendChild(optionSet);

                // Attach event listener to the remove option button
                optionSet.querySelector('.remove-option-btn').addEventListener('click', function () {
                    optionsContainer.removeChild(optionSet);
                    optionCount--;
                });

                optionCount++;
            }
        });
    });
</script>
