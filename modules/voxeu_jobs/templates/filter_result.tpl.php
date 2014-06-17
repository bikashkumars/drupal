<div class='table-title'>
  <?php print t('Advertisements Found'); ?>
</div>
<table class="table-result">
  <tbody>
  <?php foreach($datas as $data): ?>
    <tr>
      <td>
      <?php print l($data['title'], 'job/'. $data['posid']); ?>
      <?php print '(' . $data['shortname'] . ')';?>
      </td>
    </tr>
  <?php endforeach;?>
  </tbody>
</table>