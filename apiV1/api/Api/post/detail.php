<?php
//post check
$post_id = MainHelper::getIntVariable('post_id');
$c = $db->db->prepare("select * from posts where id=?");
$c->execute(array(
    $post_id
));
$count = $c->rowCount();
if ($count == 0) {
    $returnArray['message'] = "Böyle bir paylaşım bulunamadı!";
    return;
}
//get detail
$data = $c->fetch(PDO::FETCH_ASSOC);
$returnArray['data'] = $data;
$returnArray['status'] = true;
$returnArray['message'] = "Gönderi detayları başarılı bir şekilde getirildi!";
