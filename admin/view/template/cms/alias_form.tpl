<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/alias.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
     	<div id="tabs" class="htabs">
            <a href="#tab-general"><?php echo $tab_general; ?></a>
        </div>
      	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        	<div id="tab-general">
                <div id="languages" class="htabs">
                    <?php foreach ($languages as $language) { ?>
                        <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                    <?php } ?>
                </div>
          		<table class="form">
            		<tr>
              			<td><?php echo $entry_query; ?></td>
              			<td><input type="text" name="query" value="<?php echo $query; ?>" size="60" /></td>
            		</tr>            		
            		<tr>
              			<td><?php echo $entry_keyword; ?></td>
              			<td><input type="text" name="keyword" value="<?php echo $keyword; ?>" size="60" /></td>
            		</tr>  
          		</table>
        	</div>
      	</form>
  	</div>
  </div>
</div>

<script type="text/javascript">
<!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//-->
</script> 
<?php echo $footer; ?>