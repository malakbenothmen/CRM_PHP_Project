<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          <li class="nav-item">
            <a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/Dashboard.php" >
           <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Dadshboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Utilisateur</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/admnPages/utilisateur/gestionuser.php">gestion Client</a></li>
              </ul>
            </div>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/admnPages/utilisateur/gestionadmin.php">gestion Admin</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title"> Devis</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/admnPages/Devis/demande.php">les Demandes</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/admnPages/Devis/gestDevis.php">gestion Devis</a></li>
              </ul>
            </div>
          </li>



          <li class="nav-item">
            <a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/admnPages/commande/gestCom.php">
            <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title"> Commande</span>
            </a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/admnPages/produits/gestArt.php">
            <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title"> Produit</span>
            </a>
          </li>
          


          <li class="nav-item">
            <a class="nav-link" href="<?php echo APPURL ?>/Admin-panel/admnPages/facture/gestFact.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title"> Facture</span>
            </a>
          </li>

        </ul>
      </nav>