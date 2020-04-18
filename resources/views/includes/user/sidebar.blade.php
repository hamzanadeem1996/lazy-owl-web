<div class="sidebar">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="active">
                    <a href="/home">
                        <i class="iconsmind-Shop-4"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="/user/tasks">
                        <i class="iconsmind-Star"></i>
                        <span>Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="/user/account/{{Auth::id()}}">
                        <i class="iconsmind-Digital-Drawing"></i> Account
                    </a>
                </li>
                <li>
                    <a href="#payment">
                        <i class="iconsmind-Space-Needle"></i> Payment
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="payment">
                <li>
                    <a href="/user/payment-methods">
                        <i class="simple-icon-credit-card"></i> Payment Methods
                    </a>
                </li>
                <li>
                    <a href="/user/payment-history">
                        <i class="simple-icon-credit-card"></i> Payment History
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
