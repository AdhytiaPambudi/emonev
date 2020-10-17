<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Tambah Pengguna</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
			<div class="box-body my-form-body">
			  <?php if(isset($msg) || validation_errors() !== ''): ?>
				  <div class="alert alert-warning alert-dismissible">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
					  <?= validation_errors();?>
					  <?= isset($msg)? $msg: ''; ?>
				  </div>
				<?php endif; ?>
			   
				<?php echo form_open(base_url('admin/users/add'), 'class="form-horizontal"');  ?> 
				  <div class="form-group">
					<label for="firstname" class="col-sm-2 control-label">First Name</label>

					<div class="col-sm-9">
					  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="">
					</div>
				  </div>

				  <div class="form-group">
					<label for="lastname" class="col-sm-2 control-label">Last Name</label>

					<div class="col-sm-9">
					  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="">
					</div>
				  </div>

				  <div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>

					<div class="col-sm-9">
					  <input type="email" name="email" class="form-control" id="email" placeholder="">
					</div>
				  </div>
				  <div class="form-group">
					<label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

					<div class="col-sm-9">
					  <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="">
					</div>
				  </div>
				  <div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>

					<div class="col-sm-9">
					  <input type="password" name="password" class="form-control" id="password" placeholder="">
					</div>
				  </div>
				  <div class="form-group">
					<label for="role" class="col-sm-2 control-label">Select Role</label>

					<div class="col-sm-9">
					  <select name="user_role" class="form-control">
						<option value="">Select Role</option>
						<?php foreach($all_opds as $row): ?>
						<option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
						<?php endforeach; ?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-11">
					  <input type="submit" name="submit" value="Add User" class="btn btn-info pull-right">
					</div>
				  </div>
				<?php echo form_close( ); ?>
			  </div>
		</div>
    </div>
</div>  

<script>
$("#add_user").addClass('active');
</script>    