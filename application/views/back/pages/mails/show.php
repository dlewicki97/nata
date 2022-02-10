    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Wiadomości #<?php echo $value->id; ?></h4>
        <p class="mg-b-0"><?php echo subtitle(); ?></p>
        <hr>
      </div><!-- d-flex -->

      <div class="br-pagebody mg-t-0 pd-x-30">
        <?php if(isset($_SESSION['flashdata'])): ?>
        <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
        <?php endif; ?>

          <div class="form-layout form-layout-2">

            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="row"> <!-- set -->
                        <div class="col-md-12 pr-0">
                            <div class="form-group bd-b-0-force">
                                <label class="form-control-label">Imię i nazwisko:</label>
                                <input class="form-control" type="text" value="<?php echo $value->name; ?>" readonly>
                            </div>
                        </div><!-- col-12 -->
                        <div class="col-md-6 pr-0">
                            <div class="form-group">
                                <label class="form-control-label">Adres E-mail:</label>
                                <input id="email" class="form-control" type="text" value="<?php echo $value->email; ?>" readonly>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-md-6 px-0">
                            <div class="form-group bd-l-0-force">
                                <label class="form-control-label">Telefon:</label>
                                <input class="form-control" type="text" value="<?php echo $value->phone; ?>" readonly>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-md-12 pr-0">
                            <div class="form-group bd-t-0-force">
                                <label class="form-control-label">Temat:</label>
                                <input class="form-control" type="text" value="<?php echo $value->subject; ?>" readonly>
                            </div>
                        </div><!-- col-12 -->
                    </div> <!-- set -->
                    <div class="row"> <!-- set -->
                        <div class="col-md-12 pr-0">
                            <div class="form-group bd-t-0-force bd-b-0-force">
                                <label class="form-control-label">Treść wiadomości</label>
                                <textarea class="form-control" readonly><?php echo $value->message; ?></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div> <!-- set -->
                    <div class="row"> <!-- set -->
                        <div class="col-md-6 pr-0">
                            <div class="form-group bd-b-0-force bd-r-0-force">
                                <label class="ckbox">
                                    <input type="checkbox" <?php if($value->rodo1 == 1){echo 'checked';} ?> onclick="return false;">
                                    <span>Zgoda na przetwarzanie danych osobowych</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-md-6 px-0">
                            <div class="form-group bd-b-0-force">
                                <label class="ckbox">
                                    <input type="checkbox" <?php if($value->rodo2 == 1){echo 'checked';} ?> onclick="return false;">
                                    <span>Zgoda na kontakt mailowy i telefoniczny</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <?php if(!empty($value->attachment)):?>
                        <div class="col-md-12 pr-0">
                            <div class="form-group bd-b-0-force">
                            <label class="form-control-label">Załącznik do pobrania: <a download href="<?php echo base_url(); ?>mailer/attachment/<?php echo $value->attachment?>"><i class="fas fa-file-download fa-3x ml-3 tx-black"></i></a></label>

                            </div>
                        </div><!-- col-4 -->
                        <?php endif; ?>
                    </div> <!-- set -->
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            <div class="form-layout-footer bd pd-20">
                                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Powrót</button>
                            </div><!-- form-group -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-group bd-l-0-force">
                            <div id="answer">
                                <?php if($value->answer == 1): ?>
                                <span class="text-success"><i class="fas fa-check"></i> Odpowiedź została wysłana!</span>
                                <?php endif; ?>
                            </div>
                            <label class="form-control-label">Temat Twojej wiadomości:</label>
                            <input class="form-control" type="text" name="subject" required>
                        </div>
                    </div><!-- col-12 -->
                    <div class="col-md-12">
                        <div class="form-group bd-l-0-force bd-t-0-force">
                            <label class="form-control-label">Treść Twojej wiadomości</label>
                            <textarea class="summernote" class="form-control" name="message"></textarea>
                        </div>
                    </div><!-- col-12 -->
                    <div class="col-md-12">
                        <div class="form-layout-footer bd pd-20 bd-t-0-force">
                            <button class="btn btn-info" onclick="sendMessage(<?php echo $value->id; ?>)">Wyślij</button>
                        </div><!-- form-group -->
                    </div><!-- col-12 -->
                </div>
            </div><!-- row -->
        </div><!-- form-layout -->


    <script type="text/javascript">
      function sendMessage(id)
      {
        var id = id;
        var subject = document.getElementsByName('subject')[0].value;
        var message = document.getElementsByName('message')[0].value;
        var email = document.getElementById('email').value;
        $.ajax({  
             type: "post", 
             url:"<?php echo base_url(); ?>panel/mails/send", 
             data: {id:id, subject:subject, message:message, email:email}, 
             cache: false,
             beforeSend:function(html)
             {
                document.getElementById('answer').innerHTML = '<p class=""><i class="fas fa-spinner fa-pulse loader"></i></p>';
             },
             complete:function(html)
             {
                 console.log(html);
                document.getElementById('answer').innerHTML = '<p class="text-success"><i class="fas fa-check"></i> Odpowiedź została wysłana!</p>';
             }  
        });  
      }
    </script>