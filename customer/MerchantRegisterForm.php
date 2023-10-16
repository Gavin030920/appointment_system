<?php 
session_start(); 
include "DbConnection.php";
include "AuthenticateMiddleware.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <?php $pageTitle = "Merchant Registration Form"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>

    <div class="page-content">
        <?php  
            $userId = $_SESSION["authId"];
            $query = "SELECT * FROM accountinformations WHERE userId = $userId";
            $results = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_row($results)) {
        ?>
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="formFacePicture">Face picture:</label>
            <input type="file" name="formFacePicture" id="formFacePicture" placeholder="Face Picture (upload)">

            <label for="formBankSlipPicture">BankSlipPicture:</label>
            <input type="file" name="formBankSlipPicture" id="formBankSlipPicture" placeholder="Bank Slip picture (upload)">

            <label for="formICPicture">IC Picture:</label>
            <input type="file" name="formICPicture" id="formICPicture" placeholder="IC Picture (upload)">

            <label for="formPassportPicture">Passport Picture:</label>
            <input type="file" name="formPassportPicture" id="formPassportPicture" placeholder="Passport Picture (upload)">

            <label for="formBusinessAddress">Business Address:</label>
            <input type="textarea" name="formBusinessAddress" id="formBusinessAddress" placeholder="Business Address">

            <label for="formPhoneNumber">Phone Number:</label>
            <input type="textarea" name="formPhoneNumber" id="formPhoneNumber" placeholder="60123456789">
            <input type="hidden" name="formUserId" value="<?php echo $_SESSION["authId"] ?>">
            <input type="submit" name="submit" value="<?php echo $row[8] == true? "APPROVED" : "submit" ?>" 
                <?php echo $row[8] == true? "disabled" : "" ?>> <br><br>
            <?php if (isset($_GET["formMessage"])) {
                ?>
                    <span class="formMessage"><?php echo $_GET["formMessage"] ?></span>
                <?php
            } ?>
        </form>
        <?php
            }
        ?>
    </div>
</body>
</html>

<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function uploadFile($pathName, $formFileName, $binaryFile) {
    $fileNames = explode(".", $formFileName);
    $fileNameWithoutExtension = $fileNames[0];
    $fileExtension = $fileNames[1];

    $newFileName = generateRandomString().".".$fileExtension;
    $uploadDir = "PublicUploads/".$pathName."/".$newFileName;
    move_uploaded_file($binaryFile, $uploadDir);
    
    return $uploadDir;
}

    if (isset($_POST["submit"])) {
                $formMessage = "Successfully%20Update%20Account%20Information";

                $userId = $_POST["formUserId"];
                $facePicture = $_FILES["formFacePicture"];
                $bankSlipPicture = $_FILES["formBankSlipPicture"];
                $icPicture = $_FILES["formICPicture"];
                $passportPicture = $_FILES["formPassportPicture"];
                $businessAddress = $_POST["formBusinessAddress"];
                $phoneNumeber = $_POST["formPhoneNumber"];

                $facePictureDir = uploadFile("FacePicture", $facePicture["name"], $facePicture["tmp_name"]);
                $bankSlipPictureDir = uploadFile("BankSlipPicture", $bankSlipPicture["name"], $bankSlipPicture["tmp_name"]);
                $icPictureDir = uploadFile("ICPicture", $icPicture["name"], $icPicture["tmp_name"]);
                $passportPictureDir = uploadFile("PassportPicture", $passportPicture["name"], $passportPicture["tmp_name"]);

                $existingAccountInformationQuery = "SELECT * FROM accountInformations WHERE userId = $userId";
                $existingAccountInformationResult = mysqli_query($connection, $existingAccountInformationQuery);
                if (mysqli_num_rows($existingAccountInformationResult) == 1) {
                    $accountInformationId = mysqli_fetch_row($existingAccountInformationResult)[0];
                    $updateQuery = "UPDATE accountInformations SET facePicture = '$facePictureDir', bankSlipPicture = '$bankSlipPictureDir', 
                                                                    icPicture = '$icPictureDir', passport = '$passportPictureDir', businessAddress = '$businessAddress', phoneNumber = '$phoneNumeber'
                                                                    WHERE accountInformationId = $accountInformationId";
                    mysqli_query($connection, $updateQuery);
                }
                else {
                    $formMessage = "Failed%20Update%20Account%20Information";
                }

                echo "<script>location.replace(window.location.protocol + '//' + window.location.host + window.location.pathname + '?formMessage=$formMessage')</script>";
            }
?>

<style>
    .page-content {
        padding: 100px 200px;
    }
</style>