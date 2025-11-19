@extends('admin.layout.app')

@section('title', 'All Candidates List')

@section('styles')
    <style>
        @keyframes moving {
            from { transform: translateX(50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }


        /* Font Styles */
        .frame-title {
            color: var(--font-text-primary, #071437);
            text-align: left;
            font-family: var(--display-display-6-bold-font-family, "Inter-Bold", sans-serif);
            font-size: 2rem;
            line-height: 2.5rem;
            font-weight: 700;
        }

        .title, .title2 {
            text-align: center;
            font-family: var(--label-medium-medium-font-family, "Inter-Medium", sans-serif);
            font-size: 12px;
            line-height: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .title {
            color: var(--shade-white, #ffffff);
        }

        .title2 {
            color: var(--orange-500-p, #f7951d);
        }

        .highest-job-position-level, .number-job-position, .user-dept, .user-location, .user-position {
            color: var(--font-text-tertiary, #99a1b7);
            text-align: left;
            font-family: var(--subheading-subheading-6-regular-font-family, "Inter-Regular", sans-serif);
            font-size: 14.5px;
            line-height: 20.96px;
            font-weight: 500;
            position: relative;
        }

        .user-dept, .user-location {
            font-family: var(--heading-h6-medium-font-family, "Inter-Medium", sans-serif);
            font-size: var(--heading-h6-medium-font-size, 13.975px);
            line-height: var(--heading-h6-medium-line-height, 16.77px);
            font-weight: var(--heading-h6-medium-font-weight, 500);
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 5px;
        }

        .user-dept p {
            margin: 0px !important;
        }

        .user-dept > i {
            font-size: 18px;
        }

        .user-location > i {
            font-size: 18px;
        }

        .user-location p {
            margin: 0px !important;
        }

        .total-value-highest-job-data {
            color: var(--teal-teal-80, #108585);
            font-family: var(--label-small-semi-bold-font-family, "Inter-SemiBold", sans-serif);
            font-size: 11px;
            line-height: 14px;
            font-weight: 600;
        }

        .total-value-number-job-position {
            color: var(--purple-purple-80, #6652A1);
            font-family: var(--label-small-semi-bold-font-family, "Inter-SemiBold", sans-serif);
            font-size: 11px;
            line-height: 14px;
            font-weight: 600;
        }

        /* Container Styles */
        .main-frame {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
        }

        .top-data, .user-status-data, .frame-7, .frame-8, .frame-9, .workforce-data, .button-frame, .position-overview, .highest-job-data, .number-job-position-data {
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: center;
            position: relative;
        }

        .top-data {
            justify-content: space-between;
            width: 100%;
        }

        .workforce-data, .button-frame, .position-overview, .highest-job-data, .number-job-position-data {
            align-items: flex-start;
        }

        .position-overview {
            gap: 16px;
        }

        .highest-job-data, .number-job-position-data {
            gap: 4px;
        }

        .head-total, .employee-total, .vacancy-total, .total-highest-job-data, .total-number-job-position {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            padding: 5px 10px;
            position: relative;
        }

        .head-total {
            background: var(--primary-orange-50, #f9a845);
            padding: 4.23px 6.5px;
            border-radius: 3.4px;
        }

        .employee-total, .vacancy-total {
            background: var(--primary-orange-10, #fff6ea);
            padding: 4.23px 6.5px;
            border-radius: 3.4px;
        }

        .total-highest-job-data {
            background: var(--teal-teal-10, #E2F6F6);
        }

        .total-number-job-position {
            background: var(--purple-purple-10, #F2EEFD);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
        .top-data, .workforce-data, .button-frame, .position-overview {
            flex-direction: column;
            align-items: flex-start;
        }

        .head-total, .employee-total, .vacancy-total {
            width: 100%;
            margin-bottom: 10px;
        }

        .highest-job-data, .number-job-position-data {
            flex-direction: column;
            width: 100%;
        }

        .nav-bar {
            flex-direction: column;
            gap: 10px;
        }

        .nav-bar > div {
            font-size: 10px;
        }
        }

        @media (max-width: 480px) {
        .main-frame {
            padding: 10px;
        }

        .frame-title {
            font-size: 1.5rem;
            line-height: 2rem;
        }

        .position-overview {
            gap: 10px;
        }
        }

        .nav-bar {
            display: flex;
            gap: 36px;
            color: var(--font-text-tertiary, #99a1b7);
            margin-top: 20px;
            position: relative;
        }

        .nav-bar > div {
            font-family: var(--subheading-subheading-6-regular-font-family, "Inter-Regular", sans-serif);
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }
        .nav-bar > div.active {
            color: #f9a845;
        }

        .nav-bar-line {
            position: absolute;
            top: 30px;
            left: -2px;
            width: 62px;
            height: 2px;
            background-color: #f9a845;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        @media (max-width: 1300px) {
            .nav-bar-line {
                top: 45px !important;
                width: 50px;
            }
        }


        .overview-title { 
            display: flex; 
            flex-direction: row; 
            width: 100%; 
            justify-content: space-between;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 10px; 
        }
        .calendar-filter { 
            margin-left: 20px;
            background: #fff; cursor: pointer; 
            padding: 5px 10px; 
            width: 307px; 
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 10px;
            color: var(--font-text-tertiary, #99a1b7);
        }

        .overview-data{
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            color: var(--font-text-tertiary, #99a1b7);
            gap: 20px;
        }

        .overview-data > div > h1{
            font-size: 35px
        }

        .overview-chart{
            display: flex;
            margin-top: 60px;
            justify-content: space-between;
        }

        .apexcharts-legend { 
            display: flex; 
            flex-direction: column;
        }

        .apexcharts-legend-marker {
            margin-right: 10px !important;
        }
        .apexcharts-legend-series{
            display: flex !important;
            align-items: center !important;
        }

        .bar-gender > h1{
            margin-left: 15px;
            margin-bottom: 15px;
        }

        .location-data{
            width: 600px;
        }

        .employment-status > h2 {
            width: 600px;
            margin-bottom: 20px;
        }

        .city-list{
            margin-top: 50px;
            cursor: pointer;
        }

        .city-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #98a0ba !important;
        }
        .city-item:last-child {
            border-bottom: none;
        }
        .city-info {
            display: flex;
            align-items: center;
        }

        .location {
            color: var(--font-text-tertiary, #808698);
            font-weight: bold;
        }

        .total-user-location-value{
            color: var(--font-text-tertiary, #99a1b7);
        }

        .position-employment-data{
            display: flex;
            margin-top: 60px;
            justify-content: space-between;
        }

        .position-level-top-bar{
            display: flex;
            justify-content: space-between;
        }

        .position-level-top-bar > a {
            color:#F7941C !important;
            font-weight: 300;
            font-size: 12px;
            margin-top: 10px;
            margin-left: 15px;
        }

        .position-level-top-bar > h2 {
            color:#252F4A;
        }
        /* Legend Item Styles */
        .legend-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .legend-item span.label {
            flex: 1;
            min-width: 80px;
            text-align: left;
        }
        .legend-item span.value {
            text-align: right;
        }

        .age-legend-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }
        .age-legend-item span.label {
            flex: 1;
            min-width: 80px;
            text-align: left;
        }
        .age-legend-item span.value {
            text-align: right;
            width: 20px;
        }

        .legend-item i {
            margin-left: 5px;
        }

        .employee-content {
            padding-top: 40px;
            position: relative;
        }

        .employee-directory-nav-bar{
            display: flex;
            gap: 30px;
            font-size: 15px;
        }

        .employee-directory-title {
            margin-bottom: 30px;
            font-size: 35px;
        }

        .tab-content {
            width: 100%;
        }

        .tab-content-data .tab-content {
            display: none;
            animation: moving .5s ease;
        }

        .tab-content-data .tab-content.active {
            display: block;
        }

        .employee-content {
            background: #ffffff;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); 
            border-radius: 8px; 
            padding: 40px 50px;
            height: auto;
        }

        .line {
            position: absolute;
            top: 30px;
            left: -2px;
            width: 62px;
            height: 2px;
            background-color: #f9a845;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .overview-title {
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: space-between;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 10px;
        }

        .calendar-filter {
            margin-left: 20px;
            background: #fff;
            cursor: pointer;
            padding: 5px 10px;
            width: 307px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 10px;
            color: var(--font-text-tertiary, #99a1b7);
        }

        .overview-data {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            color: var(--font-text-tertiary, #99a1b7);
        }

        .overview-data > div > h1 {
            font-size: 35px;
        }

        .overview-chart {
            display: flex;
            margin-top: 60px;
            justify-content: space-between;
        }

        .apexcharts-legend {
            display: flex;
            flex-direction: column;
        }

        .apexcharts-legend-marker {
            margin-right: 10px !important;
        }

        .apexcharts-legend-series {
            display: flex !important;
            align-items: center !important;
        }

        .bar-gender > h1 {
            margin-left: 15px;
            margin-bottom: 15px;
        }

        .location-data {
            width: 600px;
        }

        .employment-status > h2 {
            width: 400px;
            margin-bottom: 20px;
        }

        .city-list {
            margin-top: 50px;
            cursor: pointer;
        }

        .city-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .city-item:last-child {
            border-bottom: none;
        }

        .city-info {
            display: flex;
            align-items: center;
        }

        .location {
            color: var(--font-text-tertiary, #808698);
            font-weight: bold;
        }

        .total-user-location-value {
            color: var(--font-text-tertiary, #99a1b7);
        }

        .position-employment-data {
            display: flex;
            margin-top: 60px;
            justify-content: space-between;
            flex-direction: column;
        }

        .position-level-top-bar {
            display: flex;
            justify-content: space-between;
        }

        .position-level-top-bar > a {
            color: #F7941C !important;
            font-weight: 300;
            font-size: 12px;
        }

        .position-level-top-bar > h2 {
            color: #252F4A;
        }

        .employee-directory-nav-bar{
            color: var(--font-text-tertiary, #99a1b7);
        }

        .employee-directory-nav-bar > div {
            font-family: var(--subheading-subheading-6-regular-font-family, "Inter-Regular", sans-serif);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        .employee-directory-nav-bar > div.active {
            color: #f9a845;
        }

        .employee-nav-line{
            position: absolute;
            top: 65px;
            left: 0;
            width: 65px;
            height: 2px;
            background-color: #f9a845;
            border-radius: 10px;
            transition: all .3s ease-in-out;
        }

        .employee-directory-content {
            display: none;;
        }

        .employee-directory-content.active {
            display: block;
            animation: moving .5s ease;
        }

        .employee-directory-filter-bar{
            display: flex;
            margin-bottom: 30px;
        }

        .employee-directory-content > h1 {
            font-weight: 500;
            color: #252F4A;
        }

        .profile {
            display: flex;
            align-items: center;
            position: relative;
        }

        .profile-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 20px;
            align-self: center;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
        }

        .profile-name{
            display: flex;
            flex-direction: row;
            font-size: 13px;
            font-weight: 400;
            color: #252F4A;
            font-weight: 500;
            gap: 10px;
            max-width: 210px;
        }

        .profile-title{
            margin-top: 2px;
            margin-bottom: 15px;
            font-size: 11px;
            color: #78829D;
        }

        .profile-email{
            font-size: 10px;
            color: #99A1B7;
        }

        .profile-container { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
            grid-gap: 20px; 
            margin: 30px 0px;
            padding: 10px;
            
        }

        .profile-container .profile {
            display: flex;
            gap: 10px;
        }

        #person-icon {
            display: none;
        }

        .psychometric-main-content {
            padding-top: 40px;
            position: relative;
        }

        .psychometric-content {
            display: none;
        }

        .psychometric-nav-bar{
            display: flex;
            gap: 30px;
            font-size: 15px;
        }

        .psychometric-nav-bar{
            color: var(--font-text-tertiary, #99a1b7);
        }

        .psychometric-nav-bar > div {
            font-family: var(--subheading-subheading-6-regular-font-family, "Inter-Regular", sans-serif);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        .psychometric-nav-bar > div.active {
            color: #f9a845;
        }

        .psychometric-nav-line {
            position: absolute;
            top: 65px;
            left: 0;
            width: 135px;
            height: 2px;
            background-color: #f9a845;
            border-radius: 10px;
            transition: all .3s ease-in-out;
        }

        .psychometric-content.active {
            display: block;
            animation: moving .5s ease;
        }

        .psychometric-title {
            font-size: 35px;
            font-weight: 500;
            color: #252F4A;
        }

        .psychometric-nav-content-box{
            margin: 30px 0px;
        }

        .psychometric-content-first-tab {
            display: flex;
            justify-content: space-between;
        }

        i.bi-download {
            margin-right: 10px;
            color: #F7941C;
            text-shadow: 0.5px 0.5px 0 #F7941C, -0.5px -0.5px 0 #F7941C, 0.5px -0.5px 0 #F7941C, -0.5px 0.5px 0 #F7941C; /* Create bold effect */
        }

        .aggregated-report-download-btn{
            color: #F7941C;
            font-weight: 600;
            padding: 0px 15px;
            border-color: #F7941C;
            border-style: solid;
            border-width: 1px;
            border-radius: 5px;
            background: none;
        }

        .aggregated-department-graph-container { 
            display: grid; 
            grid-template-columns: repeat(2, 1fr); /* This sets 2 columns per row */
            grid-gap: 40px 20px; 
            margin: 60px 0px;
        }

        .aggregated-department-graph-container h2 {
            margin-bottom: 30px;
            color: #252F4A;
        }

        #overall-match-rate-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right, #lp-chart, #gp-chart, .apexcharts-legend.apexcharts-align-center.apx-legend-position-right, #ssmr-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right, #assessment-completion-status-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right, #technical-assessment-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right,  #behavioral-fit-rate-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right,#technical-skill-match-rate-chart , #job-match-rate-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right, #workplace-alignment-forecast-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right, #flight-risk-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right, #cognitive-ability-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right { 
            display: flex; 
            justify-content: center;
            height: fit-content;
            gap: 10px;
        }


        .allstar-value-content{
            display: grid; 
            grid-template-columns: repeat(4, 1fr); /* This sets 2 columns per row */
            grid-gap: 50px 20px; 
            margin: 60px 0px;
        }

        .allstar-value-content h3 {
            font-weight: 400;
            font-size: 18px;
            color: #4B5675;
            margin-bottom: 35px;
        }

        #allstar-safety-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .legend-item {
            display: flex;
            justify-content: space-between;
            width: 200px; /* Adjust the width as needed */
        }

        .label {
            display: flex;
            align-items: center;
        }

        .value {
            display: flex;
            align-items: center;
        }

        #allstar-celebrate-all-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        #allstar-be-transparent-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        #allstar-make-a-difference-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #allstar-keep-simple-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #allstar-all-for-one-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #allstar-have-empathy-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #allstar-dare-to-dream-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .allstar-safety{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .allstar-have-empathy{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .allstar-celebrate-all-individuals{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .allstar-be-transparent{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .allstar-make-a-difference{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .allstar-keep-it-simple{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .allstar-all-for-one{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .allstar-dare-to-dream{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .search {
            width: 100%;
            position: relative;
            display: flex;
        }

        .searchTerm {
            width: 100%;
            border: 3px solid #DBDFE9;
            border-right: none;
            padding: 5px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
        }

        .searchTerm:focus{
            color: #F7941C;
        }
        
        .searchButton {
            width: 40px;
            height: 36px;
            border: 1px solid #F7941C;
            background: #F7941C;
            text-align: center;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 20px;
        }
        .wrap{
            width: 30%;
        }

        i.fa-search{
            color: white;
        }

        .psychometric-content-second-tab {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .psychometric-content-third-tab {
            display: flex;
            justify-content: space-between;
            margin-bottom: 70px;
        }

        .potential-dashboard-content{
            display: flex;
            flex-direction: row;
            gap: 70px;
        }

        .employee-filter-data {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .employee-filter-data-first-column{
            display: flex;
            flex-direction: column;
        }

        .employee-filter-data-container {
            display: grid; 
            grid-template-columns: repeat(2, 1fr); /* This sets 2 columns per row */
            grid-gap: 50px 20px; 
            margin: 40px 0px;
        }

        .title-color-label {
            width: 23px;
            height: 23px;
            border-radius: 50%;
            margin-right: 10px;
            align-self: center;
            margin-bottom: 4px;
        }

        .column-title{
            display: flex;
            flex-direction: row;
        }

        .employee-filter-data-first-column h2 {
            font-size: 30px;
        }

        .grid-filter{
            display: flex;
            flex-direction: column;
            width: 350px;
        }

        .filter-title {
            display: flex;
            flex-direction: row;
            width: 100%;    
            justify-content: space-between;
        }

        .filter-title > p {
            color:#F7941C !important;
            font-weight: 300;
            font-size: 12px;
            cursor: pointer;
        }

        .color-filter-container{
            display: grid; 
            grid-template-columns: repeat(3, 1fr);
            margin-top: 30px;
            gap: 10px;
            width: 350px;
        }

        .filter-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .psychometric-sub-department-filter {
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #DBDFE9;
            color: #99A1B7;
            -webkit-appearance: none; /* Remove default arrow for Safari */
            -moz-appearance: none; /* Remove default arrow for Firefox */
            background-image: url('data:image/svg+xml;utf8,<svg fill="%2399A1B7" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>'); /* Custom arrow */
            background-repeat: no-repeat;
            background-position: right 10px center; /* Position the arrow */
            padding-right: 30px;
        }

        .filter-color-label{
            width: 100%;
            height: 50px;
            border-radius: 5px;
            align-self: center;
            margin-bottom: 4px;
            position: relative;
            cursor: pointer;
        }

        .filter-color-label:nth-child(1) { background-color: #F6E54B; /* Yellow */ }
        .filter-color-label:nth-child(2) { background-color: #7DC76F; /* Orange */ }
        .filter-color-label:nth-child(3) { background-color: #34792F; /* Pink */ }
        .filter-color-label:nth-child(4) { background-color: #F2B948; /* Purple */ }
        .filter-color-label:nth-child(5) { background-color: #F6E54B; /* Light Blue */ }
        .filter-color-label:nth-child(6) { background-color: #7DC76F; /* Light Green */ }
        .filter-color-label:nth-child(7) { background-color: #E66C6C; /* Lime */ }
        .filter-color-label:nth-child(8) { background-color: #F2B948; /* Red */ }
        .filter-color-label:nth-child(9) { background-color: #F6E54B; /* Dark Blue */ }

        .filter-color-label:hover .dialog-box {
            opacity: 1;
            pointer-events: initial;
            height: auto;
        }

        .filter-color-label:hover .dialog-box:before {
            opacity: 1;
            pointer-events: initial;
        }

        .dialog-box {
            background-color: #fff;
            width: 100px;
            height: auto;
            position: absolute;
            left: -30%;
            top: -70px; /* Adjust as needed */
            border-radius: 8px;
            box-shadow: 0 0 24px rgba(0, 0, 0, 0.5);
            pointer-events: none;
            opacity: 0;
            transition: 0.3s;
        }

        /* .dialog-box:before {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            left: 50%;
            top: 0; 
            border-radius: 0 4px 0 0;
            transform: translate(-50%, 50%) rotate(45deg);
            background-color: #fff;
            opacity: 0;
            pointer-events: none;
            box-shadow: 0 0 24px rgba(0, 0, 0, 0.5);
        } */

        .dropdown-menu-container {
            background-color: #fff;
            width: 150px;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .filter-on-off{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        @supports(-webkit-appearance: none) or (-moz-appearance: none) {
            input[type='checkbox'] {
                --active: #F7941C;
                --active-inner: #fff;
                --border: #BBC1E1;
                --border-hover: #F7941C;
                --background: #fff;
                --disabled: #F6F8FF;
                --disabled-inner: #E1E6F9;
                -webkit-appearance: none;
                -moz-appearance: none;
                height: 21px;
                outline: none;
                display: inline-block;
                vertical-align: top;
                position: relative;
                margin: 0;
                cursor: pointer;
                border: 1px solid var(--bc, var(--border));
                background: var(--b, var(--background));
                transition: background .3s, border-color .3s, box-shadow .2s;
            }
            input[type='checkbox']:after {
                content: '';
                display: block;
                left: 0;
                top: 0;
                position: absolute;
                transition: transform var(--d-t, .3s) var(--d-t-e, ease), opacity var(--d-o, .2s);
            }
            input[type='checkbox']:checked {
                --b: var(--active);
                --bc: var(--active);
                --d-o: .3s;
                --d-t: .6s;
                --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
            }
            input[type='checkbox']:disabled {
                --b: var(--disabled);
                cursor: not-allowed;
                opacity: .9;
            }
            input[type='checkbox']:disabled:checked {
                --b: var(--disabled-inner);
                --bc: var(--border);
            }
            input[type='checkbox'] + label {
                display: inline-block;
                vertical-align: top;
                cursor: pointer;
            }
            input[type='checkbox']:hover:not(:checked):not(:disabled) {
                --bc: var(--border-hover);
            }
            input[type='checkbox']:focus {
                box-shadow: 0 0 0 var(--focus);
            }
            input[type='checkbox']:not(.switch) {
                width: 21px;
                border-radius: 7px;
            }
            input[type='checkbox']:not(.switch):after {
                opacity: var(--o, 0);
                width: 5px;
                height: 9px;
                border: 2px solid var(--active-inner);
                border-top: 0;
                border-left: 0;
                left: 7px;
                top: 4px;
                transform: rotate(var(--r, 20deg));
            }
            input[type='checkbox']:checked:not(.switch):after {
                --o: 1;
                --r: 43deg;
            }
            input[type='checkbox'].switch {
                width: 38px;
                border-radius: 11px;
            }
            input[type='checkbox'].switch:after {
                left: 2px;
                top: 2px;
                border-radius: 50%;
                width: 15px;
                height: 15px;
                background: var(--ab, var(--border));
                transform: translateX(var(--x, 0));
            }
            input[type='checkbox'].switch:checked {
                --ab: var(--active-inner);
                --x: 17px;
            }
            input[type='checkbox'].switch:disabled:not(:checked):after {
                opacity: .6;
            }
        }
        
        .subDepartmentSearch {
            width: 100%;
            height: 40px;
            border: 3px solid #DBDFE9;
            padding: 5px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
            margin-top: 10px;
        }

        .checkbox-container {
            display: flex;
            flex-direction: column;
            gap: 10px; 
        }
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .position-level{
            margin-top: 20px;
        }

        .checkbox-item{
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .checkbox-item > label {
            margin-bottom: 0px !important;
        }

        .title-info {
            font-size: 20px !important;
        }

        .column-title-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .column-title {
            display: flex;
            justify-content: space-between;
        }

        .view-full-details-btn{
            color:#F7941C !important;
            font-weight: 300;
            font-size: 12px;
            cursor: pointer;
            margin-left: auto;
        }

        .profile-name-potential {
            width: 100px;
            height: 20px;
            border-radius: 10px;
            text-align: center;
            background-color: #DDF5E2;
            padding: 2px;
            font-size: 12px;
            color: #196329;
        }

        .employee-filter {
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: baseline;
        }

        .employee-wrap{
            width: 25%;
            display: flex;
            align-items: end;
        }

        .employee-search{
            width: 100%;
            position: relative;
            display: flex;
        }

        .employee-searchTerm {
            width: 100%;
            border: 2px solid #DBDFE9;
            border-right: none;
            padding: 10px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
        }

        .employee-searchTerm:focus{
            color: #F7941C;
        }
        
        .employee-searchButton {
            width: 40px;
            height: 43px;
            border: 1px solid #F7941C;
            background: #F7941C;
            text-align: center;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 20px;
        }

        .employee-filter > h4 {
            color: #78829D;
        }

        .sub-department-filter {
            position: relative;
            display: inline-block;
            margin-right: 30px;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 250px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            padding: 10px;
        }

        .dropdown-content label {
            display: inline-block;
            max-width: 200px; /* Adjust this value as needed */
            cursor: pointer;
            vertical-align: top;
        }

        .dropdown-content input[type="checkbox"] {
            vertical-align: top;
        }


        .dropdown-content .buttons {
            display: flex;
            justify-content: end;
            margin-top: 10px;
        }
        .dropdown-content .buttons button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .dropdown-content .buttons .filter-btn {
            background-color: orange;
            color: white;
            border-radius: 20px;
            padding: 0px 20px;
        }
        .sub-department-filter:hover .dropdown-content {
            display: block;
        }

        .dropdown-button {
            border: none;
            outline: none;
            background: none;
        }

        .dropdown-button-container {
            width: 200px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            border: 2px solid #DBDFE9;
            padding: 10px 15px;
            border-radius: 20px;
            outline: none;
            color: #252F4A;
        }

        .position-level {
            position: relative;
            display: inline-block;
        }

        .position-level:hover .dropdown-content {
            display: block;
        }

        .job-position {
            position: relative;
            display: inline-block;
        }

        .job-position:hover .dropdown-content {
            display: block;
        }

        .high-potential{
            display: flex;
            flex-direction: row;
            padding: 5px 5px;
            border-radius: 20px;
            outline: none;
            background: #DDF5E2;
            align-items: center;
            justify-content: center;
            width: 90px;
        }

        .container-name {
            display: flex;
            flex-direction: row;
            gap: 5px;
        }

        .high-potential > p {
            color: #218336;
            font-size: 10px;
            margin-bottom: 0px !important;
        }

        .user-status {
            display: flex;
            flex-direction: row;
            padding: 10px 15px;
            border-radius: 20px;
            outline: none;
            background: #DDF5E2;
            align-items: flex-end;
            gap: 5px;
            border: none;
            appearance: none; /* Remove default arrow */
            -webkit-appearance: none; /* Remove default arrow for Safari */
            -moz-appearance: none; /* Remove default arrow for Firefox */
            background-image: url('data:image/svg+xml;utf8,<svg fill="%23218336" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>'); /* Custom arrow */
            background-repeat: no-repeat;
            background-position: right 10px center; /* Position the arrow */
            padding-right: 30px;
            color: #218336;
            font-size: 10px;
        }

        /* Ensure the select element has a consistent style across browsers */
        .user-status::-ms-expand {
            display: none; /* Remove default arrow in IE */
        }

        .btn-outline-warning {
            border: solid 1px !important;
            border-color: #F7941C !important;
            color: #F7941C;
        }

        .bi-pencil {
            margin-right: 10px;
            color: #F7941C !important;
        }

        .btn:hover .bi-pencil { 
            color: black !important; 
        }

        .btn-outline-danger {
            border: solid 1px !important;
            border-color: #F24130 !important;
            color: #F24130;
        }

        .bi-trash3 {
            margin-right: 10px;
            color: #F24130 !important;
        }

        .btn:hover .bi-trash3 { 
            color: black !important; 
        }

        .value{
            display: flex;
            flex-direction: row;
            align-items: baseline;
        }

        .value > h1 {
            font-size: 35px;
        }

        .total-employee-value{
            display: flex;
            flex-direction: row;
            align-items: baseline;
            justify-content: space-between;
            color: #252F4A;
        }

        .percentage-value{
            display: flex;
            flex-direction: row;
            border-radius: 5px;
            outline: none;
            background: #DDF5E2;
            align-items: baseline;
            gap: 5px;
            padding: 5px 10px;
            font-size: 10px;
            color: #2AA443;
        }

        .percentage-value > p {
            margin: 0px !important;
        }

        .percentage-value > i {
            font-size: 10px;
            color: #2AA443;
        }

        .total-employee-data {
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2); 
            border-radius: 8px; 
            padding: 16px; 
            font-weight: 600;
        }

        #employment-status-chart .apexcharts-legend.apexcharts-align-center.apx-legend-position-right {
            gap: 10px;
        }

        .color-filter-title {
            font-weight: bold;
            font-size: 11px;
        }

        .color-filter-point {
            font-size: 10px;
        }

        .dropdown-menu-container > p {
            margin: 0px;
        }

        .custom-icon {
            width: 14px;
            height: 14px;
            fill: red; /* Change the color here */
        }
        .label-group {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: #A0A0A0;
            height: 20px; /* Set the height of the label group */
        }
        .axis .domain {
            display: none; /* Hide the axis lines */
        }
        .axis text {
            font-size: 12px;
        }
        .icon-label-group {
            display: flex;
            align-items: center;
        }
        .icon-label-group svg {
            margin-right: 4px;
        }

        .employee-checkbox-container {
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            width: 100%; 
            padding: 8px 0;
        }

        .employee-checkbox-container-level {
            display: flex;
        }


        /* Modal background overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Modal content */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            text-align: left;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            gap: 20px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: red;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .bfr-level-dropdown {
            display: none;
            position: absolute;
            background: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
            padding: 15px 20px; /* Increase padding */
            border-radius: 5px;
            z-index: 1000;
            width: auto;
            max-width: 200px;
            text-align: center; /* Center text inside */
        }

        .bfr-level-dropdown p {
            margin: 0;
            padding: 5px 0;
            text-align: center; /* Ensure <p> aligns too */
        }


        /* Ensure the parent element has relative positioning */
        .column-title {
            position: relative;
        }

        .page {
            page-break-after: always; /* Ensures each section is on a new page */
            padding: 20px;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: row;
        }
        .page:last-child {
            page-break-after: auto; /* Prevents an extra blank page at the end */
        }

        a {
            color: white;
            text-decoration: none !important;
            font-weight: bold;
        }

        .pdf-button-nav{
            display: flex;
            flex-direction: column;
            background-color: #3E3E3E;
            gap: 20px;
            padding: 50px 30px;
        }

        .btn-nav {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 15px;
            border: 1px solid black;
        }

        .highlight-b{
            color: #4B5675;
        }

        .text-bold {
            font-weight: bold;
        }

        .top-frame {
            background: #ffffff;
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
            padding: 40px 50px 10px 50px;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2); 
            border-radius: 8px; 
        }

        .top-overview {
            background: #ffffff;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2); 
            border-radius: 8px; 
            padding: 40px 50px;
            margin-bottom: 30px;
        }

        .bottom-overview {
            background: #ffffff;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2); 
            border-radius: 8px; 
            padding: 40px 50px;
        }

        .top-employment-data {
            display: flex;
            justify-content: space-between;
        }

        .bottom-employment-data {
            display: flex;
            justify-content: space-between;
        }

        .talent-status .apexcharts-legend.apexcharts-align-center.apx-legend-position-right {
            top: 1px !important;
            gap: 4px !important;
        }

        .tab-employee-profile{
            background: #ffffff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); 
            border-radius: 8px; 
            padding: 10px 20px 10px 30px;
        }

        .total-employee-number {
            background: #F1F1F4;
            color: #4B5675;
            padding: 1px 10px;
            border-radius: 10px;
            font-size: 20px;
        }

        .position-container h1 {
            font-size: 25px;
        }

        .position-container {
            position: relative;
        }


        .tab-employee-profile:hover {
            background-color: #FFF6EA;
        }

        .checkbox-label-group {
            display: flex;
            align-items: center;
            gap: 8px; 
        }

        .unique-position {
            margin-bottom: 2px !important;
        }

        .count-badge {
            color: #99A1B7;
        }

        input[type='radio'] {
            accent-color: #F9A845;
        }

        .psychometric-filter-bar {
            display: flex;
            align-items: baseline;
        }
                .app-header-menu .menu .menu-item.hover:not(.here)>.menu-link:not(.disabled):not(.active):not(.here) .menu-title, .app-header-menu .menu .menu-item:not(.here) .menu-link:hover:not(.disabled):not(.active):not(.here) .menu-title, .app-header-menu .menu .menu-item.hover:not(.here)>.menu-link:not(.disabled):not(.active):not(.here), .app-header-menu .menu .menu-item:not(.here) .menu-link:hover:not(.disabled):not(.active):not(.here), .app-header-menu .menu .menu-item:not(.here) .menu-link:hover:not(.disabled):not(.active):not(.here) .menu-icon {
                color: #f9a845;
        }
 
.app-header-menu .menu .menu-item.show > .menu-link .menu-title {
                color: #f9a845;
}

#toast-container {
    background: #f8285a !important;
}

a {
    font-weight: inherit;
}

    .employee-clearButton {
    position: absolute;
    top: 12px;
    right: 45px;
    cursor: pointer;
    }

    .no-data {
            display: flex;
    /* height: 819px; */
    padding: 118px 232px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 16px;
    align-self: stretch;
    border-radius: 8px;
    background: #FCFCFC;
    box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.03);
    color: #4B5675;
    text-align: center;
    font-size: 19.5px;
    font-weight: 500;
    line-height: 23.4px;
    }
    
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1 class="page-heading d-flex text-gray-900 fs-3 flex-column justify-content-center my-0">
                Department Profile
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">
                   Organization Structure
                </li>
                 <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize">
                    <a href="{{ route('admin.department.users.index') }}" class="text-muted text-hover-primary">
                        Departments
                    </a>
                </li>
                 <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">
                  {{ $departmentName }}
                </li>
               
            </ul>
        </div>
    </div>
</div>
    <div class="main-frame"  style="margin-top: 50px;">
        <div class="top-frame" style="margin-top: -30px;">
            @php
                $highestPositionLevel = collect($employeeData)
                    ->pluck('level')
                    ->filter(fn($level) => is_numeric($level) && (int)$level > 0)
                    ->max() ?? 0;
            @endphp
            <x-people-retention-department.tab-overview.info-data :departmentSectionStatus="$departmentSectionStatus" :departmentSectionNames="$departmentSectionNames" :totalHeads="$totalHeads" :totalNumberJobPosition="$totalNumberJobPosition" :departmentName="$departmentName" :location="$location" :headOfDepartment="$headOfDepartment" :totalEmployee="$totalEmployee" :jobVacancy="$jobVacancy" :highestPositionLevel="$highestPositionLevel" />
            <x-main-tab-nav-people-retention />
        </div>
        <div class="tab-content-data">
            <x-people-retention-department.tab-overview.tab-overview :id="$id" :percentageChange="$percentageChange" :formattedPercentage="$formattedPercentage" :averagePercentage="$averagePercentage" :newHiresCount="$newHiresCount" :totalEmployee="$totalEmployee" :activeJobAds="$activeJobAds" :cityCounts="$cityCounts" />
            <div class="tab-content employee-content">
                <div class="employee-directory-nav-content-box">
                    @php
                        $roleName = 'employee'; 
                        $filteredEmployeeData = $employeeData->where('role_name', $roleName);
                        $groupedByPosition = $filteredEmployeeData->groupBy('position_name');
                        
                        $typeSpecificPositions = $filteredEmployeeData->pluck('position_name')->unique()->values();
                        $typeSpecificLevels = $filteredEmployeeData->pluck('level')->unique()->values();
                        
                        $typeSpecificPositionCounts = [];
                        foreach ($typeSpecificPositions as $position) {
                            $typeSpecificPositionCounts[$position] = $filteredEmployeeData->where('position_name', $position)->count();
                        }
                        
                        $typeSpecificLevelCounts = [];
                        foreach ($typeSpecificLevels as $level) {
                            $typeSpecificLevelCounts[$level] = $filteredEmployeeData->where('level', $level)->count();
                        }
                    @endphp
                
                    <x-people-retention-department.tab-employee.tab-employee 
                        title="Employee Directory"
                        :employeeData="$groupedByPosition"
                        :uniquePositions="$typeSpecificPositions"
                        :positionCounts="$typeSpecificPositionCounts"
                        :positionLevelCounts="$typeSpecificLevelCounts"
                        :uniqueLevels="$typeSpecificLevels"
                        :positionsByLevel="$positionsByLevel"
                        :levelsByPosition="$levelsByPosition" />
                </div>
            </div>

            <x-people-retention-department.tab-psychometric.tab-psychometric 
                :resultTAPsychometric="$resultTAPsychometric"
                :employeeData="$employeeData"
                :availableLevels="$availableLevels"
                :id="$id"
                :completedCount="$completedCount"
                :incompleteCount="$incompleteCount"
                :positionsByLevelPsychometric="$positionsByLevelPsychometric"
                :levelsByPositionPsychometric="$levelsByPositionPsychometric"
                :bfrLevelCounts="$bfrLevelCounts"
                :tsmrLevelCounts="$tsmrLevelCounts"
                :jmrLevelCounts="$jmrLevelCounts"
                :flightRiskCounts="$flightRiskCounts"
                :workplaceAlignmentForecast="$workplaceAlignmentForecast"
                :catLevelCounts="$catLevelCounts"
                :matchRateCounts="$matchRateCounts"
                :leadershipPotentialCounts="$leadershipPotentialCounts"
                :growthPotentialCounts="$growthPotentialCounts"
            />            
            <x-people-retention-department.tab-workforce.tab-workforce />
            <x-people-retention-department.tab-succession.tab-succession />
            <x-people-retention-department.tab-internal.tab-internal />
            <x-people-retention-department.tab-performance.tab-performance />
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        const positionLevelMap = @json(config('helpers.position_levels'));
    </script>


    <script>
        var genderData = @json($genderData);
        var statusData = @json($statusData);
        console.log(statusData);
        var assessmentCompletionStatusData = @json($assessmentCompletionStatusData);
        var positionLevelData = @json($positionLevelData);
        var omrLevelCounts = @json($omrLevelCounts);
        var bfrLevelCounts = @json($bfrLevelCounts);
        var taLevelCounts = @json($taLevelCounts);
        var matchRateCounts = @json($matchRateCounts);
        var leadershipPotentialCounts = @json($leadershipPotentialCounts);
        var growthPotentialCounts = @json($growthPotentialCounts);
        var tsmrLevelCounts = @json($tsmrLevelCounts);
        var jmrLevelCounts = @json($jmrLevelCounts);
        var flightRiskCounts = @json($flightRiskCounts);
        var workplaceAlignmentForecastCounts = @json($workplaceAlignmentForecast);
        var catLevelCounts = @json($catLevelCounts);
        var dareToDreamCount = @json($dareToDreamCount);
        var haveEmpathyCount = @json($haveEmpathyCount);
        var allForOneCount = @json($allForOneCount);
        var makeDifferenceCount = @json($makeDifferenceCount);
        var beTransparentCount = @json($beTransparentCount);
        var celebrateIndividualsCount = @json($celebrateIndividualsCount);
        var keepItSimpleCount = @json($keepItSimpleCount);
        var chartPositionLevelGroup = @json($chartPositionLevelGroup);
        var deparmentId = {{ $department->id }};

        document.getElementById('status-dropdown').addEventListener('change', function() {
        var newStatus = this.value;
        var departmentId = {{ $department->id }};

        fetch('/update-department-section-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                department_id: departmentId,
                status: newStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.current-user-status').textContent = newStatus;
            } else {
                alert('Failed to update status');
            }
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeEmployeeCardDropdowns();
        });
    </script>

    <script>
        const tabs = document.querySelectorAll('.tab-nav');
        const all_content = document.querySelectorAll('.tab-content');

        let chart, ageChart, positionLevelChartSVG, employmentStatusChart, talentInsightChart, 
        aggregatedOverallMatchRateChart, assessmentCompletionStatusChart, technicalAssessmentChart, technicalSkillMatchRateChart, jobMatchRateChart, ssmrRateChart,
        behavioralFitRateChart, gpChart, workplaceAlignmentForecastChart, flightRiskChart, cognitiveAbilityChart;

        document.addEventListener('DOMContentLoaded', () => {
            console.log("DOM fully loaded and parsed");
            tabs[0].classList.add('active');
            all_content[0].classList.add('active');
            initializeCharts();
        });

        let activeTabIndex = 0;
        let activeEmployeeTabIndex = 0;

        function setupEmployeeTabListeners() {
            const employeeDirectoryTabs = document.querySelectorAll('.employee-directory-tab-nav');
            const employeeDirectoryContent = document.querySelectorAll('.employee-directory-content');
            const employeeLine = document.querySelector('.employee-nav-line');

            employeeDirectoryTabs.forEach((tab) => {
                const newTab = tab.cloneNode(true);
                tab.parentNode.replaceChild(newTab, tab);
            });

            const updatedTabs = document.querySelectorAll('.employee-directory-tab-nav');

            updatedTabs.forEach((employeeTab, employeeIndex) => {
                employeeTab.addEventListener('click', (e) => {
                    updatedTabs.forEach(tab => tab.classList.remove('active'));
                    employeeTab.classList.add('active');

                    if (employeeLine) {
                        employeeLine.style.width = e.target.offsetWidth + 'px';
                        employeeLine.style.left = e.target.offsetLeft + 'px';
                    }

                    employeeDirectoryContent.forEach(content => content.classList.remove('active'));
                    employeeDirectoryContent[employeeIndex].classList.add('active');

                    activeEmployeeTabIndex = employeeIndex;
                });
            });
        }

        let originalProfiles = []; 

        function initializeAllTabFilters() {
            const allTabs = document.querySelectorAll('.employee-directory-content');

            allTabs.forEach(tab => {
                const tabType = tab.getAttribute('data-tab-type');
                if (!tabType) return;

                const container = document.querySelector(`.filter-buttons[data-tab="${tabType}"]`);
                if (!container) return;

                const searchInput = container.querySelector('input.employee-searchTerm');

                const originalContainers = [];
                tab.querySelectorAll('.position-container').forEach((container, i) => {
                    originalContainers[i] = container.cloneNode(true); 
                });

                tab.querySelectorAll('.tab-employee-profile').forEach(profile => {
                    originalProfiles.push(profile);
                });

                if (searchInput) {
    searchInput.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();
        const parentWrapper = tab.querySelector('.employee-directory-title-1');
        parentWrapper.innerHTML = '';

        let anyVisible = false;  // Flag to track if any container has visible profiles

        originalContainers.forEach((originalContainer, containerIndex) => {
            const clone = originalContainer.cloneNode(true);
            const cards = clone.querySelectorAll('.tab-employee-profile');
            let visibleCount = 0;

            const levelRadio = document.querySelector(`.filter-buttons[data-tab="${tabType}"] input[name^="ED"][name$="PositionLevelFilter"]:checked`);
            const positionRadio = document.querySelector(`.filter-buttons[data-tab="${tabType}"] input[name^="ED"][name$="JobPositionFilter"]:checked`);

            const selectedLevel = levelRadio ? levelRadio.value.replace('Level ', '').trim() : null;
            const selectedPosition = positionRadio ? positionRadio.value.trim().toLowerCase() : null;

            cards.forEach((card) => {
                const name = card?.querySelector('.profile-name')?.textContent.toLowerCase() || '';
                const email = card?.querySelector('.profile-email')?.textContent.toLowerCase() || '';
                const position = card?.getAttribute('data-position')?.toLowerCase() || '';
                const gender = card?.getAttribute('data-gender')?.toLowerCase() || '';
                const profileLevel = card?.getAttribute('data-level')?.trim();
                const profilePosition = card?.getAttribute('data-department')?.toLowerCase().trim();

                const matchSearch = name.includes(query) || email.includes(query) || position.includes(query) || gender === query;
                const matchLevel = selectedLevel ? profileLevel === selectedLevel : true;
                const matchPosition = selectedPosition ? profilePosition === selectedPosition : true;

                const isVisible = matchSearch && matchLevel && matchPosition;

                if (!isVisible) {
                    card.remove();
                } else {
                    visibleCount++;
                }
            });

            if (visibleCount > 0) {
                anyVisible = true;
                const countLabel = clone.querySelector('.total-employee-number');
                if (countLabel) countLabel.textContent = visibleCount;
                parentWrapper.appendChild(clone);
            } else {
                console.log(`❌ No matching profiles in container ${containerIndex}`);
            }
        });

        if (!anyVisible) {
            parentWrapper.innerHTML = '<p class="no-data">No data available</p>';
        }

        initializeEmployeeCardDropdowns();
    });
}


                container.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.querySelectorAll('.custom-check-input').forEach(div => {
                        div.addEventListener('click', function () {
                            let radio = this.querySelector('input[type="radio"]');
                            let targetButton = document.getElementById(radio.getAttribute("data-target"));

                            if (radio) {
                                radio.checked = true;
                                menu.querySelectorAll('.custom-check-input').forEach(item => item.classList.remove('active'));
                                this.classList.add('active');
                                if (targetButton) {
                                    // targetButton.querySelector("span").textContent = radio.value;
                                    // targetButton.classList.add("active-btn");
                                    const labelText = radio.getAttribute("data-label") || radio.value;
                                    targetButton.querySelector("span").textContent = labelText;
                                    targetButton.classList.add("active-btn");
                                }
                                filterEmployees(tabType);
                                updateDependentDropdowns(tabType); // ← ADD THIS LINE
                            }
                        });
                    });
                });

                container.querySelectorAll('.resetBtn').forEach(button => {
    button.addEventListener('click', function () {
        let menu = this.closest('.dropdown-menu');
        let targetButton = document.getElementById(this.getAttribute("data-target"));
        let searchInput = menu.closest('.filter-buttons').querySelector('input.employee-searchTerm');

        if (!menu || !targetButton) return;

        // Reset radios and UI buttons
        let radios = menu.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => radio.checked = false);
        menu.querySelectorAll('.custom-check-input').forEach(item => item.classList.remove('active'));
        targetButton.querySelector("span").textContent = targetButton.getAttribute("data-default-text");
        targetButton.classList.remove("active-btn");

        // Clear search input
        // if (searchInput) {
        //     searchInput.value = '';
        // }

        const parentWrapper = tab.querySelector('.employee-directory-title-1');
        parentWrapper.innerHTML = '';

        // Append all original containers
        originalContainers.forEach(originalContainer => {
            parentWrapper.appendChild(originalContainer);
        });

        // Show "No data available" message if after append it's empty
        if (parentWrapper.children.length === 0) {
            parentWrapper.innerHTML = '<p class="no-data">No data available</p>';
        }

        initializeEmployeeCardDropdowns();
        filterEmployees(tabType);
        updateDependentDropdowns(tabType);
    });
});

document.querySelectorAll('.employee-clearButton').forEach(button => {
    button.addEventListener('click', function () {
        let wrapper = this.closest('.employee-search');
        let searchInput = wrapper.querySelector('.employee-searchTerm');
        if (searchInput) {
            searchInput.value = '';
        }
         const parentWrapper = tab.querySelector('.employee-directory-title-1');
        parentWrapper.innerHTML = '';

        // Append all original containers
        originalContainers.forEach(originalContainer => {
            parentWrapper.appendChild(originalContainer);
        });

        initializeEmployeeCardDropdowns();
        filterEmployees(tabType);
        updateDependentDropdowns(tabType);
    });
});


            });
        }

        function updateDependentDropdowns(tabType) {
            const container = document.querySelector(`.employee-directory-content[data-tab-type="${tabType}"]`);
            if (!container) return;

            const levelRadios = document.querySelectorAll(`.filter-buttons[data-tab="${tabType}"] input[name^="ED"][name$="PositionLevelFilter"]`);
            const positionRadios = document.querySelectorAll(`.filter-buttons[data-tab="${tabType}"] input[name^="ED"][name$="JobPositionFilter"]`);

            const selectedLevelRadio = Array.from(levelRadios).find(r => r.checked);
            const selectedPositionRadio = Array.from(positionRadios).find(r => r.checked);

            const selectedLevel = selectedLevelRadio ? selectedLevelRadio.value : null;
            const selectedPosition = selectedPositionRadio ? selectedPositionRadio.value : null;

            const allProfiles = Array.from(container.querySelectorAll('.tab-employee-profile'));

            // Build a count map: { position: { level: count }, level: { position: count } }
            let positionLevelMap = {};
            let levelPositionMap = {};

            allProfiles.forEach(profile => {
                const profileLevel = profile.getAttribute('data-level');
                const profilePosition = profile.getAttribute('data-department');

                // Count based on both level and position
                if (!positionLevelMap[profilePosition]) positionLevelMap[profilePosition] = {};
                if (!positionLevelMap[profilePosition][profileLevel]) positionLevelMap[profilePosition][profileLevel] = 0;
                positionLevelMap[profilePosition][profileLevel]++;

                if (!levelPositionMap[profileLevel]) levelPositionMap[profileLevel] = {};
                if (!levelPositionMap[profileLevel][profilePosition]) levelPositionMap[profileLevel][profilePosition] = 0;
                levelPositionMap[profileLevel][profilePosition]++;
            });

            // Update position dropdown counts
            positionRadios.forEach(radio => {
                const position = radio.value;
                const count = selectedLevel
                    ? (positionLevelMap[position] && positionLevelMap[position][selectedLevel]) || 0
                    : allProfiles.filter(p => p.getAttribute('data-department') === position).length;

                const label = radio.closest('.custom-check-input').querySelector('span');
                
                if (label) label.textContent = count;
            });

            // Update level dropdown counts
            levelRadios.forEach(radio => {
                const level = radio.value;
                const count = selectedPosition
                    ? (levelPositionMap[level] && levelPositionMap[level][selectedPosition]) || 0
                    : allProfiles.filter(p => p.getAttribute('data-level') === level).length;

                const label = radio.closest('.custom-check-input').querySelector('span');
                if (label) label.textContent = count;
            });
        }

        function filterEmployees(tabType) {
            const container = document.querySelector(`.employee-directory-content[data-tab-type="${tabType}"]`);
            if (!container) return;

            const levelRadio = document.querySelector(`.filter-buttons[data-tab="${tabType}"] input[name^="ED"][name$="PositionLevelFilter"]:checked`);
            const positionRadio = document.querySelector(`.filter-buttons[data-tab="${tabType}"] input[name^="ED"][name$="JobPositionFilter"]:checked`);

            const selectedLevel = levelRadio ? levelRadio.value.replace('Level ', '').trim() : null;
            const selectedPosition = positionRadio ? positionRadio.value.trim().toLowerCase() : null;

            const positionContainers = container.querySelectorAll('.position-container');

            positionContainers.forEach(container => {
                const profiles = container.querySelectorAll('.tab-employee-profile');
                let visibleCount = 0;

                profiles.forEach(profile => {
                    const profileLevel = profile.getAttribute('data-level');
                    const profilePosition = profile.getAttribute('data-department');

                    const matchLevel = selectedLevel ? profileLevel === selectedLevel : true;
                    const matchPosition = selectedPosition ? profilePosition.toLowerCase() === selectedPosition : true;

                    const isVisible = matchLevel && matchPosition;
                    profile.style.display = isVisible ? 'block' : 'none';

                    if (isVisible) visibleCount++;
                });

                container.style.display = visibleCount > 0 ? 'block' : 'none';
                const countElement = container.querySelector('.total-employee-number');
                if (countElement) {
                    countElement.textContent = visibleCount;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            initializeAllTabFilters();
            initializeEmployeeCardDropdowns();
            setupEmployeeTabListeners();
        });

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = parseInt(urlParams.get('tab')) || 0;

            tabs.forEach(tab => tab.classList.remove('active'));
            all_content.forEach(content => content.classList.remove('active'));

            tabs[tabParam].classList.add('active');
            all_content[tabParam].classList.add('active');
            activeTabIndex = tabParam;

            const navBarLine = document.querySelector('.nav-bar-line');
            if (navBarLine && tabs[activeTabIndex]) {
                navBarLine.style.width = tabs[activeTabIndex].offsetWidth + 'px';
                navBarLine.style.left = tabs[activeTabIndex].offsetLeft + 'px';
            }

            if (tabParam === 2) {
                const psychometricTabs = document.querySelectorAll('.psychometric-tab-nav');
                const psychometricContent = document.querySelectorAll('.psychometric-content');
                const psychometricLine = document.querySelector('.psychometric-nav-line');

                psychometricTabs.forEach(tab => tab.classList.remove('active'));
                psychometricTabs[1].classList.add('active');
                psychometricContent.forEach(content => content.classList.remove('active'));
                psychometricContent[1].classList.add('active');

                const activeTab = psychometricTabs[1];
                if (psychometricLine && activeTab) {
                    psychometricLine.style.width = activeTab.offsetWidth + 'px';
                    psychometricLine.style.left = activeTab.offsetLeft + 'px';
                }
            }
        });

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', debounce((e) => {
                tabs.forEach(tab => tab.classList.remove('active'));
                tab.classList.add('active');

                var navBarLine = document.querySelector('.nav-bar-line');
                navBarLine.style.width = e.target.offsetWidth + 'px';
                navBarLine.style.left = e.target.offsetLeft + 'px';

                all_content.forEach(content => content.classList.remove('active'));
                all_content[index].classList.add('active');

                activeTabIndex = index;

                if (index === 1) {
                    const employeeDirectoryTabs = document.querySelectorAll('.employee-directory-tab-nav');
                    const employeeDirectoryContent = document.querySelectorAll('.employee-directory-content');
                    const employeeLine = document.querySelector('.employee-nav-line');
                    
                    employeeDirectoryTabs.forEach(tab => tab.classList.remove('active'));
                    employeeDirectoryTabs[activeEmployeeTabIndex].classList.add('active');
                    employeeDirectoryContent.forEach(content => content.classList.remove('active'));
                    employeeDirectoryContent[activeEmployeeTabIndex].classList.add('active');
                    
                    if (employeeLine && employeeDirectoryTabs[activeEmployeeTabIndex]) {
                        employeeLine.style.width = employeeDirectoryTabs[activeEmployeeTabIndex].offsetWidth + 'px';
                        employeeLine.style.left = employeeDirectoryTabs[activeEmployeeTabIndex].offsetLeft + 'px';
                    }
                }

                if (index === 2) {
                    const psychometricTabs = document.querySelectorAll('.psychometric-tab-nav');
                    const psychometricContent = document.querySelectorAll('.psychometric-content');
                    const psychometricLine = document.querySelector('.psychometric-nav-line');

                    psychometricTabs.forEach(tab => tab.classList.remove('active'));
                    psychometricTabs[0].classList.add('active');
                    psychometricContent.forEach(content => content.classList.remove('active'));
                    psychometricContent[0].classList.add('active');

                    const activeTab = psychometricTabs[0];
                    psychometricLine.style.width = activeTab.offsetWidth + 'px';
                    psychometricLine.style.left = activeTab.offsetLeft + 'px';

                    // Add this logic to update the page number dynamically
                    psychometricTabs.forEach((psyTab, psyIndex) => {
                        psyTab.addEventListener('click', (e) => {
                            e.preventDefault();

                            console.log(`Psychometric tab ${psyIndex} clicked`);

                            if (psyIndex === 1) {
                                psychometricTabs.forEach(tab => tab.classList.remove('active'));
                                psyTab.classList.add('active');

                                psychometricContent.forEach(content => content.classList.remove('active'));
                                psychometricContent[psyIndex].classList.add('active');

                                psychometricLine.style.width = psyTab.offsetWidth + 'px';
                                psychometricLine.style.left = psyTab.offsetLeft + 'px';

                                const tableContainer = document.querySelector('.table-container');
                                if (tableContainer) {
                                    tableContainer.innerHTML = `
                                        <div style="padding: 50px; text-align: center;">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p>Loading table...</p>
                                        </div>
                                    `;
                                }

                                const page = 1;  
                                const tab = 2;   

                                fetch(`/admin/department-details/${deparmentId}?page=${page}&tab=${tab}`)
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not OK');
                                        }
                                        return response.text();
                                    })
                                    .then(html => {
                                        const parser = new DOMParser();
                                        const doc = parser.parseFromString(html, 'text/html');

                                        const newTableContainer = doc.querySelector('.table-container');
                                        const currentTableContainer = document.querySelector('.table-container');

                                        if (newTableContainer && currentTableContainer) {
                                            currentTableContainer.innerHTML = newTableContainer.innerHTML;
                                        } else {
                                            console.error('Table container not found in the page.');
                                        }

                                        window.history.pushState({}, '', `/admin/department-details/${deparmentId}`);
                                        $(document).trigger('ready');
                                    })
                                    .catch(error => {
                                        console.error('Error loading page:', error);
                                    });

                                return;
                            }

                            psychometricTabs.forEach(tab => tab.classList.remove('active'));
                            psyTab.classList.add('active');

                            psychometricLine.style.width = e.target.offsetWidth + 'px';
                            psychometricLine.style.left = e.target.offsetLeft + 'px';

                            psychometricContent.forEach(content => content.classList.remove('active'));
                            psychometricContent[psyIndex].classList.add('active');
                        });
                    });

                    if (aggregatedOverallMatchRateChart) aggregatedOverallMatchRateChart.destroy();
                    if (chart) chart.destroy();
                    if (technicalAssessmentChart) technicalAssessmentChart.destroy();
                    if (behavioralFitRateChart) behavioralFitRateChart.destroy();
                    if (technicalSkillMatchRateChart) technicalSkillMatchRateChart.destroy();
                    if (jobMatchRateChart) jobMatchRateChart.destroy();
                    if (ssmrRateChart) ssmrRateChart.destroy();
                    if (gpChart) gpChart.destroy();
                    if (workplaceAlignmentForecastChart) workplaceAlignmentForecastChart.destroy();
                    if (flightRiskChart) flightRiskChart.destroy();
                    if (cognitiveAbilityChart) cognitiveAbilityChart.destroy();
                    initializeCharts();

                    setTimeout(() => {
                        $(document).trigger('ready'); 
                    }, 200);
                    
                }
            }, 100));
        });

        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                const context = this;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        function initializeCharts() {

            // var ageChartOptions = {
            //     series: [
            //         { name: 'Male', data: genderData.Male },
            //         { name: 'Female', data: genderData.Female }
            //     ],
            //     legend: {
            //         position: 'top',
            //         horizontalAlign: 'left',
            //         markers: { strokeWidth: 0 },
            //         formatter: function(seriesName, opts) {
            //             const total = genderData.Male.reduce((a, b) => a + b, 0) + genderData.Female.reduce((a, b) => a + b, 0);
            //             const seriesTotal = genderData[seriesName].reduce((a, b) => a + b, 0);
            //             const percentage = (seriesTotal / total * 100).toFixed(1) + '%';
            //             return `<div class="age-legend-item"><span class="label">${seriesName}</span><span class="value">${percentage}</span></div>`;
            //         },
            //         labels: {
            //             colors: "#A0A0A0"
            //         }
            //     },
            //     chart: { type: 'bar', height: 300, width: 500, toolbar: { show: false } },
            //     plotOptions: { bar: { vertical: true } },
            //     colors: ['#AA91F4', '#3FD0D0'],
            //     dataLabels: { enabled: false },
            //     stroke: { show: false },
            //     tooltip: { shared: true, intersect: false },
            //     xaxis: { categories: ['18-24', '25-34', '35-44', '45-54', '55-64', '65+'], labels: { style: { colors: '#252F4A'}} },
            //     yaxis: { max: Math.max(...genderData.Male.concat(genderData.Female)) + 5 }
            // }

            // var ageChartOptions = {
            //     series: [
            //         { name: 'Male', data: genderData.Male },
            //         { name: 'Female', data: genderData.Female },
            //         { name: 'Others', data: genderData.Others }
            //     ],
            //     legend: {
            //         position: 'top',
            //         horizontalAlign: 'left',
            //         markers: { strokeWidth: 0 },
            //         formatter: function(seriesName, opts) {
            //             const total =
            //                 genderData.Male.reduce((a, b) => a + b, 0) +
            //                 genderData.Female.reduce((a, b) => a + b, 0) +
            //                 genderData.Others.reduce((a, b) => a + b, 0);

            //             const seriesTotal = genderData[seriesName].reduce((a, b) => a + b, 0);
            //             const percentage = total > 0 ? (seriesTotal / total * 100).toFixed(1) + '%' : '0%';

            //             return `<div class="age-legend-item"><span class="label">${seriesName}</span><span class="value">${percentage}</span></div>`;
            //         },
            //         labels: {
            //             colors: "#A0A0A0"
            //         }
            //     },
            //     chart: {
            //         type: 'bar',
            //         height: 300,
            //         width: 500,
            //         toolbar: { show: false }
            //     },
            //     plotOptions: { bar: { vertical: true } },
            //     colors: ['#AA91F4', '#3FD0D0', '#F9A825'],
            //     dataLabels: { enabled: false },
            //     stroke: { show: false },
            //     tooltip: { shared: true, intersect: false },
            //     xaxis: {
            //         categories: ['N/A', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'],
            //         labels: { style: { colors: '#252F4A' } }
            //     },
            //     yaxis: {
            //         max: Math.max(...genderData.Male.concat(genderData.Female, genderData.Others)) + 5
            //     }
            // };

            var ageChartOptions = {
                series: [
                    { name: 'Male', data: genderData.Male },
                    { name: 'Female', data: genderData.Female },
                    { name: 'N/A', data: genderData.Others } // <- Changed from 'Others' to 'N/A'
                ],
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    markers: { strokeWidth: 0 },
                    formatter: function(seriesName, opts) {
                        const total =
                            genderData.Male.reduce((a, b) => a + b, 0) +
                            genderData.Female.reduce((a, b) => a + b, 0) +
                            genderData.Others.reduce((a, b) => a + b, 0);

                        let seriesTotal = 0;

                        if (seriesName === 'Male') {
                            seriesTotal = genderData.Male.reduce((a, b) => a + b, 0);
                        } else if (seriesName === 'Female') {
                            seriesTotal = genderData.Female.reduce((a, b) => a + b, 0);
                        } else if (seriesName === 'N/A') { // <- Handle renamed legend
                            seriesTotal = genderData.Others.reduce((a, b) => a + b, 0);
                        }

                        const percentage = total > 0 ? (seriesTotal / total * 100).toFixed(1) + '%' : '0%';

                        return `<div class="age-legend-item"><span class="label">${seriesName}</span><span class="value">${percentage}</span></div>`;
                    },
                    labels: {
                        colors: "#A0A0A0"
                    }
                },
                chart: {
                    type: 'bar',
                    height: 300,
                    width: 500,
                    toolbar: { show: false }
                },
                plotOptions: { bar: { vertical: true } },
                colors: ['#AA91F4', '#3FD0D0', '#F9A825'],
                dataLabels: { enabled: false },
                stroke: { show: false },
                tooltip: { shared: true, intersect: false },
                xaxis: {
                    categories: ['N/A', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'],
                    labels: { style: { colors: '#252F4A' } }
                },
                yaxis: {
                    max: Math.max(...genderData.Male.concat(genderData.Female, genderData.Others)) + 5
                }
            };


            
            function isEmptyData(data) {
                if (!data || Object.keys(data).length === 0) return true;
                return Object.values(data).every(val => val === 0);
            }

            if (isEmptyData(statusData)) {
                document.querySelector("#employment-status-chart").innerHTML = '<p style="text-align:center; margin-top: 130px; margin-right:30px; font-size:16px">No data</p>';
            } else {
                var employmentStatusOptions = {
                    series: Object.values(statusData),
                    chart: { type: 'donut', height: 300, width: 500, id: 'employment-status-chart' },
                    labels: Object.keys(statusData),
                    colors: ['#8CE3E3', '#D0C2F9', '#1AC2C2', '#108585', '#FFC549', '#49C0F3'],
                    dataLabels: { enabled: false },
                    plotOptions: {
                        pie: {
                            donut: { labels: { show: true } },
                            expandOnClick: true,
                            stroke: { width: 0 }
                        }
                    },
                    stroke: { show: false, colors: ['transparent'], width: 0 },
                    legend: {
                        show: true,
                        position: 'right',
                        formatter: function(seriesName, opts) {
                            return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${opts.w.globals.series[opts.seriesIndex]}</span><i class="bi bi-person"></i></div>`;
                        }
                    }
                    
                };

                employmentStatusChart = new ApexCharts(document.querySelector("#employment-status-chart"), employmentStatusOptions);
                employmentStatusChart.render();
            }

            var aggregatedOverallMatchRate = {
                series: [omrLevelCounts.VeryHigh, omrLevelCounts.High, omrLevelCounts.Moderate, omrLevelCounts.Low, omrLevelCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'overall-match-rate-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = aggregatedOverallMatchRate.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var technicalAssessment = {
                series: [taLevelCounts.VeryHigh, taLevelCounts.High, taLevelCounts.Moderate, taLevelCounts.Low, taLevelCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'technical-assessment-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = technicalAssessment.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var behavioralFitRate = {
                series: [bfrLevelCounts.VeryHigh, bfrLevelCounts.High, bfrLevelCounts.Moderate, bfrLevelCounts.Low, bfrLevelCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'behavioral-fit-rate-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = behavioralFitRate.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var technicalSkillMatchRate = {
                series: [tsmrLevelCounts.VeryHigh, tsmrLevelCounts.High, tsmrLevelCounts.Moderate, tsmrLevelCounts.Low, tsmrLevelCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'technical-skill-match-rate-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = technicalSkillMatchRate.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };
            
            var jobMatchRate = {
                series: [jmrLevelCounts.VeryHigh, jmrLevelCounts.High, jmrLevelCounts.Moderate, jmrLevelCounts.Low, jmrLevelCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'job-match-rate-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = jobMatchRate.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var ssmrRate = {
                series: [matchRateCounts.VeryHigh, matchRateCounts.High, matchRateCounts.Moderate, matchRateCounts.Low, matchRateCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'ssmr-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = ssmrRate.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var lp = {
                series: [leadershipPotentialCounts.VeryHigh, leadershipPotentialCounts.High, leadershipPotentialCounts.Moderate, leadershipPotentialCounts.Low, leadershipPotentialCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'lp-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = lp.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var gp = {
                series: [growthPotentialCounts.VeryHigh, growthPotentialCounts.High, growthPotentialCounts.Moderate, growthPotentialCounts.Low, growthPotentialCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'gp-chart',
                },
                labels: ['Very High', 'High', 'Moderate', 'Low', 'Very Low'],
                colors: ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = gp.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var workplaceAlignmentForecast = {
                series: [workplaceAlignmentForecastCounts.VeryHigh, workplaceAlignmentForecastCounts.High, workplaceAlignmentForecastCounts.Moderate, workplaceAlignmentForecastCounts.Low, workplaceAlignmentForecastCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'workplace-alignment-forecast-chart',
                },
                labels: ['Very High Risk', 'High Risk', 'Moderate Risk', 'Low Risk', 'Very Low Risk'],
                colors: ['#FF6355', '#FFC1BB', '#FFE4AA', '#7F66CA', '#54CF63'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = workplaceAlignmentForecast.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var flightRisk = {
                series: [flightRiskCounts.VeryHigh, flightRiskCounts.High, flightRiskCounts.Moderate, flightRiskCounts.Low, flightRiskCounts.VeryLow],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'flight-risk-chart',
                },
                labels: ['Very High Risk', 'High Risk', 'Moderate Risk', 'Low Risk', 'Very Low Risk'],
                colors: ['#FF6355', '#FFC1BB', '#FFE4AA', '#7F66CA', '#54CF63'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = flightRisk.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            var cognitiveAbility = {
                series: [catLevelCounts.High, catLevelCounts.Moderate, catLevelCounts.Low],
                chart: {
                    type: 'donut',
                    height: 300,
                    width: 500,
                    id: 'cognitive-ability-chart',
                },
                labels: ['High', 'Moderate', 'Low'],
                colors: ['#3FD0D0', '#54CF63', '#FFCD44'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        var total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        return total;
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: true, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var seriesValue = cognitiveAbility.series[opts.seriesIndex];
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${seriesValue}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            if (isEmptyData(assessmentCompletionStatusData)) {
                document.querySelector("#assessment-completion-status-chart").innerHTML = '<p style="text-align:center; margin-top: 130px; margin-right:30px; font-size:16px">No data</p>';
            } else {
                var assessmentCompletionStatus = {
                    series: Object.values(assessmentCompletionStatusData),
                    chart: { type: 'donut', height: 300, width: 500, id: 'assessment-completion-status-chart' },
                    labels: Object.keys(assessmentCompletionStatusData),
                    colors: ['#D0C2F9', '#FFD76A'],
                    dataLabels: { enabled: false },
                    plotOptions: {
                        pie: {
                            donut: { labels: { show: true } },
                            expandOnClick: true,
                            stroke: { width: 0 }
                        }
                    },
                    stroke: { show: false, colors: ['transparent'], width: 0 },
                    legend: {
                        show: true,
                        position: 'right',
                        formatter: function(seriesName, opts) {
                            return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${opts.w.globals.series[opts.seriesIndex]}</span><i class="bi bi-person"></i></div>`;
                        }
                    }
                };

                assessmentCompletionStatusChart = new ApexCharts(document.querySelector("#assessment-completion-status-chart"), assessmentCompletionStatus);
                assessmentCompletionStatusChart.render();
            }

            var talentInsight = {
                series: Object.values(window.bfrLevelData),
                chart: { type: 'donut', height: 300, width: 500, id: 'talent-insight-chart' },
                labels: Object.keys(window.bfrLevelData),
                colors: ['#997BF2', '#1AC2C2', '#108585', '#FFD76A', '#D0C2F9', '#65DADA', '#F7941C', '#FFC31F', '#7F66CA'],
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: { labels: { show: true } },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { show: false, colors: ['transparent'], width: 0 },
                legend: {
                    show: true,
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        return `<div class="legend-item"><span class="label" style="color:#4B5675">${seriesName}</span><span class="value" style="color:#78829D">${opts.w.globals.series[opts.seriesIndex]}</span><i class="bi bi-person"></i></div>`;
                    }
                }
            };

            ageChart = new ApexCharts(document.querySelector("#age-chart"), ageChartOptions);
            ageChart.render();

            renderPositionLevelD3Chart(positionLevelData);

            talentInsightChart = new ApexCharts(document.querySelector("#talent-insight-chart"), talentInsight);
            talentInsightChart.render();

            aggregatedOverallMatchRateChart = new ApexCharts(document.querySelector("#overall-match-rate-chart"), aggregatedOverallMatchRate);
            aggregatedOverallMatchRateChart.render();

            technicalAssessmentChart = new ApexCharts(document.querySelector("#technical-assessment-chart"), technicalAssessment);
            technicalAssessmentChart.render();

            behavioralFitRateChart = new ApexCharts(document.querySelector("#behavioral-fit-rate-chart"), behavioralFitRate);
            behavioralFitRateChart.render();

            technicalSkillMatchRateChart = new ApexCharts(document.querySelector("#technical-skill-match-rate-chart"), technicalSkillMatchRate);
            technicalSkillMatchRateChart.render();

            jobMatchRateChart = new ApexCharts(document.querySelector("#job-match-rate-chart"), jobMatchRate);
            jobMatchRateChart.render();

            ssmrRateChart = new ApexCharts(document.querySelector("#ssmr-chart"), ssmrRate);
            ssmrRateChart.render();

            lpChart = new ApexCharts(document.querySelector("#lp-chart"), lp);
            lpChart.render();

            gpChart = new ApexCharts(document.querySelector("#gp-chart"), gp);
            gpChart.render();

            workplaceAlignmentForecastChart = new ApexCharts(document.querySelector("#workplace-alignment-forecast-chart"), workplaceAlignmentForecast);
            workplaceAlignmentForecastChart.render();

            flightRiskChart = new ApexCharts(document.querySelector("#flight-risk-chart"), flightRisk);
            flightRiskChart.render();

            cognitiveAbilityChart = new ApexCharts(document.querySelector("#cognitive-ability-chart"), cognitiveAbility);
            cognitiveAbilityChart.render();
        }

        //Start of Position Level Filter

        function createBasicApexChart(containerId, title, levelData) {
            let seriesData = [];
            let labels = [];
            let colors;
            
            // Get the metric type from containerId
            const metricType = containerId.includes('omr-level') ? 'omr' :
                            containerId.includes('ta-level') ? 'ta' :
                            containerId.includes('bfr-level') ? 'bfr' :
                            containerId.includes('jmr-level') ? 'jmr' :
                            containerId.includes('waf-level') ? 'waf' :
                            containerId.includes('fr-level') ? 'fr' :
                            containerId.includes('cat-level') ? 'cat' :
                            containerId.includes('gp-level') ? 'gp' : 
                            containerId.includes('mr-level') ? 'mr' :'';
            
            if (metricType) {
                const data = levelData[metricType] || {};
                
                if (['omr', 'ta', 'bfr', 'jmr', 'gp', 'mr'].includes(metricType)) {
                    labels = [
                        'Very High',
                        'High',
                        'Moderate',
                        'Low',
                        'Very Low',
                        metricType === 'omr' || metricType === 'ta' ? 
                            'Technical Assessment Not Completed' : 'Data Not Available'
                    ];
                    
                    seriesData = [
                        data['Very High'] || 0,
                        data['High'] || 0,
                        data['Moderate'] || 0,
                        data['Low'] || 0,
                        data['Very Low'] || 0,
                        data[labels[5]] || 0
                    ];
                    
                    colors = ['#108585', '#1AC2C2', '#8CE3E3', '#FFDC92', '#FFC549', '#D3D3D3'];
                }
                else if (['waf', 'fr'].includes(metricType)) {
                    labels = [
                        'Very High Risk',
                        'High Risk',
                        'Moderate Risk',
                        'Low Risk',
                        'Very Low Risk',
                        'Data Not Available'
                    ];
                    
                    seriesData = [
                        data['Very High'] || 0,
                        data['High'] || 0,
                        data['Moderate'] || 0,
                        data['Low'] || 0,
                        data['Very Low'] || 0,
                        data['Data Not Available'] || 0
                    ];
                    
                    colors = ['#FF6355', '#FFC1BB', '#FFE4AA', '#7F66CA', '#54CF63', '#D3D3D3'];
                }
                else if (metricType === 'cat') {
                    labels = [
                        'High',
                        'Moderate',
                        'Low',
                        'Data Not Available'
                    ];
                    
                    seriesData = [
                        data['High'] || 0,
                        data['Moderate'] || 0,
                        data['Low'] || 0,
                        data['Data Not Available'] || 0
                    ];
                    
                    colors = ['#3FD0D0', '#54CF63', '#FFCD44', '#D3D3D3'];
                }
            }

            const options = {
                series: seriesData,
                chart: {
                    type: 'donut',
                    height: 250,
                    width: '100%',
                    toolbar: {
                        show: false
                    }
                },
                labels: labels,
                colors: colors, 
                dataLabels: { 
                    enabled: false 
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: 15
                                },
                                value: {
                                    show: true,
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    offsetY: -20,
                                    formatter: function(val) {
                                        return val;
                                    }
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Employees',
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif',
                                    color: '#4B5675',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        },
                        expandOnClick: true,
                        stroke: { width: 0 }
                    }
                },
                stroke: { 
                    show: true, 
                    colors: ['transparent'], 
                    width: 0 
                },
                legend: {
                    show: true,
                    position: 'right',
                    offsetY: 40,
                    formatter: function(seriesName, opts) {
                        const seriesValue = seriesData[opts.seriesIndex];
                        return `<div class="legend-item">
                                    <span class="label" style="color:#4B5675">${seriesName}</span>
                                    <span class="value" style="color:#78829D">${seriesValue}</span>
                                    <i class="bi bi-person"></i>
                                </div>`;
                    },
                    markers: {
                        width: 12,
                        height: 12,
                        strokeWidth: 0,
                        radius: 12,
                        offsetX: -5
                    },
                    itemMargin: {
                        horizontal: 0,
                        vertical: 5
                    }
                },
                title: {
                    text: title,
                    align: 'left',
                    style: {
                        fontSize: '14px',
                        color: '#4B5675',
                        fontWeight: 'bold'
                    },
                    margin: 20
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 250
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            return new ApexCharts(document.querySelector(`#${containerId}`), options);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.psychometric-filter-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;
                    const isVisible = dropdown.style.display === 'block';
                    
                    document.querySelectorAll('.psychometric-dropdown-menu').forEach(menu => {
                        if (menu !== dropdown) {
                            menu.style.display = 'none';
                        }
                    });
                    
                    // Toggle current dropdown
                    dropdown.style.display = isVisible ? 'none' : 'block';
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.psychometric-dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            });

            // Prevent dropdown from closing when clicking inside
            document.querySelectorAll('.psychometric-dropdown-menu').forEach(menu => {
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });

            // Checkbox selection for multiple levels
            document.querySelectorAll('.psychometric-custom-check-input').forEach(div => {
                div.addEventListener('click', function(e) {
                    // Don't trigger if clicking on the checkbox directly
                    if (e.target.tagName === 'INPUT') return;
                    
                    const checkbox = this.querySelector('input[type="checkbox"]');
                    if (!checkbox) return;
                    
                    // Toggle checkbox state
                    checkbox.checked = !checkbox.checked;
                    
                    updateSelectedLevels();
                });
            });

            // Handle direct checkbox clicks
            document.querySelectorAll('.psychometric-checkbox-input').forEach(checkbox => {
                checkbox.addEventListener('click', function(e) {
                    e.stopPropagation();
                    updateSelectedLevels();
                });
            });

            function updateSelectedLevels() {
                const targetButton = document.getElementById('psychometricPositionLevelChart');
                const checkboxes = document.querySelectorAll('.psychometric-checkbox-input:checked');
                const departmentGraph = document.querySelector('.aggregated-department-graph');
                
                // Configuration for display divs
                const displayConfig = [
                    // { 
                    //     id: 'selected-value-display1', 
                    //     idMainChart: 'overall-match-rate',
                    //     idLevelChart: 'omr-level',
                    //     chartName: 'Overall Match Rate'
                    // },
                    // { 
                    //     id: 'selected-value-display2', 
                    //     idMainChart: 'technical-assessment',
                    //     idLevelChart: 'ta-level',
                    //     chartName: 'Technical Assessment'
                    // },
                    { 
                        id: 'selected-value-display3', 
                        idMainChart: 'behavioral-fit-rate',
                        idLevelChart: 'bfr-level',
                        chartName: 'Behavioral Fit Rate'
                    },
                    { 
                        id: 'selected-value-display4', 
                        idMainChart: 'job-match-rate',
                        idLevelChart: 'jmr-level',
                        chartName: 'Job Match Rate'
                    },
                    { 
                        id: 'selected-value-display5', 
                        idMainChart: 'ssmr-rate',
                        idLevelChart: 'mr-level',
                        chartName: 'Soft Skills Match Rate',
                    },
                    { 
                        id: 'selected-value-display6', 
                        idMainChart: 'gp-rate',
                        idLevelChart: 'gp-level',
                        chartName: 'Growth Potential',
                    },
                    { 
                        id: 'selected-value-display7', 
                        idMainChart: 'workplace-alignment-forecast',
                        idLevelChart: 'waf-level',
                        chartName: 'Workplace Alignment Forecast'
                    },
                    { 
                        id: 'selected-value-display8', 
                        idMainChart: 'flight-risk',
                        idLevelChart: 'fr-level',
                        chartName: 'Flight Risk'
                    },
                    { 
                        id: 'selected-value-display9', 
                        idMainChart: 'cognitive-ability',
                        idLevelChart: 'cat-level',
                        chartName: 'Cognitive Ability',
                        isCat: true // Add identifier for CAT charts
                    },
                ];
                
                if (checkboxes.length > 4) {
                    checkboxes[checkboxes.length - 1].checked = false;
                    return;
                }
                
                if (checkboxes.length === 0) {
                    targetButton.querySelector('span').textContent = 'Position Level (Maximum 4 Levels)';
                    targetButton.classList.remove('psychometric-active-btn');
                    
                    displayConfig.forEach(config => {
                        document.getElementById(config.id).style.display = 'none';
                    });
                    
                    departmentGraph.style.display = 'block';
                } else {
                    // const selectedValues = Array.from(checkboxes).map(cb => cb.value.replace('Level ', ''));
                    // targetButton.querySelector('span').textContent = 'Level ' + selectedValues.join(',');
                    // targetButton.classList.add('psychometric-active-btn');

                    const selectedValues = Array.from(checkboxes).map(cb => cb.value.replace('Level ', '')); // ✅ You keep these for logic
    const selectedLabels = Array.from(checkboxes).map(cb => cb.getAttribute('data-label'));   // ✅ These are used for display

    targetButton.querySelector('span').textContent = selectedLabels.join(', '); // ✅ Human-friendly labels shown
    targetButton.classList.add('psychometric-active-btn');
                    
                    displayConfig.forEach((config) => {
                        const displayDiv = document.getElementById(config.id);
                        displayDiv.style.display = 'block';
                        
                        const existingLevelContainer = displayDiv.querySelector('.level-indicators-container');
                        if (existingLevelContainer) {
                            existingLevelContainer.remove();
                        }
                        
                        if (!displayDiv.querySelector(`.${config.idMainChart}`)) {
                            const sourceDiv = document.querySelector(`.${config.idMainChart}`);
                            if (sourceDiv) {
                                const clone = sourceDiv.cloneNode(true);
                                
                                const existingClone = displayDiv.querySelector(`.${config.idMainChart}`);
                                if (existingClone) {
                                    existingClone.remove();
                                }
                                
                                displayDiv.appendChild(clone);
                            }
                        }
                        
                        const levelContainer = document.createElement('div');
                        levelContainer.className = 'level-indicators-container';
                        levelContainer.style.display = 'grid';
                        levelContainer.style.gridTemplateColumns = 'repeat(2, 1fr)';
                        levelContainer.style.gap = '10px';
                        levelContainer.style.marginTop = '15px';
            
                        selectedValues.forEach(level => {
                            const existingChart = document.querySelector(`#${config.idLevelChart}-${level}`);
                        
                            if (!existingChart) {
                                const levelDiv = document.createElement('div');
                                levelDiv.id = `${config.idLevelChart}-${level}`;
                                levelDiv.style.minHeight = '200px';
                                levelDiv.style.padding = '15px';
                                levelDiv.style.backgroundColor = '#ffffff'; 
                                levelDiv.style.border = '0.5px solid #d3d3d3'; 
                                levelDiv.style.borderRadius = '10px'; 
                                levelDiv.style.boxShadow = '0 1px 2px rgba(0, 0, 0, 0.05)'; 
                        
                                const chartContainer = document.createElement('div');
                                chartContainer.id = `chart-${config.idLevelChart}-${level}`;
                                chartContainer.style.marginTop = '10px';
                        
                                levelDiv.appendChild(chartContainer);
                        
                                // ⚡ ADD THIS: append to levelContainer
                                levelContainer.appendChild(levelDiv);
                        
                                const levelData = chartPositionLevelGroup[level] || {};
                        
                                // setTimeout(() => {
                                //     let chartTitle;
                                //     if (config.isCat) {
                                //         const positionLevelMap = {
                                //             '1': 'Position Level 1',
                                //             '2': 'Position Level 2',
                                //             '3': 'Position Level 3',
                                //             '4': 'Position Level 4'
                                //         };
                                //         chartTitle = `Cognitive Ability - ${positionLevelMap[level] || `Level ${level}`}`;
                                //     } else {
                                //         chartTitle = `${config.chartName} - Position Level ${level}`;
                                //     }
                        
                                //     const chart = createBasicApexChart(
                                //         `chart-${config.idLevelChart}-${level}`, 
                                //         chartTitle,
                                //         levelData
                                //     );
                                //     chart.render();
                                // }, 0);

                                setTimeout(() => {
                                    let chartTitle;

                                    const levelName = positionLevelMap[level] || `Level ${level}`;

                                    if (config.isCat) {
                                        chartTitle = `${levelName}`;
                                        // chartTitle = `Cognitive Ability - ${levelName}`;
                                    } else {
                                        // chartTitle = `${config.chartName} - ${levelName}`;
                                        chartTitle = `${levelName}`;
                                    }

                                    const chart = createBasicApexChart(
                                        `chart-${config.idLevelChart}-${level}`, 
                                        chartTitle,
                                        levelData
                                    );
                                    chart.render();
                                }, 0);

                            }
                        });
                        
                        
                        displayDiv.appendChild(levelContainer);
                    });
                    
                    departmentGraph.style.display = 'none';
                }
                
                document.querySelectorAll('.psychometric-custom-check-input').forEach(div => {
                    const cb = div.querySelector('input[type="checkbox"]');
                    if (cb && cb.checked) {
                        div.classList.add('active');
                    } else {
                        div.classList.remove('active');
                    }
                });
            }

            // Reset button
            document.querySelectorAll('.psychometric-resetBtn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const target = this.dataset.target;
                    const menu = this.closest('.psychometric-dropdown-menu');
                    const targetButton = document.getElementById(target);
                    
                    if (!menu || !targetButton) return;
                    
                    // Uncheck all checkboxes
                    menu.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                        cb.checked = false;
                    });
                    
                    // Remove active classes
                    menu.querySelectorAll('.psychometric-custom-check-input').forEach(item => {
                        item.classList.remove('active');
                    });
                    
                    // Reset button text
                    targetButton.querySelector('span').textContent = 'Position Level (Maximum 4 Levels)';
                    targetButton.classList.remove('psychometric-active-btn');
                    
                    // Hide all display divs
                    [
                        'selected-value-display1',
                        'selected-value-display2',
                        'selected-value-display3',
                        'selected-value-display4',
                        'selected-value-display5',
                        'selected-value-display6',
                        'selected-value-display7',
                        'selected-value-display8',
                        'selected-value-display9',

                    ].forEach(id => {
                        document.getElementById(id).style.display = 'none';
                    });
                    
                    document.querySelector('.aggregated-department-graph').style.display = 'block';
                });
            });

            // Filter button
            document.querySelectorAll('.psychometric-filter').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    this.closest('.psychometric-dropdown-menu').style.display = 'none';
                });
            });

        });

        function psychometricFilterEmployees() {
            const searchTerm = document.getElementById('psychometricSearchEmployeeInput').value.toLowerCase();
            console.log('Searching for:', searchTerm);
        }

        //End of Position Level Filter

        function renderPositionLevelD3Chart(positionLevelData) {
    var svg = d3.select("#chart");
    svg.selectAll("*").remove();

    if (!positionLevelData || positionLevelData.length === 0) {
        svg.append("text")
            .attr("x", +svg.attr("width") / 2)
            .attr("y", +svg.attr("height") / 2)
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "middle")
            .attr("fill", "#000000")
            .style("font-size", "16px")
            .text("No data");
        return;
    }

    var margin = { top: 10, right: 80, bottom: 40, left: 63 };  // left margin increased for icon
    var width = +svg.attr("width") - margin.left - margin.right;
    var height = +svg.attr("height") - margin.top - margin.bottom;

    var colorMap = {
        1: "#FCCF98",
        2: "#FABB6E",
        3: "#F9A845",
        4: "#F7941C",
        5: "#F57C00",
        6: "#E65100",
        7: "#E65100",
        8: "#E65100",
        9: "#E65100",
        10: "#E65100",
        11: "#E65100",
        12: "#E65100",
        13: "#E65100",
        14: "#E65100",
        15: "#E65100"
    };

    var x = d3.scaleLinear()
        .domain([0, d3.max(positionLevelData, d => d.user_count)])
        .range([0, width]);

    var y = d3.scaleBand()
        .domain(positionLevelData.map(d => d.level))
        .range([0, height])
        .padding(0.1);

    var g = svg.append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Hide default y-axis labels and ticks
    var yAxis = d3.axisLeft(y)
        .tickSize(0)
        .tickFormat("");  // No label rendered

    g.append("g")
        .attr("class", "y-axis")
        .call(yAxis);

        g.selectAll(".y-axis .domain").remove();

    // Add custom labels with icon + number
    // Place them where the y-axis ticks would be
    var labelG = svg.append('g')
        .attr('transform', `translate(${margin.left - 60},${margin.top})`); // Shift left for icons

    positionLevelData.forEach(function(d) {
        labelG.append('foreignObject')
            .attr('x', 0)
            .attr('y', y(d.level) + y.bandwidth() / 2 - 16) // center vertically
            .attr('width', 60)
            .attr('height', 32)
            .append('xhtml:div')
            .style('display', 'flex')
            .style('align-items', 'center')
            .html(
                `<img src="/admin/media/svg/org-chart-svg/position-level.svg" 
                      alt="Position Level" 
                      style="width:20px;height:20px;margin-right:8px;">
                 <span style="font-size:16px;color:#444;">${d.level}</span>`
            );
    });

    // Draw bars
    g.selectAll(".bar")
        .data(positionLevelData)
        .enter().append("rect")
        .attr("class", "bar")
        .attr("y", d => y(d.level))
        .attr("width", d => x(d.user_count))
        .attr("height", y.bandwidth())
        .attr("fill", d => colorMap[d.level] || "#f7931e")
        .attr("rx", 4);

    // User count & icon label at the end of bars
    g.selectAll(".custom-label")
        .data(positionLevelData)
        .enter().append("foreignObject")
        .attr("class", "custom-label")
        .attr("width", 50)
        .attr("height", 30)
        .attr("x", d => x(d.user_count) + 10)
        .attr("y", d => y(d.level) + y.bandwidth() / 2 - 10)
        .append("xhtml:div")
        .attr("class", "label-group")
        .style('display', 'flex')
        .style('align-items', 'center')
        .html(d => `${d.user_count} &nbsp; <i class="bi bi-person custom-icon"></i>`);
}


        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();
            function cb(start, end, label) {
                var range = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');
                $('#reportrange span').html(label + ': ' + range);
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'Last 90 Days': [moment().subtract(89, 'days'), moment()],
                    'This Week': [moment().startOf('week'), moment().endOf('week')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().endOf('month')]
                }
            }, cb);
            cb(start, end, 'Last 30 Days');
        });

        document.querySelectorAll('.filter-color-label').forEach(label => {
            label.addEventListener('click', function() {
                const bfr = this.dataset.bfr;
                document.querySelector('.filter-color-label.active')?.classList.remove('active');
                this.classList.add('active');
                updateFilters();

                const bfrLevel = this.dataset.bfr;
                let color, title;

                switch (bfrLevel) {
                    case 9:
                        color = '#F6E54B';
                        title = 'Trusted Professional';
                        break;
                    case 8:
                        color = '#F2B948';
                        title = 'Valued Contributor';
                        break;
                    case 7:
                        color = '#E66C6C';
                        title = 'Lower Performance';
                        break;
                    case 6:
                        color = '#7DC76F';
                        title = 'Emerging Talent';
                        break;
                    case 5:
                        color = '#F6E54B';
                        title = 'Solid Contributor';
                        break;
                    case 4:
                        color = '#F2B948';
                        title = 'Inconsistent Performer';
                        break;
                    case 3:
                        color = '#34792F';
                        title = 'Next Gen Leader';
                        break;
                    case 2:
                        color = '#7DC76F';
                        title = 'Rising Star';
                        break;
                    case 1:
                        color = '#F6E54B';
                        title = 'Emerging Performer';
                        break;
                    default:
                        color = '#000';
                        title = 'All';
                        break;
                }

                $('.grid-title').text(title);
                $('.title-color-label').css('background-color', color);
            });
        });

        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateFilters();
            });
        });

        document.querySelector('.switch').addEventListener('change', function() {
            toggleHighPotential(this.checked);
        });

        document.querySelector('.searchTerm').addEventListener('input', function() {
            updateFilters();
        });

        function updateFilters() {
            const activeFilterColorLabel = document.querySelector('.filter-color-label.active');
            const bfr = activeFilterColorLabel ? activeFilterColorLabel.dataset.bfr : null;

            const selectedLevels = Array.from(document.querySelectorAll('.filter-checkbox:checked'))
                                        .map(checkbox => checkbox.dataset.level);

            const searchTerm = document.querySelector('.searchTerm').value.toLowerCase();

            const selectedPosition = document.getElementById('sub-department-dropdown').value;

            const profiles = document.querySelectorAll('.employee-profile');
            const columnTitles = document.querySelectorAll('.column-title');

            let profileCount = 0;

            columnTitles.forEach(columnTitle => {
                const columnBfr = columnTitle.dataset.bfr;
                const matchesBfr = bfr ? columnBfr == bfr : true;

                if (matchesBfr) {
                    columnTitle.style.display = 'block';
                } else {
                    columnTitle.style.display = 'none';
                }
            });

            profiles.forEach(profile => {
                const profileBfr = profile.dataset.bfr;
                const profileLevel = profile.dataset.level;
                const profileName = profile.querySelector('.profile-name').textContent.toLowerCase();
                const profilePosition = profile.dataset.position;

                const matchesBfr = bfr ? profileBfr == bfr : true;
                const matchesLevel = selectedLevels.length ? selectedLevels.includes(profileLevel) : true;
                const matchesSearch = profileName.includes(searchTerm);
                const matchesPosition = selectedPosition ? profilePosition == selectedPosition : true;

                if (matchesBfr && matchesLevel && matchesSearch && matchesPosition) {
                    profile.style.display = 'block';
                    profileCount++;
                } else {
                    profile.style.display = 'none';
                }
            });

            const noResultsMessage = document.querySelector('.no-results');
            if (profileCount === 0) {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
        }

        function toggleHighPotential(show) {
            document.querySelectorAll('.high-potential').forEach(element => {
                if (show) {
                    element.style.display = 'flex';
                } else {
                    element.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const switchElement = document.querySelector('.switch');
            toggleHighPotential(switchElement.checked);

            updateFilters();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const originalStates = {};
            document.querySelectorAll('.column-title').forEach((columnTitle) => {
                const bfrLevel = columnTitle.getAttribute('data-bfr');
                const gridTitle = columnTitle.querySelector('.grid-title');
                const titleColorLabel = columnTitle.querySelector('.title-color-label');
                originalStates[bfrLevel] = {
                    title: gridTitle.innerText,
                    color: titleColorLabel.style.backgroundColor
                };
            });

            function clearFilter() {
                document.querySelector('.filter-color-label.active')?.classList.remove('active');
                document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
            
                document.querySelector('.searchTerm').value = '';
            
                document.querySelectorAll('.employee-profile').forEach(profile => {
                    profile.style.display = 'block';
                });
            
                document.querySelectorAll('.column-title').forEach(columnTitle => {
                    columnTitle.style.display = 'block';
                });
            
                document.querySelectorAll('.column-title').forEach((columnTitle) => {
                    const bfrLevel = columnTitle.getAttribute('data-bfr');
                    const gridTitle = columnTitle.querySelector('.grid-title');
                    const titleColorLabel = columnTitle.querySelector('.title-color-label');
                    const originalState = originalStates[bfrLevel];
                    gridTitle.innerText = originalState.title;
                    titleColorLabel.style.backgroundColor = originalState.color;
                });
            
                updateFilters();
            }

            document.querySelector('#clear-filter').addEventListener('click', clearFilter);
        });


        document.querySelectorAll('.filter-color-label').forEach(label => {
            label.addEventListener('click', function() {
                const bfr = this.dataset.bfr;
                document.querySelector('.filter-color-label.active')?.classList.remove('active');
                this.classList.add('active');
                updateFilters();
            });
        });

        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateFilters();
            });
        });

        document.querySelector('.switch').addEventListener('change', function() {
            toggleHighPotential(this.checked);
        });

        document.querySelector('.searchTerm').addEventListener('input', function() {
            updateFilters();
        });

        document.getElementById('clear-filter').addEventListener('click', function() {
            clearFilter();
        });

        const buttons = document.getElementsByClassName('view-full-details-btn');

        Array.from(buttons).forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const activeFilter = document.querySelector('.filter-color-label.active');
                const idLevel = activeFilter ? activeFilter.dataset.id : null;

                if (idLevel) {
                    window.location.href = `/admin/talent/insight?data_id=${encodeURIComponent(idLevel)}`;
                } else {
                    alert('Please select a 9-Grid filter before viewing full details.');
                }
            });
        });

        const infoIcon = document.getElementById('infoIcon');
        const popupModal = document.getElementById('popupModal');
        const closeModal = document.getElementById('closeModal');

        infoIcon.addEventListener('click', () => {
            popupModal.style.display = 'flex';
        });

        closeModal.addEventListener('click', () => {
            popupModal.style.display = 'none';
        });

        popupModal.addEventListener('click', (event) => {
            if (event.target === popupModal) {
            popupModal.style.display = 'none';
            }
        });

        $(document).ready(function () {
            $(".title-info").hover(
                function () {
                    const bfrLevel = $(this).data("bfr");
                    const dropdown = $("#dropdown-" + bfrLevel);
                    const parent = $(this).closest(".column-title");

                    dropdown.css({
                        display: "block",
                        bottom: parent.height() + 3 + "px", 
                        left: $(this).position().left + "px"
                    });
                },
                function () {
                    const bfrLevel = $(this).data("bfr");
                    $("#dropdown-" + bfrLevel).css("display", "none");
                }
            );
        });

        function initializeEmployeeCardDropdowns() {
            // Avoid double-binding
            document.querySelectorAll('.profile-drop-toggle1').forEach(toggle => {
                toggle.removeEventListener('click', toggle._dropdownHandler);
                
                const handler = function(e) {
                    e.stopPropagation();
                    const dropdownMenu = this.nextElementSibling;

                    if (dropdownMenu && dropdownMenu.classList.contains('profile-dropdown-menu')) {
                        document.querySelectorAll('.profile-dropdown-menu').forEach(menu => {
                            if (menu !== dropdownMenu) menu.classList.remove('show');
                        });
                        dropdownMenu.classList.toggle('show');
                    }
                };

                toggle.addEventListener('click', handler);
                toggle._dropdownHandler = handler;
            });

            document.querySelectorAll('.profile-dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (item.classList.contains('send-email')) return;

                    e.preventDefault();
                    const id = item.getAttribute('data-id');

                    if (item.classList.contains('view-profile')) {
                        window.location.href = `/admin/employee-details/${id}?page=overview`;
                    } else if (item.classList.contains('edit-profile')) {
                        window.location.href = `/admin/myemployee/${id}/edit`;
                    }

                    const menu = item.closest('.profile-dropdown-menu');
                    if (menu) menu.classList.remove('show');
                });
            });

            // Global outside click to close
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.profile-drop-toggle1') && !e.target.closest('.profile-dropdown-menu')) {
                    document.querySelectorAll('.profile-dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });
        }

    </script>

    
@endsection
