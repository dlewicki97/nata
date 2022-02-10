<div class="row no-gutters">
   <div class="col-md-12">
      <div class="row">

         <div class="col-md-6 pr-0">
            <div class="form-group bd-r-0-force bd-b-0-force">
               <label class="form-control-label">Cena detaliczna brutto: <span class="tx-danger">*</span></label>
               <input class="form-control" type="text" name="price_brutto" value="<?php echo @$value->price_brutto; ?>">
            </div>
         </div>
         <div class="col-md-6 pl-0">
            <div class="form-group">
               <label class="form-control-label">Cena detaliczna netto: <span class="tx-danger">*</span></label>
               <input class="form-control" type="text" name="price_netto" value="<?php echo @$value->price_netto; ?>">
            </div>
         </div>

         <!-- <div class="col-md-6 pr-0">
            <div class="form-group bd-b-0-force bd-r-0-force">
               <label class="form-control-label">Cena hurtowa brutto: <span class="tx-danger">*</span></label>
               <input class="form-control" type="text" name="price_hurt_brutto" value="<?php echo @$value->price_hurt_brutto; ?>">
            </div>
         </div>
         <div class="col-md-6 pl-0">
            <div class="form-group">
               <label class="form-control-label">Cena hurtowa netto: <span class="tx-danger">*</span></label>
               <input class="form-control" type="text" name="price_hurt_netto" value="<?php echo @$value->price_hurt_netto; ?>">
            </div>
         </div> -->

         <div class="col-md-6 pr-0">
            <div class="form-group">
               <label class="form-control-label">Promocja:</label>
                <label class="ckbox">
        	        <input id="promo" type="checkbox" <?php if(@$value->promo_active == 1){echo 'checked';} ?> onchange="checkPromo()" name="promo_active" value="1">
    	            <span>Aktywuj promocję na ten produkt</span>
                </label>
            </div>
         </div>
         <div id="discountPercent" class="col-md-6 pl-0 <?php if(@$value->promo_active == 0){echo 'd-none';} ?>">
            <div class="form-group bd-l-0-force bd-b-0-force bd-t-0-force">
               <label class="form-control-label">Wartość procentowa promocji:</label>
               <input class="form-control" type="text" name="promo_discount" value="<?php echo @$value->promo_discount; ?>">
            </div>
         </div>

         <div id="promoStart" class="col-md-6 pr-0 <?php if(@$value->promo_active == 0){echo 'd-none';} ?>">
            <div class="form-group bd-t-0-force">
               <label class="form-control-label">Data rozpoczęcia promocji:</label>
               <input class="form-control" type="date" name="promo_start" value="<?php echo @$value->promo_start; ?>">
            </div>
         </div>
         <div id="promoEnd" class="col-md-6 pl-0 <?php if(@$value->promo_active == 0){echo 'd-none';} ?>">
            <div class="form-group bd-l-0-force">
               <label class="form-control-label">Data zakończenia promocji:</label>
               <input class="form-control" type="date" name="promo_end" value="<?php echo @$value->promo_end; ?>">
            </div>
         </div>

      </div>
   </div>
</div>


<script type="text/javascript">
	function checkPromo() {
	    value = document.getElementById('promo').checked;
	    if(value == true) {
	    	$("#discountPercent").removeClass("d-none");
	    	$("#promoStart").removeClass("d-none");
	    	$("#promoEnd").removeClass("d-none");
	    } else {
	    	$("#discountPercent").addClass("d-none");
	    	$("#promoStart").addClass("d-none");
	    	$("#promoEnd").addClass("d-none");
	    }
	} 
</script>