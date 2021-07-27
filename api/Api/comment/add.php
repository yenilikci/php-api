<?php
if ($_POST) {
    //strip_tags , intval filtering
    $userId = MainHelper::postIntVariable("userid");
    $postId = MainHelper::postIntVariable("postid");
    $text = MainHelper::postVariable("text");

    //field check
    if ($text == "") {
        $returnArray['message'] = "Text alanı boş bırakılamaz!";
        return;
    }

    //post check
    $c = $db->db->prepare("select * from posts where id=?");
    $c->execute(array(
        $postId
    ));
    $count = $c->rowCount();
    if ($count == 0) {
        $returnArray['message'] = "Böyle bir yazı yok!";
        return;
    }

    //insert comment
    $insertQuery = $db->db->prepare("insert into comments(user_id,post_id,text,date) value(?,?,?,?)");
    $date = date("Y-m-d");
    $result = $insertQuery->execute(array(
        $userId,
        $postId,
        $text,
        $date
    ));
    if ($result) {
        $returnArray['status'] = true;
        $returnArray['message'] = "Yorum başarılı bir şekilde eklendi!";
    } else {
        $returnArray['message'] = "Yorum eklenemedi!";
    }
}
