<template lang="pug">

li
  h2 {{ name }} {{ isFavorite ? '(Favorite)' : '' }}
  button(@click="toggleDetails") Show Details
  button(@click="toggleFavorite") Toggle Favorite
  button(@click="deleteContact") Delete contact
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
  // emits: ['toggle-favorite'],
  emits: {
    'toggle-favorite': function(id) {
      if (id) {
        return true;
      } else {
        console.log('Warning: Friend id is not exist');
        return false;
      }
    }
  },
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
    },
    deleteContact() {
      this.$emit('delete-contact', this.id)
    }
  },
}
</script>