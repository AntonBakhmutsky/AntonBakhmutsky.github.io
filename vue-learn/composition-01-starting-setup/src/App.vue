<template lang="pug">
section.container
  UserData(:first-name="firstName" :last-name="lastName" :age="uAge")
  button(@click="setAge") Change Age
  div
    input(type="text" placeholder="First Name" v-model="firstName")
    input(type="text" placeholder="Last Name" ref="lastNameInput")
    button(@click="setLastName") Set Lastname
</template>

<script>
import { ref, computed, reactive, watch, provide } from 'vue'
import UserData from '@/components/UserData';
export default {
  components: {
    UserData
  },
  setup() {
    // const uName = ref('Maximilian');
    const uAge = ref(31);

    const user = reactive({
      name: 'Maximilian',
      age: 31
    })

    const firstName = ref('');
    const lastName = ref('');
    const lastNameInput = ref(null);

    watch(uAge, function(newValue, oldValue) {
      console.log('Old age: ' + oldValue);
      console.log('New age: ' + newValue);
    });

    const uName = computed(function() {
      return firstName.value + ' ' + lastName.value;
    });

    function setFirstName(event) {
      firstName.value = event.target.value;
    }

    function setLastName() {
      lastName.value = lastNameInput.value.value;
    }

    provide('userAge', uAge)

    // console.log(isRef(uAge));
    // console.log(isReactive(user), user.age)
    // setTimeout(function() {
    //   user.name = 'Max';
    //   user.age = 32;
    // }, 2000)

    function setNewData() {
      uAge.value = 32;
    }

    return { user: user, setAge: setNewData, setFirstName, setLastName, userName: uName, firstName, lastNameInput, lastName, uAge }
  }
  // data() {
  //   return {
  //     userName: 'Maximilian',
  //   };
  // },
};
</script>

<style lang="sass">
*
  box-sizing: border-box

html
  font-family: sans-serif

body
  margin: 0

.container
  margin: 3rem auto
  max-width: 30rem
  border-radius: 12px
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26)
  padding: 1rem
  text-align: center
</style>