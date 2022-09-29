<template lang="pug">
section
  BaseCard
    h2 {{ fullName }}
    h3 {{ rate }}
section
  BaseCard
    header
      h2 Interested? Reach out now!
      BaseButton(link :to="contactLink") Contact
    RouterView
section
  BaseCard
    BaseBadge(v-for="area in areas" :key="area" :class="area" :title="area")
    p {{ description }}
</template>

<script>
export default {
  props: ['id'],
  data() {
    return {
      selectedCoach: null
    }
  },
  computed: {
    fullName() {
      return `${this.selectedCoach.firstName} ${this.selectedCoach.lastName}`;
    },
    contactLink() {
      return `${this.$route.path}/${this.id}/contact`;
    },
    areas() {
      return this.selectedCoach.areas;
    },
    rate() {
      return  this.selectedCoach.rate
    }
  },
  created() {
    this.selectedCoach = this.$store.getters['coaches/coaches'].find(coach => coach.id === this.id);
  }
}
</script>