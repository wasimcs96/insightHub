<div class="w-100">
    <label for="business_unit" class="fw-semibold fs-6 mb-2">Business Unit</label>
    <select id="business_unit" class="form-select" wire:model="selectedBusinessUnit"
        wire:change="$emit('businessUnitSelected', $event.target.value)">
        <option value="">Select Business Unit</option>
        @foreach ($businessUnits as $unit)
            <option value="{{ $unit->id }}" {{ $unit->id == $selectedBusinessUnit ? 'selected' : '' }}>{{ $unit->name }}</option>
        @endforeach
    </select>
</div>
