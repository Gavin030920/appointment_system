<?php include "dbConnection.php"; ?>

<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <?php $pageTitle = "Customer Service"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>
    <div class="prototype">
      <div class="div">
        <div class="overlap"><div class="text-wrapper">Customer Service</div></div>
        <div class="overlap-group">
        <div class="rectangle"></div>
          <div class="rectangle">
            <center>
            <form action="../CustomerServiceFirstReply/index.php" method="get">
              <input type="text" name="message" id="message" placeholder="(Enter your message)">
              <input type="submit" value="Send">
            </form>
          </center>
        </div>

          <img class="polygon" src="img/polygon-2.svg" />
        </div>
        <div class="overlap-2">
          <div class="rectangle-4"></div>
          <img class="img" src="img/polygon-2.svg" />
          <p style="margin-top: -10px" class="p">Good morning, Online Home Repairman. How long will my home maintenance take?</p>
        </div>
        <img class="image" src="img/image-17.png" />
        <img class="image-2" src="img/image-16.png" />
        <div class="group">
          <a href="../ServiceHistory/index.php"><div class="div-wrapper"><div class="text-wrapper-4">Service History</div></div></a>
        </div>
      </div>
    </div>
  </body>
</html>

<style>

  form input[type= "submit"] {
    font-family: 'Times New Roman', Times, serif;
  }

  form input[type = "text"] {
    width: 800px;
    margin-top: 50px;
    font-family: 'Times New Roman', Times, serif;
  }

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

.prototype .overlap-group {
  position: absolute;
  width: 1005px;
  height: 132px;
  top: 696px;
  left: 196px;
}

.prototype .rectangle {
  position: absolute;
  width: 961px;
  height: 132px;
  top: 0;
  left: 44px;
  background-color: #fff0b6;
}

.prototype .rectangle-2 {
  position: absolute;
  width: 661px;
  height: 22px;
  top: 55px;
  left: 141px;
  background-color: #fff0b6;
}

.prototype .rectangle-3 {
  position: absolute;
  width: 97px;
  height: 22px;
  top: 55px;
  left: 821px;
  background-color: #ffcc00;
}

.prototype .text-wrapper-2 {
  position: absolute;
  width: 97px;
  height: 19px;
  top: 56px;
  left: 821px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 16px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-3 {
  position: absolute;
  width: 661px;
  height: 19px;
  top: 56px;
  left: 141px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 16px;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .polygon {
  left: 0;
  position: absolute;
  width: 155px;
  height: 81px;
  top: 51px;
}

.prototype .overlap-2 {
  position: absolute;
  width: 1007px;
  height: 132px;
  top: 299px;
  left: 274px;
}

.prototype .rectangle-4 {
  position: absolute;
  width: 961px;
  height: 132px;
  top: 0;
  left: 0;
  background-color: #fff0b6;
}

.prototype .img {
  left: 852px;
  position: absolute;
  width: 155px;
  height: 81px;
  top: 51px;
}

.prototype .p {
  position: absolute;
  width: 766px;
  top: 50px;
  left: 98px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 24px;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .image {
  top: 431px;
  left: 1290px;
  position: absolute;
  width: 150px;
  height: 150px;
  object-fit: cover;
}

.prototype .image-2 {
  top: 828px;
  left: 0;
  position: absolute;
  width: 150px;
  height: 150px;
  object-fit: cover;
}

.prototype .group {
  position: absolute;
  width: 187px;
  height: 39px;
  top: 126px;
  left: 115px;
}

.prototype .div-wrapper {
  position: relative;
  width: 185px;
  height: 39px;
  background-color: #ffcc00;
  border-radius: 20px;
}

.prototype .text-wrapper-4 {
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

</style>