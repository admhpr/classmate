<template>
    <div>
     <transition name="fade">
        <article :class="cmStyle">
            <div class="message-header">
                Classmate Message
                <button  @click="$emit('close')" class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
            <slot></slot>
            </div>
        </article>
     </transition>
    </div>
</template>

<script>
export default {
  props: ["cmStyle"],
  name: "message",
  data() {
    return {};
  }
};
</script>

<style scoped>

</style>