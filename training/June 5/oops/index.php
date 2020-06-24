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
    if($sign=='+'){
        $result = $mycalc-> add();
        $operation='Addition';
    }
    if($sign=='-'){
        $result = $mycalc-> subtract();
        $operation='Subtraction';
    }
    if($sign=='*'){
        $result = $mycalc-> multiply();
        $operation='Multiplication';
    }
    if($sign=='/'){
        $result = $mycalc-> divide();
        $operation='Division';
    }
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
                <h3>Calculator</h3>
            </div>
            <div class="col-md-9 register-right">
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Calculate Here !</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <form autocomplete="off" name="calculator-form" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Value" name="first_value" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Value" name="second_value" value="" />
                                    </div>                                
                                    <div class="form-group">
                                        <div class="maxl">
                                            <label class="radio inline"> 
                                                <input type="radio" name="sign" value="+" checked>
                                                <span> Addition </span> 
                                            </label><br/>
                                            <label class="radio inline"> 
                                                <input type="radio" name="sign" value="-">
                                                <span> Subtraction </span> 
                                            </label><br/>
                                            <label class="radio inline"> 
                                                <input type="radio" name="sign" value="*">
                                                <span> Multiplication </span> 
                                            </label><br/>
                                            <label class="radio inline"> 
                                                <input type="radio" name="sign" value="/">
                                                <span> Division </span> 
                                            </label>
                                        </div>
                                    </div>
                                    <input type="submit" class="btnRegister"  value="Calculate"/>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div style="border:1px solid #ced4da; background-color:#fff;min-height:70%;">
                                    <h3 class="text-center"><?php echo !empty($operation)?strtoupper($operation):''; ?></h3>
                                    <div class="text-center">
                                        <span style="font-size:20px;"><?php echo $first_value.' '.$sign.' '.$second_value;  ?> </span><br/>
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