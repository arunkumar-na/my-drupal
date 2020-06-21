<?php
include('includes/Calculator.php');
error_reporting(0);
$first_value='';
$second_value='';
$result='';
$sign='';
$operation='';
if(isset($_POST)){
    $first_value=$_POST['first_value'];
    $second_value=$_POST['second_value'];
    $sign=$_POST['sign'];
    $mycalc = new Calculator($first_value, $second_value);     
    $result = $mycalc-> multiply().' Square cms';    
}
?>
<html>
<title>Calculator | Arun</title>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="includes/custom.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="includes/logo_white.png" alt=""/>
                <h3>Find Area</h3>
            </div>
            <div class="col-md-9 register-right">
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Find Area Here !</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <form autocomplete="off" name="calculator-form" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Height in cm" name="first_value" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Width in cm" name="second_value" value="" />
                                    </div> 
                                    <input type="submit" class="btnRegister"  value="Calculate"/>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div style="border:1px solid #ced4da; background-color:#fff;min-height:70%;">
                                    <h3 class="text-center">Area is</h3>
                                    <div class="text-center">
                                        <span style="font-weight:bold;color:#1e7e34;font-size:30px;"><?php echo $result; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>