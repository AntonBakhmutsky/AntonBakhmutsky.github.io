<template lang="pug">
div
  h2 {{ userName }}
  h3 {{ age }}
</template>

<script>
import {computed} from "vue";

export default {
  props: ['firstName', 'lastName'],
  setup(props, context) {
    console.log(context);
    const userName = computed(function() {
      return props.firstName + ' ' + props.lastName;
    });


    return {userName}
  }
  // computed: {
  //   userName() {
  //     return this.firstName + ' ' + this.lastName;
  //   }
  // }
}
</script>