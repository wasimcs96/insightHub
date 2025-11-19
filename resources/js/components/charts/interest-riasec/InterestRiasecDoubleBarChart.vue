
<template>

  <canvas id="myChart" style="width:100%;height:300px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'InterestRiasecDoubleBarChart',
  props: ['data', 'type'],
  setup(props){

    let chartData = {};

    const colors = {
      'Realistic' : '#CF3C53',
      'Investigative' : '#688BC3',
      'Artistic' : '#5BA670',
      'Social' : '#9A78A1',
      'Enterprising' : '#D5973D',
      'Conventional' : '#F7D93C'
    }

    let allUsers = [];

    props.data.domains.forEach((domain) => {

      domain.values.forEach((value) => {

        value.questions.forEach((question) => {

          question.answers.forEach((answer) => {

            allUsers.push(answer.user_id)

          });


        });


      })

    })


    Array.from(new Set(allUsers)).forEach((user_id) => {

      chartData[user_id] = []

      props.data.domains.forEach((domain) => {

        domain.values.forEach((value) => {

          let questionsTotal = 0;

          value.questions.forEach((question) => {

            question.answers.forEach((answer) => {

              if(answer.user_id == user_id){

                questionsTotal += answer.answer;

              }

            });


          });


          chartData[user_id].push({
            value : questionsTotal,
            label : value.title,
            color : value.color,
          })


        })

      })

    });



    for (const [key, value] of Object.entries(chartData)) {

      value.sort(function(a, b) { return b.value - a.value })

    }



    let newObj = {
      'Realistic' : [0, 0],
      'Investigative' : [0, 0],
      'Artistic' : [0, 0],
      'Social' : [0, 0],
      'Enterprising' : [0, 0],
      'Conventional' : [0, 0]
    };


    const finalData = reactive({
      labels : [],
      datasets : [
        {
          label: 'Top Interest',
          data : [],
          backgroundColor : []
        },
        {
          label: 'Top 3 Interest',
          data : [],
          backgroundColor : []
        }
      ]
    });


    for (const [key, value] of Object.entries(chartData)) {

      newObj[value[0].label][0] += 1;

      newObj[value[1].label][1] += 1;
      newObj[value[2].label][1] += 1;

    }


    for (const [key, value] of Object.entries(newObj)) {

      finalData.labels.push(key)
      finalData.datasets[0].data.push(value[0])
      finalData.datasets[0].backgroundColor.push('#71254B')
      finalData.datasets[1].data.push(value[1])
      finalData.datasets[1].backgroundColor.push('#DF5297')
    }

    console.log(JSON.stringify(finalData))

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
