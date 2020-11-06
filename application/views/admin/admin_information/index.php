<div class="card">            
    <div class="custom-card-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><h4 class="custom-card-title"><?= $title ?></h4></div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                <?php if (empty($adminInformation)): ?>
                	<?= $this->LinkModel->AddLink(); ?>
                <?php else: ?>
                	<?= $this->LinkModel->EditLink(); ?>                	
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="card-body">
    	<?php if (empty($adminInformation)): ?>
    		<h4>Please Add Admin Information</h4>
    	<?php else: ?>
    		<div class="table-responsive">
				<table class="table table-borderless table-sm">
				    <thead class="thead-dark">
				        <tr>
				            <th colspan="6">Admin Information</th>
				        </tr>
				    </thead>

				    <tbody>
				    	<tr>
				    		<td class="head_name">Website Name</td>
				    		<td class="head_colon">:</td>
				    		<td><?= $adminInformation->website_name ?></td>
				    	</tr>

				    	<tr>
				    		<td class="head_name">Website Prefix Title</td>
				    		<td class="head_colon">:</td>
				    		<td><?= $adminInformation->prefix_title ?></td>
				    	</tr>

				    	<tr>
				    		<td class="head_name">Website Title</td>
				    		<td class="head_colon">:</td>
				    		<td><?= $adminInformation->website_title ?></td>
				    	</tr>

				    	<tr>
				    		<td class="head_name">Developed By</td>
				    		<td class="head_colon">:</td>
				    		<td><?= $adminInformation->developed_by ?></td>
				    	</tr>

				        <tr>
				            <td class="head_name">Developer Website Link</td>
				            <td class="head_colon">:</td>
				            <td><?= $adminInformation->developer_website_link ?></td>
				        </tr>
				    </tbody>
				</table>

				<table class="table table-bordered table-sm">
					<thead class="thead-dark">
						<tr>
							<th colspan="3">Images</th>
						</tr>
					</thead>

					<tbody align="center">
						<tr>
							<td width="150px">
								<img src="<?= base_url($adminInformation->logo_one); ?>">
							</td>
							<td width="150px">
								<img src="<?= base_url($adminInformation->logo_two); ?>">
							</td>
							<td width="150px">
								<img src="<?= base_url($adminInformation->fav_icon); ?>">
							</td>
						</tr>

						<tr>
							<td class="image_title">Logo - 1</td>
							<td class="image_title">Logo - 2</td>
							<td class="image_title">Fav Icon</td>
						</tr>
					</tbody>
				</table>
    		</div>
    	<?php endif ?>
    </div>
</div>