<?php
require_once "config/system.php";
require_once "template/header.php";

//session check
if (!SessionManager::control()) {
    Header("Location: ./");
}
$id = intval($_GET['id']);
?>

<!--post details-->
<div class="title" id="title">
    Gönderi
</div>
<div class="list">
    <img src="" alt="" id="image">
</div>
<div class="list" id="text"></div>

<!--comments-->
<div class="status"></div>
<div class="title">
    Yorumlar
</div>
<div class="comment-area"></div>
<form>
    <input type="hidden" name="userid" value="<?= SessionManager::getInfo(); ?>">
    <input type="hidden" name="postid" value="<?= $id; ?>">
    <div class="list">
        <textarea name="text" placeholder="Yorumunuzu giriniz" id="text" cols="30" rows="10"></textarea>
    </div>
    <div class="list">
        <button type="button" id="postComment">Gönder</button>
    </div>
</form>

<?php
require_once "template/footer.php";
?>

<script>
    $(document).ready(function() {
        postDetail(<?= $id; ?>);
        getComments(<?= $id; ?>);
    });
</script>