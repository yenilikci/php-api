<?php
$parent_id = 0;
$query = $db->db->prepare("select * from categories where parent_id=?");
$query->execute(array(
    $parent_id
));
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$returnArray['status'] = true;
$returnArray['data'] = $result;
