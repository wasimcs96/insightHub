@extends('admin.layout.app')

@section('title', 'Report')
@section('style')
<style>
    #pagination{
        display: flex;
    justify-content: space-evenly;
    align-items: center;
    }
    #pagination a{
        background-color: #e2e8f0;
        padding: 9px;
        border-radius: 5px;
        color: black;
        display: flex;
    align-items: center;
    }
    #pagination .disabled{
        background-color: #ededed !important;
        color:#a5a5a5;
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
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
              </a>
            </li>
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
              Reports
              <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
             Individual Reports</li>
             <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                Individual Report Details</li>
          </ul>
        </div>
        <!-- END: BreadCrumb -->
        <div class=" space-y-5">

    <div class="card">
        <header class=" card-header noborder">
            <h4 class="card-title"> Individual Report Details
            </h4>
          
            {{-- <a href="/admin/individual/student/detail/export" class="btn inline-flex justify-center btn-success">Export</a> --}}
        </header>
        <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 ">
                <span class=" col-span-8  hidden"></span>
                <span class="  col-span-4 hidden"></span>
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table id="students-table" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
                            <thead class=" bg-slate-200 dark:bg-slate-700">
                                <tr>

                                    <th scope="col" class=" table-th ">
                                        Question
                                    </th>

                                    <th scope="col" class=" table-th ">
                                        Answer
                                    </th>

                                    <th scope="col" class=" table-th ">
                                        Status
                                    </th>

                                    <th scope="col" class=" table-th ">
                                        Points
                                    </th>
                                    <th scope="col" class=" table-th ">
                                        Time Taken(sec)
                                    </th>

                                </tr>
                            </thead>
                            
                            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                @php
                                try {
                                    $url = urldecode(request()->query('url'));
                                    $parsedUrl = parse_url($url);
                                    parse_str($parsedUrl['query'], $queryParameters);
                                    $page = $queryParameters['page'];
                                    $startingId = ($page - 1) * 10 + 1;
                                } catch (\Throwable $th) {
                                    $startingId = 1;
                                }

                                @endphp
                                {{-- {{dd($page)}} --}}
                            @foreach($data['results'] as $i => $item)
                                <tr>
                                    <td class="table-td ">{{ $startingId + $i}}</td>
                                    <td class="table-td ">
                                        @if ( $item['option_selected'] == 1)
                                        A
                                    @elseif ( $item['option_selected'] == 2)
                                        B
                                    @elseif ( $item['option_selected'] == 3)
                                       C
                                    @elseif ( $item['option_selected'] == 4)
                                       D
                                    @else 
                                    Time Up
                                    @endif
                                    
                                    </td>
                                    <td class="table-td "> {{ $item['is_correct'] == 1 ? 'Correct' : 'Wrong' }}</td>
                                    <td class="table-td ">{{ $item['answer'] ?? 'N/A'}}</td>
                                    <td class="table-td ">{{ $item['time_taken']}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div id="pagination" class="d-flex justify-content-center mt-3">
                            <!-- Next and Previous page links will be populated dynamically with AJAX -->
                            @if (isset($data['previous']) && $data['previous'] != null)
                            <a class="page-link" href="{{ route('individual.report.detail.paginate', ['url' => $data['previous']]) }}"> <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon> Previous</a>
                         
                            @else
                            <a class="page-link disabled" href="javascript:void(0)" disabled> <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon> Previous</a>
                            @endif


                            @if(isset($data['next']) && $data['next'] != null)
                            <a class="page-link" href="{{ route('individual.report.detail.paginate', ['url' => $data['next']]) }}" > Next  <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon></a>
                            @else
                            <a class="page-link disabled" href="javascript:void(0)" disabled> Next  <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon></a>
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
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
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
                                    <td class="table-td "><a class="action-btn" href="/individual/detail/${item.user_id}"><iconify-icon icon="heroicons-outline:eye"></iconify-icon></a></td>

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
