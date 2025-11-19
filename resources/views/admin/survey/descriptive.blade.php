<div class="d-flex justify-content-between align-items-center mt-3">
    <button type="button" id="addDescriptiveQuestionButton" class="btn btn-sm btn-primary mb-3">{{ trans('Add Descriptive Questions') }}</button>
</div>

<div id="descriptiveFormContainer" style="display: none">
    <!-- Existing questions will be added here -->
</div>

<script>
    document.getElementById('addDescriptiveQuestionButton').addEventListener('click', function() {
        addDescriptiveQuestion();
    });

    function addDescriptiveQuestion() {
        const descriptiveFormContainer = document.getElementById('descriptiveFormContainer');

        // Create a new question container
        const questionContainer = document.createElement('div');
        questionContainer.classList.add('form-group', 'mt-3');

        // Hidden input for question type
        const questionTypeInput = document.createElement('input');
        questionTypeInput.type = 'hidden';
        questionTypeInput.name = 'question_types[]';
        questionTypeInput.value = "{{ \App\Models\SurveyQuestion::$descriptive }}";

        // Label for the question input
        const label = document.createElement('label');
        label.textContent = "{{ trans('Question Title') }}";

        // Input for the question
        const questionInputContainer = document.createElement('div');
        questionInputContainer.classList.add('input-group');

        const questionInput = document.createElement('input');
        questionInput.type = 'text';
        questionInput.classList.add('form-control');
        questionInput.name = 'questions[]';
        questionInput.required = true;

        // Close button (cross) for removing the question
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'input-group-append');
        removeButton.innerHTML = '<i class="fas fa-times"></i>'; // FontAwesome icon for cross

        // Remove button event listener
        removeButton.addEventListener('click', function() {
            descriptiveFormContainer.removeChild(questionContainer);
            // Hide the container if no questions remain
            if (descriptiveFormContainer.children.length === 0) {
                descriptiveFormContainer.style.display = 'none';
            }
        });

        // Append the input and remove button to the input container
        questionInputContainer.appendChild(questionInput);
        questionInputContainer.appendChild(removeButton);

        // Append all elements to the question container
        questionContainer.appendChild(questionTypeInput);
        questionContainer.appendChild(label);
        questionContainer.appendChild(questionInputContainer);

        // Show the container and add the question to it
        descriptiveFormContainer.style.display = 'block';
        descriptiveFormContainer.appendChild(questionContainer);
    }
</script>
