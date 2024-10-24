<!-- manufacturer Sales Summary Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manufacturer_sales_summary') ?></h1>
	        <small><?php echo display('manufacturer_sales_summary') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('manufacturer') ?></a></li>
	            <li class="active"><?php echo display('manufacturer_sales_summary') ?></li>
	        </ol>
	    </div>
	</section>

	<!-- Search manufacturer -->
	<section class="content">
		
		<div class="row">
            <div class="col-sm-12">
                <div class="column">
                
                  <a href="<?php echo base_url('Cmanufacturer')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_manufacturer')?> </a>

                  <a href="<?php echo base_url('Cmanufacturer/manage_manufacturer')?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_manufacturer')?> </a>

                  <a href="<?php echo base_url('Cmanufacturer/manufacturer_ledger_report')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('manufacturer_ledger')?> </a>

                

                </div>
            </div>
        </div>
        
		<!-- Sales Report -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                   <h4><?php echo display('manufacturer_sales_summary') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                <?php if ($manufacturer_detail) { ?>
							{manufacturer_detail}
							<h3> {manufacturer_name} </h3>
							<h5><?php echo display('address') ?> : {address} </h5>
							<h5 ><?php echo display('phone') ?> : {mobile} </h5>
							{/manufacturer_detail}
						<?php } ?>
						
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th> <?php echo display('date') ?> </th>
										<th><?php echo display('product_name') ?> </th>
										<th><?php echo display('quantity') ?> </th>
										<th class="text-right"> <?php echo display('rate') ?> </th>
										<th class="text-right"> <?php echo display('ammount') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($sales_info) {
								?>
								{sales_info}
									<tr>
										<td> {date}</td>
										<td>
											<a href="<?php echo base_url().'Cproduct/product_details/{product_id}'; ?>">
												{product_name}-({product_model})
											</a>
										</td>
										<td class="text-right"> {quantity}</td>
										<td class="text-right"><?php echo (($position==0)?"$currency {manufacturer_rate}":"{manufacturer_rate} $currency") ?></td>
										<td class="text-right"><?php echo (($position==0)?"$currency {total}":"{total} $currency") ?></td>
										 
									</tr>
								{/sales_info}
								<?php
									}
								?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="3"></td>
										<td><b><?php echo display('grand_total') ?>:</b></td>
										<td class="text-right">
											<b>
											<?php echo (($position==0)?"$currency {sub_total}":"{sub_total} $currency") ?>
											</b>
										</td>
									</tr>
								</tfoot>
		                    </table>
		                </div>
		                <div class="text-right"><?php echo htmlspecialchars_decode($links)?></div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- manufacturer Sales Summary End -->