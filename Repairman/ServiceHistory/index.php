<?php include "dbConnection.php"; ?>

<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
  <?php $pageTitle = "Service History"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>
    <div class="prototype">
      <div class="div">
        <div class="list-bar">
          <div class="div-2">
            <div class="text-wrapper">Service ID</div>
            <div class="text-wrapper-2">Repairman ID</div>
            <div class="text-wrapper-3">Customer ID</div>
            <div class="text-wrapper-4">Service Event</div>
            <div class="text-wrapper-5">Servicing Date</div>
            <div class="text-wrapper-6">Total Amount</div>
            <div class="text-wrapper-7">Action</div>
          </div>
        </div>
        <?php
        $query = "SELECT * FROM servicehistories";
        $result=mysqli_query($connection, $query);
        ?>
        <div class="demo-data">
        <?php while ($row=mysqli_fetch_array($result))
        {
          ?>          
          <div class="div-2">
            <a href="../ServiceHistoryDetail/index.php"><div class="text-wrapper-8"><?php echo $row[1] ?></div></a>
            <a href="../ServiceHistoryDetail/index.php"><div class="text-wrapper-9"><?php echo $row[3] ?></div></a>
            <a href="../ServiceHistoryDetail/index.php"><div class="text-wrapper-10"><?php echo $row[2] ?></div></a>
            <a href="../ServiceHistoryDetail/index.php"><div class="text-wrapper-11"><?php echo $row[4] ?></div></a>
            <a href="../ServiceHistoryDetail/index.php"><div class="text-wrapper-12"><?php echo $row[6] ?></div></a>
            <a href="../ServiceHistoryDetail/index.php"><div class="text-wrapper-13"><?php echo $row[9] ?></div></a>
            <div class="group">
              <div class="overlap-group">
                <a href="deleteServiceHistory.php?serviceHistoryId=<?php echo $row[0] ?>">
                  <div class="text-wrapper-14">Delete</div>
                </a>
              </div>
            </div>
            <div class="overlap-wrapper">
              <div class="overlap-group">
              <a href="editServiceHistory.php?serviceHistoryId=<?php echo $row[0] ?>">
              <div class="text-wrapper-14">Edit</div></div></a>
            </div>
          </div>
          <?php
        }
        ?>

        </div>
        
        <div class="overlap-2"><div class="text-wrapper-15">Service History</div></div>
        <div class="overlap-3">
          <input type="text" id="searchInput" placeholder="Enter Service ID">
          <button id="searchButton">Search</button>
        </div>
        <div class="group-2">
           <a href="../CustomerService/index.php"><div class="overlap-4"><div class="text-wrapper-17">Customer Service</div></div>
          </a>
        </div>
      </div>
    </div>

    <!-- Add the JavaScript code here, just before the closing </body> tag -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const searchButton = document.getElementById("searchButton");
        const searchInput = document.getElementById("searchInput");
        const demoData = document.querySelectorAll(".demo-data .div-2");

        searchButton.addEventListener("click", function () {
          const searchValue = searchInput.value.trim().toLowerCase();

          if (searchValue === "") {
            // Reset the search and display all rows
            demoData.forEach((row) => {
              row.style.display = "block";
            });
          } else {
            // Filter rows based on the search input
            demoData.forEach((row) => {
              const serviceId = row.querySelector(".text-wrapper-8").textContent.toLowerCase();

              if (serviceId.includes(searchValue)) {
                row.style.display = "block";
              } else {
                row.style.display = "none";
              }
            });
          }
        });
      });
    </script>
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

.prototype .list-bar {
  position: absolute;
  width: 1407px;
  height: 62px;
  top: 230px;
  left: 24px;
}

.prototype .div-2 {
  position: relative;
  width: 1393px;
  height: 62px;
  background-color: #fff1bb;
  border-radius: 20px;
}

.prototype .text-wrapper {
  width: 121px;
  top: 19px;
  left: 10px;
  position: absolute;
  height: 24px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-2 {
  position: absolute;
  width: 145px;
  height: 24px;
  top: 20px;
  left: 164px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-3 {
  position: absolute;
  width: 133px;
  height: 24px;
  top: 19px;
  left: 342px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-4 {
  width: 158px;
  top: 20px;
  left: 512px;
  position: absolute;
  height: 24px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-5 {
  position: absolute;
  width: 150px;
  height: 24px;
  top: 20px;
  left: 759px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-6 {
  position: absolute;
  width: 147px;
  height: 24px;
  top: 19px;
  left: 982px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-7 {
  position: absolute;
  width: 96px;
  height: 24px;
  top: 20px;
  left: 1223px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .demo-data {
  position: absolute;
  width: 1405px;
  height: 62px;
  top: 321px;
  left: 24px;
}

.prototype .text-wrapper-8 {
  position: absolute;
  width: 74px;
  height: 24px;
  top: 19px;
  left: 27px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-9 {
  position: absolute;
  width: 74px;
  height: 24px;
  top: 19px;
  left: 199px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-10 {
  position: absolute;
  width: 77px;
  height: 24px;
  top: 19px;
  left: 371px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-11 {
  position: absolute;
  width: 182px;
  height: 24px;
  top: 19px;
  left: 500px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-12 {
  position: absolute;
  width: 136px;
  height: 24px;
  top: 19px;
  left: 766px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .text-wrapper-13 {
  position: absolute;
  width: 50px;
  height: 24px;
  top: 20px;
  left: 1030px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .group {
  position: absolute;
  width: 97px;
  height: 39px;
  top: 10px;
  left: 1178px;
}

.prototype .overlap-group {
  position: relative;
  width: 95px;
  height: 39px;
  background-color: #ffcc00;
  border-radius: 20px;
}

.prototype .text-wrapper-14 {
  position: absolute;
  width: 89px;
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

.prototype .overlap-wrapper {
  position: absolute;
  width: 97px;
  height: 39px;
  top: 10px;
  left: 1280px;
}

.prototype .overlap-group-wrapper {
  top: 881px;
  left: 24px;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .div-wrapper {
  top: 601px;
  left: 24px;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .overlap {
  position: absolute;
  width: 1405px;
  height: 62px;
  top: 461px;
  left: 24px;
}

.prototype .navbar-wrapper {
  top: 0;
  left: 0;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .rectangle {
  position: absolute;
  width: 2px;
  height: 5px;
  top: 37px;
  left: 1331px;
  background-color: #d9d9d9;
}

.prototype .demo-data-2 {
  top: 741px;
  left: 24px;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .demo-data-3 {
  top: 391px;
  left: 24px;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .demo-data-4 {
  top: 671px;
  left: 24px;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .demo-data-5 {
  top: 531px;
  left: 24px;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .demo-data-6 {
  top: 811px;
  left: 24px;
  position: absolute;
  width: 1405px;
  height: 62px;
}

.prototype .overlap-2 {
  position: absolute;
  width: 1440px;
  height: 84px;
  top: 0;
  left: 0;
  background-color: #ffcc00;
}

.prototype .text-wrapper-15 {
  position: absolute;
  width: 1440px;
  height: 58px;
  top: 20px;
  left: 0;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 700;
  color: #000000;
  font-size: 48px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .overlap-3 {
  position: absolute;
  width: 233px;
  height: 46px;
  top: 126px;
  left: 51px;
}

.prototype .rectangle-wrapper {
  position: absolute;
  width: 223px;
  height: 46px;
  top: 0;
  left: 0;
}

.prototype .rectangle-2 {
  height: 46px;
  background-color: #ffcc00;
  border-radius: 320px;
}

.prototype .icon-search {
  position: absolute;
  width: 35px;
  height: 37px;
  top: 5px;
  left: 13px;
}

.prototype .text-wrapper-16 {
  position: absolute;
  width: 156px;
  height: 24px;
  top: 10px;
  left: 42px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400;
  color: #000000;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: normal;
}

.prototype .group-2 {
  position: absolute;
  width: 154px;
  height: 39px;
  top: 126px;
  left: 1271px;
}

.prototype .overlap-4 {
  position: relative;
  width: 160px;
  height: 39px;
  background-color: #ffcc00;
  border-radius: 20px;
}

.prototype .text-wrapper-17 {
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


</style>