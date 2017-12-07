<!-- <?php var_dump($viewmodel); ?> -->


<script>
    var cmData = <?php echo(json_encode($viewmodel)) ?>;
    <?php if( isset($_SESSION['is_logged_in'])): ?>
		var userData = <?php echo(json_encode($_SESSION['user_data'])); ?>;
	<?php endif; ?>	
    var currentUserId = <?php echo(json_encode($_SESSION['user_data']['id'])) ?>;
</script>
<!-- see ./src/components/UserProfile.vue -->
<div id="vue">
    <user-profile :current-user-id = "currentUserId" :cm-data="cmData" :user-data="userData"></user-profile>
</div>

