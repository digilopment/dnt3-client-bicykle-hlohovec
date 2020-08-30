<div class="col-md-9 main-content bussinessController">
    <!-- Dynamic Item -->
    <div class="blog-grid margin-bottom-30">
        <h2 class="title-v4"> <?php echo $data['article']['name']; ?></h2>
        <div class="overflow-h margin-bottom-10 article-view">
            <div class="row">
                <div class="col-md-12 no-padding">
                    <ul class="bussiness nav nav-tabs" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1"
                               aria-selected="true">Ochrana osobnch údajov</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                               aria-selected="false">Obchodné podmienky</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3"
                               aria-selected="false">Reklamačný poriadok</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4"
                               aria-selected="false">Reklamačný formulár</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab5-tab" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5"
                               aria-selected="false">Formulár odstúpenia v lehote 14 dní</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab6-tab" data-toggle="tab" href="#tab6" role="tab" aria-controls="tab6"
                               aria-selected="false">Kontaktné údaje</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <ul class="links">
                                <?php if ($this->data['plugin_data']['postMeta']('zakladne_informacie')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('zakladne_informacie') ?>"><i class="fa fa-external-link"></i> Základné informácie</a></li>
                                <?php } ?>
                                <?php if ($this->data['plugin_data']['postMeta']('pravne_zaklady')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('pravne_zaklady') ?>"><i class="fa fa-external-link"></i> Právne základy spracúvania osobných údajov</a></li>
                                <?php } ?>
                                <?php if ($this->data['plugin_data']['postMeta']('informacna_povinnost')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('informacna_povinnost') ?>"><i class="fa fa-external-link"></i> Informačná povinnosť pre zamestnanca</a></li>
                                <?php } ?>
                                <?php if ($this->data['plugin_data']['postMeta']('spracovatelske_cinnosti')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('spracovatelske_cinnosti') ?>"><i class="fa fa-external-link"></i> Spracovateľské činnosti</a></li>
                                <?php } ?>
                                <?php if ($this->data['plugin_data']['postMeta']('prava_osoby')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('prava_osoby') ?>"><i class="fa fa-external-link"></i> Práva dotknutej osoby</a></li>
                                <?php } ?>
                                <?php if ($this->data['plugin_data']['postMeta']('kurierske_spolocnosti')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('kurierske_spolocnosti') ?>"><i class="fa fa-external-link"></i> Kurierske a doručovateľské spoločnosti</a></li>
                                <?php } ?>
                                <?php if ($this->data['plugin_data']['postMeta']('zacatie_konania')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('zacatie_konania') ?>"><i class="fa fa-external-link"></i> Návrh na začatie konania</a></li>
                                <?php } ?>
                                <?php if ($this->data['plugin_data']['postMeta']('cookies')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('cookies') ?>"><i class="fa fa-external-link"></i> Cookies</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="tab-pane" id="tab2" role="tabpane2" aria-labelledby="tab1-tab">
                            <ul class="links">
                                <?php if ($this->data['plugin_data']['postMeta']('obchodne_podmienky')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('obchodne_podmienky') ?>"><i class="fa fa-external-link"></i> Otvoriť dokument Obchodné podmienky</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="tab-pane" id="tab3" role="tabpane3" aria-labelledby="tab1-tab">
                            <ul class="links">
                                <?php if ($this->data['plugin_data']['postMeta']('reklamacny_poriadok')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('reklamacny_poriadok') ?>"><i class="fa fa-external-link"></i> Otvoriť dokument Reklamačný poriadok</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="tab-pane" id="tab4" role="tabpane4" aria-labelledby="tab1-tab">
                            <ul class="links">
                                <?php if ($this->data['plugin_data']['postMeta']('reklamacny_formular')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('reklamacny_formular') ?>"><i class="fa fa-external-link"></i> Otvoriť dokument Reklamačný formulár</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="tab-pane" id="tab5" role="tabpane5" aria-labelledby="tab1-tab">
                            <ul class="links">
                                <?php if ($this->data['plugin_data']['postMeta']('formular_odstupenia')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('formular_odstupenia') ?>"><i class="fa fa-external-link"></i> Otvoriť dokument Formulár odstúpenia v lehote 14 dní</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="tab-pane" id="tab6" role="tabpane6" aria-labelledby="tab1-tab">
                            <ul class="links">
                                <?php if ($this->data['plugin_data']['postMeta']('kontakt')) { ?>
                                    <li><a target="_blank" href="<?php echo $this->data['plugin_data']['postMeta']('kontakt') ?>"><i class="fa fa-external-link"></i> Kontaktné údaje</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>