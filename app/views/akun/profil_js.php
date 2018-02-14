<script type="text/javascript">
	function ShowError(msg) {
    	$(".alertbox").html(msg);
    	$("#errorbox").show();
	}

	$( "#btnSimpan" ).click(function() {
    	$("#errorbox").hide();
    	var id = $("#kode").val();
    	var nama = $("#nama").val();
    	var username = $("#username").val();
    	var email = $("#email").val();

    	if(nama.trim() == "") {
			ShowError("Nama harus diisi !!");
			return;
		}

    	if(username.trim() == "") {
			ShowError("Username harus diisi !!");
			return;
		}

    	$.ajax({
	        type: "POST",
	        url: "<?= _link('akun/CheckUsername'); ?>",
	        data: { "id": id, "username": username },
	        success: function (msg) { 
	        	var str = msg.trim();
	        	if(str=="SUCCESS") SaveProfil(id,nama,username,email); 
	        	else ShowError("Username " + username + " sudah terpakai oleh user lain! Gunakan username yang berbeda");
	        },
	        error: function (xhr, status, error) {
	            console.log(xhr);
	            ShowError("Sistem error! Silahkan hubungi administrator sistem.");
	        }
	    });
    });

    function SaveProfil(id,nama,username,email) {
    	if(confirm("Simpan data profil user?")) {
	    	$.ajax({
		        type: "POST",
		        url: "<?= _link('akun/SaveProfil'); ?>",
		        data: { "id": id, "nama": nama, "username": username, "email": email },
		        success: function (msg) {
		            Relogin(id);
		        },
		        error: function (xhr, status, error) {
		            //alert("Error!");
		            console.log(xhr);
		            ShowError("Sistem error! Silahkan hubungi administrator sistem.");
		        }
		    });
    	}
	}

	function Relogin(id) {
    	$.ajax({
	        type: "POST",
	        url: "<?= _link('akun/Relogin'); ?>",
	        data: { "id": id },
	        success: function (msg) {
	            var str = msg.trim();
	            if(str=="SUCCESS") {
		            alert("Profil berhasil disimpan");
		            location.reload(true);
	        	}
	        	else ShowError("Sistem error! Silahkan hubungi administrator sistem.");
	        },
	        error: function (xhr, status, error) {
	            //alert("Error!");
	            console.log(xhr);
	            ShowError("Sistem error! Silahkan hubungi administrator sistem.");
	        }
	    });
	}
</script>