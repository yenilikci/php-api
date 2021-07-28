<?php
require_once "config/system.php";
require_once "template/header.php";
?>
<h2 class="title">
    Giriş Yap
</h2>
<div class="status"></div>
<div class="center-div">
    <form>
        <div class="list">
            Email: <br>
            <input type="email" class="input" name="email">
        </div>
        <div class="list">
            Şifre: <br>
            <input type="password" class="input" name="password">
        </div>
        <div class="list">
        <div class="list">
            <button id="login" type="button">Giriş Yap</button>
        </div>
    </form>
</div>
<?php
require_once "template/footer.php";
?>