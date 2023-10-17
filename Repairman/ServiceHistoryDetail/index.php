<?php include "dbConnection.php"; ?>

<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <?php $pageTitle = "Service History Details"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>
    <div class="prototype">
      <div class="div">
        <div class="overlap"><div class="text-wrapper">Service History Detail</div></div>
        <p class="service-ID">
        Service ID: <?php echo isset($row['serviceId']) ? $row['serviceId'] : ''; ?><br /><br /><br />
        Repairman ID: <?php echo isset($row['repairmanId']) ? $row['repairmanId'] : ''; ?><br /><br /><br />
        Customer ID: <?php echo isset($row['customerId']) ? $row['customerId'] : ''; ?><br /><br /><br />
        Service Event: <?php echo isset($row['serviceEventTitle']) ? $row['serviceEventTitle'] : ''; ?><br /><br /><br />
        Servicing Date: <?php echo isset($row['servicingDate']) ? $row['servicingDate'] : ''; ?><br /><br /><br />
        Total Amount: <?php echo isset($row['totalAmount']) ? $row['totalAmount'] : ''; ?>
      </p>
        <div class="group">
          <a href="../CustomerService/index.php"><div class="overlap-group"><div class="text-wrapper-2">Customer Service</div></div>
          </a>
        </div>
        <div class="overlap-wrapper">
          <a href="../ServiceHistory/index.php"><div class="div-wrapper"><div class="text-wrapper-3">Service History</div></div>
          </a>
        </div>
        <div class="icon-person">
          <div class="overlap-2">
            <a href="../ServiceHistory/index.php"><img class="stroke" src="img/stroke-1.svg" /> <img class="image" src="img/image-1.png" /></a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<style>
  .prototype {
  background-color: #ffffff;
  display: flex;
  flex-direction: row;
  justify-content: center;
  width: 100%;
}

.prototype .div {
  background-color: #ffffff;
  width: 1440px;
  height: 1024px;
  position: relative;
}

.prototype .overlap {
  position: absolute;
  width: 1440px;
  height: 84px;
  top: 0;
  left: 0;
  background-color: #ffcc00;
}

.prototype .text-wrapper {
  position: absolute;
  width: 1440px;
  height: 58px;
  top: 12px;
  left: 0;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 700;
  color: #000000;
  font-size: 48px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .service-ID {
  position: absolute;
  width: 363px;
  top: 537px;
  left: 539px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .group {
  width: 154px;
  left: 1198px;
  position: absolute;
  height: 39px;
  top: 126px;
}

.prototype .overlap-group {
  position: relative;
  width: 160px;
  height: 39px;
  background-color: #ffcc00;
  border-radius: 20px;
}

.prototype .text-wrapper-2 {
  position: absolute;
  width: 160px;
  height: 24px;
  top: 7px;
  left: 0;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .overlap-wrapper {
  width: 187px;
  left: 115px;
  position: absolute;
  height: 39px;
  top: 126px;
}

.prototype .div-wrapper {
  position: relative;
  width: 185px;
  height: 39px;
  background-color: #ffcc00;
  border-radius: 20px;
}

.prototype .text-wrapper-3 {
  position: absolute;
  width: 182px;
  height: 24px;
  top: 7px;
  left: 3px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .icon-person {
  position: absolute;
  width: 200px;
  height: 200px;
  top: 245px;
  left: 539px;
  border: 1px solid;
  border-color: #000000;
}

.prototype .overlap-2 {
  position: relative;
  height: 199px;
  top: 1px;
}

.prototype .stroke {
  position: absolute;
  width: 134px;
  height: 134px;
  top: 32px;
  left: 33px;
}

.prototype .image {
  position: absolute;
  width: 200px;
  height: 199px;
  top: 0;
  left: 0;
  object-fit: cover;
}


</style>