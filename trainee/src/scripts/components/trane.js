import * as Vue from 'vue/dist/vue.esm-bundler.js';

const app = Vue.createApp({
  data() {
    return {
      friends: [
        {
          id: 'manuel',
          name: 'Manuel Lorenz',
          phone: '1234 5678 991',
          email: 'manuel@localhost.com'
        },
        {
          id: 'julie',
          name: 'Julie Jones',
          phone: '09876 543 221',
          email: 'julie@localhost.com'
        },
      ]
    }
  }
})

app.component('friend-contact', {
  template: `
    <li>
      <h2>{{ friend.name }}</h2>
      <button @click="toggleDetails()">{{ detailsAreVisible ? "Hide" : "Show" }} Details</button>
      <ul v-if="detailsAreVisible">
        <li><strong>Phone: {{ friend.phone }}</strong></li>
        <li><strong>Email: {{ friend.email }}</strong></li>
      </ul>
    </li>
  `,
  data() {
    return {
      detailsAreVisible: false,
      friend: {
        id: 'manuel',
        name: 'Manuel Lorenz',
        phone: '1234 5678 991',
        email: 'manuel@localhost.com'
      }
    }
  },
  methods: {
    toggleDetails() {
      this.detailsAreVisible = !this.detailsAreVisible;
    }
  }
});
app.mount('#app');
