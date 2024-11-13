<?php
$CI =& get_instance();
$CI->load->model('Web_settings');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Content Wrapper. Contains page content -->



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_details') ?></h1>
            <small><?php echo display('invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_details') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $message ?>
        </div>
        <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>
        </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

        <?php
        if($this->permission1->method('pos_invoice', 'read')->access()){ ?>
        

        <body>
            <div class="row">
                <center>
                <div class="printwrap">
                    <div style="padding:20px" class="panel panel-bd">
                        <div>
                            <div class="panel-body" id="printableArea">
                            <style>
            #printableArea {
                width: 44mm;
                page-break-after: always;
                font-size: 7pt;
                margin: 0;
                padding: 0;
            }

            .printwrap {
                width: 100%;
                page-break-after: always;
                font-size: 10pt;
                margin: 0;
                padding: 0;
            }

            .page {
                width: 44mm;
                page-break-after: always;
            }

            .border-bottom td {
                border-bottom: 1px solid black;
                border-collapse: collapse;
            }

            table {
                border-spacing: 0px;
            }
        </style>
                                <table border="0" width="100%">
                                    <tbody>
                                        <tr>
                                        {company_info}
                                            <td align="center" class="print_header"><span>
                                            <img src="<?php if (isset($Web_settings[0]['invoice_logo'])) {echo $Web_settings[0]['invoice_logo']; }?>" class="" alt="">
                                                        </span><br>
                                                        {address}<br>
                                                        {mobile}
                                            </td>
                                            {/company_info}
                                        </tr>
                                        <tr>
                                            <td align="center"> <b>{customer_name}</b><br>

                                            {customer_address}
                                    <br>
                                    {customer_mobile}

                                    <nobr>
                                                    <date>Date:{final_date}<time></time></date>
                                                </nobr>

                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr class="border-bottom">
                                            <td style="width:20%">Qty</td>
                                            <td align="left">Item</td>
                                            <td align="right">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $subtotalamount = 0;
                                        $return_discount = 0;
                                        $return_amount = 0;
                                         foreach($invoice_all_data as $details){?>
                                        <tr class="border-bottom">
                                            <td> <?php if($details['quantity'] < 0){ echo $qty = -1*$details['quantity'];}else{
                                                echo $qty = $details['quantity'];
                                            } ?></td>
                                            <td align="left"><?php echo $details['product_name']; ?><br> Harga : <?php echo (($position==0)?"$currency ".$details['rate']."":"".$details['rate']." $currency") ?>
                                        
                                            <br> Diskon : <?php
                                            if($details['quantity'] < 0){
                                             $discounts =  -1*$details['discount'];
                                             $tp = -1*$details['total_price'];
                                            
                                         }else{
                                            $discounts = $details['discount'];
                                            $tp = $details['total_price'];
                                            }
                                             if ($discount_type == 1) { echo $discounts;
                                                $dis_amount = ($qty*$details['rate']*$discounts)/100;
                                            }elseif($discount_type == 2){ 
                                                echo (($position==0)?"$currency ".$discounts."":"".$discounts." $currency");
                                                $dis_amount = $qty*$discounts;
                                            }else{
                                                echo (($position==0)?"$currency ".$discounts."":"".$discounts." $currency");
                                                 $dis_amount = $discounts;
                                            }
                                            ?>
                                        </td>
                                            <td align="right"><?php
                                             if($details['quantity'] < 0){ 
                                                 $totalprice = $tp - $dis_amount;
                                                 $subtotalamount -= $totalprice;
                                                 $return_discount += $dis_amount;
                                                 $return_amount  +=$totalprice;
                                             }else{
                                                 $totalprice = $tp;
                                                 $subtotalamount += $totalprice;
                                            }

                                           
                                             echo (($position==0)?"$currency ".$totalprice."":"".$totalprice." $currency") ?></td>
                                        </tr>
                                        <?php
                                         }
                                        ?>
                                        <tr class="border-bottom">
                                            <td align="left" colspan="2">
                                                <nobr>Sub Total</nobr>
                                            </td>
                                            <td align="left">
                                                <?php echo (($position==0)?"$currency ".$subtotalamount: $subtotalamount." $currency") ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">
                                                <nobr>Pajak</nobr>
                                            </td>
                                            <td align="left">
                                                <?php echo (($position==0)?"$currency {total_tax}":"{total_tax} $currency") ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">
                                                <nobr>Diskon Faktur</nobr>
                                            </td>
                                            <td align="left">
                                                <?php echo (($position == 0) ? "$currency {invoice_discount}" : "{invoice_discount} $currency") ?>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td align="left" colspan="2">
                                                Diskon Total
                                            </td>
                                            <td align="left">
                                               <?php
                                                  $dis = $total_discount + $return_discount + $invoice_discount;
                                                 echo (($position == 0) ? "$currency ".$dis : $dis." $currency") ?>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">

                                            <td align="left" colspan="2">
                                                <strong>Hasil akhir</strong>
                                            </td>
                                            <td align="left">
                                                <strong><?php
                                            $tmnt = $total_amount-$return_amount;
                                             echo (($position == 0) ? "$currency ".$tmnt  : $tmnt." $currency") ?></strong>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td colspan="2">
                                                Berbayar
                                            </td>
                                            <td>
                                                <?php echo (($position==0)?"$currency {paid_amount}":"{paid_amount} $currency") ?>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td align="left" colspan="2">
                                                <?php
                                        $change=$paid_amount-$total_amount;
                                        if($change > 0){
                                            echo 'Kembalian';
                                        }else{
                                            echo 'Kembalian';
                                        }
                                        ?>
                                            </td>
                                            <td align="left">
                                                <?php
                                        $change=$paid_amount-$total_amount;
                                        if($change > 0){
                                            echo number_format($change,2);
                                        }else{
                                             $due = $tmnt - $paid_amount;
                                                 echo (($position == 0) ? "$currency ".$due : $due."{due_amount} $currency");
                                        }?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Receipt No:{invoice_no}</td>
                                            <td></td>
                                            <td>Kasir : <?php echo $this->session->userdata('user_name');?></td>
                                        </tr>
                                    </tbody>
                                </table>




                            </div>
                            <div class="panel-footer text-left">
                                <!-- <a  class="btn btn-danger" href="<?php echo base_url('Cinvoice');?>"><?php echo display('cancel') ?></a> -->
                                <button class="btn btn-info" onclick="printDiv('printableArea')"><span
                                        class="fa fa-print"></span></button>

                            </div>
                        </div>
                    </div>
                    </center>
                </div>
        </body>
        <?php
        }
        else{
            ?>
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('You do not have permission to access. Please contact with administrator.');?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->