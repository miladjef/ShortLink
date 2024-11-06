<?php

class Shortener
{
    protected static $chars = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ|0123456789";
    protected static $codeLength = 8;
    private $conn;

    private $table = "short_urls";
    protected $timestamp;

    public function __construct($conn){
        $this->conn=$conn;
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function urlToShortCode($url){
        $conn= $this->conn;
        if(!$this->validateUrlFormat($url)){
          header("Location: index.php?t=2");
          exit;
        }
        $shortCode = $this->createShortCode($url);
        $save= $this->insertUrlInDB($url,$shortCode,$conn);
        return $shortCode;
    }

    protected function validateUrlFormat($url){
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    protected function createShortCode($url){
        $shortCode = $this->generateRandomString(self::$codeLength);
        return $shortCode;
    }

    protected function generateRandomString($length = 7){
        $sets = explode('|', self::$chars);
        $all = '';
        $randString = '';
        foreach($sets as $set){
            $randString .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++){
            $randString .= $all[array_rand($all)];
        }
        $randString = str_shuffle($randString);
        return $randString;
    }

    protected function insertUrlInDB($url, $code, $conn){
        $query = "INSERT INTO `$this->table` (long_url, short_code, created) VALUES ('$url','$code','$this->timestamp')";
        if (mysqli_query($conn,$query)) {
            return ".با موفقیت انجام شد";
        } else {
            return "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    public function shortCodeToUrl($code, $increment = true){
        if(empty($code)) {
            header("Location: index.php?t=3");
        }

        if($this->validateShortCode($code) == false){
            header("Location: index.php?t=4");
//            throw new Exception("Short code does not have a valid format.");
        }

        $urlRow = $this->getUrlFromDB($this->conn , $code);
        if(empty($urlRow)){
            header("Location: index.php?t=5");
//            throw new Exception("Short code does not appear to exist.");
        }
        return $urlRow;
    }

    protected function validateShortCode($code){
        $rawChars = str_replace('|', '', self::$chars);
        return preg_match("|[".$rawChars."]+|", $code);
    }

    public function getUrlFromDB($conn,$code){
        $query = "SELECT long_url FROM `$this->table` WHERE short_code = '$code' ";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                return $row["long_url"];
            }
        } else {
            echo "0 results";
        }
    }

}