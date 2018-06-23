<?php

class radelproductreview {

    const host = 'localhost';
    const database = 'productreview';
    const username = '';
    const password = '';

    private function db() {
        $conn = new mysqli(self::host, self::username, self::password, self::database);
        return $conn;
    }

    public static function add_product($params) {
        $db = self::db();
        $pid = params['pid'];
        $product_name = params['product_name'];
        $product_description = params['product_description'];
        $table=  self::product_list;
        $query = "INSERT INTO `product_list` (`pid`,`product_name`,`product_description`) VALUES ('$pid','$product_name','$product_description')";
        $result = $db->query($query) or die();
        return 'Success';
    }
    public static function get_product_list($param){
        $table=  self::product_list;
        $query = "SELECT * FROM `$table` WHERE $param LIMIT 10";
        $result = $db->query($query) or die();
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
    
    public static function edit_product_list($param){
        $pid = params['pid'];
        $product_name = params['product_name'];
        $product_description = params['product_description'];
        $table=  self::product_list;
        $query = "UPDATE `product_list` SET `pid`='$pid',`product_name`='$product_name',`product_description='$product_description' WHERE `id`='$pid'";
        $result = $db->query($query) or die();
        return 'Success';
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
        $result = $db->query($query) or die();
        return 'Success';
    }
    
    public static function get_review($param){
        $table=  self::review_list;
        $query = "SELECT * FROM `$table` WHERE $param ORDER BY id DESC LIMIT 10";
        $result = $db->query($query) or die();
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
    
    public static function edit_review($params) {
        $db = self::db();
        $pid = params['pid'];
        $review = params['review'];
        $rd = new DateTime($params['review_date']);
        $review_date = $rd->format('Y-m-d');
        $reviewer_name = params['reviewer_name'];
        $table=  self::review_list;
        $query = "UPDATE `product_review` SET `pid`=$pid,`review`='$review',`review_date`='$review_date',`reviewer_name`='$reviewer_name' WHERE `id`='$pid'";
        $result = $db->query($query) or die();
        return 'Success';
    }
}
  ?>

