@extends('layouts.layout')

@section('body_content')
<section>
	<div class="container">
		<div class="row">
			

		<?php /* @include('layouts/leftbar', ['test'=>'testy', 'categories'=>$categories]) */?>

		@include('layouts.leftbar')

		
			<div class="col-sm-9 padding-right">
				<div class="table-responsive">
					<form method="post" action="/cart/update">
					    <table class="table table-striped jambo_table bulk_action">
					        <thead>
					            <tr class="headings">
					                <th>
					                    <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="check-all" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
					                </th>
					                <th class="column-title">S.N </th>
					                <th class="column-title">Title </th>
					                <th class="column-title">Price </th>
					                <th class="column-title">Quantity </th>
					                <th class="column-title">Sub Total </th>
					                <th class="column-title no-link last"><span class="nobr">Action</span>
					                </th>
					                <th class="bulk-actions" colspan="7">
					                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
					                </th>
					            </tr>
					        </thead>

					        <tbody>
					        	@if($items)
					            @foreach($items as $row)
					                <tr class="even pointer">
					                    <td class="a-center ">
					                        <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
					                    </td>
					                    <td class=" ">{{ $row[0]['id'] }}</td>
					                    <td class=" ">{{ $row[0]['title'] }} </td>
					                    <td class=" ">{{ $row[0]['price'] }}</td>
					                    <td class=" "><input type="number" name="qty[{{ $row[0]['id'] }}]" value="{{ $row[0]['qty'] }}"></td>
					                    <td class=" ">{{ $row[0]['subtotal'] }} </td>
					                    <td class=" last">	
					                    	<a href="/cart/remove/{{ $row[0]['id'] }}"><input type="button" class="btn btn-danger" value="DELETE"></a>
					                    </td>
					                </tr>
					            @endforeach
					            <tr>
					            	<th colspan="6">
					            		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					            		<input type="submit" class="btn btn-primary" value="Update">
					            	</th>
					            	<th colspan="2">
					            		<label>Total :
					            			<?php 
					            				$total = 0;
					            				foreach($items as $row)
					            				{
					            					$total = $total + $row[0]['subtotal']; 
					            				}
					            				echo $total;
					            			?>
					            		</label>
					            	</th>
					            </tr>
					            @endif
					        </tbody>
					    </table>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
                    
@endsection
