<template lang="pug">

li
  h2 {{ name }} {{ friendIsFavorite ? '(Favorite)' : '' }}
  button(@click="toggleDetails") Show Details
  button(@click="toggleFavorite") Toggle Favorite
  ul(v-if="detailsAreVisible")
    li #[strong Phone: {{ phoneNumber }}]
    li #[strong Email: {{ emailAddress }}]

</template>

<script>
export default {
  props: [
    'name',
    'phoneNumber',
    'emailAddress',
    'isFavorite'
  ],
  data() {
    return {
      detailsAreVisible: false,
      friendIsFavorite: this.isFavorite
    }
  },
  methods: {
    toggleDetails() {
      this.detailsAreVisible = !this.detailsAreVisible;
    },
    toggleFavorite() {
      this.friendIsFavorite = !this.friendIsFavorite;
    }
  },
}
</script>