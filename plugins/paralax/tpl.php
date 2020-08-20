<style>
    .microslider-wrapper{
        background: url('<?php echo $data['article']['img']; ?>') no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
    }
</style>
<div class="microslider-wrapper">
    <div class="page-name-wrapper">
        <span class="page-name"><span class="name"><?php echo $data['title']; ?></span></span>
    </div>
</div>