@extends('admin.layout.app')

@section('title', 'Skills Master List')
@section('styles')
    <style>
        .user {
            display: flex;
            align-items: center;
        }

        /* Breadcrumb-skill */

        .breadcrumb-skill {
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 8px 186px 9.75px 186px;
            background: #fff;
        }

        .heading-bread {
            color: #071437;
            font-size: 17.55px;
            font-weight: 700;
            margin: 0;
        }

        .desc-bread {
            color: #99a1b7;
            font-size: 12.35px;
            margin-top: 3.25px;
            font-weight: 400;
            margin-bottom: 0px;
        }

        .main-master-list {
            margin: 61px 30px 0px 30px;
            padding: 48.75px;
            border-radius: 8.13px;
            background: #fff;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .top-heading {
            color: #071437;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.25px;
            border-bottom: 1px solid #dbdfe9;
            padding-bottom: 32px;
        }

        .master-list-inner {
            padding-top: 32px;
            display: grid;
            grid-template-columns: 18.1% 77.5%;
            gap: 65px;
        }

        /* master inner left side */

        .inner-left {
            display: flex;
            flex-direction: column;
            gap: 23px;
        }

        .inner-left-top {
            color: #000;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 700;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin: 0;
        }


        .jd-search-bar {
            display: flex;
            gap: 3.25px;
        }

        .jd-search-bar input {
            padding: 10.075px 13px;
            border-radius: 6px;
            border: 1px solid #dbdfe9;
            background: #fff;
            width: 209.31px;
        }

        .search-button {
            display: flex;
            padding: 11.075px 20.5px;
            align-items: center;
            gap: 10px;
            border: none;
            border-radius: 6px;
            background: #f7941c;
        }

        .search-button-icon {
            font-size: 21px;
        }

        .list-div ul {
        padding-left: 0px;
        }

        .list-div ul li {
            padding: 9.75px 13px;
            border-bottom: 1px solid #f3f3f3;
            list-style: none;
        }

        .list-div ul li:hover,
        .list-div ul li:first-child {
            border-radius: 6.8px;
            background: rgba(247, 149, 29, 0.15);
        }

        /* master inner right side */

        .right-heading {
            color: #000;
            font-size: 26px;
            font-style: normal;
            font-weight: 700;
            line-height: 40px;
            margin-bottom: 20px;
        }

        .top-filter {
            display: flex;
            gap: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f1f4;
            margin-bottom: 16px;
        }

        .bottom-left-filter div:first-child {
            background: #f7941c;
            color: #fff;
            font-weight: 700;
        }

        .search-right-icon {
            font-size: 16px;
        }

        .tab-button {
            display: flex;
            padding: 8.46px 13px;
            justify-content: center;
            align-items: center;
            gap: 6px;
            border-radius: 6.8px;
            color: #4b5675;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            border-radius: 6.8px;
            background: #f1f1f4;
            cursor: pointer;
        }

        .tab-button p {
            margin: 0;
        }

        .bottom-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .bottom-left-filter {
            display: flex;
            gap: 16px;
        }

        .title-found {
            color: #4b5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            margin-bottom: 18px;
        }

        .title-tab {
            display: flex;
            align-items: center;
        }

        .title-head {
            display: grid;
            grid-template-columns: 31.05% 48% 16.7%;
            padding: 16px;
            align-items: center;
            gap: 24px;
            border-radius: 8px 8px 0px 0px;
            border-bottom: 1px solid #f3f3f3;
            background: #fafafb;
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 98.462% letter-spacing: 0.5px;
        }

        .tab-star-color {
            color: #F3AC60;
        }

        .tab-star ul,
        .tab-star ul li {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 0px;
        }

        .right-title-info {
            display: grid;
            grid-template-columns: 33% 46% 16.5%;
            padding: 16px;
            align-items: center;
            border-right: 1px solid #f1f1f4;
            border-bottom: 1px solid #f1f1f4;
            border-left: 1px solid #f1f1f4;
            gap: 24px;
        }

        .action-btn {
            display: flex;
            padding: 4px 12px;
            align-items: center;
            gap: 4px;
            border-radius: 6.8px;
            border: 1px solid #99a1b7;
            background: #fff;
            color: #99a1b7;
            font-size: 12px;
            font-style: normal;
            font-weight: 700;
            line-height: 16px;
            letter-spacing: 0.5px;
            width: fit-content;
            cursor: pointer;
        }

        .bottom-right-filter {
            display: flex;
            height: 36px;
            padding: 0px 12px;
            align-items: center;
            gap: 6px;
            border-radius: 4px;
            border: 1px solid #dbdfe9;
            background: #fff;
            width: 281px;
        }

        .bottom-right-filter input {
            display: flex;
            outline: none;
            border: none;
            height: 16px;
            padding-right: 38.43px;
            align-items: center;
            flex: 1 0 0;
        }

        .bottom-right-filter button {
            border: none;
            background: none;
            padding: 0;
            margin-top: 10px;
        }

        .title-line {
            display: flex;
            align-items: center;
            width: fit-content;
            border-radius: 3.4px;
        }

        .title-line span:first-child {
            border-radius: 3.4px 0px 0px 3.4px;
        }

        .title-line span:last-child {
            border-radius: 0px 3.4px 3.4px 0px;
        }

        .title-line span {
            width: 92px;
            height: 12px;
            background: #f7941c;
        }

        /* Overlay | Skills Levels */

        .close-header {
            display: flex;
            padding: 22.75px;
            justify-content: space-between;
            align-items: center;
            border-radius: 8.134px 8.134px 0px 0px;
            border-bottom: 1px solid #f1f1f4;
            background: #fff;
        }

        .close-header p {
            color: #000;
            font-size: 17.55px;
            font-weight: 700;
        }

        .view-main {
            display: flex;
            padding: 22.75px;
            justify-content: space-between;
            align-items: center;
            border-radius: 8.13px;
            background: #fff;
        }

        .view-inner-div {
            display: grid;
            grid-template-columns: 49% 49%;
            gap: 17.88px;
            margin: auto;
            padding-bottom: 22.75px;
        }

        .inner-box {
            display: flex;
            padding: 1px;
            width: 525px;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 8.13px;
            border: 1px solid rgba(153, 161, 183, 0.3);
            background: #fff;
        }

        .eye-icon {
            font-size: 14px;
        }

        .box-header {
            display: flex;
            height: 69px;
            padding: 0px 29.25px;
            gap: 5px;
            align-items: center;
            align-self: stretch;
            border-bottom: 1px solid rgba(153, 161, 183, 0.3);
            color: #071437;
            font-size: 16.575px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .box-content-div {
            padding: 26px 29.25px;
            height: 524.75px;
        }

        .box-p {
            color: #000;
            font-size: 14.95px;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin: 0px;
        }

        .icon-desc {
            margin: 16.25px 0px 20px 0px;
        }

        .icon-desc>p {
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 20px;
            letter-spacing: 0.1px;
            margin: 0px;
        }

        .icon-content {
            margin-top: 13px;
        }

        .icon-text {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6.5px;
        }

        .icon-text-check {
            display: flex;
            align-items: center;
            border-radius: 100px;
            color: #F7941D;
            padding: 4px;
            font-size: 18px;
            background: #FFF6EA;
        }

        .icon-text p {
            color: #4b5675;
            font-size: 13px;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin: 0px;
        }

        /* Skill View Tab */

        .tab-main {
            margin: 0px 187px 68px 187px;
        }

        .tabs-star-head {
            border-bottom: 1px solid #dbdfe9;
            margin-bottom: 16px;
        }

        .tabs-star-head ul {
            display: flex;
            justify-content: flex-start;
            margin-top: 16px;
        }

        .tabs-star-head ul li {
            display: flex;
            padding: 12px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #99a1b7;
            font-size: 17.55px;
            font-weight: 400;
            line-height: 23.4px;
        }

        .tabs-star-head ul li.active {
            border-bottom: 3px solid #f7941c;
            color: #000;
            font-weight: 500;
            line-height: 21.06px;
        }

        .tabs-desc.active {
            display: block;
        }

        .tabs-desc {
            display: none;
        }

        .tab-header {
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #f1f1f4;
            background: #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            padding: 24px;
        }

        .tab-content {
            border-radius: 0px 0px 8px 8px;
            border-width: 0px 1px 1px 1px;
            border-color: #f1f1f4;
            border-style: solid;
            background: #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 24px;
            display: grid;
            gap: 24px;
        }

        .tab-desc-inner ul {
            padding-left: 26px;
        }

        .tab-desc-inner ul li {
            list-style: disc;
        }

        .inner-desc-p,
        .tab-desc-inner ul li {
            color: #3e3e3e;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .tab-desc-inner>p {
            color: #3e3e3e;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .modal-title {
            color: #000;
            font-size: 17.55px;
            font-weight: 700;
            line-height: normal;
        }
        .tab-content-tabs {
    display: none;
}

.tab-content-tabs.active {
    display: block;
}

.tab-button.active {
            background: #f7941c;
            color: #fff;
            font-weight: 700;
}

.app-header {
                border-bottom: 1px dashed #DBDFE9;
}

.app-container {
padding-left: 0px !important;
        padding-right: 0px !important;
}

.app-wrapper {
margin-top: 75px !important;
}

.flex-root {
background-color: #FAFAFB
}
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="breadcrumb-skill">
            <p class="heading-bread">Skills Management</p>
            <p class="desc-bread">Home - Skills Master List - Air Transport</p>
        </div>
        <div class="main-master-list">
            <p class="top-heading">Air Transport</p>
            <div class="master-list-inner">
                <div class="inner-left">
                    <p class="inner-left-top">TSC Categories</p>
                    <div class="jd-search-bar">
                        <input type="text" placeholder="Search for categories... " />
                        <button class="search-button">
                            <iconify-icon icon="icon-park-outline:search" class="search-button-icon"></iconify-icon>
                        </button>

                    </div>
                    <div class="list-div">
                        <ul>
                            <li>Aircraft Operations</li>
                            <li>Airline Operations</li>
                            <li>Airport Engineering</li>
                            <li>Airport Operations</li>
                            <li>Airside Operations</li>
                            <li>Business Management</li>
                        </ul>
                    </div>
                </div>
                <div class="inner-right">
                    <p class="right-heading">
                        Aircraft Operations
                    </p>
                    <div class="top-filter">
                        <div class="tab-button" onclick="showTabContent('tab1')">
                            <iconify-icon icon="ep:arrow-right-bold" style="font-size: 12px;"></iconify-icon>
                            <p>By TSC Title</p>
                        </div>
                        <div class="tab-button" onclick="showTabContent('tab2')">
                            <iconify-icon icon="ep:arrow-right-bold" style="font-size: 12px;"></iconify-icon>
                            <p>By Proficiency Level</p>
                        </div>
                    </div>
                    <div id="tab1" class="tab-content-tabs active">
                        <div class="bottom-filter">
                            <div class="bottom-left-filter">
                                <div class="tab-button">
                                    <p>All</p>
                                </div>
                                <div class="tab-button">
                                    <p>A</p>
                                </div>
                                <div class="tab-button">
                                    <p>F</p>
                                </div>
                                <div class="tab-button">
                                    <p>P</p>
                                </div>
                            </div>
                            <div class="bottom-right-filter">
                                <button>
                                    <iconify-icon icon="bx:search" class="search-right-icon"></iconify-icon>
                                </button>
                                <input type="text" placeholder="Search skill by title" />
                            </div>
                        </div>
                        <p class="title-found">10 TSC titles found.</p>
                        <div class="right-titles-list">
                            <div class="title-head">
                                <div class="title-tab">TSC Title<iconify-icon icon="iconamoon:arrow-down-2"
                                        style="font-size: 20px"></iconify-icon>
                                </div>
                                <div class="tab-star">
                                    <ul>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 1
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 2
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 3
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 4
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 5
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 6
                                        </li>
                                    </ul>
                                </div>
                                <div class="action">Actions</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Cruise Operations</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Dispatch</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Emergency Management</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Landing Operations</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Manual Handling</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Performance Management</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Take-Off Operations</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Flight Deck Communications</div>
                                <div class="title-line">
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Pre-Flight Preparation</div>
                                <div class="title-line">
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-content-tabs">
                        <div class="bottom-filter">
                            <div class="bottom-left-filter">
                                <div class="tab-button">
                                    <p>All</p>
                                </div>
                                <div class="tab-button">
                                    <p>1</p>
                                </div>
                                <div class="tab-button">
                                    <p>2</p>
                                </div>
                                <div class="tab-button">
                                    <p>3</p>
                                </div>
                                <div class="tab-button">
                                    <p>4</p>
                                </div>
                                <div class="tab-button">
                                    <p>5</p>
                                </div>
                                <div class="tab-button">
                                    <p>6</p>
                                </div>
                            </div>
                            <div class="bottom-right-filter">
                                <button>
                                    <iconify-icon icon="bx:search" class="search-right-icon"></iconify-icon>
                                </button>
                                <input type="text" placeholder="Search skill by title" />
                            </div>
                        </div>
                        <p class="title-found">10 TSC titles found.</p>
                        <div class="right-titles-list">
                            <div class="title-head">
                                <div class="title-tab">TSC Title<iconify-icon icon="iconamoon:arrow-down-2"
                                        style="font-size: 20px"></iconify-icon>
                                </div>
                                <div class="tab-star">
                                    <ul>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 1
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 2
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 3
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 4
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 5
                                        </li>
                                        <li><iconify-icon icon="material-symbols:star"
                                                class="tab-star-color"></iconify-icon> 6
                                        </li>
                                    </ul>
                                </div>
                                <div class="action">Actions</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Cruise Operations</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Dispatch</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Emergency Management</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Landing Operations</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Manual Handling</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Performance Management</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Aircraft Take-Off Operations</div>
                                <div class="title-line">
                                    <span></span>
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Flight Deck Communications</div>
                                <div class="title-line">
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                            <div class="right-title-info">
                                <div class="title-left">Pre-Flight Preparation</div>
                                <div class="title-line">
                                    <span></span>
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#viewModal" class="action-btn"><iconify-icon
                                        icon="mdi:eye" class="eye-icon"></iconify-icon> View</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal bg-body fade" tabindex="-1" id="viewModal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Aircraft Cruise Operations</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">

                        <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="view-main">
                        <div class="view-inner-div">
                            <div class="inner-box">
                                <div class="box-header">
                                    Level 4 <iconify-icon icon="material-symbols:star"
                                        class="tab-star-color"></iconify-icon>
                                </div>
                                <div class="box-content-div">
                                    <p class="box-p">Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                    <div class="icon-desc">
                                        <p>Knowledge</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icon-desc">
                                        <p>Ability</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Input journal entries, transactions and events relating to sales</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse lectus
                                                    fusce non
                                                    platea justo dictumst.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-box">
                                <div class="box-header">
                                    Level 5 <iconify-icon icon="material-symbols:star"
                                        class="tab-star-color"></iconify-icon>
                                </div>
                                <div class="box-content-div">
                                    <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                    <div class="icon-desc">
                                        <p>Knowledge</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icon-desc">
                                        <p>Ability</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse lectus fusce non platea justo dictumst.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse lectus
                                                    fusce non
                                                    platea justo dictumst.</p>
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
@section('scripts')
    <script>
        const tabButtons = document.querySelectorAll(".tabs-star-head ul li");
        const tabContents = document.querySelectorAll(".tabs-desc");

        tabButtons.forEach((button) => {
            button.addEventListener("click", () => {
                tabButtons.forEach((btn) => btn.classList.remove("active"));
                button.classList.add("active");

                tabContents.forEach((content) => content.classList.remove("active"));
                const tabId = button.getAttribute("data-tab");
                document.getElementById(tabId).classList.add("active");

                tabButtons.forEach((btn) => {
                    const img = btn.querySelector("img");
                    if (img) {
                        img.src = btn.classList.contains("active") ?
                            "{{ asset('admin/media/skill-management/star.svg') }}" :
                            "admin/media/skill-management/star-grey.svg";
                    }
                });
            });
        });
    </script>
    <script>
    function showTabContent(tabId) {
    // Remove active class from all tab contents
    document.querySelectorAll('.tab-content-tabs').forEach((content) => {
        content.classList.remove('active');
    });

    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach((button) => {
        button.classList.remove('active');
    });

    // Add active class to the selected tab content
    document.getElementById(tabId).classList.add('active');

    // Add active class to the corresponding tab button
    const tabButtons = document.querySelectorAll('.tab-button');
    if (tabId === 'tab1') {
        tabButtons[0].classList.add('active');
    } else if (tabId === 'tab2') {
        tabButtons[1].classList.add('active');
    }
}

// Show the first tab by default
showTabContent('tab1');

    </script>
@endsection
