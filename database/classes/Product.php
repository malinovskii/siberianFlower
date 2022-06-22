<?php
// Product Class 

class Product
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->connection)) return null;

        $this->db = $db;
    }

    public function getColumnValues($table, $column){
        $result = $this->db->connection->query("SELECT `{$column}` FROM `{$table}`");

        $resultArray = array();

        // Fetch data from product table one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;

    }

    // Fetch product
    public function getDataFromTable($table)
    {
        $result = $this->db->connection->query("SELECT * FROM `{$table}`");

        $resultArray = array();

        // Fetch data from product table one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }  

    // Fetch reviews by product_id
    public function getReviews($id)
    {
        $result = $this->db->connection->query("SELECT * FROM `reviews` WHERE `product_id` = {$id}");

        $resultArray = array();

        // Fetch data from product table one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    } 

    public function createReview($name, $text, $rating, $product_id)
    {
        $this->db->connection->query("INSERT INTO `reviews` (`id`, `name`, `text`, `rating`, `product_id`) VALUES (NULL, '$name', '$text', '$rating', '$product_id')");
    } 


    // Get product by id
    public function getProductById($id, $table = 'product')
    {
        if (isset($id)) {
            $result = $this->db->connection->query("SELECT * FROM {$table} WHERE id={$id}");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    // Search product by name
    public function searchProductByName($name)
    {
        if (isset($name)) {
            $result = $this->db->connection->query("SELECT * FROM `product` WHERE `name` LIKE '%"."{$product_name}"."%'");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }
}