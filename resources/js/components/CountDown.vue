<template>
  <span id="timer"></span>
</template>
<script>
import { onMounted } from 'vue';
export default {
  name : 'CognitiveCountDown',
  props : ['timer', 'redirect'],
  setup(props){

    onMounted(() => {

      var x = setInterval(function() {

        // Get today's date and time
        var now = Math.floor(Date.now() / 1000)

        // Find the distance between now and the count down date
        var distance = Number(props.timer) - now;

        let minutes = parseInt(distance / 60, 10);
        let seconds = parseInt(distance % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById('counter').innerHTML = minutes+' : '+seconds;

        // If the count down is finished, write some text
        if (distance <= 0) {

          clearInterval(x);

          document.location.href = props.redirect

        }

      }, 1000);

    })


  }
}
</script>
