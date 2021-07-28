<?php
require_once "config/system.php";
require_once "template/header.php";

//session check
if (!SessionManager::control()) {
    Header("Location: ./");
}
$id = intval($_GET['id']);
?>

<div class="title" id="title">
    Gönderi
</div>
<div class="list">
    <img src="" alt="" id="image">
</div>
<div class="list" id="text"></div>

<?php
require_once "template/footer.php";
?>

<script>
    $(document).ready(function() {
        postDetail(<?= $id; ?>);
    });
</script>