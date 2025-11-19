@extends('admin.layout.app')

@section('title', 'Report')
@section('style')
    <style>
        #pagination {
            display: flex;
            justify-content: space-evenly;
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
                            Population Reports</li>
                    </ul>
                </div>
                <!-- END: BreadCrumb -->
                <div class=" space-y-5">


                    <div class="card rounded-md bg-white dark:bg-slate-800 lg:h-full shadow-base">

                        <div class="card-body flex flex-col p-6">
                            <header
                                class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <div class="flex-1">
                                    <div class="card-title text-slate-900 dark:text-white">Population Reports</div>
                                </div>
                            </header>
                            <div class="card-text h-full">
                                <div class="active">
                                    <ul class="nav nav-pills flex items-center flex-wrap list-none pl-0 mb-6 space-x-4 menu-open"
                                        id="pills-tabHorizontal" role="tablist">
                                        <li class="nav-item text-center" role="presentation">
                                            <a href="#pills-homeHorizontal"
                                                class="nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md px-6 py-3 focus:outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-300  @if (request('tabtype') == 'demograph') active @elseif(request('url') == null && request() != null) active @endif"
                                                id="pills-home-tabHorizontal" data-bs-toggle="pill"
                                                data-bs-target="#pills-homeHorizontal" role="tab"
                                                aria-controls="pills-homeHorizontal" aria-selected="false">Demographics
                                                Data</a>
                                        </li>
                                        <li class="nav-item text-center" role="presentation">
                                            <a href="#pills-profileHorizontal"
                                                class="nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md px-6 py-3 focus:outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-300 @if (request('url') != null) active @endif"
                                                id="pills-profile-tabHorizontal" data-bs-toggle="pill"
                                                data-bs-target="#pills-profileHorizontal" role="tab"
                                                aria-controls="pills-profileHorizontal" aria-selected="true">Tabural
                                                Data</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content" id="pills-tabContentHorizontal">
                                        <div class="tab-pane fade  @if (request('tabtype') == 'demograph') active show @elseif(request('url') == null && request() != null) active show @endif"
                                            id="pills-homeHorizontal" role="tabpanel"
                                            aria-labelledby="pills-home-tabHorizontal">
                                            <div class="card-body flex flex-col p-6  shadow border">
                                                <header
                                                    class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                                    <div class="flex-1">
                                                        <div class="card-title text-slate-900 dark:text-white">Filter</div>
                                                    </div>
                                                </header>
                                                <form action="">
                                                    <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
                                                        <div>
                                                            <label for="default-picker" class=" form-label">From</label>
                                                            <input class="form-control py-2  " id="default-picker"
                                                                value="{{ request('from') }}" type="date" name="from">
                                                        </div>

                                                        <div>
                                                            <label for="default-picker" class=" form-label">to</label>
                                                            <input class="form-control py-2 " id="default-picker"
                                                                value="{{ request('to') }}" type="date" name="to">
                                                        </div>
                                                        <input type="hidden" name="tabtype" value="demograph">
                                                        <div>
                                                            <label for="basicSelect" class="form-label">Year of
                                                                Study</label>
                                                            <select name="yearstudy" id="basicSelect"
                                                                class="form-control w-full mt-2">
                                                                <option value=""
                                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                    All</option>
                                                                @foreach ($yearstudy->data as $data)
                                                                    <option
                                                                        @if (request('yearstudy') == $data->Id) selected @endif
                                                                        value="{{ $data->Id ?? '' }}"
                                                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                        {{ $data->Name ?? '' }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="basicSelect" class="form-label">Scope of
                                                                Study</label>
                                                            <select name="scopestudy" id="basicSelect"
                                                                class="form-control w-full mt-2">
                                                                <option value=""
                                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                    All</option>
                                                                @foreach ($scopestudy->data as $data)
                                                                    <option
                                                                        @if (request('scopestudy') == $data->Id) selected @endif
                                                                        value="{{ $data->Id ?? '' }}"
                                                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                        {{ $data->Name ?? '' }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>


                                                        <div>
                                                            <label for="basicSelect" class="form-label">Gender</label>
                                                            <select name="gender" id="basicSelect"
                                                                class="form-control w-full mt-2">
                                                                <option selected="Selected" value=""
                                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                    Select Gender</option>
                                                                <option value=""
                                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                    All
                                                                </option>
                                                                <option @if (request('gender') == 1) selected @endif
                                                                    value="1"
                                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                    Male
                                                                </option>
                                                                <option @if (request('gender') == 2) selected @endif
                                                                    value="2"
                                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                                    Female</option>
                                                            </select>
                                                        </div>

                                                        <div class="filter-btn"
                                                            style="
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: end;
                                                    ">
                                                            <button
                                                                class="btn inline-flex justify-center btn-success shadow-base2">Filter
                                                                data</button>
                                                        </div>
                                                    </div>
                                                </form>


                                            </div>
                                            <div class="card">


                                                <header class=" card-header noborder">
                                                    <h4 class="card-title"> Population Reports
                                                    </h4>
                                                </header>
                                                <div class="card-body px-6 pb-6">
                                                    <div class="grid md:grid-cols-3 grid-cols-1 gap-4">

                                                        <!-- BEGIN: Group Chart -->


                                                        <div class="card  shadow border">
                                                            <div class="card-body pt-4 pb-3 px-4">
                                                                <div class="flex space-x-3 rtl:space-x-reverse">
                                                                    <div class="flex-none">
                                                                        <div
                                                                            class="h-12 w-12 rounded-full flex flex-col items-center justify-center text-2xl bg-[#E5F9FF] dark:bg-slate-900	 text-info-500">
                                                                            <iconify-icon
                                                                                icon="heroicons:clock"></iconify-icon>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-1">
                                                                        <div
                                                                            class="text-slate-600 dark:text-slate-300 text-sm mb-1 font-medium">
                                                                            Average Time
                                                                        </div>
                                                                        <div
                                                                            class="text-slate-900 dark:text-white text-lg font-medium">
                                                                            {{ $population->data->data->average_time ?? 'N/A' }}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="card  shadow border">
                                                            <div class="card-body pt-4 pb-3 px-4">
                                                                <div class="flex space-x-3 rtl:space-x-reverse">
                                                                    <div class="flex-none">
                                                                        <div
                                                                            class="h-12 w-12 rounded-full flex flex-col items-center justify-center text-2xl bg-[#FFEDE6] dark:bg-slate-900	 text-warning-500">
                                                                            <iconify-icon
                                                                                icon="heroicons:calculator"></iconify-icon>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-1">
                                                                        <div
                                                                            class="text-slate-600 dark:text-slate-300 text-sm mb-1 font-medium">
                                                                            Average Score
                                                                        </div>
                                                                        <div
                                                                            class="text-slate-900 dark:text-white text-lg font-medium">
                                                                            {{ $population->data->data->average_score ?? 'N/A' }}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="card  shadow border">
                                                            <div class="card-body pt-4 pb-3 px-4">
                                                                <div class="flex space-x-3 rtl:space-x-reverse">
                                                                    <div class="flex-none">
                                                                        <div
                                                                            class="h-12 w-12 rounded-full flex flex-col items-center justify-center text-2xl bg-[#EAE6FF] dark:bg-slate-900	 text-[#5743BE]">
                                                                            <iconify-icon
                                                                                icon="heroicons:plus-circle"></iconify-icon>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-1">
                                                                        <div
                                                                            class="text-slate-600 dark:text-slate-300 text-sm mb-1 font-medium">
                                                                            Total Count
                                                                        </div>
                                                                        <div
                                                                            class="text-slate-900 dark:text-white text-lg font-medium">
                                                                            {{ $population->data->data->total_counts ?? 'N/A' }}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- END: Group Chart -->
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="tab-pane fade @if (request('url') != null) active show @endif"
                                            id="pills-profileHorizontal" role="tabpanel">
                                            <div class="card-body px-6 pb-6">
                                                <div
                                                    style=" display: flex;      justify-content: end;         margin-bottom: 15px;">
                                                    <a href="/admin/population/tabular/export"
                                                        class="btn inline-flex justify-center btn-success">Export</a></div>
                                                <div class="overflow-x-auto -mx-6 ">
                                                    <span class=" col-span-8  hidden"></span>
                                                    <span class="  col-span-4 hidden"></span>
                                                    <div class="inline-block min-w-full align-middle">
                                                        <div class="overflow-hidden ">
                                                            <table id="students-table"
                                                                class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
                                                                <thead class=" bg-slate-200 dark:bg-slate-700">
                                                                    <tr>

                                                                        <th scope="col" class=" table-th ">
                                                                            Question NO.
                                                                        </th>

                                                                        <th scope="col" class=" table-th ">
                                                                            Answer A
                                                                        </th>

                                                                        <th scope="col" class=" table-th ">
                                                                            Answer B
                                                                        </th>
                                                                        <th scope="col" class=" table-th ">
                                                                            Answer C
                                                                        </th>
                                                                        <th scope="col" class=" table-th ">
                                                                            Answer D
                                                                        </th>

                                                                        <th scope="col" class=" table-th ">
                                                                            Average Time Taken (Sec)
                                                                        </th>

                                                                        <th scope="col" class=" table-th ">
                                                                            % Talent Answer Correctly
                                                                        </th>


                                                                    </tr>
                                                                </thead>

                                                                <tbody
                                                                    class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                                    {{-- @php
                                                                try {
                                                                    $url = urldecode(request()->query('url'));
                                                                    $parsedUrl = parse_url($url);
                                                                    parse_str($parsedUrl['query'], $queryParameters);
                                                                    $page = $queryParameters['page'];
                                                                    $startingId = ($page - 1) * 10 + 1;
                                                                } catch (\Throwable $th) {
                                                                    $startingId = 1;
                                                                }
                                
                                                                @endphp --}}
                                                                    @if (isset($table['results']))
                                                                        @foreach ($table['results'] as $i => $item)
                                                                            <tr>
                                                                                <td class="table-td ">{{ $item['id'] }}
                                                                                </td>
                                                                                <td class="table-td ">
                                                                                    {{ number_format($item['average_a'], 0) }}
                                                                                </td>
                                                                                <td class="table-td ">
                                                                                    {{ number_format($item['average_b'], 0) }}
                                                                                </td>
                                                                                <td class="table-td ">
                                                                                    {{ number_format($item['average_c'], 0) }}
                                                                                </td>
                                                                                <td class="table-td ">
                                                                                    {{ number_format($item['average_d'], 0) }}
                                                                                </td>
                                                                                <td class="table-td ">
                                                                                    {{ number_format($item['average_time'], 0) }}
                                                                                </td>
                                                                                <td class="table-td ">
                                                                                    {{ number_format($item['average_correct'], 0) }}
                                                                                </td>
                                                                                {{-- <td class="table-td "> {{ $item['is_correct'] == 1 ? 'Correct' : 'Wrong' }}</td>
                                                                    <td class="table-td ">{{number_format( $item['answer'] ?? 'N/A'}}</td>
                                                                    <td class="table-td ">{{number_format( $item['time_taken']}}</td> --}}

                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                            {{-- <div id="pagination" class="d-flex justify-content-center mt-3">
                                                            <!-- Next and Previous page links will be populated dynamically with AJAX -->
                                                            @if (isset($table['previous']) && $table['previous'] != null)
                                                            <a class="page-link" href="{{ route('population.report', ['url' => $table['previous']]) }}"> <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon> Previous</a>
                                                         
                                                            @else
                                                            <a class="page-link disabled" href="javascript:void(0)" disabled> <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon> Previous</a>
                                                            @endif
                                
                                
                                                            @if (isset($table['next']) && $table['next'] != null)
                                                            <a class="page-link" href="{{ route('population.report', ['url' => $table['next']]) }}" > Next  <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon></a>
                                                            @else
                                                            <a class="page-link disabled" href="javascript:void(0)" disabled> Next  <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon></a>
                                                            @endif
                                                        </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- <div class="card-body flex flex-col p-6">
                            <header
                                class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <div class="flex-1">
                                    <div class="card-title text-slate-900 dark:text-white">Filter</div>
                                </div>
                            </header>
                            <form action="">
                                <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
                                    <div>
                                        <label for="default-picker" class=" form-label">From</label>
                                        <input class="form-control py-2  " id="default-picker" value="{{ request('from') }}"
                                            type="date" name="from">
                                    </div>

                                    <div>
                                        <label for="default-picker" class=" form-label">to</label>
                                        <input class="form-control py-2 " id="default-picker" value="{{ request('to') }}"
                                            type="date" name="to">
                                    </div>

                                    <div>
                                        <label for="basicSelect" class="form-label">Year of Study</label>
                                        <select name="yearstudy" id="basicSelect" class="form-control w-full mt-2">
                                            <option value=""
                                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                Select Year of Study</option>
                                            @foreach ($yearstudy->data as $data)
                                                <option @if (request('yearstudy') == $data->Id) selected @endif
                                                    value="{{ $data->Id ?? '' }}"
                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                    {{ $data->Name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="basicSelect" class="form-label">Scope of Study</label>
                                        <select name="scopestudy" id="basicSelect" class="form-control w-full mt-2">
                                            <option value=""
                                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                Select Scope of Study</option>
                                            @foreach ($scopestudy->data as $data)
                                                <option @if (request('scopestudy') == $data->Id) selected @endif
                                                    value="{{ $data->Id ?? '' }}"
                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                    {{ $data->Name ?? '' }}</option>
                                            @endforeach

                                        </select>
                                    </div>


                                    <div>
                                        <label for="basicSelect" class="form-label">Gender</label>
                                        <select name="gender" id="basicSelect" class="form-control w-full mt-2">
                                            <option selected="Selected" value=""
                                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                Select Gender</option>
                                            <option value="all"
                                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">All
                                            </option>
                                            <option @if (request('gender') == 1) selected @endif value="1"
                                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                Male
                                            </option>
                                            <option @if (request('gender') == 2) selected @endif value="2"
                                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                Female</option>
                                        </select>
                                    </div>

                                    <div class="filter-btn">
                                        <button
                                            class="btn inline-flex justify-center btn-success shadow-base2">success</button>
                                    </div>
                                </div>
                            </form>


                        </div> --}}
                    </div>


                    {{-- 
                    <div class="card">


                        <header class=" card-header noborder">
                            <h4 class="card-title"> Population Reports
                            </h4>
                        </header>
                        <div class="card-body px-6 pb-6">
                            <div class="grid md:grid-cols-3 grid-cols-1 gap-4">

                                <!-- BEGIN: Group Chart -->


                                <div class="card">
                                    <div class="card-body pt-4 pb-3 px-4">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <div class="flex-none">
                                                <div
                                                    class="h-12 w-12 rounded-full flex flex-col items-center justify-center text-2xl bg-[#E5F9FF] dark:bg-slate-900	 text-info-500">
                                                    <iconify-icon icon="heroicons:clock"></iconify-icon>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-slate-600 dark:text-slate-300 text-sm mb-1 font-medium">
                                                    Average Time
                                                </div>
                                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                                    {{ $population->data->data->average_time ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body pt-4 pb-3 px-4">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <div class="flex-none">
                                                <div
                                                    class="h-12 w-12 rounded-full flex flex-col items-center justify-center text-2xl bg-[#FFEDE6] dark:bg-slate-900	 text-warning-500">
                                                    <iconify-icon icon="heroicons:calculator"></iconify-icon>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-slate-600 dark:text-slate-300 text-sm mb-1 font-medium">
                                                    Average Score
                                                </div>
                                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                                    {{ $population->data->data->average_score ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body pt-4 pb-3 px-4">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <div class="flex-none">
                                                <div
                                                    class="h-12 w-12 rounded-full flex flex-col items-center justify-center text-2xl bg-[#EAE6FF] dark:bg-slate-900	 text-[#5743BE]">
                                                    <iconify-icon icon="heroicons:plus-circle"></iconify-icon>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-slate-600 dark:text-slate-300 text-sm mb-1 font-medium">
                                                    Total Count
                                                </div>
                                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                                    {{ $population->data->data->total_counts ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- END: Group Chart -->
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        // Sample data
        var chartData = {
            "average_time": 16.8125,
            "average_score": 1.0,
            "total_counts": 2
        };

        // Chart options for average time chart
        var averageTimeOptions = {
            chart: {
                type: 'pie'
            },
            series: [chartData.average_time],
            labels: ['Average Time']
        };

        // Chart options for average score chart
        var averageScoreOptions = {
            chart: {
                type: 'pie'
            },
            series: [chartData.average_score],
            labels: ['Average Score']
        };

        // Chart options for total counts chart
        var totalCountsOptions = {
            chart: {
                type: 'pie'
            },
            series: [chartData.total_counts],
            labels: ['Total Counts']
        };

        // Create and render the charts
        var averageTimeChart = new ApexCharts(document.querySelector("#average-time-chart"), averageTimeOptions);
        var averageScoreChart = new ApexCharts(document.querySelector("#average-score-chart"), averageScoreOptions);
        var totalCountsChart = new ApexCharts(document.querySelector("#total-counts-chart"), totalCountsOptions);

        averageTimeChart.render();
        averageScoreChart.render();
        totalCountsChart.render();
    </script>

@endsection --}}
