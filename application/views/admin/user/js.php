<script type="text/javascript">
    $(document).ready(function(){
        $('.select_all').click(function(event){
            if(this.checked)
            {
                // Iterate each checkbox
                $(':checkbox').each(function(){
                    this.checked = true;
                });
            }
            else
            {
                $(':checkbox').each(function(){
                    this.checked = false;
                });
            }
        });

        $('.menu').click(function(event){
            var menuId = $(this).data('id');
            if(this.checked)
            {
                $('.parentMenu_'+menuId).each(function()
                {
                    this.checked = true;
                });

                $('.childMenu_'+menuId).each(function(){
                    this.checked = true;
                });
            }
            else
            {
                $('.parentMenu_'+menuId).each(function()
                {
                    this.checked = false;
                });

                $('.childMenu_'+menuId).each(function(){
                    this.checked = false;
                });
            }
        });
    });
</script>