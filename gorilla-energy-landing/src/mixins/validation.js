export default {
  data () {
    return {
      formValidation: {
        errors: null,
        saving: false
      }
    }
  },
  computed: {
    isFormInvalid: vm => Object.keys(vm.fields).some(key => vm.fields[key].invalid),
    disabledButton: vm => vm.isFormInvalid || vm.formValidation.saving
  },
  methods: {
    clearError () {
      this.formValidation.errors = null
    },
    getError (field) {
      return this.errors.first(field) || this.formValidation.errors?.[field]?.[0] || null
    },
    isError (field) {
      return !!this.getError(field)
    }
  }
}
