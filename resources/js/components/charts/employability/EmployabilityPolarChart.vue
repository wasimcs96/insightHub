
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

    props.data.domains.forEach((domain) => {

      let questionsTotal = 0;

      domain.values.forEach((value) => {

        questionsTotal += Number(value.answers_sum_answer);

      })

      chartData.push({
        value : questionsTotal * 100 / (['Ideas and Opportunities', 'Resources'].includes(domain.title) ? 75 : 90),
        label : domain.title,
        color : domain.color
      })

    })



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
          r : {
            suggestedMin: 0,
            suggestedMax: 100,
          }

        }
      },

    });

  })
}

}

</script>
