@extends('layout')

@section('content')
<div class='container main-container'>
  <h2>Edit page</h2>
  <form role='form' action='admin/page/update/<?= $page->id ?>' method='POST' enctype='multipart/form-data'>
          {{ csrf_field() }}

<button type='button' class='btn btn-link pull-right' style='margin-top:-2%;' data-toggle='modal' data-target='.<?= $page->id ?>-modal-xl'>
  <img src='<?= $page->getThumb() ?>' class='img img-thumbnail' width=300  >
</button>

  <br><br>
  <input type='hidden' name='id' value='<?= $page->id ?>'>
  <div class='form-group pull-left col-xs-12 col-md-8' >
      <label for='title'>Menu:</label>
      <input type='text' class='form-control' id='menu-title' name='name' onkeyup="ajaxGetSlug();" value='<?= htmlspecialchars($page->name,ENT_QUOTES) ?>' required></input>
      <small><b>Semantic url:</b>&nbsp&nbsp&nbsp<?= $data['domain'].rtrim(BASE_DIR,'/') ?><a class='text-muted' id='ajaxSlug'><?= "/".UrlManager::seo_url($page->name) ?></a> </small>
    </div>

<br>
    <div class='form-group pull-left col-xs-12 col-md-8' >
         <label for='title'>Page template:</label>

      <select class='form-control' name='url'>
        <option value=''>Default</option>
        <?php 

          foreach($page_templates as $template){
            echo "<option value='".$template."' "; if($template==$page->url){ echo "selected"; } echo ">"
                    .ucfirst(rtrim($template,".php")).
                  "</option>";
          }

        ?>
      </select>
    </div>
<br>

<?php

echo "<div class='form-group pull-left col-xs-12 col-md-6' id='level' >
  <label for='level'>Level:</label>
  <select class='form-control' name='parent_select' >  
          <option value='0' "; if($page->parent==0){echo "selected";} echo">Main menu</option>
          <option value='1' "; if($page->parent!=0){echo "selected";} echo">Submenu</option>";
echo "</select></div>";

echo "<div class='form-group pull-left col-xs-12 col-md-6' id='submenus'>
  <label for='submenus'>Parent menu:</label>
  <select class='form-control' name='parent' >";  
      
      echo "<option value='0'>None</option>"; 

      foreach($all_page as $each){

      	if($page->id==$each->id){continue;}

      	if($page->parent==$each->id){
      		echo "<option value='".$each->id."' selected >".$each->name."</option>"; 
  		}else{
   			echo "<option value='".$each->id ."'>".$each->name."</option>"; 
  			}
      }

echo "</select></div>";

/*echo "<div class='form-group pull-left col-xs-12 col-md-8' >
          <label for='title'>Visibility:&nbsp&nbsp&nbsp&nbsp</label>
              <input type='radio' name='visibility' value='1' "; if($page->visibility==1){echo "checked";}echo">Visible&nbsp&nbsp&nbsp&nbsp&nbsp
              <input type='radio' name='visibility' value='0' "; if($page->visibility==0){echo "checked";}echo">Invisible&nbsp&nbsp&nbsp&nbsp&nbsp
      </div></br>";*/

echo "  
<div class='form-group pull-left col-xs-12 col-md-8' style='margin-top:20px;margin-bottom:20px;'>
  <label style='margin-right:10px;'>Visibility:</label> 
        <div class='radio radio-info radio-inline'>
                        <input type='radio' id='inlineRadio1' value='1' name='visibility' "; if($page->visibility==1){echo "checked";}echo">
                        <label for='inlineRadio1'> Visible </label>
                    </div>
                    <div class='radio radio-inline'>
                        <input type='radio' id='inlineRadio2' value='0' name='visibility' "; if($page->visibility==0){echo "checked";}echo">
                        <label for='inlineRadio2'> Invisible </label>
                    </div>
</div>
";
?>

<div class='form-group pull-left col-xs-12 col-md-12' >
      <label for='text'>Page content:</label>

<!-------------------------------------------------- jQUERY TEXT EDITOR ------------------------------------------------------>

<textarea name='page' id='editor' rows="15" cols="80"><?php echo $page->page ?></textarea>


            <script>

                CKEDITOR.replace( 'editor' );
                CKEDITOR.config.language = '<?= Config::get('app.locale') ?>';
                CKEDITOR.config.removeButtons = 'Save';
                CKEDITOR.config.height = 350;

            </script>


<!--echo "<textarea name='page' class='jqte-test'>".$page->page."</textarea>

<!-------------------------------------------------------- jQUERY TEXT EDITOR ------------------------------------------------------>


</div>

      <div class='form-group col-xs-12 col-md-12'>
            <label for='file'>Upload file:</label>
            <input name='up_file' id='input-2' type='file' class='file' multiple='true' data-show-upload='true' data-show-caption='true'>
      </div>


<div class='form-group pull-left col-xs-12 col-md-8' >
    <button id='submit-btn' type='submit' class='btn btn-primary btn-lg' onclick='window.onbeforeunload = null;'>Save updates</button>
    </div>
  </form>
</div>

<?php
Bootstrap::image_details($page->id,$page->get_image());
?>

<script type='text/javascript'>
  $('.jqte-test').jqte();
  

  var jqteStatus = true;
  $('.status').click(function()
  {
    jqteStatus = jqteStatus ? false : true;
    $('.jqte-test').jqte({'status' : jqteStatus})
  });
</script>





<script type='text/javascript'>
 jQuery(document).ready(function() {

   jQuery('#level').change(function() {
      if(jQuery(this).find('option:selected').val() == '0') {
         jQuery('#submenus').hide();

      }
      else{

        jQuery('#submenus').show();
      }
   });
});
</script>

<script type='text/javascript'>
  function ajaxGetSlug(){

    text = $('#menu-title').val();

    if(text!=""){
      $.get("admin/ajax/ajaxConvertSlug/"+text, function( data ) {
        $("#ajaxSlug").html( "/"+data );
      });
    }else{
      $("#ajaxSlug").html("");
    }


  }
</script>

@endsection;