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
    <link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
</head>
<body>
    <?php $pageTitle = "Chatting"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>

    <div class="page-content">
        <div class="chat-sidebar">
            <div class="chat-list-item">
                <?php 
                    $selfId = $_SESSION["authId"];
                    $retrieveListOfMessagedQuery = "SELECT 
                                                          CASE 
                                                              WHEN cm.senderUserId = $selfId THEN cm.receiverUserId 
                                                              ELSE cm.senderUserId 
                                                          END AS chattedUserId,
                                                          u.username AS chattedUsername,
                                                          MIN(cm.Message) AS lastMessage
                                                      FROM 
                                                          chatMessages cm
                                                      JOIN 
                                                          users u ON (cm.senderUserId = $selfId AND cm.receiverUserId = u.userId) 
                                                                  OR (cm.receiverUserId = $selfId AND cm.senderUserId = u.userId)
                                                      GROUP BY
                                                          chattedUserId,
                                                          u.username";
                    $retrieveListOfMessagedResult = mysqli_query($connection, $retrieveListOfMessagedQuery);
                    
                    while ($chattedUser = mysqli_fetch_array($retrieveListOfMessagedResult)) {
                        $chattedUserId = $chattedUser[0];
                        $chattedUserName = $chattedUser[1];
                        $chattedUserRecentMessage = $chattedUser[2];
                        ?>
                        <a href="ChattingPage.php?userId=<?php echo $chattedUserId ?>">
                            <div class="chat-item">
                                <img class="avatar" src="Assets/Avatar.png" alt="avatar.png">
                                <div class="chat-content">
                                    <span class="chat-header"><?php echo $chattedUserName ?></span>
                                    <span class="chat-content"><?php echo $chattedUserRecentMessage ?></span>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                ?>
            </div>
        </div>
        <div class="main-content">
            <?php 
                    if (isset($_GET["userId"])) {
                        $userId = $_GET["userId"];
                        $selfId = $_SESSION["authId"];
                        $messagesQuery = "SELECT usr.username AS displayName, msg.senderUserId, msg.message, msg.dateCreated
                                    FROM chatMessages AS msg
                                    JOIN users AS usr ON msg.senderUserId = usr.userId
                                    WHERE (msg.senderUserId = $selfId AND msg.receiverUserId = $userId) OR
                                    (msg.senderUserId = $userId AND msg.receiverUserId = $selfId)
                                    ORDER BY msg.dateCreated DESC";
                        $messagesResult = mysqli_query($connection, $messagesQuery);
                        // 0: displayName
                        // 1: senderId
                        // 2: message
                        // 3: dateCreated

                        $userAccountDetailQuery = "SELECT username, email FROM users WHERE userId = $userId LIMIT 1";
                        // 0: username
                        // 1: email
                        $userAccountDetailResult = mysqli_query($connection, $userAccountDetailQuery);
                ?>
            <div class="user-content">
                <div class="user-details">
                    <?php while ($userAccountDetail = mysqli_fetch_array($userAccountDetailResult)) { ?>
                        <span>Name: <?php echo $userAccountDetail[0] ?></span>
                        <span>Email: <?php echo $userAccountDetail[1] ?></span>
                    <?php } ?>
                </div>
                <img class="user-details-avatar" src="Assets/Avatar.png" alt="avatar.png">
            </div>
            <div class="messaging-content">
                <div class="text-box-message">
                    <?php $useSenderInsteadOfReceiver = mysqli_num_rows($messagesResult) < 1 || mysqli_fetch_array($messagesResult)[0][1] == $selfId; mysqli_data_seek($messagesResult, 0); ?>
                    <form action="<?php echo basename($_SERVER['REQUEST_URI']); ?>" method="post">
                        <input type="text" name="formMessage" id="formMessage" placeholder="Type a message">
                        <input type="hidden" name="formSelfId" value="<?php echo $selfId ?>">
                        <input type="hidden" name="formChattingUser" value="<?php echo $userId ?>">
                        <input type="hidden" name="formUseSenderInsteadOfReceiver" value="<?php echo $useSenderInsteadOfReceiver ?>">
                        <input type="submit" name="submit" value="Send">
                    </form>
                </div>
                <?php while ($message = mysqli_fetch_array($messagesResult)) {
                    $date = $message[3];
                    $messageContent = $message[2];
                    $senderMessageUserId = $message[1]
                ?>
                    <span class='message <?php echo $senderMessageUserId == $userId? 'message-left' : 'message-right'; ?>'>
                        <?php echo "$date: $messageContent" ?>
                    </span>
                <?php
                } 
                ?>
            </div>
            <?php } else {
                echo "<center>Please Select a chat to start messaging!<center>";
            } ?>
        </div>
    </div>
</body>
</html>

<?php 
    if (isset($_POST["submit"])) {
        $senderUserId = $_POST["formUseSenderInsteadOfReceiver"]? $_POST["formSelfId"] : $_POST["formChattingUser"];
        $receiverUserId = $_POST["formUseSenderInsteadOfReceiver"]? $_POST["formChattingUser"] : $_POST["formSelfId"];
        $message = $_POST["formMessage"];
        $dateTimeNow = date('Y-m-d H:i:s');
        $sendMessageQuery = "INSERT INTO chatMessages (senderUserId, receiverUserId, message, dateCreated, dateUpdated) VALUES ('$senderUserId', '$receiverUserId', '$message', '$dateTimeNow', '$dateTimeNow')";
        mysqli_query($connection, $sendMessageQuery);
        echo "<script>location.replace(location.href);</script>"; // ensure refresh with get method
    }
?>

<script>
    setTimeout(() => {
        location.replace(location.href) 
    }, 10000);
</script>

<style>
.page-content {
    padding: 0px;
    padding-left: 80px;
    height: 95%;
}

.chat-sidebar {
    width: 80px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #ADD8E6;
    border-left: 1px solid #ddd;
    overflow: hidden;
    z-index: 1;
    border: 1px solid grey;
}

.chat-sidebar:hover {
    width: 300px
}

.chat-list-item {
    margin: 80px 20px;
}

.chat-item {
    display: flex;
    align-items: center;
    padding: 25px 0px;
    height: 100%;
    white-space: nowrap;
    border-bottom: 1px solid grey;
}

.avatar {
    margin-right: 25px;
}

.chat-content {
    display: flex;
    flex-direction: column;
}

.icon {
    font-size: 24px;
}

.chat-expand {
    position: absolute;
    left: 100%;
    top: 0;
    width: 0;
    overflow: hidden;
    height: 100%;
}

.chat-icon-item:hover .chat-expand {
    width: 250px;
}

.main-content {
    height: 100%;
}

.user-content {
    display: flex;
    align-items: center;
    background-color: #F9F9F9;
    padding: 0px 50px;
    height: 20%;
}

.user-details {
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    height: 200px;
}

.user-details-avatar {
    height: 150px;
    width: 150px;
}

.messaging-content {
    display: flex;
    flex-direction: column-reverse;
    height: 80%;
    overflow-y: auto;
}

.text-box-message {
    padding: 25px;
    background-color: #ADD8E6;
}

.message {
    background-color: #F9F9F9;
    padding: 10px 50px;
    border-radius: 25px;
    width: 50%;
    margin: 30px;
    margin-top: 0px;
}

.message-left {
    margin-left: auto;
}

.message-right {
    margin-right: auto;
}

</style>