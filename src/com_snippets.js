// question list
// Vue.component("cm-question-list", {
//   template: `<div><question v-for="question in questions">{{question.ques}}</question></div>`,

//   data() {
//     return {
//       questions: [
//         { ques: "1", test: true },
//         { ques: "2", test: false },
//         { ques: "3", test: true }
//       ]
//     };
//   }
// });

// // question
// Vue.component("question", {
//   template: "<li><slot></slot></li>"
// });

// // message
// Vue.component("cm-message", {
//   props: ["title", "body"],
//   data() {
//     return {
//       isVisible: true
//     };
//   },
//   template: `
//     	<article class="message" v-show="isVisible">
// 				<div class="message-header">
// 					{{ title }}
// 					<button class="delete" aria-label="delete" @click='hideMsg'></button>
// 				</div>
//         <div class="message-body">
//           {{ body }}
// 				</div>
//       </article>`,
//   methods: {
//     hideMsg() {
//       this.isVisible = false;
//     }
//   }
// });

// Vue.component("cm-modal", {
//   template: `
// 			<div class="modal is-active">
// 				<div class="modal-background"></div>
// 				<div class="modal-content">

// 					<div class="box">
// 						<p>
// 							<slot></slot>
// 						</p>
// 					</div>
// 				</div>
//         <button class="modal-close is-large" aria-label="close" @click="$emit('close')"></button>
//         </div>`
// });

Vue.component("tabs", {
  template: `
          <div>
           <div class="tabs is-centered">
              <ul>
                <li v-for="tab in tabs" :class="{ 'is-active' : tab.isActive }"> 
                  <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                </li> 
              </ul>
            </div>
            
            <div class="tabs-details">
              <slot></slot>
            </div>
          </div>
          `,
  data() {
    return { tabs: [] };
  },

  created() {
    this.tabs = this.$children;
  },
  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = tab.name == selectedTab.name;
      });
    }
  }
});

Vue.component("tab", {
  template: `
            <div v-show="isActive"><slot></slot></div>
            `,
  props: {
    name: { required: true },
    selected: { default: false }
  },

  data() {
    return {
      isActive: false
    };
  },

  computed: {
    href() {
      return "#" + this.name.toLowerCase().replace(/ /g, "-");
    }
  },
  mounted() {
    this.isActive = this.selected;
  }
});

new Vue({
  el: "#app",

  data: {
    showModal: false
  }
});
