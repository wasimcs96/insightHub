<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assessment Report PDF</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    {{-- <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" /> --}}
    <style>
        @page {
            margin: 0;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url("fonts/Inter-Regular.ttf") format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-style: bold;
            font-weight: 700;
            src: url("fonts/Inter-Bold.ttf") format('truetype');
        }

        body {
            margin: 0;
            padding: 0;
        }

        /* .page-number:after {
            content: counter(page);
        } */

        body {
            font-family: "Inter", sans-serif;
            background: #525659;
            font-style: normal;
            margin: 0;
        }

        h1,
        h2,
        p {
            margin: 0;
        }

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
        }

        .fade-red {
            background: #FF8B8B;
        }

        .dark-red {
            background: #FF5D5D;
        }

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
            transform: translateY(-50%);
        }

        .pdf-page {
            width: 100vw;
            height: 100vh;
            margin: auto;
            position: relative;
            overflow: hidden;
            /* page-break-after: always; */
        }

        .moderate-icon-yellow {
            font-weight: 600;
            width: 14px;
            height: 14px;
            transform: rotate(45deg);
            background: #FFCD44;
            margin-right: 10px;
            margin-top: 3px;
        }

        .moderate-big-icon {
            font-weight: 600;
            width: 14px;
            height: 14px;
            transform: rotate(45deg);
            background: #FFCD44;
            margin-right: 10px;
            margin-top: 8px;
        }

        .row-right {
            text-align: right;
        }

        .row {
            display: flex;
            justify-content: space-between;
            /* Separate left and right sections */
            align-items: center;
            /* Align text vertically */
        }

        .left {
            text-align: left;
            position: relative;
            margin-bottom: -20px;
            width: 50%;
        }

        .width-33 {
            width: 33% !important;
            position: relative;
            margin-bottom: -20px;
            bottom: 1%;
        }

        .right {
            text-align: center;
        }

        .right-small-text {
            text-align: right;
            position: relative;
            width: 50%;
            float: right;
        }

        .right-big-text {
            text-align: right;
            position: relative;
            margin-top: -13px;
            width: 50%;
            float: right;
        }

        .bottom-p span {
            margin-left: 24px;
        }

        /* Frame 1 */

        .pdf-background {
            background-color: white;
            height: 100%;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .first-frame {
            background-image: url("admin/media/pdf/FrameOne.png");
        }

        .second-frame {
            background-image: url("admin/media/pdf/FrameTwo.png");
            background-position: bottom;
        }

        .heading {
            color: #5b5b5b;
            font-size: 64px;
            font-weight: 500;
            line-height: 56px;
            padding: 144px 0px 46px 46px;
        }

        .info {
            position: absolute;
            top: 240px;
            left: 400px;
            margin-right: 30px;
        }

        .info-title {
            color: #949495;
            font-size: 14px;
            font-weight: 600;
            line-height: 12.8px;
            text-transform: uppercase;
            margin: 0px 0px 14px 0px;
        }

        .info-value,
        .info-value-break {
            color: #5b5b5b;
            font-size: 20px;
            font-weight: 500;
            line-height: 24px;
            margin: 0px 0px 14px 0px;
        }

        .info-value-break {
            width: 100%
        }

        /* Frame 2 */

        .top-head,
        .bottom-content {
            width: 89.7%;
            margin: 0 39px;
            padding: 14px 0;
            color: #666;
            font-size: 14px;
            line-height: normal;
            border-bottom: 1px solid #c8c8c9;
        }

        /* .top-head {
            padding-bottom: 24px;
        } */

        .top-head p,
        .bottom-content p {
            display: table-cell;
            padding: 0 10px;
            vertical-align: middle;
        }

        .bottom-content {
            border: none;
            padding-bottom: 20px;
            margin: 0px 39px 0px 39px;
            position: absolute;
            bottom: 0;
        }

        .top-head .left,
        .top-head .right {
            font-weight: 700;
        }

        .top-head span {
            font-weight: 500;
        }


        .bottom-content p {
            font-weight: 500;
        }

        .contents {
            margin: 50px 39px 0px 39px;
        }

        .heading-two {
            color: #f7941c;
            font-size: 36px;
            font-weight: 500;
            line-height: 30px;
            letter-spacing: 2px;
            margin-bottom: 40px;
        }

        .points span {
            color: #f7941c;
            font-weight: 500;
            line-height: 30px;
            margin-right: 26px;
        }

        .points p {
            color: #5b5b5b;
            font-size: 22px;
            font-weight: 500;
            display: table;
        }

        .Copyright {
            position: absolute;
            bottom: 300px;
            width: 400px;
            right: 30px;
        }

        .Copyright h2 {
            color: #7c4a0e;
            font-size: 22px;
            font-weight: 500;
        }

        .Copyright p {
            color: #5b5b5b;
            font-size: 12px;
            font-weight: 400;
            margin: 10px 0px 13px 2px;
        }

        .Copyright span {
            color: #5b5b5b;
            font-size: 12px;
            font-weight: 400;
        }

        /* Frame 3 */

        .heading-three {
            color: #5b5b5b;
            font-size: 30px;
            font-weight: 500;
            margin: 18px 39px 30px 39px;
        }

        .table {
            margin: 0px 74px;
        }

        .table-head {
            color: #5b5b5b;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
            width: 100%;
            padding: 4px 0px 6px 0px;
            text-align: center;
            background: #fff6ea;
        }

        .table-box {
            width: 95%;
            text-align: center;
            border: 0.811px solid #ebebeb;
            margin-bottom: 12px;
            padding: 10px 15px;
        }

        .table-box p {
            color: #7b7b7b;
            font-size: 18px;
            font-weight: 500;
            line-height: 18px;
        }

        .table-box svg {
            margin-right: 8px;
        }

        .box-inner {
            display: table;
            text-align: left;
            gap: 10px;
            width: 100%;
            padding: 10px 15px;
            border: 0.811px solid #EBEBEB;
        }

        .box-two {
            padding: 0px;
            border: 0px;
            width: 100%;
        }

        .box-bottom {
            width: 91.34%;
            text-align: center;
            display: table;
        }

        .table-bottom-box {
            padding: 0px 15px;
        }

        .box-bottom div {
            padding: 8.108px 0px;
        }

        .box-bottom div:nth-child(1) {
            border-right: 0.81px solid #EBEBEB;
        }

        .icon-div {
            display: table;
            margin-top: 5px;

        }

        /*Frame 4 */

        .content-div {
            margin: 0px 62px 30px 41px;
        }

        .heading-content {
            color: #5B5B5B;
            font-size: 20px;
            font-weight: 500;
            line-height: normal;
        }

        .icon-p {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            margin: 10px 0px;
            display: table;
        }

        .content-desc {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 400;
            padding-left: 16px;
            border-left: 1px solid #EBEBEB;
        }

        .content-desc span {
            color: #F7941C;
            font-weight: 600;
        }


        /*Frame 7 */

        .skill-div {
            margin: 18px 41px 0px 41px;
        }

        .skill-table {
            margin: 40px 17px 0px 41px;
            width: fit-content;

        }

        .inner-table {
            display: table;
        }

        .left-table {
            width: 94%;
        }

        .left-table-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
            margin-bottom: 3px;
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
            top: 10px;
            border-radius: 5.421px;
            background: #F7941C;
            color: #FFF;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .purple,
        .purple-high,
        .cyan,
        .green,
        .cyan-high,
        .orange,
        .spring {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
            display: inline-table;
            margin-bottom: 5px;
        }

        .purple span,
        .purple-high span,
        .cyan span,
        .cyan-high span,
        .orange span,
        .green span,
        .spring span,
        .badge-custom {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .purple {
            color: #7F66CA;
        }

        .purple-high {
            color: #6652A1;
        }

        .purple span, .purple-high span {
            background: #E1D8FB;
        }

                .cyan-high {
            color: #108585;
        }

         .cyan-high span {
            background: #B2ECEC;
            color: #0C6464;
        }



        .cyan {
            color: #14A6A6;
        }

        .cyan span {
            background: #B2ECEC;
        }

.right-bot span.cyan {
    color: #108585;
    background: #B2ECEC;
}

        .orange {
            color: #F7941C;
        }

        .orange span {
            background: #FDE2C1;
        }

        .spring {
            color: #E39B00;
        }

        .spring span {
            color: #F7941C;
            background: #FFEBB4;
        }

        .right-bot span.spring {
    color: #F7941C;
    background: #FFEBB4;
}

.right-bot span.orange {
    color: #F7941C;
    background: #FDE2C1;
}

.right-bot span.purple {
    color: #7F66CA;
    background: #E1D8FB;
}

.right-bot span.green {
            color: #218336;
            background: #BBECC5;
}

        .table-top-content {
            padding-left: 12px;
            border-left: 1.6px solid #FABB6E;
        }

        .right-table {
            width: 37%;
            display: table-cell;
        }

        .line {
            border-radius: 7.14px;
        }

        .line-fourteen {
            border-radius: 7.14px;
        }

        .green {
            color: #2AA443;
        }

        .green span {
            color: #218336;
            background: #BBECC5 !important;
        }

        /*Frame 12 */

        .summary {
            padding: 10.5px 0px 0px;
        }

        .summary-head {
            color: #5B5B5B;
            font-size: 10px;
            font-weight: 600;
            line-height: 11.9px;
        }

        .summary ul {
            margin: 0;
            padding: 3px 0px 24px 14px;
            border-bottom: 0.56px solid #E1E1E1;
            width: 276px;
        }

        .summary ul li {
            color: #5B5B5B;
            font-size: 10px;
            font-weight: 400;
            line-height: 14px;
        }

        .table-right-tweleve {
            display: table-cell;
            width: 33%;
        }

        .tweleve-inner {
            padding: 16px 24px;
            border-radius: 5.6px;
            background: #FFF;
            box-shadow: 0px 2.24px 2.24px 0px rgba(0, 0, 0, 0.25);
            border: 1px solid #E1E1E1;
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

        /*Frame 13 */

        .thirteen-first {
            margin-top: 31px;
            width: fit-content;
        }

        .thirteen-first-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: 17.6px;
            margin-bottom: 10px;
        }

        .thirteen-teal {
            color: #108585;
            font-size: 24px;
            font-weight: 500;
            line-height: normal;
        }

        .thirteen-progress-section {
            margin: 40px 0px;
            display: table;
        }

        .progress-container {
            width: 100%;
            margin-top: 16px;
            height: 12px;
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
            height: 12px;
        }

        .segment-yellow,
        .segment-orange,
        .segment-blue {
            width: 33.33%;
        }

        .segment-yellow {
            background-color: #FFD16D;
        }

        .segment-orange {
            background-color: #99E2A8;
        }

        .segment-blue {
            background-color: #65DADA;
        }

            .progress-circle {
        position: absolute;
            top: 30%;
        border: 2px solid #fff;
        width: 10px;
        height: 10px;
        border-radius: 50px;
        box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            transform: translate(398px, -50%);
    }


        .thirteen-inneer {
            display: table;
            margin-bottom: 24px;
        }

        .thirteen-inneer p {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
            display: table;
        }

        .thirteen-inneer span {
            display: table-cell;
            padding: 2.4px 5.6px;
            position: relative;
            left: 10px;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            background: #B2ECEC;
            color: #108585;
            font-size: 12px;
            font-weight: 600;
        }

        .thirteen-three {
            display: table;
            margin: 50px auto 50px 50px;
        }

        .thirteen-three p {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            display: inline-table;
        }

        .thirteen-three span {
            width: 26px;
            height: 6px;
            display: table-cell;
        }

        .three-low span {
            background: #FFD76A;
        }

        .three-moderate span {
            background: #FABB6E;
        }

        .circle-second-div {
            display: table-cell;
            margin-top: 250px
        }

        .circle-second-div p {
            width: max-content;
        }

        .three-high span {
            background: #3FD0D0;
        }

        .thirteen-second {
            border-radius: 7.168px;
            background: #FFF;
            box-shadow: 0px 2.867px 2.867px 0px rgba(0, 0, 0, 0.25);
            display: table;
            width: auto;
            width: 83.4%;
            padding: 26.88px 59.76px 26.88px 59.76px;
            margin-top: 40px;
        }

        .chart-container {
            position: relative;
            width: 270.501px;
            height: 270.501px;
        }

        .chart-label {
            position: absolute;
            display: inline-flex;
            padding: 3.584px 5.376px;
            justify-content: center;
            align-items: center;
            gap: 8.96px;
            color: #218336;
            font-size: 15px;
            font-weight: 600;
            line-height: normal;
            text-transform: uppercase;
            border-radius: 5.018px;
        }

        .correct-label {
            top: 48%;
            left: -15%;
            color: #218336;
            background: #DDF5E2;

        }

        .wrong-label {
            top: 18%;
            right: -18%;
            background-color: #fff7eb;
            color: #f4a261;
        }

        .result-ciircle {
            margin-bottom: 26.88px;
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 400;
            line-height: 19.712px;
        }

        .circle-second-div p {
            color: #5B5B5B;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            display: table;
            align-items: center;
            margin-top: 13.44px;
        }

        .correct {
            background: #BBECC5;
        }

        .wrong {
            background: #FFDC92;
        }


        /*Frame 14 */

        .heading-content-bot {
            color: #5B5B5B;
            font-size: 15px;
            font-weight: 500;
            line-height: normal;
            text-transform: capitalize;
            margin-bottom: 10px;
        }

        .white-text {
            color: #FFF;
            font-size: 10.64px;
            font-weight: 600;
            line-height: normal;
            padding-left: 7.92px;
            position: relative;
            top: 4px;
        }

        .fourteen-top {
            color: #5B5B5B;
            font-size: 12px;
        }

        .fourteen-top span {
            font-weight: 400;
            display: inline-block;
            width: 33%;
        }

        .table-fourteen {
            margin-top: 42px;
        }

        .fourteen-left {
            width: 94%;
        }

        .fourteen-right {
            width: 35%;
            display: table-cell;
        }

        .fourteen-inner {
            display: table;
            margin-bottom: 20px;
        }

        .right-top-heading {
            font-size: 15px;
            font-weight: 600;
            display: table;
            margin-bottom: 6px;
        }

        .right-top-heading span {
            position: relative;
            left: 6.4px;
            padding: 3.4px 8.6px;
            border-radius: 8px;
            font-size: 11px;
            text-transform: uppercase;
        }

        .fourteen-right-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            line-height: 14px;
        }

        .teal-purple {
            color: #108585;
        } 

        .teal-purple span {
            color: #6652A1;
            background: #E1D8FB;
        }

        .orange-green {
            color: #2AA443;
        }

        .orange-green span {
            color: #218336;
            background: #BBECC5;
        }

        .purple-teal {
            color: #108585;
        }

        .purple-teal span {
            color: #108585;
            background: #B2ECEC;
        }

        /*Frame 15 */

        .table-fifteen {
            margin-top: 24px;
        }

        .fifteent-inner-main {
            margin-top: 20px;
        }

        .fifteen-top {
            display: table;
        }

        .fifteen-top-p {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: normal;

        }

        .fifteen-left {
            border-bottom: 1px solid #E1E1E1;
            padding-bottom: 25px;
        }

        .work-table {
            display: table;
            margin: 29px 22px 0px 41px;
            width: 94vw;
        }

        .work-table-left {
            width: 96%;
        }

        /*Frame 20 */

        .work-right-table {
            width: 33%;
            display: table-cell;
        }

        .work-right-inner {
            border-radius: 6.4px;
            background: #FFF;
            box-shadow: 0px 2.56px 2.56px 0px rgba(0, 0, 0, 0.25);
            padding: 16px 24px;
            margin-right: 17px;
            border: 1px solid #E1E1E1;
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

        /*Frame 21 */

        .contact-frame {
            background-image: url("admin/media/pdf/FrameContact.png");
        }

        .contact-content {
            padding: 32px 0px 0px 26px;
            color: #fff;
        }

        .contact-head {
            font-size: 24px;
            font-weight: 500;
            line-height: 28px;
        }

        .contact-inner {
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
        }

        .contact-inner p {
            margin-bottom: 10px;
        }

        .circle-high-low {
            width: 300px;
        }

        .triangle {
            width: 0px;
            height: 0px;
            border-left: 6.5px solid transparent;
            /* Half of the width */
            border-right: 6.5px solid transparent;
            /* Half of the width */
            border-bottom: 11px solid #2AA443;
            /* Height and color of the triangle */
            margin-right: 10px;
            margin-top: 3px;
        }

        .triangle-down {
            width: 0;
            height: 0;
            border-left: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-right: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-top: 11px solid #e11f1f;
            /* Height and color of the triangle */
            /* transform: rotate(180deg); Flip the triangle to match the SVG direction */
            margin-right: 10px;
            margin-top: 3px;
        }

        .circle {
            width: 13px;
            /* Diameter (2 * radius) */
            height: 13px;
            /* Diameter (2 * radius) */
            /* background-color: #FFAE00; */
            /* Circle color */
            border-radius: 50%;
            /* Makes it a circle */
            margin-right: 10px;
            margin-top: 3px;
        }

        .rectangle-container {
            display: table;
            margin-top: 5px;
            margin-right: 10px;
            gap: 3px;
            /* Space between the rectangles */
        }

        .rectangle {
            height: 4px;
            /* Equivalent to SVG's height */
        }

        .light-green {
            width: 21px;
            /* Equivalent to 21.0817 units in the SVG */
            background-color: #ddf5e2;
            display: table-cell;
        }

        .medium-green {
            width: 21px;
            background-color: #99e2a8;
            display: table-cell;
        }

        .dark-green {
            width: 21px;
            background-color: #2aa443;
            display: table-cell;
        }


        @media print {
            .pdf-page {
                page-break-after: always;
            }

            body {
                width: 100vw;
                height: 100vh;
            }
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f8f8;
        }

        .donut-chart {
            position: relative;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: conic-gradient(#c5e6c3 0% 75%,
                    /* Correct answers: 75% */
                    #fdd89b 75% 100%
                    /* Wrong answers: 25% */
                );
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .donut-chart::before {
            content: "";
            width: 140px;
            height: 140px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
        }
    </style>

    <style>
        .triangle-red {
            width: 0px;
            height: 0px;
            border-left: 6.5px solid transparent;
            /* Half of the width */
            border-right: 6.5px solid transparent;
            /* Half of the width */
            border-bottom: 11px solid #e11f1f;
            /* Height and color of the triangle */
            margin-right: 10px;
            margin-top: 3px;
        }

        .triangle-down-green {
            width: 0;
            height: 0;
            border-left: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-right: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-top: 11px solid #2AA443;
            /* Height and color of the triangle */
            /* transform: rotate(180deg); Flip the triangle to match the SVG direction */
            margin-right: 10px;
            margin-top: 3px;
        }

        .extra-span,
        .aligned,
        .needs-development,
        .highly-aligned,
        .high-badge,
        .low-badge,
        .moderate-badge {
            color: #7F66CA !important;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 3px 7px;
            border-radius: 10px;
            background: #E1D8FB;
            width: fit-content;
            position: relative;
            top: -3px;
        }

        .aligned,
        .high-badge {
            color: #108585 !important;
            background: #B2ECEC;
        }

        .needs-development, .low-badge {
            color: #F7941C !important;
            background: #FFEBB4;
        }
        /* .low-badge {
            color: #7F66CA !important;
            background: #E1D8FB;
        } */

        .moderate-badge {
            color: #218336 !important;
            background: #BBECC5;
        }

        .line-bottom {
            display: block;
            border-bottom: 1px solid #E1E1E1;
            margin-bottom: 20px;
        }

        .circle-green {
            background-color: #2AA443
        }

        .circle-orange {
            background-color: #FFAE00;
        }

        .light-orange,
        .light-orange-sss {
            background: #FFC549;
        }

        .dark-orange,
        .dark-orange-sss {
            background: #F7941C;
        }

        .dark-red,
        .dark-red-sss {
            background: #FF5D5D;
        }

        .dark-green {
            width: 21px;
            background-color: #2aa443;
            display: table-cell;
        }

        .light-green {
            width: 21px;
            /* Equivalent to 21.0817 units in the SVG */
            background-color: #ddf5e2;
            display: table-cell;
        }

        .dark-red-sss,
        .grey-sss,
        .dark-orange-sss,
        .light-orange-sss {
            width: 21px;

            display: table-cell;
        }

        .grey-sss {
            background-color: #EBEBEB;
        }

        .medium-green {
            width: 21px;
            background-color: #99e2a8;
            display: table-cell;
        }

        .entry {
            background: #FFEBB4 !important;
            color: #F7941C !important;
        }

        .individual-contributors {
            /* color: #F36B0A;
            background: #FEECE5; */
            background: #FFEDCA !important;
            color: #F5872B !important;
        }

        .managers {
            color: #FF2E2E;
            background: #FFE8E8;
        }

        .leadership {
            color: #BF3173;
            background: #FFE4F1;
        }

        .highly-aligned {
            color: #7F66CA !important;
            background: #E1D8FB;
        }

        .aligned {
            color: #108585 !important;
            background: #B2ECEC;
        }

        .needs-development {
            background: #FFEBB4 !important;
            color: #F7941C !important;
        }

        .svg-round {
            border: 5px solid #fff;
            background-color: #465F3F;
            border-radius: 50px;
            width: 15px;
            height: 15px;
        }
    </style>
</head>

<body>
    <!-- Frame 1 -->
    <div class="pdf-page">
        <div class="first-frame pdf-background">
            <p class="heading">Assessment Profile</p>
            <div class="info">
                <div>
                    <p class="info-title">REPORT PREPARED FOR:</p>
                    <p class="info-value">{{ $user->name ?? '' }}</p>
                </div>
                <div> 
                    <p class="info-title">DEPARTMENT:</p>
                    <p class="info-value">{{ $user->department->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="info-title">JOB POSITION:</p>
                    <p class="info-value">{{ $user->job_position->title ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="info-title">REPORT DATE:</p>
                    <p class="info-value">{{ $reportDate ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 2 -->
    <div class="pdf-page">
        <div class="second-frame pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>

            <div class="contents">
                <p class="heading-two">Contents</p>
                <div class="points">
                    <div>
                        <p><span>03</span>{{ $companyDetail->name ?? '' }} Values</p>
                        <p><span>05</span>Assessment Report</p>
                        <p><span>06</span>Assessment Report Analysis</p>
                        <p><span>09</span>Critical Core Skills</p>
                        <p><span>14</span>Learning Style</p>
                        <p><span>15</span>Cognitive Ability</p>
                        <p><span>16</span>OCEAN Domain</p>
                        <p><span>17</span>30 Facets</p>
                        <p><span>22</span>RIASEC (Work Interest)</p>
                    </div>
                </div>

            </div>
            <div class="Copyright">
                <h2>Copyright Notice</h2>
                <p>
                    This report has been prepared exclusively for the benefit and
                    internal use of {{ $companyDetail->name ?? '' }} and
                    does not carry any right of reproduction or disclosure to third
                    parties without the expressed written consent of the authors.
                </p>
                <p style="margin-top: -6px">
                    While the utmost care has been taken to incorporate all available
                    data,the latest trends and best practices in the Malaysia Labour
                    Market; no representation or warranty is given by the authors as to
                    the achievement, reasonableness or completeness of any
                    recommendation, idea and/or assumption presented in this report.
                </p>
                <span>© CXS Analytics. All Rights Reserved</span>
            </div>
        </div>
    </div>

    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content" style="font-size: 18px; color: #5B5B5B;">{{ $companyDetail->name ?? '' }} Values</p>
                <p class="heading-content-bot" style="font-size: 14px;">Expected Value: <span
                        style="color: #108585;">Intermediate</span>
                </p>

            </div>

            @if (in_array(env('DB_DATABASE'), ['aboitiz_food_dev', 'aboitiz_food_prod', 'base_ph_dev', 'base_ph_dev_org_structure']))
                <div class="skill-table" style="margin-top: 100px;">
                    <div class="inner-table fifteen-left">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Commitment <span style="color: #465F3F">
                                            100% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        To always represent the spirit of the company.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 100%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: -1%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="purple" style="margin-bottom: 12px;">
                                <span>HIGHLY ALIGNED</span>
                            </p>
                            <p class="purple right-top-heading">
                                99th
                                <span>ADVANCED</span>
                            </p>
                            <p class="table-desc">
                                The employee <b>consistently demonstrates integrity and dedication to the company’s mission</b>. They honor commitments with reliability and fairness, while inspiring others through their actions. They actively foster transparency and embed ethical standards within the team and wider organization. In times of challenge, they remain accountable, take ownership of results, and make principled decisions under pressure. Their dependability, resilience, and moral leadership position them as a trusted role model who represents the true spirit of the company.                            </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                    <div class="inner-table">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Excellence <span style="color: #465F3F;"> 65%  </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We always strive for outstanding results that make us stand out from the rest and be preferred by our clients.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 65%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: 33%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="spring" style="margin-bottom: 12px;">
                                <span>NEEDS DEVELOPMENT</span>
                            </p>
                            <p class="spring right-top-heading">
                                48th
                                <span>DEVELOPMENT STAGE</span>
                            </p>
                            <p class="table-desc">
                                The employee is still <b>developing the skills and mindset required to consistently deliver high-quality outcomes</b>. While they demonstrate effort and willingness to improve, their work may at times fall short of the standards expected for client satisfaction. They are learning to recognize the importance of attention to detail, consistency, and continuous improvement. With guidance and feedback, they are beginning to adopt best practices, refine their problem-solving skills, and understand how their contributions impact team performance and client experience.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif(in_array(env('DB_DATABASE'), ['jgs_olefins_dev', 'jgs_olefins_prod']))
                <div class="skill-table" style="margin-top: 100px;">
                    <div class="inner-table fifteen-left">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Stewardship Mindset <span style="color: #0C52A1">
                                            100% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We are fully responsible for the resources entrusted to us, be they financial, environmental, and people. We make sure that they are managed well and cared for, all with sustainability at the forefront.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 100%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: -1%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="purple" style="margin-bottom: 12px;">
                                <span>HIGHLY ALIGNED</span>
                            </p>
                            <p class="purple right-top-heading">
                                99th
                                <span>ADVANCED</span>
                            </p>
                            <p class="table-desc">
                                The employee <b>embodies a strong stewardship mindset, acting as a strategic leader</b> in managing and preserving organizational resources. They champion sustainability and accountability across teams and functions, guiding others to make thoughtful, future-oriented decisions. They integrate responsible resource management into planning, influence policies that drive sustainable outcomes, and serve as a role model for ethical and visionary stewardship.
                            </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                    <div class="inner-table">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Entrepreneurial Mindset <span style="color: #0C52A1">
                                            65% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We strive for growth with a resilient, passionate and agile mindset with focus on living out our purpose to provide our customers with better choices.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 65%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: 33%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="spring" style="margin-bottom: 12px;">
                                <span>NEEDS DEVELOPMENT</span>
                            </p>
                            <p class="spring right-top-heading">
                                48th
                                <span>DEVELOPMENT STAGE</span>
                            </p>
                            <p class="table-desc">
                                The employee <b>is in the process of developing an awareness of what it means to think and act with an entrepreneurial mindset.</b> They are learning to approach challenges with curiosity and show interest in understanding customer needs. While they may still rely on structure and support, they demonstrate early signs of resilience and openness to trying new approaches. With encouragement, they begin to connect their work to the organization’s broader purpose and growth goals.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="skill-table" style="margin-top: 100px;">
                    <div class="inner-table fifteen-left">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Integrity <span style="color: #465F3F">
                                            100% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We believe in integrity. We deliver on what we promise, practice fair processes, are accountable for our actions and their consequences.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 100%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: -1%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="purple" style="margin-bottom: 12px;">
                                <span>HIGHLY ALIGNED</span>
                            </p>
                            <p class="purple right-top-heading">
                                99th
                                <span>ADVANCED</span>
                            </p>
                            <p class="table-desc">
                                The employees <b>embodies integrity in all aspects of their work</b>. They not only meet commitments and practice fairness consistently but also influence and inspire others to do the same. They proactively uphold transparency and ensure ethical standards are integrated into team or organizational culture. When challenges arise, they model accountability, take ownership of outcomes, and make principled decisions even under pressure. Their trustworthiness and moral leadership make them a role model within the organization.
                            </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                    <div class="inner-table">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Teamwork <span style="color: #465F3F;"> 65%  </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We draw on our collective strength as a team, co-creating exponential growth through synergy, speed, and innovation
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 65%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: 33%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="spring" style="margin-bottom: 12px;">
                                <span>NEEDS DEVELOPMENT</span>
                            </p>
                            <p class="spring right-top-heading">
                                48th
                                <span>DEVELOPMENT STAGE</span>
                            </p>
                            <p class="table-desc">
                                The employee is <b>in the process of learning on how to engage effectively in a team setting</b>. They are beginning to understand the value of collective contribution and are open to collaborating but may still operate independently at times. With guidance, they are developing interpersonal communication and learning how their role fits into the broader team purpose. They are gradually becoming more receptive to shared decision-making and diverse viewpoints.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content" style="font-size: 18px; color: #5B5B5B;">{{ $companyDetail->name ?? '' }} Values</p>
                <p class="heading-content-bot" style="font-size: 14px;">Expected Value: <span
                        style="color: #108585;">Intermediate</span>
                </p>

            </div>
            @if (in_array(env('DB_DATABASE'), ['aboitiz_food_dev', 'aboitiz_food_prod', 'base_ph_dev', 'base_ph_dev_org_structure']))
                <div class="skill-table" style="margin-top: 100px;">
                    <div class="inner-table fifteen-left">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Integrity <span style="color: #465F3F">
                                            100% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        The Company and its workers keep their word and commitments, and are confident that relationships with our clients, suppliers, and workers are long-term relationships.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 100%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: -1%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="purple" style="margin-bottom: 12px;">
                                <span>HIGHLY ALIGNED</span>
                            </p>
                            <p class="purple right-top-heading">
                                99th
                                <span>ADVANCED</span>
                            </p>
                            <p class="table-desc">
                                The employee <b>demonstrates reliability by following through on their commitments and maintaining consistency in their actions</b>. They communicate openly and honestly, ensuring that expectations are clear with colleagues, clients, and partners. While they generally uphold fairness and transparency, they are still developing the ability to navigate complex situations where integrity may be tested. They are becoming a dependable contributor who supports trust-based, long-term relationships and is learning to consistently model integrity in more challenging circumstances.                         </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                    <div class="inner-table fifteen-left">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        RESPECT <span style="color: #465F3F;"> 80%  </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We accept and recognize others as our equals, we promote caring for people and treating them well, and we stand out for having a special understanding between the company and its workers.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 65%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: 33%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="spring" style="margin-bottom: 12px;">
                                <span>NEEDS DEVELOPMENT</span>
                            </p>
                            <p class="spring right-top-heading">
                                48th
                                <span>DEVELOPMENT STAGE</span>
                            </p>
                            <p class="table-desc">
                                The employee is <b>beginning to show awareness of the importance of treating others with courtesy and consideration</b>. They generally interact politely but may not yet consistently recognize or value different perspectives. At this stage, they are developing the ability to listen actively, show empathy, and acknowledge colleagues as equals. With guidance, they are learning how respectful behaviors contribute to stronger teamwork, a supportive workplace, and positive relationships across the company.
                            </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                    <div class="inner-table">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Safety <span style="color: #465F3F;"> 62%  </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        An accident can never be justified. Therefore, people’s safety is more important than any other 
                                        circumstantial target.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 65%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: 33%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="spring" style="margin-bottom: 12px;">
                                <span>NEEDS DEVELOPMENT</span>
                            </p>
                            <p class="spring right-top-heading">
                                44th
                                <span>DEVELOPMENT STAGE</span>
                            </p>
                            <p class="table-desc">
                                The employee is <b>beginning to recognize the importance of safety as a priority over operational targets</b>. They are learning to follow established safety procedures and are becoming more aware of how their actions affect the well-being of themselves and others. While they may still require reminders or guidance, they show willingness to adopt safe practices and demonstrate increasing caution in their daily tasks.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif(in_array(env('DB_DATABASE'), ['jgs_olefins_dev', 'jgs_olefins_prod']))
                <div class="skill-table" style="margin-top: 100px;">
                    <div class="inner-table fifteen-left">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Malasakit <span style="color: #0C52A1">
                                            80% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We act with Malasakit, or genuine care and concern for each other and
                                                        the company, as we deliver on our promise of quality and superior value,
                                                        meaningfully giving back to the community we work in and ultimately
                                                        having a lasting impact on the nation.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 80%; background: #14A028;" class="line line-orange fade-orange"
                                    >
                                </div>
                                <div class="svg-round-icon" style="right: 18%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="cyan" style="margin-bottom: 12px;">
                                <span>ALIGNED</span>
                            </p>
                            <p class="cyan right-top-heading">
                                84th
                                <span>INTERMEDIATE</span>
                            </p>
                            <p class="table-desc">
                                The employee <b>consistently acts with Malasakit by showing empathy, collaboration, and ownership</b>. They actively support teammates, take pride in delivering high-quality outcomes, and often go beyond their job description to help others or the organization. They engage in community efforts and model respect, responsibility, and a strong sense of shared purpose. Their care positively influences team morale, service quality, and connection to broader societal goals.
                            </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                    <div class="inner-table">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Integrity <span style="color: #0C52A1">
                                            80% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We will act with honor in all our undertakings and with all our stakeholders, upholding the principle of always doing the right thing because it is the right thing to do, even when no one else is watching.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 80%; background: #14A028;" class="line line-orange fade-orange"
                                    >
                                </div>
                                <div class="svg-round-icon" style="right: 18%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="spring" style="margin-bottom: 12px;">
                                <span>NEEDS DEVELOPMENT</span>
                            </p>
                            <p class="orange-green right-top-heading">
                                62nd
                                <span>BASIC</span>
                            </p>
                            <p class="table-desc">
                                The employee <b>demonstrates emerging ethical awareness by generally acting with honesty and respect toward others. They aim to meet expectations and are learning to make principled decisions independently</b>. While they may still be influenced by external validation, they show a growing commitment to doing what is right, even in less visible situations. They are becoming more reliable in upholding trust and fairness.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="skill-table" style="margin-top: 100px;">
                    <div class="inner-table fifteen-left">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Integrity <span style="color: #465F3F">
                                            100% </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We believe in integrity. We deliver on what we promise, practice fair processes, are accountable for our actions and their consequences.
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 100%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: -1%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="purple" style="margin-bottom: 12px;">
                                <span>HIGHLY ALIGNED</span>
                            </p>
                            <p class="purple right-top-heading">
                                99th
                                <span>ADVANCED</span>
                            </p>
                            <p class="table-desc">
                                The employees <b>embodies integrity in all aspects of their work</b>. They not only meet commitments and practice fairness consistently but also influence and inspire others to do the same. They proactively uphold transparency and ensure ethical standards are integrated into team or organizational culture. When challenges arise, they model accountability, take ownership of outcomes, and make principled decisions even under pressure. Their trustworthiness and moral leadership make them a role model within the organization.
                            </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                    <div class="inner-table">
                        <div class="fourteen-left">
                            <div class="fifteen-top">
                                <div style="display: table-row; max-width: 100%;">
                                    <p class="fifteen-top-p left-table-head">
                                        Teamwork <span style="color: #465F3F;"> 65%  </span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                        We draw on our collective strength as a team, co-creating exponential growth through synergy, speed, and innovation
                                    </p>
                                </div>
                            </div>
                            <div class="line line-grey">
                                <div style="width: 65%; background: #14A028;" class="line line-orange fade-orange"  >
                                </div>
                                <div class="svg-round-icon" style="right: 33%; top: 3px;">
                                    <div class="svg-round"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p class="spring" style="margin-bottom: 12px;">
                                <span>NEEDS DEVELOPMENT</span>
                            </p>
                            <p class="spring right-top-heading">
                                48th
                                <span>DEVELOPMENT STAGE</span>
                            </p>
                            <p class="table-desc">
                                The employee is <b>in the process of learning on how to engage effectively in a team setting</b>. They are beginning to understand the value of collective contribution and are open to collaborating but may still operate independently at times. With guidance, they are developing interpersonal communication and learning how their role fits into the broader team purpose. They are gradually becoming more receptive to shared decision-making and diverse viewpoints.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 3 -->

    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <p class="heading-three">Assessment Report</p>
            <div class="table">
                @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                    <p class="table-head">OVERVIEW ANALYSIS</p>
                    <div class="table-box">
                        <p>Overall Match Rate</p>
                        <div class="icon-div" style="margin: auto; margin-top: 10px;">
                            <div style="display: table-row;">
                                {{-- <p
                                    class="{{ config('helpers.icon_class_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}">
                                </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                <p style="display: table-cell; padding-left: 5px;">
                                    {{ config('helpers.overall_match_rate_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}
                                </p>
                            </div>
                        </div>
                    </div> 
                    <p class="table-head">TECHNICAL ASSESSMENT</p>
                    <div class="table-box">
                        <p>Technical Assessment Result</p>
                        <div class="icon-div" style="margin: auto; margin-top: 10px;">
                            <div style="display: table-row;">
                                {{-- <p
                                    class="{{ config('helpers.icon_class_levels')[$technicalResult['technical']['level'] ?? 0] }}">
                                </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$technicalResult['technical']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                <p style="display: table-cell; padding-left: 5px;">
                                    {{ config('helpers.technical_assessment_levels')[$technicalResult['technical']['level'] ?? 0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                
                <p class="table-head">PERSONALITY AND MOTIVATION</p>
                <div class="table-box box-two">
                    <div class="box-inner">
                        <div style="display: table-row;">
                            <div class="inner-div">
                                <p>Behavioral Fit Rate</p>
                                <div class="icon-div">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.soft_skill_match_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-div" style="display: table-cell; text-align: right;">
                                <p>Response Consistency Index</p>
                                <div class="icon-div" style="float: right;">
                                    <div style="display: table-row;">
                                        <p class="circle {{ config('helpers.rci_class_based_on_levelss')[$rciResult['rci']['level'] ?? 0] }}"
                                            style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }} !important;">
                                        </p>
                                        <p style="display: table-cell;">
                                            {{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-inner">
                        <div style="display: table-row;">
                            <div class="inner-div">
                                <p>Job Match Rate</p>
                                <div class="icon-div">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif 
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.job_match_rate_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-div" style="display: table-cell; text-align: right;">
                                <p>Soft Skill Match Rate</p>
                                <div class="icon-div" style="float: right;">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.talent_pillar_match_rate_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-inner">
                        <div style="display: table-row;">
                            <div class="inner-div">
                                <p>Leadership Potential</p>
                                <div class="icon-div">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif 
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.growth_potential_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-div" style="display: table-cell; text-align: right;">
                                <p>Growth Potential</p>
                                <div class="icon-div" style="float: right;">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-inner">
                        <div style="display: table-row;">
                            <div class="inner-div">
                                <p>Workplace Alignment Forecast</p>
                                <div class="icon-div">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }} Risk
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-div" style="display: table-cell; text-align: right;">
                                <p>Flight Risk</p>
                                <div class="icon-div" style="float: right;">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="table-head" style="margin-top: 10px;">PERSONALITY TYPE</p>
                    <div class="table-box">
                        <p>{{ $personalityTypeResult['name'] ?? '' }}</p>
                    </div>
                    <p class="table-head" style="margin-top: 10px;">COGNITIVE LEVEL</p>
                    <div class="box-inner">
                        <div style="display: table-row;">
                            <div class="inner-div">
                                <p>Cognitive Test Result</p>
                                <div class="icon-div">
                                    <div style="display: table-row;">
                                        <div class="rectangle-container">
                                            <div style="display: table-row;">
                                                @if ($cognitiveOverallResult['cognitive']['level'] == 1)
                                                    <div class="rectangle dark-red-sss"></div>
                                                    <div class="rectangle grey-sss"></div>
                                                    <div class="rectangle grey-sss"></div>
                                                @endif
        
                                                @if ($cognitiveOverallResult['cognitive']['level'] == 2)
                                                    <div class="rectangle light-orange-sss"></div>
                                                    <div class="rectangle dark-orange-sss"></div>
                                                    <div class="rectangle grey-sss"></div>
                                                @endif
        
                                                @if ($cognitiveOverallResult['cognitive']['level'] == 3)
                                                    <div class="rectangle light-green"></div>
                                                    <div class="rectangle medium-green"></div>
                                                    <div class="rectangle dark-green"></div>
                                                @endif
                                                {{-- <p
                                                    class="rectangle @if ($cognitiveOverallResult['cognitive']['level'] == 1) dark-green @else light-green @endif ">
                                                </p>
                                                <p
                                                    class="rectangle @if ($cognitiveOverallResult['cognitive']['level'] == 2) dark-green @else light-green @endif ">
                                                </p>
                                                <p
                                                    class="rectangle @if ($cognitiveOverallResult['cognitive']['level'] == 3) dark-green @else light-green @endif ">
                                                </p> --}}
                                            </div>
                                        </div>
                                        <p style="font-weight: 600; margin-top:5px; display: table-cell;">
                                            {{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-div" style="display: table-cell; text-align: right;">
                                <p>Technical Skill Match Rate</p>
                                <div class="icon-div" style="float: right;">
                                    <div style="display: table-row;">
                                        {{-- <p
                                            class="{{ config('helpers.icon_class_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}">
                                        </p> --}}
                                        @php
                                        $icon = config('helpers.icon_class_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle;">
                                        @endif
                                        <p style="display: table-cell; padding-left: 5px;">
                                            {{ config('helpers.talent_pillar_match_rate_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="table-head">RIASEC (Top 3)</p>
                    <div class="table-box table-bottom-box">
                        <div class="box-bottom">
                            <div>
                                <p>Individual</p>
                                <p style="font-weight: 600; font-size: 20px; margin-top: 5px;">
                                    {{ $riasecTop3Result['string'] ?? '' }}
                                </p>
                            </div>
                            <div style="display: table-cell; width: 44%;">
                                <p>Job</p>
                                <p style="font-weight: 600; font-size: 20px; margin-top: 5px;">
                                    {{ $riasecTop3Result['job_top_3_riasec'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 4 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <p class="heading-three">Assessment Report Analysis</p>
                @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                    <div class="content-div">
                        <p class="heading-content">Overall Match Rate</p>
                        <div class="icon-p">
                            <div style="display: table-row; max-width: 100%;">
                                {{-- <p
                                    class="{{ config('helpers.icon_class_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}">
                                </p> --}}
                                @php
                                        $icon = config('helpers.icon_class_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                                <p style="display: table-cell; padding-left: 5px;">
                                    {{ config('helpers.overall_match_rate_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}
                                </p>
                            </div>
                        </div>
                        <p class="content-desc">
                            {!! $overAllMatchRateResult['overall-match-rate']['description'] ?? '' !!}
                        </p>
                    </div>
                    <div class="content-div">
                        <p class="heading-content">Technical Assessment Result</p>
                        <div class="icon-p">
                            <div style="display: table-row; max-width: 100%;">
                                {{-- <p
                                    class="{{ config('helpers.icon_class_levels')[$technicalResult['technical']['level'] ?? 0] }}">
                                </p> --}}
                                @php
                                        $icon = config('helpers.icon_class_levels')[$technicalResult['technical']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                                <p style="display: table-cell; padding-left: 5px;">
                                    {{ config('helpers.technical_assessment_levels')[$technicalResult['technical']['level'] ?? 0] }}
                                </p>
                            </div>
                        </div>
                        <p class="content-desc">
                            {!! $technicalResult['technical']['description'] ?? '' !!}
                        </p>
                    </div>
                @endif
            
            <div class="content-div">
                <p class="heading-content">Behavioral Fit Rate</p>
                <div class="icon-p">
                    <div style="display: table-row; max-width: 100%;">
                        {{-- <p
                            class="{{ config('helpers.icon_class_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}">
                        </p> --}}
                        @php
                                        $icon = config('helpers.icon_class_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.soft_skill_match_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}
                        </p>
                    </div>
                </div>

                <p class="content-desc">
                    {!! $behaviorFitRateResult['soft-skill-score']['description'] ?? '' !!}
                </p>
            </div>
            <div class="content-div">
                <p class="heading-content">Response Consistency Index</p>
                <div class="icon-p">
                    <div style="display: table-row;">
                        {{-- <p
                            class="circle {{ config('helpers.rci_class_based_on_levelss')[$rciResult['rci']['level'] ?? 0] }}" style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }};">
                        </p> --}}
                        <p class="circle {{ config('helpers.rci_class_based_on_levelss')[$rciResult['rci']['level'] ?? 0] }}"
                            style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }} !important;">
                        </p>
                        <p style="display: table-cell;">
                            {{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }} </p>
                    </div>
                </div>
                <p class="content-desc">{!! $rciResult['rci']['description'] ?? '' !!}</p>
            </div>
            <div class="content-div">
                <p class="heading-content">Job Match Rate</p>
                <div class="icon-p">
                    <div style="display: table-row; max-width: 100%;">
                        {{-- <p
                            class="{{ config('helpers.icon_class_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}">
                        </p> --}}
                        @php
                                        $icon = config('helpers.icon_class_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.job_match_rate_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}
                        </p>
                    </div>
                </div>
                <p class="content-desc">
                    {!! $jobMatchRateResult['job-match-rate']['description'] ?? '' !!}
                </p>
            </div>
            <div class="content-div">
                <p class="heading-content">Soft Skill Match Rate</p>
                <div class="icon-p">
                    <div style="display: table-row; max-width: 100%;">
                        {{-- <p
                            class="{{ config('helpers.icon_class_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}">
                        </p> --}}
                        @php
                                        $icon = config('helpers.icon_class_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.talent_pillar_match_rate_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}
                        </p>
                    </div>
                </div>
                <p class="content-desc">
                    {!! $softSkillMatchRateResult['ccs-match-rate']['description'] ?? '' !!}
                </p>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 5 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="content-div">
            <p class="heading-content" style="margin-top: 21px;">Personality Type</p>
                <div class="icon-p">
                    <p style="
            font-size: 18px;
            line-height: 26px;">
                        {{ $personalityTypeResult['name'] ?? '' }}</p>
                </div>

                {{-- <p class="content-desc"><span>Innovative Thinking</span>: Geniuses are known for their creativity and ability to
          think outside the box, often coming up with groundbreaking ideas and solutions.</p>
        <p class="content-desc" style="padding-top: 6px;"><span>Problem-Solving</span>: They excel at solving complex
          problems through analytical
          thinking and ingenuity.</p> --}}
                <p class="content-desc">
                    {!! str_replace(';', '<br>', $personalityTypeResult['description'] ?? '') !!}
                </p>
            </div>
            <div class="content-div" style="margin-bottom: 21px;">
                <p class="heading-content">Leadership Potential</p>
                <div class="icon-p">
                    <div style="display: table-row; max-width: 100%;">
                        {{-- <p class="moderate-big-icon"></p> --}}
                        {{-- <p
                            class="{{ config('helpers.icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}">
                        </p> --}}
                        @php
                                        $icon = config('helpers.icon_class_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.growth_potential_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}
                        </p>
                    </div>
                </div>
                <p class="content-desc">
                    {!! $leadershipPotentialResult['leadership-potential']['description'] ?? '' !!}</p>
            </div>
            <div class="content-div" style="margin-bottom: 21px;">
                <p class="heading-content">Growth Potential</p>
                <div class="icon-p">
                    <div style="display: table-row; max-width: 100%;">
                        {{-- <p class="moderate-big-icon"></p> --}}
                        {{-- <p
                            class="{{ config('helpers.icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}">
                        </p> --}}
                        @php
                                        $icon = config('helpers.icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}
                        </p>
                    </div>
                </div>
                <p class="content-desc">
                    {!! $growthPotentialResult['growth-potential']['description'] ?? '' !!}</p>
            </div>
            <div class="content-div" style="margin-top: 21px;">
                <p class="heading-content">Workplace Alignment Forecast</p>
                <div class="icon-p">
                    <div style="display: table-row;">
                        {{-- <p
                            class="{{ config('helpers.icon_class_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}">
                        </p> --}}
                        @php
                                        $icon = config('helpers.icon_class_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}
                        </p>
                    </div>
                </div>
                <p class="content-desc">
                    {!! $organizationalFitForecastResult['organizational-fit-forecast']['description'] ?? '' !!}</p>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 6 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="content-div">
            <p class="heading-content" style="margin-top: 21px;">Flight Risk</p>
                <div class="icon-p">
                    <div style="display: table-row; max-width: 100%;">
                        {{-- <p
                            class="{{ config('helpers.icon_class_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}">
                        </p> --}}
                        @php
                                        $icon = config('helpers.icon_class_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk
                        </p>
                    </div>
                </div>
                <p class="content-desc">
                    {!! $flightRiskResult['flight-risk']['description'] ?? '' !!}
                </p>
            </div>
            <div class="content-div">
                <p class="heading-content">Cognitive Test Result</p>
                <div style="display: table;" class="icon-p">
                            <div style="display: table-row;">
                                <div class="rectangle-container" style="margin-top: 10px;">
                                    <div style="display: table-row;">
                                        @if ($cognitiveOverallResult['cognitive']['level'] == 1)
                        <div class="rectangle dark-red-sss"></div>
                        <div class="rectangle grey-sss"></div>
                        <div class="rectangle grey-sss"></div>
                        @endif

                        @if ($cognitiveOverallResult['cognitive']['level'] == 2)
                            <div class="rectangle light-orange-sss"></div>
                            <div class="rectangle dark-orange-sss"></div>
                            <div class="rectangle grey-sss"></div>
                        @endif

                        @if ($cognitiveOverallResult['cognitive']['level'] == 3)
                            <div class="rectangle light-green"></div>
                            <div class="rectangle medium-green"></div>
                            <div class="rectangle dark-green"></div>
                        @endif
                                        {{-- <p
                                            class="rectangle @if ($cognitiveOverallResult['cognitive']['level'] == 1) dark-green @else light-green @endif ">
                                        </p>
                                        <p
                                            class="rectangle @if ($cognitiveOverallResult['cognitive']['level'] == 2) dark-green @else light-green @endif ">
                                        </p>
                                        <p
                                            class="rectangle @if ($cognitiveOverallResult['cognitive']['level'] == 3) dark-green @else light-green @endif ">
                                        </p> --}}
                                    </div>
                                </div>
                                <p style="display: table-cell;">
                                {{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}
                            </p>
                            </div>
                        </div>
                <p class="content-desc">
                    {!! $cognitiveOverallResult['cognitive']['description'] ?? '' !!}
                </p>
            </div>
            <div class="content-div" style="margin-bottom: 21px;">
                <p class="heading-content">Technical Skill Match Rate</p>
                <div class="icon-p">
                    <div style="display: table-row; max-width: 100%;">
                        @php
                                        $icon = config('helpers.icon_class_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0];
                                        @endphp

                                        @if(!empty($icon) && file_exists(public_path($icon)))
                                            <img src="{{ public_path($icon) }}" 
                                                width="14" height="16" alt="icon" style="display: table-cell; vertical-align: middle; padding-top: 4px;">
                                        @endif
                        <p style="display: table-cell; padding-left: 5px;">
                            {{ config('helpers.growth_potential_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}
                        </p>
                    </div>
                </div>
                <p class="content-desc">
                    {!! $technicalSkillMatchRateResult['technical-skill-match-rate']['description'] ?? '' !!}</p>
            </div>
            <div class="content-div" style="margin-bottom: 21px;">
                <p class="heading-content">RIASEC (Top 3)</p>
                <div class="icon-p">
                    <p style="font-size: 19.2px; color:#F7941C;">{{ $riasecTop3Result['string'] ?? '' }}</p>
                </div>
                <p class="content-desc">{!! $riasecTop3Result['description'] ?? '' !!}</p>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 7 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content">Skills Alignment:<br />
                    Critical Core Skills</p>
            </div>
            <div class="skill-table">
                @foreach (collect($jobCcsResult)->take(2) as $name => $result)
                    <div class="inner-table fifteen-left">
                        <div class="left-table">
                            <div class="table-top-content">
                                <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                        {{ $result['score'] ?? 0 }}%</span></p>
                                <p class="table-desc">
                                    {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                </p>
                            </div>
                            <div class="line line-grey">
                                <div style="width: {{ $result['score'] ?? 0 }}%;"
                                    class="line line-orange dark-orange"></div>
                                <div class="svg-round-icon"
                                    style="right: {{ 100 - 2 - $result['score'] }}%; top: 5px;">
                                    <img src="admin/media/pdf/RoundIcon.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p
                                class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                {{ $result['percentage_with_label'] ?? 0 }}
                                <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                            </p>
                            <p class="right-bot">Generic Skills Requirement
                                <span class="{{ config('helpers.ccs_class_based_on_levels')[$result['required_level'] ?? 0] }}">{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span>
                            </p>
                            <span
                                class="badge-custom {{ config('helpers.all_star_job_alignment')[$result['alignment_level'] ?? 0]['class'] ?? '' }}">
                                {{ config('helpers.all_star_job_alignment')[$result['alignment_level'] ?? 0]['title'] ?? '' }}
                            </span>
                            <p class="table-desc">
                                {!! $result['description'] ?? '' !!}
                            </p>
                        </div>
                    </div>
                    <div style="height: 48px;"></div>
                @endforeach

            </div>

            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

      @if ($user->job_position)
        <!-- Frame 7 -->
        <div class="pdf-page">
            <div class="pdf-background">
                <div class="top-head">
                    <div class="row">
                        <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                            <span>{{ $user->job_position->title ?? '' }}</span>
                        </div>
                        {{-- <div
                            @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                            Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                    </div>
                </div>
                <div class="skill-div">
                    <p class="heading-content">Skills Alignment:<br />
                        Critical Core Skills</p>
                </div>
                <div class="skill-table">
                    @foreach (collect($jobCcsResult)->skip(2) as $name => $result)
                        <div class="inner-table fifteen-left">
                            <div class="left-table">
                                <div class="table-top-content">
                                    <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                            {{ $result['score'] ?? 0 }}%</span></p>
                                    <p class="table-desc">
                                        {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                    </p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $result['score'] ?? 0 }}%;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $result['score'] }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="right-table">
                                <p
                                    class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                    {{ $result['percentage_with_label'] ?? 0 }}
                                    <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                                </p>
                                <p class="right-bot">Generic Skills Requirement
                                    <span class="{{ config('helpers.ccs_class_based_on_levels')[$result['required_level'] ?? 0] }}">{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span>
                                </p>
                                <span
                                    class="badge-custom {{ config('helpers.all_star_job_alignment')[$result['alignment_level'] ?? 0]['class'] ?? '' }}">
                                    {{ config('helpers.all_star_job_alignment')[$result['alignment_level'] ?? 0]['title'] ?? '' }}
                                </span>
                                <p class="table-desc">
                                    {!! $result['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                        <div style="height: 48px;"></div>
                    @endforeach

                </div>

                <div class="bottom-content">
                    <div class="row">
                        <div class="width-33">{{ $reportDate ?? '' }}</div>
                        <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                        <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                    </div>
                </div>
            </div>
        </div>
    
      @endif
    <!-- Frame 8 -->
    {{-- <div class="pdf-page">
    <div class="pdf-background">
          <div class="top-head">
      <div class="row">
          <div class="left">Report Prepared for: <span>{{ $user->name ?? '' }}</span></div>
          <div @if (str_word_count($user->job_position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->job_position->title ?? '' }}</span></div>
      </div>
    </div>
      <div class="skill-div">
        <p class="heading-content">Skills Alignment:<br />
          Critical Core Skills</p>

      </div>
      <div class="skill-table">
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Problem Solving<span> 80%</span></p>
              <p class="table-desc">Identify problems and implement guidelines and procedures to solve problems and test
                solutions</p>
            </div>
            <div class="line line-grey">
              <div style="width: 80%;" class="line line-orange dark-orange"></div>
              <div class="svg-round-icon" style="right: 19%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">62nd<span> BASIC</span></p>
            <p class="right-bot">Generic Skills Requirement<span> INTERMEDIATE</span></p>
            <p class="table-desc">The employees personality traits likely embodies enhancing capacity to recognize
              potential problems within familiar areas of work, particially align with the job requirement. While they
              are still building confidence in proactively anticipating problems and driving continuous improvement
              beyond their current responsibilities, they show strong potential to enhance these skills.</p>
          </div>
        </div>
        <div style="height: 48px;"></div>

        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Customer Orientation<span> 85%</span></p>
              <p class="table-desc">Demonstrate an understanding of customer needs or objectives to respond in a way
                which delivers an effective customer experience</p>
            </div>
            <div class="line line-grey">
              <div style="width: 85%;" class="line line-orange dark-orange"></div>
              <div class="svg-round-icon" style="right: 14%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">56th<span class="green"> BASIC</span></p>
            <p class="right-bot">Generic Skills Requirement<span> INTERMEDIATE</span></p>
            <p class="table-desc">The employees personality traits likely embodies enhancing capacity to connect with
              customers and respond to their needs, partially aligning with the job requirements. While they effectively
              establish basic relationships and respond to known needs, they have strong potential to enhance their
              skills in proactively anticipating future requirements.</p>
          </div>
        </div>
      </div>

      <div class="bottom-content">
      <div class="row">
          <div class="left">{{ $reportDate ?? '' }}</div>
          <div class="right bottom-p">© CXS Analytics <span class="page-number"></span></div>
      </div>
    </div>
    </div>
  </div> --}}

    <!-- Frame 9 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content">Other Critical Core Skills</p>

            </div>
            <div class="skill-table" style="margin-top: 36px;">
                @foreach ($ccsResult->take(4) as $name => $result)
                    <div class="inner-table fifteen-left" style="margin-top: 20px;">
                        <div class="left-table">
                            <div class="table-top-content">
                                <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                        {{ $result['score'] ?? 0 }}%</span></p>
                                <p class="table-desc">
                                    {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                </p>
                            </div>
                            <div class="line line-grey">
                                <div style="width: {{ $result['score'] ?? 0 }}%;"
                                    class="line line-orange dark-orange"></div>
                                <div class="svg-round-icon"
                                    style="right: {{ 100 - 2 - $result['score'] }}%; top: 5px;">
                                    <img src="admin/media/pdf/RoundIcon.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p
                                class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                {{ $result['percentage_with_label'] ?? 0 }}
                                <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                            </p>
                            {{-- <p class="right-bot">Generic Skills Requirement <span>{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span></p> --}}
                            <p class="table-desc">
                                {{ isset($result['description']) ? preg_replace('/, aligning well with( the)? job requirement(s)?/i', '', $result['description']) : '' }}

                            </p>
                        </div>
                    </div>
                    <div style="height: 24px;"></div>
                @endforeach
            </div>

            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-table" style="margin-top: 36px;">
                @foreach ($ccsResult->skip(4)->take(4) as $name => $result)
                    <div class="inner-table fifteen-left" style="margin-top: 20px;">
                        <div class="left-table">
                            <div class="table-top-content">
                                <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                        {{ $result['score'] ?? 0 }}%</span></p>
                                <p class="table-desc">
                                    {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                </p>
                            </div>
                            <div class="line line-grey">
                                <div style="width: {{ $result['score'] ?? 0 }}%;"
                                    class="line line-orange dark-orange"></div>
                                <div class="svg-round-icon"
                                    style="right: {{ 100 - 2 - $result['score'] }}%; top: 5px;">
                                    <img src="admin/media/pdf/RoundIcon.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p
                                class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                {{ $result['percentage_with_label'] ?? 0 }}
                                <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                            </p>
                            {{-- <p class="right-bot">Generic Skills Requirement <span>{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span></p> --}}
                            <p class="table-desc">
                                {{ isset($result['description']) ? preg_replace('/, aligning well with( the)? job requirement(s)?/i', '', $result['description']) : '' }}

                            </p>
                        </div>
                    </div>
                    <div style="height: 24px;"></div>
                @endforeach
            </div>

            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-table" style="margin-top: 36px;">
                @php
                    $ccsToShow = $user->job_position
                        ? $ccsResult->skip(8)
                        : $ccsResult->skip(8)->take(4);
                @endphp
                @foreach ($ccsToShow as $name => $result)
                    <div class="inner-table fifteen-left" style="margin-top: 20px;">
                        <div class="left-table">
                            <div class="table-top-content">
                                <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                        {{ $result['score'] ?? 0 }}%</span></p>
                                <p class="table-desc">
                                    {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                </p>
                            </div>
                            <div class="line line-grey">
                                <div style="width: {{ $result['score'] ?? 0 }}%;"
                                    class="line line-orange dark-orange"></div>
                                <div class="svg-round-icon"
                                    style="right: {{ 100 - 2 - $result['score'] }}%; top: 5px;">
                                    <img src="admin/media/pdf/RoundIcon.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="right-table">
                            <p
                                class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                {{ $result['percentage_with_label'] ?? 0 }}
                                <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                            </p>
                            {{-- <p class="right-bot">Generic Skills Requirement <span>{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span></p> --}}
                            <p class="table-desc">
                                {{ isset($result['description']) ? preg_replace('/, aligning well with( the)? job requirement(s)?/i', '', $result['description']) : '' }}

                            </p>
                        </div>
                    </div>
                    <div style="height: 24px;"></div>
                @endforeach
            </div>

            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    @if(!($user->job_position))
        <div class="pdf-page">
            <div class="pdf-background">
                <div class="top-head">
                    <div class="row">
                        <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                            <span>{{ $user->job_position->title ?? '' }}</span>
                        </div>
                        {{-- <div
                            @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                            Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                    </div>
                </div>
                <div class="skill-table" style="margin-top: 36px;">
                    @foreach ($ccsResult->skip(12) as $name => $result)
                        <div class="inner-table fifteen-left" style="margin-top: 20px;">
                            <div class="left-table">
                                <div class="table-top-content">
                                    <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                            {{ $result['score'] ?? 0 }}%</span></p>
                                    <p class="table-desc">
                                        {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                    </p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $result['score'] ?? 0 }}%;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $result['score'] }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="right-table">
                                <p
                                    class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                    {{ $result['percentage_with_label'] ?? 0 }}
                                    <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                                </p>
                                {{-- <p class="right-bot">Generic Skills Requirement <span>{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span></p> --}}
                                <p class="table-desc">
                                    {{ isset($result['description']) ? preg_replace('/, aligning well with( the)? job requirement(s)?/i', '', $result['description']) : '' }}

                                </p>
                            </div>
                        </div>
                        <div style="height: 24px;"></div>
                    @endforeach
                </div>

                <div class="bottom-content">
                    <div class="row">
                        <div class="width-33">{{ $reportDate ?? '' }}</div>
                        <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                        <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                    </div>
                </div>
            </div>
        </div>

    @endif


    <!-- Frame 10 -->
    {{-- <div class="pdf-page">
    <div class="pdf-background">
          <div class="top-head">
      <div class="row">
          <div class="left">Report Prepared for: <span>{{ $user->name ?? '' }}</span></div>
          <div @if (str_word_count($user->job_position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->job_position->title ?? '' }}</span></div>
      </div>
    </div>
      <div class="skill-div">
        <p class="heading-content">Other Critical Core Skills</p>

      </div>
      <div class="skill-table" style="margin-top: 36px;">
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Global Perspective<span> 80%</span></p>
              <p class="table-desc">Demonstrate an understanding of global challenges and opportunities to work
                effectively in a cross-cultural environment  </p>
            </div>
            <div class="line line-grey">
              <div style="width: 80%;" class="line line-orange dark-orange"></div>
              <div class="svg-round-icon" style="right: 19%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="cyan">84th <span>INTERMEDIATE</span></p>
            <p class="table-desc">The employees personality traits typically cultivate a solid capacity to lead in
              cross-cultural environments and contribute to building the organization’s global capabilities, largely
              aligning with job requirements. They can resolve challenges that arise in diverse environments and
              actively work towards positioning the organization for success in global markets</p>
          </div>
        </div>
        <div style="height: 24px;"></div>
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Digital Fluency<span> 70%</span></p>
              <p class="table-desc">Perform work processes and activities using identified digital technology tools,
                systems and software</p>
            </div>
            <div class="line line-grey">
              <div style="width: 70%;" class="line line-orange fade-orange"></div>
              <div class="svg-round-icon" style="right: 29%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">67th<span class="green"> BASIC</span></p>
            <p class="table-desc">The employees personality traits likely embodies enhancing capacity to identify
              opportunities and understand some risks associated with using digital tools and software, aligning
              partially with the job requirements. While they can suggest basic uses of technology within familiar
              contexts, they show strong potential to enhance their digital assessment and risk evaluation skills.</p>
          </div>
        </div>
        <div style="height: 24px;"></div>
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Influence<span> 80%</span></p>
              <p class="table-desc">Demonstrate empathy to understand the feelings and actions of others and communicate
                in ways that limit misunderstandings and influence others on operational issues</p>
            </div>
            <div class="line line-grey">
              <div style="width: 80%;" class="line line-orange dark-orange"></div>
              <div class="svg-round-icon" style="right: 19%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">58th <span class="green">BASIC</span></p>
            <p class="table-desc">The employees personality traits likely embodies enhancing capacity to engage with
              stakeholders to build confidence and communicate goals, aligning partially with the job requirements at
              this time. While they can establish basic connections and align on immediate objectives, they show
              potential to enhance their skills in building confidence and alignment.</p>
          </div>
        </div>
        <div style="height: 24px;"></div>
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Creative Thinking <span> 70%</span></p>
              <p class="table-desc">Adopt diverse perspectives in combining ideas or information and making connections
                between different fields to create different ideas, improvements and solutions.</p>
            </div>
            <div class="line line-grey">
              <div style="width: 70%;" class="line line-orange fade-orange"></div>
              <div class="svg-round-icon" style="right: 29%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">54th <span class="green">BASIC</span></p>
            <p class="table-desc">The employees personality traits likely embodies enhancing capacity to support
              innovation within small, defined areas of their role, aligning partially with the job requirements. While
              they are able to suggest minor improvements and ideas to drive creativity or reshape organizational goals,
              they demonstrate potential to expand their influence on innovation.</p>
          </div>
        </div>
      </div>

      <div class="bottom-content">
      <div class="row">
          <div class="left">{{ $reportDate ?? '' }}</div>
          <div class="right bottom-p">© CXS Analytics <span class="page-number"></span></div>
      </div>
    </div>
    </div>
  </div> --}}

    <!-- Frame 11 -->
    {{-- <div class="pdf-page">
    <div class="pdf-background">
          <div class="top-head">
      <div class="row">
          <div class="left">Report Prepared for: <span>{{ $user->name ?? '' }}</span></div>
          <div @if (str_word_count($user->job_position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->job_position->title ?? '' }}</span></div>
      </div>
    </div>
      <div class="skill-div">
        <p class="heading-content">Other Critical Core Skills</p>

      </div>
      <div class="skill-table" style="margin-top: 36px;">
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Self Management<span> 73%</span></p>
              <p class="table-desc">Exercise self-awareness by monitoring own behaviours and ways of working in personal
                and professional capacities, and implement techniques for improvement</p>
            </div>
            <div class="line line-grey">
              <div style="width: 73%;" class="line line-orange fade-orange"></div>
              <div class="svg-round-icon" style="right: 26%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">53rd<span class="green"> BASIC</span></p>
            <p class="table-desc">The employees personality traits likely embodies enhancing capacity to apply basic
              strategies to manage their well-being and effectiveness, partially aligning with the job requirements.
              While they can evaluate some aspects of their self-management and understand certain influences on their
              personal brand, they may need further support to refine these strategies and apply them consistently.</p>
          </div>
        </div>
        <div style="height: 24px;"></div>
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Sense Making<span> 70%</span></p>
              <p class="table-desc">Organise and interpret information to identify relationships and linkages </p>
            </div>
            <div class="line line-grey">
              <div style="width: 70%;" class="line line-orange fade-orange"></div>
              <div class="svg-round-icon" style="right: 29%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">34th <span class="spring">DEVELOPMENT STAGE</span></p>
            <p class="table-desc">The employees personality traits suggest they exhibit minimal capacity to organize and
              interpret information to identify relationships and linkages, which may not fully align with the job
              requirements at this time. While they rely heavily on structured guidance, they have potential for growth
              as they build foundational skills in this area.</p>
          </div>
        </div>
        <div style="height: 24px;"></div>
        <div class="inner-table">
          <div class="left-table">
            <div class="table-top-content">
              <p class="left-table-head">Adaptability<span> 55%</span></p>
              <p class="table-desc">Modify behaviours and approaches to respond to changes and evolving contexts</p>
            </div>
            <div class="line line-grey">
              <div style="width: 55%;" class="line line-orange fade-orange"></div>
              <div class="svg-round-icon" style="right: 44%; top: 5px;">
                <img src="admin/media/pdf/RoundIcon.svg" />
              </div>
            </div>
          </div>
          <div class="right-table">
            <p class="orange">14th <span class="spring">DEVELOPMENT STAGE</span></p>
            <p class="table-desc">The employees personality traits suggest they are innately holds the capacity to
              foster a culture of flexibility, which may not fully align with the job requirements at this time. While
              they are still building confidence in adapting to evolving contexts and encouraging others to embrace
              change, they show strong potential to enhance their skills in promoting flexibility.</p>
          </div>
        </div>
      </div>

      <div class="bottom-content">
      <div class="row">
          <div class="left">{{ $reportDate ?? '' }}</div>
          <div class="right bottom-p">© CXS Analytics <span class="page-number"></span></div>
      </div>
    </div>
    </div>
  </div> --}}

    <!-- Frame 12 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content" style="font-size: 18px;">Learning Style</p>
                <p class="heading-content" style="float: right; font-size: 12px;"><img src="admin/media/svg/org-chart-svg/line-three.svg" alt="line"> Employee's Learning Style</p>
            </div>
            <div class="skill-table" style="margin-top: 36px; width: auto;">
                <div class="inner-table">
                    <div style="display: table-row; max-width: 100%;">
                        <div class="left-table">
                            <div>
                                <div class="table-top-content" @if($learningStyle['visual_kinesthetic_score'] > 3.75)  style="padding: 12px 12px 12px 14px; background: #FFF6EA; margin-top: 24px;" @else style="margin-top: 25px;" @endif
                                    >
                                    <p class="left-table-head">Visual & Kinesthetic<span>
                                            {{ $learningStyle['visual_kinesthetic_percentage'] ?? 0 }}%</span>
                                    </p>
                                    <p class="table-desc">
                                        {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'visual-kinesthetic')->first()->analysis ?? ' ' }}
                                    </p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $learningStyle['visual_kinesthetic_percentage'] ?? 0 }}%;"
                                        class="line line-orange @if($learningStyle['visual_kinesthetic_score'] > 3.75) dark-orange @else fade-orange @endif"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $learningStyle['visual_kinesthetic_percentage'] }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                                <div class="summary">
                                    <p class="summary-head">Examples:</p>
                                    <ul>
                                        <li>Engaging with interactive simulations and physical models.</li>
                                        <li>Using diagrams, flowcharts, and illustrative videos to understand
                                            complex concepts.</li>
                                        <li>Participating in workshops where they can physically manipulate relevant
                                            materials.</li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-top-content" @if($learningStyle['aural_score'] > 3.75)  style="padding: 12px 12px 12px 14px; background: #FFF6EA; margin-top: 24px;" @else style="margin-top: 25px;" @endif>
                                    <p class="left-table-head">AURAL<span>
                                            {{ $learningStyle['aural_percentage'] ?? 0 }}%</span></p>
                                    <p class="table-desc">
                                        {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'aural')->first()->analysis ?? ' ' }}
                                    </p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $learningStyle['aural_percentage'] ?? 0 }}%;"
                                        class="line line-orange @if($learningStyle['aural_score'] > 3.75) dark-orange @else fade-orange @endif"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $learningStyle['aural_percentage'] }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                                <div class="summary">
                                    <p class="summary-head">Examples:</p>
                                    <ul>
                                        <li>Benefiting from lectures, group discussions, and verbal briefings.</li>
                                        <li>Using podcasts and audio recordings for learning new content.</li>
                                        <li>Participating in study groups or team meetings where ideas are discussed
                                            aloud.</li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-top-content"
                                @if($learningStyle['reading_writing_score'] > 3.75)  style="padding: 12px 12px 12px 14px; background: #FFF6EA; margin-top: 24px;" @else style="margin-top: 25px;" @endif>
                                    <p class="left-table-head">Reading & Writing<span>
                                            {{ $learningStyle['reading_writing_percentage'] ?? 0 }}%</span>
                                    </p>
                                    <p class="table-desc">
                                        {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'reading-writing')->first()->analysis ?? ' ' }}
                                    </p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $learningStyle['reading_writing_percentage'] ?? 0 }}%;"
                                        class="line line-orange @if($learningStyle['reading_writing_score'] > 3.75) dark-orange @else fade-orange @endif"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $learningStyle['reading_writing_percentage'] }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                                <div class="summary">
                                    <p class="summary-head">Examples:</p>
                                    <ul style="border: none;">
                                        <li>Using textbooks, articles, and written handouts as primary study
                                            materials.</li>
                                        <li>Making comprehensive lists, writing out notes, and summarizing
                                            information</li>
                                        <li>Preferring email and text-based communication for clarity and
                                            record-keeping.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="right-table table-right-tweleve">
                            <div class="tweleve-inner">
                                <p class="tweleve-head">Development Plan</p>
                                <p class="tweleve-desc"><img src="admin/media/pdf/LearningIcon.svg" /> Learning Style
                                    Summary</p>
                                <p class="table-desc"
                                    style="
            font-size: 12px; line-height: 16px;
            ">
                                    @foreach ($learningStyle['learning_style_preference'] as $key => $learning_style_preference)
                                        {{ $learning_style_preference['learning_style_preference_summary'] ?? '' }}
                                        <br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 13 -->
    {{-- <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div class="left">Report Prepared for: <span>{{ $user->name ?? '' }}</span></div>
                    <div
                        @if (str_word_count($user->job_position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->job_position->title ?? '' }}</span></div>
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content">Cognitive Ability</p>
                <div class="thirteen-first">
                    <div>
                        <p class="thirteen-first-head">Overall Cognitive Ability</p>
                        <p class="thirteen-teal">
                            {{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}
                        </p>
                    </div>
                    <div class="thirteen-progress-section">
                        <div class="thirteen-inneer">
                            <p>Quantitative Knowledge
                                <span>{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}</span>
                            </p>
                            <div class="progress-container">
                                <div class="progress-fill">
                                    <div class="progress-segment segment-yellow"></div>
                                    <div class="progress-segment segment-orange"></div>
                                    <div class="progress-segment segment-blue"></div>
                                </div>
                                <div class="progress-circle"
                                    style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}, -50%);">
                                    <img src="admin/media/pdf/ProgressCircle.svg" alt="Progress Circle" />
                                </div>
                            </div>
                        </div>
                        <div class="thirteen-inneer">
                            <p>Comprehensive Knowledge
                                <span>{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}</span>
                            </p>
                            <div class="progress-container">
                                <div class="progress-fill">
                                    <div class="progress-segment segment-yellow"></div>
                                    <div class="progress-segment segment-orange"></div>
                                    <div class="progress-segment segment-blue"></div>
                                </div>
                                <div class="progress-circle"
                                    style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}, -50%);">
                                    <img src="admin/media/pdf/ProgressCircle.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="thirteen-inneer">
                            <p>Visual Reasoning
                                <span>{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}</span>
                            </p>
                            <div class="progress-container">
                                <div class="progress-fill">
                                    <div class="progress-segment segment-yellow"></div>
                                    <div class="progress-segment segment-orange"></div>
                                    <div class="progress-segment segment-blue"></div>
                                </div>
                                <div class="progress-circle"
                                    style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}, -50%);">
                                    <img src="admin/media/pdf/ProgressCircle.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="thirteen-inneer">
                            <p>Fluid Reasoning
                                <span>{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}</span>
                            </p>
                            <div class="progress-container">
                                <div class="progress-fill">
                                    <div class="progress-segment segment-yellow"></div>
                                    <div class="progress-segment segment-orange"></div>
                                    <div class="progress-segment segment-blue"></div>
                                </div>
                                <div class="progress-circle"
                                    style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}, -50%);">
                                    <img src="admin/media/pdf/ProgressCircle.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="thirteen-three">
                            <div style="display: table-row;">
                                <p class="three-low"><span></span>
                                <p style="margin: 0px 5px -4px 5px;">Low</p>
                                </p>
                                <p class="three-moderate"><span></span>
                                <p style="margin: 0px 5px -4px 5px;"> Moderate</p>
                                </p>
                                <p class="three-high"><span></span>
                                <p style="margin: 0px 5px -4px 5px;"> High</p>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="thirteen-second">
                    <div style="display: table-row;">
                        <div class="circle-high-low">
                            <p class="result-ciircle">Result:</p>
                            <div class="chart-container" style="width: 300px; height: 300px; margin: auto;">
                                <img src="{{ $chartUrl }}" alt="Cognitive Pie Chart"
                                    style="max-width: 100%; height: auto;">

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom-content">
                <div class="row">
                    <div class="left">{{ $reportDate ?? '' }}</div>
                    <div class="right bottom-p">© CXS Analytics <span class="page-number"></span></div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>

            <div class="skill-div">
                <p class="heading-content">Cognitive Ability</p>
                <div class="thirteen-first">
                    <p class="thirteen-first-head">Overall Cognitive Ability</p>
                    <p class="thirteen-teal"
                        style="color: {{ config('helpers.employee_detail_positive_3_text_color')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }} !important;">
                        {{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}
                    </p>
                </div>
                <div class="table-fifteen">
                    <div class="fifteent-inner-main">
                        <div class="fourteen-inner">
                            <div style="display: table-row; width: 100%;">
                                <div class="fourteen-left"
                                    style="display: table-cell; vertical-align: middle; width: 57%;">
                                    <div class="fifteen-top">
                                        <div style="display: table-row; width: 100%;">
                                            <p class="fifteen-top-p left-table-head">
                                                Quantitative Knowledge
                                            </p>
                                            <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                                The ability to reason numerical concepts and relationships, and to
                                                manipulate numerical symbols.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="progress-container">
                                        <div class="progress-fill">
                                            <div class="progress-segment segment-yellow"></div>
                                            <div class="progress-segment segment-orange"></div>
                                            <div class="progress-segment segment-blue"></div>
                                        </div>
                                        <div class="progress-circle"
                                            style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}, -50%);">
                                            {{-- <img src="admin/media/pdf/ProgressCircle.svg" alt="Progress Circle" /> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="fourteen-right"
                                    style="display: table-cell; vertical-align: middle; padding-left: 20px;">
                                    <p class="right-top-heading" style="color: #5B5B5B;">
                                        Level: <span
                                            class="{{ config('helpers.cognitive_ability_badges')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                        {!! nl2br(str_replace('.', '.<br>', $cognitiveDomainResult['quantitative-knowledge']['description'] ?? '0')) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="fourteen-inner">
                            <div style="display: table-row; width: 100%;">
                                <div class="fourteen-left"
                                    style="display: table-cell; vertical-align: middle; width: 57%;">
                                    <div class="fifteen-top">
                                        <div style="display: table-row; width: 100%;">
                                            <p class="fifteen-top-p left-table-head">
                                                Comprehensive Knowledge
                                            </p>
                                            <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                                A person's acquired knowledge as well as ability to communicate
                                                knowledge and ability to reason using previously learned experiences or
                                                procedures.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="progress-container">
                                        <div class="progress-fill">
                                            <div class="progress-segment segment-yellow"></div>
                                            <div class="progress-segment segment-orange"></div>
                                            <div class="progress-segment segment-blue"></div>
                                        </div>
                                        <div class="progress-circle"
                                            style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}, -50%);">
                                            {{-- <img src="admin/media/pdf/ProgressCircle.svg" /> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="fourteen-right"
                                    style="display: table-cell; vertical-align: middle; padding-left: 20px;">
                                    <p class="right-top-heading" style="color: #5B5B5B;">
                                        Level: <span
                                            class="{{ config('helpers.cognitive_ability_badges')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                        {!! nl2br(str_replace('.', '.<br>', $cognitiveDomainResult['comprehension-knowledge']['description'] ?? '0')) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="fourteen-inner">
                            <div style="display: table-row; width: 100%;">
                                <div class="fourteen-left"
                                    style="display: table-cell; vertical-align: middle; width: 57%;">
                                    <div class="fifteen-top">
                                        <div style="display: table-row; width: 100%;">
                                            <p class="fifteen-top-p left-table-head">
                                                Visual Reasoning
                                            </p>
                                            <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                                The ability to perceive, analyse and synthesize visual patterns, and to
                                                think with visual patterns, including the ability to store and recall
                                                visual representations.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="progress-container">
                                        <div class="progress-fill">
                                            <div class="progress-segment segment-yellow"></div>
                                            <div class="progress-segment segment-orange"></div>
                                            <div class="progress-segment segment-blue"></div>
                                        </div>
                                        <div class="progress-circle"
                                            style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}, -50%);">
                                            {{-- <img src="admin/media/pdf/ProgressCircle.svg" /> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="fourteen-right"
                                    style="display: table-cell; vertical-align: middle; padding-left: 20px;">
                                    <p class="right-top-heading" style="color: #5B5B5B;">
                                        Level: <span
                                            class="{{ config('helpers.cognitive_ability_badges')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                        {!! nl2br(str_replace('.', '.<br>', $cognitiveDomainResult['visual-reasoning']['description'] ?? '0')) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="fourteen-inner">
                            <div style="display: table-row; width: 100%;">
                                <div class="fourteen-left"
                                    style="display: table-cell; vertical-align: middle; width: 57%;">
                                    <div class="fifteen-top">
                                        <div style="display: table-row; width: 100%;">
                                            <p class="fifteen-top-p left-table-head">
                                                Fluid Reasoning
                                            </p>
                                            <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                                The ability to reason, form concepts, and solve problems using
                                                unfamiliar information or novel procedures.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="progress-container">
                                        <div class="progress-fill">
                                            <div class="progress-segment segment-yellow"></div>
                                            <div class="progress-segment segment-orange"></div>
                                            <div class="progress-segment segment-blue"></div>
                                        </div>
                                        <div class="progress-circle"
                                            style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}, -50%);">
                                            {{-- <img src="admin/media/pdf/ProgressCircle.svg" /> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="fourteen-right"
                                    style="display: table-cell; vertical-align: middle; padding-left: 20px;">
                                    <p class="right-top-heading" style="color: #5B5B5B;">
                                        Level: <span
                                            class="{{ config('helpers.cognitive_ability_badges')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                        {!! nl2br(str_replace('.', '.<br>', $cognitiveDomainResult['fluid-reasoning']['description'] ?? '0')) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-content">
            <div class="row">
                <div class="width-33">{{ $reportDate ?? '' }}</div>
                <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
            </div>
        </div>
    </div>
    </div>

    <!-- Frame 14 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>

            <div class="skill-div">
                <p class="heading-content">OCEAN Domain</p>
                <p class="heading-content-bot">Response Consistency Index: <span
                        style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span>
                </p>
                {{-- <div class="table-fourteen">
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <p class="fourteen-top"><span>Openness</span><span
                                        style="font-weight: 600; text-align: center;">Openness
                                        to
                                        Experience</span><span
                                        style="
                                        text-align: right;
                                                                ">Pragmatism</span>
                                </p>
                                <div class="line ocean-grey line-grey">
                                    <div style="width: {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%; justify-content: left;"
                                        class="line line-orange ocean-orange dark-orange">
                                        <p class="white-text">Openness
                                            {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%
                                        </p>
                                    </div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%; top: 9px;">
                                        <img src="admin/media/pdf/RoundIconOcean.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['openness-to-experience']['percentage_with_label'] ?? 0 }}<span>
                                        {{ config('helpers.ocean_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px;">
                                    {{ $oceanDomainResult['openness-to-experience']['description'] ?? 0 }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <p class="fourteen-top"><span>High Self Control</span><span
                                        style="
                                    font-weight: 600;
                                        text-align: center;

                                                            ">Conscientiousness</span><span
                                        style="
                                        text-align: right;
                                                                ">Low
                                        Self Control</span></p>
                                <div class="line ocean-grey line-grey">
                                    <div style="width: {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%; justify-content: left;"
                                        class="line line-orange ocean-orange dark-orange">
                                        <p class="white-text">High Self Control
                                            {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%</p>
                                    </div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%; top: 9px;">
                                        <img src="admin/media/pdf/RoundIconOcean.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['conscientiousness']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['conscientiousness']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['conscientiousness']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px;">
                                    {{ $oceanDomainResult['conscientiousness']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <p class="fourteen-top">
                                    <span>Extroversion</span><span
                                        style="
                                    font-weight: 600;
                                        text-align: center;

                                                            ">Extroversion</span><span
                                        style="
                                        text-align: right;
                                                                ">Introversion</span>
                                </p>
                                <div class="line ocean-grey line-grey">
                                    <div style="width: {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%; justify-content: left;"
                                        class="line line-orange ocean-orange fade-orange">
                                        <p class="white-text">Extroversion
                                            {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%</p>
                                    </div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%; top: 9px;">
                                        <img src="admin/media/pdf/RoundIconOcean.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['extraversion']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['extraversion']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['extraversion']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px;">
                                    {{ $oceanDomainResult['extraversion']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <p class="fourteen-top">
                                    <span>Agreeableness</span><span
                                        style="
                                    font-weight: 600;
                                        text-align: center;

                                                            ">Agreeableness</span><span
                                        style="
                                        text-align: right;
                                                                ">Independence</span>
                                </p>
                                <div class="line ocean-grey line-grey">
                                    <div style="width: {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%; justify-content: left;"
                                        class="line line-orange ocean-orange dark-orange">
                                        <p class="white-text">Agreeableness
                                            {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%</p>
                                    </div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%; top: 9px;">
                                        <img src="admin/media/pdf/RoundIconOcean.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['agreeableness']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['agreeableness']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['agreeableness']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px;">
                                    {{ $oceanDomainResult['agreeableness']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <p class="fourteen-top"><span>Low Anxiety</span><span
                                        style="
                                    font-weight: 600;
                                        text-align: center;

                                                            ">Emotional
                                        Stability</span><span
                                        style="
                                        text-align: right;
                                                                ">High
                                        Anxiety</span></p>
                                <div class="line ocean-grey line-grey">
                                    <div style="width: {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%; justify-content: left;"
                                        class="line line-orange ocean-orange fade-orange">
                                        <p class="white-text">Low Anxiety
                                            {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%</p>
                                    </div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%; top: 9px;">
                                        <img src="admin/media/pdf/RoundIconOcean.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['emotional-stability']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['emotional-stability']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['emotional-stability']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px;">
                                    {{ $oceanDomainResult['emotional-stability']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="fifteent-inner-main">
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <div class="fifteen-top">
                                    <div style="display: table-row; max-width: 100%;">
                                        <p class="fifteen-top-p left-table-head">
                                            Openness to Experience <span>
                                                {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                            Imaginative, curious, open-minded, and willing to try new things. They tend
                                            to have a wide range of interests and a vivid imagination.
                                        </p>
                                    </div>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['openness-to-experience']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                    {!! $oceanDomainResult['openness-to-experience']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="line-bottom"></div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <div class="fifteen-top">
                                    <div style="display: table-row; max-width: 100%;">
                                        <p class="fifteen-top-p left-table-head">
                                            Conscientiousness <span>
                                                {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 ?? 0 }}%</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                            Organized, dependable, and have a strong sense of duty. They are
                                            goal-oriented, disciplined, and prefer planned rather than spontaneous
                                            behavior.
                                        </p>
                                    </div>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['conscientiousness']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['conscientiousness']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['conscientiousness']['level'] ?? 0] }}</span>
                                </p>
                                 <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                    {!! $oceanDomainResult['conscientiousness']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="line-bottom"></div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <div class="fifteen-top">
                                    <div style="display: table-row; max-width: 100%;">
                                        <p class="fifteen-top-p left-table-head">
                                            Extroversion <span>
                                                {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                            Sociable, energetic, talkative, appeard to enjoy being around others. They
                                            are often perceived as outgoing and enthusiastic.
                                        </p>
                                    </div>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['extraversion']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['extraversion']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['extraversion']['level'] ?? 0] }}</span>
                                </p>
                                 <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                    {!! $oceanDomainResult['extraversion']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="line-bottom"></div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <div class="fifteen-top">
                                    <div style="display: table-row; max-width: 100%;">
                                        <p class="fifteen-top-p left-table-head">
                                            Agreeableness <span>
                                                {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 5px; ">
                                            Friendly, compassionate, cooperative, and eager to help others. They are
                                            often seen as trustworthy and good-natured.
                                        </p>
                                    </div>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['agreeableness']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['agreeableness']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['agreeableness']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                    {!! $oceanDomainResult['agreeableness']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="line-bottom"></div>
                    <div class="fourteen-inner">
                        <div style="display: table-row; max-width: 100%;">
                            <div class="fourteen-left">
                                <div class="fifteen-top">
                                    <div style="display: table-row; max-width: 100%;">
                                        <p class="fifteen-top-p left-table-head">
                                            Emotional Stability <span>
                                                {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%</span>
                                        </p>
                                        <p class="fourteen-right-desc"
                                                        style="font-size: 13px; margin-top: 5px; ">
                                                Calm, emotionally stable, and less likely to experience negative
                                                emotions.They maintain a steady, calm demeanor, handling challenges with
                                                ease and are less affected by stress.
                                        </p>
                                    </div>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon"
                                        style="right: {{ 100 - 2 - $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%; top: 5px;">
                                        <img src="admin/media/pdf/RoundIcon.svg" />
                                    </div>
                                </div>
                            </div>
                            <div class="fourteen-right">
                                <p
                                    class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['emotional-stability']['level'] ?? 0] }} right-top-heading">
                                    {{ $oceanDomainResult['emotional-stability']['percentage_with_label'] ?? 0 }}<span>{{ config('helpers.ocean_levels')[$oceanDomainResult['emotional-stability']['level'] ?? 0] }}</span>
                                </p>
                                <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                    {!! $oceanDomainResult['emotional-stability']['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="tweleve-inner" style="margin-top: 50px;">
                    <p class="tweleve-head"><img src="admin/media/pdf/LearningIcon.svg" /> OCEAN Summary</p>
                    <p class="table-desc ocean-summary-description" style="font-size: {{ $oceanSummaryFontSize }}px !important; line-height: 1.2;">
                        {{ $oceanSummary ?? '' }}
                    </p>
                </div>
            </div>


            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 15 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>

            <div class="skill-div">
                <p class="heading-content">30 Facets</p>
                <div class="table-fifteen">
                    <p class="heading-content" style="font-size: 18px;">Openness to Experience</p>
                    <p class="heading-content-bot" style="font-size: 14px;">Response Consistency Index: <span
                            style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span>
                    </p>
                    <div class="fifteent-inner-main">
                        @foreach ($oceanAllFacetsResult->whereIn('slug', ['daydreaming', 'aesthetic-appreciation', 'feeling-aware', 'explorer', 'innovation', 'open-mindedness']) as $name => $result)
                            <div class="fourteen-inner fifteen-left">
                                <div style="display: table-row; max-width: 100%;">
                                    <div class="fourteen-left">
                                        <div class="fifteen-top">
                                            <div style="display: table-row; max-width: 100%;">
                                                <p class="fifteen-top-p left-table-head">
                                                    {{ $result['name'] ?? '' }} <span>
                                                        {{ $result['score_percentage'] ?? 0 }}% </span>
                                                </p>
                                                <p class="fourteen-right-desc"
                                                    style="font-size: 13px; margin-top: 5px; ">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: {{ $result['score_percentage'] ?? 0 }}%;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon"
                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%; top: 5px;">
                                                <img src="admin/media/pdf/RoundIcon.svg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fourteen-right">
                                        <p
                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                            {{ $result['percentage_with_label'] }}<span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                            {!! $result['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 16 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>

            <div class="skill-div">
                <p class="heading-content">30 Facets</p>
                <div class="table-fifteen">
                    <p class="heading-content" style="font-size: 18px;">Conscientiousness</p>
                    <p class="heading-content-bot" style="font-size: 14px;">Response Consistency Index: <span
                            style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span>
                    </p>
                    <div class="fifteent-inner-main">
                        @foreach ($oceanAllFacetsResult->whereIn('slug', ['self-confidence', 'tidiness', 'responsibility', 'drive-to-achieve', 'willpower', 'careful-thinking']) as $name => $result)
                            <div class="fourteen-inner fifteen-left">
                                <div style="display: table-row; max-width: 100%;">
                                    <div class="fourteen-left">
                                        <div class="fifteen-top">
                                            <div style="display: table-row; max-width: 100%;">
                                                <p class="fifteen-top-p left-table-head">
                                                    {{ $result['name'] ?? '' }} <span>
                                                        {{ $result['score_percentage'] ?? 0 }}% </span>
                                                </p>
                                                <p class="fourteen-right-desc"
                                                    style="font-size: 13px; margin-top: 5px; ">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                                {{-- <p>
                                                  {{ config('helpers.ocean_all_facets_mapping')[$name]['name'] }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', config('helpers.ocean_all_facets_mapping')[$name]['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p>
                                              <p style="text-align: right;">
                                                  {{ $result['name'] ?? '' }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p> --}}
                                            </div>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: {{ $result['score_percentage'] ?? 0 }}%;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon"
                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%; top: 5px;">
                                                <img src="admin/media/pdf/RoundIcon.svg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fourteen-right">
                                        <p
                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                            {{ $result['percentage_with_label'] }}<span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                            {!! $result['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 17 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>

            <div class="skill-div">
                <p class="heading-content">30 Facets</p>
                <div class="table-fifteen">
                    <p class="heading-content" style="font-size: 18px;">Extraversion</p>
                    <p class="heading-content-bot" style="font-size: 14px;">Response Consistency Index: <span
                            style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span>
                    </p>
                    <div class="fifteent-inner-main">
                        @foreach ($oceanAllFacetsResult->whereIn('slug', ['sociability', 'crowd-enjoyment', 'confidence', 'energetic-lifestyle', 'thrill-seeking', 'optimism']) as $name => $result)
                            <div class="fourteen-inner fifteen-left">
                                <div style="display: table-row; max-width: 100%;">
                                    <div class="fourteen-left">
                                        <div class="fifteen-top">
                                            <div style="display: table-row; max-width: 100%;">
                                                <p class="fifteen-top-p left-table-head">
                                                    {{ $result['name'] ?? '' }} <span>
                                                        {{ $result['score_percentage'] ?? 0 }}% </span>
                                                </p>
                                                <p class="fourteen-right-desc"
                                                    style="font-size: 13px; margin-top: 5px; ">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                                {{-- <p>
                                                  {{ config('helpers.ocean_all_facets_mapping')[$name]['name'] }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', config('helpers.ocean_all_facets_mapping')[$name]['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p>
                                              <p style="text-align: right;">
                                                  {{ $result['name'] ?? '' }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p> --}}
                                            </div>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: {{ $result['score_percentage'] ?? 0 }}%;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon"
                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%; top: 5px;">
                                                <img src="admin/media/pdf/RoundIcon.svg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fourteen-right">
                                        <p
                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                            {{ $result['percentage_with_label'] }}<span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                            {!! $result['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 18 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>

            <div class="skill-div">
                <p class="heading-content">30 Facets</p>
                <div class="table-fifteen">
                    <p class="heading-content" style="font-size: 18px;">Agreeableness</p>
                    <p class="heading-content-bot" style="font-size: 14px;">Response Consistency Index: <span
                            style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span>
                    </p>
                    <div class="fifteent-inner-main">
                        @foreach ($oceanAllFacetsResult->whereIn('slug', ['belief', 'honesty', 'helpfulness', 'diplomacy', 'humility', 'compassion']) as $name => $result)
                            <div class="fourteen-inner fifteen-left">
                                <div style="display: table-row; max-width: 100%;">
                                    <div class="fourteen-left">
                                        <div class="fifteen-top">
                                            <div style="display: table-row; max-width: 100%;">
                                                <p class="fifteen-top-p left-table-head">
                                                    {{ $result['name'] ?? '' }} <span>
                                                        {{ $result['score_percentage'] ?? 0 }}% </span>
                                                </p>
                                                <p class="fourteen-right-desc"
                                                    style="font-size: 13px; margin-top: 5px; ">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                                {{-- <p>
                                                  {{ config('helpers.ocean_all_facets_mapping')[$name]['name'] }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', config('helpers.ocean_all_facets_mapping')[$name]['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p>
                                              <p style="text-align: right;">
                                                  {{ $result['name'] ?? '' }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p> --}}
                                            </div>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: {{ $result['score_percentage'] ?? 0 }}%;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon"
                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%; top: 5px;">
                                                <img src="admin/media/pdf/RoundIcon.svg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fourteen-right">
                                        <p
                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                            {{ $result['percentage_with_label'] }}<span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                            {!! $result['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 19 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content">30 Facets</p>
                <div class="table-fifteen">
                    <p class="heading-content" style="font-size: 18px;">Emotional Stability</p>
                    <p class="heading-content-bot" style="font-size: 14px;">Response Consistency Index: <span
                            style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level']] }};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span>
                    </p>
                    <div class="fifteent-inner-main">
                        @foreach ($oceanAllFacetsResult->whereIn('slug', ['steadiness', 'tolerance', 'positivity', 'social-sensitivity', 'impulse-control', 'stress-response']) as $name => $result)
                            <div class="fourteen-inner fifteen-left">
                                <div style="display: table-row; max-width: 100%;">
                                    <div class="fourteen-left">
                                        <div class="fifteen-top">
                                            <div style="display: table-row; max-width: 100%;">
                                                <p class="fifteen-top-p left-table-head">
                                                    {{ $result['name'] ?? '' }} <span>
                                                        {{ $result['score_percentage'] ?? 0 }}% </span>
                                                </p>
                                                <p class="fourteen-right-desc"
                                                    style="font-size: 13px; margin-top: 5px; ">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                                {{-- <p>
                                                  {{ config('helpers.ocean_all_facets_mapping')[$name]['name'] }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', config('helpers.ocean_all_facets_mapping')[$name]['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p>
                                              <p style="text-align: right;">
                                                  {{ $result['name'] ?? '' }}
                                                  <span>
                                                      {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                  </span>
                                              </p> --}}
                                            </div>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: {{ $result['score_percentage'] ?? 0 }}%;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon"
                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%; top: 5px;">
                                                <img src="admin/media/pdf/RoundIcon.svg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fourteen-right">
                                        <p
                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }} right-top-heading">
                                            {{ $result['percentage_with_label'] }}<span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                        </p>
                                        <p class="fourteen-right-desc" style="font-size: 13px; margin-top: 10px; ">
                                            {!! $result['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 20 -->
    <div class="pdf-page">
        <div class="pdf-background">
            <div class="top-head">
                <div class="row">
                    <div>Report Prepared for: <span>{{ $user->name ?? '' }}</span> |
                        <span>{{ $user->job_position->title ?? '' }}</span>
                    </div>
                    {{-- <div
                        @if (str_word_count($user->position->title ?? '') > 3) class="right-big-text" @else class="right-small-text" @endif>
                        Job Position: <span>{{ $user->position->title ?? '' }}</span></div> --}}
                </div>
            </div>
            <div class="skill-div">
                <p class="heading-content">Work Interest</p>
                <p class="heading-content" style="font-size: 12px; margin-top: 10px;"><img src="admin/media/svg/org-chart-svg/line-three.svg" alt="line"> Job Position's Top 3 RIASEC</p>
            </div>
            <div class="skill-table" style="margin-top: 26px; width: auto;">
                <div class="inner-table">
                    <div style="display: table-row; max-width: 100%;">
                        <div class="work-table-left">
                            @foreach ($riasecDomainResult as $slug => $result)
                                <div>
                                    <div class="table-top-content" style=" margin-top: 28px;"
                                        @if (in_array($result['code'], $riasecTop3Result['job_top_3_riasec_array'])) style="padding: 12px 12px 12px 14px; background: #FFF6EA; margin-top: 28px;" @endif>
                                        <p class="left-table-head" style="font-size: 18px;">
                                            {{ $result['name'] }}<span> {{ $result['score'] }}%</span></p>
                                        <p class="table-desc">
                                            {!! $result['description'] ?? '' !!}
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: {{ $result['score'] }}%;"
                                            class="line line-orange @if (in_array($result['code'], $riasecTop3Result['job_top_3_riasec_array'])) dark-orange @else fade-orange @endif">
                                        </div>
                                        <div class="svg-round-icon"
                                            style="right: {{ 100 - 2 - $result['score'] }}%; top: 5px;">
                                            <img src="admin/media/pdf/RoundIcon.svg" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="right-table table-right-tweleve">
                            {{-- <div class="work-right-inner" style="margin-bottom: 30px;">
                                <p class="work-right-head">Job Position's Top 3 RIASEC</p>
                                <p class="work-orange">{{ $riasecTop3Result['string'] ?? '' }}</p>
                                <p class="table-desc">
                                    {!! $riasecTop3Result['description'] ?? '' !!}
                                </p>
                            </div> --}}
                            <div class="work-right-inner">
                                <p class="work-right-head">Employee's Top 3 RIASEC</p>
                                <p class="work-orange">{{ $riasecTop3Result['string'] ?? '' }}</p>
                                <p class="table-desc">
                                    {!! $riasecTop3Result['description'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="row">
                    <div class="width-33">{{ $reportDate ?? '' }}</div>
                    <div class="width-33" style="left: 48%;"><span class="page-number"></span></div>
                    <div class="right width-33" style="left: 76%;">© CXS Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Frame 21 -->
    <div class="pdf-page">
        <div class="contact-frame pdf-background">
            <div class="contact-content">
                <p class="contact-head">Contact Us</p>
                <div class="contact-inner">
                    <p>A-37-7 & 8, Menara UOA Bangsar,<br />
                        No.5, Jalan Bangsar Utama 1,<br />
                        59000 Kuala Lumpur.</p>
                    <p>+03-50324926</p>
                    <p>info@cxsanalytics.com</p>
                    <p>© CXS Analytics. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        // Predefined list of headings with their corresponding numbers
        const headingNumbers = {
            "Why are Allstar Values important?": "03",
            "Allstar Values": "04",
            "Assessment Report": "07",
            "Assessment Report Analysis": "08",
            "Critical Core Skills": "11",
            "Learning Style": "16",
            "Cognitive Ability": "17",
            "OCEAN Domain": "18",
            "30 Facets": "19",
            "RIASEC (Work Interest)": "24"
        };

        // Find the current heading
        const headingElement = document.querySelector(".heading-content");
        const headingText = headingElement ? headingElement.textContent.trim() : "";

        // Get the corresponding number
        const pageNumber = headingNumbers[headingText] || "XX"; // Default to "XX" if not found

        // Update the page number in the bottom content
        const pageNumberElement = document.querySelector(".page-number");
        if (pageNumberElement) {
            pageNumberElement.textContent = pageNumber;
        }
    </script> --}}

    <script type="text/php">
        if ( isset($pdf) ) { 
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Helvetica", "normal");
                    $size = 8;
                    $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 820;
                    $x = 250;
                    $pdf->text($x, $y, $pageText, $font, $size);
                } 
            ');
        }
        </script>
    

</body>

</html>
