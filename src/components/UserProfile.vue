<template>
    <div class="main">
        <div>
            
        </div>

        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-cm-info">
                            <p class="title">Hey there {{ cmData.first_name }}!</p>
                    
                            <!-- Picture input component config -->
                            <div v-if="userData.image_path">
                                <img :src="cmSrc" alt="Profile Picture">
                            </div>
                           
                            <picture-input
                                v-if="userData.id == currentUserId" 
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
                                <div v-else>
                                    <img src="" alt="Profile Picture">
                                </div>
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

            <div v-if="cmData.id == currentUserId" class="tile is-parent">
                <article class="tile is-child notification is-cm-success">
                    <div class="content">
                        <p class="title">Settings</p>
                        <p class="subtitle">Make it your Own!</p>
                        <div class="content">
                        <!-- Content -->
                            <tabs>
                                
                                <tab name="User Settings" :selected="true">
                                    <div class="field">
                                        <div class="control has-icons-left has-icons-right">
                                            <input v-model="cmData.first_name" class="input" type="text" placeholder="Name">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-user"></i>
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
                                            <textarea v-model="cmData.bio" class="textarea" type="text" placeholder="Bio">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-info"></i>
                                            </span>
                                            <span class="icon is-small is-right">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <button @click="updateSettings" class="button is-text">Save</button>
                                        </div>
                                        <div class="control">
                                            <button @click="changePic" class="button is-text">Change Picture</button>
                                        </div>
                                        <!-- <div class="control">
                                            <button @click="cancel" class="button is-text">Cancel</button>
                                        </div> -->
                                    </div>
                                </tab>

                                <tab name="ClassMate List">
                                    <div v-for="(user, i) in userList" :key="i">
                                        <a :href="user_href(user)">@{{ user.first_name }}{{ user.last_name }}</a>
                                    </div>
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
import axios from "axios";
import path from "../helpers/config";

let axiosDefaults = require("axios/lib/defaults");
axiosDefaults.baseURL = path;

import PictureInput from "vue-picture-input";
import FormDataPost from "../helpers/upload";
import Tab from "./Tab.vue";
import Tabs from "./Tabs.vue";

export default {
  props: ["cmData", "userData", "currentUserId"],
  components: {
    PictureInput,
    Tab,
    Tabs
  },
  name: "UserProfile",
  data() {
    return {
      image: "",
      cmSrc: this.cmData.image_path,
      userList: []
    };
  },
  created() {
    axios.get("/api/all/users").then(res => {
      if (res.statusText == "OK") {
        res.data.forEach(u => {
          this.userList.push(u);
        });
      }
    });
  },
  methods: {
    user_href(user) {
      return "./" + user.id;
    },
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
        FormDataPost("users/upload", this.image)
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
    },
    updateSettings() {
      console.log("clicked");
    },
    changePic() {
      this.cmData.image_path = false;
    }
  }
};
</script>

<style lang="scss" >
@import "../styles/globals.scss";

$line: 5px;

.tile {
  color: $black !important;
  background-color: transparent !important;
  margin: $line;
  .is-cm-success {
    border-right: $green $line solid !important;
    .subtitle {
      border-bottom: $green $line * 2 solid !important;
    }
  }
  .is-cm-warning {
    border-left: $blue $line solid;
    .title {
      border-bottom: $blue $line solid;
    }
  }
  .is-cm-info {
    border-bottom: $light-green $line solid;
    p {
      border-right: $light-green $line * 6 solid;
    }
    .button {
      color: $black !important;
      background-color: transparent !important;
    }
  }
  .is-cm-primary {
    border-bottom: $light-purple $line solid;
  }
  &.is-child {
    background-color: $white !important;
    box-shadow: bottom-shadow(2), top-shadow(3);
  }
}
.is-danger {
  border-left: $purple $line solid !important;
  color: $black !important;
  background-color: transparent !important;
}
</style>