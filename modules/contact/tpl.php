<?php

use DntLibrary\Base\ArticleView;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\MultyLanguage;
use DntLibrary\Base\Vendor;

include "dnt-view/layouts/" . Vendor::getLayout() . "/tpl_functions.php";
get_top($data);
include "dnt-view/layouts/" . Vendor::getLayout() . "/top.php";

$multylanguage = new MultyLanguage;
$article = new ArticleView;

$translate['sidlo'] = MultyLanguage::translate($data, "sidlo", "translate");
$translate['kontakt'] = MultyLanguage::translate($data, "kontakt", "translate");
$translate['meno'] = MultyLanguage::translate($data, "meno", "translate");
$translate['ulica'] = MultyLanguage::translate($data, "ulica", "translate");
$translate['mesto'] = MultyLanguage::translate($data, "mesto", "translate");
$translate['email'] = MultyLanguage::translate($data, "email", "translate");
$translate['tel_c'] = MultyLanguage::translate($data, "tel_c", "translate");
$translate['pobocka'] = MultyLanguage::translate($data, "pobocka", "translate");
$translate['nazov'] = MultyLanguage::translate($data, "nazov", "translate");
$translate['thankyou_for_registration'] = MultyLanguage::translate($data, "thankyou_for_registration", "translate");
$translate['odoslat_btn'] = MultyLanguage::translate($data, "odoslat_btn", "translate");
$translate['field_word_err'] = MultyLanguage::translate($data, "field_word_err", "translate");
$translate['predmet'] = MultyLanguage::translate($data, "predmet", "translate");
$translate['priezvisko'] = MultyLanguage::translate($data, "priezvisko", "translate");
$translate['sprava'] = MultyLanguage::translate($data, "sprava", "translate");
$translate['formular'] = MultyLanguage::translate($data, "formular", "translate");
$translate['ico'] = MultyLanguage::translate($data, "ico", "translate");
$translate['c_ziv_reg'] = MultyLanguage::translate($data, "c_ziv_reg", "translate");
$translate['prevadzka'] = MultyLanguage::translate($data, "prevadzka", "translate");
$translate['kde_nas_najdete'] = MultyLanguage::translate($data, "kde_nas_najdete", "translate");
?>


<?php
get_paralax($data['article']['img'], $data['title']);
?>

<div class="margin-bottom-60"></div>

<div class="container margin-bottom-40">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-9 main-content">
            <!-- Dynamic Item -->
            <div class="blog-grid margin-bottom-30">
                <h2 class="title-v4"> <?php echo $data['article']['name']; ?></h2>
                <div class="overflow-h margin-bottom-10 article-view">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <h4><span class="sidlo-a-pobocka"><?php echo $translate["kde_nas_najdete"] ?>:</span> <?php echo Frontend::getMetaSetting($data, "vendor_company"); ?>, <?php echo Frontend::getMetaSetting($data, "vendor_street"); ?>, <?php echo Frontend::getMetaSetting($data, "vendor_city"); ?></h4>
                            <?php
                            $googleMapsUrl = $data['meta_settings']['keys']['google_map']['value'];
                            $googleMapsToken = $data['meta_settings']['keys']['google_maps_token']['value'];
                            $mapLocation = Dnt::getMapLocation($googleMapsUrl);
                            $map_first = $mapLocation[0];
                            $map_second = $mapLocation[1];
                            $zoom = "12";
                            ?>
                            <iframe style="width: 100%; height: 400px; border: none; border-radius: 5px;" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $map_first; ?>%2C%20<?php echo $map_second; ?>&key=<?php echo $googleMapsToken; ?>"></iframe>
                            <br/><br/>
                            <div class="col-xs-12 col-md-4">
                                <h3><?php echo $translate["prevadzka"] ?></h3>
                                <ul class="dnt_kontakt">
                                    <li><?php echo $translate["nazov"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_company"); ?></b></li>
                                    <li><?php echo $translate["ulica"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_street"); ?></b></li>
                                    <li><?php echo $translate["mesto"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_psc"); ?> <?php echo Frontend::getMetaSetting($data, "vendor_city"); ?></b></li>
                                    <li><?php echo $translate["email"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_email"); ?></b></li>
                                    <li><?php echo $translate["tel_c"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_tel"); ?></b></li>
                                </ul>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <h3><?php echo $translate["sidlo"] ?></h3>
                                <ul class="dnt_kontakt">
                                    <li><?php echo $translate["nazov"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_company"); ?></b></li>
                                    <li><?php echo $translate["ulica"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_sidlo_street"); ?></b></li>
                                    <li><?php echo $translate["mesto"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_sidlo_psc"); ?> <?php echo Frontend::getMetaSetting($data, "vendor_sidlo_city"); ?></b></li>
                                    <li><?php echo $translate["ico"] ?>: <b><?php echo Frontend::getMetaSetting($data, "vendor_ico"); ?></b></li>
                                    <li><?php echo $translate["c_ziv_reg"] ?>: <b><?php echo Frontend::getMetaSetting($data, "c_ziv_reg"); ?></b></li>
                                </ul>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <h3><?php echo MultyLanguage::translate($data, "otvaracie_hodiny", "translate"); ?></h3>
                                <ul class="dnt_kontakt">
                                    <li >
                                        <?php echo MultyLanguage::translate($data, "od_pondelok", "translate"); ?>
                                    </li>
                                    <li >
                                        <?php echo MultyLanguage::translate($data, "od_utorok", "translate"); ?>
                                    </li>
                                    <li >
                                        <?php echo MultyLanguage::translate($data, "od_streda", "translate"); ?>
                                    </li>
                                    <li >
                                        <?php echo MultyLanguage::translate($data, "od_stvrtok", "translate"); ?>
                                    </li>
                                    <li >
                                        <?php echo MultyLanguage::translate($data, "od_piatok", "translate"); ?>
                                    </li>
                                    <li >
                                        <?php echo MultyLanguage::translate($data, "od_sobota", "translate"); ?>
                                    </li>
                                    <li >
                                        <?php echo MultyLanguage::translate($data, "od_nedela", "translate"); ?>
                                    </li>
                                </ul>
                            </div>

                        </div>



                    </div>

                    <div class="col-xs-12">
                        <h3><?php echo $translate['formular']; ?></h3>
                        <div class="overflow-h margin-bottom-10 article-view">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#form-request").validate({
                                        rules: {
                                            meno: {
                                                required: true,
                                                minlength: 1
                                            },
                                            surname: {
                                                required: true,
                                                minlength: 1
                                            },
                                            tel_c: {
                                                required: true,
                                                minlength: 1
                                            },
                                            predmet: {
                                                required: true,
                                                minlength: 1
                                            },
                                            email: {
                                                required: true,
                                                email: true
                                            },
                                            sprava: {
                                                required: true,
                                                minlength: 1
                                            },
                                        },
                                        messages: {
                                            meno: "<?php echo $translate['field_word_err']; ?>",
                                            surname: "<?php echo $translate['field_word_err']; ?>",
                                            tel_c: "<?php echo $translate['field_word_err']; ?>",
                                            predmet: "<?php echo $translate['field_word_err']; ?>",
                                            email: "<?php echo $translate['field_word_err']; ?>",
                                            sprava: "<?php echo $translate['field_word_err']; ?>",

                                        },
                                        submitHandler: function (form) {
                                            $.ajax({
                                                type: "POST",
                                                url: '<?php echo WWW_PATH; ?>rpc/json/contact-form',
                                                data: $(form).serialize(),
                                                timeout: 10000,
                                                dataType: "json",
                                                success: function (data) {
                                                    console.log(data);
                                                    if (data.success == 1) {
                                                        $("#form-request").hide();
                                                        $("#form_ok").show();
                                                    } else if (data.success == 0) {
                                                        alert("Bat token");
                                                    } else {
                                                        writeError(data.message);
                                                    }
                                                },
                                                error: function () {
                                                    alert("Momentálne sme zaneprázdnený.");
                                                }
                                            });
                                            return false;
                                        }
                                    });

                                    function writeError(message) {
                                        $("#form-result").html("<div class=\"alert alert-error\">" + message + "</div>");
                                    }
                                });

                            </script>
                            <form action="" method="post" id="form-request" class="sky-form contact-style" novalidate="novalidate">
                                <fieldset class="no-padding">
                                    <label><?php echo $translate['predmet']; ?> <span class="color-red">*</span></label>
                                    <div class="row sky-space-20">
                                        <div class="col-md-7 col-md-offset-0">
                                            <div>
                                                <input type="text" name="predmet" id="predmet" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <label><?php echo $translate['meno']; ?> <span class="color-red">*</span></label>
                                    <div class="row sky-space-20">
                                        <div class="col-md-7 col-md-offset-0">
                                            <div>
                                                <input type="text" name="meno" id="meno" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <label><?php echo $translate['priezvisko']; ?> <span class="color-red">*</span></label>
                                    <div class="row sky-space-20">
                                        <div class="col-md-7 col-md-offset-0">
                                            <div>
                                                <input type="text" name="surname" id="surname" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <label><?php echo $translate['tel_c']; ?> <span class="color-red">*</span></label>
                                    <div class="row sky-space-20">
                                        <div class="col-md-7 col-md-offset-0">
                                            <div>
                                                <input type="text" name="tel_c" id="tel_c" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <label><?php echo $translate['email']; ?> <span class="color-red">*</span></label>
                                    <div class="row sky-space-20">
                                        <div class="col-md-7 col-md-offset-0">
                                            <div>
                                                <input type="text" name="email" id="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <label><?php echo $translate['sprava']; ?> <span class="color-red">*</span></label>
                                    <div class="row sky-space-20">
                                        <div class="col-md-11 col-md-offset-0">
                                            <div>
                                                <textarea rows="8" name="sprava" id="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" name="sent_msg" value="1" class="btn-u"><?php echo $translate['odoslat_btn']; ?></button>
                                </fieldset>
                            </form>
                            <div id="form_ok" style="display: none;">
                                <div class="message">
                                    <h3><i class="rounded-x fa fa-check"></i><?php echo $translate['thankyou_for_registration']; ?></h3>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br/>
                    <br/>

                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-md-3">
            <?php col_right($data); ?>
        </div><!-- End Right Sidebar -->


    </div>
</div>

<?php
get_footer($data);
get_bottom($data);
