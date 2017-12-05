<template>
    <div>
         <div>
            <div class="tabs is-centered is-boxed">
                <ul>
                    <li v-for="(tab,i) in tabs" :key='i' :class="{ 'is-active': tab.isActive }">
                        <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                    </li>
                </ul>
            </div>
            <div class="tabs-details">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return { tabs: [] };
  },

  created() {
    this.tabs = this.$children;
  },

  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = tab.href == selectedTab.href;
      });
    }
  }
};
</script>

<style scoped>

</style>