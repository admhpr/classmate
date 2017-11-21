/**
 *  Main entry point to the application , this is were in the root Vue instance is intialised.
 * 
 */

// Vue is the main class of the framework
import Vue from "vue/dist/vue.esm.js";
import Bulma from "bulma";

// Root component of the framework
import Home from "./App.vue";
import QuestionList from "./components/QuestionList.vue";
import UserProfile from "./components/UserProfile.vue";
import NewModule from "./components/NewModule.vue";

// registering child components
Vue.component("question-list", QuestionList);
Vue.component("user-profile", UserProfile);
Vue.component("new-module", NewModule);

/**
 * @param {string} el: this is were the Vue application is rendered and mounted to div with the id of 'app'. See 
 * ../views/main.php.
 * 
 * @param {component} components: Add your single file component to be used throughout the app don't forget to create a div
 * with the id of vue for this to work
 */

new Vue({
  el: "#vue",
  components: { Home, QuestionList, UserProfile, NewModule },
  data: {
    cmData: false
  },
  created: function() {
    if (typeof cmData != "undefined") {
      this.cmData = cmData;
    }
  }
});
