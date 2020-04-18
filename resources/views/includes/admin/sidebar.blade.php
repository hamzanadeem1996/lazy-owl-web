<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/build/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="/"><i class="fa fa-home"></i> Home</a>
                    <li><a href="/admin/user/add"><i class="fa fa-plus"></i> Add User</a>

                    </li>
                    <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/user/active">Active Users</a></li>
                            <li><a href="/admin/user/disabled">Disabled Users</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-users"></i> Service Providers <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/service-provider/active">Active Service Providers</a></li>
                            <li><a href="/admin/service-provider/disabled">Disabled Service Providers</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-users"></i> Consultants <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/consultant/active">Active Consultants</a></li>
                            <li><a href="/admin/consultant/disabled">Disabled Consultants</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-list"></i> Categories <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/category/add">Add Category</a></li>
                            <li><a href="/admin/category/active">Active Categories</a></li>
                            <li><a href="/admin/category/disabled">Disabled Categories</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-list"></i> Sub-Categories <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/sub-category/add">Add Sub-Category</a></li>
                            <li><a href="/admin/sub-category/active">Active Sub-Categories</a></li>
                            <li><a href="/admin/sub-category/disabled">Disabled Sub-Categories</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-book"></i> Education Degree <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/degree/add">Add Degree</a></li>
                            <li><a href="/admin/degree/active">Active Degrees</a></li>
                            <li><a href="/admin/degree/disabled">Disabled Degrees</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-pagelines"></i> Degree Programme <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/programme/add">Add Programme</a></li>
                            <li><a href="/admin/programme/active">Active Programmes</a></li>
                            <li><a href="/admin/programme/disabled">Disabled Programmes</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-paper-plane"></i> Projects <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/project/add">Add Project</a></li>
                            <li><a href="/admin/project/active">Active Projects</a></li>
                            <li><a href="/admin/project/completed">Completed Projects</a></li>
                            <li><a href="/admin/project/discarded">Discarded Projects</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-money"></i> Transactions <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/transaction/add">Add Transactions</a></li>
                            <li><a href="/admin/transaction/history">Transactions History</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-credit-card"></i> Payment Methods <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/payment-methods">Payment Methods</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-bars"></i> Packages <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/package/add">Add Package</a></li>
                            <li><a href="/admin/package/all">Packages List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-question"></i> Queries <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/queries/project">Project Queries</a></li>
                            <li><a href="/admin/queries/contact">Contact Queries</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-cogs"></i> Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/settings/list">Settings List</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
