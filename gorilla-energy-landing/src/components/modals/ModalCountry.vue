<template lang="pug">
  ModalLayout(
    type="country"
    :active="active"
    @hide="hide"
  )
    .modal__country-title {{ $t('country.your') }} - ?
    button.modal__country-approve.more-btn(v-lazyload) {{ $t('country.approve') }}
    button.modal__country-change {{ $t('country.change') }}
</template>

<script>
import modals from '@/mixins/modals'

export default {
  name: 'ModalCountry',
  mixins: [modals]
}
</script>
