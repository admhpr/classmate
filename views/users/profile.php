<!-- <?php var_dump($viewmodel); ?> -->


<script>
    var cmData = <?php echo(json_encode($viewmodel)) ?>;
    var currentUserId = <?php echo(json_encode($_SESSION['user_data']['id'])) ?>;
</script>
<!-- see ./src/components/UserProfile.vue -->
<div id="vue">
    <user-profile :current-user-id = "currentUserId" :cm-data="cmData"></user-profile>
</div>

