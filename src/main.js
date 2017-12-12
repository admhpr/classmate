/**
 *  Main entry point to the application , this is were in the root Vue instance is intialised.
 *
 */

import scss from "./styles/app.scss";
// Vue is the main class of the framework
import Vue from "vue/dist/vue.esm.js";
import Bulma from "bulma";

// Root component of the framework
import Home from "./App.vue";
import QuestionList from "./components/QuestionList.vue";
import UserProfile from "./components/UserProfile.vue";
import NewModule from "./components/NewModule.vue";
import Tab from "./components/Tab.vue";
import Tabs from "./components/Tabs.vue";
import AnswerList from "./components/AnswerList.vue";
import Message from "./components/Message.vue";
import Category from "./components/Category.vue";

// registering child components
Vue.component("question-list", QuestionList);
Vue.component("user-profile", UserProfile);
Vue.component("categories", Category);
Vue.component("new-module", NewModule);
Vue.component("tabs", Tabs);
Vue.component("tab", Tab);
Vue.component("answer-list", AnswerList);
Vue.component("message", Message);


/**
 * @param {string} el: this is where the Vue application is rendered and mounted to div with the id of 'app'. See
 * ../views/main.php.
 *
 * @param {component} components: Add your single file component to be used throughout the app don't forget to create a div
 * with the id of vue in the corresponding view php for this to work
 */

new Vue({
  el: "#vue",
  components: {
    Home,
    QuestionList,
    UserProfile,
    Category,
    NewModule,
    AnswerList,
    Message
  },
  data: {
    cmData: "",
    userData: false,
    currentUserId: ""
  },
  created: function () {
    if (typeof cmData !== "undefined") {
      this.cmData = cmData;
    }

    if (typeof userData !== "undefined") {
      this.userData = userData;
    }
    if (typeof currentUserId !== "undefined") {
      this.currentUserId = currentUserId;
    }
  }
});
