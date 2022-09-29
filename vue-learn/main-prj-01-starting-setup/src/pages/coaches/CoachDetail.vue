<template lang="pug">
section
  BaseCard
    h2 {{ fullName }}
    h3 {{ rate }}
section
  BaseCard
    header
      h2 Interested? Reach out now!
      BaseButton(link :to="contactLink" v-if="!isContact") Contact
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
    isContact() {
      return /contact/.test(this.$route.path);
    },
    fullName() {
      return `${this.selectedCoach.firstName} ${this.selectedCoach.lastName}`;
    },
    contactLink() {
      return `${this.$route.path}/contact`;
    },
    areas() {
      return this.selectedCoach.areas;
    },
    rate() {
      return  this.selectedCoach.hourlyRate;
    },
    description() {
      return this.selectedCoach.description;
    }
  },
  created() {
    this.selectedCoach = this.$store.getters['coaches/coaches'].find(coach => coach.id === this.id);
  }
}
</script>