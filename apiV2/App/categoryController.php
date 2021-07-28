<?php
class categoryController extends Controller
{
    public function list($id)
    {
        $returnArray = [];
        //default status res
        $returnArray['status'] = false;

        $query = $this->db->prepare("select * from categories where parent_id=?");
        $query->execute(array(
            $id
        ));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

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

        $c = $this->db->prepare("select * from categories where id=?");
        $c->execute(array(
            $id
        ));
        $count = $c->rowCount();
        if ($count == 0) {
            $returnArray['message'] = "Böyle bir kategori bulunamadı!";
            return;
        }

        //get
        $query = $this->db->prepare("select * from categories where parent_id=?");
        $query->execute(array(
            $id
        ));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $returnArray['status'] = true;
        $returnArray['data'] = $result;

        //convert json
        echo json_encode($returnArray);
    }
}
