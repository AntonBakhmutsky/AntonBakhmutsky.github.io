<template lang="pug">
section
  BaseCard
    h2 How was you learning experience?
    form(@submit.prevent="submitSurvey")
      div(class="form-control")
        label(for="name") Your Name
        input(type="text" id="name" name="name" v-model.trim="enteredName")
      h3 My learning experience was ...
      div(class="form-control")
        input(type="radio" id="rating-poor" value="poor" name="rating" v-model="chosenRating")
        label(for="rating-poor") Poor
      div(class="form-control")
        input(
          type="radio"
          id="rating-average"
          value="average"
          name="rating"
          v-model="chosenRating"
        )
        label(for="rating-average") Average
      div(class="form-control")
        input(type="radio" id="rating-great" value="great" name="rating" v-model="chosenRating")
        label(for="rating-great") Great
      p(v-if="invalidInput") One or more input fields are invalid. Please check your provided data.
      div
        BaseButton Submit
</template>

<script>
export default {
  data() {
    return {
      enteredName: '',
      chosenRating: null,
      invalidInput: false,
    };
  },
  // emits: ['survey-submit'],
  methods: {
    submitSurvey() {
      if (this.enteredName === '' || !this.chosenRating) {
        this.invalidInput = true;
        return;
      }
      this.invalidInput = false;

      // this.$emit('survey-submit', {
      //   userName: this.enteredName,
      //   rating: this.chosenRating,
      // });

      fetch('https://vue-http-demo-ca7ca-default-rtdb.firebaseio.com/surveys.json', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name: this.enteredName, rating: this.chosenRating}),
      });

      this.enteredName = '';
      this.chosenRating = null;
    },
  },
};
</script>

<style scoped>
.form-control {
  margin: 0.5rem 0;
}

input[type='text'] {
  display: block;
  width: 20rem;
  margin-top: 0.5rem;
}
</style>