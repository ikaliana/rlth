    <script src="<?= _resx('js') ?>/bootstrap-filestyle.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#rtlh_file").change(function() {
                var file = $(this).val();

                if(file != "")
                    $(".submit_btn").removeAttr("disabled");
            })

            $(".submit_btn").on("click", function() {
                $(".submit_btn").attr("disabled", "disabled");

                var file = $("#rtlh_file").val();

                if(file != "")
                    $("#frm_import").submit();
                else
                    return false;
            });
        });
    </script>