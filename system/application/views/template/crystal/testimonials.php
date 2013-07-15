<div class="span12 testimonials">
						<h3>Testimonials</h3>
					</div>
					<div class="span4">
						<p>
							It really matters to us that our clients are happy with the results we achieve and the services we provide.
							Our aim is to exceed their expectations and develop a close rapport and understanding of their requirements.
							We are proud to receive these recent emails and letters from clients
						</p>
					</div>
					<div class="span8">
						
						
						
						<div id="testimonial" class="flexslider">
							<ul id="cycle" class="slides testimonials">
								<?php foreach ($references as $row2): ?>
									<li>

										<p>
											<?= $row2['testimonial'] ?>
										</p>
										<h4><?= $row2['author'] ?></h4>
									</li>
									<?php endforeach; ?>
								
								
							</ul>
						</div>
						
						
						
						
						
						<!--testimonals-->
						
						<script type="text/javascript">
							$(document).ready(function() {
								$('#cycle').cycle({
									timeout: 14000
								});
							});
						</script>
					</div>