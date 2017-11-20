<?php var_dump($viewmodel); ?>


<!-- see ./src/components/UserProfile.vue -->
<div id="vue">
    <user-profile data="<?php json_encode($viewmodel)?>"></user-profile>
</div>

