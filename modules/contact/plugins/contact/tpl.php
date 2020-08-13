<div class="col-md-9 main-content">
    <!-- Dynamic Item -->
    <div class="blog-grid margin-bottom-30">
        <h2 class="title-v4"> <?php echo $data['article']['name']; ?></h2>
        <div class="overflow-h margin-bottom-10 article-view">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <h4><span class="sidlo-a-pobocka"><?php echo $this->data['plugin_data']['translate']('kde_nas_najdete') ?>:</span> <?php echo $this->data['plugin_data']['setting']('vendor_company'); ?>, <?php echo $this->data['plugin_data']['setting']('vendor_street'); ?>, <?php echo $this->data['plugin_data']['setting']('vendor_city'); ?></h4>
                    <?php
                    $googleMapsUrl = $data['meta_settings']['keys']['google_map']['value'];
                    $googleMapsToken = $data['meta_settings']['keys']['google_maps_token']['value'];
                    $mapLocation = $this->data['plugin_data']['googleMaps']($googleMapsUrl);
                    $map_first = $mapLocation[0];
                    $map_second = $mapLocation[1];
                    $zoom = "12";
                    ?>
                    <iframe style="width: 100%; height: 400px; border: none; border-radius: 5px;" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $map_first; ?>%2C%20<?php echo $map_second; ?>&key=<?php echo $googleMapsToken; ?>"></iframe>
                    <br/><br/>
                    <div class="col-xs-12 col-md-4">
                        <h3><?php echo $this->data['plugin_data']['translate']('prevadzka') ?></h3>
                        <ul class="dnt_kontakt">
                            <li><?php echo $this->data['plugin_data']['translate']('nazov') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_company'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('ulica') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_street'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('mesto') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_psc'); ?> <?php echo $this->data['plugin_data']['setting']('vendor_city'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('email') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_email'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('tel_c') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_tel'); ?></b></li>
                        </ul>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <h3><?php echo $this->data['plugin_data']['translate']('sidlo') ?></h3>
                        <ul class="dnt_kontakt">
                            <li><?php echo $this->data['plugin_data']['translate']('nazov') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_company'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('ulica') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_sidlo_street'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('mesto') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_sidlo_psc'); ?> <?php echo $this->data['plugin_data']['setting']('vendor_sidlo_city'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('ico') ?>: <b><?php echo $this->data['plugin_data']['setting']('vendor_ico'); ?></b></li>
                            <li><?php echo $this->data['plugin_data']['translate']('c_ziv_reg') ?>: <b><?php echo $this->data['plugin_data']['setting']('c_ziv_reg'); ?></b></li>
                        </ul>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <h3><?php echo $this->data['plugin_data']['translate']('otvaracie_hodiny'); ?></h3>
                        <ul class="dnt_kontakt">
                            <li >
                                <?php echo $this->data['plugin_data']['translate']('od_pondelok'); ?>
                            </li>
                            <li >
                                <?php echo $this->data['plugin_data']['translate']('od_utorok'); ?>
                            </li>
                            <li >
                                <?php echo $this->data['plugin_data']['translate']('od_streda'); ?>
                            </li>
                            <li >
                                <?php echo $this->data['plugin_data']['translate']('od_stvrtok'); ?>
                            </li>
                            <li >
                                <?php echo $this->data['plugin_data']['translate']('od_piatok'); ?>
                            </li>
                            <li >
                                <?php echo $this->data['plugin_data']['translate']('od_sobota'); ?>
                            </li>
                            <li >
                                <?php echo $this->data['plugin_data']['translate']('od_nedela'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 no-padding">
                <h3><?php echo $this->data['plugin_data']['translate']('formular'); ?></h3>
                <div class="overflow-h margin-bottom-10">
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
                                    suhlas: {
                                        required: true,
                                        minlength: 1
                                    }
                                },
                                messages: {
                                    meno: "<?php echo $this->data['plugin_data']['translate']('field_word_err'); ?>",
                                    surname: "<?php echo $this->data['plugin_data']['translate']('field_word_err'); ?>",
                                    tel_c: "<?php echo $this->data['plugin_data']['translate']('field_word_err'); ?>",
                                    predmet: "<?php echo $this->data['plugin_data']['translate']('field_word_err'); ?>",
                                    email: "<?php echo $this->data['plugin_data']['translate']('field_word_err'); ?>",
                                    sprava: "<?php echo $this->data['plugin_data']['translate']('field_word_err'); ?>",
                                    suhlas: "<?php echo $this->data['plugin_data']['translate']('field_word_err'); ?>"
                                },
                                submitHandler: function (form) {
                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo WWW_PATH; ?>rpc/json/contact-form',
                                        data: $(form).serialize(),
                                        timeout: 10000,
                                        dataType: 'json',
                                        success: function (data) {
                                            console.log(data);
                                            if (data.success == 1) {
                                                $('#form-request').hide();
                                                $('#form_ok').show();
                                            } else if (data.success == 0) {
                                                alert('Bat token');
                                            } else {
                                                writeError(data.message);
                                            }
                                        },
                                        error: function () {
                                            alert('Momentálne sme zaneprázdnený.');
                                        }
                                    });
                                    return false;
                                }
                            }
                            );

                            function writeError(message) {
                                $("#form-result").html('<div class="alert alert-error">' + message + '</div>');
                            }
                        }
                        );

                    </script>
                    <form action="" method="post" id="form-request" class="sky-form contact-style" novalidate="novalidate">
                        <fieldset class="no-padding" id="form-area">
                            <label><?php echo $this->data['plugin_data']['translate']('predmet'); ?> <span class="color-red">*</span></label>
                            <div class="row sky-space-20">
                                <div class="col-md-7 col-md-offset-0">
                                    <div>

                                        <?php if ($this->data['plugin_data']['dynamicRequest']) { ?>
                                            <input type="text" name="predmet" value="<?php echo $this->data['plugin_data']['requestSubject'] ?>" id="predmet" class="form-control">
                                        <?php } else { ?>
                                            <input type="text" name="predmet" id="predmet" class="form-control">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <label><?php echo $this->data['plugin_data']['translate']('meno'); ?> <span class="color-red">*</span></label>
                            <div class="row sky-space-20">
                                <div class="col-md-7 col-md-offset-0">
                                    <div>
                                        <input type="text" name="meno" id="meno" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <label><?php echo $this->data['plugin_data']['translate']('priezvisko'); ?> <span class="color-red">*</span></label>
                            <div class="row sky-space-20">
                                <div class="col-md-7 col-md-offset-0">
                                    <div>
                                        <input type="text" name="surname" id="surname" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <label><?php echo $this->data['plugin_data']['translate']('tel_c'); ?> <span class="color-red">*</span></label>
                            <div class="row sky-space-20">
                                <div class="col-md-7 col-md-offset-0">
                                    <div>
                                        <input type="text" name="tel_c" id="tel_c" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <label><?php echo $this->data['plugin_data']['translate']('email'); ?> <span class="color-red">*</span></label>
                            <div class="row sky-space-20">
                                <div class="col-md-7 col-md-offset-0">
                                    <div>
                                        <input type="text" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <label><?php echo $this->data['plugin_data']['translate']('sprava'); ?> <span class="color-red">*</span></label>
                            <div class="row sky-space-20">
                                <div class="col-md-11 col-md-offset-0">
                                    <div>
                                        <?php if ($this->data['plugin_data']['dynamicRequest']) { ?>
                                            <textarea rows="8" name="sprava" id="message" class="form-control"><?php echo $this->data['plugin_data']['requestContent'] ?></textarea>
                                        <?php } else { ?>
                                            <textarea rows="8" name="sprava" id="message" class="form-control"></textarea>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="suhlas">
                                    <span class="text-description" style="max-width: 91%;display: block;text-align: justify;">
                                        <?php print($this->data['plugin_data']['article']['content'])?>
                                    </span>
                                </label>
                            </div>

                            <br>
                            <button type="submit" name="sent_msg" value="1" class="btn-u"><?php echo $this->data['plugin_data']['translate']('odoslat_btn'); ?></button>
                        </fieldset>
                    </form>
                    <div id="form_ok" style="display: none;">
                        <div class="message">
                            <h3><i class="rounded-x fa fa-check"></i><?php echo $this->data['plugin_data']['translate']('thankyou_for_registration'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>