<template lang="pug">
h2 My Course Goal
<!-- Task 1: Output your main course goal with help of the composition API -->
<!-- Don't hardcode it into the template, instead hardcode it into the JS code -->
h3(v-show="flag") {{ goal }}
h3(v-show="flag") {{ goal2.goal }}
h3(v-show="flag") {{ goal3.goal }}
<!-- Task 2: Toggle (show/ hide) the goal with help of the button  -->
button(@click="toggleGoal") Toggle Goal
<!-- Task 3: Manage data in three ways -->
<!-- => Separate refs -->
<!-- => Ref Object -->
<!-- => Reactive Object -->
<!-- Task 4: Also solve the assignment with the Options API -->
</template>

<script>
import {ref, reactive} from 'vue';

export default {
  setup() {
    const goal = ref('Finish the course!');
    const goal2 = ref({
      goal: 'Learn vue'
    })
    const goal3 = reactive({goal: 'Master Vue'})
    let flag = ref(true)

    function toggleGoal() {
      flag.value = !flag.value
    }

    return {goal: goal, toggleGoal: toggleGoal, flag: flag, goal2: goal2, goal3: goal3}
  }
}
</script>

<style lang="sass">
html
  font-family: sans-serif

body
  margin: 3rem
  text-align: center

</style>