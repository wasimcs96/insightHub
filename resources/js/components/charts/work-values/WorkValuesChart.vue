
<template>

  <canvas :id="'myChart'+type" style="width:100%;height:300px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'WorkValuesChart',
  props: ['data', 'type'],
  setup(props){

    let chartData = [];

    props.data.domains.forEach((domain) => {

      domain.values.forEach((value) => {

        const questionsTotal = Number(value.answers_sum_answer);

        let totalVal = 0;

        if(questionsTotal >= value.value_answer_valuation.low[0] && questionsTotal <= value.value_answer_valuation.low[1]){

          totalVal = 1

        }

        if(questionsTotal >= value.value_answer_valuation.moderate[0] && questionsTotal <= value.value_answer_valuation.moderate[1]){

          totalVal = 2

        }

        if(questionsTotal >= value.value_answer_valuation.high[0] && questionsTotal <= value.value_answer_valuation.high[1]){

          totalVal = 3

        }

        chartData.push({
          value : totalVal,
          label : value.title,
          color : props.type != 'second' ? domain.color : '#00C4CC'
        })

      })

    })

    if(props.type == 'second'){

      chartData.sort(function(a, b) { return a.value - b.value })

    }


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

    finalData.datasets[0].data.push(3)

    onMounted(function(){
      const yLabels = {
        1: 'Low',
        2: 'Moderate',
        3: 'High'
      }
      const ctx = document.getElementById('myChart'+props.type).getContext('2d');
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
            tooltip: {
              callbacks: {
                label: function(context) {
                  return yLabels[context.parsed.y];

                }
              }
            }
          },
          scales: {
            y: {
              ticks: {
                callback: function(value, index, values) {

                  return yLabels[value];

                },
                font: {
                  size: 16,
                  weight: 'bold'
                },
                autoSkip: false,
                beginAtZero: true,
                max: 2,
                min: 0,
                stepSize: 1
              },
          },

        }
      },

    });

  })
}

}

</script>
