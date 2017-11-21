<template>
    <div>
        <div class="modal is-active">
      
  
            <div class="modal-card">
            <header class="modal-card-head">
             <p class="modal-card-title">Answer</p>
            <button class="delete" @click="$emit('close')" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
            <!-- Content ... -->
            </section>
            <footer class="modal-card-foot">
            <button class="button is-success"> Answer </button>
            <button class="button" @click="$emit('close')">Cancel</button>
            </footer>
            </div>
           
         <div class="modal-background"></div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
@import "../style/vars.scss";
.modal-background {
  background-image: url("/adv-web-final-project/src/assets/hands.jpg");
  background-repeat: repeat-x;
  z-index: -1;
}
</style>