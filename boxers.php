<?php require "database.php" ?>
<?php
    if (!$_SESSION['user']) {
        header("Location: login.php");
    }

    if ($_SESSION['type'] != 'boxer') {
        header("Location: index.php");
    }
?>
    <?php include 'header.php';?>
    <?php require 'nav.php' ?>
    <div class="container container-lg mt-2 index">
        <div class="info">
            
        <!-- </div> -->

        <div class="header mt-2">
            <h3>
                Izaberite doktora
            </h3>
        </div>

        <div class="info">
            <?php
                $Available_Trainers_Query = "
                    SELECT * FROM trainers
                ";

                $result = mysqli_query($CONNECTION, $Available_Trainers_Query);


                echo "<table bgcolor='#f1f1f1'>";
                while($row = mysqli_fetch_array($result)) {
                        echo "
                             <tr bgcolor='#f1f1f1'>
                                 <td><img class='avatar' src='{$row['profilePicture']}' /></td>
                                 <td><a href='boxers.php?fk_trainers={$row['id']}'> {$row['name']} </td>
                                 <td> {$row['lastname']} </td>
                             </tr>
                         ";
                //     }
                }
                echo "</table>";

            ?>
			
            <?php
                $fk_trainers = $_GET['fk_trainers'];
				$id = (int)$_SESSION['user']['id'];
                $Update_Boxers_Query = "
                    UPDATE boxers SET fk_trainers = {$fk_trainers} WHERE id = {$id}";

                $result = mysqli_query($CONNECTION, $Update_Boxers_Query);
                if($result)
				{
					echo "
						<h1>Uspesno ste izabrali lekara</h1>
					";
				}
				else
					echo "
						<h1>Nista od konekcije</h1>
					";
            ?>


        </div>

        <div class="header mt-2">
            <h3>
                Vasi odgovori lekaru
            </h3>
        </div>

        <div class="info">
            <?php
                echo "
                    <form method='POST' action='boxers.php' class='mb-2 mt-1' enctype='multipart/form-data'>
                        <div id='basicInfo'>
                        <label for='description'> Napisi svom lekaru: </label>
                        <input type='text' name='description' id='description' class='form-input size-lg' style='width:70%'/>
                        <button type='submit'class='mt-1 size-lg' name='odgovor'> Odgovori </button>
                    </form>
                "       


            ?>

            <?php
                if(isset($_POST['odgovor']))
                {
                    $description = $_POST['description'];

                    $Invite_To_Coach = "
                 INSERT INTO `Invitations` (
                     `createdBy`,
                     `createdFor`,
                     `description`
                 ) VALUES (
                     '{$_SESSION['user']['id']}',
                     '{$_SESSION['user']['fk_trainers']}',
                     '{$description}'
                 )
             ";

                    $result = mysqli_query($CONNECTION, $Invite_To_Coach);
                }



            ?>
        </div>


        <div class="header mt-2" style="background-color:#e6ffff">
            <h3>
                Pregled svih poruka
            </h3>
        </div>

        <div class="info">
            <?php 
                $Get_News_Query = "
                SELECT * FROM Invitations
                WHERE createdFor = '{$_SESSION['user']['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Get_News_Query);

                if($result) {
					while($row = mysqli_fetch_array($result)) {
                        echo "
                            <div class='info mt-2'>
                                <div style='display: flex; flex-direction: column'>
                                <p style='padding: 1em;'> {$row['description']} </p>
                                </div>
                            </div>
                        ";
                    }
				}
            ?>
        </div>


        <div class="header mt-2" style="background-color:#e6ffff">
            <h3>
                Pregled kartona
            </h3>
        </div>

        <div class="info">
            <?php

				
                $Get_News_Query = "
                SELECT weight FROM boxers
                WHERE id = {$id}
                ";

                $result = mysqli_query($CONNECTION, $Get_News_Query);

                if($result) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "
							<div class='info mt-2'>
								<div style='display: flex; flex-direction: column'>
								<p style='padding: 1em;'> {$row['weight']} </p>
								</div>
							</div>
                        ";
                    }
                }



            ?>
        </div>

        <div class="header mt-2" style="background-color:#e6ffff">
            <h3>
                Pregled usluga
            </h3>
        </div>

        <div class="info">
	<section class="vc_row py-40 py-md-80">
		<div class="container align-self-center">
			<div class="row" id="categories-container">
				
				<div class="lqd-column service col-12 offset-sm-0 col-sm-6 col-md-4 col-xl-3" style="flex: 0 0 33.33333%;
    max-width: 33.33333%;">
						<div class="iconbox iconbox-service iconbox-circle iconbox-shadow-hover
										iconbox-xl iconbox-heading-sm iconbox-filled iconbox-filled-hover 
										iconbox-has-fill-element border-athens-gray pt-md-0 pb-md-35 py-10">
							<div class="d-flex flex-wrap align-content-md-center align-items-md-center flex-grow-1
										flex-sm-column justify-content-start align-items-center align-content-start 
										justify-content-sm-start justify-items-sm-center align-content-sm-center w-100 px-md-0 px-1">
								<span class="iconbox-fill-el iconbox-fill-el-hover"
									style="background-image: url(/static/img/usluge/bg.jpg);"></span>

								<div class="category-image-wrap d-none d-md-block z-index-1">
									<figure>
                                        
                                          <img src="Assets//1._ultrazvuk-Euromedik.jpg" alt="Ultrazvuk (UZ) sa kolor doplerom">
                                        
									</figure>
								</div>

								<div class="contents px-2 px-md-0">
									<h3 class="mb-0 text-primary text-left text-sm-center">Ultrazvuk (UZ) sa kolor doplerom</h3>
									<p class="d-none d-md-block">Ultrazvučni pregled je potpuno bezopasna metoda pregleda unutrašnjih organa. Tehnika pregleda se zasniva na zvučnim talasima visoke frekfencije koji prolaze kroz tkiva i organe, odbijaju se različitom brzinom, vraćaju se ka sondi i vizealizuju na ekr</p>
									<span
										class="btn-link d-none d-md-block font-weight-bold text-uppercase">Zakazi</span>
								</div><!-- /.contents -->
							</div>
						</div><!-- /.iconbbox -->
				</div><!-- /.lqd-column col-6 col-sm-6 col-md-4 col-xl-3 -->
				
				<div class="lqd-column service col-12 offset-sm-0 col-sm-6 col-md-4 col-xl-3" style="flex: 0 0 33.33333%;
    max-width: 33.33333%;">						<div class="iconbox iconbox-service iconbox-circle iconbox-shadow-hover
										iconbox-xl iconbox-heading-sm iconbox-filled iconbox-filled-hover 
										iconbox-has-fill-element border-athens-gray pt-md-0 pb-md-35 py-10">
							<div class="d-flex flex-wrap align-content-md-center align-items-md-center flex-grow-1
										flex-sm-column justify-content-start align-items-center align-content-start 
										justify-content-sm-start justify-items-sm-center align-content-sm-center w-100 px-md-0 px-1">
								<span class="iconbox-fill-el iconbox-fill-el-hover"
									style="background-image: url(/static/img/usluge/bg.jpg);"></span>

								<div class="category-image-wrap d-none d-md-block z-index-1">
									<figure>
                                        
                                          <img src="Assets//3._EUROMEDIK-rentgen-radiografija.jpg" alt="Rendgen (RTG)">
                                        
									</figure>
								</div>

								<div class="contents px-2 px-md-0">
									<h3 class="mb-0 text-primary text-left text-sm-center">Rendgen (RTG)</h3>
									<p class="d-none d-md-block">Radiografija je bezbolna i neinvazivna dijagnostička metoda koja se zasniva na primeni X zraka za snimanje različitih delova tela i organa. Pruža informacije o zapaljenskim bolestima organa,  tumorima,  povredama kostiju, degenerativnim i zapaljinski</p>
									<span
										class="btn-link d-none d-md-block font-weight-bold text-uppercase">Zakazi</span>
								</div><!-- /.contents -->
							</div>
						</div><!-- /.iconbbox -->
				</div><!-- /.lqd-column col-6 col-sm-6 col-md-4 col-xl-3 -->
				
				<div class="lqd-column service col-12 offset-sm-0 col-sm-6 col-md-4 col-xl-3" style="flex: 0 0 33.33333%;
    max-width: 33.33333%;">						<div class="iconbox iconbox-service iconbox-circle iconbox-shadow-hover
										iconbox-xl iconbox-heading-sm iconbox-filled iconbox-filled-hover 
										iconbox-has-fill-element border-athens-gray pt-md-0 pb-md-35 py-10">
							<div class="d-flex flex-wrap align-content-md-center align-items-md-center flex-grow-1
										flex-sm-column justify-content-start align-items-center align-content-start 
										justify-content-sm-start justify-items-sm-center align-content-sm-center w-100 px-md-0 px-1">
								<span class="iconbox-fill-el iconbox-fill-el-hover"
									style="background-image: url(/static/img/usluge/bg.jpg);"></span>

								<div class="category-image-wrap d-none d-md-block z-index-1">
									<figure>
                                        
                                          <img src="Assets//5._euromedik-magnetna-rezonanca-mr.jpg" alt="Magnetna rezonancija (MR)">
                                        
									</figure>
								</div>

								<div class="contents px-2 px-md-0">
									<h3 class="mb-0 text-primary text-left text-sm-center">Magnetna rezonancija (MR)</h3>
									<p class="d-none d-md-block">Magnetna rezonancija je neinvazivna i precizna dijagnostička metoda, koja daje konkretnu sliku o zdravlju pojedinih organa, organskih sistema, ali i o stanju čitavog organizma. Bezbolna je i potpuno neškodljiva za pacijente.</p>
									<span
										class="btn-link d-none d-md-block font-weight-bold text-uppercase">Zakazi</span>
								</div><!-- /.contents -->
							</div>
						</div><!-- /.iconbbox -->
				</div><!-- /.lqd-column col-6 col-sm-6 col-md-4 col-xl-3 -->
				
				<div class="lqd-column service col-12 offset-sm-0 col-sm-6 col-md-4 col-xl-3" style="flex: 0 0 33.33333%;
    max-width: 33.33333%;">						<div class="iconbox iconbox-service iconbox-circle iconbox-shadow-hover
										iconbox-xl iconbox-heading-sm iconbox-filled iconbox-filled-hover 
										iconbox-has-fill-element border-athens-gray pt-md-0 pb-md-35 py-10">
							<div class="d-flex flex-wrap align-content-md-center align-items-md-center flex-grow-1
										flex-sm-column justify-content-start align-items-center align-content-start 
										justify-content-sm-start justify-items-sm-center align-content-sm-center w-100 px-md-0 px-1">
								<span class="iconbox-fill-el iconbox-fill-el-hover"
									style="background-image: url(/static/img/usluge/bg.jpg);"></span>

								<div class="category-image-wrap d-none d-md-block z-index-1">
									<figure>
                                        
                                          <img src="Assets//4._euromedik-multislajsni-skener-msct.jpg" alt="Multislajsni skener (MSCT)">
                                        
									</figure>
								</div>

								<div class="contents px-2 px-md-0">
									<h3 class="mb-0 text-primary text-left text-sm-center">Multislajsni skener (MSCT)</h3>
									<p class="d-none d-md-block">Snimanje na MSCT-u se koristi da bi se dobile informacije o unutrašnjim organima: jetra, pankreas, nadbubrežne žlezde, pluća, srce, krvni sudovi, kosti, kičme i drugih organa. Aparat pomoću X-zraka pravi slike slojeva pojedinih organa.</p>
									<span
										class="btn-link d-none d-md-block font-weight-bold text-uppercase">Zakazi</span>
								</div><!-- /.contents -->
							</div>
						</div><!-- /.iconbbox -->
				</div><!-- /.lqd-column col-6 col-sm-6 col-md-4 col-xl-3 -->
				
				<div class="lqd-column service col-12 offset-sm-0 col-sm-6 col-md-4 col-xl-3" style="flex: 0 0 33.33333%;
    max-width: 33.33333%;">						<div class="iconbox iconbox-service iconbox-circle iconbox-shadow-hover
										iconbox-xl iconbox-heading-sm iconbox-filled iconbox-filled-hover 
										iconbox-has-fill-element border-athens-gray pt-md-0 pb-md-35 py-10">
							<div class="d-flex flex-wrap align-content-md-center align-items-md-center flex-grow-1
										flex-sm-column justify-content-start align-items-center align-content-start 
										justify-content-sm-start justify-items-sm-center align-content-sm-center w-100 px-md-0 px-1">
								<span class="iconbox-fill-el iconbox-fill-el-hover"
									style="background-image: url(/static/img/usluge/bg.jpg);"></span>

								<div class="category-image-wrap d-none d-md-block z-index-1">
									<figure>
                                        
                                          <img src="Assets//2._EUROMEDIK-mamografija.jpg" alt="Mamografija">
                                        
									</figure>
								</div>

								<div class="contents px-2 px-md-0">
									<h3 class="mb-0 text-primary text-left text-sm-center">Mamografija</h3>
									<p class="d-none d-md-block">Mamografija je bezbolna, neškodljiva rendgenska tehnika, kojom se dobija jasna slika o unutrašnjosti dojke, radi se u svrhe ranog otkrivanja oboljenja dojki.</p>
									<span
										class="btn-link d-none d-md-block font-weight-bold text-uppercase">Zakazi</span>
								</div><!-- /.contents -->
							</div>
						</div><!-- /.iconbbox -->
				</div><!-- /.lqd-column col-6 col-sm-6 col-md-4 col-xl-3 -->
				
				<div class="lqd-column service col-12 offset-sm-0 col-sm-6 col-md-4 col-xl-3" style="flex: 0 0 33.33333%;
    max-width: 33.33333%;">						<div class="iconbox iconbox-service iconbox-circle iconbox-shadow-hover
										iconbox-xl iconbox-heading-sm iconbox-filled iconbox-filled-hover 
										iconbox-has-fill-element border-athens-gray pt-md-0 pb-md-35 py-10">
							<div class="d-flex flex-wrap align-content-md-center align-items-md-center flex-grow-1
										flex-sm-column justify-content-start align-items-center align-content-start 
										justify-content-sm-start justify-items-sm-center align-content-sm-center w-100 px-md-0 px-1">
								<span class="iconbox-fill-el iconbox-fill-el-hover"
									style="background-image: url(/static/img/usluge/bg.jpg);"></span>

								<div class="category-image-wrap d-none d-md-block z-index-1">
									<figure>
                                        
                                          <img src="Assets//6._euromedik-angiografije.jpg" alt="Angiografija interventna radiologija">
                                        
									</figure>
								</div>

								<div class="contents px-2 px-md-0">
									<h3 class="mb-0 text-primary text-left text-sm-center">Angiografija interventna radiologija</h3>
									<p class="d-none d-md-block">Angiografija ili arterijografija je invazivna dijagnostička metoda pregleda unutrašnjosti krvnih sudova čovekovog tela. Ubrizgavanjem kontastnog stredstva dobijamo detalljan  prikaz unutrašnjosti krvnih sudova.</p>
									<span
										class="btn-link d-none d-md-block font-weight-bold text-uppercase">Zakazi</span>
								</div><!-- /.contents -->
							</div>
						</div><!-- /.iconbbox -->
				</div><!-- /.lqd-column col-6 col-sm-6 col-md-4 col-xl-3 -->
				
				<div class="lqd-column service col-12 offset-sm-0 col-sm-6 col-md-4 col-xl-3" style="flex: 0 0 33.33333%;
    max-width: 33.33333%;">
                        	<div class="iconbox ">
							<div class="d-flex flex-wrap align-content-md-center align-items-md-center flex-grow-1
										flex-sm-column justify-content-start align-items-center align-content-start 
										justify-content-sm-start justify-items-sm-center align-content-sm-center w-100 px-md-0 px-1">
								<span class="iconbox-fill-el iconbox-fill-el-hover"
									style="background-image: url(/static/img/usluge/bg.jpg);"></span>

								<div class="category-image-wrap d-none d-md-block z-index-1">
									<figure>
                                        
                                          <img src="Assets//8._euromedik-endoskopija.jpg" alt="Endoskopije">
                                        
									</figure>
								</div>

								<div class="contents px-2 px-md-0">
									<h3 class="mb-0 text-primary text-left text-sm-center">Endoskopije</h3>
									<p class="d-none d-md-block">Endoskopijom se otkriva šta je uzrok različitih gastro problema, kao što su mučnine, često povraćanje, osećaj nadutosti i muke, bol u stomaku, bol u želudcu, teškoće pri gutanju hrane i tečnosti, izbacivanja krvi itd.</p>
									<span
										class="btn-link d-none d-md-block font-weight-bold text-uppercase">Zakazi</span>
								</div><!-- /.contents -->
							</div>
						</div><!-- /.iconbbox -->
				</div><!-- /.lqd-column col-6 col-sm-6 col-md-4 col-xl-3 -->
				

			</div>
		</div>
	</section>
    </div>
    </div>

</div>
    <?php include 'footer.php';?>
