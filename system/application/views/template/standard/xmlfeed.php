<root>
  <kyero>
    <feed_version>3</feed_version>
  </kyero>
  <?php foreach ($properties as $property): ?>
<property>
  <id><?= $property['property_ref_no'] ?></id>
</property>
  <?php endforeach; ?>
  
  
  
  <?php foreach ($rentals as $rental): ?>
  <property>
    <id><?= $rental['property_ref_no']?></id>
  </property>
  
  <?php endforeach; ?>

</root>
