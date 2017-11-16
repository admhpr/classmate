Vue.component("question-list", {
  template: `<div><question v-for="question in questions">{{question.ques}}</question></div>`,

  data() {
    return {
      questions: [
        { ques: "1", test: true },
        { ques: "2", test: false },
        { ques: "3", test: true }
      ]
    };
  }
});

Vue.component("question", {
  template: "<li><slot></slot></li>"
});

new Vue({
  el: "#app"
});
