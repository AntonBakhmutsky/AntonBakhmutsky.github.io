<template lang="pug">
section
  BaseCard
    h2 Page not found
    p This page could not be found - maybe check out all our coaches.
    RouterLink(to="/coaches") Coaches
</template>

<script>
import BaseCard from "@/components/UI/BaseCard";
export default {
  components: {BaseCard}
}
</script>