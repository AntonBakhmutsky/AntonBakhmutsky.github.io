<template lang="pug">
  .select.select__filter.select_active(v-tap-outside="hide")
    .select__container
      .select__input(
        v-lazyload
        :class="{ 'select__input_active': active }"
        v-tap="toggle"
      )
        .select__item
          .select__text(v-lazyload) {{ value.name || placeholder }}
    .select__options(
      v-lazyload
      :class="{ 'select__options_active': active }"
    )
      .select__options-head(v-lazyload)
      .select__options-wrap(v-lazyload)
        .select__options-content(v-lazyload)
          .select__item(v-tap="() => select(null)")
            .select__text(v-lazyload) {{ placeholder }}
          .select__item(
            v-for="option in options"
            :key="option.code"
            v-tap="() => select(option)"
          )
            .select__text(v-lazyload) {{ option.name }}
</template>

<script>

export default {
  name: 'SelectFilter',
  props: {
    placeholder: {
      type: String,
      required: true
    },
    value: {
      type: Object,
      required: true
    },
    options: {
      type: Array,
      required: true
    }
  },
  data: () => ({
    active: false
  }),
  methods: {
    hide () {
      this.active = false
    },
    toggle () {
      this.active = !this.active
    },
    select (option) {
      this.active = false
      this.$emit('input', option)
    }
  }
}
</script>
