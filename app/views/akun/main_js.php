<script type="text/javascript">	
	$('#frmDetailUser').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var kode = button.data("kode");
		var nama = (kode!="") ? button.data("nama") : "";
		var username = (kode!="") ? button.data("user") : "";
		var role = (kode!="") ? button.data("role") : "";
		var email = (kode!="") ? button.data("email") : "";

		var judul = ((kode!="") ? "Edit" : "Tambah") + " data pengguna";
		var mode = (kode!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#kode").val(kode);
		modal.find("#nama").val(nama);
		modal.find("#username").val(username);
		modal.find("#email").val(email);
		modal.find("#role").val(role).change();
		modal.find("#hMode").val(mode);

		$('#role').selectpicker();
		console.log(kode);

		if(kode!="") modal.find("#password").attr("readonly","");
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var kode = $("#kode").val();
    	var nama = $("#nama").val();
    	var username = $("#username").val();
    	var password = $("#password").val();
    	var role = $("#role").val();
    	var email = $("#email").val();
    	var mode = $("#hMode").val();

    	$.ajax({
	        type: "POST",
	        url: "<?= _link('akun/save'); ?>",
	        data: { "kode": kode, "nama": nama, "username": username, "password": password
	        		, "role": role, "editmode": mode, "email": email },
	        success: function (msg) {
	            alert("Data tersimpan dengan sukses");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(error);
	        }
	    });
	}

	$( ".btnDelete" ).click(function() {
		var kode = $(this).attr("data-kode");
		
		if(confirm("Hapus data?")) DeleteData(kode);
    });

    function DeleteData(kode) {
    	$.ajax({
	        type: "POST",
	        url: "<?= _link('akun/delete'); ?>",
	        data: { "kode": kode },
	        success: function (msg) {
	            alert("Data terhapus dengan sukses");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(error);
	        }
	    });
	}
</script>