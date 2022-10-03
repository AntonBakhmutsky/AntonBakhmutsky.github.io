<template lang="pug">
div
  h2 {{ userName }}
  h3 {{ age }}
</template>

<script>
import {
  computed,
  inject,
  onBeforeMount,
  onMounted,
  onBeforeUpdate,
  onUpdated,
  onBeforeUnmount,
  onUnmounted
} from "vue";

export default {
  props: ['firstName', 'lastName'],
  setup(props, context) {

    console.log(context);
    const userName = computed(function () {
      return props.firstName + ' ' + props.lastName;
    });

    const age = inject('userAge')

    onBeforeMount(function() {
      console.log('onBeforeMount');
    });

    onMounted(function() {
      console.log('onMounted');
    });
    onBeforeUpdate(function() {
      console.log('onBeforeUpdate');
    });
    onUpdated(function() {
      console.log('onUpdated');
    });
    onBeforeUnmount(function() {
      console.log('onBeforeUnmount');
    });
    onUnmounted(function() {
      console.log('onUnmounted');
    });

    return {userName, age}
  }
  // computed: {
  //   userName() {
  //     return this.firstName + ' ' + this.lastName;
  //   }
  // }
}
</script>