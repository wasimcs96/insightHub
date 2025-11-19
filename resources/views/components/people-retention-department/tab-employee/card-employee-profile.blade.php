<style>
    .profile-dropdown-menu {
        position: absolute;
        top: -100%;
        left: 85%; 
        transform: translateX(-50%);
        z-index: 9999;
        display: none; 
        width: max-content; 
    }

    .profile-dropdown-menu.show {
        display: block;
    }

    .bi-three-dots { 
        cursor: pointer;
        font-size: 1.2rem;
        padding: 5px;
        border-radius: 50%;
        transition: background-color 0.3s;
    }

    .bi-three-dots:hover {
        background-color: #f0f0f0;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 30%;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 4px;
        overflow: hidden;
        padding: 10px 3px !important;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-item {
        color: #333;
        padding: 8px 16px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
    }

    .dropdown-item:hover {
        background-color: #F9A845 !important;
        color: white !important;
        border-radius: 7px !important;
    }

    .dropdown-item:not(:last-child) {
        margin-bottom: 8px;
    }

    .profile1{
        display: flex;
        align-items: center;
        position: relative;
    }

    .profile-details1 {
        display: flex;
        flex-direction: column;
        flex-grow: 1;  /* This will make it take up the available space */
    }

    .profile-drop-toggle1 {
        position: absolute; /* Position the icon absolutely within the profile container */
        top: 10px; /* Adjust as necessary for spacing from the top */
        right: 10px; /* Adjust as necessary for spacing from the right */
        cursor: pointer;
        font-size: 1.2rem;
        padding: 5px;
        border-radius: 50%;
        transition: background-color 0.3s;
    }

    .profile-drop-toggle1:hover {
        background-color: #f0f0f0;
    }

</style>

<div class="profile1" 
    data-level="{{ $employee->level }}" 
    data-position="{{ $employee->position_name }}" 
    data-department="{{ $employee->department }}" 
    data-name="{{ strtolower($employee->name) }}"
    data-email="{{ strtolower($employee->email) }}"
    data-gender="{{ $employee->gender == 1 ? "Female" : "Male" }}">
    
    <!-- Profile Image -->
    <img src="{{ $employee->profile_picture ? asset($employee->profile_picture) : asset('images/default-user.svg') }}" 
     alt="{{ $employee->name }}" 
     class="profile-photo"
     onerror="this.onerror=null; this.src='{{ asset('images/default-user.svg') }}';">

    <div class="profile-details1">
        <div class="profile-name">{{ $employee->name }}
            <div class="profile-actions">
                <i class="bi bi-three-dots profile-drop-toggle1 top-right"></i>
                <div class="dropdown-menu profile-dropdown-menu">
                    <a href="/admin/employee-details/{{ $employee->id }}?page=overview" class="dropdown-item profile-dropdown-item view-profile" data-id="{{ $employee->id }}">View Profile</a>
                    {{-- <a href="/admin/myemployee/{{ $employee->id }}/edit" class="dropdown-item profile-dropdown-item edit-profile" data-id="{{ $employee->id }}">Edit Profile</a> --}}
                    {{-- <a href="mailto:{{ $employee->email }}" class="dropdown-item profile-dropdown-item send-email">Send Email</a> --}}
                </div>
            </div>
        </div>
        <div class="profile-title">Age/Gender: {{ $employee->age ? $employee->age : "No Data" }}, {{ $employee->gender == 1 ? "Female" : "Male"}}</div>
        <div class="profile-email">{{ $employee->email }}</div>
        <div class="profile-position" style="display:none">{{ $employee->position_name }}</div>
    </div>
</div>



