<script>
    $(document).ready(function () {
        $('#sidebar-expandable').on('click', function () {
            $('#sidebar').toggleClass('shrink');
            $('#sidebar').toggleClass('expand');
            $('#sidebar .sidebar-item span').toggleClass('shrink');
            $('#sidebar .sidebar-item span').toggleClass('expand');
            $('#sidebar').trigger('toggle');
        });
    });

    $(document).ready(function () {
        $('.sidebar-item.<?= $this->active_sidebar ?>').addClass('active');
    });

</script>

<style> 
    #global-container {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 100%;
        min-height: 100vh;
    }

    nav {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    #logo {
        padding: 3px 20px;
    }

    #logo:hover {
        cursor: pointer;
    }

    #logo img {
        width: 30px;
        height: 30px;
    }
    
    #logo span {
        font-size: 19px;
        font-weight: 550;
        color: #fff;
        margin-left: 10px;
    }

    #user {
        padding: 3px 20px;
    }

    #user .separator {
        margin: 0 10px;
    }

    #user img {
        margin: 0 5px;
    }

    #user a:hover {
        text-decoration: none;
        color: #fff;
        background-color: #ffffff00;
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
    }

    #bottom {
        flex: 1;
        max-width: 100%;
        display: flex;
    }

    #sidebar {
        background-color: #222D30;
        color: #fff;
        transition: all 0.3s ease-in-out;
    }

    #sidebar.shrink {
        width: 53px;
    }

    #sidebar.expand {
        width: 199px;
    }

    #sidebar .sidebar-item-list {
        width: 100%;
        padding: 0;
    }

    #sidebar .sidebar-item {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        color: #fff;
        text-decoration: none;
        padding: 7px 11px;
        cursor: pointer;
    }

    #sidebar .sidebar-item:hover {
        background-color: #550;
    }

    #sidebar .sidebar-item.active {
        background-color: var(--bs-accent);
    }

    #sidebar .sidebar-item span {
        font-size: 17px;
        overflow-x: hidden;
        margin-top: 3px;
        white-space: nowrap;
    }

    #sidebar .sidebar-item span.expand {
        width: 100%;
    }

    #sidebar .sidebar-item span.shrink {
        width: 0;
    }

    #sidebar-expandable {
        display: flex;
        justify-content: right;
        margin: 9px 11px 5px 11px;
    }

    #sidebar img {
        width: 30px;
        height: 30px;
        cursor: pointer;
    }

    .sidebar-item.inventaris img {
        width: 27px !important;
        height: 27px !important;
        margin-right: 1px;
    }

    #content {
        position: relative;
        flex: 1;
        padding: 20px;
        width: 100%;
    }
</style>


<div id="global-container">
    <div id="top">
        <nav class="navbar bg-primary">
            <div id="logo">
                <img src="<?= BASEURL ?>/assets/jti-logo.png">
                <span>Inventaris JTI</span>
            </div>
            <div id="user" class="d-flex">
                <img src="<?= BASEURL ?>/assets/person.svg">
                <span class="text-white"><?= "  " . $_SESSION['nama'] . "(" . $_SESSION['role'] . ")  " ?></span>
                <span class="separator text-white">|</span>
                <a href="<?= BASEURL ?>/Auth/logout">
                    Logout
                    <img src="<?= BASEURL ?>/assets/logout.svg">
                </a>
            </div>
        </nav>
    </div>
    <div id="bottom">
        <div id="sidebar" class="shrink">
            <div id="sidebar-expandable">
                <img src="<?= BASEURL ?>/assets/menu.svg">
            </div>
            <ul class="sidebar-item-list list-unstyled w-100">
                <?php
                foreach ($this->sidebar as $item) {
                    echo '
                        <li>
                            <a class="sidebar-item ' . $item['id'] . '" href="' . BASEURL. '/' . $item['url'] . '">
                                <span class="shrink">' . $item['title'] . '</span>
                                <img src="' . BASEURL . '/assets/' . $item['icon'] . '">
                            </a>
                        </li>
                    ';
                }
                ?>
            </ul>
        </div>
        <div id="content">
