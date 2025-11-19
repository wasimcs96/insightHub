<div class="modal-header">
    <h2 class="modal-title">Edit Skill: {{ $job_title ?? '' }}</h2>
    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <p class="mb-7">For Job Position: <strong id="modal-profile-name">Manager, Security</strong></p>
    <input type="hidden" value="" id="modal-pivot-id" />
    <input type="hidden" value="" id="modal-skill-id" />
    <input type="hidden" value="" id="modal-job-id" />

    <!-- Proficiency Level -->
    <div class="mb-7">
        <label class="form-label fw-medium">Select Proficiency Level</label>
        <div class="d-flex gap-2 justify-content-center">
            <!-- Levels 1–6 -->
            <button type="button" class="level-btn" data-level="1">1</button>
            <button type="button" class="level-btn" data-level="2">2</button>
            <button type="button" class="level-btn" data-level="3">3</button>
            <button type="button" class="level-btn" data-level="4">4</button>
            <button type="button" class="level-btn" data-level="5">5</button>
            <button type="button" class="level-btn" data-level="6">6</button>
        </div>
    </div>

    <!-- Level Description -->
    <div class="mb-4">
        <label class="form-label">Level Description</label>
        <p class="mb-0" id="level-description">
            Advanced proficiency. Can handle complex tasks and situations. Innovates and optimizes
            processes. Seen as a subject matter expert.
        </p>
    </div>
</div>

<div class="modal-footer border-0 pt-0  edit-footer-btn" id="edit-footer-btn">
    <button type="button" class="orange-outline" id="removeSkillBtn">Remove Skill</button>
    <div>
        <button type="button" class="grey-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="orange-fill" id="saveSkillBtn">Save Changes</button>
    </div>
</div>
