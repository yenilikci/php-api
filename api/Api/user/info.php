<?php
$id = intval($_GET['id']);

//record check
$c = $db->db->prepare("select * from users where id=?");
$c->execute(array(
    $id
));
$count = $c->rowCount();
if ($count == 0) {
    $returnArray['message'] = "Böyle bir kullanıcı bulunamadı!";
    return;
}
//get user data
$w = $db->db->prepare("select * from users where id=?");
$w->execute(array(
    $id
));
$result = $w->fetch(PDO::FETCH_ASSOC);

//response
$returnArray['data'] = $result;
$returnArray['status'] = true;
$returnArray['message'] = $id . " id'li kullanıcı verileri başarıyla getirildi!";
