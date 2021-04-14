<template lang="pug">
  .riders__filter.animated
    .riders__filter-switch
      template(v-for="(item, index) in categories")
        .riders__filter-switch-item(
          :key="item.code"
          :class="{'riders__filter-switch-item_selected': item.code === category.code }"
          v-tap="() => SET_CATEGORY(item)"
          v-lazyload
        ) {{ item.name }}
        .riders__filter-switch-delimiter(
          v-if="index < categories.length - 1"
          v-lazyload
        )
    .riders__filter-discipline(v-lazyload)
      SelectFilter(
        :placeholder="$t('riders.placeholder')"
        :options="disciplines"
        :value="discipline"
        @input="SET_DISCIPLINE"
      )
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import SelectFilter from '@/components/forms/SelectFilter'
import { mapGetters, mapState, mapMutations } from 'vuex'

export default {
  name: 'RidersFilter',
  components: { SelectFilter },
  computed: {
    ...mapState('riders', ['category', 'discipline']),
    ...mapGetters('riders', ['categories', 'disciplines'])
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          duration: 200,
          easing: 'linear'
        })
      }, 'bottom')
    })
  },
  methods: {
    ...mapMutations('riders', ['SET_CATEGORY', 'SET_DISCIPLINE'])
  }
}
</script>
