
<template>

  <div class="row">

    <div class="col-12 col-lg-7">

      <!-- <div class="d-flex align-items-center">

        <div class="flex-fill">

          <div class="color-yellow fs-lg-1-1 fw-700" :style="{'margin-left' : chartData[0].value+'%'}">{{ chartData[0].value.toFixed(2) }}%</div>

        </div>

        <div class="color-yellow ms-3 text-center" style="visibility:hidden">

          <div class="fs-lg-1-1 fs-08 fw-700">{{ chartData[0].value.toFixed(2) }}%</div>


        </div>

      </div> -->

      <div class="d-flex align-items-center">

        <!-- <div class="color-yellow me-3 text-center">

          <div class="fs-lg-1-1 fs-08 fw-700">0%</div>

        </div> -->

        <div class="flex-fill">

          <div class="progress-bar">

            <div class="status" :style="{width : chartData[0].value+'%'}"></div>

          </div>

        </div>

        <!-- <div class="color-yellow ms-3 text-center">

          <div class="fs-lg-1-1 fs-08 fw-700">100%</div>

        </div> -->

      </div>

      <div class="d-flex align-items-center">

        <div class="flex-fill">

          <div class="color-yellow fs-lg-1-1 fw-700" :style="{'margin-left' : chartData[0].value+'%'}">{{ chartData[0].label }}</div>

        </div>

        <div class="color-yellow ms-3 text-center" style="visibility:hidden">

          <div class="fs-lg-1-1 fs-08 fw-700">{{ chartData[0].value.toFixed(2) }}%</div>


        </div>

      </div>


    </div>

  </div>

</template>

<script>
import { onMounted, reactive } from 'vue'
export default {
  name: 'FiveFactorChart',
  props: ['data', 'type'],
  setup(props){

    let chartData = [];

    props.data.domains.forEach((domain) => {

      domain.values.forEach((value) => {

        if(value.title == props.type){

          const questionsTotal = Number(value.answers_sum_answer) * 100 / 120;

          chartData.push({
            value : questionsTotal,
            label : questionsTotal <= 25 ? 'Low' : (questionsTotal > 25 && questionsTotal <= 76 ? 'Moderate' : 'High'),
            color : value.color
          })

        }

      })

    })

    return {
      chartData
    }
  }

}

</script>
