<ul class="previous_next">
	
	<!-- PREVIOUS BUTTON -->
	@if(isset($previous->id))
		<li class=""><a href="{{ url($previous->slug) }}" class="previous"><i class="fa fa-angle-left"></i></a></li>
	@endif
	
	<!-- NEXT BUTTON -->
	@if(isset($next->id))
		<li class=""><a href="{{ url($next->slug) }}" class="next"><i class="fa fa-angle-right"></i></a></li>
	@endif

</ul>