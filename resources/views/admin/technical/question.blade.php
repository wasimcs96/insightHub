

<div id="questions-container">
    <!-- Question and answer inputs will be appended here -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const questionsContainer = document.getElementById('questions-container');
    const addBothBtn = document.querySelector('.add-both-btn');

    let questionCount = 0; // Track the number of questions

    addBothBtn.addEventListener('click', function () {
        const questionIndex = questionCount; // Use current count for indexing
        const questionHtml = `
            <div class="fv-row mb-7 row">
                <div class="input-area col-xl-3">
                    <label  for="titles[${questionIndex}]" class="form-label">{{ trans('Title') }}</label>
                    <input type="text" class="form-control" name="titles[${questionIndex}]" placeholder="Enter Title" required>
                </div>
               <div class="col-lg-3">
    <label for="levels[${questionIndex}]" class="form-label">{{ trans('Level') }}</label>
    <select class="form-control" name="levels[${questionIndex}]" required>
        <option value="">Select Level</option>
        <option value="1">Level 1</option>
        <option value="2">Level 2</option>
        <option value="3">Level 3</option>
    </select>
</div>
                <div class="col-lg-3">
                    <label for="question_numbers[${questionIndex}]" class="form-label">{{ trans('Question Number') }}</label>
                    <input type="number" class="form-control" name="question_numbers[${questionIndex}]" placeholder="Enter Question Number" required>
                </div>
                <div class="col-lg-3">
                    <label for="scores[${questionIndex}]" class="form-label">{{ trans('Score') }}</label>
                    <input type="number" class="form-control" name="scores[${questionIndex}]" placeholder="Enter Score" required>
                </div>

              

                <!-- Options Container -->
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-primary mb-3 add-option-btn">
                            <i class="fas fa-plus-circle"></i> {{ trans('Add Option') }}
                        </button>
                    </div>
                    <div class="options-container mb-4">
                        <!-- Option inputs will be appended here -->
                    </div>
                </div>
            </div>
              <!-- Remove Question Button -->
                <div class="d-flex justify-content-end mt-3 col-12">
                    <button type="button" class="btn btn-danger remove-question-btn">{{ trans('Remove Question') }}</button>
                </div>
        `;
        
        const questionSet = document.createElement('div');
        questionSet.innerHTML = questionHtml;
        questionsContainer.appendChild(questionSet);
        questionCount++; // Increment the question count

        // Attach event listener to the remove question button
        questionSet.querySelector('.remove-question-btn').addEventListener('click', function () {
            questionsContainer.removeChild(questionSet);
            questionCount--; // Decrement question count
        });

        // Handle adding options for this specific question
        const addOptionBtn = questionSet.querySelector('.add-option-btn');
        const optionsContainer = questionSet.querySelector('.options-container');

        addOptionBtn.addEventListener('click', function () {
            const optionIndex = optionsContainer.children.length; // Get current number of options

            if (optionIndex < 4) { // Only allow up to 4 options
                const optionLabels = ['A.', 'B.', 'C.', 'D.']; // Map optionIndex to letters

const optionHtml = `
    <div class="form-group d-flex align-items-center mb-3 option-item">
        <!-- Option Label (A, B, C, D) -->
        <span class="option-label mr-2">${optionLabels[optionIndex]}</span>

        <!-- Option Text Input -->
        <input type="text" class="form-control mr-3" name="options[${questionIndex}][${optionIndex}][text]" placeholder="Enter option" required>
        
        <!-- Correct Answer Radio Button -->
        <div class="form-check mr-3">
            <input type="radio" class="form-check-input" name="correct_answer[${questionIndex}]" value="${optionIndex}" required>
            <label class="form-check-label">Correct</label>
        </div>
        
        <!-- Remove Option Button -->
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
                });
            }
        });
    });
});

</script>