<?php 
    $floatformat = '.';
    $decimalformat = ',';
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        /*table>thead>tr>th{
            padding: 5px;
        }*/
    </style>
    <link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>bootstrap-select.css" type="text/css"  />
    <link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>styles.css" type="text/css"  />
</head>
<body style="background-color: #FFF;">
    <div class="row">
        <div class="col-md-12">
            <p class="text-center" style="font-size: 18px;color: #000"><u><b>View Product Process Details</b></u></p>
        </div>
    </div>
    <div class="row mb-xl">
        <div class="col-md-12">
            
            <div class="">
                <?php require_once(APPPATH."views/".ADMINFOLDER.'product_process/Productprocessdetails.php');?>
            </div>
        </div>
    </div>
</body>
</html>



