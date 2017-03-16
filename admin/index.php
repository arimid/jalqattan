<?php
    $assets = '../assets/';
    $pageTitle = 'إلادارة';
    $styles = ['header','admin','footer'];
    
    require_once $assets . 'includes/head.php';
    if(isset($_SESSION['username'])){//Check if the is sign in or not
        if($_SESSION['rank'] == 0){//Check user rank in website
?>
				<!--stat admin area-->
				<div class="container text-center">
					<div class="row" >	
						<div class="content-box text-center"  >
							<div class="col-lg-10 col-xs-12 adpart">
								<h3 class=""><?php echo $pageTitle?></h3>
								<div class="btns-box row">
                                                                <a href="add.php"><button>أضافه موظف</button></a>
								<button>الرواتب</button>
								<button>القروض</button>
                                                                <a href="Vacations/"><button class=" ">الأجازات</button></a>
								<button class=" ">تقييم الموظف</button>
                                                                </div>
                                                                <div class="btns-box">
								<button class=" ">الغياب</button>
								<button class=" ">البريد</button>
								<button class=" ">العقود</button>
								<button class=" ">التقارير</button>
								<button class=" ">الصلاحيات</button>
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
}elseif($_SESSION['rank'] == 1){
    header('location: /member');
   }else{
                session_destroy();
                header('location: /');
            }
        }
    else{
        header('location: /');
    }
      