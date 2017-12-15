<template>
      <div>
         <div>{{ message }}</div>
         <div :key="categories.title" v-for="categories in json">{{ categories }}</div>
      </div>
</template>

<script>
export default {
  props: ["cmData"],
  name: "Category",
  data() {
    return {
      message: "Category Component test"
    };
  }
};
</script>

<style lang="scss" scoped>

</style>