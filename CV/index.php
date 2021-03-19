<?php
    // include 'includes/kernel.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma super page</title>

    <!-- style -->
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">

</head>

<body id='body'>

    <!--     
        Barre de navigation
     -->
    <nav id="nav">
        <div class="container">

            <div class="leftmenu">
                <div class="nav-elem" id="brand">
                    <a href="./">
                        <img src="assets/medias/Psykokwak-RFVF.png" alt="" width="30" height="30" title="Psykokwak : pokémon migraineux.">
                        Boilley.info
                    </a>
                </div>

                <div class="nav-elem">
                    <!-- menu auto-construit -->
                    <div id="menu-area"></div>
                </div>
            </div>

            <div class="nav-elem" id="login">
                <a href="user/account.php">
                    <img src="asset/user.jpg" alt="defaultavata" width="20" height="20">
                </a>
            </div>

        </div>
    </nav>

    <div id="core" class="container">

        <aside id="leftaside">      
            <section id="picture" >
                <img class="leftAsided" src="assets/medias/crop3_offset.png" alt="" width="100px">
            </section>
           
            <section id="About" class="menu-item">
                <article>
                    <h2>About me</h2>
                    <p>
                        Passionné : J’ai découvert les
                        systèmes Linux dès 2009. Puis je
                        me suis intéressé aux langages du
                        web. J’ai commencé par PHP, MySql
                        et Javascript, et acquis des
                        rudiments de C, C++ et Python.
                    </p>
                    <p>
                        Patient : je sais prendre le temps
                        de bien faire, je sais expliquer mon
                        travail et développer mes idées.
                    </p>
                    <p>
                        Curieux : J’apprends vite et
                        m’adapte rapidement à de
                        nouveaux langages, librairies,
                        frameworks, outils et méthodes de
                        travail.
                    </p>
                </article>
            </section>
        </aside>


        <section id="main">
            <!-- 
                En-tête de la page
            -->
            <header id="header">
                <div>
                    <h1>Mon super parcours</h1>
                    <p>while ( you->like(this) ) { continue; }</p>
                </div>
            </header>

            <!--     
                Contenu 
            -->
            <main>
                <section id="Skills" class="menu-item">
                    <h2>Compétences</h2>
                    <ol>
                        <li class="square green">
                            <div class="date">
                                Back-End
                            </div>
                            <div class="detail">
                                PHP7+ (OOP), Composer + Symfony (Doctrine, Back-end Twig), MariaDB / MySQL.
                            </div> 
                        </li>
                        <li class="square green">
                            <div class="date">
                                Front-End
                            </div>
                            <div class="detail">
                                JavaScript (OOP), Node.Js, JQuery, Vue.js, Bootstrap4, SASS CSS, thèmes WordPress.
                            </div>
                        </li>
                        <li class="square green">
                            <div class="date">System</div>
                            <div class="detail">
                                GNU/Linux Shell (Debian) + Apache2 server, Autres
                            </div>
                        </li>
                        <li class="square green">
                            <div class="date">
                                Autres
                            </div>
                            <div class="detail">
                                Gimp, Inkscape et autres solutions libres.
                            </div>
                        </li>
                    </ol>

                </section>

                <section id="Exps" class="menu-item">
                    <h2>Expériences</h2>
                    <ol>
                        <li class="square red">
                            <div class="date">
                                2019
                            </div>
                            <div class="detail">
                                Développement du site fastlab-timing.com
                                Institut Femto-St
                                Laboratoire : Temps Fréquences (ENSMM)
                            </div> 
                        </li>
                        <li class="square red">
                            <div class="date">
                                2014 / 19
                            </div>
                            <div class="detail">
                                Bénévole et Président au Fa²Lab Net-Iki
                                (animation, dessin et impressi²n 3d)
                                Intérimaire Adecco / LI²
                                (bâtiment, commerce, industrie)
                            </div>
                        </li>
                        <li class="square red">
                            <div class="date">
                                2007 / 17
                            </div>
                            <div class="detail">
                                Bénévole puis encadrant (CDD)
                                Amis Chevreaux Châtel
                            </div>
                        </li>

                    </ol>
                </section>

                <section id="Grades" class="menu-item">
                    <h2>Diplômes</h2>
                    <ol>
                        <li class="square blue">
                            <div class="date">
                                2018
                            </div>
                            <div class="detail">
                                Développeur web et web mobile
                                Titre pro Bac+2 (ACS Besançon)
                            </div>
                        </li>

                        <li class="square blue">
                            <div class="date">
                                2016
                            </div>
                            <div class="detail">
                                Titre Pro Maçon / Tailleur de pierre
                            </div>
                        </li>


                        <li class="square blue">
                            <div class="date">
                                2008
                            </div>
                            <div class="detail">
                                Bac Pro CGEA
                            </div>
                        </li>

                        <li class="square blue">
                            <div class="date">
                                2004
                            </div>
                            <div class="detail">
                                BEPA CPA
                            </div>
                        </li>
                    </ol>
                </section>
            
                <!-- 
                    <section id="foo" class="menu-item"></section> 
                -->

            </main>
        </section>
    </div>


    <!-- 
        Pied de page
     -->
    <footer id="footer">

        <div class="container title">
            BOILLEY ADRIEN © GPL V 3.0
        </div>


        <div class="container">
            <div class="col">
                <ul>
                    <li>
                       <button onclick="popup('form-contact')">Formulaire</button>
                    </li>
                    <li>
                        <a href="mailto:adrien.boilley@gmail.com">adrien.boilley@gmail.com</a>
                    </li>
                    <li>
                        <a href="tel:+33648238042">+33 O6 48 23 80 42</a>
                    </li>
                    <li>
                        19 Rue de l'Amitié - 25 000 Besançon.
                    </li>
                </ul>
            </div>

            <div class="col">
                <img src="assets/medias/d599c1ed3700b8990c26ca5bbb77ff4a.svg" alt="" width="100" height="100">
                <img src="assets/medias/79993510bb0baff30c497a6a136f0b1c.svg" alt="" width="100" height="100">
            </div>

        </div>
    </footer>

    <!-- <div class="hidden" id ="form-login">
    <h3>Login</h3>
        <form action="includes/API/login.php" method="post">
        <fieldset>
                <button type="submit">Submit form</button>
                <button type="reset">Reset form</button>
            </fieldset>

        </form>
    </div> -->

    <div class="hidden" id ="form-contact">
        <h3>Contact</h3>
        <form action="includes/API/form.php" method="post">
            
            <fieldset>
                <label for="email">You're email</label>
                <input type="email" name="email" id="email">
            </fieldset>
            
            <fieldset>
                <label for="subject">Message subject</label>
                <input type="text" name="subject" id="subject">
            </fieldset>
            
            <fieldset>
                <label for="content">Message content</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </fieldset>
            
            <fieldset>
                <button type="submit">Submit form</button>
                <button type="reset">Reset form</button>
            </fieldset>

        </form>
    </div>

    <!-- <script src="assets/js/form.js"></script> -->
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/menu.js"></script>

</body>

</html>