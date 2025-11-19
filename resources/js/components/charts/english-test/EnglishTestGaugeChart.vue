<template>
  <div class="chartjs-wrapper">
    <canvas :id="'canvas'+color"></canvas>

    <div class="text-center text-muted fw-600">Level {{ val }}</div>
  </div>
</template>
<script>
require('chartjs-gauge/dist/chartjs-gauge.min.js')
import { onMounted } from 'vue';
export default {
  name : 'EnglishTestGaugeChart',
  props : ['color', 'max', 'val'],
  setup(props){
    // Create chart

    const colors = ['#fe1600','#fd7500','#ecbc00','#91fd13','#5cc60a']

    onMounted(() => {

      var value = Number(props.val);

      var data = [];

      var color = [];

      for(var i = 1; i <= Number(props.max); i++){

        data.push(i);
        color.push(colors[i - 1])
      }



      var config = {
        type: 'gauge',
        data: {
          //labels: ['Success', 'Warning', 'Warning', 'Error'],
          datasets: [{
            minValue: 0,
            maxValue: Number(props.max),
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
            // Needle circle radius as the percentage of the chart area width
            radiusPercentage: 2,
            // Needle width as the percentage of the chart area width
            widthPercentage: 3.2,
            // Needle length as the percentage of the interval between inner radius (0%) and outer radius (100%) of the arc
            lengthPercentage: 80,
            // The color of the needle
            color: '#416B3A'
          },
          valueLabel: {
            display : false,
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
