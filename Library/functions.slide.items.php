<?php

function accueilSlideBar($indentation)
{
?>
<li>
    <div class="iocn-link">
        <a href="<?php $indentation?>index.php">
          <i class='bx bx-home'></i>
          <span class="link_name">Accueil</span>
        </a>
    </div>
    <ul class="sub-menu">
        <li><a class="link_name">Accueil</a></li>
    </ul>
</li>
<?php
}