<div class="mt-25">
    <div class="d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-sm btn-primary mb-3 add-both-btn">{{ trans('Add MCQ Questions') }}</button>
    </div>
</div>

<div id="questions-container">
    <!-- Question and answer inputs will be appended here -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const questionsContainer = document.getElementById('questions-container');
        const addBothBtn = document.querySelector('.add-both-btn');
    
        addBothBtn.addEventListener('click', function () {
            const questionIndex = questionsContainer.children.length; // Get the current number of questions
            const questionHtml = `
                <div class="question-answer-set">
                    <input type="hidden" name="question_types[${questionIndex}]" value="multiple">
                 
                    <div class="form-group">
                        <label for="questions[${questionIndex}]">{{ trans('MCQ Question') }}</label>
                        <input type="text" class="form-control" name="questions[${questionIndex}]" required>
                    </div>
    
                    <div class="answers-container">
                        <div class="form-group answer-input">
                            <label for="answers[${questionIndex}][]">{{ trans('Option') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="answers[${questionIndex}][]" required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger remove-answer-btn" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="button" class="btn btn-sm btn-primary mb-3 add-answer-btn" data-index="${questionIndex}">{{ trans('Add More Options') }}</button>
                        <button type="button" class="btn btn-danger remove-question-btn">{{ trans('Remove Question') }}</button>
                    </div>
                    <hr>
                </div>
            `;
    
            const questionSet = document.createElement('div');
            questionSet.innerHTML = questionHtml;
            questionsContainer.appendChild(questionSet);
    
            // Attach event listeners for the new elements
            attachEventListeners(questionSet, questionIndex);
        });
    
        function attachEventListeners(questionSet, questionIndex) {
            const addAnswerBtn = questionSet.querySelector('.add-answer-btn');
            const answersContainer = questionSet.querySelector('.answers-container');
    
            addAnswerBtn.addEventListener('click', function () {
                const answerHtml = `
                    <div class="form-group answer-input">
                        <label for="answers[${questionIndex}][]">{{ trans('Option') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="answers[${questionIndex}][]" required>
                            <div class="input-group-append">
                                <button class="btn btn-danger remove-answer-btn" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
    
                const newAnswerInput = document.createElement('div');
                newAnswerInput.innerHTML = answerHtml;
                answersContainer.appendChild(newAnswerInput);
    
                // Attach event listener to the new remove button
                newAnswerInput.querySelector('.remove-answer-btn').addEventListener('click', function () {
                    answersContainer.removeChild(newAnswerInput);
                });
            });
    
            // Attach event listener to the remove question button
            questionSet.querySelector('.remove-question-btn').addEventListener('click', function () {
                questionsContainer.removeChild(questionSet);
            });
    
            // Attach event listener to existing remove answer buttons
            const existingRemoveBtns = questionSet.querySelectorAll('.remove-answer-btn');
            existingRemoveBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const parent = btn.closest('.answer-input');
                    answersContainer.removeChild(parent);
                });
            });
        }
    });
    </script>
    
