<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment Contract</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        h1 {
            margin: 20px 0;
            font-size: 24px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 18px;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .section p {
            margin: 5px 0;
        }

        .section p strong {
            /* display: inline-block; */
            /* width: 200px; */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            {{-- <img src="http://127.0.0.1:8000/media/insightaccess.png" alt="Company Logo"> --}}
            <h1>Employment Contract</h1>
        </div>
        <div class="section">This Employment Contract is made and entered into on this Friday day of
            {{ \Carbon\Carbon::parse($contract->date_signed_by_employer)->format('d, M, Y') ?? '' }}
            by
            and between:
            <p></p>
            <h2>Employer Details</h2>
            {{-- <p><strong>Company Name:</strong> {{ $contract->company->userCompany->name ?? '' }}</p>
            <p><strong>Company Address:</strong> {{ $contract->company->userCompany->address ?? '' }}</p>
            <p><strong>Company Branch:</strong> {{ $contract->company->name ?? '' }}</p>
            <p><strong>Contact Person:</strong> {{ $contract->company->userCompany->contact_person ?? '' }}</p>
            <p><strong>Contact Phone Number:</strong> {{ $contract->company->userCompany->mobile_number ?? '' }}</p>
            <p><strong>Contact Email:</strong> {{ $contract->company->userCompany->email ?? '' }}</p> --}}
            <p>
                {{ $contract->company->userCompany->name ?? '' }}, a corporation organized and existing under the laws
                of
                the Philippines, with its principal
                office located at {{ $contract->company->userCompany->address ?? '' }} and specifically at its branch
                located at {{ $contract->company->userCompany->branch ?? 'branch' }}. The company
                can be contacted through {{ $contract->contact_person ?? 'Contact Person' }}, who
                can be reached
                at
                {{ $contract->company->userCompany->mobile_number ?? '' }} or via email at
                {{ $contract->company->userCompany->email ?? '' }}, hereinafter referred to as the "Employer".
            </p>
        </div>

        <div class="section">
            <h2>Employee Details</h2>
            {{-- <p><strong>Full Name:</strong>
                @if (isset($contract->user->full_name))
                    {{ $contract->user->full_name }}
                @else
                    {{ $contract->user->first_name ?? '' }}
                    {{ $contract->user->middle_name ?? '' }}
                    {{ $contract->user->last_name ?? '' }}
                @endif
            </p>
            <p><strong>Position:</strong> {{ $contract->jobPosition->title }}</p>
            <p><strong>Department:</strong> {{ $contract->user->department->name ?? '' }}</p>
            <p><strong>Date of Birth:</strong> {{ $contract->user->birth_date ?? '' }}</p>
            <p><strong>Gender:</strong>
                @if ($contract->user->gender == 0)
                    Male
                @elseif ($contract->user->gender == 1)
                    Female
                @else
                    N / A
                @endif
            </p>
            <p><strong>Civil
                    Status:</strong>{{ config('constants.MARITAL_STATUSES.' . $contract->user->marital_status) }}</p>
            <p><strong>Address:</strong> {{ $contract->user->home_address ?? '' }}</p>
            <p><strong>Phone:</strong> {{ $contract->user->mobile_number ?? '' }}</p>
            <p><strong>Email:</strong> {{ $contract->user->email ?? '' }}</p> --}}

            <p>
                @if (isset($contract->user->full_name))
                    {{ $contract->user->full_name }}
                @else
                    {{ $contract->user->first_name ?? '' }}
                    {{ $contract->user->middle_name ?? '' }}
                    {{ $contract->user->last_name ?? '' }}
                @endif, of legal age, born on {{ $contract->user->birth_date ?? '' }},
                @if ($contract->user->gender == 0)
                    Male
                @elseif ($contract->user->gender == 1)
                    Female
                @else
                    N / A
                @endif,
                {{ config('constants.MARITAL_STATUSES.' . $contract->user->marital_status) }}, with a residential
                address
                at {{ $contract->user->home_address ?? '' }}, and contact details as follows: phone number
                {{ $contract->user->mobile_number ?? '' }} and email address {{ $contract->user->email ?? '' }},
                hereinafter referred to as the "Employee". The Employee shall hold the position of
                {{ $contract->jobPosition->title }} within the{{ $contract->jobPosition->OrgDepartment->name ?? '' }}.
            </p>

        </div>


        <div class="section">
            <h2>Contract Details</h2>
            {{-- <p><strong>Commencement Date:</strong> {{ $contract->commencement_date }}</p>
            <p><strong>Probationary Period:</strong> {{ $contract->probationary_period }}</p>
            <p><strong>Employment Type:</strong>
                {{ config('constants.EMPLOYMENT_STATUSES.' . $contract->employment_type) ?? 'Full Time' }}</p> --}}
            <p>The employment will commence on {{ $contract->commencement_date }}. The initial probationary period is
                {{ $contract->probationary_period }} months. The employment type is
                {{ config('constants.EMPLOYMENT_STATUSES.' . $contract->employment_type) ?? 'Full Time' }}.</p>
        </div>
        {{-- {{ dd($contract) }} --}}
        <div class="section">
            <h2>Compensation and Benefits</h2>
            <p><strong>Basic Salary:</strong> {{ $contract->basic_salary }}</p>
            <p><strong>Pay Frequency:</strong> {{ $contract->pay_frequency }}</p>
            <p><strong>Statutory Deduction:</strong> {{ $contract->statutary_deduction ?? '' }}</p>
            <p><strong>Tardiness Policy:</strong> {{ $contract->tardiness_policy }}</p>
            <p><strong>Holiday Entitlement:</strong> {{ $contract->holiday_entitlement }}</p>
            <p><strong>Overtime Rate:</strong> {{ $contract->overtime_rate ?? '' }}</p>
            {{-- <p><strong>Is Allowance:</strong> {{ $contract->is_allowance }}</p> --}}
        </div>
        <div class="section">
            <h2>Work Hours and Leave</h2>
            <p><strong>Regular Working Hours:</strong> {{ $contract->working_hour ?? '' }}</p>

            @if(isset($contract->rest_days))
            @php
                $restDaysString = $contract->rest_days;
                $WEEK_DAYS = config('constants.WEEK_DAYS'); // This would typically come from your database
                if ($restDaysString) {
                    $restDaysArray = explode(',', $restDaysString);

                    $restDaysNames = array_map(function ($dayNumber) use ($WEEK_DAYS) {
                        return $WEEK_DAYS[$dayNumber];
                    }, $restDaysArray);

                    $restDaysNamesString = implode(', ', $restDaysNames);
                }
                // Step 3: Convert the comma-separated string to an array of day names
            @endphp
            <p><strong>Rest Days:</strong> {{ $restDaysNamesString ?? '' }}</p>
            @endif
            <p><strong>Holiday Entitlement:</strong> {{ $contract->holiday_entitlement ?? '' }}</p>

            @if (isset($contract->leave_entitlement))
                <h3>Leave Entitlement</h3>
                @php
                    // Array of leave codes from the database
                    $leaveCodesString = $contract->leave_entitlement ?? ''; // This would typically come from your database
                    $leaveCodes = explode(',', $leaveCodesString);
                    // $leavesConfig = config('constants.LEAVES');
                    $leavesConfig = App\Models\MasterLeave::get()->keyBy('id'); // Make sure it's keyed by the 'id' or whatever unique key it has
                    $paidLeaveCount = json_decode($contract->paid_leave_count, true);
                @endphp

                @foreach ($leaveCodes as $code)
                
                    @if (isset($leavesConfig[$code]))
                   
                    @php
                        // Get the leave configuration for the current code
                        $leave = $leavesConfig[$code];
                        $entitlement = 'The employee is entitled to ';
                        // dd($paidLeaveCount);
                        // Check if depend_job is set and use the value from paid_leave_count
                        if ($leave['depend_on_job'] == 1 && isset($paidLeaveCount[$code])) {
                            $days = $paidLeaveCount[$code];
                            // dd($days);
                            $entitlement .= "$days days of paid leaves per calendar year.";
                        } else {
                            // Use default value if not dependent on job or no paid_leave_count data
                            $days = $leave['days_per_year'] ?? 'N/A'; // Assuming you have a default entitlement in MasterLeave
                            $entitlement .= "$days days of paid leaves per calendar year.";
                        }

                        if ($leave['cumulative'] === 1) {
                                $cumulative = 'Unused leave may accumulate from year to year, subject to company policy.';
                            } else {
                                $cumulative = '';
                            }

                            if ($leave['eligibility'] === 'M') {
                                $eligibility = 'Male Employees';
                            } else if ($leave['eligibility'] === 'F') {
                                $eligibility = 'Female Employees';
                            } else {
                                $eligibility = 'All Employees';
                            }

                    @endphp
                        <div>
                            <p><strong>Leave Type:</strong> {{ $leave['name'] }}</p>
                                {{-- @if ($code = 'VL')
                                    <p><strong>Entitlement:</strong>The employee is entitled to {{ $contract->paid_leave_count ?? '' }} days of paid vacation leave per calendar year.</p>
                                @else --}}
                                    <p><strong>Entitlement:</strong>  {{ $entitlement }}</p>
                                {{-- @endif --}}
                                @isset($leave['additional_benefit'])
                                <p><strong>Additional Benefit:</strong> {{ $leave['additional_benefit'] }}
                                </p>
                            @endisset
                            @isset($leave['eligibility'])
                                <p><strong>Eligibility:</strong> {{ $eligibility ?? '' }}</p>
                            @endisset

                            <p><strong>Purpose:</strong> {{ $leave['purpose'] }}</p>
                            <p><strong>Cumulative:</strong> {{ $cumulative }}</p>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="section">

            {{-- <p><strong>Is Allowance:</strong> {{ $contract->is_allowance }}</p> --}}
        </div>

        <div class="section">
            <h2>Termination and Resignation</h2>
            <p><strong>Notice Period:</strong> {{ $contract->notice_period ?? '' }} Months</p>
            <p><strong>Pay Frequency:</strong> {!! $contract->grounds_for_termination ?? '' !!}</p>
            <p><strong>Separation Pay:</strong> {{ $contract->separation_pay ?? '' }}</p>

        </div>
        @php
            $contract->is_allowance = $contract->is_allowance ?? 0;
        @endphp


        @if ($contract->is_allowance == 1)
            <!-- Debugging statement to check if the code reaches here -->

            @if (
                !is_null($contract->uniform_allowance) ||
                    !is_null($contract->rice_subsidy) ||
                    !is_null($contract->laundry_allowance) ||
                    !is_null($contract->daily_meal_allowance) ||
                    !is_null($contract->bonuses_incentive))
                <div class="section">
                    <h2>Allowances</h2>

                    @if ($contract->uniform_allowance)
                        <p><strong>Uniform Allowance:</strong> {{ $contract->uniform_allowance }}</p>
                    @endif

                    @if (isset($contract->rice_subsidy))
                        <p><strong>Rice Subsidy:</strong> {{ $contract->rice_subsidy  ?? ''}}</p>
                    @endif

                    @if (isset($contract->laundry_allowance))
                        <p><strong>Laundry Allowance:</strong> {{ $contract->laundry_allowance ?? ''}}</p>
                    @endif

                    @if (isset($contract->daily_meal_allowance))
                        <p><strong>Daily Meal Allowance:</strong> {{ $contract->daily_meal_allowance  ?? ''}}</p>
                    @endif

                    @if (isset($contract->bonuses_incentive))
                        <p><strong>Bonuses and Incentives:</strong> {{ $contract->bonuses_incentive ?? ''}}</p>
                    @endif

                </div>
            @endif
        @endif




       
        @if (isset($contract->benefits) && $contract->benefits != "")
            @php
                $benefits = json_decode($contract->benefits, true);
                // Filter out null values
                $filteredBenefits = array_filter($benefits, function ($value) {
                    return $value !== null;
                });
            @endphp

            @if ($filteredBenefits)
                <div class="section">
                    <h2>Benefits</h2>

                    @foreach ($filteredBenefits as $key => $value)
                        <p><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</p>
                    @endforeach

                </div>
            @endif
        @endif


        <div class="section">
            <h2>Other Clauses</h2>
            <p><strong>Confidentiality Agreement:</strong> {{ $contract->confidentiality_agreement }}</p>
            <p><strong>Non-compete Clause:</strong> {{ $contract->non_compete_clause }}</p>
            <p><strong>Non-disclosure Agreement:</strong> {{ $contract->non_disclosure_agreement }}</p>
            <p><strong>Intellectual Property Rights:</strong> {{ $contract->intellectual_property_rights }}</p>
            <p><strong>Dispute Resolution:</strong> {{ $contract->dispute_resolution }}</p>
        </div>
        <div class="section">
            <h2>Acknowledgements</h2>
            <p><strong>Acknowledgement of Company Policies:</strong>
                {{ $contract->acknowledgement_of_company_policies }}</p>
            <p><strong>Acknowledgement of Receipt of Handbook:</strong>
                {{ $contract->acknowledgement_of_receipt_of_handbook }}</p>
            <p><strong>Acknowledgement of Understanding Terms and Conditions:</strong>
                {!! $contract->acknowledgement_of_understanding_terms_and_conditions !!}</p>
        </div>
        <div class="section">
            <h2>Signatures and Dates</h2>
            {{-- {{ dd(asset($contract->employee_signature)) }} --}}
            <div style="display: flex;justify-content: space-between;">
                <div>
                    <p style="display: flex;align-items: center;">
                        <strong>Employee Signature:</strong><img src="{{ $contract->employee_signature ?? '' }}"
                            class="signtureimg" style="width: 103px;height: 103px;object-fit: cover;">
                    </p>
                    {{-- {{ dd($contract) }} --}}
                    <p><strong>Date :</strong> @if(isset($contract->date_signed_by_employee)) {{ $contract->date_signed_by_employee ? $contract->date_signed_by_employee : now()->toDateString()}} @endif</p>
                </div>
                <div>

                    <p style="display: flex;align-items: center;"><strong>Employer Signature:</strong>
                        <img src="{{ $contract->employer_signature ?? '' }}" class="signtureimg"
                            style="width: 103px;height: 103px;object-fit: cover;">
                    </p>
                    <p><strong>Date:</strong> {{ $contract->date_signed_by_employer ? $contract->date_signed_by_employer : now()->toDateString()}}</p>
                </div>
            </div>
            {{-- {{ dd('sdfsf') }} --}}
        </div>
    </div>
</body>

</html>
