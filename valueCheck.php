<?php
require_once("main.php");

if (!isset($_POST['input'])) {
    header("Location: index.php?t=1");
}
$longURL = $_POST['input'];



if (isset($_POST['redirect_check'])){
    if (isset($_POST['url_check'])) {
        $shortner = new Shortener($conn);
        $part = str_replace(SHORT_URL, "", $longURL);
        $URL=$shortner ->shortCodeToUrl($part);
        header("Location: $URL");
        exit();
    }else{
      $shortner = new Shortener($conn);
        $shortCode = $shortner->urlToShortCode($longURL);
        header("Location: $shortCode");
        exit();
    }
}else{
  if (isset($_POST['url_check'])) {
    $shortner = new Shortener($conn);
    $part = str_replace(SHORT_URL, "", $longURL);
    $URL=$shortner ->shortCodeToUrl($part);
    header("Location: index.php?code=".$part . ' & t=6');
  } else {
    try {
      $shortner = new Shortener($conn);
      $shortCode = $shortner->urlToShortCode($longURL);
      header("Location: index.php?code=".$shortCode . ' & t=7');
    } catch (Exception $e) {
      echo "Erorr In Code Shortner" ;
    }
  }
}

