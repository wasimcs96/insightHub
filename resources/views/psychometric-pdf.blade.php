<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
</head>
<body>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['assessmentChart']))
                    {!! $data['assessmentChart'] !!}
                @endif
                @if(isset($data['agePieChart']))
                    {!! $data['agePieChart'] !!}
                @endif
                @if(isset($data['positionLevel']))
                    {!! $data['positionLevel'] !!}
                @endif
                @if(isset($data['genderChart']))
                    {!! $data['genderChart'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutOmrEmployee']))
                    {!! $data['donutOmrEmployee'] !!}
                @endif

                @if(isset($data['barChartOmrEmployee']))
                    {!! $data['barChartOmrEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutOmrEmployeeLv1']))
                    {!! $data['donutOmrEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartOmrEmployeeLv1']))
                    {!! $data['barChartOmrEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutOmrEmployeeLv2']))
                    {!! $data['donutOmrEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartOmrEmployeeLv2']))
                    {!! $data['barChartOmrEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutOmrEmployeeLv3']))
                    {!! $data['donutOmrEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartOmrEmployeeLv3']))
                    {!! $data['barChartOmrEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutOmrEmployeeLv4']))
                    {!! $data['donutOmrEmployeeLv4'] !!}
                @endif

                @if(isset($data['barChartOmrEmployeeLv4']))
                    {!! $data['barChartOmrEmployeeLv4'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutTaEmployee']))
                    {!! $data['donutTaEmployee'] !!}
                @endif

                @if(isset($data['barChartTaEmployee']))
                    {!! $data['barChartTaEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutTaEmployeeLv1']))
                    {!! $data['donutTaEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartTaEmployeeLv1']))
                    {!! $data['barChartTaEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutTaEmployeeLv2']))
                    {!! $data['donutTaEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartTaEmployeeLv2']))
                    {!! $data['barChartTaEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutTaEmployeeLv3']))
                    {!! $data['donutTaEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartTaEmployeeLv3']))
                    {!! $data['barChartTaEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutTaEmployeeLv4']))
                    {!! $data['donutTaEmployeeLv4'] !!}
                @endif

                @if(isset($data['barChartTaEmployeeLv4']))
                    {!! $data['barChartTaEmployeeLv4'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutBfrEmployee']))
                    {!! $data['donutBfrEmployee'] !!}
                @endif

                @if(isset($data['barChartBfrEmployee']))
                    {!! $data['barChartBfrEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutBfrEmployeeLv1']))
                    {!! $data['donutBfrEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartBfrEmployeeLv1']))
                    {!! $data['barChartBfrEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutBfrEmployeeLv2']))
                    {!! $data['donutBfrEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartBfrEmployeeLv2']))
                    {!! $data['barChartBfrEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutBfrEmployeeLv3']))
                    {!! $data['donutBfrEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartBfrEmployeeLv3']))
                    {!! $data['barChartBfrEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutBfrEmployeeLv4']))
                    {!! $data['donutBfrEmployeeLv4'] !!}
                @endif

                @if(isset($data['barChartBfrEmployeeLv4']))
                    {!! $data['barChartBfrEmployeeLv4'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutJmrEmployee']))
                    {!! $data['donutJmrEmployee'] !!}
                @endif

                @if(isset($data['barChartJmrEmployee']))
                    {!! $data['barChartJmrEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutJmrEmployeeLv1']))
                    {!! $data['donutJmrEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartJmrEmployeeLv1']))
                    {!! $data['barChartJmrEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutJmrEmployeeLv2']))
                    {!! $data['donutJmrEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartJmrEmployeeLv2']))
                    {!! $data['barChartJmrEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutJmrEmployeeLv3']))
                    {!! $data['donutJmrEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartJmrEmployeeLv3']))
                    {!! $data['barChartJmrEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutJmrEmployeeLv4']))
                    {!! $data['donutJmrEmployeeLv4'] !!}
                @endif

                @if(isset($data['barChartJmrEmployeeLv4']))
                    {!! $data['barChartJmrEmployeeLv4'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutSsmrEmployee']))
                    {!! $data['donutSsmrEmployee'] !!}
                @endif

                @if(isset($data['barChartSsmrEmployee']))
                    {!! $data['barChartSsmrEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutSsmrEmployeeLv1']))
                    {!! $data['donutSsmrEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartSsmrEmployeeLv1']))
                    {!! $data['barChartSsmrEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutSsmrEmployeeLv2']))
                    {!! $data['donutSsmrEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartSsmrEmployeeLv2']))
                    {!! $data['barChartSsmrEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutSsmrEmployeeLv3']))
                    {!! $data['donutSsmrEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartSsmrEmployeeLv3']))
                    {!! $data['barChartSsmrEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutSsmrEmployeeLv4']))
                    {!! $data['donutSsmrEmployeeLv4'] !!}
                @endif

                @if(isset($data['barChartSsmrEmployeeLv4']))
                    {!! $data['barChartSsmrEmployeeLv4'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutGpEmployee']))
                    {!! $data['donutGpEmployee'] !!}
                @endif

                @if(isset($data['barChartGpEmployee']))
                    {!! $data['barChartGpEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutGpEmployeeLv1']))
                    {!! $data['donutGpEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartGpEmployeeLv1']))
                    {!! $data['barChartGpEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutGpEmployeeLv2']))
                    {!! $data['donutGpEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartGpEmployeeLv2']))
                    {!! $data['barChartGpEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutGpEmployeeLv3']))
                    {!! $data['donutGpEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartGpEmployeeLv3']))
                    {!! $data['barChartGpEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutGpEmployeeLv4']))
                    {!! $data['donutGpEmployeeLv4'] !!}
                @endif

                @if(isset($data['barChartGpEmployeeLv4']))
                    {!! $data['barChartGpEmployeeLv4'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutWafEmployee']))
                    {!! $data['donutWafEmployee'] !!}
                @endif

                @if(isset($data['barChartWafEmployee']))
                    {!! $data['barChartWafEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutWafEmployeeLv1']))
                    {!! $data['donutWafEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartWafEmployeeLv1']))
                    {!! $data['barChartWafEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutWafEmployeeLv2']))
                    {!! $data['donutWafEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartWafEmployeeLv2']))
                    {!! $data['barChartWafEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutWafEmployeeLv3']))
                    {!! $data['donutWafEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartWafEmployeeLv3']))
                    {!! $data['barChartWafEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutWafEmployeeLv4']))
                    {!! $data['donutWafEmployeeLv4'] !!}
                @endif

                @if(isset($data['barChartWafEmployeeLv4']))
                    {!! $data['barChartWafEmployeeLv4'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutFrEmployee']))
                    {!! $data['donutFrEmployee'] !!}
                @endif

                @if(isset($data['barChartFrEmployee']))
                    {!! $data['barChartFrEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutFrEmployeeLv1']))
                    {!! $data['donutFrEmployeeLv1'] !!}
                @endif

                @if(isset($data['barChartFrEmployeeLv1']))
                    {!! $data['barChartFrEmployeeLv1'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutFrEmployeeLv2']))
                    {!! $data['donutFrEmployeeLv2'] !!}
                @endif

                @if(isset($data['barChartFrEmployeeLv2']))
                    {!! $data['barChartFrEmployeeLv2'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content" style="margin-top:20px;">
                @if(isset($data['donutFrEmployeeLv3']))
                    {!! $data['donutFrEmployeeLv3'] !!}
                @endif

                @if(isset($data['barChartFrEmployeeLv3']))
                    {!! $data['barChartFrEmployeeLv3'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            @if(isset($data['donutFrEmployeeLv4']))
                {!! $data['donutFrEmployeeLv4'] !!}
            @endif

            @if(isset($data['barChartFrEmployeeLv4']))
                {!! $data['barChartFrEmployeeLv4'] !!}
            @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutCaEmployee']))
                    {!! $data['donutCaEmployee'] !!}
                @endif

                @if(isset($data['barChartCaEmployee']))
                    {!! $data['barChartCaEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                <div class="quantitativeLv1">
                    @if(isset($data['quantitativePieChartContainerLv1']))
                        {!! $data['quantitativePieChartContainerLv1'] !!}
                    @endif

                    @if(isset($data['quantitativeBarChartContainerLv1']))
                        {!! $data['quantitativeBarChartContainerLv1'] !!}
                    @endif
                </div>
                <div class="comprehensiveLv1">
                    @if(isset($data['comprehensivePieChartContainerLv1']))
                        {!! $data['comprehensivePieChartContainerLv1'] !!}
                    @endif

                    @if(isset($data['comprehensiveBarChartContainerLv1']))
                        {!! $data['comprehensiveBarChartContainerLv1'] !!}
                    @endif
                </div>
                <div class="visualLv1">
                    @if(isset($data['visualPieChartContainerLv1']))
                        {!! $data['visualPieChartContainerLv1'] !!}
                    @endif

                    @if(isset($data['visualBarChartContainerLv1']))
                        {!! $data['visualBarChartContainerLv1'] !!}
                    @endif
                </div>
                <div class="fluidLv1">
                    @if(isset($data['fluidPieChartContainerLv1']))
                        {!! $data['fluidPieChartContainerLv1'] !!}
                    @endif

                    @if(isset($data['fluidBarChartContainerLv1']))
                        {!! $data['fluidBarChartContainerLv1'] !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                <div class="quantitativeLv2">
                    @if(isset($data['quantitativePieChartContainerLv2']))
                        {!! $data['quantitativePieChartContainerLv2'] !!}
                    @endif

                    @if(isset($data['quantitativeBarChartContainerLv2']))
                        {!! $data['quantitativeBarChartContainerLv2'] !!}
                    @endif
                </div>
                <div class="comprehensiveLv2">
                    @if(isset($data['comprehensivePieChartContainerLv2']))
                        {!! $data['comprehensivePieChartContainerLv2'] !!}
                    @endif

                    @if(isset($data['comprehensiveBarChartContainerLv2']))
                        {!! $data['comprehensiveBarChartContainerLv2'] !!}
                    @endif
                </div>
                <div class="visualLv2">
                    @if(isset($data['visualPieChartContainerLv2']))
                        {!! $data['visualPieChartContainerLv2'] !!}
                    @endif

                    @if(isset($data['visualBarChartContainerLv2']))
                        {!! $data['visualBarChartContainerLv2'] !!}
                    @endif
                </div>
                <div class="fluidLv2">
                    @if(isset($data['fluidPieChartContainerLv2']))
                        {!! $data['fluidPieChartContainerLv2'] !!}
                    @endif

                    @if(isset($data['fluidBarChartContainerLv2']))
                        {!! $data['fluidBarChartContainerLv2'] !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                <div class="quantitativeLv3">
                    @if(isset($data['quantitativePieChartContainerLv3']))
                        {!! $data['quantitativePieChartContainerLv3'] !!}
                    @endif

                    @if(isset($data['quantitativeBarChartContainerLv3']))
                        {!! $data['quantitativeBarChartContainerLv3'] !!}
                    @endif
                </div>
                <div class="comprehensiveLv3">
                    @if(isset($data['comprehensivePieChartContainerLv3']))
                        {!! $data['comprehensivePieChartContainerLv3'] !!}
                    @endif

                    @if(isset($data['comprehensiveBarChartContainerLv3']))
                        {!! $data['comprehensiveBarChartContainerLv3'] !!}
                    @endif
                </div>
                <div class="visualLv3">
                    @if(isset($data['visualPieChartContainerLv3']))
                        {!! $data['visualPieChartContainerLv3'] !!}
                    @endif

                    @if(isset($data['visualBarChartContainerLv3']))
                        {!! $data['visualBarChartContainerLv3'] !!}
                    @endif
                </div>
                <div class="fluidLv3">
                    @if(isset($data['fluidPieChartContainerLv3']))
                        {!! $data['fluidPieChartContainerLv3'] !!}
                    @endif

                    @if(isset($data['fluidBarChartContainerLv3']))
                        {!! $data['fluidBarChartContainerLv3'] !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                <div class="quantitativeLv4">
                    @if(isset($data['quantitativePieChartContainerLv4']))
                        {!! $data['quantitativePieChartContainerLv4'] !!}
                    @endif

                    @if(isset($data['quantitativeBarChartContainerLv4']))
                        {!! $data['quantitativeBarChartContainerLv4'] !!}
                    @endif
                </div>
                <div class="comprehensiveLv4">
                    @if(isset($data['comprehensivePieChartContainerLv4']))
                        {!! $data['comprehensivePieChartContainerLv4'] !!}
                    @endif

                    @if(isset($data['comprehensiveBarChartContainerLv4']))
                        {!! $data['comprehensiveBarChartContainerLv4'] !!}
                    @endif
                </div>
                <div class="visualLv4">
                    @if(isset($data['visualPieChartContainerLv4']))
                        {!! $data['visualPieChartContainerLv4'] !!}
                    @endif

                    @if(isset($data['visualBarChartContainerLv4']))
                        {!! $data['visualBarChartContainerLv4'] !!}
                    @endif
                </div>
                <div class="fluidLv4">
                    @if(isset($data['fluidPieChartContainerLv4']))
                        {!! $data['fluidPieChartContainerLv4'] !!}
                    @endif

                    @if(isset($data['fluidBarChartContainerLv4']))
                        {!! $data['fluidBarChartContainerLv4'] !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutAllStarSafetyEmployee']))
                    {!! $data['donutAllStarSafetyEmployee'] !!}
                @endif
                @if(isset($data['donutAllStarCelebrateallEmployee']))
                    {!! $data['donutAllStarCelebrateallEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutAllStarBetransparentEmployee']))
                    {!! $data['donutAllStarBetransparentEmployee'] !!}
                @endif
                @if(isset($data['donutAllStarMakedifferenceEmployee']))
                    {!! $data['donutAllStarMakedifferenceEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutAllStarKeepsimpleEmployee']))
                    {!! $data['donutAllStarKeepsimpleEmployee'] !!}
                @endif
                @if(isset($data['donutAllStarAllforoneEmployee']))
                    {!! $data['donutAllStarAllforoneEmployee'] !!}
                @endif
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="main-container">
        <div class="main-content">
            <div class="content">
                @if(isset($data['donutAllStarHaveempathyEmployee']))
                    {!! $data['donutAllStarHaveempathyEmployee'] !!}
                @endif
                @if(isset($data['donutAllStarDaretodreamEmployee']))
                    {!! $data['donutAllStarDaretodreamEmployee'] !!}
                @endif
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="{{ asset('js/pdf-aggregated-department.js') }}"></script>
</body>
</html>