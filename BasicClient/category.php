<?php
require_once "config/system.php";
require_once "template/header.php";

//session check
if (!SessionManager::control()) {
    Header("Location: ./");
}
$id = intval($_GET['id']);
?>
<input type="hidden" id="parent_id" value="<?=$id;?>">
<div class="title">Kategori</div>
<div class="categoryChild"></div>
<?php
require_once "template/footer.php";
?>