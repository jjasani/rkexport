<?php 
    $floatformat = '.';
    $decimalformat = ',';
    $style = 'style="padding: 5px;border: 1px solid #666;font-size: 12px;"';
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        table tr td{
            padding: 5px;/* border: 1px solid #666; */font-size: 12px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>bootstrap-select.css" type="text/css"  />
    <link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>styles.css" type="text/css"  />
</head>
<body style="background-color: #FFF;">
    <div class="row">
        <div class="col-md-12">
            <p class="text-center" style="font-size: 18px;color: #000"><u><b>Product Wise Sales Report</b></u></p>
        </div>
    </div>
    <div class="row mb-xl m-n">
        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>         
                    <th rowspan="2" <?=$style?>><?=Member_label?> Name</th>
                    <th rowspan="2" <?=$style?>>Product Name</th>
                    <th rowspan="2" class="text-right" <?=$style?>>Total Sales (<?=CURRENCY_CODE?>)</th>   
                    <th rowspan="2" class="text-right" <?=$style?>>Total Sold Qty</th>   
                    <?php if(!empty($headings)){
                        foreach($headings as $thead){ ?>
                            <th colspan="2" class="text-right" <?=$style?>><?=$thead?></th>
                        <?php
                        }
                    }?>
                </tr>
                <tr> 
                    <?php if(!empty($headings)){
                        foreach($headings as $thead){ ?>
                            <th class="text-right" <?=$style?>>Sales</th>
                            <th class="text-right" <?=$style?>>Sold Qty</th>
                        <?php
                        }
                    }?>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($reportdata)){
                    foreach($reportdata as $k=>$row){ ?>
                        <tr>
                            <td <?=$style?>><?=$row['membername']?></td>
                            <td <?=$style?>><?=$row['productname']?></td>
                            <td class="text-right" <?=$style?>><?=numberFormat($row['total'],2,',')?></td>
                            <td class="text-right" <?=$style?>><?=numberFormat($row['totalsold'],2,',')?></td>
                            <?php if(!empty($row['datewisesales'])){
                                foreach($row['datewisesales'] as $i=>$s){ ?>
                                    <td class="text-right" <?=$style?>><?=numberFormat($s['sales'],2,',')?></td>
                                    <td class="text-right" <?=$style?>><?=numberFormat($s['qty'],2,',')?></td>
                                <?php
                                }
                            }?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>



