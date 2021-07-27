<?php
require_once "config/system.php";
require_once "template/header.php";
?>
<h2 class="title">
    Kayıt Ol
</h2>
<div class="center-div">
<form>
    <div class="list">
        Adınız: <br>
        <input type="text" class="input" name="name">
    </div>
    <div class="list">
        Soyadınız: <br>
        <input type="text" class="input" name="name">
    </div>
    <div class="list">
        Email: <br>
        <input type="email" class="input" name="email">
    </div>
    <div class="list">
        Şifre: <br>
        <input type="password" class="input" name="password">
    </div>
    <div class="list">
        Cinsiyet: <br>
        <input type="radio" name="gender" value="0"> Erkek
        <input type="radio" name="gender" value="1"> Kadın
    </div>
    <div class="list">
        <button type="button">Kayıt Ol</button>
    </div>
</form>
</div>
<?php
require_once "template/footer.php";
?>