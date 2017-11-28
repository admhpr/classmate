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

            </section>
            <footer class="modal-card-foot">
            <button class="button is-success" @click.prevent="submit"> Answer </button>
            <button class="button" @click="$emit('close')">Cancel</button>
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
      errMsg: false
    };
  },
  methods: {
    submit() {
      if (this.answer == "" || this.answer.trim().length == 0) {
        this.error();
      } else {
        var params = new URLSearchParams();
        // nice terse regex stack overflow special
        params.table_name = "answers";
        params.append("answer", this.answer.replace(/(^\s+|\s+$)/g, ""));
        params.append("user_id", this.$root.userData.id);
        params.append("question_id", this.config.question.id);
        // ajax
        axios.post("./api/add/", params);
      }
    },
    error() {
      this.errMsg = true;
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../style/globals.scss";
.modal-background {
  background: url($path + "src/assets/bg_ans.jpg");
  z-index: -1;
}

.modal-card {
  box-shadow: bottom-shadow(4), top-shadow(4);
  border: 1px solid $light-green;
  border-radius: 2px;
}

.modal-card-head {
  background-color: lighten($dark-blue, 5);
  .modal-card-title {
    color: $white;
  }
}
</style>