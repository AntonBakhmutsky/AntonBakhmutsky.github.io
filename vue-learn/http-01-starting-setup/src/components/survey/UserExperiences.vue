<template lang="pug">
section
  BaseCard
    h2 Submitted Experiences
    div
      base-button(@click="loadExperiences") Load Submitted Experiences
    p(v-if="isLoading") Loading...
    p(v-else-if="!isLoading && error" ) {{ error }}
    P(v-else-if="!isLoading && (!results || results.length === 0)" ) No stored experiences found. Start adding some survey results first.
    ul(v-else-if="!isLoading && results && results.length > 0")
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
      isLoading: false,
      error: null
    }
  },
  methods: {
    loadExperiences() {
      this.isLoading = true;
      this.error = null;
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
      }).catch((error) => {
        console.log(error)
        this.isLoading = false;
        this.error = 'Filed to fetch data - please try again later';
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