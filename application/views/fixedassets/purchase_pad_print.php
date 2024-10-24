<?php
$CI = & get_instance();
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
            <h1><?php echo display('fixed_assets_purchase_details') ?></h1>
            <small><?php echo display('fixed_assets_purchase_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('fixed_assets_purchase_details') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' class="tap-print-head">
                                <div class="padd-space" style="height: 220px"></div>
                                <table border="0" width="100%" >
                                    <tr>
                                        <td>

                                            <table border="0" width="100%">
                                                
                                                <tr>
                                                    <td align="left">
                                                      <b><?php echo display('supplier_name')?>: {supplier_name}</b><br>
                                                      <?php echo display('phone')?>: 
                                                        <?php if ($supplier_mobile) { ?>
                                                            {supplier_mobile}
                                                        <?php } ?>
                                                    </td>
                                                     <td align="right"><strong><?php echo display('purchase_id'); ?> : {purchase_id}</strong><br>
                                                        <date>
                                                        Date: {final_date}
                                                    </date>
                                                    </td>
                                                </tr>            
                                   
                                </table>
                                    <tr>
                                        <td>

                                             <table width="100%" class="table-striped" >
                                                <thead >
                                    <tr class="tbodydata">
                                        <td><?php echo display('sl'); ?></td>
                                        <td><?php echo display('item_name'); ?></td>
                                        <td></td>
                                        <td align="right"><?php echo display('quantity'); ?></td>
                                        
                                        <td align="right"><?php echo display('rate'); ?></td>
                                        <td align="right"><?php echo display('ammount'); ?></td>
                                    </tr>
                                </thead>
                               <tbody>
                                <?php
                                    if ($purchase_all_data) {
                                ?>
                                    {purchase_all_data}
                                    <tr>
                                        <td align="left"><nobr>{sl}</nobr></td>
                                    <td align="left"><nobr>{item_name}</nobr></td>
                                      <td></td>
                                    <td align="right"><nobr>{qty}</nobr></td>
                                
                                    <td align="right">
                                    <nobr>
                                       <?php echo (($position==0)?"$currency {price}":"{price} $currency") ?>
                                    </nobr>
                                    </td>

                                    <td align="right">
                                    <nobr>
                                       <?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?>
                                    </nobr>
                                    </td>
                                    </tr>
                                 {/purchase_all_data}
                             <?php }?>
                                </tbody>
                          <tfoot>
                                    <tr>
                                        <td colspan="6"  class="print-footer"><nobr></nobr></td>
                                    </tr>

                                    <tr>
                                        <td colspan="6" class="print-footer"><nobr></nobr></td>
                                    </tr>
                                     <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="4"><nobr><?php echo display('total') ?></nobr></td>
                                    <td align="right">
                                    <nobr>
                                       <?php echo (($position==0)?"$currency {ptotal_amount}":"{ptotal_amount} $currency") ?>
                                    </nobr>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="print-footer"><nobr></nobr></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td colspan="3"><nobr><span align="right"><?php echo display('in_word').' : ' ?>{am_inword}</span> <?php echo display('taka_only')?></td><td align="right"><strong><?php echo display('grand_total')?></strong></nobr></td>
                                    <td align="right"><nobr>
                                        <strong>
                                            <?php echo (($position == 0) ? "$currency {sub_total_amount}" : "{sub_total_amount} $currency")
                                             ?>
                                        </strong></nobr></td>
                                    </tr>
                                </tfoot>
                                </table>
                               
                                </td>
                                </tr>
                               
                                <tr>{company_info}
                                    <td>Website: <a href="{website}">{website}</a><div class="pad-print-com">
                                        <?php echo display('signature') ?>
                                    </div></td>
                                     {/company_info}
                                </tr>
                                </table>
                                </div>


                        </div>
                    </div>
                        <div class="panel-footer text-left">
                        <a  class="btn btn-danger" href="<?php echo base_url('Cpurchase/manage_purchase'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>
                   
                    </div>

  </div>                     
</div> <!-- /.content-wrapper -->
</div>
</section>
</div>