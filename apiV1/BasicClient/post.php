<?php
require_once "config/system.php";
require_once "template/header.php";

//session check
if (!SessionManager::control()) {
    Header("Location: ./");
}
$id = intval($_GET['id']);
?>
<input type="hidden" id="parent_id" value="<?= $id; ?>">
<div class="title">Gönderiler</div>
<div class="post"></div>

<?php
require_once "template/footer.php";
?>

<script>
    $(document).ready(function() {
        postListing(<?= $id; ?>);
    });
</script>