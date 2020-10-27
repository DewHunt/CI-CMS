<script type="text/javascript">
    $(document).on('change','#parentMenuId',function(){
        var parentMenuId = $('#parentMenuId').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('menu/maxorder') ?>",
            data:{parentMenuId:parentMenuId},
            success: function(response) {
                var orderBy = response.orderBy;

                $('#orderBy').val(orderBy);
            },
        });
    });
</script>