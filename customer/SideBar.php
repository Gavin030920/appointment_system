<div class="sidebar" id="sidebar">
        <ul>
            <li class="border"><a href="CreateUpdateAppointment.php">Create Appointment</a></li>    
            <li class="border"><a href="ServiceSuggestion.php">Service Suggestion</a></li>
            <li class="border"><a href="ChattingPage.php">Chatting</a></li>
            <li class="border"><a href="BillingList.php">Billing History</a></li>
            <li class="border"><a href="AccountSetting.php">Account Setting</a></li>
            <li class="border"><a href="MerchantRegisterForm.php">Want to become a merchant? :D</a></li>
        </ul>

        <center>
            <div class="calender">
                <table>
                    <span class="calender-header">October 2023</span>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </center>
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