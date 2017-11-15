<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-question" href="<?= ROOT_PATH ?>questions/add">Question Something</a>
	<?php endif; ?>
	<?php var_dump($viewmodel); ?>
	<!-- Vue potential -->
	<div id="app">
		<select v-model="selected">
			<ul>
				<option v-for="question in questions">{{ question.title }}
				</option>
			</ul>
			<span>Selected: {{ selected }}</span>
		</select>
		<br>
		<div>
			<ul>
				<li v-for="question in questions">
				  <div class="well">
					<h3>{{ question.title }}</h3>
					<small>Asked: {{ question.date_created }}</small>
					<span class="pull-right">Category: <h4><mark>{{ question.category }}</mark></h4></span>
					<hr>
					<p>{{ question.content }}</p>
				  <a class="btn btn-primary"  :href="<?= ROOT_PATH ?> + 'questions/'  + question.id" target="_blank">View Answers</a>
				  </div>
				</li>
			</ul>			
		</div>
	</div>
</div>
<script>
window.onload = () => {
	var app = new Vue({
		el: '#app',
		data: {
			selected: "A",
			questions:<?php echo json_encode($viewmodel) ?>
		},
		mounted(){
			// axios.get('http://localhost/adv-web-final-project/api/all/questions')
			// 	.then(response => this.questions = response.data)
		}
	})
}
</script>