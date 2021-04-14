import Vue from 'vue'
import VeeValidate from 'vee-validate'
import VeeValidateLocaleRu from 'vee-validate/dist/locale/ru'
import VeeValidateLocaleEn from 'vee-validate/dist/locale/en'
import i18n from '@/plugins/i18n'

Vue.use(VeeValidate, {
  locale: i18n.locale,
  dictionary: {
    en: VeeValidateLocaleEn,
    ru: VeeValidateLocaleRu,
    kz: VeeValidateLocaleRu
  }
})
