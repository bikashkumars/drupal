<?php
  $datas = array(
    17 => 'Any field',
    16 => 'Behavioral Economics',
    21 => 'Business Economics',
    22 => 'Computational Economics',
    1 => 'Development; Growth', 
    2 => 'Econometrics',
    3 => 'Economic History',
    4 => 'Environmental; Ag. Econ',
    5 => 'Experimental Economics',
    6 => 'Finance', 
    20 => 'Health; Education; Welfare',
    7 => 'Industrial Organization',
    26 => 'Insurance',
    8 => 'International Finance/Macro',
    9 => 'International Trade',
    10 => 'Labor; Demographic Econ',
    11 => 'Law and Economics',
    12 => 'Macroeconomics; Monetary',
    27 => 'Management, General',
    30 => 'Marketing',
    13 => 'Microeconomics',
    18 => 'Other',
    14 => 'Public Economics',
    15 => 'Theory',
    19 => 'Urban; Rural; Regional Econ',
  );
  $categories = explode(',', (string)$myads->categories);
  $path = URL_SERVICE_IMG . '/' . (string)$myads->oid;
  $start_date = @strtotime((string)$myads->startdate);
  $end_date = @strtotime((string)$myads->enddate);
  $options = array(
    'attributes' => array(
      'target' => '_blank',
      'class' => 'external_job',
    ),
  );
?>
<table class="job-detail">
  <tbody>
  <tr>
    <td class="table-label"><?php print t('Ad Title'); ?></td>
    <td><b><?php print t((string)$myads->adtitle); ?></b></td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('Type'); ?></td>
    <td><b><?php print t((string)$myads->position_type); ?></b></td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('Institution'); ?></td>
    <td><b><?php print t((string)$myads->name); ?></b></td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('Department'); ?></td>
    <td><b><?php print t((string)$myads->department); ?></b></td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('Categories'); ?></td>
    <td>
      <ol>
      <?php foreach($categories as $cid): ?>
         <li><?php print $datas[$cid]; ?></li>
      <?php endforeach;?>
      </ol>
    </td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('Descritption'); ?></td>
    <td>
      <p style="text-align:center;"> <img src="<?php print $path; ?>" /> </p>
      <?php print t((string)$myads->adtext); ?>
    </td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('Apply Now'); ?></td>
    <?php $link = URL_LINK_APPLY . (string)$myads->oid;?>
    <td><?php print l($link, $link, $options); ?></td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('Posting Period'); ?></td>
    <td><?php print format_date($start_date, 'custom_date') . ' -- ' . format_date($end_date, 'custom_date'); ?></td>
  </tr>
  <tr>
    <td class="table-label"><?php print t('URL Permalink'); ?></td>
    <?php $link = URL_PERMALINK . (string)$myads->oid; ?>
    <td><?php print l($link, $link, $options); ?></td>
  </tr>
  </tbody>
</table>