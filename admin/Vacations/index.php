<?php
$assets = '../../assets/';
$pageTitle = 'ألاجازات';
$pages = ['الأداره',$pageTitle];
$styles = ['header','Vacations','footer'];
require_once $assets . 'includes/head.php';
if(isset($_SESSION['username'])){
    if($_SESSION['rank'] == 0){
?>
<!--stat admin area-->
				<div class="container text-center">
					<div class="row" >	
						<div class=" text-center" style="
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;"
">
							<div class="col-xs-10 col-xs-offset-1 adpart">
								<h3 class=""><?php echo $pageTitle?></h3>
								<div class="form col-lg-12">
                                                                    <a href="add.php"><button class="" style='margin-left: 20px'>إضافة إجازة</button></a>
                                                                                <a href="orders.php"><button class="">قبول إجازة</button></a>
								</div>
							</div>
						</div>	
					</div>
				</div>
				<!--end admin area-->
<?php require_once $includes . 'footer.php'; 

    }elseif($_SESSION['rank'] == 1){
        header('location: /member/vacationorder.php');
    }else{
        header('location: /');
        session_unset();
        session_destroy();
    }}else{
        header('location: /');
    }
?>