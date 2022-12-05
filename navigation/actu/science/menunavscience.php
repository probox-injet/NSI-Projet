<?php
/**
 * Création d'une cession
 * Elle doit appaitre lorsque qu'on va créer ou utiliser les sessions ($_SESSION)
*/
session_start();
?>
<div class="sidebar close">
    <div class="logo-details">
        <div class="logo">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">Menu</span>
        </div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-links">
        <li>
            <div class="iocn-link">
                <a href="../../../index.php">
                  <i class='bx bx-home'></i>
                  <span class="link_name">Accueil</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Accueil</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-book' ></i>
                    <span class="link_name">Culture</span>
                </a>
                <i class='bx bx-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Culture</a></li>
                <li><a href="#">Spectacle</a></li>
                <li><a href="#">Musique</a></li>
                <li><a href="#">Cinéma</a></li>
                <li><a href="#">Expo</a></li>
                <li><a href="#">Livres</a></li>
                <li><a href="#">Série</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-world'></i>
                    <span class="link_name">Actualité</span>
                </a>
                <i class='bx bx-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="../../../actu/actualite.php">Actualité</a></li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Résumé de l'Actualité</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Résumé de l'Actualité</a></li>
                        <li><a href="../../../actu/resumer_actu/L'Afganistan.pdf">L'Afganistan</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Écologie</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Écologie</a></li>
                        <li><a href="../../actu/resumer_actu/Histoire des Sardines.m4a">Histoire des Sardines</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Photo</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Photo</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="../../../detente/detente.php">
                    <i class='bx bx-book-reader'></i>
                    <span class="link_name">Détente</span>
                </a>
                <i class='bx bx-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="../../../detente/detente.php">Détente</a></li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Cuisine</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Cuisine</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Relaxation</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Relaxation</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Apprendre les bases d'une langue</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Apprendre les bases d'une langue</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Quizz</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Quizz</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                      <a><span class="sub_link_menu">Astrologie</span></a>
                        <i class='bx bx-chevron-down arrow-sub'></i>
                    </div>
                    <ul class="sub-sub-menu">
                        <li><a class="link_name" href="#">Astrologie</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-atom'></i>
                    <span class="link_name">Science</span>
                </a>
                <i class='bx bx-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Science</a></li>
                <li><a href="#">Astronomies</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-cog' ></i>
                    <span class="link_name">Paramètre</span>
                </a>
                <i class='bx bx-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="../../../securite/parametre/parametre.php">Paramètre</a></li>
                <?php
                if(!empty($_SESSION['id']))
                {
                ?>
                <li><a href="../../../securite/connexion_user.php">Profil</a></li>
                <li><a href="../../../securite/deconnexion_user.php">Déconnexion</a></li>
                <?php
                }
                else
                {
                ?>
                <li><a href="../../../securite/inscription_user.php">Inscription</a></li>
                <li><a href="../../../securite/connexion_user.php">Connexion</a></li>
                <?php
                }
                ?>
                <li><a href="#">Thème</a></li>
            </ul>
        </li>
        <?php
        /**
            * On verifi si l'utilisateur à un sessions ID
        */
        if(!empty($_SESSION['id']))
        {
        ?>
        <li>
            <div class="iocn-link">
                <a href="../../../Files_and_Directories/upload/verification.php">
                    <i class='bx bx-export' ></i>
                    <span class="link_name">Importer</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Importer</a></li>
            </ul>
        </li>
        <?php
        }
        else
        {
        ?>
        <li>
            <div class="iocn-link">
                <a href="../../../Files_and_Directories/upload/verification.php">
                    <i class='bx bx-download'></i>
                    <span class="link_name">Télécharger</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Télécharger</a></li>
            </ul>
        </li>
        <?php
        }
        ?>
    </ul>
</div>
<script src="../../../js/nav.js"></script>