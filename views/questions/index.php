<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-question" href="<?php echo ROOT_PATH; ?>questions/add">Question Something</a>
	<?php endif; ?>
	<?php var_dump($viewmodel); ?>
	<?php foreach($viewmodel as $question) : ?>
	<?php var_dump($question); ?>
		<div class="well">
			<h3><?php echo $question['title']; ?></h3>
			<small><?php echo $question['date_created']; ?></small>
			<hr />
			<p><?php echo $question['content']; ?></p>
			<br />
			<a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>questions/<?php echo $question['id']?>" target="_blank">View Answers</a>
		</div>
	<?php endforeach; ?>

	<!-- Vue potential -->
	<div id="app">
		<select v-model="selected">
			<ul>
				<option v-for="question in questions" :bind:value="question.title">{{ question.title }}
				</option>
			</ul>
			<span>Selected: {{ selected }}</span>
		</select>
		<br>
	   <input v-model="question">
		<div v-model="questions">
			<ul>
				<li v-for="question in questions">
				  <div class="well">
					<h3>{{ question.title | capitalize }}</h3>
					<small>{{ question.date_created }}</small>
					<hr>
					<p>{{ question.content }}</p>
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