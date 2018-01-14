<div class="container-fluid sigbun-container">
    <h2>Daftar User</h2>

    <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Role</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data->result() as $row) { ?>
            <tr>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->role_name; ?></td>
                <td><?php echo $row->email; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs" title="Update user"
                        data-toggle="modal" data-target="#frmDetailUser"
                        data-kode="<?php echo $row->id; ?>" data-nama="<?php echo $row->nama; ?>"
                        data-user="<?php echo $row->username; ?>" data-email="<?php echo $row->email; ?>"
                        data-role="<?php echo $row->role_id; ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs btnDelete" title="Hapus user" data-kode="<?php echo $row->id; ?>">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#frmDetailUser" data-kode="">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah user
    </button>

</div>

<div class="modal fade" id="frmDetailUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah data pengguna</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="message-text" class="col-sm-2 control-label">Nama:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama"></input>
            </div>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-sm-2 control-label">Username:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username">
            </div>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password">
            </div>
          </div>

          <div class="form-group">
            <label for="message-text" class="col-sm-2 control-label">Role:</label>
            <div class="col-sm-10">
              <select class="form-control" id="role">
                  <option value="">[ Pilih Role ]</option>
                  <?php foreach ($role->result() as $row) { ?>
                  <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <img id="imgSimpan" src="<?php echo base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
        <input type="hidden" id="hMode" value=""></input>
        <input type="hidden" id="kode" value=""></input>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>