<?php
    $assets = 'assets/';
    $pageTitle = 'تسجيل الدخول';
    $styles = ['header','index','footer'];
    require_once $assets . 'includes/head.php';
    require_once $assets . 'includes/connect.php';
    /* @var $db PDO*/
    if(!isset($_SESSION['username'])){//check if user is already signed in 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){// check if the page comes from post method
        if(!isset($_SESSION['ProStat'])){
        $IDNum = $_POST['ID_Number'];
        $_SESSION['IDNum'] = $IDNum;
        $pass = $_POST['Password'];
        if($IDNum == '' && $pass == ''){ // check if the ID Number and password fileds are empty
            $_SESSION['error'] = 'يرجى إدخال رقم الهوية و كلمة المرور';
        }elseif($IDNum == '' && !$pass == ''){
            $_SESSION['error'] = 'يرجى إدخال رقم الهوية';
        }elseif(!$IDNum == '' && $pass == ''){
            $checkID = 'SELECT * FROM Users WHERE ID_Number=:IDNum';
            $prepareID = $db->prepare($checkID);
            $prepareID->bindValue(':IDNum', $IDNum);
            $prepareID->execute();
            //check if the entered ID is right
            if($prepareID->rowCount()){
                $checkID = 'SELECT Password FROM Users WHERE ID_Number=:IDNum';
                $prepareID = $db->prepare($checkID);
                $prepareID->bindColumn('Password', $pass);
                $prepareID->execute();
                if($pass == ''){
                    $_SESSION['error'] = 'يبدوا انك موظف جديد فلم يتم تحديد كلمة مرور لحسابك يرجى كتابة كلمة المرور';
                    $_SESSION['ProStat'] = 0;
                }else{
                $_SESSION['error'] .= 'يرجى إدخال كلمة المرور';
                $_SESSION['IDNum'] = $IDNum;
                }
            }else{
                $_SESSION['error'] = 'يرجى التأكد من صحة رقم الهوية و إدخال كلمة المرور';
            }
        }else{
        $checkData = 'SELECT * FROM Users WHERE ID_Number=:IDNum AND Password=:pass';
        $stmt = $db->prepare($checkData);
        $stmt->bindValue(':IDNum', $IDNum);
        $stmt->bindValue(':pass', $pass);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount()){
            $_SESSION['username'] = $data['Name'];
            $_SESSION['rank'] = $data['Rank'];
            if($_SESSION['rank'] == 0){
                header('location: admin/');
            }elseif($_SESSION['rank'] == 1){
                $_SESSION['id'] = $data['ID'];
                header('location: member/');
            }else{
                session_destroy();
                session_start();
                $_SESSION['error'] = 'رتبة غير متعارف عليها يرجى حل المشكلة';
                header('location: '. $_SERVER['HTTP_REFERER']);
            }
        }else{
            $checkID = 'SELECT * FROM Users WHERE ID_Number=:IDNum';
            $prepareID = $db->prepare($checkID);
            $prepareID->bindValue(':IDNum', $IDNum);
            $prepareID->execute();
            //check if the entered ID is right
            if($prepareID->rowCount()){
                $_SESSION['error'] = 'كلمة المرور غير صحيحة يرجى التأكد من صحتها و اعادة المحاولة';
                $_SESSION['IDNum'] = $IDNum;
            }else{
                $_SESSION['error'] = 'يرجى التأكد من صحة رقم الهوية و إدخال كلمة المرور';
            }
//            $_SESSION['error'] ='اسم المستخدم او كلمة المرور غير صحيحان يرجى التأكد من كليهما و اعادة المحاولة';
            header('location: '. $_SERVER['HTTP_REFERER']);
        }
        }
        header('location: '. $_SERVER['HTTP_REFERER']);
        }else{
            $pass = $_POST['Password'];
            if($pass == ''){
                $_SESSION['error'] = 'يرجى كتابة كلمة مرور';
                header('location: '. $_SERVER['HTTP_REFERER']);
            }else{
                //$IDNum
                
                $setPass = "UPDATE users SET Password ='$pass' WHERE users.ID_Number=".$_SESSION['IDNum'];
                $setPass = $db->prepare($setPass);
                $setPass->execute();
                if($setPass->rowCount()){
                    $getData = "SELECT ID, Rank,Name FROM users users.ID_Number=".$_SESSION['IDNum'];
                    $getData = $db->prepare($getData);
                    unset($_SESSION['ProStat']);
                    unset($_SESSION['error']);
                    $getData->bindColumn('ID', $_SESSION['id']);
                    $getData->bindColumn('Rank', $_SESSION['rank']);
                    $getData->bindColumn('Name', $_SESSION['username']);
                    $getData->execute();
                    header('location: /member');
                }else{
                    header('location: /');
                }
            }
        }
    }else{
        
?>
<!--start form-->
<div class="container text-center">
    <div class="row" style="display: flex;justify-content: center;">
        <p class="topnav text-center  ">تسجيل الدخول لموظفي جامع القطان بخليص</p>
        <div class="contan">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" class="  text-center">
            <?php if(isset($_SESSION['error'])){ ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];?>
            </div>
                    <?php } ?>
            <?php if(!isset($_SESSION['ProStat'])) {?>
            <label for='ID_Number'>رقم الهوية</label>
            <input id="ID_Number" autocomplete="off" name="ID_Number" class="text-center IDNum" type="text" placeholder="ادخل رقم الهوية" value="<?php if(isset( $_SESSION['IDNum'])) { echo $_SESSION['IDNum']; } ?>">
            <label for='Password'>كلمه المرور </label>
            <input id="Password" name='Password'  class="text-center pass" type="password" placeholder="كلمه المرور">
            <button class="submit">الدخول</button>
            <?php }else{ ?>
            <label for='Password'>كلمه المرور </label>
            <input id="Password" name='Password'  class="text-center pass" type="password" placeholder="كلمه المرور">
            <button class="submit">تسجيل</button>
            <?php }?>
        </form>	
        <?php if(isset($_SESSION['ProStat'])){?>
        <a href="logout.php"><button class="submit">تسجيل الخروج</button></a>
        <?php } ?>
        </div>
    </div>
</div>
<!--end form-->
<?php require_once $includes. 'footer.php';
if(!isset($_SESSION['ProStat'])){
session_unset();
session_destroy();
}
    }}else{
    
    if($_SESSION['rank'] == 0){
        header('location: /admin');
    }elseif($_SESSION['rank'] == 1){
        header('location: /member');
    }else{
        session_destroy();
        session_start();
        $_SESSION['error'] = 'رتبة غير متعارف عليها يرجى حل المشكلة مع المسؤول';
        header('location: /');
        
    }
}