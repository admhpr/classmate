<?php var_dump($viewmodel); ?>


<script>
    var cmData = <?php echo(json_encode($viewmodel)) ?>;
</script>
<!-- see ./src/components/UserProfile.vue -->
<div id="vue">
    <user-profile :cm-data="cmData"></user-profile>
</div>

