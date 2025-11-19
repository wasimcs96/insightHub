@foreach ($resultTAPsychometric as $result)
    <tr data-position-name="{{ $result->position_name }}" 
        data-position-level="{{ $result->position_level }}"
        data-assessment-completion="{{ $result->is_personality_motivation_completed && $result->is_work_interest_completed && $result->is_cognitive_ability_completed ? 'complete' : 'incomplete' }}">
        <td>
            <div class="employee-info">
                <img src="{{ $result->profile_picture ? asset('storage/' . $result->profile_picture) : asset('/images/default-user.svg') }}" 
                alt="{{ $result->name }}" 
                class="profile-photo">                                      
                <div class="profile-name-table">
                    <p class="employee-name">{{$result->name}}</p>
                    <p class="employee-role">{{$result->position_name}}</p>
                </div>
                <a href="#" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <iconify-icon icon="entypo:dots-three-vertical"></iconify-icon>
                </a>
                <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content report-dropdown" data-kt-menu="true">
                    <a class="m-0 px-4 py-2" href="/admin/employee-details/{{ $result->id }}?page=overview">View Profile</a>
                    <a class="m-0 px-4 py-2" href="{{ route('admin.employee.details.download_report', $result->id) }}">Download Report</a>
                </div>
            </div>
        </td>
        @if ($result->is_personality_motivation_completed == 1)
            <td><span class="high table-status">Yes</span></td>
        @else
            <td><span class="low table-status">No</span></td>
        @endif
        @if ($result->is_work_interest_completed == 1)
            <td><span class="high table-status">Yes</span></td>
        @else
            <td><span class="low table-status">No</span></td>
        @endif
        @if ($result->is_cognitive_ability_completed == 1)
            <td><span class="high table-status">Yes</span></td>
        @else
            <td><span class="low table-status">No</span></td>
        @endif
        @if ($result->is_cognitive_ability_completed == 1 && $result->is_personality_motivation_completed == 1 && $result->is_work_interest_completed == 1) 
            <td><span class="high table-status">Yes</span></td>
        @else
            <td><span class="low table-status">No</span></td>
        @endif
        <td>
            <span class="table-status">
                @if($result->last_report_downloaded_at && !$result->last_report_downloaded_at->isStartOfTime())
                    {{ $result->last_report_downloaded_at->format('Y-m-d H:i:s') }}
                @else
                    N/A
                @endif
            </span>
        </td>
    </tr>
@endforeach