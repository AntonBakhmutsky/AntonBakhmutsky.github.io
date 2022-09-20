<template lang="pug">

section
  base-card
    template(v-slot:header)
      h3 {{ fullName }}
      base-badge(:type="role" :caption="role.toUpperCase()")
    template(v-slot:default)
      p {{ infoText }}

</template>

<script>
export default {
  props: ['fullName', 'infoText', 'role'],
};
</script>

<style scoped>
section div {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>