<template lang="pug">
  a.social-card.animated(
    v-lazyload
    :href="item.link"
    target="_blank"
    rel="noopener noreferrer"
  )
    img(v-lazyload :data-src="item.image" alt="")
    .social-card__icon(v-lazyload :class="`social-card__icon_${icon}`")
</template>

<script>
export default {
  name: 'SocialsListItem',
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: {
    link: vm => vm.item.link || '',
    icon: vm => vm.link.includes('vk') ? 'vk'
      : vm.link.includes('facebook') ? 'facebook'
        : vm.link.includes('instagram') ? 'instagram'
          : ''
  }
}
</script>
