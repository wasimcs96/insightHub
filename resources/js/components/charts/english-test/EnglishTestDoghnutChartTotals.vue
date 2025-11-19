
<template>

  <canvas :id="'myChartTotals'+(type ? type : '')" class="mb-5" style="width:100%;height:300px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'EnglishTestDoghnutChartTotals',
  props: ['data', 'type'],
  setup(props){

    let newObj = {};

    const finalData = reactive({
      labels : ['Level 1','Level 2','Level 3','Level 4','Level 5'],
      datasets : [{
        data : [0,0,0,0,0],
        backgroundColor : ['#4891D3', '#D5E334', '#9AC177', '#F7D93C', '#DF5297']
      }]
    });

    let allUsers = [];

    let chartData = {};

    props.data.domains.forEach((domain) => {

      domain.values.forEach((value) => {

        newObj[value.title] = 0;

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

          let questionsTotalValue = 0;

          if(props.type && props.type != value.title) return;

          value.questions.forEach((question) => {

            question.answers.forEach((answer) => {

              if(answer.user_id == user_id){

                // if(user_id == 1) console.log(answer.answer+' : '+answer.answer * 100 / (value.title == 'Grammar' ? 20 : 30))

                questionsTotalValue += answer.answer * 100 / (value.title == 'Grammar' ? 20 : 30);

              }

            });


          });

          chartData[user_id].push({
            value : questionsTotalValue,
            label : value.title,
            // color : value.color,
          })

        })



      })

    });

    console.log(chartData)

    for (const [key, value] of Object.entries(chartData)) {

      switch (true) {

        case value[0].value < 50:
        finalData.datasets[0].data[0] += 1;
        break;

        case value[0].value >= 50 && value[0].value < 60:
        finalData.datasets[0].data[1] += 1;
        break;

        case value[0].value >= 60 && value[0].value < 75:
        finalData.datasets[0].data[2] += 1;
        break;

        case value[0].value >= 75 && value[0].value < 90:
        finalData.datasets[0].data[3] += 1;
        break;

        case value[0].value >= 90:
        finalData.datasets[0].data[4] += 1;
        break;

      }

    }


    console.log(finalData.datasets[0].data)


    onMounted(function(){

      const ctx = document.getElementById('myChartTotals'+(props.type ? props.type : '')).getContext('2d');
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
