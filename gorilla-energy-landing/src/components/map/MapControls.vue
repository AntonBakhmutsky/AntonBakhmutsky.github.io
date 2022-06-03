<template lang="pug">
  .map__controls
    .map__controls-item.map__controls-item_plus(
      :class="{ 'map__controls-item_disabled': max }"
      v-lazyload
      ref="plus"
    )
    .map__controls-item.map__controls-item_minus(
      :class="{ 'map__controls-item_disabled': min }"
      v-lazyload
      ref="minus"
    )
</template>

<script>
export default {
  name: 'MapControls',
  props: {
    max: {
      type: Boolean,
      required: false
    },
    min: {
      type: Boolean,
      required: false
    }
  }
}
</script>
