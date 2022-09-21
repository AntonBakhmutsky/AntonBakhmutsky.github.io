<template lang="pug">

BaseCard
  BaseButton(
    @click="setSelectedTab('stored-resources')"
    :mode="storedResButtonMode"
  ) Stored Resources
  BaseButton(
    @click="setSelectedTab('add-resource')"
    :mode="addResButtonMode"
  ) Add Resource
component(:is="selectedTab")

</template>

<script>
import StoredResources from '@/components/learning-resources/StoredResources';
import AddResource from '@/components/learning-resources/AddResource';

export default {
  components: {
    StoredResources,
    AddResource
  },
  data() {
    return {
      selectedTab: 'stored-resources',
      storedResources: [
        {
          id: 'official-guide',
          title: 'Official Guide',
          description: 'The official Vue.js documentation',
          link: 'https://vuejs.org'
        },
        {
          id: 'google',
          title: 'Google',
          description: 'Learn to google...',
          link: 'https://www.google.com'
        },
      ]
    }
  },
  computed: {
    storedResButtonMode() {
      return this.selectedTab === 'stored-resources' ? null : 'flat';
    },
    addResButtonMode() {
      return this.selectedTab === 'add-resources' ? null : 'flat';
    }
  },
  provide() {
    return {
      resources: this.storedResources
    }
  },
  methods: {
    setSelectedTab(tab) {
      this.selectedTab = tab;
    }
  }
}
</script>

<style lang="sass">

</style>