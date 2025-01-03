<?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        $profile_picture = $_SESSION['profile_picture'];
        $user_type = $_SESSION['user_type'];
    
        echo "<header>

    <div class='off-screen-menu'>
        <ul>
            <a href='index.php'><li>Home</li></a>
            <a href='services_page.php'><li>Services</li></a>
            <a href='pharmacy.php'><li>Pharmacy</li></a>
            <a href='pet_store.php'><li>Pet Store</li></a>
            <a href='faq_page.php'><li>FAQ</li></a>
        </ul>
    </div>

    <nav>";
    if ($user_type != 'employee') {
        echo "<div class='hb_menu'>
            <div></div>
            <div></div>
            <div></div>
        </div>
    
        <a href='index.php'><img id='logo' src='assets/images/logo.jpeg' alt='' width='80px'></a>
    
        <form action='process/search.php', method='POST'>
            <input type='text' name='search-term'>
            <button type='submit' class='search-btn'><img src='assets/icons/search-icon.png'></button>
        </form>";
    }

        echo "<a href='".$_SESSION['profile_path']."'><img id='user_profile_picture' src='profile_pictures/users/$profile_picture' alt='' width='80px' height='80px'></a>
    </nav>
</header>";
    } else {
        echo "<header>

    <div class='off-screen-menu'>
        <ul>
            <a href='index.php'><li>Home</li></a>
            <a href='services_page.php'><li>Services</li></a>
            <a href='pharmacy.php'><li>Pharmacy</li></a>
            <a href='pet_store.php'><li>Pet Store</li></a>
            <a href='faq_page.php'><li>FAQ</li></a>
        </ul>
    </div>

    <nav>
        <div class='hb_menu'>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <a href='index.php'><img id='logo' src='assets/images/logo.jpeg' alt='' width='80px'></a>

        <form action='process/search.php' method='POST'>
            <input type='text' name='search-term'>
            <button type='submit' class='search-btn'><img src='assets/icons/search-icon.png'></button>
        </form>
        <div>
            <a href='login.php'><button class='login-signup-btn'>Login</button></a>
            <a href='user_registration.php'><button class='login-signup-btn'>Sign up</button></a>
        </div>
    </nav>
</header>";
    }
?>




