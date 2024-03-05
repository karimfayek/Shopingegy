<nav id="main-navigation">
	<ul id="menu-main-menu" class="menu">
		<li class="level-0 menu-item {{  Route::currentRouteName() == 'home.show' ? 'current-menu-item' : ''  }} ">
			<a href="/{{ $local }}"><span class="menu-item-text">{{ $heading['home'] }}</span></a>
			
		</li>
		@foreach($top_menu as $page)
		<li class="level-0 menu-item {{  Route::currentRouteName() == 'page.show' ? 'current-menu-item' : ''  }} ">
			<a href="/page/{{$page->slug}}/{{ $local }}"><span class="menu-item-text">{{$page->LocalName}}</span></a>
			
		</li>
		@endforeach
		<li class="level-0 menu-item menu-item-has-children {{  Route::currentRouteName() == 'category.show' ? 'current-menu-item' : ''  }} ">
			<a href="#"><span class="menu-item-text">{{ $heading['products'] }}</span></a>
			<ul class="sub-menu">
				@foreach ($categories as $category)
				@foreach ($category->items as $cat)
				<li @if ($cat->items->count() > 0) class="level-1 menu-item menu-item-has-children" @endif>
					<a href="/category/{{ $cat->slug }}/{{ $local }}"><span class="menu-item-text">{{ $cat->LocalName}}</span></a>
					@if ($cat->items->count() > 0)
						<ul class="sub-menu">
							@foreach ($cat->items as $catItem)
								<li>
									<a href="/category/{{ $catItem->slug }}/{{ $local }}"><span class="menu-item-text">{{ $catItem->LocalName }}</span></a>
								</li>
							@endforeach
						</ul>
					@endif
				</li>
				@endforeach
				@endforeach
				
				
			</ul>
		</li>
		
		
		<li class="level-0 menu-item {{  Route::currentRouteName() == 'contact.show' ? 'current-menu-item' : ''  }}">
			<a href="/contact/{{ $local }}"><span class="menu-item-text">{{ $heading['contact'] }}</span></a>
		</li>

		
		<li class="level-0 menu-item">
			@if ($local == "en")
			<a href="ar"><span class="menu-item-text"><i class="fa fa-globe mr-2"></i>ع</span></a>
			@else
			<a href="en"><span class="menu-item-text">English</span></a>
			@endif
			
		</li>
	</ul>
</nav>
		
	