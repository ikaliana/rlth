<div class="container-fluid sigbun-container">
  <h2>Profil User</h2>

  <div class="col-sm-6">
	  <form class="form-horizontal">
	    <div class="form-group">
	      <label for="message-text" class="col-sm-3 control-label">Nama:</label>
	      <div class="col-sm-9">
		      <label class="form-control"><?php echo $profil->nama ?></label>
	      </div>
	    </div>

	    <div class="form-group">
	      <label for="recipient-name" class="col-sm-3 control-label">Username:</label>
	      <div class="col-sm-9">
		      <label class="form-control"><?php echo $profil->username ?></label>
	      </div>
	    </div>

	    <div class="form-group">
	      <label for="message-text" class="col-sm-3 control-label">Role:</label>
	      <div class="col-sm-9">
		      <label class="form-control"><?php echo $profil->role_name ?></label>
	      </div>
	    </div>

	    <div class="form-group">
	      <label for="recipient-name" class="col-sm-3 control-label">Email:</label>
	      <div class="col-sm-9">
		      <label class="form-control"><?php echo $profil->email ?></label>
	      </div>
	    </div>

	    <div class="form-group">
	      <label for="recipient-name" class="col-sm-3 control-label"></label>
	      <div class="col-sm-9" style="text-align:right">
		      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#frmDetailUser" id="btnEdit">Edit</button>
	      </div>
	    </div>
	  </form>
  </div>

</div>

<div class="modal fade" id="frmDetailUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit profil</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="message-text" class="col-sm-3 control-label"><span style="color:red">*</span> Nama: </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama" value="<?php echo $profil->nama ?>"></input>
            </div>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-sm-3 control-label"><span style="color:red">*</span> Username:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="username" value="<?php echo $profil->username ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="message-text" class="col-sm-3 control-label">Role:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="role" value="<?php echo $profil->role_name ?>" readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-sm-3 control-label">Email:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="email" value="<?php echo $profil->email ?>">
            </div>
          </div>

		      <div class="form-group" id="errorbox" style="display:none">
		        <div class="col-sm-offset-3 col-sm-9">
		          <div class="alert alert-danger alertbox" role="alert">
		            Password baru dan password konfirmasi tidak sama 
		          </div>
		        </div>
		      </div>

        </form>
      </div>
      <div class="modal-footer">
        <img id="imgSimpan" src="<?php echo base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
        <input type="hidden" id="hMode" value=""></input>
        <input type="hidden" id="kode" value="<?php echo $profil->id ?>"></input>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>