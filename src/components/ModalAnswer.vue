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
              <p v-show="quesPass" class="help">“No one is useless in this world who lightens the burdens of another.” Thanks for your answer</p>
            </section>
            <footer class="modal-card-foot">
            <button class="button is-success" @click.prevent="submit"> Answer </button>
            <button class="button" @click="$emit('close')">Back</button>
            <a v-show="quesPass" :href='btnHref'><button class="button is-right is-primary">See What Others Have Said</button></a>
            </footer>
            </div>  
         <div class="modal-background"></div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
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
        params.table_name = "answers";
        params.append("answer", this.answer.replace(/(^\s+|\s+$)/g, ""));
        params.append("user_id", this.$root.userData.id);
        params.append("question_id", this.config.question.id);
        // ajax
        this.answer = "";
        axios.post("./api/add/", params).then(function(res) {
          if (res.data.msg == "success") {
            vm.answers = "";
            vm.quesPass = true;
            vm.btnHref = "/questions/" + res.data.question_id;
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
  background: url($path + "src/assets/bg_ans.jpg");
  z-index: -1;
}

.modal-card {
  box-shadow: bottom-shadow(4), top-shadow(4);
  border: 1px solid $dark-blue;
  border-radius: 2px;
}

.modal-card-head {
  border-bottom: solid 5px lighten($dark-blue, 5);
  .modal-card-title {
    color: $black;
  }
}
</style>