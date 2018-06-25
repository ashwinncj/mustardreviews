<?php

class radelproductreview {

    const host = 'localhost';
    const database = 'productreview';
    const username = '';
    const password = '';
    const product_list='product_list';
    const review_list='review_list';

    private function db($query) {
        $conn = new mysqli(self::host, self::username, self::password, self::database);
        return $conn->query($query) or die();
    }

    public static function add_product($params) {
        $pid = params['pid'];
        $product_name = params['product_name'];
        $product_description = params['product_description'];
        $table=  self::product_list;
        $query = "INSERT INTO `product_list` (`pid`,`product_name`,`product_description`) VALUES ('$pid','$product_name','$product_description')";
        $result = self::db($query);
        $data['success']=TRUE;
        return json_encode($data);
        
    }
    public static function get_product($param){
        $table=  self::product_list;
        $query = "SELECT * FROM `$table` WHERE `pid`='$param'";
        $result = self::db($query);
        $count = $result->num_rows;
        if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $temp[] = $row;
            }
        } else {
            $temp[] = '';
        }
        $data['count'] = $count;
        $data['data'] = $temp;
        return json_encode($data);
       
    }
    
    public static function edit_product_list($param){
        $pid = params['pid'];
        $product_name = params['product_name'];
        $product_description = params['product_description'];
        $table=  self::product_list;
        $query = "UPDATE `product_list` SET `pid`='$pid',`product_name`='$product_name',`product_description='$product_description' WHERE `id`='$pid'";
        $result = self::db($query);
        $data['success']=TRUE;
        return json_encode($data);
    }
    
    public static function add_review($params) {
        $db = self::db();
        $table=  self::review_list;
        $pid = params['pid'];
        $review = params['review'];
        $rd = new DateTime($params['review_date']);
        $review_date = $rd->format('Y-m-d');
        $reviewer_name = params['reviewer_name'];
        $query = "INSERT INTO `product_review` (`pid`,`review`,`review_date`,`reviewer_name`) VALUES ('$pid','$review','$review_date','$reviewer_name')";
       $result = self::db($query);
        $data['success']=TRUE;
        return json_encode($data);
    }
    
    public static function get_reviews($param){
        $table=  self::review_list;
        $query = "SELECT * FROM `$table` WHERE $param ORDER BY id DESC LIMIT 10";
        $result = self::db($query);
         $count = $result->num_rows;
        if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $temp[] = $row;
            }
        } else {
            $temp[] = '';
        }
        $data['count'] = $count;
        $data['data'] = $temp;
        return $data;
       
    }
    //To be decided whether to keep this option or not
    public static function edit_review($params) {
        $db = self::db();
        $pid = params['pid'];
        $review = params['review'];
        $rd = new DateTime($params['review_date']);
        $review_date = $rd->format('Y-m-d');
        $reviewer_name = params['reviewer_name'];
        $table=  self::review_list;
        $query = "UPDATE `product_review` SET `pid`=$pid,`review`='$review',`review_date`='$review_date',`reviewer_name`='$reviewer_name' WHERE `id`='$pid'";
        $result = self::db($query);
        $data['success']=TRUE;
        return json_encode($data);
    }
}
  ?>

