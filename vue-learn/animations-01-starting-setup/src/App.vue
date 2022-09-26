<template lang="pug">
.container
  .block(:class="{animate: animatedBlock}")
  button(@click="animateBlock") Animate
.container
  transition(
    name="para"
    @before-enter="beforeEnter"
    @enter="enter"
    @after-enter="afterEnter"
    @before-leave="beforeLeave"
    @leave="leave"
    @after-leave="afterLeave"
  )
    p(v-if="paraIsVisible") This is only sometimes visible...
  button(@click="toggleParagraph") Toggle paragraph
.container
  transition(name="fade-button" mode="out-in")
    button(@click="showUsers" v-if="!usersAreVisible") Show Users
    button(@click="hideUsers" v-else) Hide Users
base-modal(@close='hideDialog' :open='dialogIsVisible')
  p This is a test dialog!
  button(@click='hideDialog') Close it!
.container
  button(@click='showDialog') Show Dialog
</template>  

<script>
export default {
  data() {
    return {
      dialogIsVisible: false,
      animatedBlock: false,
      paraIsVisible: false,
      usersAreVisible: false
    };
  },
  methods: {
    leave(el) {
      console.log('leave');
      console.log(el);
    },
    afterLeave(el) {
      console.log('afterLeave');
      console.log(el);
    },
    beforeEnter(el) {
      console.log('before Enter');
      console.log(el);
    },
    afterEnter(el) {
      console.log('after Enter');
      console.log(el);
    },
    enter(el) {
      console.log('enter');
      console.log(el);
    },
    beforeLeave(el) {
      console.log('before Leave');
      console.log(el);
    },
    animateBlock() {
      this.animatedBlock = !this.animatedBlock;
    },
    showDialog() {
      this.dialogIsVisible = true;
    },
    hideDialog() {
      this.dialogIsVisible = false;
    },
    toggleParagraph() {
      this.paraIsVisible = !this.paraIsVisible;
    },
    showUsers() {
      this.usersAreVisible = true;
    },
    hideUsers() {
      this.usersAreVisible = false;
    },
  },
};
</script>

<style lang="sass">
*
  box-sizing: border-box

html
  font-family: sans-serif

body
  margin: 0

button
  font: inherit
  padding: 0.5rem 2rem
  border: 1px solid #810032
  border-radius: 30px
  background-color: #810032
  color: white
  cursor: pointer

  &:hover, &:active
    background-color: #a80b48
    border-color: #a80b48

.block
  width: 8rem
  height: 8rem
  background-color: #290033
  margin-bottom: 2rem
  //transition: transform .3s

.container
  max-width: 40rem
  margin: 2rem auto
  display: flex
  justify-content: center
  align-items: center
  flex-direction: column
  padding: 2rem
  border: 2px solid #ccc
  border-radius: 12px

.animate
  //transform: translateX(-150px)
  animation: slide-scale .3s ease-out forwards

@keyframes slide-scale
  0%
    transform: translateX(0) scale(1)

  70%
    transform: translateX(-120px) scale(1.1)

  100%
    transform: translateX(-150px) scale(1)

.para-enter-from
  //opacity: 0
  //transform: translateY(-30px)


.para-enter-active
  animation: slide-scale .3s ease-out

.para-enter-to
  //opacity: 1
  //transform: translateY(0)

.para-leave-from
  //opacity: 1
  //transform: translateY(0)

.para-leave-active
  animation: slide-scale .3s ease-out

.para-leave-to
  //opacity: 0
  //transform: translateY(-30px)

.fade-button-enter-from, .fade-button-leave-to
  opacity: 0
.fade-button-enter-active
  transition: opacity .3s ease-out

.fade-button-enter-to, .fade-button-leave-from
  opacity: 1

.fade-button-leave-active
  transition:  opacity .3s ease-in
</style>