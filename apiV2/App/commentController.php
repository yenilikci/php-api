<?php
class commentController extends Controller
{
    public function store()
    {
        if ($_POST) {
            $returnArray = [];
            //default status res
            $returnArray['status'] = false;


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
            $c = $this->db->prepare("select * from posts where id=?");
            $c->execute(array(
                $postId
            ));
            $count = $c->rowCount();
            if ($count == 0) {
                $returnArray['message'] = "Böyle bir yazı yok!";
                return;
            }

            //insert comment
            $insertQuery = $this->db->prepare("insert into comments(user_id,post_id,text,date) value(?,?,?,?)");
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

        //convert json
        echo json_encode($returnArray);
    }

    public function get($id)
    {
        $returnArray = [];
        //default status res
        $returnArray['status'] = false;

        //post check
        $c = $this->db->prepare("select * from posts where id =?");
        $c->execute(array(
            $id
        ));
        $count = $c->rowCount();
        if ($count == 0) {
            $returnArray['message'] = "Böyle bir paylaşım bulunamadı!";
            return;
        }

        //get data
        $list = $this->db->prepare("select * from comments where post_id=?");
        $list->execute(array(
            $id
        ));
        $result = $list->fetchAll(PDO::FETCH_ASSOC);

        #result
        $returnArray['status'] = true;
        $returnArray['message'] = "Yorum verileri başarılı bir şekilde listelendi!";

        $returnDataArray = [];
        foreach ($result as $key => $value) {
            $user = $this->db->prepare("select * from users where id=?");
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
        $returnArray['status'] = true;
        $returnArray['message'] = "Yorumlar başarıyla listelendi";

        //convert json
        echo json_encode($returnArray);
    }
}
