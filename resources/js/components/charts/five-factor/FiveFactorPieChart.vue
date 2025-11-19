
<template>

  <canvas :id="'myChart'+(domain ? domain : value)" style="width:100%;height:300px!important"></canvas>

</template>

<script>
import { onMounted, reactive } from 'vue'
import Chart from 'chart.js/auto';
export default {
  name: 'FiveFactorPieChart',
  props: ['data', 'domain', 'value'],
  setup(props){

    const finalData = reactive({
      labels : ['Low', 'Moderate', 'High'],
      datasets : [{
        data : [0, 0, 0],
        backgroundColor : ['#4891D3', '#D5E334', '#9AC177']
      }]
    });

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

      props.data.domains.forEach((domain) => {

        if(typeof props.domain != 'undefined' && domain.title != props.domain){

          return;

        }


        domain.values.forEach((value) => {

          if(typeof props.value != 'undefined' && value.title != props.value){

            return;

          }

          let questionsTotal = 0;

          value.questions.forEach((question) => {

            question.answers.forEach((answer) => {

              if(answer.user_id == user_id){

                questionsTotal += answer.answer;

              }

            });


          });



          if(questionsTotal <= 25){

            finalData.datasets[0].data[0] += 1;

          }

          if(questionsTotal > 25 && questionsTotal <= 76){

            finalData.datasets[0].data[1] += 1;

          }

          if(questionsTotal >76){

            finalData.datasets[0].data[2] += 1;

          }


        })

      })

    });

    onMounted(function(){

      const ctx = document.getElementById('myChart'+(props.domain ? props.domain : props.value)).getContext('2d');
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
