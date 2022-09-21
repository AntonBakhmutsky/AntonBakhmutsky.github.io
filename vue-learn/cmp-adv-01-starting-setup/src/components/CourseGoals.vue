<template lang="pug">

ul
  li(v-for="goal in goals" :key="goal")
    slot(:item="goal")
</template>

<script>
export default {
  data() {
    return {
      goals: ['Finish the course', 'Learn Vue'],
    }
  }
}
</script>