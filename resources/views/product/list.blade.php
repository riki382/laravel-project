@extends('layouts.layout')

@section('body_content')

	@include('layouts.slider')
		<div class="container">
			<div class="row">
				@include('layouts/leftbar')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">All Products</h2>
						@foreach($products as $p)
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img width="200" height="250" src="{{ $p->image }}" alt="" />
											<h2>343</h2>
											<p>{{ $p->title }}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
						
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>

@endsection
