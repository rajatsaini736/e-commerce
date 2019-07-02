<?php
session_start();
include('db.php');
include('function.php');
$MERCHANT_KEY = "C8mkKqk4";
$SALT = "eZKpy19Z76";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
    

$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body onload="submitPayuForm()">

    <?php
      nav();
    ?>

    <?php if($formError) { ?>
	
      <span style="color:red">All mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>


    
    <form action="<?php echo $action; ?>" method="post" name="payuForm" id="form_id">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
<!--         <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr> -->
        <tr>
<!--           <td>Amount: </td>
 -->          <td><input type="hidden" name="amount" value="<?php echo $_SESSION["amount"]; ?>"  readonly/></td>
<!--           <td>First Name: </td>
 -->          <td><input type="hidden" name="firstname" id="firstname" value="<?php echo $_SESSION["first_name"]; ?>"  readonly/></td>
        </tr>
        <tr>
<!--           <td>Email: </td>
 -->          <td><input type="hidden" name="email" id="email" value="<?php echo $_SESSION["email"]; ?>"  readonly /></td>
<!--           <td>Phone: </td>
 -->          <td><input type="hidden" name="phone" value="<?php echo $_SESSION["mobile"]; ?>"  readonly/></td>
        </tr>
        <tr>
<!--           <td>Product Info: </td>
 -->          <td><input type="hidden" name="productinfo" value="<?php echo $_SESSION["pinfo"]; ?>"  readonly/></td>
        </tr>
        <tr>
<!--           <td>Success URI: </td>
 -->          <td colspan="3"><input type="hidden" name="surl" value="http://localhost/Project/Home/success.php" size="64" /></td>
        </tr>
        <tr>
<!--           <td>Failure URI: </td>
 -->          <td colspan="3"><input type="hidden" name="furl" value="http://localhost/Project/Home/failure.php" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
<!--           <td><b>Optional Parameters</b></td>
 -->        </tr>
        <tr>
<!--           <td>Last Name: </td>
 -->          <td><input type="hidden" name="lastname" id="lastname" value="<?php echo $_SESSION["last_name"]; ?>"  readonly/></td>
<!--           <td>Cancel URI: </td>
 -->          <td><input type="hidden" name="curl" value="" /></td>
        </tr>
        <tr>
<!--           <td>Address1: </td>
 -->          <td><input type="hidden" name="address1" value="<?php echo $_SESSION["address"]; ?>"  readonly/></td>
<!--           <td>Address2: </td>
          <td><input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td> -->
        </tr>
<!--         <tr>
          <td>City: </td>
          <td><input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
          <td>State: </td>
          <td><input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr> -->
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" name="submit" value="Loading. . ." /></td>
          <?php } ?>
        </tr>
      </table>
    </form>

<script type="text/javascript">
  document.getElementById("form_id").submit.click();
</script>

  </body>

<!-- Footer -->
  <?php 
   footer();
  ?>
  <!-- /.Footer -->

</html>
