<div class="profile">
    <!-- Display the employee's profile picture -->
    <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : '/images/dummy-profile-pic.png' }}" alt="{{ $employee->name }}" class="profile-photo">
    <div class="profile-details">
        <!-- Display the employee's name -->
        <div class="container-name">
            <div class="profile-name">{{ $employee->name }}</div>
            @if ($employee->is_high_potential == 1)
                <div class="high-potential">
                    <p>High Potential</p>
                </div>
            @endif
        </div>
        <!-- Display the employee's position (title) -->
        <div class="profile-title">{{ $employee->position_name }}</div>
        <!-- Display the employee's email -->
        <div class="profile-email">{{ $employee->email }}</div>
    </div>
</div>         
