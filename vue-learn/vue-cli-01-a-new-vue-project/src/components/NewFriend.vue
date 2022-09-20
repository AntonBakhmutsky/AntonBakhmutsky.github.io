<template lang="pug">

form(ref="form" @submit.prevent="passNewFriend")
  div.grid
    .grid__item
      label(for="friendId") Friend ID:
      input#friendId(type="text" required v-model="id")
    .grid__item
      label(for="name") Friend name:
      input#name(type="text" v-model="name" required)
    .grid__item
      label(for="phone") Friend phone:
      input#phone(type="tel" required v-model="phone")
    .grid__item
      label(for="email") Friend email:
      input#email(type="email" required v-model="email")
    .grid__item
      input#favorite(type="checkbox" v-model="isFavorite")
      label(for="favorite") Are friend is favorite?
    button Add new friend

</template>

<script>
export default {
  emits: ['pass-new-friend'],
  data() {
    return {
      id: '',
      name: '',
      phone: '',
      email: '',
      isFavorite: false
    }
  },
  methods: {
    passNewFriend() {
      this.$emit('pass-new-friend', this.id, this.name, this.phone, this.email, this.isFavorite)
      this.$refs.form.reset();
      this.id = '';
      this.name = '';
      this.phone = '';
      this.email = '';
      this.isFavorite = false;
    }
  }
}
</script>

<style lang="sass">
  form
    width: 90%
    max-width: 40rem
    margin: 30px auto

    .grid
      display: grid
      grid-template-columns: repeat(2, 1fr)
      grid-gap: 25px
      align-items: center

      button
        height: 44px

      &__item
        font-size: 18px
        font-weight: 700

        &:not(:nth-child(5))
          flex-direction: column
          display: flex

        input:not([type="checkbox"])
          width: 100%
          height: 44px

</style>