<?php 
    $assets = '../assets/';
    $pageTitle = 'الموظفين';
    $styles = ['header','member','footer'];
    require_once $assets . 'includes/head.php';
    if(isset($_SESSION['username'])){
        if($_SESSION['rank'] == 0){
            header('location: /admin');
        }elseif($_SESSION['rank'] == 1){
?>
				<!--stat admin area-->
				<div class="container text-center">
					<div class="row" >	
						<div class="content-box text-center">
							<div class="col-sm-10 col-xs-12 adpart">
								<h3 class=""><?php echo $pageTitle?></h3>
								<div class="btns-box row">
                                                                    <a href="vacationorder.php"><button class=" ">طلب اجازه</button></a>
								<button class=" ">رفع خطاب</button>
								<button class=" ">التقارير</button>
                                                                </div>
                                                                <div class="row">
                                                                <a href="../logout.php"><button>تسجيل الخروج</button></a>
                                                                </div>
								
							</div>
						</div>	
					</div>
				</div>
				<!--end admin area-->
    <?php require_once $includes.'footer.php';
    }else{
        session_destroy();
        header('location: /');
        }
        }
    else{
        header('location: /');
    }