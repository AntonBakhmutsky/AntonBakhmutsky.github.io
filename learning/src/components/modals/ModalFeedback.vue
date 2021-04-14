<template lang="pug">
  ModalLayout(
    type="message"
    :active="active"
    @hide="hide"
  )
    form.form.modal__form(@submit.prevent="onSubmit" ref="form")
      h2.form__header {{ $t('feedback.title') }}
      p.form__text.form__text_success(v-if="success") {{ $t('feedback.success') }}
      .form__container(v-else)
        p.form__text {{ $t('feedback.text') }}
        input(type="hidden" name="type" :value="typeId")
        input(type="hidden" name="locale" :value="$i18n.locale")
        BaseInput(
          :label="$t('feedback.fields.full_name')"
          name="full_name"
          v-model="form.full_name"
          v-validate="validation.full_name"
          :data-vv-as="$t('feedback.fields.full_name')"
          :error="getError('full_name')"
        )
        BaseInput(
          v-show="params.type !== 'become-rider'"
          :label="$t('feedback.fields.company_name')"
          name="company_name"
          v-model="form.company_name"
          :error="getError('company_name')"
        )
        BaseInput(
          v-show="params.type === 'become-rider'"
          :label="$t('feedback.fields.profile')"
          name="profile"
          v-model="form.profile"
          :error="getError('profile')"
        )
        BaseInput(
          :label="$t('feedback.fields.email')"
          name="email"
          v-model="form.email"
          v-validate="validation.email"
          :data-vv-as="$t('feedback.fields.email')"
          :error="getError('email')"
        )
        BaseInput(
          :label="$t('feedback.fields.phone')"
          name="phone"
          v-model="form.phone"
          v-validate="validation.phone"
          :data-vv-as="$t('feedback.fields.phone')"
          :error="getError('phone')"
        )
        BaseFile(
          :label="$t('feedback.fields.file')"
          name="file"
          :error="getError('file')"
        )
        BaseTextarea(
          :label="$t('feedback.fields.message')"
          name="message"
          v-model="form.message"
          v-validate="validation.message"
          :data-vv-as="$t('feedback.fields.message')"
          :error="getError('message')"
        )
        BaseSubmit(
          :label="$t('feedback.fields.send')"
          :disabled="disabledButton"
        )
    ModalPreloader(v-if="formValidation.saving")
</template>

<script>
import validation from '@/mixins/validation'
import modals from '@/mixins/modals'
import feedback from '@/api/feedback'
import BaseInput from '@/components/forms/BaseInput'
import BaseTextarea from '@/components/forms/BaseTextarea'
import BaseSubmit from '@/components/forms/BaseSubmit'
import BaseFile from '@/components/forms/BaseFile'
import ModalPreloader from '@/components/modals/ModalPreloader'

const initialState = () => ({
  success: false,
  form: {
    full_name: null,
    company_name: null,
    profile: null,
    email: null,
    phone: null,
    message: null
  }
})

export default {
  name: 'ModalFeedback',
  components: {
    ModalPreloader,
    BaseFile,
    BaseSubmit,
    BaseTextarea,
    BaseInput
  },
  mixins: [modals, validation],
  data: () => initialState(),
  computed: {
    typeId: vm => vm.params.type === 'become-rider' ? 2 : 1,
    validation: () => ({
      full_name: { required: true },
      email: { required: true, email: true },
      phone: { required: true },
      message: { required: true }
    })
  },
  methods: {
    initialState: () => initialState(),
    async onSubmit () {
      this.formValidation.saving = true

      try {
        await feedback.send(new FormData(this.$refs.form))
        this.$refs.form.reset()
        this.success = true
      } catch (error) {
        if (error.response?.status === 422) {
          this.formValidation.errors = error.response?.data?.error?.detail
        }
      }

      this.formValidation.saving = false
    }
  }
}
</script>
