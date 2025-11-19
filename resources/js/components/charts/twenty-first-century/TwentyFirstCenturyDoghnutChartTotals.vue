
<template>

  <canvas id="myChartTotals" class="mb-5" style="width:100%;height:300px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'TwentyFirstCenturyDoghnutChartTotals',
  props: ['data'],
  setup(props){

    let newObj = {};

    const finalData = reactive({
      labels : [],
      datasets : [{
        data : [],
        backgroundColor : ['#4891D3', '#D5E334', '#9AC177', '#F7D93C']
      }]
    });

    let allUsers = [];

    let chartData = {};

    props.data.domains.forEach((domain) => {

      // finalData.labels.push(domain.title)

      newObj[domain.title] = 0;

      // finalData.datasets[0].data.push(0)

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

        let questionsTotalDomain = 0;

        domain.values.forEach((value) => {

          value.questions.forEach((question) => {

            question.answers.forEach((answer) => {

              if(answer.user_id == user_id){

                questionsTotalDomain += answer.answer;

              }

            });


          });

        })

        const questionsTotal = questionsTotalDomain * 100 / 80

        chartData[user_id].push({
          value : questionsTotal,
          label : domain.title,
          // color : value.color,
        })

      })

    });

    for (const [key, value] of Object.entries(chartData)) {

      value.sort(function(a, b) { return b.value - a.value })

    }

    for (const [key, value] of Object.entries(chartData)) {

      newObj[value[0].label] += 1;

    }



    for (const [key, value] of Object.entries(newObj)) {

      finalData.labels.push(key)
      finalData.datasets[0].data.push(value)
    }

    onMounted(function(){

      const ctx = document.getElementById('myChartTotals').getContext('2d');
      const myChart = new Chart(ctx, {
          type: 'doughnut',
          data: finalData,
          options: {
            tooltips: {
             enabled: false
           },
            responsive: false,
            maintainAspectRatio: true,
            showScale: false,
            plugins: {

              legend: {
                display: true
              },
              tooltip: {
                callbacks: {
                  label: function(context) {

                    let sum = 0;
                    context.dataset.data.forEach((item) => {
                      sum += item;
                    });

                    let percentage = context.label+' '+(context.raw * 100 / sum).toFixed(2) + "%";
                    return percentage;
                  }
                }
              }
          },

      },

    });

  })
}

}

</script>
