<style type='text/css' title='currentStyle'>
@import './includes/jquery.dataTables/css/table_jui.css';
 @import './includes/jquery.dataTables/css/table.css';
 @import './includes/jquery.dataTables/css/page.css';
</style>
<script type='text/javascript' language='javascript' src='./includes/jquery.dataTables/jquery.dataTables.js'></script>
<div id='container'>
  <div class='pages_jui'>
    <table width='100%' border='0' cellpadding='0' cellspacing='0' class='display' id='example'>
      <thead>
        <tr>
          <th width='5%' height='22' align='center'>จัดการ</th>
          <th width='8%' align='center'>รหัสเมนู</th>
          <th width='30%' align='center'>ชื่อกลุ่มเมนู (ไทย)</th>
          <th width='30%' align='center'>ชื่อกลุ่มเมนู (อังกฤษ)</th>
          <th width='15%' align='center'>Path ที่อยู่โปรแกรม</th>
          <th width='12%' align='center'>ไอคอน</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align='center'><label>
              <input type='radio' name='radio' id='radio' value='radio' />
            </label></td>
          <td align='center'>1</td>
          <td>&nbsp;เมนูผู้ดูแลระบบ</td>
          <td>&nbsp;Administrator</td>
          <td>Admin</td>
          <td align='center'><img src='./images/menu_actions/icon-config.png' width='18' height='18' /></td>
        </tr>
        <tr>
          <td align='center'><input type='radio' name='radio' id='radio2' value='radio' /></td>
          <td align='center'>2</td>
          <td>&nbsp;ข้อมูลทั่วไป </td>
          <td>&nbsp;Master</td>
          <td>Forms</td>
          <td align='center'><img src='./images/menu_actions/icon-profile.gif' width='16' height='16' /></td>
        </tr>
        <tr>
          <td align='center'><input type='radio' name='radio' id='radio3' value='radio' /></td>
          <td align='center'>3</td>
          <td>&nbsp;รายงาน</td>
          <td>&nbsp;Reports</td>
          <td>Reports</td>
          <td align='center'><img src='./images/menu_actions/icon-report.png' width='16' height='16' /></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class='spacer'></div>
</div>