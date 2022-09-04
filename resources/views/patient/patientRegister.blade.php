@extends('layout.app')
@section('main')


		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
								
							<!-- Register Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Register">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Patient Register <a href="{{ route('d.register') }}">Are you a Doctor?</a></h3>
										</div>
										
										<!-- Register Form -->
										<form action="{{ route('p.register.create') }}" method="POST">
                                            @csrf
											@include('layout.validate')
											<div class="form-group form-focus">
												<input name="email" type="email" class="form-control floating">
												<label class="focus-label">email</label>
											</div>
											<div class="form-group form-focus">
												<input name="password" type="password" class="form-control floating">
												<label class="focus-label">Password</label>
											</div>
                                            <div class="form-group form-focus">
												<input name="password_confirmation" type="password" class="form-control floating">
												<label class="focus-label">Confirm Password</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="{{ route('login.page') }}">Already have an account?</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
											<div class="login-or">
												<span class="or-line"></span>
												<span class="span-or">or</span>
											</div>
											<div class="row form-row social-login">
												<div class="col-6">
													<a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>
												</div>
												<div class="col-6">
													<a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>
												</div>
											</div>
										</form>
										<!-- /Register Form -->
										
									</div>
								</div>
							</div>
							<!-- /Register Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
		   
		</div>
		<!-- /Main Wrapper -->
	  

@endsection