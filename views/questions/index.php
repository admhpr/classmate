<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-question" href="<?= ROOT_PATH ?>questions/add">Question Something</a>
	<?php endif; ?>
	<?php var_dump($viewmodel); ?>
	<!-- Vue potential -->
	<!-- <div id="app"> -->
		<!-- <select v-model="selected">
			<ul>
				<option v-for="question in questions">{{ question.title }}
				</option>
			</ul>
			<span>Selected: {{ selected }}</span> -->
		<!-- </select> -->
		<!-- <br>
		<div> -->
			<!-- <message title="Hello World" body="lorem dhdjsh dummy the quick brown fox jumped over the lazy dog"></message> -->

			<!-- <cm-modal v-if="showModal" @close="showModal = false">Here is the modal</cm-modal>
			<button @click="showModal = true">Show</button>
			</div> -->
	
	
	<!-- </div> -->
</div>
<script>
// window.onload = () => {
// 	var app = new Vue({
// 		el: '#app',
// 		data: {
// 			selected: "A",
// 			questions:<?php echo json_encode($viewmodel) ?>
// 		},
// 		mounted(){
// 			// axios.get('http://localhost/adv-web-final-project/api/all/questions')
// 			// 	.then(response => this.questions = response.data)
// 		}
// 	})
// }
</script>