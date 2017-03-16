<?php
$assets = '../../assets/';
$pageTitle = 'قبول إجازة';
$pages = ['الأداره','إلاجازات',$pageTitle];
$pageStyle = 'inLine';
$scripts = 'vaca';
$styles = ['header','footer','orders'];
/* @var $db PDO*/
require_once $assets . 'includes/head.php';
require_once $includes . 'connect.php';
if(isset($_SESSION['username'])){
    if($_SESSION['rank'] == 0){
        $selectCommand = 'SELECT * FROM Vacas';
        $selectData = $db->query($selectCommand);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['status'] <= 4){
                $id = $_POST['Order_id'];
                $status = $_POST['status'];
                $getName = "UPDATE vacas SET Status =$status WHERE vacas.order_ID =$id";
                $id = $db->prepare($getName);
                $id = $id->execute();
                header('location: '. $_SERVER['PHP_SELF']);
            }
        }else{
?>
<!--stat admin area-->
<div class="container">
    <div class="row" >	
        <div class="adpart col-lg-12 col-md-12 col-sm-12 ">
            <h2 class="text-center">قبول اجازه</h2>
            <?php
                if(isset($error)){?>
            <div class="text-center alert alert-danger"><?php echo $error ?></div>
                <?php
                }else{
                    $selectRange = 'SELECT * FROM Vacas WHERE Status < 4';
                    $getRange = $db->query($selectRange);
                    if($getRange->rowCount() > 0){
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="hidden-xs">#</th>
                        <th>اسم الموظف</th>
                        <th>نوعها </th> 
                        <th> مدتها</th>
                        <th> التاريخ</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $selectData->fetch(PDO::FETCH_ASSOC)){ 
                           $getName = 'SELECT name FROM Users WHERE ID="'.$row['User_ID'].'"';
                           $name = $db->query($getName);
                           $name = $name->fetchColumn();
                            if ($row['Status'] == 0){
                                $status = 'معلق';
                            }elseif($row['Status'] == 1){
                                $status = 'مقبول';
                            }elseif($row['Status'] == 2){
                                $status = 'مرفوض';
                            }elseif($row['Status'] == 3){
                                $status = 'منتهى';
                            }
                    ?>
                    <tr>
                        <?php if($row['Status'] < 4) {?>
                        <th scope="row"  class="hidden-xs"><?php echo $row['order_ID']?></th>
                        <?php
                            if($row['Dur'] === 1){
                                $dur = 'يوم';
                            }elseif($row['Dur'] <= 10){
                                $dur = $row['Dur'] . ' أيام ';
                            }elseif($row['Dur'] >= 11 && $row['Dur'] < 30){
                                $dur = $row['Dur'] .' يوم';
                            }elseif($row['Dur'] == 30){
                                $dur = 'شهر';
                            }elseif($row['Dur'] > 30){
                                $month = floor($row['Dur'] / 30);
                                $day = $row['Dur'] % 30;
                                if($day === 1){
                                $day = 'يوم';
                                }elseif($day <= 10){
                                $day = $day . ' أيام ';
                                }elseif($day >= 11 && $row['Dur'] < 30){
                                $day = $day .' يوم';}
                                if ($month == 1){
                                    $month = 'شهر';
                                }elseif($month <= 10){
                                $month = $month . ' أشهر ';
                                }elseif($month == 12){
                                $month = ' سنة ';
                                
                                }
                                $dur =  $month . ' و ' . $day ;
                            }
                        ?>
                        <td><?php echo $name ?></td>
                        <td><?php echo $row['kind'] ?></td>
                        <td><?php echo $dur ?></td>
                        <td><?php echo $row['vDate']?></td>
                        <td><?php echo $status?></td>
                        <?php if($row['Status'] == 0){?>
                        <td class="text-center rest-td" style="background-color: rgb(164, 96, 72);">
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                <input type="hidden" name="User_id" value="<?php echo $row['User_ID']?>">
                                <input type="hidden" name="Order_id" value="<?php echo $row['order_ID']?>">
                                <input type="hidden" name="status" value="1">
                                <button class="btn btn-success">قبول</button>
                            </form></td>
                        <td class="text-center rest-td" style="background-color: rgb(164, 96, 72);">
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                <input type="hidden" name="User_id" value="<?php echo $row['User_ID']?>">
                                <input type="hidden" name="Order_id" value="<?php echo $row['order_ID']?>">
                                <input type="hidden" name="status" value="2">
                                <button class="btn btn-danger">رفض</button>
                            </form></td>
                        <?php }elseif($row['Status'] >= 2){?>
                        <td class="text-center rest-td" style="background-color: rgb(164, 96, 72);">
                            <div class="order-id" style="display: none"><?php echo $row['order_ID']?></div>
                            <div class="user-id" style="display: none"><?php echo $row['User_ID']?></div>
                                <button class="btn btn-danger delete">حذف</button>
                            </td>
                        <?php }elseif($row['Status'] >= 1){?>
                        <td class="text-center rest-td" style="background-color: rgb(164, 96, 72);">
                            <div class="order-id" style="display: none"><?php echo $row['order_ID']?></div>
                            <div class="user-id" style="display: none"><?php echo $row['User_ID']?></div>
                            <button class="btn btn-danger finish">انهاء</button>
                            </td>
                        <?php } ?>
                    </tr>
                    <?php }} ?>
                </tbody> 
            </table>
            <div class="deleteback">
                        <div class="deletebox">
                            <h1>حذف طلب اجازة</h1>
                            <h2>هل انت متأكد من رغبتك فى حذف هذا الطلب فى المعتاد سيحذف بشكل تلقائى بعد 4 ايام</h2>
                            <div>
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                <input class="User" type="hidden" name="User_id" value="">
                                <input class="Order" type="hidden" name="Order_id" value="">
                                <input type="hidden" name="status" value="4">
                                <button class="btn-delete btn btn-danger">حذف</button>
                            </form>
                            <button class="delete-cancel btn btn-primary">إلغاء</button>
                            </div>
                        </div>
                    </div>
            <div class="finishback">
                        <div class="finishbox">
                            <h1>إنهاء أجازة</h1>
                            <h2>هل انت متأكد من أنك تريد إنهاء الاجازة باقى على موعد انتهائها <span class="finishDur">1</span> يوم</h2>
                            <div>
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                <input class="User" type="hidden" name="User_id" value="">
                                <input class="Order" type="hidden" name="Order_id" value="">
                                <input type="hidden" name="status" value="3">
                                <button class="btn-finish btn btn-danger">إنهاء</button>
                            </form>
                            <button class="finish-cancel btn btn-primary">إلغاء</button>
                            </div>
                        </div>
                    </div>
        </div>
        
    </div>
    
</div>

<!--end admin area-->
<?php
require_once $includes .'footer.php';
                    }else{
                     echo "<div class='text-center alert alert-success'>لا توجد طلبات اجازة حاليا</div>";
                     
                    }}}}elseif($_SESSION['rank'] == 1){
        header('location: /member/vacations');
}else{
    session_destroy();
    session_start();
    $_SESSION['error'] = 'رتبة غير متعارف عليها يرجى حل المشكلة';
    header('location: /');
}}else{
    header('location: /');
}
