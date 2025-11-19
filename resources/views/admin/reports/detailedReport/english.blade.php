@extends('admin.layout.app')

@section('title', 'Report')
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
    #tabs-tab .nav-link.active{
        background: #37a7d6 !important;
    color: aliceblue !important;
    border-radius: 4px !important;
    }
    .nav-tabs .nav-link {
        border: 1px solid;
    border-radius: 4px;
    }
    .legend_th{
        background: black;
    color: white;
    }
    .legend_th, .legend-title {
        padding-top: 0.25rem !important;
    padding-bottom: 0.25rem !important;
    padding-left: 0.5rem !important;
    padding-right: 0.5rem !important;
    font-size: 0.5rem !important;
    text-align: center !important;

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
                            Admin
                            <iconify-icon icon="heroicons-outline:chevron-right"
                                class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                        </li>
                        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                            Detailed Reports</li>
                    </ul>
                </div>
                <!-- END: BreadCrumb -->
                <div class="space-y-6">

              @include('admin.reports.detailedReport.filter')

                    <div class="card">

                        <div class="card-body flex flex-col p-6">
                            <header
                                class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <div class="flex-1">
                                    <div class="card-title text-slate-900 dark:text-white">Detailed Reports  <a href="/admin/detailed/report/export/english"
                                        class="btn inline-flex justify-center btn-success" style="
                                        float: right;
                                    ">Export</a></div>
                                </div>
                            </header>
                            <div class="card-text h-full">
                               
                                <div class="card-text h-full ">
                                    <div>
                                     @include('admin.reports.detailedReport.topnav')
                              
                                     <div class="badge-group">
                                        <span class="badge bg-primary-500 text-white mx-5 mb-4" data-v-d70534ce="">
                                            <span class="inline-flex items-center" data-v-d70534ce="">
                                                C = Comprehension , G = Grammar , T = Total
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
                                    
                                                            <tr>
                                    
                                                                <th scope="col" colspan="2" class="bg-warning-400 color-black table-th text-center">
                                                                    User
                                                                </th>
                                                                {{-- <th scope="col" class=" table-th ">
                                                                    
                                                                </th> --}}
                                    
                                                                <th scope="col" colspan="4" class="bg-success-400 color-black table-th text-center ">
                                                                    Demographic
                                                                </th>
                                    
                                                                <th scope="col" colspan="3" class=" table-th bg-primary-400 color-black text-center ">
                                                                    English
                                                                </th>
                                    
                                                            </tr>
                                                            <tr>
                                    
                                                                <th scope="col" class=" table-th ">
                                                                    Name
                                                                </th>
                                                                <th scope="col" class=" table-th ">
                                                                    Email
                                                                </th>
                                    
                                                                <th scope="col" class=" table-th ">
                                                                    Gender
                                                                </th>
                                    
                                                                <th scope="col" class=" table-th ">
                                                                    Race
                                                                </th>
                                                                <th scope="col" class=" table-th ">
                                                                    Age
                                                                </th>
                                                                <th scope="col" class=" table-th ">
                                                                    CGPA
                                                                </th>
                                                              
                                                                <th scope="col" class=" table-th ">
                                                                    C(%)
                                                                </th>
                                                                <th scope="col" class=" table-th ">
                                                                    G(%)
                                                                </th>
                                                                <th scope="col" class=" table-th ">
                                                                    T(%)
                                                                </th>
                                                              
                                    
                                    
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    
                                                            
                                                            @if (isset($table['results']))
                                    
                                                                @foreach ($table['results'] as $key => $item)
                                                                    <tr>
                                                                        <td class="table-td ">{{ $item['display_name'] }}</td>
                                                                        <td class="table-td " style="text-transform: none;">{{ $item['email'] }} </td>
                                                                        <td class="table-td ">
                                    
                                                                            @if ($item['gender'] == 1)
                                                                                Male
                                                                            @else
                                                                                Female
                                                                            @endif
                                                                        </td>
                                                                        <td class="table-td ">{{ $item['race'] }} </td>
                                                                        <td class="table-td ">{{ $item['dob'] }} </td>
                                                                        <td class="table-td ">{{ $item['cgpa'] }} </td>
                                    
                                                                        {{-- <td class="table-td ">{{ $item['english_comprehension'] ?? ''}} </td> --}}
                                                                        <td class="table-td ">
                                                                            @if (isset($item['english_comprehension']))
                                                                            {{ number_format($item['english_comprehension']) }} 
                                                                            @else
                                                                            N/A
                                                                            @endif

                                                                        </td>
                                                                      
                                                                        <td class="table-td ">
                                                                            {{-- {{ $item['english_grammar'] ?? ''}}  --}}
                                                                            @if (isset($item['english_grammar']))
                                                                            {{ number_format($item['english_grammar']) }} 
                                                                            @else
                                                                            N/A
                                                                            @endif
                                                                        </td>
                                                                        <td class="table-td ">
                                                                            {{-- {{ $item['english_total'] ?? ''}}  --}}

                                                                            @if (isset($item['english_total']))
                                                                            {{ number_format($item['english_total']) }} 
                                                                            @else
                                                                            N/A
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                    
                                                            @endif
                                    
                                                        </tbody>
                                                    </table>
                                                  
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

            </div>
        </div>
    </div>
@endsection
