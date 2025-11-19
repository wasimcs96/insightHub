@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')

@section('styles')

    <style>
        .app-wrapper {
            margin-top: 90px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .back-btn {
            color: #F7941C;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .heading {
            color: #000;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin: 30px 0px;
        }

        .card-heading h3 {
            margin: 0;
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .inner-card {
            display: flex;
            padding: 32px;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-end;
            gap: 24px;
            flex: 1 0 0;
            align-self: stretch;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .button.btn-disabled {
            border: 1px solid #DBDFE9;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .button.btn-enabled {
            background: #F7941C;
            border: 1px solid #F7941C;
            color: #fff;
        }
    </style>

@endsection

@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container styles-bulk-upload">
                <a href="{{route('admin.interview-question.index')}}">
                    <p class="d-flex align-items-center gap-3 back-btn"><iconify-icon icon="majesticons:arrow-left-line"
                        width="18" height="18"></iconify-icon> Back to List
                </p>
                </a>
                <h4 class="heading">Bulk Upload Interview Question</h4>
                <div class="card-heading">
                    <h3>Upload Files</h3>
                    <form action="{{route('interview.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="inner-card">
                            <input class="form-control mb-3" type="file" name="file" accept=".xlsx,.xls" required>
                
                            <div class="text-end mb-3">
                                <a href="{{ route('admin.interview-question.download') }}" class="back-btn text-decoration-underline">
                                    <iconify-icon icon="tabler:download" width="16" height="16"></iconify-icon> Download Sample File
                                </a>
                            </div>
                
                            <div class="text-end">
                                <button class="button btn-enabled" type="submit">Import Interview Question</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
