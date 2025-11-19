<div class="w-100">
    <label for="job_role" class="fw-semibold fs-6 mb-2">Job Position</label>
    <select id="job_role" class="form-select" wire:model="departmentId"{{ empty($jobs) ? 'disabled' : '' }}>
        <option value="">Select Job Position</option>
        @foreach ($jobs as $job)
            <option value="{{ $job->id }}">{{ $job->title }}</option>
        @endforeach
    </select>
</div>