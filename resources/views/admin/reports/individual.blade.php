@extends('admin.layout.app')

@section('title', 'Individual Report')
@section('style')
<style>
    #pagination {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    #pagination a {
        background-color: #e2e8f0;
        padding: 9px;
        border-radius: 5px;
        color: black;
        display: flex;
        align-items: center;
    }

    #pagination .disabled {
        background-color: #ededed !important;
        color: #a5a5a5;
    }

    .page-link {
        margin-right: 20px !important;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper transition-all duration-150 xl:ltr:ml-[248px] xl:rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div id="content_layout">




            <!-- BEGIN: Breadcrumb -->
            <div class="mb-5">
                <ul class="m-0 p-0 list-none">
                    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                        <a href="/admin/dashboard">
                            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                            <iconify-icon icon="heroicons-outline:chevron-right"
                                class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                        </a>
                    </li>
                    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                        Reports
                        <iconify-icon icon="heroicons-outline:chevron-right"
                            class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                    </li>
                    <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                        Individual Reports</li>
                </ul>
            </div>
            <!-- END: BreadCrumb -->
            <div class=" space-y-5">

                <div class="card">
                    <header class=" card-header noborder">
                        <h4 class="card-title"> Individual Reports
                        </h4>
                        <a href="/admin/individual/student/export"
                            class="btn inline-flex justify-center btn-success">Export</a>
                    </header>
                    <div class="badge-group">
                        <span class="badge bg-primary-500 text-white mx-5 mb-4" data-v-d70534ce="">
                            <span class="inline-flex items-center" data-v-d70534ce="">
                                1 = Correct | 0 = Wrong
                            </span>
                        </span>
                    </div>
                    <div class="card-body px-6 pb-6">
                        <div class="overflow-x-auto -mx-6 ">
                            <span class=" col-span-8  hidden"></span>
                            <span class="  col-span-4 hidden"></span>
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden ">
                                    <table id="students-table"
                                        class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
                                        <thead class=" bg-slate-200 dark:bg-slate-700">
                                            {{-- <tr>
                                                <th class="bg-white">
                                                <th class="bg-white">
                                                <th class="bg-white">

                                                <th class="bg-white">
                                                <th class="bg-white">
                                                <th class="bg-white">
                                                <th class="bg-white">
                                                <th class="bg-white"> --}}

                                                    {{--
                                                <th class="bg-white">
                                                <th class="bg-white"> --}}



                                                    {{--
                                                <th colspan="5" class="bg-success-400 text-[20px]">Personality &
                                                    Motivation</th>
                                                <th colspan="3" class="bg-primary-400 text-[20px]">English test</th>

                                            </tr> --}}
                                            <tr>

                                                <th scope="col" class=" table-th ">
                                                    Name
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Email
                                                </th>
                                                {{-- <th scope="col" class=" table-th ">
                                                    Gender
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Year of Study
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Age
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Average Time
                                                </th> --}}
                                                <th scope="col" class=" table-th ">
                                                    CAA Result
                                                </th>
                                                {{-- <th scope="col" class=" table-th ">
                                                    University
                                                </th> --}}
                                                {{-- <th scope="col" class=" table-th ">
                                                    Ocean Details
                                                </th>
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    RIASEC Details
                                                </th> --}}
                                                {{-- <th scope="col" class=" table-th ">
                                                    O
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    C
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    E
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    A
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    N
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Total(%)
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Grammar(%)
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Comprehension(%)
                                                </th> --}}
                                                <th scope="col" class=" table-th ">
                                                    Work Interest
                                                </th>
                                                @foreach (range(1, 50) as $question)
                                                <th scope="col" class=" table-th ">
                                                    Q.{{ $question }}
                                                </th>
                                                @endforeach

                                                {{-- <th scope="col" class=" table-th ">
                                                    Action
                                                </th> --}}

                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">


                                            @if (isset($data['results']))

                                            @foreach ($data['results'] as $key => $item)
                                            <tr>
                                                <td class="table-td ">{{ $item['display_name'] }}</td>
                                                <td class="table-td "> upsistudent{{ $key }}@gmail.com
                                                </td>

                                                {{-- <td class="table-td ">
                                                    {{ $item['gender'] == 1 ? 'Male' : 'Female' }}</td>
                                                <td class="table-td "> {{ $item['year_of_study'] }}</td>
                                                <td class="table-td ">{{ $item['dob'] }}</td>
                                                <td class="table-td ">
                                                    @if (isset($item['english_comprehension']))
                                                    {{ number_format($item['average_time'], 0) }}
                                                    @endif
                                                </td> --}}
                                                <td class="table-td ">{{ $item['score'] }}</td>

                                                {{-- <td class="table-td ">{{ $item['university_name'] }}</td> --}}
                                                {{-- <td class="table-td "><a class="btn btn-success"
                                                        href="/admin/individual/ocean/view/{{ $item['id'] }}">View</a>
                                                </td>
                                                <td class="table-td "><a class="btn btn-primary"
                                                        href="/admin/individual/riasec/view/{{ $item['id'] }}">View</a>
                                                </td> --}}

                                                <!-- <td class="table-td ">{{ $item['englishTest'] }}</td> -->
                                                <!-- <td class="table-td ">{{ $item['careerAlignment'] }}</td> -->
                                                <!-- <td class="table-td ">{{ $item['motivationLevel'] }}</td> -->
                                                <!-- <td class="table-td ">{{ $item['futureOfWork'] }}</td> -->
                                                <!-- <td class="table-td ">{{ $item['employability'] }}</td> -->
                                                {{-- <td class="table-td ">
                                                    @if (isset($item['o']))
                                                    {{ number_format($item['o'], 2) }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td class="table-td ">
                                                    @if (isset($item['c']))
                                                    {{ number_format($item['c'], 2) }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td class="table-td ">
                                                    @if (isset($item['e']))
                                                    {{ number_format($item['e'], 2) }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td class="table-td ">
                                                    @if (isset($item['a']))
                                                    {{ number_format($item['a'], 2) }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td class="table-td ">
                                                    @if (isset($item['n']))
                                                    {{ number_format($item['n'], 2) }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td class="table-td ">
                                                    @if (isset($item['english_comprehension']))
                                                    {{ $item['english_total'] ?? 'N/A' }}%
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td class="table-td ">
                                                    @if (isset($item['english_comprehension']))
                                                    {{ $item['english_grammar'] ?? 'N/A' }}%
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td class="table-td ">
                                                    @if (isset($item['english_comprehension']))
                                                    {{ number_format($item['english_comprehension']) }} %
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                --}}


                                                <td class="table-td " style="display: flex">
                                                    @foreach ($item['interestRiasec'] as $interest)
                                                    @if ($interest == 'Realistic')
                                                    <span class="badge bg-danger-500 text-white mr-1"
                                                        data-v-d70534ce=""><span class="inline-flex items-center"
                                                            data-v-d70534ce="">R</span></span>
                                                    @elseif($interest == 'Investigative')
                                                    <span class="badge bg-primary-500 text-white mr-1"
                                                        data-v-d70534ce=""><span class="inline-flex items-center"
                                                            data-v-d70534ce="">I</span></span>
                                                    @elseif($interest == 'Artistic')
                                                    <span class="badge bg-warning-500 text-white mr-1"
                                                        data-v-d70534ce=""><span class="inline-flex items-center"
                                                            data-v-d70534ce="">A</span>
                                                        <!---->
                                                    </span>
                                                    @elseif($interest == 'Social')
                                                    <span class="badge bg-success-500 text-white mr-1"
                                                        data-v-d70534ce=""><span class="inline-flex items-center"
                                                            data-v-d70534ce="">S</span>
                                                        <!---->
                                                    </span>
                                                    @elseif($interest == 'Conventional')
                                                    <span class="badge bg-slate-500 text-white mr-1"
                                                        data-v-d70534ce=""><span class="inline-flex items-center"
                                                            data-v-d70534ce="">C</span>
                                                        <!---->
                                                    </span>
                                                    @elseif($interest == 'Enterprising')
                                                    <span class="badge bg-info-500 text-white mr-1"
                                                        data-v-d70534ce=""><span class="inline-flex items-center"
                                                            data-v-d70534ce="">E</span>
                                                        <!---->
                                                    </span>
                                                    @endif
                                                    @endforeach
                                                </td>



                                                {{-- @foreach ($item['questions'] as $ans) --}}
                                                @for ($i = 1; $i <= 50; $i++) {{-- {{dd($item['questions'][$i - 1])}}
                                                    --}} <td class="table-td ">
                                                    {{-- @if (isset($item['questions'][$i - 1]))

                                                    @if ($item['questions'][$i - 1] == 1)
                                                    A
                                                    @elseif($item['questions'][$i - 1] == 2)
                                                    B
                                                    @elseif($item['questions'][$i - 1] == 3)
                                                    C
                                                    @else
                                                    D
                                                    @endif
                                                    @else
                                                    Not Answered
                                                    @endif --}}
                                                    {{ $i % 2 == 0 ? '0' : '1' }}
                                                    </td>
                                                    @endfor
                                                    {{-- @endforeach --}}

                                                    {{-- <td class="table-td "><a class="action-btn"
                                                            href="/admin/report/individual/detail/{{$item['user_id']}}">
                                                            <iconify-icon icon="heroicons-outline:eye"></iconify-icon>
                                                        </a></td> --}}

                                            </tr>
                                            @endforeach

                                            @endif

                                        </tbody>
                                    </table>
                                    <div id="pagination" class="d-flex justify-content-start mt-3">
                                        <!-- Next and Previous page links will be populated dynamically with AJAX -->
                                        @if (isset($data['previous']) && $data['previous'] != null)
                                        <a class="page-link"
                                            href="{{ route('individual.report', ['url' => $data['previous']]) }}">
                                            <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon>
                                            Previous
                                        </a>
                                        @else
                                        <a class="page-link disabled" href="javascript:void(0)" disabled>
                                            <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon>
                                            Previous
                                        </a>
                                        @endif


                                        @if (isset($data['next']) && $data['next'] != null)
                                        <a class="page-link"
                                            href="{{ route('individual.report', ['url' => $data['next']]) }}">
                                            Next <iconify-icon icon="heroicons-outline:chevron-double-right">
                                            </iconify-icon></a>
                                        @else
                                        <a class="page-link disabled" href="javascript:void(0)" disabled> Next
                                            <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
    let currentPage = 1;

        function fetchData(page = 1) {
            $.ajax({
                url: '/admin/individual/student/fetch',
                data: {
                    page: page,
                },
                success: function(response) {
                    // Populate the table with data
                    console.log(response.data);
                    if (response.status === 1) {
                        let apiData = response.data.results;
                        let tableBody = $('#students-table tbody');
                        html = ``
                        apiData.forEach(function(item) {
                            html+=`
                                <tr>
                                    <td class="table-td ">${item.display_name}</td>
                                    <td class="table-td ">${item.dob}</td>
                                    <td class="table-td ">${item.score}</td>
                                    <td class="table-td ">${item.level}</td>
                                    <td class="table-td "><a class="action-btn" href="/admin/report/individual/detail/${item.user_id}"><iconify-icon icon="heroicons-outline:eye"></iconify-icon></a></td>

                                </tr>
                            `;

                        });
                        tableBody.html(html);
                    } else {
                        // Handle error in the API response
                        $('#api-data').append('<tr><td colspan="13">Failed to fetch data from the API.</td></tr>');
                    }

                    currentPage = page;
                    function getVariableValue(url, variable) {
                        const regex = new RegExp(`${variable}=([^&]*)`);
                        const match = url.match(regex);
                        return match ? match[1] : null;
                        }
                        if(response.data.next) {
                            const urlString = response.data.next;
                            var current_page = getVariableValue(urlString, "page") - 1;

                        }else{
                            current_page = 1;
                        }

                    // Populate the pagination links
                    let pagination = $('#pagination');
                    pagination.empty();
                    console.log
                    if (response.data.previous) {
                        pagination.append(
                            `<a class="page-link" href="#" onclick="fetchData(${current_page > 1 ? current_page - 1 : 1})"> <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon> Previous</a>`
                            );
                    }else{
                        pagination.append(
                            `<a class="page-link disabled" href="javascript:void(0)" disabled> <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon> Previous</a>`
                            );
                    }
                    if (response.data.next) {
                        pagination.append(
                            `<a class="page-link" href="#" onclick="fetchData(${current_page + 1})"> Next  <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon></a>`
                            );
                    }else{
                        pagination.append(
                            `<a class="page-link disabled" href="javascript:void(0)" disabled> Next  <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon></a>`
                            );
                    }
                }
            });
        }

        $(document).ready(function() {
            fetchData(); // Fetch initial data on page load
        });
</script> --}}


@endsection
