<template>
  <div>
    <div v-if="!canViewProfile">

      <div class="card">
        <div class="card-content">
          <p class="title">
            Whoa Whoa easy, this is an area for resgistered users only...
          </p>
          <p class="subtitle">
            Feel free to login if you already have an account or resgister to see this users profile
          </p>
        </div>
        <footer class="card-footer">
          <p class="card-footer-item">
            <span>
              Login
              <a href="/users/login">Here</a>
            </span>
          </p>
          <p class="card-footer-item">
            <span>
              Register
              <a href="/users/register">Here</a>
            </span>
          </p>
        </footer>
      </div>

    </div>
    <div v-else>
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
                <transition class="">
                  <article class="tile is-child notification is-cm-info">
                    <p class="title">
                      Role : {{ role }}
                    </p>

                    <!-- Picture input component config -->
                    <div v-if="cmData.image_path" class="">
                      <img class="animated zoomInRight" :src="cmData.image_path" alt="Profile Picture">
                    </div>

                    <picture-input v-if="currentUserId == cmData.user_id && !cmData.image_path" ref="pictureInput" @change="onChange" @remove="onRemoved"
                      width="600" height="600" margin="16" accept="image/jpeg,image/png" size="10" buttonClass="btn" :removable="true"
                      :customStrings="{
                                      upload: '<h1>Upload it!</h1>',
                                      drag: 'Drag and drop your image here'
                                  }">
                    </picture-input>

                    <button class="btn-secondary button secondary upload" v-if="image" @click="attemptUpload" v-bind:class="{ disabled: !image }">
                      Upload
                    </button>
                  </article>

                </transition>
              </div>

              <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-cm-primary">
                  <p class="title">About This ClassMate...</p>

                  <div class="media-content">
                    <div class="content">
                      <p class="subtitle">Name:</p>
                      <strong class="info">{{cmData.first_name + " " + cmData.last_name }}</strong>
                      <small>{{ '@'+ name }}</small>
                      <small></small>
                      <br>
                      <br>
                      <p class="subtitle">Bio:</p>
                      <p class="bio">{{ cmData.bio }}</p>
                    </div>
                  </div>
                </article>
                <article class="tile is-child notification is-cm-warning animated fadeInUp">
                  <p class="title">...Answers</p>
                  <p class="subtitle"></p>
                </article>
              </div>
            </div>

            <a v-if="userData" href="/questions/add">
              <div class="tile is-parent animated fadeInRight">
                <article class="tile is-child notification is-danger">
                  <p class="title">Ask A Question</p>
                  <p class="subtitle"></p>
                  <div class="content">
                  </div>
                </article>
              </div>
            </a>
          </div>

          <div class="tile is-parent">
            <article class="tile is-child notification is-cm-success animated fadeInRight">
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
                            <i :class="{'fa': true, 'fa-user': true}"></i>
                          </span>
                          <span class="icon is-small is-right">
                            <i :class="{'fa': true, 'fa-check': true, 'saved': isSaved}"></i>
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
                            <i :class="[{ 'saved': isSaved},'fa','fa-check']"></i>
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
                            <i :class="[{ 'saved': isSaved},'fa','fa-check']"></i>
                          </span>
                        </div>
                      </div>
                      <div class="field">
                        <div class="control has-icons-left has-icons-right">
                          <textarea v-model="cmData.bio" class="textarea" type="text" placeholder="Bio">
                            <span class="icon is-small is-left">
                              <i class="fa fa-info"></i>
                            </span>
                          </textarea>
                          <span class="icon is-small is-right">
                            <i class="[{ 'saved': isSaved},'fa','fa-check']"></i>
                          </span>
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
                        <transition name="">
                          <article v-show="isSaved" class="cmMsg animated lightSpeedIn">
                            <div>
                              <p>Success</p>
                            </div>
                            <div class="content message-body">
                              <span class="icon is-small is-right">
                                <i :class="[{ 'saved': isSaved},'fa','fa-check', 'fa-2x']"></i>
                              </span>
                            </div>
                          </article>
                        </transition>
                      </div>
                    </tab>

                    <tab name="ClassMate List">
                      <aside class="menu">
                        <ul class="menu-list" v-for="(user, i) in userList" :key="i">
                          <li>
                            <a :href="user_href(user)">@{{ user.first_name }}{{ user.last_name }}</a>
                          </li>
                        </ul>
                      </aside>
                    </tab>
                    <!-- 
                                  <tab name="Activity">
                                  <h1>Here is the content for the about our vision tab.</h1>
                                  </tab> -->

                  </tabs>
                </div>
              </div>
            </article>
          </div>
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
      canViewProfile: this.cmData,
      extraData: [],
      userList: [],
      isSaved: false,
      role: "User"
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
        // res.data.forEach(d => {
        //   this.extraData.push(d);
        // });
      }
    });
    this.cmData.role_id > 1
      ? (this.role = "Teacher")
      : (this.role = "ClassMate");
  },
  computed: {
    name() {
      let trim = /\s/g;
      let fullName = "";
      if (this.canViewProfile) {
        let fullName =
          this.cmData.first_name.replace(trim, "") +
          "" +
          this.cmData.last_name.replace(trim, "");
      }
      return fullName;
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
      // let self = this;
      var params = new URLSearchParams();
      // nice terse regex stack overflow special
      params.append("table_name", "users");
      params.append("user_id", this.cmData.user_id);
      params.append("bio", this.cmData.bio);
      params.append("email", this.cmData.email);
      params.append("first_name", this.cmData.first_name);
      params.append("last_name", this.cmData.last_name);

      // ajax
      axios.post("/api/add/", params).then(
        function(res) {
          if (res.data.result == "success") {
            this.isSaved = true;
            setTimeout(() => {
              this.isSaved = false;
            }, 2000);
          }
        }.bind(this)
      );
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
  aside {
    background-color: darken($green, 11);
    ul {
      background-color: $green;
      li {
        list-style-type: none;
      }
    }
  }
  background-image: url("../assets/mem.png");
  .title {
    padding: 11px;
    border-radius: 3px;
  }
  .btn {
    color: $black;
  }
}
.cmMsg {
  margin-left: 33%;
  .message-body {
    background: $white;
  }
}
.saved {
  color: $light-green !important;
}
.tile {
  color: $white !important;
  background-color: transparent !important;
  margin: $line;
  .info {
    font-size: 2em;
  }
  .bio {
    font-size: 1.5em;
  }
  .is-cm-success {
    .title {
      background: $green;
    }
    img {
      z-index: -1;
    }
    background: lighten($green, 10) !important;
    border-right: $green $line solid !important;
    .subtitle {
      border-bottom: $green $line * 2 solid !important;
    }
  }
  .is-cm-warning {
    background: lighten($blue, 20) !important;
    border-left: $blue $line solid;
    .title {
      color: darken($blue, 23) !important;
      border-bottom: $white $line solid;
    }
  }
  .is-cm-info {
    color: $black;
    border-bottom: $light-green $line solid;
    p {
      border-right: $light-green $line * 6 solid;
    }
    .title {
      color: darken($green, 23) !important;
      border-bottom: $light-green 3px solid;
      background: $white;
    }
    .button {
      color: $black !important;
      background-color: transparent !important;
    }
    .upload {
      border: 2px $light-green solid !important;
    }
    .picture-inner-text {
      color: $black;
    }
  }
  .is-cm-primary {
    background: lighten($light-purple, 20) !important;
    border-bottom: $light-purple $line solid;
    max-width: 700px;
    .title {
      background: $light-purple;
      padding: 11px;
      border-radius: 3px;
    }
    .content {
      background: $white;
      padding: 0.5em;
      color: lighten($black, 20);
      border-radius: 5px;
      word-wrap: break-word;
    }
  }
  &.is-child {
    // background-color: $white !important;
    box-shadow: bottom-shadow(2), top-shadow(3);
  }
}
.is-danger {
  .title {
    background: $purple;
  }
  background: lighten($purple, 10) !important;
  border-left: $purple $line solid !important;
  color: $white !important;
}
</style>