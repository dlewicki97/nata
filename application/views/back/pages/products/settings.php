<style type="text/css">
.bootstrap-tagsinput {
    background-color: #fff;
}
.bootstrap-tagsinput input {
	color: #000;
}
</style>
<div class="row no-gutters">
   <div class="col-md-12">
      <div class="row">

         <div class="col-md-6 pr-0">
            <div class="form-group bd-r-0-force bd-b-0-force">
               <label class="form-control-label">Informacja o niskim stanie magazynowym:</label>
               <input class="form-control" type="text" name="low_qty" value="<?php echo @$value->low_qty; ?>">
            </div>
         </div>
         <div class="col-md-6 pl-0">
            <div class="form-group bd-b-0-force">
               <label class="form-control-label">Kolejność produktu:</label>
               <input class="form-control" type="text" name="priority" value="<?php echo @$value->priority; ?>">
            </div>
         </div>

         <div class="col-md-12">
            <div class="form-group bd-b-0-force">
               <label class="form-control-label">Tagi (słowa kluczowe):</label>
               <input type="text" name="tags" value="<?php echo @$value->tags; ?>" class="form-control bg-white transition pd-y-10" data-role="tagsinput"> 
            </div>
         </div>

      </div>
   </div>
</div>