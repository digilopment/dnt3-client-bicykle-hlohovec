
<div class="col-md-3">
    <section class="panel search">
        <h2 class="title-v4">Vyhľadávanie</h2>
        <form class="search-form" action="<?php echo $this->data['plugin_data']['searchUrl'] ?>">
            <div class="panel-body"><input type="text" placeholder="Vyhľadávanie" name="q" class="form-control" /></div>
        </form>
    </section>
    <section class="panel">
        <h2 class="btn-eshop-menu title-v4">Kategórie 
            <span class="pull-right" ><i class="fa fa-1x fa-bars"></i> </span>
            <div class="btn-group show-all-cats">
                <button title="Zobraziť všetky kategórie v strome" type="button" class="btn btn-default">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </h2>
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
        <div class="panel-body eshop-nav no-padding">

            <?php

            
            
            function htmlElement($element, $data)
            {
                if ($data['hasChild']($element['id'])) {
                    $type = 'parent';
                } else {
                    $type = 'child';
                }
                if ($element['id'] == $data['routeCategory']) {
                    $selected = 'active';
                } else {
                    $selected = '';
                }
                $str = '<li class="' . $type . ' ' . $selected . '">'
                        . '<a class="' . $selected . '" href="' . $data['path'] . '' . $data['modulUrl'] . '/category/' . $element['id_entity'] . '">';

                if ($data['hasChild']($element['id']) && $element['id'] == $data['routeCategory']) {
                    $str .= '<i class="fa fa-angle-down"></i>';
                } elseif ($data['hasChild']($element['id'])) {
                    $str .= '<i class="fa fa-angle-right"></i>';
                } else {
                    $str .= '&nbsp;';
                }
                $str .= $element['name'] . ''
                        . '</a><'
                        . '/li>';
                echo $str;
            }
            
            function child($data, $parentId)
            {
                if ($data['hasChild']($parentId)) {
                    echo '<ul class="nav nav-parent-' . $parentId . '">';
                    foreach ($data['getChildren']($parentId) as $child) {
                        htmlElement($child, $data);
                        child($data, $child['id']);
                    }
                    echo '</ul>';
                }
            }

            echo '<ul class="nav prod-cat no-padding">';
            foreach ($this->data['plugin_data']['categories'] as $parent) {
                htmlElement($parent, $this->data['plugin_data']);
                child($this->data['plugin_data'], $parent['id']);
            }
            echo '</ul>';
            ?>
        </div>
    </section>
</div>