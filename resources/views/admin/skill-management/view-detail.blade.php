@extends('admin.layout.app')

@section('title', 'Technical Skill Details')

@section('styles')
    <style>
        .ts-detail-main {
            display: flex;
            padding: 32px 24px;
            flex-direction: column;
            align-items: flex-start;
            gap: 24px;
            border-radius: 8px;
            background: #FFF;
        }

        .content-desc {
            gap: 24px;
        }

        .content-desc h1 {
            font-size: 28px;
            font-weight: 700;
            line-height: 39px;
        }

        .content-desc h1 span {
            padding: 8px 16px;
            gap: 8px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .custom-btn {
            padding: 12px 18px;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
        }

        .para {
            color: #071437;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .nav-pills {
            border-bottom: 1px solid #DBDFE9;
        }

        .nav-pills .nav-link {
            display: flex;
            padding: 12px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #99A1B7;
            font-size: 17.55px;
            font-weight: 400;
            line-height: 23.4px;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-bottom: 3px solid #F7941C;
            color: #000;
            font-weight: 500;
            line-height: 21.06px;
            background-color: #fff;
            border-radius: 0;
        }

        .nav-link.active iconify-icon.star-active {
            color: #F3AC60;
        }

        .ts-detail-card .header {
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

        .ts-detail-card .inner-content {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .ts-detail-card .inner-content .para {
            color: #3E3E3E;
        }

        .see-more-btn {
            color: #F7941C;
            font-size: 14px;
            font-weight: 700;
            line-height: 20px;
            text-decoration-line: underline;
            cursor: pointer;
        }

        .pagination .page-link {
            color: #78829D;
            border: none;
            background: transparent;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .page-item:hover:not(.active):not(.offset):not(.disabled) .page-link {
            color: #78829D;
        }

        .pagination .page-item.active-custom .page-link {
            background-color: #FABB6E;
            color: white;
            border-radius: 6px;
            border: none;
            font-weight: 600;
        }

        .pagination .page-link:focus {
            box-shadow: none;
        }
    </style>

    <style>
        .modal-footer button {
            flex: 1 0 0;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
        }

        .custom-popup-body h4 {
            margin: 16px auto 13px auto;
            color: #071437;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .custom-popup-body p {
            color: #071437;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .manually-radio {
            position: relative;
        }

        .manually-radio input[type="radio"] {
            display: none;
        }

        .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }

        .manually-modal-inner {
            border-radius: 16px;
            border: 2px solid #F1F1F4;
            padding: 16px;
            flex: 1 0 0;
            height: 160px;
            cursor: pointer;
        }

        .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }

        .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }

        .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }

        .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;
        }

        .modal-header h1 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .input-wrapper {
            height: 36px;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Technical Skill Details
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary"> Company Technical Skills</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumbText"> Aircraft Cruise Operations</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumbText"> View Technical Skill</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl">
            <div class="ts-detail-main">
                <div class="content-desc d-flex flex-column w-100">
                    <div class="heading-btn d-flex align-items-center justify-content-between">
                        <h1 class="m-0 align-items-center d-flex gap-3">Aircraft Cruise Operations <span>Aircraft
                                Operations</span></h1>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editTechnicalSkill"
                            class="custom-btn orange-fill border-0 d-flex align-items-center"><iconify-icon
                                icon="meteor-icons:pencil" width="16" height="16"></iconify-icon> Edit Technical
                            Skill</button>
                        <div class="modal fade" id="editTechnicalSkill" tabindex="-1"
                            aria-labelledby="editTechnicalSkillLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header pb-0 border-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body py-0">
                                        <div class="custom-popup-body text-center m-auto">
                                            <iconify-icon icon="jam:alert" width="70" height="70"
                                                style="color: #F8BB86;"></iconify-icon>
                                            <h4>Edit Technical Skill?</h4>
                                            <p>Choose how you'd like to apply the changes to this technical skill.</p>
                                            <form>
                                                <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                                                    <label class="manually-radio w-100">
                                                        <input type="radio" name="jdOption" value="custom">
                                                        <div class="d-flex flex-column gap-3 manually-modal-inner">
                                                            <p class="m-0 text-left fw-bold">Duplicate as New Skill</p>
                                                            <div class="line"></div>
                                                            <p class="m-0 text-left">Duplicate the existing technical skill
                                                                in the Localised Technical Skill Library into a new entry.
                                                            </p>
                                                        </div>
                                                    </label>
                                                    <label class="manually-radio w-100">
                                                        <input type="radio" name="jdOption" value="master">
                                                        <div class="d-flex flex-column gap-3 manually-modal-inner">
                                                            <p class="m-0 text-left fw-bold">Overwrite Localised Technical
                                                                Skill</p>
                                                            <div class="line"></div>
                                                            <p class="m-0 text-left">Replace the existing skill in the
                                                                Localised Technical Skill Library with the updated version.
                                                                This will affect all 70 JDs currently linked to it.</p>
                                                        </div>
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pt-0 justify-content-center">
                                        <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
                                            data-bs-dismiss="modal">Cancel</button>

                                        <button type="button" class="text-center fs-6 disable-grey-popup flex-grow-0 px-14"
                                            disabled style="display: block;">Proceed</button>

                                        <button type="button" data-bs-toggle="modal" data-bs-target="#duplicateAsNewSkill"
                                            class="text-center fs-6 orange-fill-popup flex-grow-0 px-14"
                                            style="display: none;">Proceed</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="duplicateAsNewSkill" tabindex="-1" aria-labelledby="duplicateAsNewSkillLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="m-0" id="duplicateAsNewSkillLabel">Duplicate as New Skill</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="custom-popup-body">
                                        <p class="m-0">Existing Technical Skill Title</p>
                                        <p class="mb-7"><b>Aircraft Cruise Operations</b></p>
                                        <label class="form-label">New Technical Skill Title</label>
                                        <div class="input-wrapper d-flex">
                                            <input type="text" class="border-0 w-100"
                                                placeholder="New Technical Skill Title" />
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="text-center fs-6 orange-fill-popup flex-grow-0 px-14">Duplicate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="m-0 para">Aircraft Cruise Operations involve the management and optimization of an aircraft's
                        performance
                        during the cruise phase of flight. This includes monitoring altitude, speed, fuel consumption,
                        and navigation to ensure efficient and safe travel. Professionals in this field must understand
                        aerodynamics, meteorology, and aircraft systems to make real-time adjustments and decisions that
                        enhance operational efficiency and passenger comfort.</p>
                </div>
                <div class="w-100">
                    <ul class="nav nav-pills mb-3 w-100" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-level-4-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-level-4" type="button" role="tab"
                                aria-controls="pills-level-4" aria-selected="true">Level 4 <iconify-icon
                                    icon="material-symbols:star" class="star-active" width="16"
                                    height="16"></iconify-icon></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-level-5-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-level-5" type="button" role="tab"
                                aria-controls="pills-level-5" aria-selected="false">Level 5 <iconify-icon
                                    icon="material-symbols:star" class="star-active" width="16"
                                    height="16"></iconify-icon></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-level-6-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-level-6" type="button" role="tab"
                                aria-controls="pills-level-6" aria-selected="false">Level 6 <iconify-icon
                                    icon="material-symbols:star" class="star-active" width="16"
                                    height="16"></iconify-icon></button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-level-4" role="tabpanel"
                            aria-labelledby="pills-level-4-tab" tabindex="0">
                            <div class="ts-detail-card mb-5">
                                <div class="header">
                                    <p class="m-0">Technical Skill Details</p>
                                </div>
                                <div class="inner-content">
                                    <div class="mb-5">
                                        <p class="m-0 para"><b>Description</b></p>
                                        <p class="para">Monitor aircraft turnaround activities to ensure adherence to
                                            established safety
                                            standards.</p>
                                    </div>
                                    <div class="mb-5">
                                        <p class="m-0 para"><b>Knowledge</b></p>
                                        <ul>
                                            <li class="para">Airside signals, signs and markings</li>
                                            <li class="para">Airport layout plans</li>
                                            <li class="para">Standards for airside vehicle serviceability</li>
                                            <li class="para">Airside safety and compliance requirements</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="m-0 para"><b>Abilities</b></p>
                                        <ul>
                                            <li class="para">Perform checks on motor vehicles for serviceability before
                                                driving</li>
                                            <li class="para">Drive motor vehicles to reach work areas without incidents
                                                and/or accidents</li>
                                            <li class="para">Contact relevant authorities in the event of motor vehicle
                                                incidents and/or accidents</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="ts-detail-card">
                                <div class="header">
                                    <p class="m-0">Assigned Job Descriptions (JDs)</p>
                                </div>
                                <div class="inner-content">
                                    <ul class="nav nav-pills mb-7 w-100" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-JDs-level-1-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-JDs-level-1" type="button"
                                                role="tab" aria-controls="pills-JDs-level-1"
                                                aria-selected="true">Level 1 <iconify-icon icon="material-symbols:star"
                                                    class="star-active" width="16"
                                                    height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-2-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-2" type="button" role="tab"
                                                aria-controls="pills-JDs-level-2" aria-selected="false">Level
                                                2 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-3-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-3" type="button" role="tab"
                                                aria-controls="pills-JDs-level-3" aria-selected="false">Level
                                                3 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-4-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-4" type="button" role="tab"
                                                aria-controls="pills-JDs-level-4" aria-selected="false">Level
                                                4 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-5-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-5" type="button" role="tab"
                                                aria-controls="pills-JDs-level-5" aria-selected="false">Level
                                                5 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-JDs-level-1" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-1-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-2" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-2-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>

                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-3" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-3-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-4" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-4-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-5" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-5-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-level-5" role="tabpanel"
                            aria-labelledby="pills-level-5-tab" tabindex="0">
                            <div class="ts-detail-card mb-5">
                                <div class="header">
                                    <p class="m-0">Technical Skill Details</p>
                                </div>
                                <div class="inner-content">
                                    <div class="mb-5">
                                        <p class="m-0 para"><b>Description</b></p>
                                        <p class="para">Monitor aircraft turnaround activities to ensure adherence to
                                            established safety
                                            standards.</p>
                                    </div>
                                    <div class="mb-5">
                                        <p class="m-0 para"><b>Knowledge</b></p>
                                        <ul>
                                            <li class="para">Airside signals, signs and markings</li>
                                            <li class="para">Airport layout plans</li>
                                            <li class="para">Standards for airside vehicle serviceability</li>
                                            <li class="para">Airside safety and compliance requirements</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="m-0 para"><b>Abilities</b></p>
                                        <ul>
                                            <li class="para">Perform checks on motor vehicles for serviceability before
                                                driving</li>
                                            <li class="para">Drive motor vehicles to reach work areas without incidents
                                                and/or accidents</li>
                                            <li class="para">Contact relevant authorities in the event of motor vehicle
                                                incidents and/or accidents</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="ts-detail-card">
                                <div class="header">
                                    <p class="m-0">Assigned Job Descriptions (JDs)</p>
                                </div>
                                <div class="inner-content">
                                    <ul class="nav nav-pills mb-7 w-100" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-JDs-level-5-1-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-JDs-level-5-1"
                                                type="button" role="tab" aria-controls="pills-JDs-level-5-1"
                                                aria-selected="true">Level 1 <iconify-icon icon="material-symbols:star"
                                                    class="star-active" width="16"
                                                    height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-5-2-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-5-2" type="button" role="tab"
                                                aria-controls="pills-JDs-level-5-2" aria-selected="false">Level
                                                2 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-5-3-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-5-3" type="button" role="tab"
                                                aria-controls="pills-JDs-level-5-3" aria-selected="false">Level
                                                3 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-5-4-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-5-4" type="button" role="tab"
                                                aria-controls="pills-JDs-level-5-4" aria-selected="false">Level
                                                4 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-5-5-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-JDs-level-5-5" type="button" role="tab"
                                                aria-controls="pills-JDs-level-5-5" aria-selected="false">Level
                                                5 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-JDs-level-5-1" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-5-1-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-5-2" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-5-2-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-5-3" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-5-3-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-5-4" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-5-4-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-5-5" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-5-5-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-level-6" role="tabpanel"
                            aria-labelledby="pills-level-6-tab" tabindex="0">
                            <div class="ts-detail-card mb-5">
                                <div class="header">
                                    <p class="m-0">Technical Skill Details</p>
                                </div>
                                <div class="inner-content">
                                    <div class="mb-5">
                                        <p class="m-0 para"><b>Description</b></p>
                                        <p class="para">Monitor aircraft turnaround activities to ensure adherence to
                                            established safety
                                            standards.</p>
                                    </div>
                                    <div class="mb-5">
                                        <p class="m-0 para"><b>Knowledge</b></p>
                                        <ul>
                                            <li class="para">Airside signals, signs and markings</li>
                                            <li class="para">Airport layout plans</li>
                                            <li class="para">Standards for airside vehicle serviceability</li>
                                            <li class="para">Airside safety and compliance requirements</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="m-0 para"><b>Abilities</b></p>
                                        <ul>
                                            <li class="para">Perform checks on motor vehicles for serviceability before
                                                driving</li>
                                            <li class="para">Drive motor vehicles to reach work areas without incidents
                                                and/or accidents</li>
                                            <li class="para">Contact relevant authorities in the event of motor vehicle
                                                incidents and/or accidents</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="ts-detail-card">
                                <div class="header">
                                    <p class="m-0">Assigned Job Descriptions (JDs)</p>
                                </div>
                                <div class="inner-content">
                                    <ul class="nav nav-pills mb-7 w-100" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-JDs-level-6-1-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-JDs-level-6-1"
                                                type="button" role="tab" aria-controls="pills-JDs-level-6-1"
                                                aria-selected="true">Level 1 <iconify-icon icon="material-symbols:star"
                                                    class="star-active" width="16"
                                                    height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-6-2-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-JDs-level-6-2"
                                                type="button" role="tab" aria-controls="pills-JDs-level-6-2"
                                                aria-selected="false">Level
                                                2 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-6-3-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-JDs-level-6-3"
                                                type="button" role="tab" aria-controls="pills-JDs-level-6-3"
                                                aria-selected="false">Level
                                                3 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-6-4-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-JDs-level-6-4"
                                                type="button" role="tab" aria-controls="pills-JDs-level-6-4"
                                                aria-selected="false">Level
                                                4 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-JDs-level-6-5-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-JDs-level-6-5"
                                                type="button" role="tab" aria-controls="pills-JDs-level-6-5"
                                                aria-selected="false">Level
                                                5 <iconify-icon icon="material-symbols:star" class="star-active"
                                                    width="16" height="16"></iconify-icon></button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-JDs-level-6-1"
                                            role="tabpanel" aria-labelledby="pills-JDs-level-6-1-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>



                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-6-2" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-6-2-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-6-3" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-6-3-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-6-4" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-6-4-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="pills-JDs-level-6-5" role="tabpanel"
                                            aria-labelledby="pills-JDs-level-6-5-tab" tabindex="0">
                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Audit Manager</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Audit Senior Manager/Audit Manager manages a
                                                    portfolio of
                                                    engagements to
                                                    deliver high quality audit services. He/she also provides leadership on
                                                    audit
                                                    engagements which includes client acceptance process, engagement
                                                    planning,
                                                    execution and finalisation of an audit engagement. He is fully
                                                    accountable for
                                                    the audit... <span class="see-more-btn">see more</span></p>
                                            </div>

                                            <div class="mb-5">
                                                <p class="m-0 para"><b>Turnaround Coordinator</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <div class="mb-8">
                                                <p class="m-0 para"><b>Manager Crew Operation</b> <iconify-icon
                                                        icon="solar:ranking-outline" width="16" height="16"
                                                        style="color: #F7941C;"></iconify-icon> 1
                                                </p>
                                                <p class="para">The Manager, Crew Operations at AirAsia serves as the
                                                    Subject
                                                    Matter Expert (SME) for crew operations, overseeing all activities
                                                    related to
                                                    crew management and operational efficiency. This role drives continuous
                                                    improvement initiatives to enhance productivity and operational
                                                    standards while
                                                    contributing to business development efforts... <span
                                                        class="see-more-btn">see
                                                        more</span></p>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">&laquo;</a>
                                                    </li>
                                                    <li class="page-item active-custom">
                                                        <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </nav>
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

    <script>
        function toggleText(el) {
            const para = el.closest('.para');
            para.classList.toggle('expanded');
            el.textContent = para.classList.contains('expanded') ? 'see less' : 'see more';
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function resetModalState() {
                const modal = document.getElementById('editTechnicalSkill');
                const radios = modal.querySelectorAll('input[name="jdOption"]');
                const proceedBtn = modal.querySelector('.orange-fill-popup');
                const disabledBtn = modal.querySelector('.disable-grey-popup');

                radios.forEach(radio => radio.checked = false);
                proceedBtn.disabled = true;
                proceedBtn.style.display = 'none';
                disabledBtn.style.display = 'block';
            }

            function setupRadioListeners() {
                const modal = document.getElementById('editTechnicalSkill');
                const radios = modal.querySelectorAll('input[name="jdOption"]');
                const proceedBtn = modal.querySelector('.orange-fill-popup');
                const disabledBtn = modal.querySelector('.disable-grey-popup');

                radios.forEach(radio => {
                    radio.addEventListener('change', () => {
                        proceedBtn.disabled = false;
                        proceedBtn.style.display = 'block';
                        disabledBtn.style.display = 'none';
                    });
                });
            }

            const modalEl = document.getElementById('editTechnicalSkill');
            modalEl.addEventListener('shown.bs.modal', () => {
                resetModalState();
                setupRadioListeners();
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                resetModalState();
            });
        });
    </script>


@endsection
