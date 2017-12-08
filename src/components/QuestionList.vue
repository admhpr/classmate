<template>
  
         <div>
    
          <section class="container">
            <h1 class="title">Questions</h1>
            <h2 class="subtitle">Post your question here ..</h2>
            <hr id="hr">
          <div class="columns">
      

            <div class="column is-8">
              <div class="main">
                <div class="is-left" :key="index" v-for="(question, index) in filteredList">
                  <div class="card">
                    <header class="card-header">
                      <p class="card-header-title">
                        {{ question.title }} ?
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
                    <footer v-if="userData" class="card-footer">
                      <a @click="openModal(index)" class="card-footer-item cm-answer"> Answer </a>
                      <a :href="ques_href(question)" class="card-footer-item cm-view-answers">View Answers</a>
                      <a @click="showMsg(question.id) "v-if="userData.id == question.user_id" class="card-footer-item cm-delete">Delete</a>
                    </footer>
                    </div>
                  </div>
                </div>
              </div><!--end questions list -->
              <div class="column is-4 card ques-card">
              <a v-if="!userData" class="button is-cm-info is-block is-alt is-medium" href="users/login">Login and Do More</a>
              <a v-if="userData" class="button is-cm-info is-block is-alt is-medium" href="questions/add">Ask a Question</a>
              <aside class="menu">
                <div class="card ques-card">
                    <header class="card-header">
                  <p class="card-header-title">
                  
                  </p>
                  <a href="#" class="card-header-icon" aria-label="more options">
                    <span class="icon">
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </span>
                  </a>
                </header>
                <div class="card-content">
                  <div class="content">
                    <p class="menu-label">
                    <!-- Tags -->
                    <div>
                      <p class="control has-icons-left">
                        <input v-model="keyword"  class="input is-small" type="text" placeholder="Search">
                          <span class="icon is-small is-left">
                              <i class="fa fa-search"></i>
                          </span>
                        </p>
                    </div>
                    </div>
                    <footer class="card-footer">
                      <a href="#" class="card-footer-item">Popular</a>
                      <a href="#" class="card-footer-item">Recent</a>
                      <a href="#" class="card-footer-item">Rising</a>
                    </footer>
                  </div>
                </div>
                <message :cm-style="dangerMessage" v-if="message.show" @close="message.show = false">
                  <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                        You are about to delete this question
                        along with all associated answers..
                        is that what you want?
                  <br>
                  <br>
                  <a  @click="message.show = false" class="button is-text">Cancel</a>
                  <a @click="deleteQues(message.delId)" class="button is-danger">Delete</a>
                </message>
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
import path from "../helpers/config";
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
      dangerMessage: "message is-danger is-clearfix",
      sucessMessage: "message is-success is-clearfix",
      modalConfig: {
        show: false,
        question: null
      },
      message: {
        show: false,
        confirm: false,
        delId: ""
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
      return path + "users/profile/" + ques.user_id;
    },
    ques_href(ques) {
      return path + "questions/" + ques.id;
    },
    openModal(index) {
      (this.modalConfig.show = true),
        (this.modalConfig.question = this.cmData[index]);
    },
    showMsg(id) {
      this.message.delId = id;
      this.message.show = !this.message.show;
    },
    deleteQues(id) {
      this.message.show = true;
      var params = new URLSearchParams();
      // nice terse regex stack overflow special
      params.append("table_name", "questions");
      params.append("id", id.replace(/(^\s+|\s+$)/g, ""));
      // ajax
      this.message.show = false;
      axios.post("./api/delete/", params).then(function(res) {
        if (res.data.result == "success") {
          console.log("yo");
        }
      });
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
  border-left: 3px solid $dark-blue;
}

.ques-card {
  height: 200px;
  border-left: none;
  border-bottom: 3px solid $dark-blue;
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
