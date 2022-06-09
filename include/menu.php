    <?php
     $url = $_SERVER['REQUEST_URI'];    
    //var_dump($url);
    $client="";
    $annonce="";
    $piece="";
    $services="";
    $region="";
    $photo="";
    $regionobjet="";
    if(strpos($url,"PageClient.php")>0){
        $client="active";
    }
    if(strpos($url, "PageAnnonce.php")>0){
       $annonce="active";
    }
    if(strpos($url, "PagePiece.php")>0){
       $piece="active";
    }
    if(strpos($url, "PageServices.php")>0){
        $services="active";
     }
     if(strpos($url, "PageRegion.php")>0){
        $region="active";
     }
     if(strpos($url, "PageRegionObjet.php")>0){
        $regionobjet="active";
     }
     if(strpos($url, "PagePhoto.php")>0){
        $photo="active";
     }
?>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/logo.png">
                    <h2>TA<span class="danger">BLE</span><h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="gg-close-r"></span>
                </div>
            </div>
            <div class="slidebar">
                <a href="PageClient.php" class='<?=$client?>'>
                    <span class="gg-profile"></span>
                        <h3 class="client <?=$client?>">Client</h3>
                </a>
                <a href="PageAnnonce.php" class='<?=$annonce?>'>
                    <span class="gg-display-grid"></span>
                        <h3 class="annonce <?=$annonce?>">Annonce</h3>
                </a>
                <a href="PagePiece.php" class='<?=$piece?>'>
                    <span class="gg-clipboard"></span>
                        <h3 class="piece <?=$piece?>">Piece</h3>
                </a>
                <a href="PageServices.php" class='<?=$services?>'>
                    <span class="gg-browser"></span>
                        <h3 class="services <?=$services?>">Services</h3>
                </a>
                <a href="PageRegion.php" class='<?=$region?>'>
                    <span class="gg-edit-mask"></span>
                        <h3 class="region <?=$region?>">Region</h3>
                </a>
                <a href="PageRegionObjet.php" class='<?=$regionobjet?>'>
                    <span class="gg-edit-mask"></span>
                        <h3 class="regionobjet <?=$regionobjet?>">RegionObjet</h3>
                </a>
                <a href="PagePhoto.php" class='<?=$photo?>'>
                    <span class="gg-photoscan"></span>
                        <h3 class="photo <?=$photo?>">Photo</h3>
                </a>
                <a href="logout.php" class='<?=$main?>'>
                    <span class="gg-log-in"></span>
                        <h3>Logout</h3>
                </a>
            </div>
        </aside>
    </div>