<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Map Overview</title>
    <style>
         html, body {
            height: 100%; 
            margin: 0;    
            padding: 0;   
            box-sizing: border-box; 
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-wrap: wrap;
        }

        .career-map-container {
            flex: 1;
            display: flex;
            justify-content: space-between; 
            align-items: flex-start; 
            width: fit-content; 
            border-radius: 12px;
            padding: 48px;
            overflow-x: auto;
            overflow-y: auto; 
            height: calc(100vh - 92px); 
            box-sizing: border-box;
            gap: 80px;
            height: calc(100vh - 92px); 
            box-sizing: border-box;
            gap: 80px;
            max-width: 100%;
        }

        .career-map {
            display: grid;
            grid-template-columns: repeat(39, 1fr);
            gap: 12px 24px;
            min-width: 3500px;
            padding: 0px 24px 12px 24px;
        }

        .match-rate-container {
            width: 300px;
            height: 100px;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            color: #fff;
            border-radius: 5px;
        }

        .career-map-cell {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 0.9rem;
            font-weight: 500;
            border: 2px solid #ddd;
            white-space: normal; 
            position: relative; 
            z-index: 10;
        }
        
        .career-map-cell-invisible {
            display: none; 
            visibility: hidden;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 8px;
            background-color: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 0.9rem;
            font-weight: 500;
            border: 2px solid #ddd;
            white-space: normal;
        }

        .arrow-cell {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0; 
            margin: 0;
            border-radius: 0; 
            font-size: 0.9rem;
            font-weight: 500;
            white-space: normal;
            box-sizing: border-box; 
        }

        .arrow-cell-invisible {
            display: none;
            visibility: hidden;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0; 
            margin: 0;
            border-radius: 0; 
            font-size: 0.9rem;
            font-weight: 500;
            white-space: normal;
            box-sizing: border-box; 
        }

        .box-president-bottom {
            color: #757575;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            line-height: 18px;
            letter-spacing: 0.5px;
        }

        .career-map-nogap {
            display: grid;
            row-gap: 0;
            column-gap: 40px;
            grid-template-columns: repeat(39, 1fr); 
            min-width: 3500px;
            padding: 40px;
        }

        .header {
            background-color: #5A5A5A;
            color: #F3F3F3;
            border-radius: 8px;
            text-transform: uppercase;
            box-shadow: 0px 25px 100px 0px #0C0C0D05;
            text-align: center;
            font-size: 18px;
            font-weight: 500;
            line-height: 18px;
            font-variant: all-small-caps;
            letter-spacing: 0.5px;
        }

        .career-map-top {
            grid-column: span 39;
            padding: 20px;
            border-radius: 8px;
            background-color: #333;
            font-size: 16px;
            margin-top: 24px;
            text-align: center;
            border-radius: 8px;
            background: #5A5A5A;
            box-shadow: 0px 25px 100px 0px #0C0C0D05;
            color: #F3F3F3;
            font-weight: 500;
            line-height: 16px;
            font-variant: all-small-caps;
            letter-spacing: 0.5px;  
        }

        .vice-map-cell {
            padding: 28px 12px;
            color: #757575;
        }
        .arrow-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            margin-bottom: 20px;
        }
        .career-map-cell:hover {
            background-color: #5A5A5A; 
            color: #fff;
            transform: scale(1.05); 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            transition: all 0.3s ease-in-out; 
            cursor: pointer; 
        }

        .career-map-cell.highlighted {
            border: 2px solid #000000;
            background-color: #fff;
            border: 2px solid #000000;
            background-color: #fff;
            color: black;
        }

        .career-map-cell.highlighted-red {
            border: 5px solid rgba(255, 224, 221, 1);
            color: black;
        }

        .career-map-cell.highlighted-orange {
            border: 5px solid rgba(255, 235, 180, 1);
            color: black;
        }
        .career-map-cell.highlighted-green {
            border: 5px solid rgba(187, 236, 197, 1);
            color: black;
        }
        
        .career-map-cell.highlighted-red:hover,
        .career-map-cell.highlighted-orange:hover,
        .career-map-cell.highlighted-green:hover {
            color:white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            opacity: 0; 
            transition: opacity 0.3s ease-in-out; 
        }

        
        .modal.show {
            display: block;  /* Ensure the modal is shown when it has the 'show' class */
            opacity: 1;      /* Make it fully visible */
        }
        .modal-content {
            position: absolute;
            margin-top:300px;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            width: 60%;
            max-width: 600px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            max-height: 70vh;
            z-index: 1051;  /* Ensure content is above backdrop */
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            font-size: 1.2rem; 
        }
        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        .modal-header .close {
            font-size: 1.2rem; 
            color: #aaa;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .modal-header .close:hover {
            color: #000;
        }
        .modal-body {
            margin-top: 10px;
            padding: 10px 0;
            font-size: 0.95rem; 
            line-height: 1.5;
        }
        .skill-badge {
            background-color: #feeed3;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
        }
        .skill-button {
            color: #007BFF;
            cursor: pointer;
            text-decoration: underline;
            margin-top: 8px;
            display: inline-block;
        }
        .skill-button:hover {
            text-decoration: none;
        }
        .skill-badge {
            background: #feeed3;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
        }
        .skill-button {
            background: #feeed3;
            border: 1px solid #ddd;
            border-radius: 16px;
            padding: 8px 12px;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            color: #007BFF;
            text-decoration: none;
            gap: 5px;
        }
        .skill-button:hover {
            background: #f0f0f0;
        }
        .skill-button-container{
            padding: 3px;
        }
        .highlighted-cell {
            border: 2px solid orange;
        }
        .highlighted-arrow path {
            fill: orange;
        }
        .map-box {
            flex: 1;                      
        }

        .column-grid {
            display: flex;
            flex-direction: column; 
            grid-gap: 10px;
            padding: 10px;
        }
        .row-grid-twin{
            display: flex;
            justify-content: space-around;
            grid-template-columns: repeat(4, 2fr); 
            grid-gap: 10px;
            padding: 10px;
            height: auto;
        }
        .row-grid{
            display: flex;
            flex-direction: column; 
            width: 100%;
            grid-gap: 10px;
            padding: 10px;
        }
        .box-president-bottom{
            height: 100px;
        }

        /* Responsive Styles */           
        @media (max-width: 968px) {

            .career-map-container{
            }
            .modal-content {
                width: 90%; 
                max-height: 80vh; 
            }

            .modal-header h2 {
                font-size: 1.4rem; 
            }
        }

        @media (max-width: 480px) {
            .career-map-container{
            }
            .modal-content {
                width: 95%; 
                max-height: 85vh; 
            }

            .modal-header h2 {
                font-size: 1.2rem;
            }

            .modal-body {
                font-size: 0.85rem; 
            }
        }

        @media (max-width: 768px) {
            .career-map-container{
            }

            .career-map-cell {
                font-size: 1rem;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .career-map-container{
            }
            .career-map-cell {
                font-size: 0.9rem;
                padding: 10px;
            }
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Career Map Container -->
    {{-- First CAREER MAP --}}
    <div class="map-box" style="background-color: #FFFBEB;">
            <div class="career-map">
                <!-- Top Title -->
                <div class="career-map-top">AIRPORT GROUND HANDLING</div>
                <div class="career-map-cell header" style="grid-column: span 2; background-color:#d75987">
                    Admin
                </div>
                <div class="career-map-cell header" style="grid-column: span 8; background-color:#d79859">
                    Delivery
                </div>
                <div class="career-map-cell header" style="grid-column: span 9; background-color:#d7c259;">
                    Dispatch
                </div>
                <div class="career-map-cell header" style="grid-column: span 8; background-color:#b5d759;">
                    Planning
                </div>
                <div class="career-map-cell header" style="grid-column: span 4; background-color:#d75987">
                    Admin
                </div>
                <div class="career-map-cell header" style="grid-column: span 6; background-color:#59d7b3;">
                    Training
                </div>
                <div class="career-map-cell header" style="grid-column: span 2; background-color:#7d59d7;">
                    Turnaround
                </div>
            </div>

            <div class="career-map" style="padding-bottom:2%;">

                <!-- Vice President Row -->

                <div class="career-map-cell vice-map-cell" style="grid-column: span 39; text-align: center;" data-title="Group Head of Network Management Center" onclick="openJobDetails(this)">

                    <div>Group Head of Network Management Centre</div><br><br>

                </div>



                <!-- Admin -->

                <div class="column-grid" style="grid-column: span 2;">

                    <div class="arrow-cell" style="grid-column: span 2;">

                        <svg width="20" height="680" viewBox="0 0 12 680" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 670L0.226497 680L11.7735 680L7 670L5 670ZM6 0L0.226496 10L11.7735 10L6 0ZM7 670L7 10L5 10L5 670L7 670Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Executive, Network Management Center Admin" onclick="openJobDetails(this)">NMC Admin (Level 1)</div>

                </div>

                <!-- Delivery -->

                <div class="column-grid" style="grid-column: span 8;">

                    <div class="arrow-cell">

                        <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Head of Ops Delivery" onclick="openJobDetails(this)">Head of Ops Delivery (Level 4)</div>

                    <div class="row-grid-twin">

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Crewing Manager" onclick="openJobDetails(this)">Crewing Manager<br>(Level 3)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 230Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Executive (Flight Operations)" onclick="openJobDetails(this)">Duty Manager (Flight Operations) (Level 3)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 230Z" fill="#D9D9D9" />

                                </svg>

                            </div>



                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Manager, Operation Control Center" onclick="openJobDetails(this)">MAA OCC Manager<br>(Level 3)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 230Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Senior Officer (Flight Control) / Senior Officer (Crew Scheduling)" onclick="openJobDetails(this)">Duty Manager (Crew Scheduling) (Level 3)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 230Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                        </div>

                    </div>

                    <div class="row-grid-twin">

                        <div class="row-grid">

                            <div class="career-map-cell box-president-bottom" data-title="Crew Controller" onclick="openJobDetails(this)"  id="clicked-highlight-green" match-rate="86" >Crew Controller (Level 1)</div>

                        </div>

                        <div class="row-grid">

                            <div class="career-map-cell box-president-bottom" data-title="Fleet Controller" onclick="openJobDetails(this)">Fleet Controller (Level 1)</div>

                        </div>

                    </div>

                </div>



                <div class="column-grid" style="grid-column: span 1; position: relative; height: 89%;">

                    <div class="arrow-cell" style="position: absolute; bottom: 0; width: 100%; display: flex; justify-content: center;">

                        <svg width="60" height="20" viewBox="0 0 60 12" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <!-- Left Arrowhead -->

                            <path d="M0 5L10 0.226497L10 11.7735L0 7L0 5Z" fill="#D9D9D9" />



                            <!-- Right Arrowhead -->

                            <path d="M60 6L50 0.226497L50 11.7735L60 6Z" fill="#D9D9D9" />

                            <!-- Middle Line -->

                            <path d="M10 7H50V5H10V7Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                </div>

                <!-- Dispatch -->

                <div class="column-grid" style="grid-column: span 8;">

                    <div class="arrow-cell">

                        <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Head of Dispatch & Ops Projects" onclick="openJobDetails(this)">Head of Dispatch & Ops Projects</div>

                    <div class="row-grid-twin">

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="270" viewBox="0 0 12 270" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 260L0.226497 270L11.7735 270L7 260L5 260ZM6 0L0.226496 10L11.7735 10L6 0ZM7 260L7 10L5 10L5 260L7 230Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Senior Flight Dispatcher" onclick="openJobDetails(this)">Senior Flight Dispatcher (Level 2)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="85" viewBox="0 0 12 85" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 75L0.226497 85L11.7735 85L7 75L5 75ZM6 0L0.226496 10L11.7735 10L6 0ZM7 75L7 10L5 10L5 75L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Flight Dispatcher" onclick="openJobDetails(this)">Flight Dispatcher (Level 1)</div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Manager, Charter & Ops Planning" onclick="openJobDetails(this)">Charter and Ops Planning Manager <br> (Level 3)</div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Navigation Support" onclick="openJobDetails(this)" id="relevant-highlight-red">Navigation Support Manager <br> (Level 3)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="90" viewBox="0 0 12 90" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 80L0.226497 90L11.7735 90L7 80L5 80ZM6 0L0.226496 10L11.7735 10L6 0ZM7 80L7 10L5 10L5 80L7 80Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Senior Navigation Support" onclick="openJobDetails(this)">Senior Navigation Controller (Level 2)</div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Manager, Regional Dispatch Training" onclick="openJobDetails(this)">Regional Dispatch Training Manager <br> (Level 3)</div>

                        </div>

                    </div>

                </div>



                <!-- Planning -->

                <div class="column-grid" style="grid-column: span 2;">

                    <div class="arrow-cell">

                        <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 250Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Manpower Planning Manager" onclick="openJobDetails(this)" id="relevant-highlight-red" match-rate="48">Manpower Planning Manager <br>(Level 3)</div>

                    <div class="arrow-cell">

                        <svg width="20" height="290" viewBox="0 0 12 290" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 280L0.226497 290L11.7735 290L7 280L5 280ZM6 0L0.226496 10L11.7735 10L6 0ZM7 280L7 10L5 10L5 280L7 280Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="HR Business Partner / HR Manager" onclick="openJobDetails(this)">Operation Analyst<br>(Level 1)</div>

                </div>

                <div class="column-grid" style="grid-column: span 2;">

                    <div class="arrow-cell">

                        <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 250Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Manager, Forecasting & Insight" onclick="openJobDetails(this)">Manager, Forecasting & Insights<br>(Level 3)</div>

                    <div class="arrow-cell">

                        <svg width="20" height="290" viewBox="0 0 12 290" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 280L0.226497 290L11.7735 290L7 280L5 280ZM6 0L0.226496 10L11.7735 10L6 0ZM7 280L7 10L5 10L5 280L7 280Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Specialist, OPS System Support" onclick="openJobDetails(this)">Ops System Support<br>(Level 1)</div>

                </div>

                <div class="column-grid" style="grid-column: span 4;">

                    <div class="arrow-cell">

                        <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 250Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" data-title="Manager Rostering & Adv Crewing" onclick="openJobDetails(this)" id="clicked-highlight-orange" match-rate="63">Manager Rostering & Advance Crewing <br>(Level 3)</div>

                    <div class="row-grid-twin">

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="90" viewBox="0 0 12 90" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 80L0.226497 90L11.7735 90L7 80L5 80ZM6 0L0.226496 10L11.7735 10L6 0ZM7 80L7 10L5 10L5 80L7 80Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Rostering Planning Supervisor" onclick="openJobDetails(this)" id="clicked-highlight-orange-1" match-rate="76">Roster Planning Supervisor<br>(Level 2)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Rostering Planner" onclick="openJobDetails(this)" id="clicked-highlight-green-1" match-rate="93">Roster Planner<br>(Level 1)</div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="90" viewBox="0 0 12 90" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 80L0.226497 90L11.7735 90L7 80L5 80ZM6 0L0.226496 10L11.7735 10L6 0ZM7 80L7 10L5 10L5 80L7 80Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Advance Crewing Supervisor" onclick="openJobDetails(this)">Advance Crewing Supervisor<br>(Level 2)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Advance Crew Controller" onclick="openJobDetails(this)">Advance Crew Controllers<br>(Level 1)</div>

                        </div>

                    </div>

                </div>



                <!-- Admin -->

                <div class="column-grid" style="grid-column: span 4;">

                    <div class="arrow-cell">

                        <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 250Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" data-title="Implementation Manager" onclick="openJobDetails(this)" id="relevant-highlight-orange" match-rate="57">Implementation Manager<br>(Level 3)</div>

                    <div class="row-grid-twin">

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="265" viewBox="0 0 12 265" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 255L0.226497 265L11.7735 265L7 255L5 255ZM6 0L0.226496 10L11.7735 10L6 0ZM7 255L7 10L5 10L5 255L7 230Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="VR Admin" onclick="openJobDetails(this)">VR Admin<br>(Level 1)</div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="265" viewBox="0 0 12 265" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 255L0.226497 265L11.7735 265L7 255L5 255ZM6 0L0.226496 10L11.7735 10L6 0ZM7 255L7 10L5 10L5 255L7 230Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="AIMS System Support" onclick="openJobDetails(this)" id="relevant-highlight-green" match-rate="82">AIMS System Support<br>(Level 1)</div>

                        </div>

                    </div>

                </div>

                <!-- Training -->

                <div class="column-grid" style="grid-column: span 4;">

                    <div class="arrow-cell">

                        <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 250Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" data-title="Manager Training Planning & Disruption" onclick="openJobDetails(this)" id="relevant-highlight-orange" match-rate="60">Manager, Training Planning & Disruption<br>(Level 3)</div>

                    <div class="row-grid-twin">

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="90" viewBox="0 0 12 90" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 80L0.226497 90L11.7735 90L7 80L5 80ZM6 0L0.226496 10L11.7735 10L6 0ZM7 80L7 10L5 10L5 80L7 80Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Training Planning Supervisor" onclick="openJobDetails(this)">Training Planning Supervisor<br>(Level 2)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Training Planner" onclick="openJobDetails(this)"> Training Planners<br>(Level 1)</div>

                        </div>

                        <div class="row-grid">

                            <div class="arrow-cell">

                                <svg width="20" height="90" viewBox="0 0 12 90" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 80L0.226497 90L11.7735 90L7 80L5 80ZM6 0L0.226496 10L11.7735 10L6 0ZM7 80L7 10L5 10L5 80L7 80Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Training Disruption Supervisor" onclick="openJobDetails(this)">Training Disruption Supervisor<br>(Level 2)</div>

                            <div class="arrow-cell">

                                <svg width="20" height="60" viewBox="0 0 12 60" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M5 50L0.226497 60L11.7735 60L7 50L5 50ZM6 0L0.226496 10L11.7735 10L6 0ZM7 50L7 10L5 10L5 50L7 50Z" fill="#D9D9D9" />

                                </svg>

                            </div>

                            <div class="career-map-cell box-president-bottom" data-title="Training Disruption Planner" onclick="openJobDetails(this)"> Training Disruption Planners<br>(Level 1)</div>

                        </div>

                    </div>

                </div>

                <div class="column-grid" style="grid-column: span 2;">

                    <div class="arrow-cell">

                        <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 250Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Manager, Training & Quality Assurance" onclick="openJobDetails(this)">Manager Training & QA<br>(Level 3)</div>

                </div>

                <!-- Turnaround -->

                <div class="column-grid" style="grid-column: span 2;">

                    <div class="arrow-cell">

                        <svg width="20" height="260" viewBox="0 0 12 260" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 250L0.226497 260L11.7735 260L7 250L5 250ZM6 0L0.226496 10L11.7735 10L6 0ZM7 250L7 10L5 10L5 250L7 250Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2;" data-title="Manager - TOC & OTP" onclick="openJobDetails(this)">TOC & OTP Manager<br>(Level 3)</div>

                    <div class="arrow-cell">

                        <svg width="20" height="290" viewBox="0 0 12 290" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M5 280L0.226497 290L11.7735 290L7 280L5 280ZM6 0L0.226496 10L11.7735 10L6 0ZM7 280L7 10L5 10L5 280L7 230Z" fill="#D9D9D9" />

                        </svg>

                    </div>

                    <div class="career-map-cell box-president-bottom" style="grid-column: span 2; color:red;" data-title="Turnaround Coordinator" onclick="openJobDetails(this)" id="default-highlight-red" match-rate="65">Turn Around Coordinator<br>(Level 1)</div>

                </div>

            </div>

        </div>
    </div>

    <!-- Modal Structure -->
    <div id="myModal" class="modal" style="display: none; opacity: 0;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="flex-shrink: 0;">
                <div class="d-flex flex-column align-items-start gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 512 512">
                            <path fill="#F9A845" d="M450 128a46 46 0 0 0-44.11 59l-71.37 71.36a45.88 45.88 0 0 0-29 0l-52.91-52.91a46 46 0 1 0-89.12 0L75 293.88A46.08 46.08 0 1 0 106.11 325l87.37-87.36a45.85 45.85 0 0 0 29 0l52.92 52.92a46 46 0 1 0 89.12 0L437 218.12A46 46 0 1 0 450 128" />
                        </svg>
                        <h3 id="data-title" style="margin: 0; padding-right:10px; color:#F9A845;"></h3>
                    </div>
                </div>
                <span class="close" style="padding: 8px; border: 0.5px solid gainsboro; border-radius: 100%; width: 30px; text-align: center;">&times;</span>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="flex-grow: 1; overflow-y: auto; padding: 20px;">
                <!-- Match Rate Span -->
                <span id="match-rate" class="badge text-dark custom-badge" style="background-color:#dcdcdc;">% Match</span>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div>
                        <div style="display: flex; justify-content: flex-start; align-items: center; gap: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.5" />
                                <path fill="currentColor" d="M13 7a1 1 0 0 0-2 0v3.268l-1.098-.634a1 1 0 0 0-1 1.732l2.598 1.5A1.014 1.014 0 0 0 13 12Z" />
                            </svg>
                            <p>Time to Achieve</p>
                        </div>
                        <p id="data-time" style="font-size: 34px; color: black; padding: 0; margin: 0;"></p>
                    </div>

                    <!-- Qualification Section -->
                    <div style="text-align: right; background-color: #FFFBEB; padding: 20px; border-radius: 30px; width: 200px; border: 0.5px solid orange;">
                        <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 32 32">
                                <path fill="gray" d="M5.25 4A3.25 3.25 0 0 0 2 7.25v7.92a7 7 0 0 1 11.5 7.938V25h13.25A3.25 3.25 0 0 0 30 21.75V7.25A3.25 3.25 0 0 0 26.75 4zM9 10h14a1 1 0 1 1 0 2H9a1 1 0 1 1 0-2m7 8a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2h-6a1 1 0 0 1-1-1m-3 1.5a5.5 5.5 0 1 1-11 0a5.5 5.5 0 0 1 11 0m-1 5.362A6.97 6.97 0 0 1 7.5 26.5A6.97 6.97 0 0 1 3 24.862V29a1 1 0 0 0 1.528.849l2.972-1.85l2.972 1.85a1 1 0 0 0 1.528-.85z" />
                            </svg>
                            <b style="color: gray;">Qualification Required</b>
                        </div>

                        <!-- Qualification List -->
                        <ul id="qualification-list" style="list-style: none; padding-left: 0; margin: 10px 0; text-align: right; color: gray;"> </ul>
                        <ul id="training-list" style="list-style: none; padding-left: 0; margin: 10px 0; text-align: right; color: gray;"> </ul>
                    </div>
                </div>

                <p id="data-description" style="margin: 20px 0; text-align:justify;"></p>

                <label><b>Skills I Need <br><br></b></label>
                <div id="cardContainer" class="cardContainer"></div>
            </div>
        </div>
    </div>

    <script>
        // Modal and elements
        const modal = document.getElementById('myModal');
        const closeBtn = document.querySelector('.close');
        const matchRateSpan = document.getElementById('match-rate'); // Get the span element
        const dataTitle = document.getElementById('data-title');
        const dataTime = document.getElementById('data-time');
        const dataDescription = document.getElementById('data-description');
        const qualificationList = document.getElementById('qualification-list');
        const trainingList = document.getElementById('training-list');
        const cardContainer = document.getElementById('cardContainer');
        
        // Function to open the modal and populate data dynamically
        function openJobDetails(element) {
            const jobTitle = element.getAttribute('data-title'); // Get the job title from the clicked element
            const matchRate = parseInt(element.getAttribute('match-rate')) || 0; // Get match rate from clicked element and convert to integer
        
            // Set match rate value in the span
            matchRateSpan.innerHTML = `${matchRate}% Match`;
        
            // Set background color based on match rate
            let backgroundColor;
            if (matchRate >= 85) {
                backgroundColor = 'rgba(187, 236, 197, 1)';  // Green for high match
            } else if (matchRate >= 60) {
                backgroundColor = 'rgba(255, 235, 180, 1)'; // Yellow for medium match
            } else {
                backgroundColor = 'rgba(255, 224, 221, 1)';  // Red for low match
            }
        
            matchRateSpan.style.backgroundColor = backgroundColor; // Apply background color
        
            // Open the modal
            modal.style.display = 'block'; // Show the modal
            setTimeout(() => {
                modal.style.opacity = '1'; // Ensure fade-in effect after display block
            }, 0);
        
            // Fetch job details from the backend using the job title
            fetch(`/map-job-details?job_title=${encodeURIComponent(jobTitle)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error); // If no job is found, show an error message
                        return;
                    }
        
                    // Populate the modal content with the fetched data
                    dataTitle.textContent = jobTitle || 'N/A';
                    dataTime.textContent = (data.work_experience ? data.work_experience + ' years' : 'N/A');
                    dataDescription.textContent = data.description || 'No description available.';
                    qualificationList.textContent = '🎓 ' + (data.education_level || 'No qualifications listed');
                    trainingList.textContent = 'Training List: ' + (data.relevant_training || 'N/A');
        
                    // Populate skills list
                    const skills = data.skills || [];
                    cardContainer.innerHTML = skills.length > 0 ?
                        skills.map(skill => `<div class="skill-badge">${skill}</div>`).join('') :
                        '<div class="card">No skills listed.</div>';
                })
                .catch(error => {
                    console.error('Error fetching job details:', error);
                    alert('An error occurred while fetching job details.');
                });
        }
        
        // Add click event to cells or elements that will trigger the modal
        document.querySelectorAll('.career-map-cell').forEach(cell => {
            cell.addEventListener('click', function () {
                openJobDetails(this);
            });
        });
        
        // Close the modal when clicking the close button
        closeBtn.addEventListener('click', function () {
            modal.style.opacity = '0'; // Fade out the modal
            setTimeout(() => {
                modal.style.display = 'none'; // Hide the modal completely after fade
            }, 300); // Match the fade-out duration
        });
        
        // Close the modal when clicking outside of the modal content
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.opacity = '0'; // Fade out the modal
                setTimeout(() => {
                    modal.style.display = 'none'; // Hide the modal after fade
                }, 300);
            }
        });
    </script>
    

   <!-- Cel Highlight Script -->
   <script>
       // Set default highlight color for the element with id 'default-highlight-red'
       const defaultCell = document.getElementById('default-highlight-red');
       if (defaultCell) {
           defaultCell.classList.add('highlighted-red'); // Set initial highlight for the default cell
       }
 
       const clickGreen = document.getElementById('clicked-highlight-green');
       const clickGreen1 = document.getElementById('clicked-highlight-green-1');
 
       if (clickGreen) {
           clickGreen.classList.add('highlighted-green'); // Green highlight
       }
 
       if (clickGreen1) {
           clickGreen1.classList.add('highlighted-green'); // Green highlight
       }
   
       const clickOrange = document.getElementById('clicked-highlight-orange');
       const clickOrange1 = document.getElementById('clicked-highlight-orange-1');
   
       if (clickOrange) {
           clickOrange.classList.add('highlighted-orange'); // Orange highlight
       }
 
       if (clickOrange1) {
           clickOrange1.classList.add('highlighted-orange'); // Orange highlight
       }  
   </script>
</body>
</html>

