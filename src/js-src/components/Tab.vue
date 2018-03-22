<template>
    <div>
        <div v-show="isActive"><slot></slot></div>
    </div>
</template>

<script>
export default {
  props: {
    name: { required: true },
    selected: { default: false }
  },

  data() {
    return {
      isActive: false
    };
  },

  computed: {
    href() {
      return "#" + this.name.toLowerCase().replace(/ /g, "-");
    }
  },

  mounted() {
    this.isActive = this.selected;
  }
};
</script>

<style scoped>

</style>