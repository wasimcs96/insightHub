
<template>

  <canvas id="myChart" ></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'InterestRiasecChart',
  props: ['data', 'type'],
  setup(props){

    let chartData = [];

    const colors = {
      'Realistic' : '#881336',
      'Investigative' : '#197f17',
      'Artistic' : '#bc4908',
      'Social' : '#871212',
      'Enterprising' : '#173e81',
      'Conventional' : '#321780'
    }

    if(props.type && props.type == 'api'){

      props.data.result.forEach((item, i) => {

        chartData.push({
          value : item.score,
          label : item.area,
          color : colors[item.area]
        })

      });


    }else{

      props.data.domains.forEach((domain) => {

        domain.values.forEach((value) => {

          const questionsTotal = Number(value.answers_sum_answer);

          chartData.push({
            value : questionsTotal,
            label : value.title,
            color : value.color
          })

        })

      })

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
