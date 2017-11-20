<template>
      <div>
         <div>{{ message }}</div>
         <div :key="question.title" v-for="question in cmData">{{ question }}</div>
      </div>
</template>

<script>
export default {
  props: ["cmData"],
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
