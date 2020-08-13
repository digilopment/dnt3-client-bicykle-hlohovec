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
    
    @media screen and (max-width: 991px) {
        .eshop .nav>li>a.active,
        .eshop .nav>li>a.class-96,
        .eshop .nav>li>a.class-132,
        .eshop .nav>li>a.class-110,
        .eshop .nav>li>a.class-149,
        .eshop .nav>li>a.class-171,
        .eshop .nav>li>a.class-118{
            text-transform: uppercase;
            font-weight: bold;
            color: #da0809;
            border-bottom: 0px;
        }
        
        .eshop .nav>li>a.active{
            font-size: 16px;
        }
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
        $("#showCat").attr('href','#cat<?php echo $this->data['plugin_data']['routeCategory'];?>');
        
        var activeClass = '<?php echo $this->data['plugin_data']['routeCategory'];?>';
        if(!activeClass){
            activeClass = 131;
        }
        $(".nav.prod-cat .class-" + activeClass).addClass('active');
    });
</script>