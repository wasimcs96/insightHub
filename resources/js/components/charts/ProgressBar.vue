<template>
  <div ref="container" class="mx-auto" style="width: 160px;height: 160px;position: relative;"></div>
</template>
<script>
import { ref, onMounted } from 'vue'
export default {
  name : 'ProgressBar',
  props : ['name', 'percent'],
  setup : function(props){

    const container = ref(null);

    onMounted(() => {

      var bar = new window.ProgressBar.Circle(container.value, {
      color: '#5c5b9d',
      // This has to be the same size as the maximum width to
      // prevent clipping
      strokeWidth: 4,
      trailWidth: 4,
      easing: 'easeInOut',
      duration: 1400,
      text: {
        autoStyleContainer: false
      },
      from: { color: '#5C5B9D', width: 4 },
      to: { color: '#FE60B1', width: 4 },
      // Set default step function for all animate calls
      step: function(state, circle) {
        circle.path.setAttribute('stroke', state.color);
        circle.path.setAttribute('stroke-width', state.width);

        var value = Math.round(circle.value() * 100);
        if (value === 0) {
          circle.setText('0%');
        } else {
          circle.setText(value+'%');
        }

      }
    });

    bar.text.style.fontSize = '2rem';

    bar.animate(Number(props.percent));  // Number from 0.0 to 1.0

    })



  return {
    container
  }

  }
}
</script>
