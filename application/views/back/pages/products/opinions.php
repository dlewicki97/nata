<div class="row no-gutters">
   <div class="col-md-12 bd bg-white p-3">
   		<h5>Ilość ocen tego produktu: <strong><?= $num_grades ?></strong></h5>
   		<h5>Średnia ocen tego produktu: <strong><?= $avg_grade ?><i class="fas fa-star"></i></strong></h5>
   		<br>
      <table id="datatable1" class="table display responsive nowrap">
         <thead>
            <tr>
               <th class="wd-5p align-top">L.p.</th>
               <th class="wd-5p align-top"></th>
               <th class="wd-30p align-top">Data dodania</th>
               <th class="wd-30p align-top">Liczba gwiazdek</th>
               <th class="wd-30p align-top">Użytkownik</th>
               <th class="wd-30p align-top">Wiadomość</th>
               <th class="wd-45p text-right no-sort">
               </th>
            </tr>
         </thead>
         <tbody>
            <?php $j=0; foreach (array_reverse($opinions) as $opinion): $j++; ?>
            <tr>
               <td class="align-middle"><?php echo $j; ?>.</td>
               <td class="align-middle">
                  <label class="ckbox">
                  <input type="checkbox" id="checkOpinion<?php echo $opinion->id; ?>" onchange="active_opinion(<?php echo $opinion->id; ?>, 'opinions');" <?php if($opinion->active == 1){echo 'checked';} ?>>
                  <span><strong>Aktywne</strong></span>
                  </label>
               </td>
               <td class="align-middle">
               	<?= date('H:i:s', strtotime($opinion->created)) . '<br>' . date('d.m.y', strtotime($opinion->created)); ?>
               </td>
               <td class="align-middle">
               	<?php for ($i=0; $i < $opinion->grade; $i++) { 
               		echo '<i class="fas fa-star"></i>';
               	} ?>
               	<?= $opinion->grade; ?>
               </td>
               <td class="align-middle">
               	<?= $opinion->name; ?>
               </td>
               <td class="align-middle" data-container="body" data-toggle="popover" data-popover-color="default" data-placement="top" data-html="true" data-content="<?= $opinion->message; ?>">
                 <span style="cursor: pointer;"><?= substr($opinion->message, 0, 50); ?>
                 <?php if(strlen($opinion->message) > 49) {
                   echo '...';
                 } ?></span>
               </td>
               <td class="text-right">
                  <a href="<?php echo base_url(); ?>panel/settings/delete/opinions/<?php echo $opinion->id; ?>" class="btn btn-sm btn-secondary" 
                     onclick="return confirm('Czy na pewno chcesz usunąć <?php echo $opinion->name; ?>? #<?php echo $opinion->id; ?>')" >
                  <i class="fa fa-close mg-r-10"></i> Usuń
                  </a>
               </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</div>

<script type="text/javascript">
  function active_opinion(id, table) {
    value = document.getElementById('checkOpinion'+id).checked;
    if(value == true) { value = 1;} else {value = 0;}
    $.ajax({  
         type: "post", 
         url:"<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/active_opinion", 
         data: {id:id, value:value, table:table}, 
         cache: false,
         beforeSend:function(html){
           console.log(html);
         },
         complete:function(html){
           console.log(html);
         }  
    });  
  }
</script>