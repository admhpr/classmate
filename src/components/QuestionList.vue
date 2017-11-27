<template>
      <div>
         <div :key="question.title" v-for="(question, index) in cmData">
           <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                {{ question.title }}
              </p>
              <a href="#" class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
              </a>
            </header>
            <div class="card-content">
              <div class="content">
                
                <div class="box">{{ question.content }} </div>
                <span>asked by:</span>
                <a :href="user_href(question)">@{{ question.first_name }}{{ question.last_name }}</a>. In <a href="#">#{{question.category}}</a>.
                <br>
                <time datetime="">{{question.date_created | dateFormat }}</time>.
              </div>
                <modal-answer v-if="modalConfig.show" @close="modalConfig.show = false" :config="modalConfig">

                </modal-answer>
            </div>
            <footer class="card-footer">
              <a @click="openModal(index)" class="card-footer-item cm-answer"> Answer </a>
              <a :href="ques_href(question)" class="card-footer-item cm-view-answers">View Answers</a>
              <a href="#" class="card-footer-item">Delete</a>
            </footer>
          </div>
         </div>
        </div>
      </div>
</template>

<script>
import axios from "axios";
import Vue from "vue/dist/vue.esm.js";
import ModalAnswer from "./ModalAnswer.vue";

Vue.component("modal-answer", ModalAnswer);

export default {
  props: ["cmData", "userData"],
  name: "QuestionList",
  components: { ModalAnswer },
  data() {
    return {
      message: "Question Component test",
      modalConfig: {
        show: false,
        question: null
      }
    };
  },
  computed: {},
  methods: {
    user_href(ques) {
      return "users/profile/" + ques.user_id;
    },
    ques_href(ques) {
      return "questions/" + ques.id;
    },
    openModal(index) {
      (this.modalConfig.show = true),
        (this.modalConfig.question = this.cmData[index]);
    }
  },
  filters: {
    dateFormat(date) {
      return date.substring(0, date.length - 3);
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../style/globals.scss";

.card {
  margin: 2%;
  box-shadow: bottom-shadow(2), top-shadow(3);
}
.cm-answer {
  background-color: transparent;
  border-bottom: 4px solid $blue;
  &:hover {
    border-bottom: 4px solid $dark-blue;
  }
}

.cm-view-answers {
  background-color: transparent;
  border-bottom: 4px solid $green;
  &:hover {
    border-bottom: 4px solid $light-purple;
  }
}
</style>
