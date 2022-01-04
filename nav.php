<nav>
    <ul class='hideNav' id='navList'>
        <?php
        if (isset($_SESSION['user']) && isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 'admin') {
                echo "
            <li>
                <li>
                    <a href='createNews.php'>
                        <p>Upravljaj vestima</p>
                    </a>
                </li>
                <li>
                    <a href='adminPage.php'>
                        <p>Admin stranica</p>
                    </a>
                </li>
            </li>
            ";
            } else if ($_SESSION['type'] == 'trainer') {
                echo "
             <li>
                <li>
                    <a href='trainer.php'>
                        <p>Lekar</p>
                    </a>
                </li>
             </li>
            ";
            } else {
                echo "
             <li>
                <li>
                    <a href='boxers.php'>
                        <p>Pacijent</p>
                    </a>
                </li>
             </li>
            ";
            }
        } else {
            echo "
                <li>
                    <a href='index.php'>
                        <p>Pocetna</p>
                    </a>
                </li>
                <li>
                    <a href='contact.php'>
                        <p>Kontaktiraj nas</p>
                    </a>
                </li>
                <li>
                    <a href='login.php'>
                        <p>Prijavi se</p>
                    </a>
                </li>
            ";
        }
        if(isset($_SESSION['user'])) {
            echo "
                <li>
                    <a href='logout.php'>
                        <p>Odjavi se</p>
                    </a>
                </li>
                <li>
                    <div>
                        {$_SESSION['user']['username']}
                        <img 
                            class='avatar' 
                            src='{$_SESSION['user']['profilePicture']}' 
                        />
                    </div>
                </li>
            ";
        }
        ?>
    </ul>
</nav>
<script src='JS/navbar.js'></script>