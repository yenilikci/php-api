<?php
//category check
$category_id = MainHelper::getIntVariable("category_id");
$c = $db->db->prepare("select * from categories where id=?");
$c->execute(array(
    $category_id
));
$count = $c->rowCount();
if ($count == 0) {
    $returnArray['message'] = "Böyle bir kategori yok!";
    return;
}

//get posts
$list = $db->db->prepare("select * from posts where category_id=?");
$list->execute(array(
    $category_id
));
$result = $list->fetchAll(PDO::FETCH_ASSOC);

$returnArray['message'] = "Veriler başarılı bir şekilde listelendi";
$returnArray['data'] = $result;