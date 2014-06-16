<table class='filter-form'>
  <tbody>
    <tr>
      <td>
        <?php print $form['categories']['#title'];?>
      </td>
      <td>
        <?php print drupal_render($form['categories']);?>
      </td>
      <td rowspan='2' width='80' align='center'>
        <?php print drupal_render($form['submit']);?>
      </td>
    </tr>
    <tr>
      <td>
        <?php print $form['types']['#title'];?>
      </td>
      <td>
        <?php print drupal_render($form['types']);?>
      </td>
    </tr>
  </tbody>
</table>

<?php if(isset($form['table'])): ?>
  <?php print drupal_render($form['table']);?>
<?php endif; ?>
<?php
  print drupal_render($form['form_build_id']);
  print drupal_render($form['form_token']);
  print drupal_render($form['form_id']);
?>