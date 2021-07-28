<?php
class postController extends Controller
{
    public function list($id)
    {
        $returnArray = [];
        //default status res
        $returnArray['status'] = false;

        $c = $this->db->prepare("select * from categories where id=?");
        $c->execute(array(
            $id
        ));
        $count = $c->rowCount();
        if ($count == 0) {
            $returnArray['message'] = "Böyle bir kategori yok!";
            return;
        }

        //get posts
        $list = $this->db->prepare("select * from posts where category_id=?");
        $list->execute(array(
            $id
        ));
        $result = $list->fetchAll(PDO::FETCH_ASSOC);

        $returnArray['message'] = "Veriler başarılı bir şekilde listelendi";
        $returnArray['status'] = true;
        $returnArray['data'] = $result;

        //convert json
        echo json_encode($returnArray);
    }

    public function get($id)
    {
        $returnArray = [];
        //default status res
        $returnArray['status'] = false;

        $c = $this->db->prepare("select * from posts where id=?");
        $c->execute(array(
            $id
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

        //convert json
        echo json_encode($returnArray);
    }
}
