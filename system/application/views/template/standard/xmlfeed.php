<root>
  <kyero>
    <feed_version>3</feed_version>
  </kyero>
  <?php foreach ($properties as $property): ?>
<property>
  <id><?= $property['property_ref_no'] ?></id>
  <date>2013-09-27 12:00:10</date>
<ref>V3TEST</ref>
<price>250000</price>
<currency>EUR</currency>
<price_freq>sale</price_freq>
<part_ownership>0</part_ownership>
<leasehold>0</leasehold>
<new_build>0</new_build>
<type>villa</type>
<town>almunecar</town>
<province>granada</province>
<country>spain</country>
<location>
<latitude>36.728807</latitude>
<longitude>-3.693466</longitude>
</location>
<location_detail>optional location detail</location_detail>
<beds>3</beds>
<baths><?php $property['bathrooms'] ?></baths>
<pool>1</pool>
<surface_area>
<built>150</built>
<plot>500</plot>
</surface_area>
<energy_rating>
<consumption>D</consumption>
<emissions>X</emissions>
</energy_rating>
<url>
<en>http://english.website.com/property/123456.htm</en>
</url>

<catastral>1234567AB1234C0001DE</catastral>
<desc>
<en><?php $property['description'] ?></en>

</desc>
<features>

  
<feature>good rental potential</feature>
<feature>near beach</feature>
<feature>water possible</feature>
</features>
<notes>Private property notes</notes>
<images>
<image id="1">
<url>http://images.kyero.com/12811577_large.jpg</url>
</image>
<image id="2">
<tags>
<tag>floorplan</tag>
</tags>
<url>http://images.kyero.com/12811578_large.jpg</url>
</image>
<image id="3">
<url>http://images.kyero.com/12811579_large.jpg</url>
</image>
<image id="4">
<url>http://images.kyero.com/12811581_large.jpg</url>
</image>
<image id="50">
<url>http://images.kyero.com/12811582_large.jpg</url>
</image>
</images>
<prime>1</prime>
</property>
  <?php endforeach; ?>
  
  
  
  <?php foreach ($rentals as $rental): ?>
  <property>
    <id><?= $rental['property_ref_no']?></id>
  </property>
  
  <?php endforeach; ?>

</root>
