<?php
require_once "config/system.php";
require_once "template/header.php";

//session check
if (SessionManager::control()) {
    # login success
    SessionManager::getInfo();
?>
    <div class="title">Menü</div>
    <div class="category"></div>
<?php
} else {
    # login failed
?>
    <div class="menu">
        <li><a href="./login.php">Giriş Yap</a></li>
        <li><a href="./register.php">Kayıt Ol</a></li>
    </div>
<?php
}
?>

<?php
require_once "template/footer.php";
?>

<script>
    $(document).ready(function() {
        categoryListing();
    });
</script>
