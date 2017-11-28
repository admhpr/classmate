<template>
    <div class="main">
        <div>{{ message }}</div>
        <div>{{ cmData.id }}
            
        </div>

        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-info">
                        <p class="title">Hey there {{ cmData.first_name }}!</p>
                        <p class="subtitle">With an image</p>
                        <figure class="image is-4by3">
                            <img src="https://bulma.io/images/placeholders/640x480.png">
                        </figure>
                        </article>
                    </div>
                    <div class="tile is-parent is-vertical">
                        <article class="tile is-child notification is-primary">
                        <p class="title">About This ClassMate...</p>
                        <p class="subtitle">Bio:</p>
                        <div class="media-content">
                            <div class="content">
                                <strong>{{cmData.first_name + " " +  cmData.last_name }}</strong> <small>{{ '@'+ cmData.first_name + cmData.last_name }}</small> <small></small>
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
                             </div>
                        </div>
                        </article>
                        <article class="tile is-child notification is-warning">
                        <p class="title">...Answers</p>
                        <p class="subtitle">Lorem</p>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                <article class="tile is-child notification is-danger">
                    <p class="title">Questions</p>
                    <p class="subtitle">Aligned with the right tile</p>
                    <div class="content">
                    <!-- Content -->
                    </div>
                </article>
                </div>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-success">
                <div class="content">
                    <p class="title">Settings</p>
                    <p class="subtitle">With even more content</p>
                    <div class="content">
                    <!-- Content -->
                    </div>
                </div>
                </article>
            </div>
            </div>
    </div>
</template>

<script>
export default {
  props: ["cmData", "userData"],
  name: "UserProfile",
  data() {
    return {
      message: "test user"
    };
  }
};
</script>

<style lang="scss" >
@import "../styles/globals.scss";

.is-danger {
  background-color: $purple !important;
}
</style>