<?php
// Title Menu from function.php
$title = title_menu($_GET['setPage']);
?>
<script type="text/javascript" src="./modules/<?=$_GET['setModule']?>/<?=$_GET['setPage'];?>.js"></script>

<div id="container">
  <table width="100%" border="0" cellpadding="0" cellspacing="2" class="ui-widget-content">
    <tr>
      <td height="25">&nbsp;<b>
        <?=title_menu($_GET['setPage']);?>
        </b></td>
      <td width="34%" align="right" valign="bottom">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br /></td>
    </tr>
  </table>
</div>
