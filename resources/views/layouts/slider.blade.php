<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php 
								$count = 0;
								foreach($sliders as $slider){
									$count = $count + 1;
									if($count == 1){ ?>
										<li data-target="#slider-carousel" data-slide-to="$count" class="active"></li>
									<?php } else { ?>
										<li data-target="#slider-carousel" data-slide-to="$count"></li>
									<?php }
								}
							?>
						</ol>
						
						<div class="carousel-inner">
							<?php 
								$count = 0;
								foreach($sliders as $slider){
									$count = $count + 1;
									if($count == 1) {
							?>
										<div class="item active">
								<?php } else { ?>
										<div class="item">
								<?php } ?>


								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>{{ $slider->title }}</h2>
									<p>{{ $slider->caption }} </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ $slider->image }}" class="girl img-responsive" alt="" />
									<img src="/front/images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							<?php } ?>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->