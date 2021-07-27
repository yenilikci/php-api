<?php
//post check
$postId = MainHelper::getIntVariable("postid");
$c = $db->db->prepare("select * from posts where id =?");
$c->execute(array(
    $postId
));
$count = $c->rowCount();
if ($count == 0) {
    $returnArray['message'] = "Böyle bir paylaşım bulunamadı!";
    return;
}

//get data
$list = $db->db->prepare("select * from comments where post_id=?");
$list->execute(array(
    $postId
));
$result = $list->fetchAll(PDO::FETCH_ASSOC);

#result
$returnArray['status'] = true;
$returnArray['message'] = "Yorum verileri başarılı bir şekilde listelendi!";

$returnDataArray = [];
foreach ($result as $key => $value) {
    $user = $db->db->prepare("select * from users where id=?");
    $user->execute(array(
        $value["user_id"]
    ));
    $userInfo = $user->fetch(PDO::FETCH_ASSOC);
    $returnDataArray[$key]['id'] = $value['id'];
    $returnDataArray[$key]['post_id'] = $value['post_id'];
    $returnDataArray[$key]['user'] = $userInfo['name'] . " " . $userInfo['surname'];
    $returnDataArray[$key]['text'] = $value['text'];
    $returnDataArray[$key]['date'] = $value['date'];
}
$returnArray['data'] = $returnDataArray;
