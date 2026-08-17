@extends('Dashboard.layouts.master2')
@section('title')
Login
@endsection
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('Dashboard/assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
<style>
    .loginform{
        display: none;
    }
</style>
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('Dashboard/assets/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
    <ul class="nav">
                <li class="">
                    <div class="dropdown  nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                           aria-expanded="false">


                @if (App::getLocale() == 'ar')
                    <span class="avatar country-Flag mr-0 align-self-center bg-transparent">
                        <img src="{{ asset('Dashboard/assets/img/flags/egypt_flag.jpg') }}"
                             alt="Arabic">
                    </span>
                @else
                    <span class="avatar country-Flag mr-0 align-self-center bg-transparent">
                        <img src="{{ asset('Dashboard/assets/img/flags/us_flag.jpg') }}"
                             alt="English">
                    </span>
                @endif

                <strong class="mr-2 ml-2 my-auto">
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                </strong>

            </a>

            <div class="dropdown-menu dropdown-menu-start">

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <a class="dropdown-item"
                       rel="alternate"
                       hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                        @if($localeCode == 'en')
                             <img src="{{ asset('Dashboard/assets/img/flags/us_flag.jpg') }}"
                             alt="English" height="17px">
                        @elseif($localeCode == 'ar')
                             <img src="{{ asset('Dashboard/assets/img/flags/egypt_flag.jpg') }}"
                             alt="Arabic" height="17px">
                        @endif

                        {{ $properties['native'] }}

                    </a>

                @endforeach

            </div>

        </div>
    </li>
</ul>
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/assets/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{ trans('Dashboard/login_trans.Welcome') }}</h2>
												<h5 class="font-weight-semibold mb-2 mt-2">{{ trans('Dashboard/login_trans.Please_Select') }}</h5>

                                                <select class="form-select" aria-label="Default select example" id="sectionChooser">
                                                  <option selected disabled>{{ trans('Dashboard/login_trans.Choose_list') }}</option>
                                                  <option value="user">{{ trans('Dashboard/login_trans.user') }}</option>
                                                  <option value="admin">{{ trans('Dashboard/login_trans.admin') }}</option>

                                                </select>
                                                      {{--form user--}}
                                            <div class="loginform" id="user">

                                                <form method="POST" action="{{ route('user.login') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>{{ trans('Dashboard/login_trans.Email') }}</label> <input  class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{ trans('Dashboard/login_trans.Password') }}</label> <input class="form-control" placeholder="Enter your password"   type="password"name="password" required autocomplete="current-password" >
                                                    </div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/login_trans.Sign In') }}</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i class="fab fa-facebook-f"></i> {{ trans('Dashboard/login_trans.Signup with Facebook') }}</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i class="fab fa-google"></i> {{ trans('Dashboard/login_trans.Signup with Google') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="">
                                                        {{ trans('Dashboard/login_trans.Forgot password') }}?</a></p>
                                                    <p>{{ trans('Dashboard/login_trans.Dont have an account') }}? <a href="{{ url('/' . $page='signup') }}">{{ trans('Dashboard/login_trans.Create an Account') }}</a></p>
                                                </div>
                                            </div>

                                            {{--form admin--}}
                                            <div class="loginform" id="admin">

                                                <form method="POST" action="{{ route('admin.login') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>{{ trans('Dashboard/login_trans.Email') }}</label> <input  class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{ trans('Dashboard/login_trans.Password') }}</label> <input class="form-control" placeholder="Enter your password"   type="password"name="password" required autocomplete="current-password" >
                                                    </div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/login_trans.Sign In') }}</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i class="fab fa-facebook-f"></i> {{ trans('Dashboard/login_trans.Signup with Facebook') }}</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> {{ trans('Dashboard/login_trans.Signup with Google') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="">{{ trans('Dashboard/login_trans.Forgot password') }}?</a></p>
                                                    <p>{{ trans('Dashboard/login_trans.Dont have an account')}}? <a href="{{ url('/' . $page='signup') }}">{{ trans('Dashboard/login_trans.Create an Account') }}</a></p>
                                                </div>
                                            </div>


											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
<script>
     $('#sectionChooser').change(function(){
            var myID = $(this).val();
            $('.loginform').each(function(){
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
</script>
<script type="text/javascript" src="{{ asset('Dashboard/assets/js/toastr.min.js') }}"></script>
        <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
         }
         @endif
        </script>

@endsection
