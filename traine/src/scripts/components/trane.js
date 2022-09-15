import * as Vue from 'vue/dist/vue.esm-bundler.js';

Vue.createApp({
  data() {
    return {
      goals: [],
      goalValue: ''
    }
  },
  methods: {
    addGoal() {
      if (this.goalValue) {
        this.goals.push(this.goalValue);
        this.goalValue = '';
      }
    }
  }
}).mount('#user-goals');
