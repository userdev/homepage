<div id="container">
    <div id="content">
        <div class="input_container">
            <div class="form-cotainer-header">Piesakies</div>
            <div class="bullet-container-text">
                <?php echo form_open_multipart('/homepage/takeMsg'); ?>
                <div class="form-elem" id="form_name_elem">
                    <input autocomplete="off" placeholder="Vārds, E-pasts" type="text" class="input-text" id="form_name" name="name"  maxlength="200" value="">

                </div>
                <div class="form-elem" id="form_msg_elem">
                    <textarea maxlength="3000" id="contact_msg" name="description" placeholder="Ziņa" value=""></textarea>
                </div>
                <div class="form-elem">
                    <input type="file" name="file" id="file">
                </div>

                <div class="form-elem"><input class="submit-btn" type="submit" value="Sūtīt"></div>
                </form>
                <div id="bullets_container_contact">
                    <div class="cotainer-header">Informācija, kas mūs intresē</div>
                    <ul id="intro_ul">
                        <li><div class="li-img"></div><div id="li_text">Izstrādājuamā produkta tips (interneta veikals, oragnizācijas mājaslapa, personas CV mājaslapa, datorprogramma, datubāze)</div></li>
                        <li><div class="li-img"></div><div id="li_text">Izstrādājamā produkta projekta aptuvenais budžets</div></li>
                        <li><div class="li-img"></div><div id="li_text">Piemērs pastāvošam līdzīgam produktam (mājaslapa, programma)</div></li>
                        <li><div class="li-img"></div><div id="li_text">Ierobežojumi (laika, tehnaloģiju - prasības konkrētu tehnaloģiju pielitošnā)</div></li>
                        <li><div class="li-img"></div><div id="li_text">Variet pievienot detalizētu aprakstu (prasību specifikācija, dizaina skices, u.c.), sūtot pieteikumu vai jautājumu</div></li>
                    </ul>
                </div>
                <div id="bullets_container_contact">
                    <div class="cotainer-header">Kontaktinformācija</div>
                    <div class='bullet-container-text'>
                        <p>E-Pasts: info@i-sistemas.lv</p>
                        <p>Telefons: 25864524</p>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>
</div>