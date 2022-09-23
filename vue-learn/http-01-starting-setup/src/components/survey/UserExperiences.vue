<template lang="pug">
section
  BaseCard
    h2 Submitted Experiences
    div
      base-button Load Submitted Experiences
    ul
      survey-result(
        v-for="result in results"
        :key="result.id"
        :name="result.name"
        :rating="result.rating"
      )
</template>

<script>
import SurveyResult from './SurveyResult.vue';

export default {
  props: ['results'],
  components: {
    SurveyResult,
  },
};
</script>

<style scoped>
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
</style>