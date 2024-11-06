<?php
require_once('main.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>کوتاه کننده لینک</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class=" tac">

<?php
if (isset($_GET['short_code'])) {
    $short_code = $_GET['short_code'];
    $shortner = new Shortener($conn);
    $part = str_replace(SHORT_URL, "", $short_code);
    $URL = $shortner->shortCodeToUrl($part);
    header("Location: $URL");
    exit();

}


$type = 0;
if (isset($_GET['t'])) {
    $type = $_GET['t'];
}
if (isset($_GET['code'])) {
    $shortner = new Shortener($conn);
    $code = $_GET['code'];
    if ($type == 6) {
        $value = $shortner->getUrlFromDB($conn, $code);
    } else if ($type == 7) {
        $value = SHORT_URL . $code;
    }
}
?>
<div class="container">
    <div class="row">

        <!--  body  -->
        <div class="col-md-1 col-xl-2 mt20p"></div>
        <div class="col-sm-12 col-md-10 col-xl-8 mt20p p-4 bc">

            <?php
            if ($type == 1) {
                ?>
                <div class="alert alert-danger" role="alert">
                    لطفا فیلد لینک را تکمیل نمایید!
                </div>
                <?php
            } else if ($type == 2) {
                ?>
                <div class="alert alert-danger" role="alert">
                    فرمت لینک وارد شده اشتباه است، مقادیر وارد شده را چک کنید!
                </div>
                <?php
            } else if ($type == 3) {
                ?>
                <div class="alert alert-danger" role="alert">
                    لطفا فیلد لینک را تکمیل نمایید!
                </div>
                <?php
            } else if ($type == 4) {
                ?>
                <div class="alert alert-danger" role="alert">
                    فرمت لینک کوتاه شما درست نیست، از صحت مقادیر وارد شده اطمینان حاصل کنید!
                </div>
                <?php
            } else if ($type == 5) {
                ?>
                <div class="alert alert-danger" role="alert">
                    موردی مشابه لینک کوتاه شما پیدا نشد!
                </div>
                <?php
            } else if ($type == 6 || $type == 7) {
                ?>
                <div style="direction: rtl;" class="alert alert-success" role="alert">
                    لینک شما :
                    <?php echo $value ?>
                </div>
            <?php } ?>

            <form action="valueCheck.php" method="post">
                <input required="required" type="text" class="material_input tac material_input_box" name="input"
                       id="input"><br><br>
                <label class="form-check-label" for="url_check">تبدیل لینک کوتاه به حالت اولیه</label>
                <input type="checkbox" class="custom-checkbox" name="url_check" id="url_check"><br><br>
                <label class="form-check-label" for="redirect_check">انتقال به لینک مرجع</label>
                <input type="checkbox" class="custom-checkbox" name="redirect_check" id="redirect_check"><br><br>
                <input type="submit" class="btn btn-success btn-block mt10 aic" value="ثبت">
            </form>
        </div>
        <div class="col-md-2 col-xl-3"></div>
    </div>
</div>

<br>
<br>
<hr/>
<div class="app-footer white bg p-a b-t">
    <span class="text-sm">&copy; تمامی حقوق مادی و معنوی محفوظ است 2020</span>
    <div class="pull-right text-sm">نسخه 1.0.0</div>
</div>
<hr/>

</body>
</html>