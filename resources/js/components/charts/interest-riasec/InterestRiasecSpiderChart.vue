

<template>

<canvas id="mySpiderChart" style="width:100%;height:700px!important">

</canvas>

</template>

<script>

import {
    onMounted, reactive
}
from 'vue'
import Chart from 'chart.js/auto';
export default {
    name: 'InterestRiasecSpiderChart',
    props: ['data'],
    setup(props) {

      const hexToRgbA= function(hex){
          var c;
          if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
              c= hex.substring(1).split('');
              if(c.length== 3){
                  c= [c[0], c[0], c[1], c[1], c[2], c[2]];
              }
              c= '0x'+c.join('');
              return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',.6)';
          }
          throw new Error('Bad Hex');
      }

        let chartData = [];

        props.data.domains.forEach((domain) => {

            domain.values.forEach((value) => {

                const questionsTotal = Number(value.answers_sum_answer);

                chartData.push({
                    value: questionsTotal,
                    label: value.title,
                    color: value.color
                })

            })

        })


        const finalData = reactive({
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: [],
                borderColor: [],
                pointBackgroundColor: [],
                pointBorderWidth: 1,
                pointRadius : 10
            }]
        });

        chartData.forEach((item) => {

            finalData.labels.push(item.label)
            finalData.datasets[0].data.push(item.value)
            finalData.datasets[0].backgroundColor.push(hexToRgbA(item.color))
            finalData.datasets[0].borderColor.push(item.color)


        });

        console.log(finalData)

        onMounted(function() {

            const ctx = document.getElementById('mySpiderChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'polarArea',
                data: finalData,
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    showScale: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    scales: {
                        r: {
                            font: {
                                size: 25,
                                weight: 'bold'
                            },
                            suggestedMin: 0,
                            suggestedMax: 40,
                            pointLabels: {
                              font: {
                                size: 14,
                                weight: 'bold',
                                fontColor: 'red'
                              },
                              display: true,
                              centerPointLabels: true,
                            }
                        },
                        y: {
                            display: false
                        },

                    },
                    elements: {
                        line: {
                            borderWidth: 4
                        }
                    }
                },

            });

        })
    }

}

</script>
