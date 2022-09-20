<template lang="pug">

li
  h2 {{ name }} {{ isFavorite ? '(Favorite)' : '' }}
  button(@click="toggleDetails") Show Details
  button(@click="toggleFavorite") Toggle Favorite
  button(@click="$emit('delete-contact', this.id)") Delete contact
  ul(v-if="detailsAreVisible")
    li #[strong Phone: {{ phoneNumber }}]
    li #[strong Email: {{ emailAddress }}]

</template>

<script>
export default {
  // props: ['name', 'phoneNumber', 'emailAddress', 'isFavorite'],
  props: {
    id: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    phoneNumber: {
      type: String,
      required: true
    },
    emailAddress: {
      type: String,
      required: true
    },
    isFavorite: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  emits: ['toggle-favorite', 'delete-contact'],
  data() {
    return {
      detailsAreVisible: false
    }
  },
  methods: {
    toggleDetails() {
      this.detailsAreVisible = !this.detailsAreVisible;
    },
    toggleFavorite() {
      this.$emit('toggle-favorite', this.id);
    }
  },
}
</script>