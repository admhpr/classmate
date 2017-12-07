<template>
    <div>
        <li class="vote">
		    <span  @click="$emit('vote'); upvote();"><i class="fa fa-thumbs-up"></i></span>
            <span class="">{{ cmVotes }}</span>
		    <span @click="$emit('vote'); downvote();"><i class="fa fa-thumbs-down"></i></span>
	    </li>
    </div>
</template>

<script>
export default {
  props: ["votes"],
  name: "Upvote",
  data: function() {
    return {
      upvoted: false,
      downvoted: false,
      cmVotes: this.votes
    };
  },
  methods: {
    upvote: function() {
      this.cmVotes += 1;
    },
    downvote: function() {
      if (this.cmVotes) {
        this.cmVotes -= 1;
      }
    }
  }
};
</script>

<style scoped>
.vote {
  list-style: none;
  /*don't judge the minus margin */
  margin-top: -1em;
}
</style>