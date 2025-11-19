
<template>

  <canvas id="myChart1" style="width:100%;height:500px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'OnetPolarChart',
  props: ['data'],
  setup(props){

    let chartData = [];

    const colors = {
      'Realistic' : 'rgba(207, 60, 83, .5)',
      'Investigative' : 'rgba(104, 139, 195, .5)',
      'Artistic' : 'rgba(91, 166, 112, .5)',
      'Social' : 'rgba(154, 120, 161, .5)',
      'Enterprising' : 'rgba(213, 151, 61, .5)',
      'Conventional' : 'rgba(247, 217, 60, .5)'
    }

      props.data.result.forEach((item, i) => {

        chartData.push({
          value : item.score,
          label : item.area,
          color : colors[item.area]
        })

      });



    const finalData = reactive({
      labels : [],
      datasets : [{
        data : [],
        backgroundColor : []
      }]
    });

    chartData.forEach((item) => {

      finalData.labels.push(item.label)
      finalData.datasets[0].data.push(item.value)
      finalData.datasets[0].backgroundColor.push(item.color)

    });


    onMounted(function(){

      const ctx = document.getElementById('myChart1').getContext('2d');
      const myChart = new Chart(ctx, {
          type: 'polarArea',
          data: finalData,
          options: {
            responsive: false,
            maintainAspectRatio: true,
            showScale: false,
          //   plugins: {
          //     legend: {
          //       display: false
          //     },
          // },
          scales: {
            y: {
            display: false
          },

        }
      },

    });

  })
}

}

</script>
