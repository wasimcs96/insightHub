<template>

  <canvas :id="'myChart'+value" style="width:100%;height:30px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
require('chartjs-gauge/dist/chartjs-gauge.min.js')
export default {
  name: 'TwentyFirstCenturyHorizontalBarChart',
  props: ['data', 'domain', 'value'],
  setup(props){

    let chartData = [];

    let finalValue = 0;

    var data = [];

    var color = [];

      props.data.domains.forEach((domain) => {

        if(domain.title == props.domain){

          domain.values.forEach((value) => {

            if(value.title == props.value){

              const questionsTotal = Number(value.answers_sum_answer);

              finalValue = questionsTotal * 100/20

              console.log(finalValue)

              return;

            }

          })

        }


      })


      onMounted(() => {


        for(var i = 1; i <= 100; i++){

          data.push(i);
          color.push(i <= finalValue ? '#851C3A' : 'silver')
        }

        var config = {
          type: 'gauge',
          data: {
            //labels: ['Success', 'Warning', 'Warning', 'Error'],
            datasets: [{
              minValue: 0,
              maxValue: 100,
              data: data,
              value: finalValue,
              backgroundColor: color,
              borderWidth: 0
            }]
          },
          options: {
            responsive: true,
            title: {
              display: false,
              text: 'Gauge chart'
            },
            layout: {
              padding: {
                bottom: 30
              }
            },
            needle: {
              color : 'transparent',
              // Needle circle radius as the percentage of the chart area width
              radiusPercentage: 0,
              // Needle width as the percentage of the chart area width
              widthPercentage: 0,
              // Needle length as the percentage of the interval between inner radius (0%) and outer radius (100%) of the arc
              lengthPercentage: 80,
              // The color of the needle
              color: '#416B3A'
            },
            valueLabel: {
              backgroundColor : 'transparent',
              fontSize : 35,
              color : 'black',
              display : true,
              formatter: Math.round
            }
          }
        };

        var ctx = document.getElementById('myChart'+props.value).getContext('2d');
        window.myGauge = new Chart(ctx, config);

      })
}

}

</script>
