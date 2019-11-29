<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message success alert alert-success" onclick="this.classList.add('d-lg-none')">--><?//= $message ?><!--</div>-->
<div class="alert alert-success" role="alert" onclick="this.classList.add('d-lg-none')">
    <?= $message ?>
</div>
