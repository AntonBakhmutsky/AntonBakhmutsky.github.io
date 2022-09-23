<template lang="pug">
BasePreloader(v-if="isLoading")
section
  BaseCard
    h2 Submitted Experiences
    div
      base-button(@click="loadExperiences") Load Submitted Experiences
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
  components: {
    SurveyResult,
  },
  data() {
    return {
      results: [],
      isLoading: false
    }
  },
  methods: {
    loadExperiences() {
      this.isLoading = true;
      fetch('https://vue-http-demo-ca7ca-default-rtdb.firebaseio.com/surveys.json').then(function(response) {
        if (response.ok) {
          return response.json();
        }
      }).then((data) => {
        this.isLoading = false;
        const results = [];
        for (const id in data) {
          results.push({id: id, name: data[id].name, rating: data[id].rating});
        }
        this.results = results;
      });
    }
  },
  mounted() {
    this.loadExperiences();
  }
};
</script>

<style scoped>
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
</style>