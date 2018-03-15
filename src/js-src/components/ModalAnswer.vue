<template>
    <div>
        <div class="modal is-active">
            <div class="modal-card">
            <header class="modal-card-head">
             <p class="modal-card-title">{{ config.question.title }}</p>
            <button class="delete" @click="$emit('close')" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
            <!-- Content ... -->
              <div class="field">
                <label class="label">
                  {{ config.question.content }}
                </label>
                <div class="control">
                    <textarea @keyup.shift.enter="submit" v-model="answer" class="textarea" :class="{'is-danger': errMsg }" type="text" placeholder="Give us your best answer punk!"></textarea>
                  <p v-show="errMsg" class="help is-danger"> You got to give us a little something.. </p>
                </div>
              </div>
              <transition name="fade">
                <p v-show="quesPass" class="help">Thanks for your answer!</p>
              </transition>
              </section>
              <footer class="modal-card-foot">
                <button class="button is-cm-warning" @click="$emit('close')">Back</button>
                <button class="button is-cm-success" @click.prevent="submit"> Answer </button>
                <transition name="fade">
                    <a v-show="quesPass" :href='btnHref'>
                      <button class="button is-pulled-right is-cm-primary">
                        See What Others Have Said
                      </button>
                    </a>
                </transition>
              </footer>
            </div>  
         <div class="modal-background"></div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import path from "../helpers/config";
export default {
  props: ["config"],
  data() {
    return {
      answer: "",
      errMsg: false,
      quesPass: false,
      btnHref: ""
    };
  },
  methods: {
    submit() {
      const vm = this;
      if (this.answer == "" || this.answer.trim().length == 0) {
        if (!this.errMsg) {
          this.errorHandler();
        }
      } else {
        if (this.errMsg) {
          this.errorHandler();
        }
        var params = new URLSearchParams();
        // nice terse regex stack overflow special
        params.append("table_name", "answers");
        params.append("answer", this.answer.replace(/(^\s+|\s+$)/g, ""));
        params.append("user_id", this.$root.userData.id);
        params.append("question_id", this.config.question.id);
        // ajax
        this.answer = "";
        axios.post("./api/add/", params).then(function(res) {
          if (res.data.result == "success") {
            vm.answers = "";
            vm.quesPass = true;
            vm.btnHref = path + "questions/" + res.data.question_id;
          }
        });
      }
    },
    errorHandler() {
      this.errMsg = !this.errMsg;
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../styles/globals.scss";
.modal-background {
  background: url("../assets/bg_ans.jpg");
  z-index: -1;
}

.modal-card {
  box-shadow: bottom-shadow(4), top-shadow(4);
  border: 1px solid $dark-blue;
  border-radius: 2px;
  margin: 5% 10% 5%;
  height: 95%;
  .modal-card-foot {
    align-items: center;
    & .button {
      flex-grow: 1;
      flex-basis: 0;
    }
  }
}

.modal-card-head {
  border-bottom: solid 5px lighten($dark-blue, 5);
  .modal-card-title {
    color: $black;
  }
}

// transitions
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.9s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>