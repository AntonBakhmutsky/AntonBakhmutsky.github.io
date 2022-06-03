import Vue from 'vue'

class ModalPlugin {
  constructor () {
    this.event = new Vue()
  }

  show (name, params = {}) {
    this.event.$emit('show', name, params)
  }

  hide (name) {
    this.event.$emit('hide', name)
  }
}

Vue.prototype.$modal = new ModalPlugin()

export default Vue.prototype.$modal
