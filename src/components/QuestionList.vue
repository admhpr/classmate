<template>
      <div>
         <div>{{ message }}</div>
         <div :key="question.title" v-for="question in json">{{ question }}</div>
      </div>
</template>

<script>
export default {
  props: ["json"],
  name: "QuestionList",
  data() {
    return {
      message: "Question Component test"
    };
  }
};
</script>

<style lang="scss" scoped>

</style>
