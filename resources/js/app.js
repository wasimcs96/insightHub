/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.ProgressBar = require('progressbar.js')

import VueSweetalert2 from 'vue-sweetalert2';

import ModalManager from './modal/ModalManager';

import 'sweetalert2/dist/sweetalert2.min.css';

import WorkValuesChart from './components/charts/work-values/WorkValuesChart.vue'

import WorkValuesPieChart from './components/charts/work-values/WorkValuesPieChart.vue'

import InterestRiasecChart from './components/charts/interest-riasec/InterestRiasecChart.vue'

import InterestRiasecDoubleBarChart from './components/charts/interest-riasec/InterestRiasecDoubleBarChart.vue'

import InterestRiasecSpiderChart from './components/charts/interest-riasec/InterestRiasecSpiderChart.vue'

import WorkValuesSpiderChart from './components/charts/work-values/WorkValuesSpiderChart.vue'

import FiveFactorChart from './components/charts/five-factor/FiveFactorChart.vue'

import FiveFactorPieChart from './components/charts/five-factor/FiveFactorPieChart.vue'

import OnetPolarChart from './components/charts/onet-profiler/OnetPolarChart.vue'

import EmployabilityPolarChart from './components/charts/employability/EmployabilityPolarChart.vue'

import EmployabilityBarChart from './components/charts/employability/EmployabilityBarChart.vue'

import EmployabilityDoghnutChart from './components/charts/employability/EmployabilityDoghnutChart.vue'

import EmployabilityHorizontalBarChart from './components/charts/employability/EmployabilityHorizontalBarChart.vue'

import EmployabilityGaugeChart from './components/charts/employability/EmployabilityGaugeChart.vue'

import TwentyFirstCenturyPolarChart from './components/charts/twenty-first-century/TwentyFirstCenturyPolarChart.vue'

import TwentyFirstCenturyBarChart from './components/charts/twenty-first-century/TwentyFirstCenturyBarChart.vue'

import TwentyFirstCenturyHorizontalBarChart from './components/charts/twenty-first-century/TwentyFirstCenturyHorizontalBarChart.vue'

import TwentyFirstCenturyDoghnutChart from './components/charts/twenty-first-century/TwentyFirstCenturyDoghnutChart.vue'

import TwentyFirstCenturyDoghnutChartTotals from './components/charts/twenty-first-century/TwentyFirstCenturyDoghnutChartTotals.vue'

import TwentyFirstCenturyGaugeChart from './components/charts/twenty-first-century/TwentyFirstCenturyGaugeChart.vue'

import EnglishTestGaugeChart from './components/charts/english-test/EnglishTestGaugeChart.vue'

import EnglishTestDoghnutChartTotals from './components/charts/english-test/EnglishTestDoghnutChartTotals.vue'

import ProgressBar from './components/charts/ProgressBar.vue'

import CountDown from './components/CountDown.vue'

import { SearchableDropdown } from './SearchableDropdown'; 

import { createApp } from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.ModalManager = ModalManager;
axios.defaults.headers.common['_token'] = document.querySelector('meta[name=csrf-token]').content;


const app = createApp({
  components : {
    WorkValuesChart,
    WorkValuesPieChart,
    InterestRiasecChart,
    InterestRiasecDoubleBarChart,
    InterestRiasecSpiderChart,
    WorkValuesSpiderChart,
    FiveFactorChart,
    FiveFactorPieChart,
    OnetPolarChart,
    EmployabilityPolarChart,
    EmployabilityBarChart,
    EmployabilityHorizontalBarChart,
    EmployabilityDoghnutChart,
    EmployabilityGaugeChart,
    TwentyFirstCenturyPolarChart,
    TwentyFirstCenturyBarChart,
    TwentyFirstCenturyHorizontalBarChart,
    TwentyFirstCenturyDoghnutChart,
    TwentyFirstCenturyDoghnutChartTotals,
    TwentyFirstCenturyGaugeChart,
    EnglishTestGaugeChart,
    EnglishTestDoghnutChartTotals,
    ProgressBar,
    CountDown,
    ModalManager
  },
  data : function(){

    return {

      completedPercent : 0,

      showNavigation : false,

      errors : []

    }

  },

  mounted : function(){

      this.calculateCompletedPerc()

  },

  methods : {
    collapse(id){

      if(document.getElementById(id).classList.contains('d-block')){

        document.getElementById(id).classList.remove('d-block')

      }else{

        document.getElementById(id).classList.add('d-block')

      }

    },
    calculateCompletedPerc(){

      this.$forceUpdate();

      const form = document.getElementsByTagName('form')[0];

      if(!form) return false;

      const allInputs = form.getElementsByTagName("input")



      let totalInputs = [];

      var object = {};
      for (const [key, value] of Object.entries(allInputs)) {

        if(!totalInputs.includes(value.name) && !value.classList.contains('d-none') && value.type == 'radio') totalInputs.push(value.name);

        if(value.checked && !value.classList.contains('d-none')) object[key] = value;

      }

      totalInputs = totalInputs.length

      const completedInputs = Object.keys(object).length

      this.completedPercent = Number((completedInputs / totalInputs * 100).toFixed(1))

    },
    checkSelectedInputs(element){

      const inputs = element.getElementsByTagName('input')

      for (let i = 0; i < inputs.length; i++) {

        if(inputs[i].checked && !inputs[i].classList.contains('d-none')) return true;

      }

      return false;

    },
    submitForm(e){

      e.preventDefault();

      this.errors = [];

      const form = e.target.closest('form')

      const submitButton = e.target

      if(submitButton){

        submitButton.classList.add("spinner", "spinner-light", "spinner-right")

        submitButton.disabled = true;

      }

      const formData = new FormData(form);

      const data = {}

      formData.forEach((value, key) => {

        data[key] = value

      })

      if(submitButton && (submitButton.value == 'submit' || submitButton.value == 'submit_continue')){

        data['submit'] = submitButton.value;

      }else{

        return false;

      }

      if(!form.method || !form.action){

        return false;

      }


      if(form.method == 'post'){

        axios.post(form.action, data).then(response => {

          submitButton.classList.remove("spinner", "spinner-light", "spinner-right")

          submitButton.disabled = false;

          if(response.data.success && response.data.redirect){

            document.location.href = response.data.redirect

          }

        }).catch(error => {

          submitButton.classList.remove("spinner", "spinner-light", "spinner-right")

          submitButton.disabled = false;

          if (error.response.status === 422) {

            this.errors = error.response.data.errors || [];

            setTimeout(() => {

              const firstError = form.getElementsByClassName("alert-danger")[0]

              if(firstError.previousSibling.previousSibling) firstError.previousSibling.previousSibling.scrollIntoView();

            },500)

          }

        });

      }

      if(form.method == 'get'){

      }

    },

    checkFormWithTimer(e){

      e.preventDefault();

      const form = e.target.closest('form')

      if(!form) return false;

      const allInputs = form.getElementsByTagName("input")

      let isEmpty = false;

      for (const [key, value] of Object.entries(allInputs)) {

        if(value.checked && value.classList.contains('d-none')) {

          isEmpty = true;

          break;

        }

      }

      if(isEmpty){

        this.$swal.fire({
          title: 'Some fields are empty, are you sure want to proceed?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed',
          cancelButtonText: 'No, take me back',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {

              this.submitForm(e)

          }
        })

      }else{

        this.submitForm(e)

      }



    }
  },


});

app.use(VueSweetalert2);

app.mount('#app')
