<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="main-nav">
					<!-- ***** Logo Start ***** -->
					<a href="/" class="logo">
						<img src="/cyborg/assets/images/logo.png" alt="">
					</a>
					<!-- ***** Logo End ***** -->

					<!-- ***** Search End ***** -->
					<!-- div class="search-input">
						<form id="search" action="#">
							<input type="text" placeholder="Type Something" id="searchText" name="searchKeyword" onkeypress="handle">
							<i class="fa fa-search"></i>
						</form>
					</div -->
					<!-- ***** Search End ***** -->

					<!-- ***** Menu Start ***** -->
					<ul class="nav">
						@foreach($otherLocales as $key => $locale)
						<li>
							<a href="" data-locale="{{ $key }}" onclick="return setLocale(this)">
								<i class="fa-solid fa-language"></i> {{ $locale }}
							</a>
						</li>
						@endforeach
						
						@guest
							<li><a href="/login">{{ __('Login') }}</a></li>
						@endguest
						@auth
							<li><a href="/logout">{{ __('Logout') }}</a></li>
							<li><a href="/profile">{{ __('Profile') }}</a></li>
							<li><a href="/dashboard">{{ __('Dashboard') }} <img src="/cyborg/assets/images/profile-header.jpg" alt=""></a></li>
						@endauth
					</ul>
					<a class="menu-trigger">
						<span>Menu</span>
					</a>
					<!-- ***** Menu End ***** -->
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- ***** Header Area End ***** -->