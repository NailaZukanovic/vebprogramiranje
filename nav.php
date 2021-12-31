<nav>
    <ul class='hideNav' id='navList'>
        <?php
        // echo "
        //     <li>
        //         <a href='index.php'>
        //             <img src='Assets//Hospital_logo.png' style='width: 6em; height: 4em;'/>
        //         </a>
        //     </li>
        // ";
        if (isset($_SESSION['user']) && isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 'admin') {
                echo "
            <li>
                <li>
                    <a href='createTournament.php'>
                        <p>Zakazi turnir</p>
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
                    <a href='boxers.php'>
                        <p>Bokseri</p>
                    </a>
                </li>
                <li>
                    <a href='team.php'>
                        <p>Tim</p>
                    </a>
                </li>
             </li>
            ";
            } else {
                echo "
             <li>
                <li>
                    <a href='trainers.php'>
                        <p>Treneri i pozivi</p>
                    </a>
                </li>
                <li>
                    <a href='trainer.php'>
                        <p>Moj Trener</p>
                    </a>
                </li>
                <li>
                    <a href='training.php'>
                        <p>Vezbaj</p>
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
                    <a href='profile.php?username={$_SESSION['user']['username']}'>
                        {$_SESSION['user']['username']}
                        <img 
                            class='avatar' 
                            src='{$_SESSION['user']['profilePicture']}' 
                        />
                    </a>
                </li>
            ";
        }
        ?>
    </ul>
</nav>
<?php 
    echo "
        <div class='burger-menu' onclick='toggleSider()'>
            <div class='burger-line'></div>
            <div class='burger-line'></div>
            <div class='burger-line'></div>
        </div>
    ";
?>
<script src='JS/navbar.js'></script>