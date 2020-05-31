<?php

use DntLibrary\Base\MultyLanguage;
?>
<div class="margin-bottom-60"></div>
<div class="container eshop margin-bottom-40">
    <div class="container">
        <div class="row">

            <div class="col-md-3 left-columnt">
                <div class="margin-bottom-50">

                    <h2 class="title-v4">Kategórie</h2>
                    <ul class="navigation-tree">
                        <?php

                        function htmlElement($element, $data)
                        {
                            if ($data['hasChild']($element['id'])) {
                                $type = 'parent';
                            } else {
                                $type = 'child';
                            }

                            if ($element['id'] == $data['routeCategory']) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            echo '<li class="' . $type . ' ' . $selected . '"><a href="' . $data['path'] . 'eshop/category/' . $element['id_entity'] . '">' . $element['name'] . '</a></li>';
                        }

                        function child($data, $parentId)
                        {
                            if ($data['hasChild']($parentId)) {
                                echo '<ul>';
                                foreach ($data['getChildren']($parentId) as $child) {
                                    htmlElement($child, $data);
                                    child($data, $child['id']);
                                }
                                echo '</ul>';
                            }
                        }

                        foreach ($this->data['plugin_data']['categories'] as $parent) {
                            htmlElement($parent, $this->data['plugin_data']);
                            child($this->data['plugin_data'], $parent['id']);
                        }
                        ?>
                    </ul>

                    <h2 class="title-v4">Rýchle vyhľadávanie</h2>
                    <ul class="blog-social-shares">
                        <li>
                            <input name="search" type="text">
                        </li>
                    </ul>

                    <h2 class="title-v4">Značky</h2>
                    <ul class="blog-social-shares">
                        <li>
                            <a href="" target="_blank">
                                Mayo
                            </a>
                        </li>
                    </ul>

                    <h2 class="title-v4">Elektrobicykle</h2>
                    <ul class="blog-social-shares">
                        <li>
                            <a href="" target="_blank">
                                Horské
                            </a>
                        </li>
                        <li>
                            <a href="" target="_blank">
                                krosové
                            </a>
                        </li>
                    </ul>


                    <style>

                        .eshop .left-columnt ul.navigation-tree{
                            padding-left: 5px;
                        }
                        .eshop .left-columnt ul{
                            padding-left: 20px;
                        }
                        .eshop .left-columnt ul.navigation-tree li{
                            list-style: none;
                            font-family: 'Roboto Slab',sans-serif;
                            padding-left: 0px;
                            font-size: 14px;
                            line-height: 25px;
                        }
                        .eshop .left-columnt ul.navigation-tree li.parent{
                            font-weight:bold;
                            font-size: 16px;
                            text-transform: uppercase;
                        }

                        .eshop .left-columnt ul.navigation-tree li.selected>a,
                        .eshop .left-columnt ul.navigation-tree li>a:hover{
                            color: #da0809 !important;
                        }

                        .eshop .img-effect:hover {
                            opacity:1;
                            cursor: pointer;
                            border-radius: 0px;
                            -webkit-transform: scale(1.1, 1.1);
                            -webkit-transition-timing-function: ease-out;
                            -moz-transform: scale(1.1, 1.1);
                            -moz-transition-timing-function: ease-out;
                            -ms-transform: scale(1.1, 1.1);
                            -ms-transition-timing-function: ease-out;

                            -webkit-transition-duration: 200ms;
                            -moz-transition-duration: 200ms;
                            -ms-transition-duration: 200ms;

                        }

                    </style>
                    <script>
                        $(function(){
                            $('.tip').tooltip();
                        });
                    </script>


                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-primary text-center">
                            <div class="panel-body">
                                <img class="img-responsive img-effect" src="https://via.placeholder.com/700x500/">
                            </div>
                            <div class="panel-footer">
                                <span class="label label-primary">Specialized S-Works Tarmac SL3</span>
                                <span class="pull-right">
                                    <a href="#" class="btn btn-primary btn-xs tip" title="Favorite">
                                        <i class="glyphicon glyphicon-heart"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary btn-xs tip" title="Buy">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary btn-xs tip" title="Share">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-success">
                            <div class="panel-body">
                                <img class="img-responsive img-effect" src="https://via.placeholder.com/700x500/">
                            </div>
                            <div class="panel-footer">
                                <span class="label label-success">Product name</span>
                                <span class="pull-right">
                                    <a href="#" class="btn btn-success btn-xs tip" title="Favorite">
                                        <i class="glyphicon glyphicon-heart"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-xs tip" title="Buy">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-xs tip" title="Share">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-danger">
                            <div class="panel-body">
                                <img class="img-responsive img-effect" src="https://via.placeholder.com/700x500/">
                            </div>
                            <div class="panel-footer">
                                <span class="label label-danger">Product name</span>
                                <span class="pull-right">
                                    <a href="#" class="btn btn-danger btn-xs tip" title="Favorite">
                                        <i class="glyphicon glyphicon-heart"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-xs tip" title="Buy">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-xs tip" title="Share">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <img class="img-responsive img-effect" src="https://via.placeholder.com/700x500/">
                            </div>
                            <div class="panel-footer">
                                <span class="label label-info">Product name</span>
                                <span class="pull-right">
                                    <a href="#" class="btn btn-info btn-xs tip" title="Favorite">
                                        <i class="glyphicon glyphicon-heart"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-xs tip" title="Buy">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-xs tip" title="Share">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-warning">
                            <div class="panel-body">
                                <img class="img-responsive img-effect" src="https://via.placeholder.com/700x500/">
                            </div>
                            <div class="panel-footer">
                                <span class="label label-warning">Product name</span>
                                <span class="pull-right">
                                    <a href="#" class="btn btn-warning btn-xs tip" title="Favorite">
                                        <i class="glyphicon glyphicon-heart"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-xs tip" title="Buy">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-xs tip" title="Share">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-responsive img-effect" src="https://via.placeholder.com/700x500/">
                            </div>
                            <div class="panel-footer">
                                <span class="label label-default">Product name</span>
                                <span class="pull-right">
                                    <a href="#" class="btn btn-default btn-xs tip" title="Favorite">
                                        <i class="glyphicon glyphicon-heart"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-xs tip" title="Buy">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-xs tip" title="Share">
                                        <i class="glyphicon glyphicon-share"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>