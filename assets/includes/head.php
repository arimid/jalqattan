<?php
    session_start();
    ob_start();
    include 'variables.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- for explorer-->
        <meta name="viewport" content="width=device-width, initial-scale=1"><!-- first moblie meta for resposive-->
        <title>جامع القطان
            <?php if(isset($pageTitle) && !isset($pages)){
                echo ' - ' . $pageTitle; 
                
            }elseif(isset($pages)){
//                $pages = array_reverse($pages);
                foreach ($pages as $page){
                    $pageNewTitle = ' - '. $page;
                    echo  $pageNewTitle;
                }
        } ?></title>
        <link rel="icon" href="<?php echo $images?>logo.gif">
        <link rel="stylesheet" href="<?php echo $css?>bootstrap.css">
        <link rel="stylesheet" href="<?php echo $css?>font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $css?>fonts.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
        <link href="<?php echo $css?>bootstrap-rtl.css" rel="stylesheet">
        <?php
        if(isset($styles)){
            if(is_array($styles)){
        
        foreach ($styles as $style){ ?>
        <link rel="stylesheet" href="<?php echo $css . $style?>.css">
            <?php } }else{ ?>
                <link rel="stylesheet" href="<?php echo $css . $styles?>.css">
            <?php }}
?>
<!--[if lt IE 9]>
            <script src="<?php echo $js?>html5shiv.min.js"></script>
            <script src="<?php echo $js?>respond.min.js"></script>
        <![endif]-->	
    </head>
    <body>
		<!--start ad-->
		<section class="ad">
			<div class="over">
                            <a href="/"><img src="<?php echo $images?>logo.gif" class="logo img-responsive" alt="Logo"></a>
				<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 text-center">
								<div id="date" class=""></div>
							</div>
						</div>
					</div>
				</div>
				<!--end ad-->
				<!--start h3-->
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center ">
							<h3 class="hc">الخدمات الاليكترونيه</h3>
						</div>
					</div>    
				</div>
				<!--end h3-->
				<!--start navbar-->
                                <nav class="navbar navbar-default text-center">
					<div class='container'>
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#"><img src="<?php echo $images?>masjed.gif" class=" mas" alt="Mosque"></a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav navbar-right">
                                                                    <li class="<?php if(!isset($pages) && !isset($pageTitle)){ echo 'active';} ?>"><a href="/"><i class="fa fa-3x fa-home" aria-hidden="true"></i></a></li>
                                                                        
									<?php
                                                                        if(!isset($pages) && isset($pageTitle)){
                                                                            $pages = $pageTitle;
                                                                        }
                                                                        if(!isset($pageStyle)){
                                                                            $pageStyle = 'outLine';
                                                                        }
                                                                        if(isset($pages)){
                                                                        if(is_array($pages)){
                                                                            if($pageStyle == 'outLine'){
                                                                                foreach ($pages as $page){
                                                                                if(array_search($page, $pages) + 1=== count($pages)){ ?>
                                                                     <li ><a href="#" class="a active"><?php echo $page?></a></li>
                                                                    
                                                                                <?php }else{ ?>
                                                                     <li ><a href="<?php echo str_repeat('../', array_search($page, array_reverse($pages)))?>" class="a"><?php echo $page?></a></li>
                                                                                <?php }
                                                                        }}elseif($pageStyle == 'inLine'){
                                                                            foreach ($pages as $page){
                                                                                if(array_search($page, $pages) + 1=== count($pages)){?>
                                                                                    <li ><a href="#" class="a active"><?php echo $page?></a></li>
                                                                                <?php } elseif (array_search($page, $pages) + 1=== count($pages) - 1) {?>
                                                                                    <li ><a href="index.php" class="a"><?php echo $page?></a></li>
 }
                                                                        <?php }else{ ?>
                                                                            <li ><a href="<?php echo str_repeat('../', array_search($page, $pages)+1)?>" class="a"><?php echo $page?></a></li>
                                                                        <?php }}}}else{ ?>
                                                                            <li ><a href="#" class="a active"><?php echo $pages?></a></li>
                                                                        <?php }} ?>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</div>
				</nav>