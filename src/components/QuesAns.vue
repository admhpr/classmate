<template>
        <div>
           
          <section class="container">
              
          <div class="columns">

            <div class="column is-8">
              <div class="main">
                <div class="is-left" :key="index" v-for="(question, index) in filteredList">
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
                        <a :href="user_href(question)">@{{ question.first_name }}{{ question.last_name }}</a>. YO <a href="#">#{{question.category}}</a>.
                        <br>
                        <time datetime="">{{question.date_created | dateFormat }}</time>.
                      </div>
                        <modal-answer v-if="modalConfig.show" @close="modalConfig.show = false" :config="modalConfig">

                        </modal-answer>
                    </div>
                    <footer v-if="userData" class="card-footer">
                      <a @click="openModal(index)" class="card-footer-item cm-answer"> Answer </a>
                      <a :href="ques_href(question)" class="card-footer-item cm-view-answers">View Answers</a>
                      <a @click="deleteQues(question.id) "v-if="userData.id == question.user_id" href="#" class="card-footer-item cm-delete">Delete</a>
                    </footer>
                    </div>
                  </div>
                </div>
              </div><!--end questions list -->
              <div class="column is-4">
              <a v-if="!userData" class="button is-cm-info is-block is-alt is-medium" href="users/login">Login and Do More</a>
              <a v-if="userData" class="button is-cm-info is-block is-alt is-medium" href="questions/add">Ask a Question</a>
              <aside class="menu">
                <p class="menu-label">
                  <!-- Tags -->
                   <div class="panel-block">
                    <p class="control has-icons-left">
                      <input v-model="keyword"  class="input is-small" type="text" placeholder="Search">
                      <span class="icon is-small is-left">
                        <i class="fa fa-search"></i>
                      </span>
                    </p>
                  </div>
                </p>
                <ul class="menu-list">
                  <!-- <li><a>Dashboard</a></li>
                  <li><a>Customers</a></li>
                  <li><a>Authentication</a></li>
                  <li><a>Payments</a></li>
                  <li><a>Transfers</a></li>
                  <li><a>Balance</a></li> -->
                </ul>
              </aside>
            </div>
          </div> <!--end columns -->
        </section>
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
  props: ["cmData", "userData", "currentUserId"],
  name: "QuestionList",
  components: { ModalAnswer },
  data() {
    return {
      keyword: "",
      message: "Question Component test",
      modalConfig: {
        show: false,
        question: null
      }
    };
  },
  computed: {
    filteredList() {
      return this.cmData.filter(question => {
        return question.title.toLowerCase().includes(this.keyword);
      });
    }
  },
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
  },
  deleteQues: {}
};
</script>

<style lang="scss" scoped>
@import "../styles/globals.scss";

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

.cm-delete {
  background-color: transparent;
  border-bottom: 4px solid $red;
  &:hover {
    border-bottom: 4px solid lighten($red, 10);
  }
}
</style>
