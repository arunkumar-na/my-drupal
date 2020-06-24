
<?php
interface Calculate{
    public function add();
    public function subtract();
    public function multiply();
    public function divide();
} 
class Calculator implements Calculate{
private $_fval, $_sval;
public function __construct( $fval, $sval ) {
$this->_fval = $fval;
$this->_sval = $sval;
}
public function add() {
return $this->_fval + $this->_sval;
}
public function subtract() {
return $this->_fval - $this->_sval;
}
public function multiply() {
return $this->_fval * $this->_sval;
}
public function divide() {
return $this->_fval / $this->_sval;
}
}

?>