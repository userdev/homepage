<div id="container">
    <div id="content">
        <div class="input_container">
            <div class="form-cotainer-header">Jautā mums</div>
            <div class="bullet-container-text">
                <form  role="form" method="POST" action="<?php echo base_url('/homepage/takeMsg'); ?>">
                    <div class="form-elem" id="form_name_elem">
                        <input placeholder="Vārds, E-pasts" type="text" class="input-text" id="form_name" name="name" length="50" maxlength="200" value="">
                        <br>
                    </div>
                    <div class="form-elem" id="form_msg_elem">
                        <textarea maxlength="3000" id="contact_msg" name="description" placeholder="Ziņa" value=""></textarea>
                    </div>
                    <div class="form-elem"><input class="submit-btn" type="submit" value="Sūtīt"></div>
                </form>
            </div>
        </div>
    </div>
</div>