import Modal from '@/plugins/modals'
import ModalLayout from '@/components/modals/ModalLayout'

export default {
  data: () => ({
    active: false,
    params: {}
  }),
  components: {
    ModalLayout
  },
  beforeMount () {
    Modal.event.$on('show', (name, params) => {
      if (name !== this.$options.name) {
        return false
      }

      this.show(name, params)
    })

    Modal.event.$on('hide', () => {
      this.hide()
    })
  },
  methods: {
    initialState: () => ({}),
    show (name, params) {
      this.params = params
      this.active = true
      Object.assign(this.$data, this.initialState())
    },
    hide () {
      this.active = false
    }
  }
}
