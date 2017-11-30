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
import Categories from "./components/Categories.vue";
import NewModule from "./components/NewModule.vue";
import Avatar from "./components/Avatar.vue";
import SkewLoader from "./components/SkewLoader.vue";


// registering child components
Vue.component("question-list", QuestionList);
Vue.component("user-profile", UserProfile);
Vue.component("categories", Categories);
Vue.component("new-module", NewModule);
Vue.component("avatar", Avatar);
Vue.component("skew-loader", SkewLoader);


/**
 * @param {string} el: this is where the Vue application is rendered and mounted to div with the id of 'app'. See 
 * ../views/main.php.
 * 
 * @param {component} components: Add your single file component to be used throughout the app don't forget to create a div
 * with the id of vue in the corresponding view php for this to work
 */

new Vue({
  el: "#vue",
  components: { Home, QuestionList, UserProfile, Categories, NewModule, Avatar, SkewLoader },
  data: {
    cmData: false,
    userData: false
  },
  created: function () {
    if (cmData && typeof cmData != "undefined") {
      this.cmData = cmData;
    }

    if (userData) {
      this.userData = userData;
    }
  }
});
