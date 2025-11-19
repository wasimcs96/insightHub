<template>
  <div class="chartjs-wrapper">
    <div class="text-center text-muted fw-600 mb-3">{{ domain }}</div>
    <canvas :id="'canvas'+color"></canvas>
  </div>
</template>
<script>
require('chartjs-gauge/dist/chartjs-gauge.min.js')
import { onMounted } from 'vue';
export default {
  name : 'TwentyFirstCenturyGaugeChart',
  props : ['color', 'domain', 'data'],
  setup(props){
    // Create chart

    onMounted(() => {

      var value = 0;

      var data = [];

      var color = [];




      let chartData = [];

      props.data.domains.forEach((domain) => {

        if(domain.title == props.domain){

          let questionsTotal = 0;

          domain.values.forEach((value) => {

            questionsTotal += Number(value.answers_sum_answer);

          })


          value = questionsTotal * 100 / 80

        }else{

          return;

        }



      })

      for(var i = 1; i <= 100; i++){

        data.push(i);
        color.push(i <= value ? props.color : 'silver')
      }

      var config = {
        type: 'gauge',
        data: {
          //labels: ['Success', 'Warning', 'Warning', 'Error'],
          datasets: [{
            minValue: 0,
            maxValue: 100,
            data: data,
            value: value,
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

      var ctx = document.getElementById('canvas'+props.color).getContext('2d');
      window.myGauge = new Chart(ctx, config);

    })

  }
}
</script>
