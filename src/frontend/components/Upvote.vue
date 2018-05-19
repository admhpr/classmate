<template>
    <div>
        <li class="vote">
		    <span v-if="showThumbs" class="button" @click="$emit('vote'); upvote();">
          <i class="fa fa-thumbs-up fa-2x"></i>
        </span>
            <span class="tag">  {{ cmVotes }}  </span>
		    <span v-if="showThumbs" class="button" @click="$emit('vote'); downvote();">
          <i class="fa fa-thumbs-down fa-2x"></i>
        </span>
	    </li>
    </div>
</template>

<script>
export default {
  props: ["votes", "hasVoted"],
  name: "Upvote",
  data: function() {
    return {
      upvoted: false,
      downvoted: false,
      cmVotes: Number(this.votes)
    };
  },
  computed: {
    showThumbs() {
      this.hasVoted != this.$parent.userData.id;
    }
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

<style lang="scss" scoped>
@import "../styles/globals.scss";
.vote {
  list-style: none;
  /* don't mind the minus margin */
  margin-top: -1em;
  .tag {
    padding: 20px;
    font-size: 1em;
    font-weight: 800;
    border-bottom: 3px solid $green;
  }
}
</style>