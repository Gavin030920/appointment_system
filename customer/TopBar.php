<?php 
        $userId = $_SESSION["authId"];
        $query = "SELECT * FROM users WHERE userId = $userId";
        $userDetail = mysqli_fetch_row(mysqli_query($connection, $query));
        $username = $userDetail[1];
?>

<div class="top-bar">
        <div class="top-bar-left-items">
            <img class="top-bar-button" src="Assets/BurgerButton.png" alt="Button.png">
            <span class="top-bar-title"><?php echo "$pageTitle (Welcome back, $username)" ?></span>
        </div>
        <div class="top-bar-right-items">
            <img class="avatar" src="Assets/Avatar.png" alt="avatar.png">
            <div class="avatar-dropdown">
                <a class="avatar-dropdown-item" href="AccountSetting.php">Account Settings</a> <br>
                <a class="avatar-dropdown-item" href="Logout.php">Logout</a>
            </div>            
        </div>
    </div>    
<style>
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 10px;
    background-color: #ADD8E6;
    box-shadow: 0 3px 10px #0000000D;
    z-index: 3;
    position: relative;
    height: 5%;
}

.top-bar-left-items {
    display: flex;
    align-items: center;
}

.top-bar-button {
    height: 25px;
    width: 25px;
    margin-right: 20px;
}

.top-bar-button:hover {
    cursor: pointer;
}

.top-bar-title {
    font-size: 1.3em;
    color: #333;
}

.avatar {
    height: 35px;
    width: 35px;
    border-radius: 50%;
    cursor: pointer;
}

.avatar-dropdown {
    display: none;
    padding: 15px 0;
    background-color: white;
    position: absolute;
    border: 1px solid #e7e7e7;
    top: 40px;
    right: 0;
    z-index: 10;
    box-shadow: 0 3px 10px #0000000D;
    border-radius: 4px;
}

.avatar-dropdown-item {
    padding: 10px 20px;
    display: block;
}

.avatar-dropdown-item:hover {
    background-color: #f5f5f5;
}

.avatar:hover + .avatar-dropdown, 
.avatar-dropdown:hover {
    display: block;
}
</style>