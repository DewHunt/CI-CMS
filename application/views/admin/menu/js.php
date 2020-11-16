<script type="text/javascript">
    $(document).on('change','#parentMenuId',function(){
        var parentMenuId = $('#parentMenuId').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('menu/max_order') ?>",
            data:{parentMenuId:parentMenuId},
            success: function(response) {
                var orderBy = response.orderBy;

                $('#orderBy').val(orderBy);
            },
        });
    });
</script>