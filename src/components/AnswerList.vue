<template>
        <div>
           
          <section class="container">
            <h1 class="title">Answers</h1>
            <h2 class="subtitle">Give your best answer!</h2>
            <hr id="hr">
          <div class="columns">

            <div class="column is-8">
              <div class="main">
                <!--question-->
                 <div class="card ques-card">
                    <header class="card-header">
                      <p class="card-header-title">
                        {{ cmData[0].title }}  ?
                      </p>
                      <!-- <span class="card-header-icon">
                        <i class="fa fa-question" aria-hidden="true"></i>
                      </span> -->

                      <a  class="card-header-icon" aria-label="more options">
                        <span class="icon">
                          <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                      </a>
                    </header>
                    <div class="card-content">
                      <div class="content">
                        
                        <div class="box">{{ cmData[0].content }} </div>
                        <span>asked by:</span>
                        <a :href="user_href(cmData[0])">@{{ cmData[0].first_name }}{{ cmData[0].last_name }}</a>. In <a href="#">#{{cmData[0].category}}</a>.
                        <br>
                        <time datetime="">{{cmData[0].date_created | dateFormat }}</time>.
                        
                      </div>
                    </div>
                    <footer v-if="userData.id == cmData[0].ques_user_id" class="card-footer">
                      <a @click="deleteQues(cmData[0].id)" class="card-footer-item">Edit</a>
                      <a @click="showMsg(cmData[0]); quesClick();" class="card-footer-item cm-delete">Delete</a>
                    </footer>
                </div> <!-- end question --> 

                <div class="is-left" :key="index" v-for="(question, index) in filteredList">
                  <div class="card animated fadeInUp">
                    <header class="card-header">
                      <p class="card-header-title">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        Answer #{{ index +1 }} <!-- humans start counting at one -->
                      </p>
                      <a class="card-header-icon" aria-label="more options">
                        <span class="icon">
                          <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                      </a>
                    </header>
                    <div class="card-content">
                      <div class="content">
                        
                        <div class="box">{{ question.answer_content }} </div>
                        <div v-if="!filteredList[0].hasOwnProperty('ans_id')">
                          <a  @click="openModal(0)" class="button is-text">Yes</a>
                          <a  href="../questions" class="button is-text">No</a>
                        </div>
                          <span>answered by:</span>
                        <a :href="user_href(question)">@{{ question.first_name }}{{ question.last_name }}</a>
                        <br>
                        <time datetime="">{{question.answer_created | dateFormat }}</time>.
                      </div>
                        <modal-answer v-if="modalConfig.show" @close="modalConfig.show = false" :config="modalConfig">
                       </modal-answer>
                      <div v-if="cmData[0].answer_id">
                       <!-- check if user is admin or dev -->
                        <star-rating v-if="userRole.roleId > 1 && userData.id != question.user_id" :star-size="20" inactive-color="#A9A9A9" active-color="#FFD700"></star-rating>
                        <div v-if="userData.id != question.user_id" class="votes">
                          <upvote @vote="vote(index)" :votes="question.total_votes" :has-voted="question.user_vote_id"></upvote>
                        </div>
                      </div>
                    </div>
                    <footer v-if="userData" class="card-footer">
                      <a @click="deleteQues(question.id) "v-if="userData.id == question.user_id" class="card-footer-item">Edit</a>
                      <a @click="showMsg(question) "v-if="userData.id == question.user_id" class="card-footer-item cm-delete">Delete</a>
                    </footer>
                    </div>
                  </div>
                </div>
              </div><!--end questions list -->
              <div class="column is-4 card  animated bounceInRight">
              <a v-if="!userData" class="button is-cm-info is-block is-alt is-medium" href="users/login">Login and Answer</a>
              <a v-if="userData" @click="openModal(0)" class="button is-cm-success is-block is-alt is-medium">Answer Question</a>
              <aside class="menu">
                 <div class="card ans-card">
                    <header class="card-header">
                  <p class="card-header-title">
                  Total Answers: {{ filteredList.length }}
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
                      <a @click="popSort" class="card-footer-item">Popular</a>
                      <a class="card-footer-item">Latest</a>
                      <a class="card-footer-item">Rising</a>
                    </footer>
                  </div>
                </div>
                  <message :cm-style="dangerMessage" v-if="message.show" @close="message.show = false">
                    <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                          You are about to delete something which cannot be recovered
                          is that what you want?
                    <br>
                    <br>
                    <a  @click="message.show = false" class="button is-text">Cancel</a>
                    <a @click="deleteQues(message.delId)" class="button is-danger">Delete</a>
                  </message>
                <ul class="menu-list">
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
import StarRating from "vue-star-rating";
import Upvote from "./Upvote.vue";

Vue.component("modal-answer", ModalAnswer);
Vue.component("upvote", Upvote);

export default {
  props: ["cmData", "userData", "currentUserId"],
  name: "AnswerList",
  components: { ModalAnswer, StarRating },
  data() {
    return {
      keyword: "",
      message: "Question Component test",
      popular: "",
      dangerMessage: "message is-danger is-clearfix",
      sucessMessage: "message is-success is-clearfix",
      quesClicked: false,
      modalConfig: {
        show: false,
        question: null
      },
      message: {
        show: false,
        confirm: false,
        delId: ""
      },
      userRole: {
        role: this.userData.role,
        roleId: this.userData.role_id
      },
      rating: "No Rating Selected",
      currentRating: "No Rating",
      currentSelectedRating: "No Current Rating",
      boundRating: 3,
      cmD: this.cmData
    };
  },
  computed: {
    filteredList() {
      if (this.cmData[0].answer_content && this.cmData.length > 1) {
        return this.cmD.filter(question => {
          if (question.is_active > 0) {
            if (this.keyword.length > 0) {
              this.popular = "";
            }
            if (typeof this.popular == "number") {
              return this.cmData.sort((a, b) => {
                return b.total_votes - a.total_votes;
              });
            }
            return question.answer_content.toLowerCase().includes(this.keyword);
          }
        });
      } else {
        cmData = {
          answer_content:
            "Looks like there no answers for this one can you help out?",
          first_name: "none one"
        };
        return [cmData];
      }
    }
  },
  methods: {
    user_href(ques) {
      if (this.cmData[0].answer_id) {
        return path + "users/profile/" + ques.user_id;
      }
    },
    ques_href(ques) {
      return path + "questions/" + ques.id;
    },
    openModal(index) {
      (this.modalConfig.show = true),
        (this.modalConfig.question = this.cmData[index]);
    },
    //methods for star rating
    setRating(rating) {
      this.rating = "You have Selected: " + rating + " stars";
    },
    quesClick() {
      console.log("yo");
      this.quesClicked = true;
    },
    showMsg(obj) {
      if (this.quesClicked) {
        this.message.delId = obj.id;
      } else {
        this.message.delId = obj.answer_id;
      }
      this.message.show = !this.message.show;
    },
    showCurrentRating(rating) {
      this.currentRating =
        rating === 0
          ? this.currentSelectedRating
          : "Click to select " + rating + " stars";
    },
    setCurrentSelectedRating(rating) {
      this.currentSelectedRating = "You have Selected: " + rating + " stars";
    },
    //end of star methods
    vote(i) {
      var params = new URLSearchParams();
      params.append("user_vote_id", userData.id.replace(/(^\s+|\s+$)/g, ""));
      params.append("ans_id", cmData[i].answer_id);
      params.append("total_votes", this.$children[i].cmVotes + 1);
      // ajax
      axios.post("./api/vote/", params).then(function(res) {
        if (res.data.result == "success") {
        }
      });
      console.log("voted");
    },
    deleteQues(id) {
      let self = this;
      this.message.show = true;
      var params = new URLSearchParams();
      if (this.quesClicked) {
        params.append("table_name", "questions");
      } else {
        params.append("table_name", "answers");
      }
      // nice terse regex stack overflow special
      params.append("id", id.replace(/(^\s+|\s+$)/g, ""));
      // ajax
      this.message.show = false;
      axios.post("./api/delete/", params).then(function(res) {
        if (res.data.result == "success") {
          self.cmD = self.cmD.filter(q => {
            if (q.answer_id == res.data.id) {
              q.is_active = 0;
            }
            return q.is_active > 0;
          });
          self.keyword = "";
        }
      });
    },
    popSort() {
      this.popular = 1;
    }
  },
  filters: {
    dateFormat(date) {
      if (date) {
        return date.substring(0, date.length - 3);
      }
    }
  },
  openModal(index) {
    (this.modalConfig.show = true),
      (this.modalConfig.question = this.cmData[index]);
  }
};
</script>

<style lang="scss" scoped>
@import "../styles/globals.scss";

.card {
  margin: 2%;
  box-shadow: bottom-shadow(2), top-shadow(3);
  border-left: 3px solid $green;
}

.votes {
  float: right;
}
.ans-card {
  height: 200px;
  border-left: none;
  border-bottom: 3px solid $green;
}

.ques-card {
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
