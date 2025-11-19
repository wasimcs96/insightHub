
<template>

  <canvas id="myChart" style="width:100%;height:300px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'TwentyFirstCenturyBarChart',
  props: ['data'],
  setup(props){

    let chartData = [];

      props.data.domains.forEach((domain) => {

        let opacity = 1;

        domain.values.forEach((value) => {

          const questionsTotal = Number(value.answers_sum_answer) * 100/20;

          let color = domain.color.replace(/[\d\.]+\)$/g, ''+opacity+')')

          opacity -= 0.10;

          chartData.push({
            value : questionsTotal,
            label : value.title,
            color : color
          })

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

      const ctx = document.getElementById('myChart').getContext('2d');
      const myChart = new Chart(ctx, {
          type: 'bar',
          data: finalData,
          options: {
            responsive: false,
            maintainAspectRatio: true,
            showScale: false,
            plugins: {
              legend: {
                display: false
              },
          },
          scales: {
            y: {
            beginAtZero: true
          },

        }
      },

    });

  })
}

}

</script>
