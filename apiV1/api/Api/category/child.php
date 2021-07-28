<?php
//category check
$parent_id = MainHelper::getIntVariable("parent_id");
$c = $db->db->prepare("select * from categories where id=?");
$c->execute(array(
    $parent_id
));
$count = $c->rowCount();
if ($count == 0) {
    $returnArray['message'] = "Böyle bir kategori bulunamadı!";
    return;
}

//get
$query = $db->db->prepare("select * from categories where parent_id=?");
$query->execute(array(
    $parent_id
));
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$returnArray['status'] = true;  
$returnArray['data'] = $result;
