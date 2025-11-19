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

        [type=radio]:checked+label:before,
        [type=radio]:not(:checked)+label:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 35px;
            height: 35px;
            border: 3px solid #F87DA9;
            border-radius: 100%;
            background: #fff;
        }

        [type=radio]:checked+label:after,
        [type=radio]:not(:checked)+label:after {
            content: "";
            width: 25px;
            height: 25px;
            background: #F87DA9;
            position: absolute;
            top: 5px;
            left: 5px;
            border-radius: 100%;
            transition: all 0.2s ease;
        }

        [type=radio]:not(:checked)+label:after {
            opacity: 0;
            transform: scale(0);
        }

        .colorful-radios div:nth-child(5) [type=radio]:checked+label:before,
        .colorful-radios div:nth-child(5) [type=radio]:not(:checked)+label:before {
            border-color: #FE60B1 !important;
        }

        .question_title {
            color: rgb(0, 0, 0);
            font-size: 17.6px;
            margin-top: 0px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .question_list {
            padding-bottom: 58px;
            margin-bottom: 24px;
            border-bottom: 0.8px solid rgb(222, 226, 230);
            box-sizing: border-box;
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
                            <a href="/admin/dashboard">  Reports</a>
                            <iconify-icon icon="heroicons-outline:chevron-right"
                                class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                        </li>
                        <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                           <a href="{{route('individual.report')}}"> Individual Reports </a>
                            <iconify-icon icon="heroicons-outline:chevron-right"
                                class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                        </li>
                        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                            Riasec Reports</li>
                    </ul>
                </div>
                <!-- END: BreadCrumb -->
                <div class=" space-y-5">
                    <div
                        style="padding:48px;border-radius:50px;--bs-bg-opacity: 1;background-color:rgb(255, 255, 255);padding-top:48px;padding-bottom:48px;margin-bottom:48px;box-shadow:rgba(0, 0, 0, 0.15) 0px 8px 16px 0px;box-sizing:border-box;">
                        <div
                            style="border-radius:20.8px;--bs-bg-opacity: 1;background-color:rgb(255, 255, 255);padding:16px;margin-bottom:48px;position:relative;box-shadow:rgba(0, 0, 0, 0.15) 0px 8px 16px 0px;box-sizing:border-box;">
                            <div style="left:0px;top:0px;height:0px;width: 100% !important;box-sizing:border-box;"></div>
                            <div style="justify-content:space-between;display:flex;box-sizing:border-box;">
                                <div
                                    style="margin-right:48px;color:rgb(92, 91, 157);text-align:center;box-sizing:border-box;">
                                    <input type="radio" checked value="0"
                                        style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                        style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                    <div
                                        style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                        Very<br style="box-sizing:border-box;" />Inaccurate</div>
                                </div>
                                <div
                                    style="margin-right:48px;color:rgb(143, 93, 164);text-align:center;box-sizing:border-box;">
                                    <input checked type="radio" value="1"
                                        style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                        style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                    <div
                                        style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                        Moderately<br style="box-sizing:border-box;" /> Inaccurate</div>
                                </div>
                                <div
                                    style="margin-right:48px;color:rgb(169, 94, 167);text-align:center;box-sizing:border-box;">
                                    <input checked type="radio" value="2"
                                        style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                        style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                    <div
                                        style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                        Neither<br style="box-sizing:border-box;" />Accurate<br
                                            style="box-sizing:border-box;" />Nor<br
                                            style="box-sizing:border-box;" />Inaccurate </div>
                                </div>
                                <div
                                    style="margin-right:48px;color:rgb(195, 95, 170);text-align:center;box-sizing:border-box;">
                                    <input checked type="radio" value="3"
                                        style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                        style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                    <div
                                        style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                        Moderately<br style="box-sizing:border-box;" /> Accurate</div>
                                </div>
                                <div style="color:rgb(254, 96, 177);text-align:center;box-sizing:border-box;"><input
                                        type="radio" value="4" checked
                                        style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                        style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                    <div
                                        style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                        Very<br style="box-sizing:border-box;" />Accurate</div>
                                </div>
                            </div>
                        </div>
                        
                        @if (isset($data['data']))

                        @foreach ($data['data'] as $item)
                        <div style="margin-bottom:18px;box-sizing:border-box;">
                            <div class="question_list">
                                <p class="question_title">{{ $item['question'] }}</p>
                                <div style="justify-content: space-between;display:flex;box-sizing:border-box;">
                                    <div
                                        style="margin-right:48px;color:rgb(92, 91, 157);text-align:center;box-sizing:border-box;">
                                        <input type="radio" @if($item['answer'] == 0) checked @endif 
                                            style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                            for="test1-116-1"
                                            style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                        <div
                                            style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                            Very<br style="box-sizing:border-box;" />Inaccurate</div>
                                    </div>
                                    <div
                                        style="margin-right:48px;color:rgb(143, 93, 164);text-align:center;box-sizing:border-box;">
                                        <input type="radio" @if($item['answer'] == 1) checked @endif
                                            style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                            for="test1-116-2"
                                            style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                        <div
                                            style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                            <div style="visibility: hidden;color:rgb(92, 91, 157);box-sizing:border-box;">
                                                Very<br style="box-sizing:border-box;" />Accurate</div>
                                        </div>
                                    </div>
                                    <div
                                        style="margin-right:48px;color:rgb(169, 94, 167);text-align:center;box-sizing:border-box;">
                                        <input type="radio" @if($item['answer'] == 2) checked @endif
                                            style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                            for="test1-116-3"
                                            style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                        <div
                                            style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                            <div style="visibility: hidden;color:rgb(92, 91, 157);box-sizing:border-box;">
                                                Very<br style="box-sizing:border-box;" />Accurate</div>
                                        </div>
                                    </div>
                                    <div
                                        style="margin-right:48px;color:rgb(195, 95, 170);text-align:center;box-sizing:border-box;">
                                        <input type="radio" @if($item['answer'] == 3) checked @endif 
                                            style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                            for="test1-116-4"
                                            style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                        <div
                                            style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                            <div style="visibility: hidden;color:rgb(92, 91, 157);box-sizing:border-box;">
                                                Very<br style="box-sizing:border-box;" />Accurate</div>
                                        </div>
                                    </div>
                                    <div
                                        style="margin-right:48px;color:rgb(254, 96, 177);text-align:center;box-sizing:border-box;">
                                        <input type="radio" @if($item['answer'] == 4) checked @endif 
                                            style="position:absolute;left:-9999px;margin:0px;font-family:'Open Sans', Helvetica, Arial, Lucida, sans-serif;font-size:14.4px;line-height:23.04px;box-sizing:border-box;" /><label
                                            for="test1-116-5"
                                            style="position:relative;padding-left:35px;cursor:pointer;line-height:35px;display:inline-block;color:rgb(102, 102, 102);box-sizing:border-box;">&nbsp;</label>
                                        <div
                                            style="color:rgb(169, 94, 167);font-weight:500;line-height:14.4px;margin-top:8px;box-sizing:border-box;">
                                            Very<br style="box-sizing:border-box;" />Accurate</div>
                                    </div>
                                </div>
                                <!--v-if-->
                            </div>


                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




@endsection
