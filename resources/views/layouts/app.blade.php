<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Style --}}
    @include('layouts.head')
    <style>
        .main-container{
            margin-left: 30px;
            margin-right: 30px;
        }
    </style>
</head>
<body class="">
    {{-- Header --}}
    @include('layouts.header')

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>@yield('page', 'SppPay')</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                    @yield('breadcumb')
								</ol>
							</nav>
                        </div>
                        <div class="col-md-6 col-sm-12">
							<div class="title pull-right">
								@yield('right-header')
							</div>
							</nav>
						</div>
					</div>
                </div>
                {{-- content --}}
                @yield('content')
			</div>
        
            {{-- Footer --}}
            @include('layouts.footer')
            
		</div>
	</div>
    {{-- Script --}}
    @include('layouts.script')

    
    <script type="text/javascript">
   function toggleFullScreen() {
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {  
      document.documentElement.requestFullScreen();  
    } else if (document.documentElement.mozRequestFullScreen) {  
      document.documentElement.mozRequestFullScreen();  
    } else if (document.documentElement.webkitRequestFullScreen) {  
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
    }  
  } else {  
    if (document.cancelFullScreen) {  
      document.cancelFullScreen();  
    } else if (document.mozCancelFullScreen) {  
      document.mozCancelFullScreen();  
    } else if (document.webkitCancelFullScreen) {  
      document.webkitCancelFullScreen();  
    }  
  }  
}
</script> 
</body>
</html>
