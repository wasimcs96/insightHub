@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
{{-- @endsection --}}
@section('title', 'Setting - Job Descriptions')
{{-- @endsection --}}
@section('styles')


    <style>
        .app-wrapper {
            margin-top: 130px !important;
        }

        .app-content {
            padding-top: 15px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .nav-link {
            padding: 16px !important;
            margin: 0px !important;
        }

        .profile-card {
            padding: 39px 24px 0px !important
        }

        .mb-11 {
            margin-bottom: 36px !important;
        .app-wrapper {
            margin-top: 130px !important;
        }

        .app-content {
            padding-top: 15px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .nav-link {
            padding: 16px !important;
            margin: 0px !important;
        }

        .profile-card {
            padding: 39px 24px 0px !important
        }

        .mb-11 {
            margin-bottom: 36px !important;
        }

        .gap-7 {
            gap: 24px !important;
        }

        .gap-4 {
            gap: 16px !important;
        }

        .psych-inner,
        .psych-inner-2,
        .psych-inner-3 {
            padding: 30px 40px 45px 40px;
        }

        .table-status {
            border-radius: 15px;
            padding: 4px 12px;
        .gap-7 {
            gap: 24px !important;
        }

        .gap-4 {
            gap: 16px !important;
        }

        .psych-inner,
        .psych-inner-2,
        .psych-inner-3 {
            padding: 30px 40px 45px 40px;
        }

        .table-status {
            border-radius: 15px;
            padding: 4px 12px;
            width: max-content;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
        }

        .high {
            background-color: #DDF5E2;
            color: #196329;
        }

        .moderate {
            background-color: #FFEBB4;
            color: #EB8100;
        }

        .btn-primary,
        .btn-light {
            padding: 14px 20px;
            border-radius: 4px;
            border: 1px solid #F7941C !important;
        }

        .btn-primary {
            color: #fff !important;
        }

        .btn-light {
            color: #F7941C !important;
            background: #FFF !important;
        }

        .psych-inner-2 .inner-table {
            grid-template-columns: 44.6% 36%;
            gap: 70px;
        }


        .psych-inner-3 .inner-table {
            grid-template-columns: 47.2% 47.2%;
            gap: 30px;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
        }

        .high {
            background-color: #DDF5E2;
            color: #196329;
        }

        .moderate {
            background-color: #FFEBB4;
            color: #EB8100;
        }

        .btn-primary,
        .btn-light {
            padding: 14px 20px;
            border-radius: 4px;
            border: 1px solid #F7941C !important;
        }

        .btn-primary {
            color: #fff !important;
        }

        .btn-light {
            color: #F7941C !important;
            background: #FFF !important;
        }

        .psych-inner-2 .inner-table {
            grid-template-columns: 44.6% 36%;
            gap: 70px;
        }


        .psych-inner-3 .inner-table {
            grid-template-columns: 47.2% 47.2%;
            gap: 30px;
        }

        .side-line-orange {
            padding-left: 15px;
            border-left: 2px solid #FABB6E;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        }

        .left-table-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
        .side-line-orange {
            padding-left: 15px;
            border-left: 2px solid #FABB6E;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        }

        .left-table-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 4px;
            gap: 5px;
            margin-bottom: 4px;
        }

        .left-table-head p {
            margin-bottom: 5px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        .left-table-head p {
            margin-bottom: 5px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .progress-container {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
            height: 16px;
            background-color: #f0f0f0;
            position: relative;
            display: table;
            border-collapse: collapse;
        }

        .progress-fill {
            display: table-row;
        }

        .progress-segment {
            display: table-cell;
            height: 16px;
        }

        .segment-yellow,
        .segment-orange,
        .segment-blue {
            width: 33.33%;
        }

        .segment-yellow {
            background-color: #FFD76A;
        }

        .segment-orange {
            background-color: #99E2A8;
        }

        .segment-blue {
            background-color: #65DADA;
        }

        .progress-circle {
            position: absolute;
            top: 60%;
            transform: translate(398px, -50%);
        .progress-container {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
            height: 16px;
            background-color: #f0f0f0;
            position: relative;
            display: table;
            border-collapse: collapse;
        }

        .progress-fill {
            display: table-row;
        }

        .progress-segment {
            display: table-cell;
            height: 16px;
        }

        .segment-yellow,
        .segment-orange,
        .segment-blue {
            width: 33.33%;
        }

        .segment-yellow {
            background-color: #FFD76A;
        }

        .segment-orange {
            background-color: #99E2A8;
        }

        .segment-blue {
            background-color: #65DADA;
        }

        .progress-circle {
            position: absolute;
            top: 60%;
            transform: translate(398px, -50%);
        }

        .line-grey {
            background-color: #e6e6e6;
        .line-grey {
            background-color: #e6e6e6;
            position: relative;
            margin-top: 15px;
            width: 100%;
            height: 15px;
            background: #EBEBEB;
        }

        .ocean-grey {
            margin-top: 14.4px;
            height: 21.28px;

        }

        .ocean-orange {
            height: 21.28px !important;
        }

        .line-orange {
            height: 15px;
            margin-top: 15px;
            width: 100%;
            height: 15px;
            background: #EBEBEB;
        }

        .ocean-grey {
            margin-top: 14.4px;
            height: 21.28px;

        }

        .ocean-orange {
            height: 21.28px !important;
        }

        .line-orange {
            height: 15px;
        }

        .fade-orange {
            background: #FABB6E;
        }

        .dark-orange {
            background: #F7941C;
        }

        .svg-round-icon {
        .fade-orange {
            background: #FABB6E;
        }

        .dark-orange {
            background: #F7941C;
        }

        .svg-round-icon {
            position: absolute;
            bottom: -0.701px;
            top: 13%;
            bottom: -0.701px;
            top: 13%;
            transform: translateY(-50%);
        }

        .line {
            border-radius: 7.14px;
        }

        .line-bottom {
            background: #E1E1E1;
            width: 100%;
            height: 1px;
        }

        .tweleve-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: normal;
            margin-bottom: 15px;
        }

        .tweleve-desc {
            color: #5B5B5B;
        .line {
            border-radius: 7.14px;
        }

        .line-bottom {
            background: #E1E1E1;
            width: 100%;
            height: 1px;
        }

        .tweleve-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: normal;
            margin-bottom: 15px;
        }

        .tweleve-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8.4px;
        }

        .tweleve-desc img {
            margin-right: 5px;
            position: relative;
            top: 2px;
        }

        .skill-table {
            display: grid;
            gap: 30px;
        }

        .skill-table .table-desc {
            margin: 0;
        }

        .orange-bg {
            padding: 10px 10px 10px 15px;
            background: #FFF6EA;
            border-left: 2px solid #FABB6E;
            font-weight: 600;
            margin-bottom: 8.4px;
        }

        .tweleve-desc img {
            margin-right: 5px;
            position: relative;
            top: 2px;
        }

        .skill-table {
            display: grid;
            gap: 30px;
        }

        .skill-table .table-desc {
            margin: 0;
        }

        .orange-bg {
            padding: 10px 10px 10px 15px;
            background: #FFF6EA;
            border-left: 2px solid #FABB6E;
        }

        .orange-bg .table-desc {
            margin: 0;
        .orange-bg .table-desc {
            margin: 0;
        }

        .work-right-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: 22px;
        }

        .work-orange {
            color: #F7941C;
            font-size: 36px;
            font-weight: 500;
            line-height: normal;
            margin: 12.8px 0px 6.4px 0px;
        }

        .bg-white {
            border-radius: 8px;
            background: #F1F1F4;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .inner-table {
            display: grid;
            grid-template-columns: 62% 32%;
            gap: 30px;
            align-items: center;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        .work-right-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: 22px;
        }

        .work-orange {
            color: #F7941C;
            font-size: 36px;
            font-weight: 500;
            line-height: normal;
            margin: 12.8px 0px 6.4px 0px;
        }

        .bg-white {
            border-radius: 8px;
            background: #F1F1F4;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .inner-table {
            display: grid;
            grid-template-columns: 62% 32%;
            gap: 30px;
            align-items: center;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        }

        .right-bot {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            display: table;
            margin: 7px 0px;

        }

        .right-bot span {
            padding: 2.626px 6.795px;
            position: relative;
            left: 7px;
            border-radius: 5.421px;
            background: #F7941C;
            color: #FFF;
            font-size: 9px;
            line-height: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .purple,
        .cyan,
        .orange,
        .spring {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
        }

        .purple span,
        .cyan span,
        .orange span,
        .green span,
        .spring span {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .green span {
            color: #218336 !important;
            background: #BBECC5 !important;
        }

        .purple {
            color: #7F66CA;
        }

        .purple span {
            background: #E1D8FB;
            color: #7F66CA !important;
        }

        .cyan {
            color: #108585;
        }

        .cyan span {
            background: #B2ECEC;
            color: #108585 !important;
        }

        .orange {
            color: #F7941C;
        }

        .orange span {
            background: #FDE2C1;
            color: #F7941C !important;
        }

        .spring {
            color: #E39B00;
        }

        .spring span {
            color: #E39B00;
            background: #FFEBB4 !important;
        }

        .skill-table-button {
            padding: 8px 15px;
            color: #F7941C;
            font-size: 14.3px;
            font-weight: 400;
            line-height: normal;
            background: #fff;
            border: 1px solid;
            border-radius: 4.4px;
            display: flex;
            margin: auto;
            margin-top: 60px;
        }

        .moderate-icon-yellow {
            font-weight: 600;
            width: 12px;
            height: 12px;
            transform: rotate(45deg);
            background: #FFCD44;
            margin-right: 10px;
            margin-top: 4px;
        .right-bot {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            display: table;
            margin: 7px 0px;

        }

        .right-bot span {
            padding: 2.626px 6.795px;
            position: relative;
            left: 7px;
            border-radius: 5.421px;
            background: #F7941C;
            color: #FFF;
            font-size: 9px;
            line-height: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .purple,
        .cyan,
        .orange,
        .spring {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
        }

        .purple span,
        .cyan span,
        .orange span,
        .green span,
        .spring span {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .green span {
            color: #218336 !important;
            background: #BBECC5 !important;
        }

        .purple {
            color: #7F66CA;
        }

        .purple span {
            background: #E1D8FB;
            color: #7F66CA !important;
        }

        .cyan {
            color: #108585;
        }

        .cyan span {
            background: #B2ECEC;
            color: #108585 !important;
        }

        .orange {
            color: #F7941C;
        }

        .orange span {
            background: #FDE2C1;
            color: #F7941C !important;
        }

        .spring {
            color: #E39B00;
        }

        .spring span {
            color: #E39B00;
            background: #FFEBB4 !important;
        }

        .skill-table-button {
            padding: 8px 15px;
            color: #F7941C;
            font-size: 14.3px;
            font-weight: 400;
            line-height: normal;
            background: #fff;
            border: 1px solid;
            border-radius: 4.4px;
            display: flex;
            margin: auto;
            margin-top: 60px;
        }

        .moderate-icon-yellow {
            font-weight: 600;
            width: 12px;
            height: 12px;
            transform: rotate(45deg);
            background: #FFCD44;
            margin-right: 10px;
            margin-top: 4px;
        }

        .second-container {
            display: grid;
            grid-template-columns: 60% 32%;
        }

        /* Container Styling */
        .chart-container {
            position: relative;
            width: 270px;
            height: 270px;
            margin: auto;
        }

        /* Circular Chart Rotation */
        .circular-chart {
            transform: rotate(-90deg);
            /* Starts the chart from the top */
            margin: auto;
            display: block;
        }

        /* Chart Labels */
        .chart-label {
            position: absolute;
            text-align: center;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            background: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
        }

        .correct-label,
        .wrong-label,
        .missed-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .correct-label {
            top: 15%;
            left: 46%;
            background-color: #E2F6F6;
            color: #108585;

        }

        .wrong-label {
            top: 36%;
            right: 51%;
            background-color: #FFF6EA;
            color: #CE7B17;
        }

        /* Missed Label */
        .missed-label {
            bottom: 11%;
            left: 47%;
            background-color: #F2EEFD;
            color: #6652A1;
        }


        .circle-second-div p {
            color: #5B5B5B;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            align-items: center;
            margin-top: 13.44px;
            display: flex;
        }

        .circle-second-div span {
            width: 30.484px;
            height: 8.803px;
            position: relative;
            right: 7.17px;
        }

        .correct {
            background: #8CE3E3;
        }

        .wrong {
            background: #FFDC92;
        }

        .missed {
            background: #BBA7F6;
        }

        .succession-head {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .succession-head p {
            color: #1E1E1E;
            font-size: 19.2px;
            font-style: normal;
            font-weight: 500;
            line-height: 28.8px;
            letter-spacing: 0.18px;
            margin: 0;
        }

        .success-chart {
            color: #B7B7B7;
            font-size: 28px;
        }

        .card {
            border-radius: 4px;
            justify-content: space-between;
        }

        .card-orange {
            border: 2px solid #F7941C;
        }

        .card-cyan {
            border: 2px solid #1AC2C2;
        }

        .card-pink {
            border: 2px solid #FF2E2E;
        }

        .line-chart {
            font-size: 24px;
            color: #F5872B;
        }

        .s-top-right {
            display: flex;
            align-items: center;
        }

        .s-top-right a {
            color: #99A1B7;
        }

        .three-dots {
            font-size: 18px;
        }

        .s-top-right span {
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 11px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-yellow-right {
            background: #FFEBB4;
            color: #806210;
        }

        .s-green-right {
            background: #BBECC5;
            color: #196329;
        }

        .s-pink-right {
            background: #FCE4EC;
            color: #880E4F;
        }

        .s-head-span span {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-current {
            background: #FEF2E2;
            color: #CE7B17;
        }

        .s-career-goal {
            background: #E2F6F6;
            color: #108585;
        }
        .second-container {
            display: grid;
            grid-template-columns: 60% 32%;
        }

        /* Container Styling */
        .chart-container {
            position: relative;
            width: 270px;
            height: 270px;
            margin: auto;
        }

        /* Circular Chart Rotation */
        .circular-chart {
            transform: rotate(-90deg);
            /* Starts the chart from the top */
            margin: auto;
            display: block;
        }

        /* Chart Labels */
        .chart-label {
            position: absolute;
            text-align: center;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            background: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
        }

        .correct-label,
        .wrong-label,
        .missed-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .correct-label {
            top: 15%;
            left: 46%;
            background-color: #E2F6F6;
            color: #108585;

        }

        .wrong-label {
            top: 36%;
            right: 51%;
            background-color: #FFF6EA;
            color: #CE7B17;
        }

        /* Missed Label */
        .missed-label {
            bottom: 11%;
            left: 47%;
            background-color: #F2EEFD;
            color: #6652A1;
        }


        .circle-second-div p {
            color: #5B5B5B;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            align-items: center;
            margin-top: 13.44px;
            display: flex;
        }

        .circle-second-div span {
            width: 30.484px;
            height: 8.803px;
            position: relative;
            right: 7.17px;
        }

        .correct {
            background: #8CE3E3;
        }

        .wrong {
            background: #FFDC92;
        }

        .missed {
            background: #BBA7F6;
        }

        .succession-head {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .succession-head p {
            color: #1E1E1E;
            font-size: 19.2px;
            font-style: normal;
            font-weight: 500;
            line-height: 28.8px;
            letter-spacing: 0.18px;
            margin: 0;
        }

        .success-chart {
            color: #B7B7B7;
            font-size: 28px;
        }

        .card {
            border-radius: 4px;
            justify-content: space-between;
        }

        .card-orange {
            border: 2px solid #F7941C;
        }

        .card-cyan {
            border: 2px solid #1AC2C2;
        }

        .card-pink {
            border: 2px solid #FF2E2E;
        }

        .line-chart {
            font-size: 24px;
            color: #F5872B;
        }

        .s-top-right {
            display: flex;
            align-items: center;
        }

        .s-top-right a {
            color: #99A1B7;
        }

        .three-dots {
            font-size: 18px;
        }

        .s-top-right span {
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 11px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-yellow-right {
            background: #FFEBB4;
            color: #806210;
        }

        .s-green-right {
            background: #BBECC5;
            color: #196329;
        }

        .s-pink-right {
            background: #FCE4EC;
            color: #880E4F;
        }

        .s-head-span span {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-current {
            background: #FEF2E2;
            color: #CE7B17;
        }

        .s-career-goal {
            background: #E2F6F6;
            color: #108585;
        }

        .s-head-content p {
            font-size: 12px;
            color: #757575;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        .s-head-content p {
            font-size: 12px;
            color: #757575;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .s-green-text {
        .s-green-text {
            display: flex;
            align-items: center;
            flex-flow: wrap;
            gap: 8px;
            align-items: center;
            flex-flow: wrap;
            gap: 8px;
        }

        .s-green-text div {
            padding: 8px 16px;
            border-radius: 80px;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-green-btn {
            background: #DDF5E2;
            color: #218336;
        }

        .s-yellow-btn {
            background: #FFF3E0;
            color: #975102;
        }

        .s-more-skill-btn {
            padding: 8px 16px;
            border-radius: 80px;
            border: 1px solid #99A1B7;
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            width: fit-content;
        .s-green-text div {
            padding: 8px 16px;
            border-radius: 80px;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-green-btn {
            background: #DDF5E2;
            color: #218336;
        }

        .s-yellow-btn {
            background: #FFF3E0;
            color: #975102;
        }

        .s-more-skill-btn {
            padding: 8px 16px;
            border-radius: 80px;
            border: 1px solid #99A1B7;
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            width: fit-content;
        }

        .s-more-info-btn {
            border-top: 1px solid rgba(217, 217, 217, 0.50);
            display: flex;
            padding: 8px 8px 8px 12px;
            justify-content: center;
            color: #757575;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            letter-spacing: 0.4px;
            align-items: center;
        .s-more-info-btn {
            border-top: 1px solid rgba(217, 217, 217, 0.50);
            display: flex;
            padding: 8px 8px 8px 12px;
            justify-content: center;
            color: #757575;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            letter-spacing: 0.4px;
            align-items: center;
        }

        .star {
            font-size: 16px;
            color: #F3AC60;
        }

        .s-info-btn {
            font-size: 18px;
        }

        .career-path-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        .star {
            font-size: 16px;
            color: #F3AC60;
        }

        .s-info-btn {
            font-size: 18px;
        }

        .career-path-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .career-path-head button {
            padding: 8px 8px 8px 12px;
            border-radius: 4px;
            background: #F5872B;
            color: #FFF;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            align-items: center;
            display: flex;
            gap: 8px;
        .career-path-head button {
            padding: 8px 8px 8px 12px;
            border-radius: 4px;
            background: #F5872B;
            color: #FFF;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            align-items: center;
            display: flex;
            gap: 8px;
        }

        .career-map-icon {
        .career-map-icon {
            font-size: 24px;
        }

        .path-top-text {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 17px;
        }

        .path-top-text {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 17px;
        }

        .path-top-text p {
        .path-top-text p {
            color: #071437;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 500;
            line-height: 21.06px;
        }

        .bar-career {
            width: 73px;
            height: 10px;
            background-color: #e3e6ed;
            border-radius: 10px;
            overflow: hidden;
        }

        .bar {
            height: 10px;
            background-color: #f08a3a;
            border-radius: 10px 0 0 10px;
        }

        .kpi-side-dropdown-btn {
            display: flex;
            min-width: 210px;
            padding: 6px 0px 6px 16px;
            align-items: center;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
        }

        .kpi-calender {
            color: #F7941C;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 500;
            line-height: 21.06px;
        }

        .bar-career {
            width: 73px;
            height: 10px;
            background-color: #e3e6ed;
            border-radius: 10px;
            overflow: hidden;
        }

        .bar {
            height: 10px;
            background-color: #f08a3a;
            border-radius: 10px 0 0 10px;
        }

        .kpi-side-dropdown-btn {
            display: flex;
            min-width: 210px;
            padding: 6px 0px 6px 16px;
            align-items: center;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
        }

        .kpi-calender {
            color: #F7941C;
            font-size: 16px;
        }

        .kp-select {
            color: #1E1E1E;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            border: none;
            padding: 0;
            width: 170px;
        }

        #kt_tab_pane_3 table {
            width: 100%;
            border-collapse: collapse;
        }

        #kt_tab_pane_3 thead th {
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            padding: 8px;
        }

        #kt_tab_pane_3 tbody td {
            text-align: left;
            padding: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #4B5675;
        }

        #kt_tab_pane_3 tbody tr:nth-child(odd) {
            background-color: #FAFAFB;
        }

        .kpi-inner {
            grid-template-columns: 20% 76%;
        }

        .sd-table-bot,
        .sd-table-bot-total {
        }

        .kp-select {
            color: #1E1E1E;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            border: none;
            padding: 0;
            width: 170px;
        }

        #kt_tab_pane_3 table {
            width: 100%;
            border-collapse: collapse;
        }

        #kt_tab_pane_3 thead th {
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            padding: 8px;
        }

        #kt_tab_pane_3 tbody td {
            text-align: left;
            padding: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #4B5675;
        }

        #kt_tab_pane_3 tbody tr:nth-child(odd) {
            background-color: #FAFAFB;
        }

        .kpi-inner {
            grid-template-columns: 20% 76%;
        }

        .sd-table-bot,
        .sd-table-bot-total {
            color: #071437;
            font-style: normal;
            text-align: right;
            padding: 8px;

        }

        .sd-table-bot {
            font-weight: 600;
            line-height: 16px;
            font-size: 12px;
            border-top: 1px solid #DBDFE9;
        }

        .sd-table-bot-total {
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
            font-style: normal;
            text-align: right;
            padding: 8px;

        }

        .sd-table-bot {
            font-weight: 600;
            line-height: 16px;
            font-size: 12px;
            border-top: 1px solid #DBDFE9;
        }

        .sd-table-bot-total {
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
        }

        .sd-table-bot span,
        .sd-table-bot-total span {
            margin-left: 16px;
        }

        .kpi-table-head {
            color: #071437;
        .sd-table-bot span,
        .sd-table-bot-total span {
            margin-left: 16px;
        }

        .kpi-table-head {
            color: #071437;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 8px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 8px;
        }

        .idp-table {
        .idp-table {
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .idp-table .table-row,
        .idp-table-2 .table-row {
            display: grid;
            align-items: center;
            border-bottom: 1px solid #eee;
        .idp-table .table-row,
        .idp-table-2 .table-row {
            display: grid;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .idp-table .table-row {
            grid-template-columns: 14.28% 14.28% 14.28% 14.28% 14.28% 14.28% 14.28%;
        }

        .idp-table-2 .table-row {
            grid-template-columns: 11% 25% 20% 12% 21% 11%;
        }

        .idp-table .table-row:last-child {
            border-bottom: none;
        }

        .idp-table .header div,
        .idp-table-2 .header th {
            border-bottom: 1px solid #F3F3F3;
        .idp-table .table-row {
            grid-template-columns: 14.28% 14.28% 14.28% 14.28% 14.28% 14.28% 14.28%;
        }

        .idp-table-2 .table-row {
            grid-template-columns: 11% 25% 20% 12% 21% 11%;
        }

        .idp-table .table-row:last-child {
            border-bottom: none;
        }

        .idp-table .header div,
        .idp-table-2 .header th {
            border-bottom: 1px solid #F3F3F3;
            display: flex;
            justify-content: center;
            justify-content: center;
            align-items: center;
            padding: 16px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .idp-table-2 .header th {
            border-bottom: none;
            justify-content: left;
            padding: 16px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .idp-table-2 .header th {
            border-bottom: none;
            justify-content: left;
        }

        .table-row div {
            padding: 24px;
            margin: auto;
        }

        .idp-table .badge {
        .table-row div {
            padding: 24px;
            margin: auto;
        }

        .idp-table .badge {
            display: flex;
            width: fit-content;
            margin: auto;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.9rem;
            text-align: center;

        }

        .idp-table .soft-skill {
            background: #e7f3ff;
            color: #007bff;
            width: fit-content;
            margin: auto;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.9rem;
            text-align: center;

        }

        .idp-table .soft-skill {
            background: #e7f3ff;
            color: #007bff;
        }

        .idp-table .tech-skill {
            background: #ffe5e0;
            color: #d9534f;
        }

        .idp-table .basic-level {
            background: #d4edda;
            color: #155724;
        }

        .idp-table .advanced-skill {
            background: #e0e7ff;
            color: #4e73df;
        }

        .idp-table .completed {
            background: #d4edda;
            color: #28a745;
        }

        .idp-table .in-progress {
            background: #fff3cd;
            color: #856404;
        .idp-table .tech-skill {
            background: #ffe5e0;
            color: #d9534f;
        }

        .idp-table .basic-level {
            background: #d4edda;
            color: #155724;
        }

        .idp-table .advanced-skill {
            background: #e0e7ff;
            color: #4e73df;
        }

        .idp-table .completed {
            background: #d4edda;
            color: #28a745;
        }

        .idp-table .in-progress {
            background: #fff3cd;
            color: #856404;
        }

        .idp-table .progress-bar {
            width: 100%;
            height: 8px;
            background: #f0f0f0;
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            padding: 0;
        .idp-table .progress-bar {
            width: 100%;
            height: 8px;
            background: #f0f0f0;
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            padding: 0;
        }

        .idp-table .progress {
            height: 100%;
            background: #f7b500;
            border-radius: 4px;
        }
        .idp-table .progress {
            height: 100%;
            background: #f7b500;
            border-radius: 4px;
        }

        .idp-table .requirement {
            color: #dc3545;
            font-weight: bold;
        }

        .progress-bar-container {
        .idp-table .requirement {
            color: #dc3545;
            font-weight: bold;
        }

        .progress-bar-container {
            display: flex;
            align-items: center;
            align-items: center;
            gap: 10px;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: #DBDFE9 !important;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: #f7b500;
            border-radius: 10px 10px 10px 10px;
        }

        .progress-percentage {
            font-style: normal;
            font-weight: 500;
        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: #DBDFE9 !important;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: #f7b500;
            border-radius: 10px 10px 10px 10px;
        }

        .progress-percentage {
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            text-align: right;
            color: #4B5675;

        }

        .see-all {
            color: #F7941C !important;
            font-size: 14px !important;
            font-style: normal !important;
            font-weight: 500 !important;
            line-height: 20px !important;
            display: flex;
            line-height: 16px;
            text-align: right;
            color: #4B5675;

        }

        .see-all {
            color: #F7941C !important;
            font-size: 14px !important;
            font-style: normal !important;
            font-weight: 500 !important;
            line-height: 20px !important;
            display: flex;
        }

        .idp-circular-progress {
            width: 262px;
            height: 262px;
            background: conic-gradient(#FABB6E 20% 20%,
                    #FDE2C1 20% 40%,
                    #F7941C 40% 60%,
                    #F9A845 60% 80%,
                    #FCCF98 80% 100%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .idp-circular-progress {
            width: 262px;
            height: 262px;
            background: conic-gradient(#FABB6E 20% 20%,
                    #FDE2C1 20% 40%,
                    #F7941C 40% 60%,
                    #F9A845 60% 80%,
                    #FCCF98 80% 100%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .idp-circular-progress::before {
            content: '';
            width: 210px;
            height: 210px;
        .idp-circular-progress::before {
            content: '';
            width: 210px;
            height: 210px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
        }

        .idp-percentage {
            position: absolute;
            text-align: center;
        }

        .idp-percentage h3 {
            color: #071437;
            text-align: center;
            font-size: 58.5px;
            font-style: normal;
            font-weight: 600;
            line-height: 70.2px;
        }

        .idp-percentage p {
            color: #4B5675;
            text-align: center;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 500;
            line-height: 21.06px;
        }

        .orange-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            position: absolute;
        }

        .idp-percentage {
            position: absolute;
            text-align: center;
        }

        .idp-percentage h3 {
            color: #071437;
            text-align: center;
            font-size: 58.5px;
            font-style: normal;
            font-weight: 600;
            line-height: 70.2px;
        }

        .idp-percentage p {
            color: #4B5675;
            text-align: center;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 500;
            line-height: 21.06px;
        }

        .orange-dot {
            width: 16px;
            height: 16px;
            border-radius: 8px;
        }

        .orange-1 {
            background: #F7941C;
        }

        .orange-1 {
            background: #F7941C;
        }

        .orange-2 {
            background: #F9A845;
        }

        .orange-3 {
            background: #FABB6E;
        }

        .orange-4 {
            background: #FCCF98;
        .orange-2 {
            background: #F9A845;
        }

        .orange-3 {
            background: #FABB6E;
        }

        .orange-4 {
            background: #FCCF98;
        }

        .orange-5 {
            background: #FDE2C1;
        }
        .orange-5 {
            background: #FDE2C1;
        }

        .idp-table-2 table {
            width: 100%;
            border-collapse: collapse;
        .idp-table-2 table {
            width: 100%;
            border-collapse: collapse;
        }

        .idp-table-2 .table-row div {
            padding: 0px;

        .idp-table-2 .table-row div {
            padding: 0px;
        }

        .idp-table-2 th,
        .idp-table-2 td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
        }

        .idp-table-2 th {
            color: #555;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .idp-table-2 .table-row div {
            margin: inherit
        }

        .idp-table-2 td .skill {
            display: inline-block;
            background-color: #fdf2e9;
            color: #d48a42;
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 20px;
            font-size: 0.85em;
        }

        .idp-table-2 .button {
            display: inline-block;
            color: #5a8fe8;
            font-size: 0.85em;

        .idp-table-2 th,
        .idp-table-2 td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
        }

        .idp-table-2 th {
            color: #555;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .idp-table-2 .table-row div {
            margin: inherit
        }

        .idp-table-2 td .skill {
            display: inline-block;
            background-color: #fdf2e9;
            color: #d48a42;
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 20px;
            font-size: 0.85em;
        }

        .idp-table-2 .button {
            display: inline-block;
            color: #5a8fe8;
            font-size: 0.85em;
            cursor: pointer;
        }

        .test-result {
            color: #555;
        }

        .red-top {
            border-radius: 80px;
            background: #FFE8E8;
            color: #FF2E2E;
            font-size: 8px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 4px 12px;
        }

        .red-top span {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;

        .test-result {
            color: #555;
        }

        .red-top {
            border-radius: 80px;
            background: #FFE8E8;
            color: #FF2E2E;
            font-size: 8px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 4px 12px;
        }

        .red-top span {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
        }

        .icon_wrapper {
            width: 100%;
        }

        .tab-btn button {
            padding: 12px 18px !important;
            background: #FFF !important;
            border-color: #99A1B7 !important;
            color: #78829D !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            line-height: 16px !important;
        }

        .tab-btn button.active {
            background-color: #F7941C !important;
            color: #FFF !important;
            border-color: #F7941C !important;
            border: 0px !important;
        }

        .btn-tab-1 {
            border-width: 1px 0px 1px 1px !important;
            border-radius: 4px 0px 0px 4px !important;
        }

        .btn-tab-2 {
            border-width: 1px 1px 1px 0px !important;
            border-radius: 0px 4px 4px 0px !important;

        .icon_wrapper {
            width: 100%;
        }

        .tab-btn button {
            padding: 12px 18px !important;
            background: #FFF !important;
            border-color: #99A1B7 !important;
            color: #78829D !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            line-height: 16px !important;
        }

        .tab-btn button.active {
            background-color: #F7941C !important;
            color: #FFF !important;
            border-color: #F7941C !important;
            border: 0px !important;
        }

        .btn-tab-1 {
            border-width: 1px 0px 1px 1px !important;
            border-radius: 4px 0px 0px 4px !important;
        }

        .btn-tab-2 {
            border-width: 1px 1px 1px 0px !important;
            border-radius: 0px 4px 4px 0px !important;
        }

        .kpi-circular-progress {
      width: 245px;
      height: 245px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .donut-1 .kpi-circular-progress {
        background: conic-gradient(
        #F7941C 0% 89%, /* 89% progress (2.68/3.00) */
        #DBDFE9 89% 100% /* Remaining segment */
      );
    }

    .donut-2 .kpi-circular-progress {
        background: conic-gradient(
        #F7941C 0% 100%, /* 89% progress (2.68/3.00) */
        #DBDFE9 0% 0% /* Remaining segment */
      );
    }

    .kpi-circular-progress::before {
      content: '';
      width: 200px;
      height: 200px;
      background: #fff;
      border-radius: 50%;
      position: absolute;
    }

    .kpi-circle-content {
      text-align: center;
      position: relative;
      z-index: 10;
    }

    .kpi-circle-content h3 {
      font-size: 20px;
      font-weight: 600;
      margin: 0;
      color: #1a1f36;
    }

    .kpi-circle-content p {
      font-size: 16px;
      font-weight: 500;
      color: #808080;
      margin: 5px 0 0;
    }

    .semi-circle-progress {
        width: 262px;
  height: 131px; /* Half the height for a semi-circle */
  background: conic-gradient(
    #54CF6E 0deg 45deg,
    #99E2A8 45deg 90deg,
    #DBDFE9 90deg 135deg,
    #2AA443 135deg 180deg
  );
  border-radius: 131px 131px 0 0; /* Make it a semi-circle */
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
    }

    .semi-circle-progress::before {
        content: '';
  width: 210px;
  height: 105px; /* Match inner height for semi-circle */
  background: #fff;
  position: absolute;
  bottom: 0;
  border-radius: 105px 105px 0 0;
    }

    .semi-circle-idp-percentage {
  position: absolute;
  bottom: 20%;
  text-align: center;
}


        .kpi-circular-progress {
      width: 245px;
      height: 245px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .donut-1 .kpi-circular-progress {
        background: conic-gradient(
        #F7941C 0% 89%, /* 89% progress (2.68/3.00) */
        #DBDFE9 89% 100% /* Remaining segment */
      );
    }

    .donut-2 .kpi-circular-progress {
        background: conic-gradient(
        #F7941C 0% 100%, /* 89% progress (2.68/3.00) */
        #DBDFE9 0% 0% /* Remaining segment */
      );
    }

    .kpi-circular-progress::before {
      content: '';
      width: 200px;
      height: 200px;
      background: #fff;
      border-radius: 50%;
      position: absolute;
    }

    .kpi-circle-content {
      text-align: center;
      position: relative;
      z-index: 10;
    }

    .kpi-circle-content h3 {
      font-size: 20px;
      font-weight: 600;
      margin: 0;
      color: #1a1f36;
    }

    .kpi-circle-content p {
      font-size: 16px;
      font-weight: 500;
      color: #808080;
      margin: 5px 0 0;
    }

    .semi-circle-progress {
        width: 262px;
  height: 131px; /* Half the height for a semi-circle */
  background: conic-gradient(
    #54CF6E 0deg 45deg,
    #99E2A8 45deg 90deg,
    #DBDFE9 90deg 135deg,
    #2AA443 135deg 180deg
  );
  border-radius: 131px 131px 0 0; /* Make it a semi-circle */
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
    }

    .semi-circle-progress::before {
        content: '';
  width: 210px;
  height: 105px; /* Match inner height for semi-circle */
  background: #fff;
  position: absolute;
  bottom: 0;
  border-radius: 105px 105px 0 0;
    }

    .semi-circle-idp-percentage {
  position: absolute;
  bottom: 20%;
  text-align: center;
}

    </style>


@endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">
                                Admin </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            Employee Details </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <div class="card mb-10">
                    <div class="card-body profile-card pb-0">
                        <div class="d-flex flex-wrap gap-7 flex-sm-nowrap mb-11">
                            <div>
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ asset($employee->profile_picture ?? '') }}"
                                        onerror="this.src='{{ asset('images/default-user.svg') }}'"
                                        alt="image" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column gap-4">
                                        <div class="d-flex align-items-center">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1 lh-base">{{ $employee->first_name ?? '' }}
                                                {{ $employee->middle_name ?? '' }}
                                                {{ $employee->last_name ?? '' }}
                                            </a>
                                            <p class="high table-status mb-0 mr-2 ml-3">High Potential</p>
                                            <p class="moderate table-status m-0">SUCCESSOR: Manager – Rostering & Advance
                                                Crewing​</p>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                            @php
                                                $soft_skill_score = $employee->soft_skill_score;
                                                if ($soft_skill_score > 98) {
                                                    $level = 5;
                                                } elseif ($soft_skill_score > 84 && $soft_skill_score <= 98) {
                                                    $level = 4;
                                                } elseif ($soft_skill_score >= 16 && $soft_skill_score <= 84) {
                                                    $level = 3;
                                                } elseif ($soft_skill_score >= 2 && $soft_skill_score < 16) {
                                                    $level = 2;
                                                } elseif ($soft_skill_score > 0 && $soft_skill_score < 2) {
                                                    $level = 1;
                                                } else {
                                                    $level = 0;
                                                }
                                            @endphp
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Behavior Fit Rate:
                                                {{ config('helpers.behavior_fit_rate_levels')[$level] ?? '' }}
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                |
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Job Title :
                                                {{ $employee->job_position->title ?? ($employee->job_title ?? '') }}
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                |
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Department: {{ $employee->department->name ?? 'N/A' }} </a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Section: {{ $employee->departmentSection->name ?? 'N/A' }}
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                |
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Unit: {{ $employee->sectionUnit->name ?? 'N/A' }} </a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Emp ID: #EMP{{ $employee->id ?? 'N/A' }}
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                |
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Date of Hire:
                                                {{ \Carbon\Carbon::parse($employee->date_of_hire)->format('F d, Y') ?? 'N/A' }}
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                |
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Employment Status:
                                                {{ config('constants.EMPLOYMENT_STATUSES.' . $employee->employment_status) ?? 'Full Time' }}
                                            </a>
                                        </div>
                                        <div class="d-flex flex-wrap flex-stack mt-">
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <div class="d-flex flex-wrap">
                                                    <a class="btn  btn-primary me-4"
                                                        href="{{ route('admin.employee.details.download_report', $employee->id) }}">
                                                        <iconify-icon icon="mingcute:print-line d-none"></iconify-icon>
                                                        <span class="indicator-label">
                                                            Download</span>
                                                    </a>
                                                    <button id="backButton" class="btn  btn-light me-2"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Go Back">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 active" data-bs-toggle="tab"
                                    href="#kt_tab_pane_1" role="tabpanel">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6" data-bs-toggle="tab"
                                    href="#kt_tab_pane_2">Psychometric </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6" data-bs-toggle="tab"
                                    href="#kt_tab_pane_3">Performance & Skill Review</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6" data-bs-toggle="tab"
                                    href="#kt_tab_pane_skills">Succession Plan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6" data-bs-toggle="tab"
                                    href="#kt_tab_pane_careers">Career Pathing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6" data-bs-toggle="tab"
                                    href="#kt_tab_pane_idp">Individual Development Plan (IDP)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6" data-bs-toggle="tab"
                                    href="#kt_tab_pane_operations">Operations</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <!--begin:: Panel 1-->
                    <div class="gy-5 g-xl-10 tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-4 mb-5 mb-xl-10">
                                <div class="card card-flush h-md-100" dir="ltr">
                                    <div class="card-header flex-nowrap pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-900">Basic Personal
                                                Information​</span>
                                        </h3>
                                    </div>
                                    <div class="card-body p-9">
                                        <div class="row mb-7">
                                            <label class="col-lg-6 fw-semibold text-muted">Full Name</label>
                                            <div class="col-lg-6">
                                                <span class="fw-bold fs-6 text-gray-800">
                                                    {{ $employee->first_name ?? 'N / A' }} {{ $employee->middle_name ?? 'N / A' }}
                                                    {{ $employee->last_name }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-6 fw-semibold text-muted">Gender</label>
                                            <div class="col-lg-6">
                                                <span class="fw-bold fs-6 text-gray-800">
                                                    @if ($employee->gender == 0)
                                                        Male
                                                    @elseif ($employee->gender == 1)
                                                        Female
                                                    @else
                                                        N / A
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-6 fw-semibold text-muted">Date of Birth</label>
                                            <div class="col-lg-6">
                                                <span class="fw-bold fs-6 text-gray-800">
                                                   
                                        @if ($employee->birth_date == '0000-00-00')
                                            N / A
                                        @else
                                            {{ $employee->birth_date ?? 'N / A' }}
                                        @endif
                                        </span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-6 fw-semibold text-muted">Civil Status</label>
                                            <div class="col-lg-6">
                                                <span class="fw-bold fs-6 text-gray-800">
                                                    {{ config('constants.MARITAL_STATUSES.' . $employee->marital_status ?? 'N / A') }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-6 fw-semibold text-muted">Nationality</label>
                                            <div class="col-lg-6">
                                                <span class="fw-bold fs-6 text-gray-800">
                                                    {{ $employee->country->name ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-lg-6 fw-semibold text-muted">House/Building Number and Street
                                                Name:
                                            </label>
                                            <div class="col-lg-6">
                                                <span
                                                    class="fw-bold fs-6 text-gray-800">{{ $employee->home_address ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-lg-6 fw-semibold text-muted">Barangay/Subdivision: </label>
                                            <div class="col-lg-6">
                                                <span
                                                    class="fw-bold fs-6 text-gray-800">{{ $employee->barangay->name ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-lg-6 fw-semibold text-muted">City: </label>
                                            <div class="col-lg-6">
                                                <span
                                                    class="fw-bold fs-6 text-gray-800">{{ $employee->cityName->name ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-lg-6 fw-semibold text-muted">Province: </label>
                                            <div class="col-lg-6">
                                                <span
                                                    class="fw-bold fs-6 text-gray-800">{{ $employee->province->name ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <label class="col-lg-6 fw-semibold text-muted">Postal Code: </label>
                                            <div class="col-lg-6">
                                                <span
                                                    class="fw-bold fs-6 text-gray-800">{{ $employee->postal_code ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class=" pt-5">
                                            <h3 class="card-title align-items-start flex-column mb-5">
                                                <span class="card-label fw-bold text-gray-900">Contact Information​</span>
                                            </h3>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Email Address (Official)</label>
                                            <div class="col-lg-8 fv-row">
                                                <span class="fw-semibold text-gray-800 fs-6">
                                                    {{ $employee->email ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Email Address (Personal)</label>
                                            <div class="col-lg-8 fv-row">
                                                <a>
                                                    <span class="fw-semibold text-gray-800 fs-6">
                                                        {{ $employee->secondary_email ?? 'N / A' }}</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">
                                                Mobile Number
                                            </label>
                                            <div class="col-lg-8 d-flex align-items-center">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">
                                                    {{ $employee->mobile_number ?? 'N / A' }}</span>
                                            </div>
                                        </div>
                                        <div class=" pt-5">
                                            <h3 class="card-title align-items-start flex-column mb-5">
                                                <span class="card-label fw-bold text-gray-900">Government
                                                    Identifications​​</span>

                                    </h3>
                                    <!--end::Title-->


                                </div>
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-6 fw-semibold text-muted">Tax Identification Number (TIN)</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                            {{ $employee->tin_number ?? 'N / A' }}</a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-6 fw-semibold text-muted">Social Security System (SSS) Number</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                            {{ $employee->sss_number ?? 'N / A' }}</a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-6 fw-semibold text-muted">Pag-IBIG Fund (HDMF) Number</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                            {{ $employee->hdmf_number ?? 'N / A' }}</a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-6 fw-semibold text-muted">PhilHealth Number</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                            {{ $employee->phil_number ?? 'N / A' }}</a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Engage widget 1-->
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2-->
                    <div class="col-xl-8 mb-xl-10">
                        <!--begin::Chart widget 5-->
                        <div class="card card-flush h-lg-100">
                            <!--begin::Header-->
                            <div class="card-header flex-nowrap pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Educational Background​
                                    </span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body p-6">
                                <div class="row mb-7 col-lg-12 justify-content-between" style="margin-left: 3px;">
                                    <!--begin::Label-->
                                    <div class="col-lg-6 row">
                                        <label class="col-lg-6 fw-semibold text-muted">Highest Educational Attainment</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <span class="fw-bold fs-6 text-gray-800">
                                                {{ $employee->education_level_check->name ?? 'N / A' }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="col-lg-6 row">
                                        <label class="col-lg-6 fw-semibold text-muted">Name of School/University​</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $employee->higher_learning->name ?? 'N / A' }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="col-lg-6 row">
                                        <label class="col-lg-6 fw-semibold text-muted">Course/Program​</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <span class="fw-bold fs-6 text-gray-800">
                                                {{ $employee->program->name ?? 'N / A' }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="col-lg-6 row">
                                        <label class="col-lg-6 fw-semibold text-muted">Year of Graduated</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <span class="fw-bold fs-6 text-gray-800">
                                                {{ $employee->graduate_year ?? 'N / A' }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>
                                <!--begin::Tables Widget 3-->
                                <div class="card  mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">Work Experience​</span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-gray-300 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold">Previous Employers</th>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold">Job Titles</th>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold">Start Date</th>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold">End Date</th>
                                                        <th class="py-5 p-0 text-center  fw-bold">Duration of Employment</th>
                                                        <th class="py-5 p-0 fw-bold">Key Responsibilties</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->

                                                <!--begin::Table body-->
                                                <tbody>
                                                    @foreach ($employee->employments as $employment)
                                                        <tr>
                                                            <td class="fw-bold p-0 text-muted">
                                                                {{ $employment->company_name ?? 'N / A' }} </td>
                                                            <td class="fw-bold p-0 text-muted">
                                                                {{ $employment->job_title ?? 'N / A' }}
                                                            </td>
                                                            <td class="fw-bold p-0 text-muted">
                                                                {{ $employment->start_date ?? 'N / A' }}</td>
                                                            <td class="fw-bold p-0 text-muted">
                                                                @if ($employment->end_date == '0000-00-00')
                                                                    Currently Working Here
                                                                @else
                                                                    {{ $employment->end_date ?? '' }}
                                                                @endif
                                                            </td>
                                                            <td class="fw-bold p-0 text-muted text-center">
                                                                @if ($employment->year_of_work)
                                                                    {{ $employment->year_of_work }} {{ $employment->year_of_work == 1 ? 'year' : 'years' }}
                                                                @else
                                                                    N / A
                                                                @endif
                                                            </td>
                                                            <td class="fw-bold p-0 text-muted">
                                                                {{ $employment->key_responsiblity ?? 'N / A' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Tables Widget 3-->
                                <div class="card  mb-xl-8 overflow-hidden">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">Skills and Certification​</span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--commit-1-->

                                    <!--begin::Body-->
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        <div class="mb-2 p-2">
                                            <h5 class="">Relevant Skills</h5>
                                            {{-- @if($employee->skills)
                                                @foreach (json_decode($employee->skills, true) as $skill)
                                                    <div class="badge badge-success">{{ $skill['value'] }}</div>
                                                @endforeach
                                            @endif --}}
                                            @if(!empty($employee->skills) && is_string($employee->skills))
                                                @php
                                                    $skills = json_decode($employee->skills, true);
                                                @endphp

                                                @if(is_array($skills))
                                                    @foreach ($skills as $skill)
                                                        <div class="badge badge-success">{{ $skill['value']}}</div>
                                                    @endforeach
                                                    @else
                                                    <p>No skills acquirred.</p>
                                                @endif
                                            @else
                                                    <p>No skills acquirred.</p>
                                            @endisset
                                        </div>
                                        <div class="mb-2 p-2">
                                            <h5 class="">Professional Certifications </h5>
                                            @if($employee->professional_certificate)
                                                @php
                                                    $certificates = json_decode($employee->professional_certificate, true);
                                                @endphp
                                                @if(is_array($certificates) && count($certificates) > 0)
                                                    @foreach ($certificates as $skill)
                                                        <div class="badge badge-success">{{ $skill['value'] }}</div>
                                                    @endforeach
                                                @else
                                                    <p>No certifications available.</p>
                                                @endif
                                            @else
                                                <p>No certifications available.</p>
                                            @endisset
                                        </div>
                                        <div class="mb-2 p-2">
                                            <h5 class="">Traning Program </h5>
                                            {{-- @if($employee->training_program)
                                                @foreach (json_decode($employee->training_program, true) as $skill)
                                                    <div class="badge badge-success">{{ $skill['value'] }}</div>
                                                @endforeach
                                            @endif --}}
                                            @if(!empty($employee->training_program) && is_string($employee->training_program))
                                                @php
                                                    $skills = json_decode($employee->training_program, true);
                                                @endphp
                                                @if(is_array($skills))
                                                    @foreach ($skills as $skill)
                                                        <div class="badge badge-success">{{ $skill['value'] }}</div>
                                                        @endforeach
                                                    @else
                                                    <p>No training attended.</p>
                                                @endif
                                            @else
                                                    <p>No training attended.</p>
                                            @endisset
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <div class="card  mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">Emergency Contact Information​</span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-gray-300 align-start gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold">Name of Person</th>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold">Relationship</th>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold">Contact Number</th>
                                                        <th class="py-5 p-0 w-xxl-95px fw-bold text-center">Address</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    <t>
                                                        <td class="fw-bold p-0 text-muted">
                                                            {{ $employee->ec_contact_person_name ?? 'N / A' }} </td>
                                                        <td class="fw-bold p-0 text-muted">
                                                            {{ config('constants.RELATION_EMPLOYEE.' . $employee->ec_relation_employee, 'N / A') }}
                                                        </td>
                                                        <td class="fw-bold p-0 text-muted">
                                                            {{ $employee->ec_contact_person_number ?? 'N / A' }}</td>

                                                            <td class="fw-bold p-0 text-muted text-center"></td>
                                                            {{ $employee->ec_home_address ? 'Address:' . $employee->ec_home_address : '' }}
                                                            <br>
                                                            {{ $employee->ecBarangay ? 'Sub Division/Barangay:' . $employee->ecBarangay->name : '' }}
                                                            <br>
                                                            {{ $employee->ecCityName ? 'City:' . $employee->ecCityName->name : '' }}
                                                            <br>
                                                            {{ $employee->ecProvince ? 'Province:' . $employee->ecProvince->name : '' }}
                                                            <br>
                                                            {{ $employee->ec_postal_code ? ' Postal Code:' . $employee->ec_postal_code : '' }}
                                                            <br>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-6 card card-body">
                                            <h6>Consent for data processing and sharing as per the Data Privacy Act​
                                            </h6>
                                        </div>
                                        <div class="col-lg-6 card card-body">
                                            <h6>Acknowledgement of company policies and procedures</h6>
                                        </div>
                                        <div>
                                            <p class="fw-bold mt-2 text-danger">Both to be digitally signed by
                                                employees when signing up @ Talent Module</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin:: Panel 1-->
                </div>
                <!--end::Row-->
                <!--begin::Panel 2-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                    <!--begin::Col 1 -->

                    <div class="d-flex mb-9 gap-4">
                        <div class="card col p-4">
                            <p class="fs-5 fw-bold lh-base mb-6">Personality and Motivation</p>
                                                            <td class="fw-bold p-0 text-muted text-center"></td>
                                                            {{ $employee->ec_home_address ? 'Address:' . $employee->ec_home_address : '' }}
                                                            <br>
                                                            {{ $employee->ecBarangay ? 'Sub Division/Barangay:' . $employee->ecBarangay->name : '' }}
                                                            <br>
                                                            {{ $employee->ecCityName ? 'City:' . $employee->ecCityName->name : '' }}
                                                            <br>
                                                            {{ $employee->ecProvince ? 'Province:' . $employee->ecProvince->name : '' }}
                                                            <br>
                                                            {{ $employee->ec_postal_code ? ' Postal Code:' . $employee->ec_postal_code : '' }}
                                                            <br>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-6 card card-body">
                                            <h6>Consent for data processing and sharing as per the Data Privacy Act​
                                            </h6>
                                        </div>
                                        <div class="col-lg-6 card card-body">
                                            <h6>Acknowledgement of company policies and procedures</h6>
                                        </div>
                                        <div>
                                            <p class="fw-bold mt-2 text-danger">Both to be digitally signed by
                                                employees when signing up @ Talent Module</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin:: Panel 1-->
                </div>
                <!--end::Row-->
                <!--begin::Panel 2-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                    <!--begin::Col 1 -->

                    <div class="d-flex mb-9 gap-4">
                        <div class="card col p-4">
                            <p class="fs-5 fw-bold lh-base mb-6">Personality and Motivation</p>
                        </div>

                        <div class="card col p-4">
                            <p class="fs-5 fw-bold lh-base mb-6">Work Interest</p>

                        <div class="card col p-4">
                            <p class="fs-5 fw-bold lh-base mb-6">Work Interest</p>
                        </div>

                        <div class="card col p-4">
                            <p class="fs-5 fw-bold lh-base mb-6">Cognitive Ability</p>

                        <div class="card col p-4">
                            <p class="fs-5 fw-bold lh-base mb-6">Cognitive Ability</p>
                        </div>
                    </div>

                    <div class="d-flex mb-9 card p-9 gap-15 flex-row align-items-center" style="color: #5B5B5B">
                        <div class="col-5 d-flex gap-15 align-items-center">
                            <svg width="132" height="131" viewBox="0 0 132 131" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Overall match rate (Medium)">
                                    <ellipse id="Ellipse 7" cx="65.9995" cy="65.5005" rx="66"
                                        ry="65.5" fill="#FFEBB4" />
                                    <ellipse id="Ellipse 10" cx="66.0949" cy="64.1676" rx="54.6667"
                                        ry="54.6468" fill="#FFE18F" />
                                    <path id="Moderate"
                                        d="M32.9446 55.5492H35.363L38.6016 63.454H38.7294L41.9681 55.5492H44.3864V66.4583H42.4901V58.9636H42.3889L39.374 66.4263H37.9571L34.9422 58.9476H34.841V66.4583H32.9446V55.5492ZM50.0221 66.6181C49.2231 66.6181 48.5306 66.4423 47.9446 66.0907C47.3587 65.7391 46.9042 65.2473 46.581 64.6152C46.2614 63.9831 46.1016 63.2445 46.1016 62.3993C46.1016 61.5541 46.2614 60.8137 46.581 60.1781C46.9042 59.5424 47.3587 59.0488 47.9446 58.6972C48.5306 58.3457 49.2231 58.1699 50.0221 58.1699C50.8211 58.1699 51.5135 58.3457 52.0995 58.6972C52.6854 59.0488 53.1382 59.5424 53.4578 60.1781C53.7809 60.8137 53.9425 61.5541 53.9425 62.3993C53.9425 63.2445 53.7809 63.9831 53.4578 64.6152C53.1382 65.2473 52.6854 65.7391 52.0995 66.0907C51.5135 66.4423 50.8211 66.6181 50.0221 66.6181ZM50.0327 65.0733C50.466 65.0733 50.8282 64.9543 51.1194 64.7164C51.4106 64.4749 51.6272 64.1518 51.7692 63.747C51.9148 63.3421 51.9876 62.8911 51.9876 62.394C51.9876 61.8933 51.9148 61.4405 51.7692 61.0357C51.6272 60.6273 51.4106 60.3024 51.1194 60.0609C50.8282 59.8194 50.466 59.6987 50.0327 59.6987C49.5888 59.6987 49.2195 59.8194 48.9248 60.0609C48.6336 60.3024 48.4152 60.6273 48.2696 61.0357C48.1275 61.4405 48.0565 61.8933 48.0565 62.394C48.0565 62.8911 48.1275 63.3421 48.2696 63.747C48.4152 64.1518 48.6336 64.4749 48.9248 64.7164C49.2195 64.9543 49.5888 65.0733 50.0327 65.0733ZM58.6154 66.6021C57.9726 66.6021 57.3973 66.4369 56.8895 66.1067C56.3817 65.7764 55.9804 65.297 55.6857 64.6685C55.3909 64.0399 55.2436 63.2764 55.2436 62.378C55.2436 61.4689 55.3927 60.7019 55.691 60.0769C55.9929 59.4483 56.3995 58.9742 56.9108 58.6546C57.4222 58.3315 57.9921 58.1699 58.6207 58.1699C59.1001 58.1699 59.4943 58.2516 59.8032 58.4149C60.1122 58.5747 60.3572 58.7683 60.5383 58.9955C60.7194 59.2193 60.8597 59.4306 60.9591 59.6294H61.039V55.5492H62.9726V66.4583H61.0763V65.1692H60.9591C60.8597 65.3681 60.7159 65.5793 60.5277 65.8031C60.3394 66.0232 60.0909 66.2114 59.7819 66.3677C59.473 66.5239 59.0841 66.6021 58.6154 66.6021ZM59.1534 65.02C59.5617 65.02 59.9098 64.91 60.1974 64.6898C60.485 64.4661 60.7034 64.1553 60.8526 63.7576C61.0017 63.3599 61.0763 62.8965 61.0763 62.3673C61.0763 61.8382 61.0017 61.3784 60.8526 60.9877C60.707 60.5971 60.4904 60.2935 60.2027 60.0769C59.9186 59.8602 59.5688 59.7519 59.1534 59.7519C58.7237 59.7519 58.365 59.8638 58.0774 60.0875C57.7897 60.3112 57.5731 60.6202 57.4275 61.0144C57.2819 61.4085 57.2091 61.8595 57.2091 62.3673C57.2091 62.8787 57.2819 63.335 57.4275 63.7363C57.5767 64.134 57.7951 64.4483 58.0827 64.6791C58.3739 64.9064 58.7308 65.02 59.1534 65.02ZM68.6495 66.6181C67.8292 66.6181 67.1208 66.4476 66.5242 66.1067C65.9312 65.7622 65.4748 65.2757 65.1552 64.6472C64.8356 64.0151 64.6758 63.2711 64.6758 62.4153C64.6758 61.5737 64.8356 60.835 65.1552 60.1994C65.4784 59.5602 65.9294 59.063 66.5082 58.7079C67.087 58.3492 67.7671 58.1699 68.5483 58.1699C69.0526 58.1699 69.5285 58.2516 69.9759 58.4149C70.4269 58.5747 70.8246 58.8233 71.1691 59.1607C71.5171 59.498 71.7905 59.9277 71.9894 60.4497C72.1883 60.9682 72.2877 61.5861 72.2877 62.3034V62.8947H65.5814V61.595H70.4393C70.4358 61.2257 70.3559 60.8972 70.1996 60.6095C70.0434 60.3183 69.825 60.0893 69.5444 59.9224C69.2674 59.7555 68.9443 59.672 68.575 59.672C68.1808 59.672 67.8346 59.7679 67.5363 59.9597C67.238 60.1479 67.0054 60.3965 66.8385 60.7054C66.6751 61.0108 66.5917 61.3464 66.5881 61.7122V62.8467C66.5881 63.3226 66.6751 63.731 66.8491 64.0719C67.0231 64.4092 67.2664 64.6685 67.5789 64.8496C67.8914 65.0271 68.2571 65.1159 68.6762 65.1159C68.9567 65.1159 69.2106 65.0769 69.4379 64.9987C69.6652 64.9171 69.8623 64.7981 70.0292 64.6418C70.1961 64.4856 70.3221 64.2921 70.4074 64.0612L72.2078 64.2636C72.0941 64.7395 71.8775 65.155 71.5579 65.5101C71.2419 65.8617 70.837 66.1351 70.3434 66.3304C69.8498 66.5222 69.2852 66.6181 68.6495 66.6181ZM73.919 66.4583V58.2764H75.7887V59.6401H75.8739C76.023 59.1678 76.2787 58.8038 76.6409 58.5481C77.0067 58.2889 77.424 58.1592 77.8927 58.1592C77.9992 58.1592 78.1182 58.1646 78.2496 58.1752C78.3845 58.1823 78.4964 58.1948 78.5852 58.2125V59.9863C78.5035 59.9579 78.3739 59.933 78.1963 59.9117C78.0223 59.8869 77.8536 59.8744 77.6903 59.8744C77.3387 59.8744 77.0227 59.9508 76.7421 60.1035C76.4652 60.2526 76.2468 60.4604 76.087 60.7267C75.9272 60.9931 75.8473 61.3002 75.8473 61.6482V66.4583H73.919ZM82.0742 66.6234C81.5557 66.6234 81.0887 66.5311 80.6733 66.3464C80.2613 66.1582 79.9346 65.8812 79.6931 65.5154C79.4552 65.1497 79.3362 64.6987 79.3362 64.1624C79.3362 63.7008 79.4215 63.319 79.5919 63.0172C79.7624 62.7154 79.995 62.4739 80.2897 62.2928C80.5845 62.1117 80.9165 61.9749 81.2858 61.8826C81.6587 61.7867 82.044 61.7175 82.4417 61.6749C82.9211 61.6252 83.31 61.5808 83.6083 61.5417C83.9066 61.4991 84.1232 61.4352 84.2581 61.3499C84.3966 61.2612 84.4659 61.1244 84.4659 60.9398V60.9078C84.4659 60.5065 84.3469 60.1958 84.109 59.9757C83.871 59.7555 83.5284 59.6454 83.0809 59.6454C82.6086 59.6454 82.234 59.7484 81.957 59.9543C81.6835 60.1603 81.4989 60.4036 81.403 60.6841L79.6026 60.4284C79.7446 59.9313 79.979 59.5158 80.3057 59.182C80.6324 58.8446 81.0319 58.5925 81.5042 58.4256C81.9765 58.2551 82.4985 58.1699 83.0703 58.1699C83.4644 58.1699 83.8568 58.2161 84.2475 58.3084C84.6381 58.4007 84.995 58.5534 85.3181 58.7665C85.6413 58.976 85.9005 59.2619 86.0958 59.6241C86.2947 59.9863 86.3941 60.4391 86.3941 60.9824V66.4583H84.5404V65.3343H84.4765C84.3593 65.5616 84.1942 65.7747 83.9811 65.9735C83.7716 66.1688 83.5071 66.3269 83.1875 66.4476C82.8714 66.5648 82.5003 66.6234 82.0742 66.6234ZM82.5749 65.2065C82.962 65.2065 83.2975 65.1301 83.5816 64.9774C83.8657 64.8212 84.0841 64.6152 84.2368 64.3595C84.3931 64.1038 84.4712 63.8251 84.4712 63.5232V62.5591C84.4108 62.6088 84.3078 62.655 84.1622 62.6976C84.0202 62.7402 83.8604 62.7775 83.6828 62.8095C83.5053 62.8414 83.3295 62.8698 83.1555 62.8947C82.9815 62.9195 82.8306 62.9409 82.7027 62.9586C82.4151 62.9977 82.1576 63.0616 81.9304 63.1504C81.7031 63.2391 81.5237 63.3634 81.3924 63.5232C81.261 63.6795 81.1953 63.8819 81.1953 64.1305C81.1953 64.4856 81.3249 64.7537 81.5841 64.9348C81.8434 65.1159 82.1736 65.2065 82.5749 65.2065ZM92.4186 58.2764V59.7679H87.7152V58.2764H92.4186ZM88.8764 56.3162H90.8046V63.9973C90.8046 64.2565 90.8437 64.4554 90.9218 64.5939C91.0035 64.7288 91.11 64.8212 91.2414 64.8709C91.3728 64.9206 91.5184 64.9455 91.6782 64.9455C91.799 64.9455 91.909 64.9366 92.0085 64.9188C92.1115 64.9011 92.1896 64.8851 92.2429 64.8709L92.5678 66.3784C92.4648 66.4139 92.3174 66.4529 92.1257 66.4955C91.9375 66.5382 91.7066 66.563 91.4332 66.5701C90.9502 66.5843 90.5152 66.5115 90.1282 66.3517C89.7411 66.1884 89.4339 65.9362 89.2066 65.5953C88.9829 65.2544 88.8728 64.8283 88.8764 64.3169V56.3162ZM97.5656 66.6181C96.7453 66.6181 96.0368 66.4476 95.4402 66.1067C94.8472 65.7622 94.3908 65.2757 94.0712 64.6472C93.7516 64.0151 93.5918 63.2711 93.5918 62.4153C93.5918 61.5737 93.7516 60.835 94.0712 60.1994C94.3944 59.5602 94.8454 59.063 95.4242 58.7079C96.0031 58.3492 96.6831 58.1699 97.4644 58.1699C97.9686 58.1699 98.4445 58.2516 98.8919 58.4149C99.3429 58.5747 99.7406 58.8233 100.085 59.1607C100.433 59.498 100.707 59.9277 100.905 60.4497C101.104 60.9682 101.204 61.5861 101.204 62.3034V62.8947H94.4974V61.595H99.3553C99.3518 61.2257 99.2719 60.8972 99.1156 60.6095C98.9594 60.3183 98.741 60.0893 98.4604 59.9224C98.1835 59.7555 97.8603 59.672 97.491 59.672C97.0968 59.672 96.7506 59.7679 96.4523 59.9597C96.154 60.1479 95.9214 60.3965 95.7545 60.7054C95.5911 61.0108 95.5077 61.3464 95.5041 61.7122V62.8467C95.5041 63.3226 95.5911 63.731 95.7651 64.0719C95.9391 64.4092 96.1824 64.6685 96.4949 64.8496C96.8074 65.0271 97.1732 65.1159 97.5922 65.1159C97.8727 65.1159 98.1266 65.0769 98.3539 64.9987C98.5812 64.9171 98.7783 64.7981 98.9452 64.6418C99.1121 64.4856 99.2381 64.2921 99.3234 64.0612L101.124 64.2636C101.01 64.7395 100.794 65.155 100.474 65.5101C100.158 65.8617 99.7531 66.1351 99.2595 66.3304C98.7658 66.5222 98.2012 66.6181 97.5656 66.6181Z"
                                        fill="#F7941C" />
                                </g>
                            </svg>

                            <div class="col">
                                <p class="fs-2 fw-medium lh-base m-0">Behavioural Fit Rate:</p>
                                <p class="fs-5 fw-medium lh-base m-0"
                                    style="font-size: 32px !important; color: #F7941C;">Moderate</p>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column gap-4">
                            <div class="second-container gap-9">
                                <p class="m-0">Personality Type:</br>
                                    Genius </p>
                                <div>
                                    <p class="m-0">Growth Potential:</p>
                                    <div style="display:flex;">
                                        <p class="moderate-icon-yellow mb-0"></p>
                                        <p class="m-0">Moderate</p>
                                    </div>
                                </div>
                            </div class="mt-2">
                            <div class="second-container gap-9">
                                <div>
                                    <p class="m-0">Workplace Alignment Forecast:</p>
                                    <div style="display:flex; align-items: center; gap:10px;">
                                        <svg width="18" height="15" viewBox="0 0 13 11" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path id="Polygon 8" d="M6.31983 10.385L12.6397 0.046875H0L6.31983 10.385Z"
                                                fill="#2AA443" />
                                        </svg>
                                        <p class="m-0">Low</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="m-0">Flight Risk:</p>
                                    <div style="display:flex;">
                                        <p class="moderate-icon-yellow mb-0"></p>
                                        <p class="m-0">Moderate</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner" dir="ltr">
                                <div class="top-head-view d-flex justify-content-between align-items-base"
                                    style="margin-bottom: 45px;">
                                    <!--begin::Title-->
                                    <div>
                                        <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">OCEAN
                                            Domain
                                        </h3>
                                        <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span
                                                style="color: #2AA443">Fairly Consistent</span></p>
                                    </div>
                                    <div>
                                        <p class="fs-6 fw-normal lh-base m-0" style="color: #F7941C">View all 30
                                            facets</p>

                                    </div>
                                </div>
                                <!--end::Title-->
                                <div class="skill-table">
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="cyan">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>

                    <div class="d-flex mb-9 card p-9 gap-15 flex-row align-items-center" style="color: #5B5B5B">
                        <div class="col-5 d-flex gap-15 align-items-center">
                            <svg width="132" height="131" viewBox="0 0 132 131" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Overall match rate (Medium)">
                                    <ellipse id="Ellipse 7" cx="65.9995" cy="65.5005" rx="66"
                                        ry="65.5" fill="#FFEBB4" />
                                    <ellipse id="Ellipse 10" cx="66.0949" cy="64.1676" rx="54.6667"
                                        ry="54.6468" fill="#FFE18F" />
                                    <path id="Moderate"
                                        d="M32.9446 55.5492H35.363L38.6016 63.454H38.7294L41.9681 55.5492H44.3864V66.4583H42.4901V58.9636H42.3889L39.374 66.4263H37.9571L34.9422 58.9476H34.841V66.4583H32.9446V55.5492ZM50.0221 66.6181C49.2231 66.6181 48.5306 66.4423 47.9446 66.0907C47.3587 65.7391 46.9042 65.2473 46.581 64.6152C46.2614 63.9831 46.1016 63.2445 46.1016 62.3993C46.1016 61.5541 46.2614 60.8137 46.581 60.1781C46.9042 59.5424 47.3587 59.0488 47.9446 58.6972C48.5306 58.3457 49.2231 58.1699 50.0221 58.1699C50.8211 58.1699 51.5135 58.3457 52.0995 58.6972C52.6854 59.0488 53.1382 59.5424 53.4578 60.1781C53.7809 60.8137 53.9425 61.5541 53.9425 62.3993C53.9425 63.2445 53.7809 63.9831 53.4578 64.6152C53.1382 65.2473 52.6854 65.7391 52.0995 66.0907C51.5135 66.4423 50.8211 66.6181 50.0221 66.6181ZM50.0327 65.0733C50.466 65.0733 50.8282 64.9543 51.1194 64.7164C51.4106 64.4749 51.6272 64.1518 51.7692 63.747C51.9148 63.3421 51.9876 62.8911 51.9876 62.394C51.9876 61.8933 51.9148 61.4405 51.7692 61.0357C51.6272 60.6273 51.4106 60.3024 51.1194 60.0609C50.8282 59.8194 50.466 59.6987 50.0327 59.6987C49.5888 59.6987 49.2195 59.8194 48.9248 60.0609C48.6336 60.3024 48.4152 60.6273 48.2696 61.0357C48.1275 61.4405 48.0565 61.8933 48.0565 62.394C48.0565 62.8911 48.1275 63.3421 48.2696 63.747C48.4152 64.1518 48.6336 64.4749 48.9248 64.7164C49.2195 64.9543 49.5888 65.0733 50.0327 65.0733ZM58.6154 66.6021C57.9726 66.6021 57.3973 66.4369 56.8895 66.1067C56.3817 65.7764 55.9804 65.297 55.6857 64.6685C55.3909 64.0399 55.2436 63.2764 55.2436 62.378C55.2436 61.4689 55.3927 60.7019 55.691 60.0769C55.9929 59.4483 56.3995 58.9742 56.9108 58.6546C57.4222 58.3315 57.9921 58.1699 58.6207 58.1699C59.1001 58.1699 59.4943 58.2516 59.8032 58.4149C60.1122 58.5747 60.3572 58.7683 60.5383 58.9955C60.7194 59.2193 60.8597 59.4306 60.9591 59.6294H61.039V55.5492H62.9726V66.4583H61.0763V65.1692H60.9591C60.8597 65.3681 60.7159 65.5793 60.5277 65.8031C60.3394 66.0232 60.0909 66.2114 59.7819 66.3677C59.473 66.5239 59.0841 66.6021 58.6154 66.6021ZM59.1534 65.02C59.5617 65.02 59.9098 64.91 60.1974 64.6898C60.485 64.4661 60.7034 64.1553 60.8526 63.7576C61.0017 63.3599 61.0763 62.8965 61.0763 62.3673C61.0763 61.8382 61.0017 61.3784 60.8526 60.9877C60.707 60.5971 60.4904 60.2935 60.2027 60.0769C59.9186 59.8602 59.5688 59.7519 59.1534 59.7519C58.7237 59.7519 58.365 59.8638 58.0774 60.0875C57.7897 60.3112 57.5731 60.6202 57.4275 61.0144C57.2819 61.4085 57.2091 61.8595 57.2091 62.3673C57.2091 62.8787 57.2819 63.335 57.4275 63.7363C57.5767 64.134 57.7951 64.4483 58.0827 64.6791C58.3739 64.9064 58.7308 65.02 59.1534 65.02ZM68.6495 66.6181C67.8292 66.6181 67.1208 66.4476 66.5242 66.1067C65.9312 65.7622 65.4748 65.2757 65.1552 64.6472C64.8356 64.0151 64.6758 63.2711 64.6758 62.4153C64.6758 61.5737 64.8356 60.835 65.1552 60.1994C65.4784 59.5602 65.9294 59.063 66.5082 58.7079C67.087 58.3492 67.7671 58.1699 68.5483 58.1699C69.0526 58.1699 69.5285 58.2516 69.9759 58.4149C70.4269 58.5747 70.8246 58.8233 71.1691 59.1607C71.5171 59.498 71.7905 59.9277 71.9894 60.4497C72.1883 60.9682 72.2877 61.5861 72.2877 62.3034V62.8947H65.5814V61.595H70.4393C70.4358 61.2257 70.3559 60.8972 70.1996 60.6095C70.0434 60.3183 69.825 60.0893 69.5444 59.9224C69.2674 59.7555 68.9443 59.672 68.575 59.672C68.1808 59.672 67.8346 59.7679 67.5363 59.9597C67.238 60.1479 67.0054 60.3965 66.8385 60.7054C66.6751 61.0108 66.5917 61.3464 66.5881 61.7122V62.8467C66.5881 63.3226 66.6751 63.731 66.8491 64.0719C67.0231 64.4092 67.2664 64.6685 67.5789 64.8496C67.8914 65.0271 68.2571 65.1159 68.6762 65.1159C68.9567 65.1159 69.2106 65.0769 69.4379 64.9987C69.6652 64.9171 69.8623 64.7981 70.0292 64.6418C70.1961 64.4856 70.3221 64.2921 70.4074 64.0612L72.2078 64.2636C72.0941 64.7395 71.8775 65.155 71.5579 65.5101C71.2419 65.8617 70.837 66.1351 70.3434 66.3304C69.8498 66.5222 69.2852 66.6181 68.6495 66.6181ZM73.919 66.4583V58.2764H75.7887V59.6401H75.8739C76.023 59.1678 76.2787 58.8038 76.6409 58.5481C77.0067 58.2889 77.424 58.1592 77.8927 58.1592C77.9992 58.1592 78.1182 58.1646 78.2496 58.1752C78.3845 58.1823 78.4964 58.1948 78.5852 58.2125V59.9863C78.5035 59.9579 78.3739 59.933 78.1963 59.9117C78.0223 59.8869 77.8536 59.8744 77.6903 59.8744C77.3387 59.8744 77.0227 59.9508 76.7421 60.1035C76.4652 60.2526 76.2468 60.4604 76.087 60.7267C75.9272 60.9931 75.8473 61.3002 75.8473 61.6482V66.4583H73.919ZM82.0742 66.6234C81.5557 66.6234 81.0887 66.5311 80.6733 66.3464C80.2613 66.1582 79.9346 65.8812 79.6931 65.5154C79.4552 65.1497 79.3362 64.6987 79.3362 64.1624C79.3362 63.7008 79.4215 63.319 79.5919 63.0172C79.7624 62.7154 79.995 62.4739 80.2897 62.2928C80.5845 62.1117 80.9165 61.9749 81.2858 61.8826C81.6587 61.7867 82.044 61.7175 82.4417 61.6749C82.9211 61.6252 83.31 61.5808 83.6083 61.5417C83.9066 61.4991 84.1232 61.4352 84.2581 61.3499C84.3966 61.2612 84.4659 61.1244 84.4659 60.9398V60.9078C84.4659 60.5065 84.3469 60.1958 84.109 59.9757C83.871 59.7555 83.5284 59.6454 83.0809 59.6454C82.6086 59.6454 82.234 59.7484 81.957 59.9543C81.6835 60.1603 81.4989 60.4036 81.403 60.6841L79.6026 60.4284C79.7446 59.9313 79.979 59.5158 80.3057 59.182C80.6324 58.8446 81.0319 58.5925 81.5042 58.4256C81.9765 58.2551 82.4985 58.1699 83.0703 58.1699C83.4644 58.1699 83.8568 58.2161 84.2475 58.3084C84.6381 58.4007 84.995 58.5534 85.3181 58.7665C85.6413 58.976 85.9005 59.2619 86.0958 59.6241C86.2947 59.9863 86.3941 60.4391 86.3941 60.9824V66.4583H84.5404V65.3343H84.4765C84.3593 65.5616 84.1942 65.7747 83.9811 65.9735C83.7716 66.1688 83.5071 66.3269 83.1875 66.4476C82.8714 66.5648 82.5003 66.6234 82.0742 66.6234ZM82.5749 65.2065C82.962 65.2065 83.2975 65.1301 83.5816 64.9774C83.8657 64.8212 84.0841 64.6152 84.2368 64.3595C84.3931 64.1038 84.4712 63.8251 84.4712 63.5232V62.5591C84.4108 62.6088 84.3078 62.655 84.1622 62.6976C84.0202 62.7402 83.8604 62.7775 83.6828 62.8095C83.5053 62.8414 83.3295 62.8698 83.1555 62.8947C82.9815 62.9195 82.8306 62.9409 82.7027 62.9586C82.4151 62.9977 82.1576 63.0616 81.9304 63.1504C81.7031 63.2391 81.5237 63.3634 81.3924 63.5232C81.261 63.6795 81.1953 63.8819 81.1953 64.1305C81.1953 64.4856 81.3249 64.7537 81.5841 64.9348C81.8434 65.1159 82.1736 65.2065 82.5749 65.2065ZM92.4186 58.2764V59.7679H87.7152V58.2764H92.4186ZM88.8764 56.3162H90.8046V63.9973C90.8046 64.2565 90.8437 64.4554 90.9218 64.5939C91.0035 64.7288 91.11 64.8212 91.2414 64.8709C91.3728 64.9206 91.5184 64.9455 91.6782 64.9455C91.799 64.9455 91.909 64.9366 92.0085 64.9188C92.1115 64.9011 92.1896 64.8851 92.2429 64.8709L92.5678 66.3784C92.4648 66.4139 92.3174 66.4529 92.1257 66.4955C91.9375 66.5382 91.7066 66.563 91.4332 66.5701C90.9502 66.5843 90.5152 66.5115 90.1282 66.3517C89.7411 66.1884 89.4339 65.9362 89.2066 65.5953C88.9829 65.2544 88.8728 64.8283 88.8764 64.3169V56.3162ZM97.5656 66.6181C96.7453 66.6181 96.0368 66.4476 95.4402 66.1067C94.8472 65.7622 94.3908 65.2757 94.0712 64.6472C93.7516 64.0151 93.5918 63.2711 93.5918 62.4153C93.5918 61.5737 93.7516 60.835 94.0712 60.1994C94.3944 59.5602 94.8454 59.063 95.4242 58.7079C96.0031 58.3492 96.6831 58.1699 97.4644 58.1699C97.9686 58.1699 98.4445 58.2516 98.8919 58.4149C99.3429 58.5747 99.7406 58.8233 100.085 59.1607C100.433 59.498 100.707 59.9277 100.905 60.4497C101.104 60.9682 101.204 61.5861 101.204 62.3034V62.8947H94.4974V61.595H99.3553C99.3518 61.2257 99.2719 60.8972 99.1156 60.6095C98.9594 60.3183 98.741 60.0893 98.4604 59.9224C98.1835 59.7555 97.8603 59.672 97.491 59.672C97.0968 59.672 96.7506 59.7679 96.4523 59.9597C96.154 60.1479 95.9214 60.3965 95.7545 60.7054C95.5911 61.0108 95.5077 61.3464 95.5041 61.7122V62.8467C95.5041 63.3226 95.5911 63.731 95.7651 64.0719C95.9391 64.4092 96.1824 64.6685 96.4949 64.8496C96.8074 65.0271 97.1732 65.1159 97.5922 65.1159C97.8727 65.1159 98.1266 65.0769 98.3539 64.9987C98.5812 64.9171 98.7783 64.7981 98.9452 64.6418C99.1121 64.4856 99.2381 64.2921 99.3234 64.0612L101.124 64.2636C101.01 64.7395 100.794 65.155 100.474 65.5101C100.158 65.8617 99.7531 66.1351 99.2595 66.3304C98.7658 66.5222 98.2012 66.6181 97.5656 66.6181Z"
                                        fill="#F7941C" />
                                </g>
                            </svg>

                            <div class="col">
                                <p class="fs-2 fw-medium lh-base m-0">Behavioural Fit Rate:</p>
                                <p class="fs-5 fw-medium lh-base m-0"
                                    style="font-size: 32px !important; color: #F7941C;">Moderate</p>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column gap-4">
                            <div class="second-container gap-9">
                                <p class="m-0">Personality Type:</br>
                                    Genius </p>
                                <div>
                                    <p class="m-0">Growth Potential:</p>
                                    <div style="display:flex;">
                                        <p class="moderate-icon-yellow mb-0"></p>
                                        <p class="m-0">Moderate</p>
                                    </div>
                                </div>
                            </div class="mt-2">
                            <div class="second-container gap-9">
                                <div>
                                    <p class="m-0">Workplace Alignment Forecast:</p>
                                    <div style="display:flex; align-items: center; gap:10px;">
                                        <svg width="18" height="15" viewBox="0 0 13 11" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path id="Polygon 8" d="M6.31983 10.385L12.6397 0.046875H0L6.31983 10.385Z"
                                                fill="#2AA443" />
                                        </svg>
                                        <p class="m-0">Low</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="m-0">Flight Risk:</p>
                                    <div style="display:flex;">
                                        <p class="moderate-icon-yellow mb-0"></p>
                                        <p class="m-0">Moderate</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner" dir="ltr">
                                <div class="top-head-view d-flex justify-content-between align-items-base"
                                    style="margin-bottom: 45px;">
                                    <!--begin::Title-->
                                    <div>
                                        <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">OCEAN
                                            Domain
                                        </h3>
                                        <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span
                                                style="color: #2AA443">Fairly Consistent</span></p>
                                    </div>
                                    <div>
                                        <p class="fs-6 fw-normal lh-base m-0" style="color: #F7941C">View all 30
                                            facets</p>

                                    </div>
                                </div>
                                <!--end::Title-->
                                <div class="skill-table">
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="cyan">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="green">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="green">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="green">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="cyan">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="green">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="cyan">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making<span> 95%</span>
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 4%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="cyan">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <h3 class="fs-2 fw-medium lh-base" style="color: #5B5B5B;">
                                    Learning
                                    Style
                                </h3>
                                <p class="fs-6 fw-normal lh-base d-flex gap-2" style="margin-bottom: 45px;"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="77" height="17"
                                        viewBox="0 0 77 17" fill="none">
                                        <rect width="77" height="17" fill="#FFF6EA" />
                                        <line x1="1" x2="1" y2="17" stroke="#FFBD6F"
                                            stroke-width="2" />
                                    </svg> Candidate’s Learning Style</p>
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="left-table">
                                        <div class="side-line-orange">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="side-line-orange">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>

                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="tweleve-inner">
                                        <p class="tweleve-desc"><iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#F7941C; font-size:14px; "></iconify-icon> Learning Style
                                            Summary</p>
                                        <p class="table-desc"
                                            style="
                                    font-size: 14px; line-height: normal;
                                    ">
                                            Prefers learning through listening and discussions. Excels in environments
                                            that
                                            involve verbal communication and auditory information. Thrives in settings
                                            where
                                            learning can be facilitated through spoken instructions, discussions, and
                                            oral
                                            presentations. </p>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>

                    <div class="mb-9 bg-white psych-inner-2">
                        <div class="skill-div">
                            <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Skills
                                Alignment: Critical Core Skills</p>

                        </div>
                        <div class="skill-table">
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Create individual career and development plans, and
                                            support
                                            co-workers in performing
                                            their work activities</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 0%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Demonstrate sensitivity to the differences in diversity
                                            dimensions and perspectives
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <div class="right-table">
                                            <p class="cyan">99th <span>ADVANCED</span></p>
                                            <p class="table-desc">Highly imaginative, loves novelty and innovation, and
                                                seeks out unique experiences and fresh perspectives.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <h3 class="fs-2 fw-medium lh-base" style="color: #5B5B5B;">
                                    Learning
                                    Style
                                </h3>
                                <p class="fs-6 fw-normal lh-base d-flex gap-2" style="margin-bottom: 45px;"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="77" height="17"
                                        viewBox="0 0 77 17" fill="none">
                                        <rect width="77" height="17" fill="#FFF6EA" />
                                        <line x1="1" x2="1" y2="17" stroke="#FFBD6F"
                                            stroke-width="2" />
                                    </svg> Candidate’s Learning Style</p>
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="left-table">
                                        <div class="side-line-orange">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="side-line-orange">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>

                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="tweleve-inner">
                                        <p class="tweleve-desc"><iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#F7941C; font-size:14px; "></iconify-icon> Learning Style
                                            Summary</p>
                                        <p class="table-desc"
                                            style="
                                    font-size: 14px; line-height: normal;
                                    ">
                                            Prefers learning through listening and discussions. Excels in environments
                                            that
                                            involve verbal communication and auditory information. Thrives in settings
                                            where
                                            learning can be facilitated through spoken instructions, discussions, and
                                            oral
                                            presentations. </p>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>

                    <div class="mb-9 bg-white psych-inner-2">
                        <div class="skill-div">
                            <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Skills
                                Alignment: Critical Core Skills</p>

                        </div>
                        <div class="skill-table">
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Create individual career and development plans, and
                                            support
                                            co-workers in performing
                                            their work activities</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 0%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Demonstrate sensitivity to the differences in diversity
                                            dimensions and perspectives
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Identify opportunities and targets for learning to
                                            facilitate  continuous career
                                            development</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 90%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 9%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Identify opportunities and targets for learning to
                                            facilitate  continuous career
                                            development</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 90%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 9%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-9 bg-white psych-inner-3">
                        <div class="skill-div">
                            <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Other
                                Critical Core Skills</p>

                        </div>
                        <div class="skill-table">
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                            </div>
                        </div>
                        <button class="skill-table-button">View All Critical Core Skills</button>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col 1 -->
                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner" dir="ltr">
                                <!--begin::Title-->
                                <h3 class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Work
                                    Interest
                                </h3>
                                <!--end::Title-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="left-table">
                                        <p class="left-table-head">Communication<span> 100%</span></p>
                                        <p class="table-desc">Communicate with others to share information, respond
                                            to general inquiries and
                                            obtain specific
                                            information </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        <p class="table-desc">Identify opportunities and targets for learning to
                                            facilitate  continuous career
                                            development</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 90%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 9%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Identify opportunities and targets for learning to
                                            facilitate  continuous career
                                            development</p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: 90%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 9%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p class="purple">99th <span>ADVANCED</span></p>
                                    <p class="purple"><span class="fw-bold fs-6"
                                            style="background: none; color: #000 !important; text-transform: capitalize;">Generic
                                            Skills Requirement</span> <span>ADVANCED</span></p>
                                    <p class="purple mt-5"><span>ADVANCED</span></p>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to synthesize complex information and inputs, fully align with the job
                                        requirements. They skillfully communicate a compelling overarching storyline to
                                        multiple stakeholders, ensuring that diverse perspectives are unified in a
                                        clear, strategic, and impactful message.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-9 bg-white psych-inner-3">
                        <div class="skill-div">
                            <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Other
                                Critical Core Skills</p>

                        </div>
                        <div class="skill-table">
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Decision Making<span> 95%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">Follow processes to make decisions which achieve intended
                                            goals using given
                                            information and guidelines</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width: 95%;" class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon" style="right: 4%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="purple">99th <span>ADVANCED</span></p>
                                    </div>
                                    <p class="table-desc">The employees personality traits possesess exceptional
                                        capacity to define comprehensive decision-making criteria, processes, and
                                        strategies,fully align with job requirements. They effectively evaluate the
                                        effectiveness of decisions, demonstrate innovation, and provide valuable
                                        insights that drive strategic success.</p>
                                </div>
                            </div>
                        </div>
                        <button class="skill-table-button">View All Critical Core Skills</button>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col 1 -->
                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner" dir="ltr">
                                <!--begin::Title-->
                                <h3 class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Work
                                    Interest
                                </h3>
                                <!--end::Title-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="left-table">
                                        <p class="left-table-head">Communication<span> 100%</span></p>
                                        <p class="table-desc">Communicate with others to share information, respond
                                            to general inquiries and
                                            obtain specific
                                            information </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <p class="left-table-head">Communication<span> 100%</span></p>
                                        <p class="table-desc">Communicate with others to share information, respond
                                            to general inquiries and
                                            obtain specific
                                            information </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <p class="left-table-head">Communication<span> 100%</span></p>
                                        <p class="table-desc">Communicate with others to share information, respond
                                            to general inquiries and
                                            obtain specific
                                            information </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <p class="left-table-head">Communication<span> 100%</span></p>
                                        <p class="table-desc">Communicate with others to share information, respond
                                            to general inquiries and
                                            obtain specific
                                            information </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <div class="orange-bg">
                                            <p class="left-table-head">Communication<span> 100%</span></p>
                                            <p class="table-desc">Communicate with others to share information, respond
                                                to general inquiries and
                                                obtain specific
                                                information </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="left-table">
                                        <p class="left-table-head">Communication<span> 100%</span></p>
                                        <p class="table-desc">Communicate with others to share information, respond
                                            to general inquiries and
                                            obtain specific
                                            information </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 0%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Candidate’s Top 3 RIASEC:</p>
                                        <p class="work-orange">ESI</p>
                                        <p class="table-desc">Curious, people-oriented, and ambitious, ESI individuals
                                            excel in leadership,
                                            research,
                                            and helping professions, blending analysis, social impact, and business
                                            acumen.
                                        </p>
                                    </div>
                                </div>
                                <!--end::Header-->
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Candidate’s Top 3 RIASEC:</p>
                                        <p class="work-orange">ESI</p>
                                        <p class="table-desc">Curious, people-oriented, and ambitious, ESI individuals
                                            excel in leadership,
                                            research,
                                            and helping professions, blending analysis, social impact, and business
                                            acumen.
                                        </p>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>
                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Personality Type</p>
                                        <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">Genius</p>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc"><span
                                                    style="color: #F7941C; font-weight: 700">Innovative
                                                    Thinking:</span> Geniuses are known
                                                for their creativity and ability to think outside the box, often coming
                                                up with groundbreaking ideas and solutions.</p>
                                            <p class="table-desc"><span>Problem-Solving:</span> They excel at solving
                                                complex problems through analytical thinking and ingenuity.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>
                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Personality Type</p>
                                        <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">Genius</p>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc"><span
                                                    style="color: #F7941C; font-weight: 700">Innovative
                                                    Thinking:</span> Geniuses are known
                                                for their creativity and ability to think outside the box, often coming
                                                up with groundbreaking ideas and solutions.</p>
                                            <p class="table-desc"><span>Problem-Solving:</span> They excel at solving
                                                complex problems through analytical thinking and ingenuity.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->
                                <!--begin::Body-->
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Growth Potential</p>
                                        <div style="display:flex;">
                                            <p class="moderate-icon-yellow mb-0" style="width: 17px; height: 17px;">
                                            </p>
                                            <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">Moderate
                                            </p>
                                        </div>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc">Employee at this level signify <span
                                                    style="color: #F7941C">a balanced capacity</span> to learn and
                                                develop their skills. They are adaptable and capable of managing
                                                changes. With some support and development opportunities, they can grow
                                                into more complex roles and steadily advance in their career path.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->
                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Growth Potential</p>
                                        <div style="display:flex;">
                                            <p class="moderate-icon-yellow mb-0" style="width: 17px; height: 17px;">
                                            </p>
                                            <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">Moderate
                                            </p>
                                        </div>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc">Employee at this level signify <span
                                                    style="color: #F7941C">a balanced capacity</span> to learn and
                                                develop their skills. They are adaptable and capable of managing
                                                changes. With some support and development opportunities, they can grow
                                                into more complex roles and steadily advance in their career path.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>
                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Workplace Alignment Forecast</p>
                                        <p style="color: #5B5B5B !important; font-size: 24px; fw-medium"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="22" height="19"
                                                viewBox="0 0 22 19" fill="none" class="mr-3">
                                                <path d="M10.9992 18.4962L21.9984 0.503418H0L10.9992 18.4962Z"
                                                    fill="#2AA443" />
                                            </svg>Low Risk</p>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc">Employees at a <span style="color: #F7941C">low
                                                    risk</span> level typically exhibit behaviors that support and
                                                strengthen team unity and align well with the company's cultural values.
                                                To maintain their positive contributions, the company should continue to
                                                reinforce these behaviors through regular feedback and recognition.
                                                Encouraging these employees to take on leadership roles or mentoring
                                                responsibilities can further strengthen their commitment and engagement,
                                                ensuring sustained alignment with team dynamics and organizational
                                                goals.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Flight Risk</p>
                                        <div style="display:flex;">
                                            <p class="moderate-icon-yellow mb-0" style="width: 17px; height: 17px;">
                                            </p>
                                            <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">Moderate
                                            </p>
                                        </div>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc">Employees with <span style="color: #F7941C">moderate
                                                    flight risk</span> show average engagement and satisfaction. While
                                                they are somewhat aligned with company goals, they may consider leaving
                                                if their expectations or career needs are not met. The company should
                                                carefully assess the employee’s past performance and contributions to
                                                determine whether targeted support, such as professional development,
                                                recognition, or role adjustments, could enhance their engagement and
                                                satisfaction</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>
                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Workplace Alignment Forecast</p>
                                        <p style="color: #5B5B5B !important; font-size: 24px; fw-medium"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="22" height="19"
                                                viewBox="0 0 22 19" fill="none" class="mr-3">
                                                <path d="M10.9992 18.4962L21.9984 0.503418H0L10.9992 18.4962Z"
                                                    fill="#2AA443" />
                                            </svg>Low Risk</p>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc">Employees at a <span style="color: #F7941C">low
                                                    risk</span> level typically exhibit behaviors that support and
                                                strengthen team unity and align well with the company's cultural values.
                                                To maintain their positive contributions, the company should continue to
                                                reinforce these behaviors through regular feedback and recognition.
                                                Encouraging these employees to take on leadership roles or mentoring
                                                responsibilities can further strengthen their commitment and engagement,
                                                ensuring sustained alignment with team dynamics and organizational
                                                goals.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <div class="psych-bar d-flex flex-column gap-9">
                                    <div class="work-right-inner">
                                        <p class="work-right-head">Flight Risk</p>
                                        <div style="display:flex;">
                                            <p class="moderate-icon-yellow mb-0" style="width: 17px; height: 17px;">
                                            </p>
                                            <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">Moderate
                                            </p>
                                        </div>
                                        <div class="side-line-orange" style="width: 380px">
                                            <p class="table-desc">Employees with <span style="color: #F7941C">moderate
                                                    flight risk</span> show average engagement and satisfaction. While
                                                they are somewhat aligned with company goals, they may consider leaving
                                                if their expectations or career needs are not met. The company should
                                                carefully assess the employee’s past performance and contributions to
                                                determine whether targeted support, such as professional development,
                                                recognition, or role adjustments, could enhance their engagement and
                                                satisfaction</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>

                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner" dir="ltr">
                                <div class="top-head-view d-flex justify-content-between align-items-base"
                                    style="margin-bottom: 45px;">
                                    <!--begin::Title-->
                                    <div>
                                        <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">Overall
                                            Cognitive Ability
                                        </h3>
                                        <p class="fw-medium lh-base m-0" style="color: #2AA443; font-size: 24px;">
                                            Moderate</p>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <div class="skill-table">
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>

                    <div class="d-flex mb-9">
                        <div class="col-xl-6 pr-3 pl-0">
                            <!--begin::Engage widget 1-->
                            <div class="card psych-inner" dir="ltr">
                                <div class="top-head-view d-flex justify-content-between align-items-base"
                                    style="margin-bottom: 45px;">
                                    <!--begin::Title-->
                                    <div>
                                        <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">Overall
                                            Cognitive Ability
                                        </h3>
                                        <p class="fw-medium lh-base m-0" style="color: #2AA443; font-size: 24px;">
                                            Moderate</p>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <div class="skill-table">
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <h3 class="fs-2 fw-medium lh-base" style="color: #5B5B5B;">
                                    Results:
                                </h3>

                                <div class="chart-container">
                                    <svg width="270.501px" height="270.501px" viewBox="0 0 36 36"
                                        class="circular-chart">
                                        <!-- Full Circle (Background) -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#F0F0F0" stroke-width="3"></circle>

                                        <!-- Missed Answers -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#BBA7F6" stroke-width="3" stroke-dasharray="72 28"
                                            stroke-dashoffset="0"></circle>

                                        <!-- Wrong Answers -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#FFDC92" stroke-width="3" stroke-dasharray="28 72"
                                            stroke-dashoffset="-72"></circle>

                                        <!-- correct Questions -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#8CE3E3" stroke-width="3" stroke-dasharray="15 85"
                                            stroke-dashoffset="-100"></circle>
                                    </svg>

                                    <!-- Labels -->
                                    <div class="chart-label correct-label">
                                        72% <br />CORRECT ANSWERS
                                    </div>
                                    <div class="chart-label wrong-label">
                                        28% <br />WRONG ANSWERS
                                    </div>
                                    <div class="chart-label missed-label">
                                        15% <br />MISSED QUESTIONS
                                    </div>
                                </div>


                                <div class="circle-second-div">
                                    <p><span class="correct"></span>Correct Answers</p>
                                    <p><span class="wrong"></span>Wrong Answers</p>
                                    <p><span class="missed"></span>Wrong Answers</p>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Panel 2-->

                <!--begin::Panel 3-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="card mb-12 psych-inner mt-4" style="color: #5B5B5B;">
                        <div class="kpi-top-head d-flex justify-content-between align-items-center">
                            <p class="fw-medium fs-4 m-0">Historical Data</p>
                            <div class="kpi-side-dropdown-btn gap-2">
                                <iconify-icon icon="uil:calender" class="kpi-calender"></iconify-icon>
                                <select class="form-select kp-select" data-placeholder="Technical Skills Ratings">
                                    <option selected="Selected" value="">
                                        Technical Skills Ratings</option>
                                    <option selected="Selected" value="">
                                        KPI Skills Ratings</option>
                                </select>
                            </div>
                        </div>
                        <div id="chart"></div>
                    </div>
                    <div class="mb-9">
                        <div class="kpi-top-head d-flex justify-content-between align-items-center mb-4"
                            style="color: #5B5B5B;">
                            <p class="m-0"></p>
                            <div class="kpi-side-dropdown-btn gap-2">
                                <iconify-icon icon="uil:calender" class="kpi-calender"></iconify-icon>
                                <select class="form-select kp-select" data-placeholder="End-Year 2024">
                                    <option selected="Selected" value="">
                                        End-Year 2024</option>
                                    <option selected="Selected" value="">
                                        Mid Year 2024</option>
                                    <option selected="Selected" value="">
                                        End-Year 2023</option>
                                    <option selected="Selected" value="">
                                        Mid Year 2023</option>
                                </select>
                            </div>
                        </div>
                        <div class="card psych-inner">
                            <div class="kpi-first">
                                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">KPI Ratings (70% Weightage)
                                </p>
                                <div class="kpi-inner d-grid gap-14 align-items-start">
                                    <div class="donut-1">
                                        <div class="kpi-circular-progress">
                                            <div class="kpi-circle-content">
                                              <h3 class="m-0">2.68/3.00</h3>
                                              <p class="m-0">Total Weighted Ratings</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="table-first">
                                        <p class="kpi-table-head">Objectives: Ensure Efficient Turnaround Operations
                                            (Weightage: 30%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Ensure Efficient Turnaround Operations</td>
                                                    <td>2</td>
                                                    <td>Kavitha has consistently improved TAT by collaborating
                                                        effectively with ground teams. Further efforts in
                                                        cross-department communication could achieve stretch targets.
                                                    </td>
                                                    <td>≤ 35 minutes per flight</td>
                                                    <td>≤ 30 minutes per flight</td>
                                                    <td>80% stretch target achieved</td>
                                                    <td>I aim to work on faster issue resolution during peak hours and
                                                        improve coordination with external service providers to meet
                                                        stretch targets</td>
                                                    <td><b>24%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Maintain Safety Compliance During
                                            Turnaround (Weightage: 25%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Percentage of Flights with Zero Safety Incidents</td>
                                                    <td>2</td>
                                                    <td>Strong attention to detail in adhering to safety protocols.
                                                        Additional training on incident reporting may help achieve
                                                        perfect compliance</td>
                                                    <td>98% compliance rate</td>
                                                    <td>100% compliance rate</td>
                                                    <td>93% stretch target achieved</td>
                                                    <td>I’m committed to maintaining high safety standards and would
                                                        like to participate in advanced safety training programs</td>
                                                    <td><b>23.5%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Optimize Resource Allocation
                                            (Weightage: 20%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Percentage of Flights Completed with Optimal Resource Usage</td>
                                                    <td>2</td>
                                                    <td>Good use of available tools to manage resources. Suggest
                                                        integrating predictive scheduling for even better results.</td>
                                                    <td>90% of flights</td>
                                                    <td>90% of flights</td>
                                                    <td>88% stretch target achieved</td>
                                                    <td>I plan to enhance my skills in resource optimization tools to
                                                        meet the stretch target consistently</td>
                                                    <td><b>17.6%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Improve Communication and
                                            Coordination (Weightage: 15%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Number of Complaints Related to Team Communication</td>
                                                    <td>2</td>
                                                    <td>Kavitha has made notable improvements in proactive
                                                        communication. Regular team check-ins could further reduce
                                                        complaints.</td>
                                                    <td>≤ 5 complaints per quarter</td>
                                                    <td>≤ 5 complaints per quarter</td>
                                                    <td>95% stretch target achieved</td>
                                                    <td>I intend to implement a more structured briefing process to
                                                        ensure smoother coordination.</td>
                                                    <td><b>14.25%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Support Allstar Values in Daily
                                            Operations (Weightage: 10%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Employee Alignment with Allstar Values in Peer Reviews</td>
                                                    <td>3</td>
                                                    <td>Peers appreciate your leadership and adherence to Allstar
                                                        Values. Continue mentoring team members to enhance the team’s
                                                        overall alignment.</td>
                                                    <td>80% positive peer feedback</td>
                                                    <td>90% positive peer feedback</td>
                                                    <td>100% stretch target achieved</td>
                                                    <td>I will focus on embodying Allstar Values in my interactions and
                                                        take initiative in team-building activities.</td>
                                                    <td><b>10%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot-total mb-0">Total Stretch Target Achieved:
                                            <span>89.35%</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom mb-14 mt-14"></div>
                            <div class="kpi-second">
                                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Skill Development Ratings
                                    (30% Weightage)</p>
                                <div class="kpi-inner d-grid gap-14 align-items-start">
                                    <div class="donut-2">
                                        <div class="kpi-circular-progress">
                                            <div class="kpi-circle-content">
                                              <h3 class="m-0">2.68/3.00</h3>
                                              <p class="m-0">Total Weighted Ratings</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="table-first">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Technical Skill (15%)</th>
                                                    <th>Rating</th>
                                                    <th>Minimal Level</th>
                                                    <th>Gap</th>
                                                    <th>Employee Planning</th>
                                                    <th>Manager Evaluation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot mb-0">Total Technical Skills Rating: <span>100%</span>
                                        </p>
                                        <table class="mt-14">
                                            <thead>
                                                <tr>
                                                    <th>Technical Skill (15%)</th>
                                                    <th>Rating</th>
                                                    <th>Minimal Level</th>
                                                    <th>Gap</th>
                                                    <th>Employee Planning</th>
                                                    <th>Manager Evaluation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot mb-0">Total Technical Skills Rating: <span>100%</span>
                                        </p>
                                        <p class="sd-table-bot-total mb-0">Total Skills Rating: <span>100%</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom mb-14 mt-14"></div>
                            <div class="kpi-third">
                                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Performance Ratings</p>
                                <div class="kpi-inner d-grid gap-14 align-items-start">
                                    <div class="donut-1">
                                        <div class="semi-circle-progress">
                                            <div class="kpi-circle-content" style="
                                            top: 24%;
                                        ">
                                              <h3 class="m-0">Level 3</h3>
                                              <p class="m-0">Performance Rating</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="kp-table-third">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th
                                                        style="
                                                text-align: right;
                                            ">
                                                        Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>KPI Rating</td>
                                                    <td
                                                        style="
                                                text-align: right;
                                            ">
                                                        <p class="m-0">(KPI Rating raw score) <span>89.35%</span>
                                                        </p>
                                                        <p class="m-0 mt-1"><b>(70% Weightage) <span>62.55%</span></b>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Skills Development Rating</td>
                                                    <td
                                                        style="
                                                text-align: right;
                                            ">
                                                        <p class="m-0">(Technical Skills raw score)
                                                            <span>100%</span>
                                                        </p>
                                                        <p class="m-0 mt-1">(Soft Skills raw score) <span>100%</span>
                                                        </p>
                                                        <p class="m-0 mt-1"><b>(30% Weightage) <span>30%</p>
                                                        </b></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot-total mb-0"
                                            style="
                                          border-top: 1px solid #DBDFE9;
                                      ">
                                            Total Performance Score: <span>92.55%</span></p>
                                    </div>
                                </div>
                            </div>
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div>
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>Decision Making
                                                    <p>
                                                </div>
                                                <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                    try new things. They tend to have a wide range of interests and a
                                                    vivid imagination.</p>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-fill">
                                                    <div class="progress-segment segment-yellow"></div>
                                                    <div class="progress-segment segment-orange"></div>
                                                    <div class="progress-segment segment-blue"></div>
                                                </div>
                                                <div class="progress-circle">
                                                    <img src="/Public/ProgressCircle.svg" alt="Progress Circle" />
                                                </div>
                                            </div>
                                            <p class="cyan"><span class="fw-bold fs-6 p-0 pr-2"
                                                    style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                                                </span> <span>High</span></p>
                                            <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                                try new things. They tend to have a wide range of interests and a
                                                vivid imagination.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col 1-->

                        <!--begin::Col 2-->
                        <div class="col-xl-6 pl-3">
                            <!--begin::Chart widget 5-->
                            <div class="card psych-inner">
                                <!--begin::Header-->
                                <h3 class="fs-2 fw-medium lh-base" style="color: #5B5B5B;">
                                    Results:
                                </h3>

                                <div class="chart-container">
                                    <svg width="270.501px" height="270.501px" viewBox="0 0 36 36"
                                        class="circular-chart">
                                        <!-- Full Circle (Background) -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#F0F0F0" stroke-width="3"></circle>

                                        <!-- Missed Answers -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#BBA7F6" stroke-width="3" stroke-dasharray="72 28"
                                            stroke-dashoffset="0"></circle>

                                        <!-- Wrong Answers -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#FFDC92" stroke-width="3" stroke-dasharray="28 72"
                                            stroke-dashoffset="-72"></circle>

                                        <!-- correct Questions -->
                                        <circle cx="18" cy="18" r="15.915" fill="none"
                                            stroke="#8CE3E3" stroke-width="3" stroke-dasharray="15 85"
                                            stroke-dashoffset="-100"></circle>
                                    </svg>

                                    <!-- Labels -->
                                    <div class="chart-label correct-label">
                                        72% <br />CORRECT ANSWERS
                                    </div>
                                    <div class="chart-label wrong-label">
                                        28% <br />WRONG ANSWERS
                                    </div>
                                    <div class="chart-label missed-label">
                                        15% <br />MISSED QUESTIONS
                                    </div>
                                </div>


                                <div class="circle-second-div">
                                    <p><span class="correct"></span>Correct Answers</p>
                                    <p><span class="wrong"></span>Wrong Answers</p>
                                    <p><span class="missed"></span>Wrong Answers</p>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Panel 2-->

                <!--begin::Panel 3-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="card mb-12 psych-inner mt-4" style="color: #5B5B5B;">
                        <div class="kpi-top-head d-flex justify-content-between align-items-center">
                            <p class="fw-medium fs-4 m-0">Historical Data</p>
                            <div class="kpi-side-dropdown-btn gap-2">
                                <iconify-icon icon="uil:calender" class="kpi-calender"></iconify-icon>
                                <select class="form-select kp-select" data-placeholder="Technical Skills Ratings">
                                    <option selected="Selected" value="">
                                        Technical Skills Ratings</option>
                                    <option selected="Selected" value="">
                                        KPI Skills Ratings</option>
                                </select>
                            </div>
                        </div>
                        <div id="chart"></div>
                    </div>
                    <div class="mb-9">
                        <div class="kpi-top-head d-flex justify-content-between align-items-center mb-4"
                            style="color: #5B5B5B;">
                            <p class="m-0"></p>
                            <div class="kpi-side-dropdown-btn gap-2">
                                <iconify-icon icon="uil:calender" class="kpi-calender"></iconify-icon>
                                <select class="form-select kp-select" data-placeholder="End-Year 2024">
                                    <option selected="Selected" value="">
                                        End-Year 2024</option>
                                    <option selected="Selected" value="">
                                        Mid Year 2024</option>
                                    <option selected="Selected" value="">
                                        End-Year 2023</option>
                                    <option selected="Selected" value="">
                                        Mid Year 2023</option>
                                </select>
                            </div>
                        </div>
                        <div class="card psych-inner">
                            <div class="kpi-first">
                                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">KPI Ratings (70% Weightage)
                                </p>
                                <div class="kpi-inner d-grid gap-14 align-items-start">
                                    <div class="donut-1">
                                        <div class="kpi-circular-progress">
                                            <div class="kpi-circle-content">
                                              <h3 class="m-0">2.68/3.00</h3>
                                              <p class="m-0">Total Weighted Ratings</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="table-first">
                                        <p class="kpi-table-head">Objectives: Ensure Efficient Turnaround Operations
                                            (Weightage: 30%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Ensure Efficient Turnaround Operations</td>
                                                    <td>2</td>
                                                    <td>Kavitha has consistently improved TAT by collaborating
                                                        effectively with ground teams. Further efforts in
                                                        cross-department communication could achieve stretch targets.
                                                    </td>
                                                    <td>≤ 35 minutes per flight</td>
                                                    <td>≤ 30 minutes per flight</td>
                                                    <td>80% stretch target achieved</td>
                                                    <td>I aim to work on faster issue resolution during peak hours and
                                                        improve coordination with external service providers to meet
                                                        stretch targets</td>
                                                    <td><b>24%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Maintain Safety Compliance During
                                            Turnaround (Weightage: 25%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Percentage of Flights with Zero Safety Incidents</td>
                                                    <td>2</td>
                                                    <td>Strong attention to detail in adhering to safety protocols.
                                                        Additional training on incident reporting may help achieve
                                                        perfect compliance</td>
                                                    <td>98% compliance rate</td>
                                                    <td>100% compliance rate</td>
                                                    <td>93% stretch target achieved</td>
                                                    <td>I’m committed to maintaining high safety standards and would
                                                        like to participate in advanced safety training programs</td>
                                                    <td><b>23.5%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Optimize Resource Allocation
                                            (Weightage: 20%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Percentage of Flights Completed with Optimal Resource Usage</td>
                                                    <td>2</td>
                                                    <td>Good use of available tools to manage resources. Suggest
                                                        integrating predictive scheduling for even better results.</td>
                                                    <td>90% of flights</td>
                                                    <td>90% of flights</td>
                                                    <td>88% stretch target achieved</td>
                                                    <td>I plan to enhance my skills in resource optimization tools to
                                                        meet the stretch target consistently</td>
                                                    <td><b>17.6%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Improve Communication and
                                            Coordination (Weightage: 15%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Number of Complaints Related to Team Communication</td>
                                                    <td>2</td>
                                                    <td>Kavitha has made notable improvements in proactive
                                                        communication. Regular team check-ins could further reduce
                                                        complaints.</td>
                                                    <td>≤ 5 complaints per quarter</td>
                                                    <td>≤ 5 complaints per quarter</td>
                                                    <td>95% stretch target achieved</td>
                                                    <td>I intend to implement a more structured briefing process to
                                                        ensure smoother coordination.</td>
                                                    <td><b>14.25%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="kpi-table-head mt-8">Objectives: Support Allstar Values in Daily
                                            Operations (Weightage: 10%)</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Rating</th>
                                                    <th>Base Target</th>
                                                    <th>Gap</th>
                                                    <th>Stretch Target</th>
                                                    <th>Result</th>
                                                    <th>Employee Comments</th>
                                                    <th>Objective Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Employee Alignment with Allstar Values in Peer Reviews</td>
                                                    <td>3</td>
                                                    <td>Peers appreciate your leadership and adherence to Allstar
                                                        Values. Continue mentoring team members to enhance the team’s
                                                        overall alignment.</td>
                                                    <td>80% positive peer feedback</td>
                                                    <td>90% positive peer feedback</td>
                                                    <td>100% stretch target achieved</td>
                                                    <td>I will focus on embodying Allstar Values in my interactions and
                                                        take initiative in team-building activities.</td>
                                                    <td><b>10%</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot-total mb-0">Total Stretch Target Achieved:
                                            <span>89.35%</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom mb-14 mt-14"></div>
                            <div class="kpi-second">
                                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Skill Development Ratings
                                    (30% Weightage)</p>
                                <div class="kpi-inner d-grid gap-14 align-items-start">
                                    <div class="donut-2">
                                        <div class="kpi-circular-progress">
                                            <div class="kpi-circle-content">
                                              <h3 class="m-0">2.68/3.00</h3>
                                              <p class="m-0">Total Weighted Ratings</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="table-first">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Technical Skill (15%)</th>
                                                    <th>Rating</th>
                                                    <th>Minimal Level</th>
                                                    <th>Gap</th>
                                                    <th>Employee Planning</th>
                                                    <th>Manager Evaluation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot mb-0">Total Technical Skills Rating: <span>100%</span>
                                        </p>
                                        <table class="mt-14">
                                            <thead>
                                                <tr>
                                                    <th>Technical Skill (15%)</th>
                                                    <th>Rating</th>
                                                    <th>Minimal Level</th>
                                                    <th>Gap</th>
                                                    <th>Employee Planning</th>
                                                    <th>Manager Evaluation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td>Aircraft Turnaround Coordination</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot mb-0">Total Technical Skills Rating: <span>100%</span>
                                        </p>
                                        <p class="sd-table-bot-total mb-0">Total Skills Rating: <span>100%</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom mb-14 mt-14"></div>
                            <div class="kpi-third">
                                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Performance Ratings</p>
                                <div class="kpi-inner d-grid gap-14 align-items-start">
                                    <div class="donut-1">
                                        <div class="semi-circle-progress">
                                            <div class="kpi-circle-content" style="
                                            top: 24%;
                                        ">
                                              <h3 class="m-0">Level 3</h3>
                                              <p class="m-0">Performance Rating</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="kp-table-third">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th
                                                        style="
                                                text-align: right;
                                            ">
                                                        Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>KPI Rating</td>
                                                    <td
                                                        style="
                                                text-align: right;
                                            ">
                                                        <p class="m-0">(KPI Rating raw score) <span>89.35%</span>
                                                        </p>
                                                        <p class="m-0 mt-1"><b>(70% Weightage) <span>62.55%</span></b>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Skills Development Rating</td>
                                                    <td
                                                        style="
                                                text-align: right;
                                            ">
                                                        <p class="m-0">(Technical Skills raw score)
                                                            <span>100%</span>
                                                        </p>
                                                        <p class="m-0 mt-1">(Soft Skills raw score) <span>100%</span>
                                                        </p>
                                                        <p class="m-0 mt-1"><b>(30% Weightage) <span>30%</p>
                                                        </b></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="sd-table-bot-total mb-0"
                                            style="
                                          border-top: 1px solid #DBDFE9;
                                      ">
                                            Total Performance Score: <span>92.55%</span></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--begin::Panel 4-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_skills" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="succession-head"><iconify-icon icon="material-symbols:table-chart-view-outline"
                            class="success-chart"></iconify-icon>
                        <p>Succession Plan</p>
                    </div>
                    <div class="d-flex mb-4 gap-4 mt-4">
                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">65% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Turnaround Coordinator</h5>
                                        <span class="s-current">Current</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Turnaround Coordinator at AirAsia is responsible for
                                        ensuring the smooth and
                                        efficient management of flight operations during turnaround processes. This role
                                        involves coordinating with relevant stakeholders such as airlines, airport
                                        agencies, and authorities to resolve any operational issues. The coordinator
                                        ensures all flight planning activities align with Standard Operating Procedures
                                        (SOPs) and established standards. They oversee safety and security protocols,
                                        performing checks and investigations into breaches. Additionally, the role
                                        requires strong leadership, as the coordinator mentors team members, resolves
                                        conflicts, and maintains high communication standards to foster positive
                                        relationships with both internal and external parties. The position requires a
                                        solid understanding of flight watching systems and the ability to manage
                                        operations across varying shifts.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Customer Orientation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Accident and Incident Response Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <!--begin::Panel 4-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_skills" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="succession-head"><iconify-icon icon="material-symbols:table-chart-view-outline"
                            class="success-chart"></iconify-icon>
                        <p>Succession Plan</p>
                    </div>
                    <div class="d-flex mb-4 gap-4 mt-4">
                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">65% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Turnaround Coordinator</h5>
                                        <span class="s-current">Current</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Turnaround Coordinator at AirAsia is responsible for
                                        ensuring the smooth and
                                        efficient management of flight operations during turnaround processes. This role
                                        involves coordinating with relevant stakeholders such as airlines, airport
                                        agencies, and authorities to resolve any operational issues. The coordinator
                                        ensures all flight planning activities align with Standard Operating Procedures
                                        (SOPs) and established standards. They oversee safety and security protocols,
                                        performing checks and investigations into breaches. Additionally, the role
                                        requires strong leadership, as the coordinator mentors team members, resolves
                                        conflicts, and maintains high communication standards to foster positive
                                        relationships with both internal and external parties. The position requires a
                                        solid understanding of flight watching systems and the ability to manage
                                        operations across varying shifts.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Customer Orientation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Accident and Incident Response Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0 card-cyan">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-green-right">93% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Rostering Planner</h5>
                                        <span class="s-career-goal">Next Career Goal</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Rostering Planner at AirAsia is responsible for managing
                                        and optimizing crew rosters to ensure efficient deployment and compliance with
                                        regulatory and operational requirements. This role involves monitoring flight
                                        operations, including aircraft performance, movements, and operating conditions,
                                        and adjusting crew schedules as needed to address irregularities. The Rostering
                                        Planner collaborates with internal teams and stakeholders to recover disrupted
                                        flight schedules and ensures adherence to safety and security standards. Working
                                        in a shift-based environment, the Rostering Planner demonstrates strong resource
                                        management skills and excels in preparing and managing schedules. Effective
                                        communication and interpersonal skills are essential to work collaboratively
                                        with team members, pilots, and stakeholders. The ideal candidate is
                                        detail-oriented, adaptable, and maintains high performance and alertness during
                                        flight watch periods.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airline Operations Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Change Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Data Analytics</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">2</p>
                        <div class="card col p-0 card-cyan">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-green-right">93% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Rostering Planner</h5>
                                        <span class="s-career-goal">Next Career Goal</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Rostering Planner at AirAsia is responsible for managing
                                        and optimizing crew rosters to ensure efficient deployment and compliance with
                                        regulatory and operational requirements. This role involves monitoring flight
                                        operations, including aircraft performance, movements, and operating conditions,
                                        and adjusting crew schedules as needed to address irregularities. The Rostering
                                        Planner collaborates with internal teams and stakeholders to recover disrupted
                                        flight schedules and ensures adherence to safety and security standards. Working
                                        in a shift-based environment, the Rostering Planner demonstrates strong resource
                                        management skills and excels in preparing and managing schedules. Effective
                                        communication and interpersonal skills are essential to work collaboratively
                                        with team members, pilots, and stakeholders. The ideal candidate is
                                        detail-oriented, adaptable, and maintains high performance and alertness during
                                        flight watch periods.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airline Operations Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Change Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Data Analytics</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">2</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">63% Match</span>
                                        <a href="#" data-kt-menu-trigger="click"
                                            data-kt-menu-placement="bottom-end">
                                            <iconify-icon icon="entypo:dots-three-vertical">
                                                <iconify-icon icon="humbleicons:dots-vertical"
                                                    class="three-dots"></iconify-icon></a>
                                        <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content"
                                            data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                                            <p class="m-0 px-4 py-2">Tag as successor</p>
                                            <p class="m-0 px-4 py-2">Remove as successor</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Rostering Planning Supervisor</h5>
                                        <iconify-icon icon="ri:arrow-up-circle-line"
                                            style="color: #78829D; font-size: 24px;" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Successor"></iconify-icon>
                                    </div>
                                    <p class="mb-0 mt-2">The Rostering Planning Supervisor at AirAsia is a leadership
                                        role responsible for coordinating crew scheduling and overseeing critical
                                        operational functions to ensure seamless flight operations. This role involves
                                        managing crew rosters, tracking flight crew hours, and implementing changes to
                                        operations while ensuring compliance with safety and security standards. The
                                        Rostering Planning Supervisor performs impact analyses of external issues,
                                        investigates causes and cost implications of irregular operations, and develops
                                        strategies to address disruptions. As a supervisor, this role includes coaching
                                        team members, creating on-the-job training plans, and fostering a
                                        high-performance culture. Operating in a shift-based environment, the Rostering
                                        Planning Supervisor demonstrates exceptional organizational skills, remains calm
                                        under pressure, and effectively handles complex operational challenges.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">63% Match</span>
                                        <a href="#" data-kt-menu-trigger="click"
                                            data-kt-menu-placement="bottom-end">
                                            <iconify-icon icon="entypo:dots-three-vertical">
                                                <iconify-icon icon="humbleicons:dots-vertical"
                                                    class="three-dots"></iconify-icon></a>
                                        <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content"
                                            data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                                            <p class="m-0 px-4 py-2">Tag as successor</p>
                                            <p class="m-0 px-4 py-2">Remove as successor</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Rostering Planning Supervisor</h5>
                                        <iconify-icon icon="ri:arrow-up-circle-line"
                                            style="color: #78829D; font-size: 24px;" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Successor"></iconify-icon>
                                    </div>
                                    <p class="mb-0 mt-2">The Rostering Planning Supervisor at AirAsia is a leadership
                                        role responsible for coordinating crew scheduling and overseeing critical
                                        operational functions to ensure seamless flight operations. This role involves
                                        managing crew rosters, tracking flight crew hours, and implementing changes to
                                        operations while ensuring compliance with safety and security standards. The
                                        Rostering Planning Supervisor performs impact analyses of external issues,
                                        investigates causes and cost implications of irregular operations, and develops
                                        strategies to address disruptions. As a supervisor, this role includes coaching
                                        team members, creating on-the-job training plans, and fostering a
                                        high-performance culture. Operating in a shift-based environment, the Rostering
                                        Planning Supervisor demonstrates exceptional organizational skills, remains calm
                                        under pressure, and effectively handles complex operational challenges.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Digital Fluency</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Learning Agility</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Flight Performance Data Calculation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Digital Fluency</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Learning Agility</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Flight Performance Data Calculation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-4 gap-4">
                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">3</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">63% Match</span>
                                        <iconify-icon icon="humbleicons:dots-vertical"
                                            class="three-dots"></iconify-icon>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Manager Rostering & Advanced Crewing</h5>
                                    </div>
                                    <p class="mb-0 mt-2">The Manager, Rostering & Advanced Crewing at AirAsia is a
                                        pivotal leadership role responsible for planning, directing, and coordinating
                                        crew scheduling and advanced crewing operations to ensure optimal efficiency,
                                        safety, and compliance. This role involves managing rostering systems,
                                        overseeing the administration of crew-related activities within the Operations
                                        Control Center (OCC), and developing strategies to enhance crew operations.
                                        During irregular operations, the Manager activates emergency response plans,
                                        communicates contingency measures to stakeholders, and ensures timely recovery
                                        of schedules. The role requires identifying safety and security risks and
                                        implementing mitigation strategies. Additionally, the Manager oversees team
                                        assessment and selection, fosters partnerships with stakeholders, and builds
                                        collaborative relationships with internal and external partners, including
                                        airport agencies and regulatory authorities. The ideal candidate demonstrates
                                        exceptional leadership, negotiation, and problem-solving skills. They are a
                                        strategic thinker, capable of maintaining composure under pressure, and adept at
                                        devising solutions to address complex operational challenges.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Global Perspective</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Aircraft Performance Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-4 gap-4">
                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">3</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">63% Match</span>
                                        <iconify-icon icon="humbleicons:dots-vertical"
                                            class="three-dots"></iconify-icon>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Manager Rostering & Advanced Crewing</h5>
                                    </div>
                                    <p class="mb-0 mt-2">The Manager, Rostering & Advanced Crewing at AirAsia is a
                                        pivotal leadership role responsible for planning, directing, and coordinating
                                        crew scheduling and advanced crewing operations to ensure optimal efficiency,
                                        safety, and compliance. This role involves managing rostering systems,
                                        overseeing the administration of crew-related activities within the Operations
                                        Control Center (OCC), and developing strategies to enhance crew operations.
                                        During irregular operations, the Manager activates emergency response plans,
                                        communicates contingency measures to stakeholders, and ensures timely recovery
                                        of schedules. The role requires identifying safety and security risks and
                                        implementing mitigation strategies. Additionally, the Manager oversees team
                                        assessment and selection, fosters partnerships with stakeholders, and builds
                                        collaborative relationships with internal and external partners, including
                                        airport agencies and regulatory authorities. The ideal candidate demonstrates
                                        exceptional leadership, negotiation, and problem-solving skills. They are a
                                        strategic thinker, capable of maintaining composure under pressure, and adept at
                                        devising solutions to address complex operational challenges.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Global Perspective</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Aircraft Performance Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0 card-pink">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">4</p>
                        <div class="card col p-0 card-pink">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">4</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-pink-right">32% Match</span>
                                        <iconify-icon icon="humbleicons:dots-vertical"
                                            class="three-dots"></iconify-icon>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Group Head of Network Management Center</h5>
                                    </div>
                                    <p class="mb-0 mt-2">The Group Head of Network Management Center at AirAsia is a
                                        senior leadership position responsible for the strategic oversight and alignment
                                        of flight control operations across the organization. This role ensures that
                                        AirAsia's flight operations adhere to the highest standards of safety,
                                        efficiency, and customer satisfaction. The role involves establishing and
                                        endorsing policies, response models for irregular operations, and ensuring
                                        seamless coordination with internal and external stakeholders during such
                                        events. As a key leader, the Group Head drives the development of safety and
                                        security programs, defines organizational standards, and leads initiatives for
                                        succession planning, capability development, and employee engagement. By
                                        building strong international networks and professional relationships, the Group
                                        Head plays a vital role in promoting AirAsia’s reputation globally. Exceptional
                                        leadership, situational awareness, and attention to detail are essential for
                                        this role. The Group Head leverages negotiation skills and problem-solving
                                        expertise to create innovative services that enhance stakeholder and customer
                                        satisfaction while fostering a high-performance organizational culture.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Customer Orientation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Global Perspective</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="col p-0">
                        </div>
                    </div>
                </div>
                <!--end::Panel 4-->

                <!--begin::Panel 5-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_careers" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="succession-head">
                        <p class="fw-bolder" style="font-size: 22.75px; line-height: 27.3px">Career Aspiration Goals
                        </p>
                    </div>
                    <div class="card mb-9 p-10 d-grid gap-13 mt-4" style="color: #5B5B5B;">
                        <div>
                            <p class="fw-bold mb-3">Short Term Goal:</p>
                            <p class="mb-0">Role Transition, Roster Planner</p>
                        </div>
                        <div>
                            <p class="fw-bold mb-3">Long Term Goal:</p>
                            <p class="mb-0">Promotion, Roster Planning Supervisor</p>
                                    <div class="s-top-right">
                                        <span class="s-pink-right">32% Match</span>
                                        <iconify-icon icon="humbleicons:dots-vertical"
                                            class="three-dots"></iconify-icon>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Group Head of Network Management Center</h5>
                                    </div>
                                    <p class="mb-0 mt-2">The Group Head of Network Management Center at AirAsia is a
                                        senior leadership position responsible for the strategic oversight and alignment
                                        of flight control operations across the organization. This role ensures that
                                        AirAsia's flight operations adhere to the highest standards of safety,
                                        efficiency, and customer satisfaction. The role involves establishing and
                                        endorsing policies, response models for irregular operations, and ensuring
                                        seamless coordination with internal and external stakeholders during such
                                        events. As a key leader, the Group Head drives the development of safety and
                                        security programs, defines organizational standards, and leads initiatives for
                                        succession planning, capability development, and employee engagement. By
                                        building strong international networks and professional relationships, the Group
                                        Head plays a vital role in promoting AirAsia’s reputation globally. Exceptional
                                        leadership, situational awareness, and attention to detail are essential for
                                        this role. The Group Head leverages negotiation skills and problem-solving
                                        expertise to create innovative services that enhance stakeholder and customer
                                        satisfaction while fostering a high-performance organizational culture.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Customer Orientation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Global Perspective</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="col p-0">
                        </div>
                    </div>
                </div>
                <!--end::Panel 4-->

                <!--begin::Panel 5-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_careers" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="succession-head">
                        <p class="fw-bolder" style="font-size: 22.75px; line-height: 27.3px">Career Aspiration Goals
                        </p>
                    </div>
                    <div class="card mb-9 p-10 d-grid gap-13 mt-4" style="color: #5B5B5B;">
                        <div>
                            <p class="fw-bold mb-3">Short Term Goal:</p>
                            <p class="mb-0">Role Transition, Roster Planner</p>
                        </div>
                        <div>
                            <p class="fw-bold mb-3">Long Term Goal:</p>
                            <p class="mb-0">Promotion, Roster Planning Supervisor</p>
                        </div>
                        <div>
                            <p class="fw-bold mb-3">Desired-Future Roles:</p>
                            <p class="mb-0">Manager Rostering & Advance Crewing</p>
                        </div>
                        <div>
                            <p class="fw-bold mb-3">Cross-Departmental Roles:</p>
                            <p class="mb-0">No</p>
                        </div>

                    </div>
                    <div class="career-path-head">
                        <div class="succession-head"><iconify-icon icon="material-symbols:table-chart-view-outline"
                                class="success-chart"></iconify-icon>
                            <p class="">Next Career Growth (Role Transition):</p>
                            <div class="s-top-left d-flex align-items-center gap-1">
                                <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                <p class="m-0 fs-4 fw-medium">1</p>
                            </div>
                            <p class="fw-bolder">Rostering Planner</p>
                        </div>
                        <button style="border: none">Career Map<iconify-icon icon="material-symbols:zoom-out-map"
                                class="career-map-icon"></iconify-icon></button>
                    </div>
                    <div class="d-flex mb-9 gap-4 mt-4">
                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">65% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Turnaround Coordinator</h5>
                                        <span class="s-current">Current</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Turnaround Coordinator at AirAsia is responsible for
                                        ensuring the smooth and
                                        efficient management of flight operations during turnaround processes. This role
                                        involves coordinating with relevant stakeholders such as airlines, airport
                                        agencies, and authorities to resolve any operational issues. The coordinator
                                        ensures all flight planning activities align with Standard Operating Procedures
                                        (SOPs) and established standards. They oversee safety and security protocols,
                                        performing checks and investigations into breaches. Additionally, the role
                                        requires strong leadership, as the coordinator mentors team members, resolves
                                        conflicts, and maintains high communication standards to foster positive
                                        relationships with both internal and external parties. The position requires a
                                        solid understanding of flight watching systems and the ability to manage
                                        operations across varying shifts.
                                    </p>
                        <div>
                            <p class="fw-bold mb-3">Desired-Future Roles:</p>
                            <p class="mb-0">Manager Rostering & Advance Crewing</p>
                        </div>
                        <div>
                            <p class="fw-bold mb-3">Cross-Departmental Roles:</p>
                            <p class="mb-0">No</p>
                        </div>

                    </div>
                    <div class="career-path-head">
                        <div class="succession-head"><iconify-icon icon="material-symbols:table-chart-view-outline"
                                class="success-chart"></iconify-icon>
                            <p class="">Next Career Growth (Role Transition):</p>
                            <div class="s-top-left d-flex align-items-center gap-1">
                                <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                <p class="m-0 fs-4 fw-medium">1</p>
                            </div>
                            <p class="fw-bolder">Rostering Planner</p>
                        </div>
                        <button style="border: none">Career Map<iconify-icon icon="material-symbols:zoom-out-map"
                                class="career-map-icon"></iconify-icon></button>
                    </div>
                    <div class="d-flex mb-9 gap-4 mt-4">
                        <div class="card col p-0 card-orange">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-yellow-right">65% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Turnaround Coordinator</h5>
                                        <span class="s-current">Current</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Turnaround Coordinator at AirAsia is responsible for
                                        ensuring the smooth and
                                        efficient management of flight operations during turnaround processes. This role
                                        involves coordinating with relevant stakeholders such as airlines, airport
                                        agencies, and authorities to resolve any operational issues. The coordinator
                                        ensures all flight planning activities align with Standard Operating Procedures
                                        (SOPs) and established standards. They oversee safety and security protocols,
                                        performing checks and investigations into breaches. Additionally, the role
                                        requires strong leadership, as the coordinator mentors team members, resolves
                                        conflicts, and maintains high communication standards to foster positive
                                        relationships with both internal and external parties. The position requires a
                                        solid understanding of flight watching systems and the ability to manage
                                        operations across varying shifts.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Customer Orientation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Accident and Incident Response Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Accident and Incident Response Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Aircraft Turnaround Coordination</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Change Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0 card-cyan">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-green-right">93% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Rostering Planner</h5>
                                        <span class="s-career-goal">Next Career Goal</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Rostering Planner at AirAsia is responsible for managing
                                        and optimizing crew rosters to ensure efficient deployment and compliance with
                                        regulatory and operational requirements. This role involves monitoring flight
                                        operations, including aircraft performance, movements, and operating conditions,
                                        and adjusting crew schedules as needed to address irregularities. The Rostering
                                        Planner collaborates with internal teams and stakeholders to recover disrupted
                                        flight schedules and ensures adherence to safety and security standards. Working
                                        in a shift-based environment, the Rostering Planner demonstrates strong resource
                                        management skills and excels in preparing and managing schedules. Effective
                                        communication and interpersonal skills are essential to work collaboratively
                                        with team members, pilots, and stakeholders. The ideal candidate is
                                        detail-oriented, adaptable, and maintains high performance and alertness during
                                        flight watch periods.
                                    </p>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Customer Orientation</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Accident and Incident Response Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Accident and Incident Response Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Aircraft Turnaround Coordination</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Change Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0 card-cyan">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="success-top d-flex justify-content-between align-items-center">
                                    <div class="s-top-left d-flex align-items-center gap-1">
                                        <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                        <p class="m-0 fs-4 fw-medium">1</p>
                                    </div>
                                    <div class="s-top-right">
                                        <span class="s-green-right">93% Match</span>
                                    </div>
                                </div>
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0">Rostering Planner</h5>
                                        <span class="s-career-goal">Next Career Goal</span>
                                    </div>
                                    <p class="mb-0 mt-2">The Rostering Planner at AirAsia is responsible for managing
                                        and optimizing crew rosters to ensure efficient deployment and compliance with
                                        regulatory and operational requirements. This role involves monitoring flight
                                        operations, including aircraft performance, movements, and operating conditions,
                                        and adjusting crew schedules as needed to address irregularities. The Rostering
                                        Planner collaborates with internal teams and stakeholders to recover disrupted
                                        flight schedules and ensures adherence to safety and security standards. Working
                                        in a shift-based environment, the Rostering Planner demonstrates strong resource
                                        management skills and excels in preparing and managing schedules. Effective
                                        communication and interpersonal skills are essential to work collaboratively
                                        with team members, pilots, and stakeholders. The ideal candidate is
                                        detail-oriented, adaptable, and maintains high performance and alertness during
                                        flight watch periods.
                                    </p>
                                </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Aircraft Performance Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airline Crew Scheduling</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airline Operations Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airport Operations Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Change Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Data Analytics</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-9 gap-4 mt-4">
                        <div class="card col-4 p-0">
                            <div class="success-inner p-9">
                                <div class="path-top-text"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                        height="24" viewBox="0 0 25 24" fill="none">
                                        <g clip-path="url(#clip0_179_9661)">
                                            <path
                                                d="M19.167 9L20.417 6.25L23.167 5L20.417 3.75L19.167 1L17.917 3.75L15.167 5L17.917 6.25L19.167 9Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M19.167 15L17.917 17.75L15.167 19L17.917 20.25L19.167 23L20.417 20.25L23.167 19L20.417 17.75L19.167 15Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M11.667 9.5L9.16699 4L6.66699 9.5L1.16699 12L6.66699 14.5L9.16699 20L11.667 14.5L17.167 12L11.667 9.5ZM10.157 12.99L9.16699 15.17L8.17699 12.99L5.99699 12L8.17699 11.01L9.16699 8.83L10.157 11.01L12.337 12L10.157 12.99Z"
                                                fill="#F7941C" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_179_9661">
                                                <rect width="24" height="24" fill="white"
                                                    transform="translate(0.166992)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p class="m-0">Career Recommendation</p>
                                </div>
                                <p>To transition from a Turnaround Coordinator to a Roster Planner, focus on enhancing
                                    your
                                    technical knowledge, leadership skills, and operational understanding. Gain
                                    expertise in
                                    regulatory compliance, develop strong communication abilities, and foster
                                    collaboration
                                    with various departments. Seek opportunities to lead projects and build a solid
                                    network
                                    within the industry.</p>
                            </div>
                        </div>
                                <div class="s-skill-requirement">
                                    <p class="m-0 fw-medium">Skill requirement</p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Collaboration</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Aircraft Performance Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airline Crew Scheduling</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-green-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airline Operations Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Airport Operations Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Change Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Data Analytics</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-9 gap-4 mt-4">
                        <div class="card col-4 p-0">
                            <div class="success-inner p-9">
                                <div class="path-top-text"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                        height="24" viewBox="0 0 25 24" fill="none">
                                        <g clip-path="url(#clip0_179_9661)">
                                            <path
                                                d="M19.167 9L20.417 6.25L23.167 5L20.417 3.75L19.167 1L17.917 3.75L15.167 5L17.917 6.25L19.167 9Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M19.167 15L17.917 17.75L15.167 19L17.917 20.25L19.167 23L20.417 20.25L23.167 19L20.417 17.75L19.167 15Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M11.667 9.5L9.16699 4L6.66699 9.5L1.16699 12L6.66699 14.5L9.16699 20L11.667 14.5L17.167 12L11.667 9.5ZM10.157 12.99L9.16699 15.17L8.17699 12.99L5.99699 12L8.17699 11.01L9.16699 8.83L10.157 11.01L12.337 12L10.157 12.99Z"
                                                fill="#F7941C" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_179_9661">
                                                <rect width="24" height="24" fill="white"
                                                    transform="translate(0.166992)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p class="m-0">Career Recommendation</p>
                                </div>
                                <p>To transition from a Turnaround Coordinator to a Roster Planner, focus on enhancing
                                    your
                                    technical knowledge, leadership skills, and operational understanding. Gain
                                    expertise in
                                    regulatory compliance, develop strong communication abilities, and foster
                                    collaboration
                                    with various departments. Seek opportunities to lead projects and build a solid
                                    network
                                    within the industry.</p>
                            </div>
                        </div>

                        <div class="card col p-0">
                            <div class="success-inner p-9">
                                <div class="path-top-text mb-8"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="25" height="24" viewBox="0 0 25 24" fill="none">
                                        <g clip-path="url(#clip0_179_9661)">
                                            <path
                                                d="M19.167 9L20.417 6.25L23.167 5L20.417 3.75L19.167 1L17.917 3.75L15.167 5L17.917 6.25L19.167 9Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M19.167 15L17.917 17.75L15.167 19L17.917 20.25L19.167 23L20.417 20.25L23.167 19L20.417 17.75L19.167 15Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M11.667 9.5L9.16699 4L6.66699 9.5L1.16699 12L6.66699 14.5L9.16699 20L11.667 14.5L17.167 12L11.667 9.5ZM10.157 12.99L9.16699 15.17L8.17699 12.99L5.99699 12L8.17699 11.01L9.16699 8.83L10.157 11.01L12.337 12L10.157 12.99Z"
                                                fill="#F7941C" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_179_9661">
                                                <rect width="24" height="24" fill="white"
                                                    transform="translate(0.166992)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p class="m-0">Skills Gap Analysis for Rostering Planner</p>
                                </div>
                                <div class="d-grid gap-16">
                                    <div>
                                        <p class="fw-medium m-0 fs-4 mb-5">Soft Skill They Need:</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">Communication</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="bar-career">
                                                    <div class="bar" style="width: 100%"></div>
                                                </div>
                                                <span>100%</span>
                                                <p class="m-0 s-top-right"><span
                                                        class="s-green-right">Completed</span></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-medium m-0 fs-4 mb-5">Soft Skill They Need:</p>
                                        <div class="d-flex justify-content-between align-items-center pb-5">
                                            <p class="m-0 fw-medium">Airline Crew Scheduling</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bar-career">
                                                        <div class="bar" style="width: 100%"></div>
                                                    </div>
                                                    <span>100%</span>
                                                </div>

                                                <p class="m-0 s-top-right"><span
                                                        class="s-green-right">Completed</span></p>
                                            </div>

                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="d-flex justify-content-between align-items-center pb-5 pt-5">
                                            <p class="m-0 fw-medium">Airport Operations Management</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex align-items-center gap-3">

                                                    <div class="bar-career">
                                                        <div class="bar" style="width: 64%"></div>
                                                    </div>
                                                    <span>64%</span>
                                                </div>

                                                <p class="m-0 s-top-right"><span class="s-yellow-right">In
                                                        Progress</span></p>
                                            </div>

                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="d-flex justify-content-between align-items-center pt-5">
                                            <p class="m-0 fw-medium">Flight Disruptions and Irregular Operations
                                                Management</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bar-career">
                                                        <div class="bar" style="width: 0%"></div>
                                                    </div><span>0%</span>
                                                </div>
                                                <p class="m-0 s-head-span"><span
                                                        class="s-career-goal">Completed</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn" style="border: 0;">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                        <div class="card col p-0">
                            <div class="success-inner p-9">
                                <div class="path-top-text mb-8"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="25" height="24" viewBox="0 0 25 24" fill="none">
                                        <g clip-path="url(#clip0_179_9661)">
                                            <path
                                                d="M19.167 9L20.417 6.25L23.167 5L20.417 3.75L19.167 1L17.917 3.75L15.167 5L17.917 6.25L19.167 9Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M19.167 15L17.917 17.75L15.167 19L17.917 20.25L19.167 23L20.417 20.25L23.167 19L20.417 17.75L19.167 15Z"
                                                fill="#F7941C" />
                                            <path
                                                d="M11.667 9.5L9.16699 4L6.66699 9.5L1.16699 12L6.66699 14.5L9.16699 20L11.667 14.5L17.167 12L11.667 9.5ZM10.157 12.99L9.16699 15.17L8.17699 12.99L5.99699 12L8.17699 11.01L9.16699 8.83L10.157 11.01L12.337 12L10.157 12.99Z"
                                                fill="#F7941C" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_179_9661">
                                                <rect width="24" height="24" fill="white"
                                                    transform="translate(0.166992)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p class="m-0">Skills Gap Analysis for Rostering Planner</p>
                                </div>
                                <div class="d-grid gap-16">
                                    <div>
                                        <p class="fw-medium m-0 fs-4 mb-5">Soft Skill They Need:</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">Communication</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="bar-career">
                                                    <div class="bar" style="width: 100%"></div>
                                                </div>
                                                <span>100%</span>
                                                <p class="m-0 s-top-right"><span
                                                        class="s-green-right">Completed</span></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-medium m-0 fs-4 mb-5">Soft Skill They Need:</p>
                                        <div class="d-flex justify-content-between align-items-center pb-5">
                                            <p class="m-0 fw-medium">Airline Crew Scheduling</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bar-career">
                                                        <div class="bar" style="width: 100%"></div>
                                                    </div>
                                                    <span>100%</span>
                                                </div>

                                                <p class="m-0 s-top-right"><span
                                                        class="s-green-right">Completed</span></p>
                                            </div>

                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="d-flex justify-content-between align-items-center pb-5 pt-5">
                                            <p class="m-0 fw-medium">Airport Operations Management</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex align-items-center gap-3">

                                                    <div class="bar-career">
                                                        <div class="bar" style="width: 64%"></div>
                                                    </div>
                                                    <span>64%</span>
                                                </div>

                                                <p class="m-0 s-top-right"><span class="s-yellow-right">In
                                                        Progress</span></p>
                                            </div>

                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="d-flex justify-content-between align-items-center pt-5">
                                            <p class="m-0 fw-medium">Flight Disruptions and Irregular Operations
                                                Management</p>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bar-career">
                                                        <div class="bar" style="width: 0%"></div>
                                                    </div><span>0%</span>
                                                </div>
                                                <p class="m-0 s-head-span"><span
                                                        class="s-career-goal">Completed</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn" style="border: 0;">
                                More info <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Panel 5-->

                <!--begin::Panel 5-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_idp" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="card p-15 d-flex mb-9 flex-row" style="gap: 76px;">
                        <div class="col-2.5 p-0">
                            <div class="idp-circular-progress">
                                <div class="idp-percentage">
                                    <h3 class="m-0">60%</h3>
                                    <p class="m-0">Skills proficiency</p>
                                </div>
                            </div>
                        </div>
                        <div class="col p-0 d-flex gap-7 flex-column">
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-1"></div>
                                    <div class="fw-bolder fs-5">Proficient</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-2"></div>
                                    <div class="fw-bolder fs-5">Exceeds Expectation</div>
                                    <div class="moderate table-status">30%</div>
                        </div>
                    </div>
                </div>
                <!--end::Panel 5-->

                <!--begin::Panel 5-->
                <div class="h-full tab-pane fade" id="kt_tab_pane_idp" role="tabpanel">
                    <!--begin::Col 1 -->
                    <div class="card p-15 d-flex mb-9 flex-row" style="gap: 76px;">
                        <div class="col-2.5 p-0">
                            <div class="idp-circular-progress">
                                <div class="idp-percentage">
                                    <h3 class="m-0">60%</h3>
                                    <p class="m-0">Skills proficiency</p>
                                </div>
                            </div>
                        </div>
                        <div class="col p-0 d-flex gap-7 flex-column">
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-1"></div>
                                    <div class="fw-bolder fs-5">Proficient</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-2"></div>
                                    <div class="fw-bolder fs-5">Exceeds Expectation</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-3"></div>
                                    <div class="fw-bolder fs-5">Below Expectation</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-3"></div>
                                    <div class="fw-bolder fs-5">Below Expectation</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-4"></div>
                                    <div class="fw-bolder fs-5">Not Proficient</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-5"></div>
                                    <div class="fw-bolder fs-5">Projected</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    <div class="s-more-skill-btn">
                                        + 10 more skills
                                    </div>
                                </div>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-4"></div>
                                    <div class="fw-bolder fs-5">Not Proficient</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="idp-right-inner">
                                <div class="idp-right-top d-flex flex-row gap-3 mb-3 align-items-center">
                                    <div class="orange-dot orange-5"></div>
                                    <div class="fw-bolder fs-5">Projected</div>
                                    <div class="moderate table-status">30%</div>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Communication</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="career-path-head">
                        <div>
                            <div class="succession-head">
                                <p class="">Gap Analysis for Current Job Position : </p>
                                <div class="s-top-left d-flex align-items-center gap-1">
                                    <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                    <p class="m-0 fs-4 fw-medium">1</p>
                                </div>
                                <p class="fw-bolder">Turnaround Coordinator</p>
                            </div>
                            <p class="m-0 mt-2 fs-5">Total Hours Required to Complete: 48 Hours</p>
                        </div>
                        <div class="tab-btn d-flex" id="pills-tab" role="tablist">
                            <button class="btn-tab-1 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                type="button" role="tab" aria-controls="pills-home" aria-selected="true">Current Job Position</button>
                            <button class="btn-tab-2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Next Job Position
                                Results</button>
                        </div>
                    </div>
                    <div class="idp-table mt-8">
                        <div class="table-row header">
                            <div>SS/TS Needs to Improve</div>
                            <div>Type</div>
                            <div>Current Level</div>
                            <div>Skill Ascension</div>
                            <div>Status</div>
                            <div>Progress</div>
                            <div>Skill Endorsement</div>
                        </div>
                        <div class="table-row">
                            <div>Communication</div>
                            <div>Soft Skill</div>
                            <div class="green"><span>Basic</span></div>
                            <div class="purple"><span>Advanced</span></div>
                            <div class="cyan"><span>Completed</span></div>
                            <div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                    padding: 0;
                                ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                            <div class="action-dropdown">
                                <select id="Action" placeholder="Action">
                                    <option value="Action">Action</option>
                                    <option value="Endorse this skill">Endorse this skill</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-row">
                            <div>Flight Planning</div>
                            <div>Technical Skill</div>
                            <div class="badge level-2">Level 2 <iconify-icon icon="material-symbols:star"
                                    class="star"></iconify-icon></div>
                            <div class="badge level-3">Level 3 <iconify-icon icon="material-symbols:star"
                                    class="star"></iconify-icon></div>
                            <div>
                                <p class="m-0 s-top-right"><span class="s-yellow-right">In
                                        Progress</span></p>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                padding: 0;
                            ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                            <div>Requirement Unmeet</div>
                        </div>
                    </div>
                    <div class="path-top-text d-flex justify-content-between align-items-end mt-8">
                        <div class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                viewBox="0 0 24 25" fill="none">
                                <g clip-path="url(#clip0_615_5282)">
                                    <path
                                        d="M18 2.80005H6C4.9 2.80005 4 3.70005 4 4.80005V20.8C4 21.9 4.9 22.8 6 22.8H18C19.1 22.8 20 21.9 20 20.8V4.80005C20 3.70005 19.1 2.80005 18 2.80005ZM9 4.80005H11V9.80005L10 9.05005L9 9.80005V4.80005ZM18 20.8H6V4.80005H7V13.8L10 11.55L13 13.8V4.80005H18V20.8Z"
                                        fill="#99A1B7" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_615_5282">
                                        <rect width="24" height="24" fill="white"
                                            transform="translate(0 0.800049)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <div>
                                <p class="m-0">Required Training For Your Role </p>
                                <p class="m-0 fs-6">Complete these required courses to meet your current role's
                                    expectations</p>
                            </div>
                        </div>
                        <p class="see-all m-0">See All <iconify-icon icon="iconamoon:arrow-right-2-duotone"
                                width="24" height="24"></iconify-icon></p>
                    </div>
                    <div class="d-flex mb-4 gap-4">
                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-2">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                        </div>
                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    <div class="path-top-text d-flex mt-8">
                        <div class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                viewBox="0 0 24 25" fill="none">
                                <g clip-path="url(#clip0_615_5282)">
                                    <path
                                        d="M18 2.80005H6C4.9 2.80005 4 3.70005 4 4.80005V20.8C4 21.9 4.9 22.8 6 22.8H18C19.1 22.8 20 21.9 20 20.8V4.80005C20 3.70005 19.1 2.80005 18 2.80005ZM9 4.80005H11V9.80005L10 9.05005L9 9.80005V4.80005ZM18 20.8H6V4.80005H7V13.8L10 11.55L13 13.8V4.80005H18V20.8Z"
                                        fill="#99A1B7" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_615_5282">
                                        <rect width="24" height="24" fill="white"
                                            transform="translate(0 0.800049)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <div>
                                <p class="m-0">Learning and Development Plan</p>
                            </div>
                        </div>
                    </div>
                    <div class="idp-table-2 mt-8">
                        <table>
                            <thead>
                                <tr class="table-row header">
                                    <th>Program</th>
                                    <th>Skill Progress</th>
                                    <th>Estimated Time Completed</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Test Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-row">
                                    <td class="fw-bold">Improving Communication Skills</td>
                                    <td>
                                        <div class="s-green-text d-flex align-items-center">
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Problem Solving</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Customer Orientation</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-more-skill-btn"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                + 10 more skills
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold">20 Hours</td>
                                    <td class="green"><span>Basic</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career"
                                                style="
                                        padding: 0;
                                    ">
                                                <div class="bar" style="width: 64%;padding: 0;margin: initial;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                    </td>
                                    <td>74%</td>
                                </tr>
                                <tr class="table-row">
                                    <td class="fw-bold">Flight Planning Training Program</td>
                                    <td>
                                        <div class="s-green-text d-flex align-items-center">
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Problem Solving</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Customer Orientation</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-more-skill-btn"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                + 10 more skills
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold">2 Days</td>
                                    <td>
                                        <p class="m-0 s-top-right"><span class="s-yellow-right">In
                                                Progress</span></p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career"
                                                style="
                                        padding: 0;
                                    ">
                                                <div class="bar" style="width: 64%;padding: 0;margin: initial;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                    </td>
                                    <td><span class="test-result unmeet">Requirement Unmeet</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="path-top-text d-flex mt-8">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="tdesign:dart-board" width="24" height="24"></iconify-icon>
                            <div>
                                <p class="m-0">Allstar Value Training</p>
                            </div>
                            <div class="red-top"><span>2 / 2 courses enrolled <iconify-icon
                                        icon="material-symbols:info" width="16"
                                        height="16"></iconify-icon></span></div>
                        </div>
                    </div>
                    <div class="d-flex mb-4 gap-4">
                        <div class="card col p-0">
                            <div>
                            <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-2">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                        <h5 class="m-0">Dare To Dream</h5>
                                        <div class="cyan"><span>in progress</span></div>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                    width: 100%;
                                ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-2">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                        <h5 class="m-0">Dare To Dream</h5>
                                        <div class="cyan"><span>in progress</span></div>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                    width: 100%;
                                ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="col p-0">
                        </div>

                        <div class="col p-0">
                        </div>
                    </div>
                </div>
                <!--end::Panel 5-->


            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')

<script>
    var options = {
        series: [{
            name: "Data Points",
            data: [1, 2, 1, 2]  // Y-axis values for each point
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: { show: false }  // Disable toolbar
        },
        stroke: {
            width: 2,
            curve: 'straight'  // Line style
        },
        markers: {
            size: 5,
            colors: ['#FFA726'],
            strokeWidth: 2,
            hover: { size: 6 }
        },
        xaxis: {
            categories: ["Mid Year 2023", "Year-End 2023", "Mid Year 2024", "Year-End 2024"],  // X-axis labels
            labels: { style: { colors: '#333' } }  // X-axis label style
        },
        yaxis: {
            min: 1, max: 4,
            labels: { style: { colors: '#333' } }  // Y-axis label style
        },
        colors: ['#FFA726'],
        dataLabels: { enabled: false },
        grid: { borderColor: '#ccc' }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Decision Making</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>2
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>1
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="career-path-head">
                        <div>
                            <div class="succession-head">
                                <p class="">Gap Analysis for Current Job Position : </p>
                                <div class="s-top-left d-flex align-items-center gap-1">
                                    <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                    <p class="m-0 fs-4 fw-medium">1</p>
                                </div>
                                <p class="fw-bolder">Turnaround Coordinator</p>
                            </div>
                            <p class="m-0 mt-2 fs-5">Total Hours Required to Complete: 48 Hours</p>
                        </div>
                        <div class="tab-btn d-flex" id="pills-tab" role="tablist">
                            <button class="btn-tab-1 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                type="button" role="tab" aria-controls="pills-home" aria-selected="true">Current Job Position</button>
                            <button class="btn-tab-2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Next Job Position
                                Results</button>
                        </div>
                    </div>
                    <div class="idp-table mt-8">
                        <div class="table-row header">
                            <div>SS/TS Needs to Improve</div>
                            <div>Type</div>
                            <div>Current Level</div>
                            <div>Skill Ascension</div>
                            <div>Status</div>
                            <div>Progress</div>
                            <div>Skill Endorsement</div>
                        </div>
                        <div class="table-row">
                            <div>Communication</div>
                            <div>Soft Skill</div>
                            <div class="green"><span>Basic</span></div>
                            <div class="purple"><span>Advanced</span></div>
                            <div class="cyan"><span>Completed</span></div>
                            <div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                    padding: 0;
                                ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                            <div class="action-dropdown">
                                <select id="Action" placeholder="Action">
                                    <option value="Action">Action</option>
                                    <option value="Endorse this skill">Endorse this skill</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-row">
                            <div>Flight Planning</div>
                            <div>Technical Skill</div>
                            <div class="badge level-2">Level 2 <iconify-icon icon="material-symbols:star"
                                    class="star"></iconify-icon></div>
                            <div class="badge level-3">Level 3 <iconify-icon icon="material-symbols:star"
                                    class="star"></iconify-icon></div>
                            <div>
                                <p class="m-0 s-top-right"><span class="s-yellow-right">In
                                        Progress</span></p>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                padding: 0;
                            ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                            <div>Requirement Unmeet</div>
                        </div>
                    </div>
                    <div class="path-top-text d-flex justify-content-between align-items-end mt-8">
                        <div class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                viewBox="0 0 24 25" fill="none">
                                <g clip-path="url(#clip0_615_5282)">
                                    <path
                                        d="M18 2.80005H6C4.9 2.80005 4 3.70005 4 4.80005V20.8C4 21.9 4.9 22.8 6 22.8H18C19.1 22.8 20 21.9 20 20.8V4.80005C20 3.70005 19.1 2.80005 18 2.80005ZM9 4.80005H11V9.80005L10 9.05005L9 9.80005V4.80005ZM18 20.8H6V4.80005H7V13.8L10 11.55L13 13.8V4.80005H18V20.8Z"
                                        fill="#99A1B7" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_615_5282">
                                        <rect width="24" height="24" fill="white"
                                            transform="translate(0 0.800049)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <div>
                                <p class="m-0">Required Training For Your Role </p>
                                <p class="m-0 fs-6">Complete these required courses to meet your current role's
                                    expectations</p>
                            </div>
                        </div>
                        <p class="see-all m-0">See All <iconify-icon icon="iconamoon:arrow-right-2-duotone"
                                width="24" height="24"></iconify-icon></p>
                    </div>
                    <div class="d-flex mb-4 gap-4">
                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-2">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                        </div>
                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-3">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span">
                                        <h5 class="m-0"
                                            style="
                                        width: 190px;
                                    ">
                                            Improving Communication Skills</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                    <p class="m-0 d-flex align-items-center"> <iconify-icon icon="ri:bar-chart-fill"
                                            width="16" height="16" class="mr-1"></iconify-icon> Beginner
                                    </p>
                                </div>
                                <div class="s-green-text d-flex align-items-center">
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Problem Solving</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>3
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Leadership & Team Management</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                    <div class="s-yellow-btn d-flex gap-3 align-items-center">
                                        <p class="m-0">Workflow Optimization</p>
                                        <p class="m-0 d-flex align-items-center"><iconify-icon
                                                icon="material-symbols:star" class="star"></iconify-icon>5
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    <div class="path-top-text d-flex mt-8">
                        <div class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                viewBox="0 0 24 25" fill="none">
                                <g clip-path="url(#clip0_615_5282)">
                                    <path
                                        d="M18 2.80005H6C4.9 2.80005 4 3.70005 4 4.80005V20.8C4 21.9 4.9 22.8 6 22.8H18C19.1 22.8 20 21.9 20 20.8V4.80005C20 3.70005 19.1 2.80005 18 2.80005ZM9 4.80005H11V9.80005L10 9.05005L9 9.80005V4.80005ZM18 20.8H6V4.80005H7V13.8L10 11.55L13 13.8V4.80005H18V20.8Z"
                                        fill="#99A1B7" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_615_5282">
                                        <rect width="24" height="24" fill="white"
                                            transform="translate(0 0.800049)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <div>
                                <p class="m-0">Learning and Development Plan</p>
                            </div>
                        </div>
                    </div>
                    <div class="idp-table-2 mt-8">
                        <table>
                            <thead>
                                <tr class="table-row header">
                                    <th>Program</th>
                                    <th>Skill Progress</th>
                                    <th>Estimated Time Completed</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Test Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-row">
                                    <td class="fw-bold">Improving Communication Skills</td>
                                    <td>
                                        <div class="s-green-text d-flex align-items-center">
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Problem Solving</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Customer Orientation</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-more-skill-btn"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                + 10 more skills
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold">20 Hours</td>
                                    <td class="green"><span>Basic</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career"
                                                style="
                                        padding: 0;
                                    ">
                                                <div class="bar" style="width: 64%;padding: 0;margin: initial;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                    </td>
                                    <td>74%</td>
                                </tr>
                                <tr class="table-row">
                                    <td class="fw-bold">Flight Planning Training Program</td>
                                    <td>
                                        <div class="s-green-text d-flex align-items-center">
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Problem Solving</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-yellow-btn d-flex gap-3 align-items-center"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                <p class="m-0">Customer Orientation</p>
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>2</span><iconify-icon
                                                        icon="ep:d-arrow-right" width="16" height="16"
                                                        class="star"
                                                        style="color: #975102"></iconify-icon><iconify-icon
                                                        icon="material-symbols:star"
                                                        class="star"></iconify-icon><span>3</span>
                                                </p>
                                            </div>
                                            <div class="s-more-skill-btn"
                                                style="
                                        padding: 8px 16px;
                                        width: max-content;
                                    ">
                                                + 10 more skills
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold">2 Days</td>
                                    <td>
                                        <p class="m-0 s-top-right"><span class="s-yellow-right">In
                                                Progress</span></p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career"
                                                style="
                                        padding: 0;
                                    ">
                                                <div class="bar" style="width: 64%;padding: 0;margin: initial;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                    </td>
                                    <td><span class="test-result unmeet">Requirement Unmeet</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="path-top-text d-flex mt-8">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="tdesign:dart-board" width="24" height="24"></iconify-icon>
                            <div>
                                <p class="m-0">Allstar Value Training</p>
                            </div>
                            <div class="red-top"><span>2 / 2 courses enrolled <iconify-icon
                                        icon="material-symbols:info" width="16"
                                        height="16"></iconify-icon></span></div>
                        </div>
                    </div>
                    <div class="d-flex mb-4 gap-4">
                        <div class="card col p-0">
                            <div>
                            <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-2">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                        <h5 class="m-0">Dare To Dream</h5>
                                        <div class="cyan"><span>in progress</span></div>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                    width: 100%;
                                ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>
                        <div class="card col p-0">
                            <div>
                                <img class="icon_wrapper" src="{{ asset('images/development-plan/splash_img.png') }}"  alt="splash">
                            <div class="success-inner p-4 d-grid gap-2">
                                <div class="s-head-content">
                                    <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                        <h5 class="m-0">Dare To Dream</h5>
                                        <div class="cyan"><span>in progress</span></div>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                    <p class="m-0 d-flex align-items-center"><iconify-icon
                                            icon="fluent-mdl2:date-time-12" width="16" height="16"
                                            class="mr-1"></iconify-icon> 1-4 weeks</p>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bar-career"
                                        style="
                                    width: 100%;
                                ">
                                        <div class="bar" style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;"></div>
                                    </div>
                                    <span>64%</span>
                                </div>
                            </div>
                        </div>
                            <div class="s-more-info-btn">
                                Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                    class="s-info-btn"></iconify-icon>
                            </div>
                        </div>

                        <div class="col p-0">
                        </div>

                        <div class="col p-0">
                        </div>
                    </div>
                </div>
                <!--end::Panel 5-->


            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')

<script>
    var options = {
        series: [{
            name: "Data Points",
            data: [1, 2, 1, 2]  // Y-axis values for each point
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: { show: false }  // Disable toolbar
        },
        stroke: {
            width: 2,
            curve: 'straight'  // Line style
        },
        markers: {
            size: 5,
            colors: ['#FFA726'],
            strokeWidth: 2,
            hover: { size: 6 }
        },
        xaxis: {
            categories: ["Mid Year 2023", "Year-End 2023", "Mid Year 2024", "Year-End 2024"],  // X-axis labels
            labels: { style: { colors: '#333' } }  // X-axis label style
        },
        yaxis: {
            min: 1, max: 4,
            labels: { style: { colors: '#333' } }  // Y-axis label style
        },
        colors: ['#FFA726'],
        dataLabels: { enabled: false },
        grid: { borderColor: '#ccc' }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>





@endsection
