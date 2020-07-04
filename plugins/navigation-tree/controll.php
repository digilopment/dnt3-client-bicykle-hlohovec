<style>
    .prod-cat .nav{
        display: none;
    }
    <?php foreach ($this->data['plugin_data']['getParentElements']($this->data['plugin_data']['routeCategory']) as $parent) { ?>
        .prod-cat .nav.nav-parent-<?php echo $parent; ?> {
            display: block;
        }
    <?php } ?>
    .prod-cat .nav.nav-parent-<?php echo $this->data['plugin_data']['routeCategory']; ?> {
        display: block;
    }

    .prod-cat .nav.nav-parent-131 {
        display: block;
    }

</style>
<script>
    $(document).ready(function () {
        $(".show-all-cats").click(function () {
            if ($(".show-all-cats").hasClass('isShow')) {
                $(".eshop .prod-cat .nav").hide();
                $(".show-all-cats").removeClass('isShow');
                    <?php foreach ($this->data['plugin_data']['getParentElements']($this->data['plugin_data']['routeCategory']) as $parent) { ?>
                    $(".prod-cat .nav.nav-parent-<?php echo $parent; ?>").show();
                    <?php } ?>
                $(".prod-cat .nav.nav-parent-131").show();
            } else {
                $(".eshop .prod-cat .nav").fadeIn();
                $(".show-all-cats").addClass('isShow');
            }
        });
    });
</script>