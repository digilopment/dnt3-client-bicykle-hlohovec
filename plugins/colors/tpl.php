<?php

use DntLibrary\Base\Dnt;

$color = $data['meta_settings']['keys']['color']['value'];
$colorRGBA = Dnt::hex2rgba($color, 0.85);
$colorDarken4 = Dnt::darkenColor($color, 4);
$colorDarken2 = Dnt::darkenColor($color, 2);
$colorDarken2RGBA = Dnt::hex2rgba($color, 0.7);
$reverseTextColor = "#ffffff";
echo '<style>
    .strip_cookies {background: ' . $colorDarken2 . ';}
        
   .strip_cookies .btn-primary {background-color: ' . $color . ';border-color: ' . $colorDarken2 . ';}
   
   html body{
   	font-family: "' . $data['meta_settings']['keys']['font']['value'] . '" !important;
   }
   .title-v4 {
       color: ' . $color . ';
   }
   .blog-grid h3 {
       color: ' . $color . ';
   }
   .header-v8 .dropdown-menu {
       border-top: solid 3px ' . $color . ';
   }
   .blog-slider span.blog-slider-badge {
       background: ' . $color . ';
   }
   a {
       color: ' . $color . ';
   }
   a:hover {
       color: ' . $colorDarken2 . ';
   }
   .btn-u {
       background: ' . $color . ';
   }
   .bg-color-darker {
       /*background-color: ' . $color . ' !important;*/
   }
   .fa{
   	 color: ' . $color . ';
   }
   
   h1,h2,h3,h4,h5,h6{
   	color: ' . $color . ';
   }
   .blog-topbar {
       background: ' . $colorDarken2 . ';
   }
   .blog-social-shares li.podmienky a{
   		color: ' . $colorDarken2 . ';
   }
   .title-v4 {
       border-bottom: 3px solid ' . $color . ';
   }
   .ms-wk .ms-slide {
       border: 2px solid ' . $color . ';
   }
   .blog-slider .blog-slider-title {
       background-color: ' . $color . ';
   }
   .dnt-form input {
       border: 1px solid ' . $colorDarken2 . ';
   }
   .dnt-form label {
       color: ' . $colorDarken2 . ';
       font-size: 14px;
   }
   .dnt-form a {
       color: ' . $colorDarken2 . ';
   }
   .dnt-form a:hover {
       color: ' . $color . ';
   }
   .slider-wrap{
   	background-color: ' . $colorDarken2 . ';
   }
   .slider-wrap .text {
       background-color: ' . $colorDarken2RGBA . ';
   }
   
   .footer-v8 .copyright {
       background: ' . $colorDarken4 . ';
   }
   .footer-v8 .footer {
       background: ' . $colorDarken2 . ';
   }
   .btn-u:hover,
   .btn-u:focus,
   .btn-u:active,
   .btn-u.active,
   .open .dropdown-toggle.btn-u {
   	background: ' . $colorDarken2 . ';
   }
   .btn-u-split.dropdown-toggle {
   	border-left: solid 1px ' . $colorDarken2 . ';
   }
   
   a {
   	color: ' . $color . ';
   }
   
   .header-v8 .dropdown-menu {
   	border-top: solid 3px ' . $color . ';
   }
   .header-v8 .dropdown-menu .active > a,
   .header-v8 .dropdown-menu li > a:hover {
   	color: ' . $color . ';
   }
   .header-v8 .navbar-nav .open .dropdown-menu > li > a:hover,
   .header-v8 .navbar-nav .open .dropdown-menu > li > a:focus {
   	color: ' . $color . ';
   }
   .header-v8 .navbar-nav .open .dropdown-menu > .active > a,
   .header-v8 .navbar-nav .open .dropdown-menu > .active > a:hover,
   .header-v8 .navbar-nav .open .dropdown-menu > .active > a:focus {
   	color: ' . $color . ';
   }
   
   .header-v8 .navbar-nav .open .dropdown-menu > .disabled > a,
   .header-v8 .navbar-nav .open .dropdown-menu > .disabled > a:hover,
   .header-v8 .navbar-nav .open .dropdown-menu > .disabled > a:focus {
   	color: ' . $color . ';
   }
   .header-v8 .navbar-nav > li > a:hover {
   	color: ' . $color . ';
   }
   /*.header-v8 .navbar-nav > .active > a,
   .header-v8 .navbar-nav > .active > a:hover,
   .header-v8 .navbar-nav > .active > a:focus {
   	color: ' . $color . ' !important;
   }
   */
   .header-v8 .mega-menu .mega-menu-fullwidth .dropdown-link-list li a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .column-one a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .tags-v4 a:hover {
   	border-color: ' . $color . ';
   	background-color: ' . $color . ';
   }
   .footer-v8 .footer .footer-lists li a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .latest-news h3 a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .input-group-btn .input-btn {
   	background: ' . $color . ';
   }
   .footer-v8 .footer .social-icon-list li i:hover {
   	background: ' . $color . ';
   	border-color: ' . $color . ';
   }
   .blog-slider span.blog-slider-badge {
   	background: ' . $color . ';
   }
   .blog-slider .blog-slider-title h2 a:hover {
   	color: ' . $color . ';
   }
   .blog-ms-v2 .ms-thumb-frame-selected .ms-thumb h3 {
   	color: ' . $color . ';
   }
   .tab-v4 .tab-heading h2 {
   	color: ' . $color . ';
   }
   .title-v4 {
   	color: ' . $color . ';
   }
   .tab-v4 .nav-tabs > .active > a,
   .tab-v4 .nav-tabs > .active > a:hover,
   .tab-v4 .nav-tabs > .active > a:focus {
   	color: ' . $color . ';
   }
   .blog-grid h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-grid .blog-grid-info li a:hover {
   	color: ' . $color . ';
   }
   .blog-grid a.r-more {
   	color: ' . $color . ';
   }
   .blog-grid a.r-more {
   	border-bottom: 1px solid ' . $color . ';
   }
   .blog-thumb .blog-thumb-desc h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-thumb .blog-thumb-info li a:hover {
   	color: ' . $color . ';
   	text-decoration: none;
   }
   .tab-v5 .nav-tabs li.active a {
   	color: ' . $color . ';
   }
   .blog-thumb-v3 h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-video span.category-badge {
   	background: ' . $color . ';
   }
   .twitter-posts .twitter-posts-in a.link {
   	color: ' . $color . ';
   }
   .blog-social-shares li a:hover {
   	color: ' . $color . ';
   }
   .tab-v4 .nav-tabs > li > a:hover {
   	color: ' . $color . ';
   }
   .blog-cars-heading .owl-navigation .owl-btn:focus,
   .blog-cars-heading .owl-navigation .owl-btn:hover {
   	color: ' . $color . ';
   }
   .blog-cars-heading h2 {
   	color: ' . $color . ';
   }
   .blog-thumb-v4 h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-thumb-v2 .blog-thumb-desc h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-thumb-v2 .blog-thumb-info li a:hover {
   	color: ' . $color . ';
   }
   .breadcrumb li.active,
   .breadcrumb li a:hover {
   	color: ' . $color . ';
   }
   .single-page-quote:after {
   	background: ' . $color . ';
   }
   .single-page-quote p {
   	color: ' . $color . ';
   }
   .source-list li a {
   	color: ' . $color . ';
   }
   .blog-grid-tags li a:hover {
   	background: ' . $color . ';
   }
   
   .btn-u.btn-u-default {
   	background: ' . $color . ';
   }
   .btn-u.btn-u-default:hover,
   .btn-u.btn-u-default:focus,
   .btn-u.btn-u-default:active,
   .btn-u.btn-u-default.active,
   .open .dropdown-toggle.btn-u.btn-u-default {
   	background: #c0392b;
   }
   .btn-u.btn-u-split-default.dropdown-toggle {
   	border-left: solid 1px #c0392b;
   }
   
   .blog-thumb .blog-thumb-hover:hover:after {
   	background: rgba(231,76,60,0.9);
   }
   #topcontrol:hover {
   	background: rgba(231,76,60,0.9);
   }
   .blog-video h4 {
   	background: rgba(231,76,60,0.8);
   }
   .blog-grid .blog-grid-grad i:hover {
   	background: rgba(231,76,60,1);
   }
   .blog-thumb-v2 .blog-thumb-grad i:hover {
   	background: rgba(231,76,60,1);
   }
   
   
   /*added in v1.9*/
   .promo-section .tp-caption.Newspaper-Subtitle, .promo-section .Newspaper-Subtitle, .promo-section .erinyen .tp-tab-title {
       color: ' . $color . ';
   }
   
   .tp-bannertimer {
   	background: ' . $color . ';
   }
   
   .carousel-caption h1{
       color: ' . $colorDarken2 . ';;
   }
   .carousel-caption h1 strong{
       padding: 5px;
   	background: ' . $color . ';
   }
   </style>';
?>