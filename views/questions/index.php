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
			<a class="btn btn-default" href="<?php echo ROOT_PATH; ?>questions/<?php echo $question['id']?>" target="_blank">View Answers</a>
		</div>
	<?php endforeach; ?>

	<!-- Vue potential -->
	<div id="app">
		<ul>
			<li v-for="question in questions">{{ question }}</li>
		</ul>
	</div>
</div>
<script>
window.onload = () => {
	new Vue({
		el: '#app',
		data: {
			questions: [1,1,2]	
		},
		mounted(){
			axios.get('http://localhost/adv-web-final-project/api/all/questions')
				.then(response => this.questions = response.data)
		}
	})
}
</script>