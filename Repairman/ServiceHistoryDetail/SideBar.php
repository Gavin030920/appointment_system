<div class="sidebar" id="sidebar">
        <ul>
            <li class="border"><a href="../ServiceHistory/index.php">Service History</a></li>    
            <li class="border"><a href="../CustomerService/index.php">Customer Service</a></li>
            <li class="border"><a href="../ServiceHistoryDetail/Logout.php">Logout</a></li>
        </ul>

    </div>  
<script>
    const burgerButton = document.querySelector('.top-bar-button');
    const sidebar = document.getElementById('sidebar');

    burgerButton.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-active');
    });
</script>
<style>
.sidebar {
    position: fixed;
    left: -500px;
    height: 100%;
    width: 500px;
    background-color: #f5f5f5;
    box-shadow: 2px 0 5px #0000000D;
    padding-top: 60px;
    z-index: 2;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    padding: 10px 25px;
    text-decoration: none;
    display: block;
}

.sidebar ul li a:hover {
    background-color: white;
}

.sidebar-active {
    left: 0;
}

.calender {
    margin-top: 250px;
}

.calender-header {
    font-size: large;
    font-weight: bold;
}

.calender td {
    padding: 10px;
    border: 1px solid #0000000D;
    text-align: center;
}

.border {
    border-bottom: 1px solid black;
}
</style>