<template lang="pug">

div
  the-header
  badge-list
  user-info(
    :full-name="activeUser.name"
    :info-text="activeUser.description"
    :role="activeUser.role"
  )

</template>

<script>
export default {
  data() {
    return {
      activeUser: {
        name: 'Maximilian Schwarzmüller',
        description: 'Site owner and admin',
        role: 'admin',
      },
    };
  },
};
</script>

<style>
html {
  font-family: sans-serif;
}

body {
  margin: 0;
}
</style>