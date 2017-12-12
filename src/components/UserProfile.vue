<template>
<div>
    <div>
        <div v-if="currentUserId == cmData.user_id">
            <h1 class="title">Hey there {{ cmData.first_name }}!</h1>
            <h2 class="subtitle">This is your profile ..</h2>
         </div>
        <div v-else>
            <h1 class="title">Their name is {{ cmData.first_name }}!</h1>
            <h2 class="subtitle">This is their profile ..</h2>
        </div>
            <hr id="hr">
        </div>
    <div class="main">
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-cm-info">
                            <p class="title"></p>
                    
                            <!-- Picture input component config -->
                            <div v-if="cmData.image_path">
                                <img :src="cmData.image_path" alt="Profile Picture">
                            </div>
                           
                            <picture-input
                                v-if="currentUserId == cmData.user_id && !cmData.image_path" 
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
                                <p class="title">Name:</p>
                                <strong>{{cmData.first_name + " " +  cmData.last_name }}</strong> <small>{{ '@'+ name }}</small> <small></small>
                                <br>
                                <br>
                                <p class="title">Bio:</p>
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
                        <p class="subtitle">Make it your Own!</p>
                        <div class="content">
                        <!-- Content -->
                            <tabs>
                                
                                <tab v-if="cmData.user_id == currentUserId" name="User Settings" :selected="true">
                                    <div class="field">
                                        <div class="control has-icons-left has-icons-right">
                                            <input v-model="cmData.first_name" class="input" type="text" placeholder="First Name">
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
                                            <input v-model="cmData.last_name" class="input" type="text" placeholder="last Name">
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
                                            <button @click="updateSettings" class="button">Save</button>
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
      extraData: [],
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
    axios.get("/api/extra").then(res => {
      if (res.statusText == "OK") {
        res.data.forEach(d => {
          this.extraData.push(d);
        });
      }
    });
  },
  computed: {
    name() {
      return (
        this.cmData.first_name.replace(/\s/g, "") +
        this.cmData.last_name.replace(/\s/g, "")
      );
    }
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
            console.log(response);
            if (response.data.result == "success") {
              this.image = false;
              console.log("Image uploaded successfully ✨");
              location.reload();
            }
          })
          .catch(err => {
            console.error(err);
          });
      }
    },
    updateSettings() {
      var params = new URLSearchParams();
      // nice terse regex stack overflow special
      params.append("table_name", "users");
      params.append("user_id", this.cmData.user_id);
      params.append("bio", this.cmData.bio);
      params.append("email", this.cmData.email);
      params.append("first_name", this.cmData.first_name);
      params.append("last_name", this.cmData.last_name);
      // ajax
      axios.post("./api/add/", params).then(function(res) {
        if (res.data.result == "success") {
          cmData.map(item => {
            if (item.id == id) {
              item.is_active = 0;
            }
          });
        }
      });
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
.main {
  background-image: url($path + "src/assets/triangles.jpg");
}
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