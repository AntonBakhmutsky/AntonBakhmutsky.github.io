import * as Vue from 'vue/dist/vue.esm-bundler.js';

Vue.createApp({
  data() {
    return {
      result: 0,
      message: 'Not there yet'
    }
  },
  methods: {
    increase(num) {
      this.result = this.result + num;
    }
  },
  watch: {
    result(value) {
      if (value < 37) {
        this.message = 'Not there yet';
      } else {
        this.message = 'Too much!';
      }
      setTimeout(() => {
        this.result = 0;
      }, 5000)
    }
  }
}).mount('#assignment')
