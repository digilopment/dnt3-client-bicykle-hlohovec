<div class="col-md-3 category-section">
    <section class="panel">
        <h2 class="btn-eshop-menu title-v4">Kategórie 
            <span class="pull-right" ><a id="showCat" href="#" class="fa fa-1x fa-bars"></a> </span>
            <div class="btn-group show-all-cats">
                <button title="Zobraziť všetky sekcie v zozname" type="button" class="btn btn-default">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </h2>
        <div class="panel-body eshop-nav no-padding">

            <?php

            function htmlElement($element, $data)
            {
                if ($data['hasChild']($element['id'])) {
                    $type = 'parent';
                } else {
                    $type = 'child';
                }
                $str = '<li class="' . $type . '">'
                        . '<a id="cat' . $element['id_entity'] . '" class="class-' . $element['id_entity'] . '" href="' . $data['path'] . '' . $data['modulUrl'] . '/category/' . $element['id_entity'] . $data['aggrBuilder']() . '">';

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
    <section class="panel search">
        <h2 class="title-v4">Vyhľadávanie</h2>
        <form class="search-form" action="<?php echo $this->data['plugin_data']['searchUrl'] ?>">
            <div class="panel-body"><input type="text" placeholder="Vyhľadávanie" name="q" class="form-control" /></div>
        </form>
    </section>
</div>