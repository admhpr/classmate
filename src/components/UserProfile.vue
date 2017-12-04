<template>
    <div class="main">
        <div>{{ cmData.id }}
            
        </div>

        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-cm-info">
                        <p class="title">Hey there {{ cmData.first_name }}!</p>
                        <p class="subtitle">With an image</p>
                        <!-- <figure class="image is-4by3">
                            <img src="https://bulma.io/images/placeholders/640x480.png">
                        </figure> -->
                        <!-- Picture input component config -->
                        <div v-if="cmData.image_path">
                            <img :src="cmSrc" alt="Profile Picture">
                        </div>
                        <picture-input
                            v-else 
                            ref="pictureInput" 
                            @change="onChange" 
                            @remove="onRemoved"
                            width="600" 
                            height="600" 
                            margin="16" 
                            accept="image/jpeg,image/png" 
                            size="10" 
                            buttonClass="btn"
                            :removable="true"
                            :customStrings="{
                                upload: '<h1>Upload it!</h1>',
                                drag: 'Drag and drop your image here'
                            }">
                            </picture-input>
                            <button v-if="image" @click="attemptUpload" v-bind:class="{ disabled: !image }">
                                Upload
                            </button>
                        </article>
                    </div>
                    <div class="tile is-parent is-vertical">
                        <article class="tile is-child notification is-cm-primary">
                        <p class="title">About This ClassMate...</p>
                        
                        <div class="media-content">
                            <div class="content">
                                <p class="subtitle">Name:</p>
                                <strong>{{cmData.first_name + " " +  cmData.last_name }}</strong> <small>{{ '@'+ cmData.first_name + cmData.last_name }}</small> <small></small>
                                <br>
                                <br>
                                <p class="subtitle">Bio:</p>
                                <p>{{ cmData.bio }}</p>
                             </div>
                        </div>
                        </article>
                        <article class="tile is-child notification is-cm-warning">
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
                <article class="tile is-child notification is-cm-success">
                <div class="content">
                    <p class="title">Settings</p>
                    <p class="subtitle">With even more content</p>
                    <div class="content">
                    <!-- Content -->
                      <tabs>
                        <tab name="User Settings" :selected="true">
                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <input v-model="cmData.first_name" class="input" type="email" placeholder="Name">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-check"></i>
                                    </span>
                                 </div>
                            </div>
                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <input v-model="cmData.email" class="input" type="email" placeholder="Email">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-check"></i>
                                    </span>
                                 </div>
                            </div>
                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <input v-model="cmData.bio" class="input" type="email" placeholder="Bio">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-check"></i>
                                    </span>
                                 </div>
                            </div>
                        </tab>

                        <tab name="ClassMate List">
                        <h1>Here is the content for the about our culture tab.</h1>
                        </tab>

                        <tab name="Activity">
                        <h1>Here is the content for the about our vision tab.</h1>
                        </tab>
                      </tabs>
                    </div>
                </div>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
import PictureInput from "vue-picture-input";
import FormDataPost from "./upload";
import Tab from "./Tab.vue";
import Tabs from "./Tabs.vue";

export default {
  props: ["cmData", "userData"],
  components: {
    PictureInput,
    Tab,
    Tabs
  },
  name: "UserProfile",
  data() {
    return {
      image: "",
      cmSrc: this.cmData.image_path
    };
  },
  methods: {
    onChange() {
      console.log("New picture loaded");
      if (this.$refs.pictureInput.file) {
        this.image = this.$refs.pictureInput.file;
      } else {
        console.log("Old browser. No support for Filereader API");
      }
    },
    onRemoved() {
      this.image = "";
    },
    attemptUpload() {
      if (this.image) {
        FormDataPost("upload", this.image)
          .then(response => {
            if (response.data.success) {
              this.image = "";
              console.log("Image uploaded successfully ✨");
            }
          })
          .catch(err => {
            console.error(err);
          });
      }
    }
  }
};
</script>

<style lang="scss" >
@import "../styles/globals.scss";

.is-danger {
  border: $purple 5px solid !important;
  color: $black !important;
  background-color: transparent !important;
}
</style>