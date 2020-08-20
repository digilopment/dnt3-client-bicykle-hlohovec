<?php
if ($data['meta_settings']['keys']['ga_key']['show'] == 1) {
    $ga_key = $data['meta_settings']['keys']['ga_key']['value'];
    ?>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', '<?php echo $ga_key; ?>', 'auto');
        ga('send', 'pageview');
    </script>
    <?php
}
if ($data['meta_settings']['keys']['pixel_retargeting']['show'] == 1) {
    ?>
    <noscript>
    <img height="1" width="1" border="0" alt="" style="display:none" src="<?php echo $data['meta_settings']['keys']['pixel_retargeting']['value']; ?>" />
    </noscript>
<?php } ?>
<?php if (ENABLE_COOKIES_STRIP) { ?>
    <script type="text/javascript">
        function hideStripCookies(thisCookie, thisTime) {
            document.getElementById(thisCookie).style.display = "none";
            setCookie(thisCookie, 1, thisTime);
        }
        if (getCookie("the_cookies3") != 1) {
            document.write('<section class="container col-md-12 row"><div id="the_cookies3" class="strip_cookies text-center"><p>Aby sme Vám zaistili lepší užívateľský komfort a prispôsobili naše služby Vašim potrebám, ukladá TV Markíza na Vašom počítači, tablete alebo smartfóne súbory cookies, a to predovšetkým pre uchovanie Vášho užívateľského nastavenia, poskytovanie obsahu na mieru, obstarávanie anonymných štatistík a zacielenie obchodných oznámení. Niektoré získané informácie TV Markíza zdieľa s inými spoločnosťami (anonymné štatistiky). Niektoré informácie sú aj priamo spracovávané ďalšími spoločnosťami (personalizácia zobrazovanej reklamy) bez zásahu TV Markíza.<br>Podrobnosti o podmienkach používania súborov cookies nájdete <a class="cookies-viac" href="//osobneudaje.markiza.sk/pravidla-pouzivania-cookies" target="_blank">tu</a>. <a class="clear-cookies" href="#" onclick="hideStripCookies(\'the_cookies3\', \'525600\')"><button class="btn btn-primary">Rozumiem</button></a></p></div></section>');
        }
    </script>
<?php } ?>