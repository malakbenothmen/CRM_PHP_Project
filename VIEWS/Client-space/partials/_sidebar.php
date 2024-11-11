<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          <li class="nav-item">
            <a class="nav-link" href="<?php echo APPURL ?>/Client-space/index.php">
           <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Page d'acceuil</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Mon Compte</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo APPURL ?>/Client-space/pages/profile/userProfile.php">Parametre</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Demande Devis</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo APPURL ?>/Client-space/pages/demandeDevis/MesDevis.php">Mes Demandes</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo APPURL ?>/Client-space/pages/demandeDevis/devisNormal.php">Devis Normal</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo APPURL ?>/Client-space/pages/demandeDevis/devisPersonalise.php">Devis Personalisé</a></li>
              </ul>
            </div>
          </li>



          <li class="nav-item">
            <a class="nav-link" href="<?php echo APPURL ?>/Client-space/pages/commande/allCommande.php">
            <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Mes Commandes</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo APPURL ?>/Client-space/pages/facture/allFacture.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Mes Factures</span>
            </a>
          </li>

        </ul>
      </nav>