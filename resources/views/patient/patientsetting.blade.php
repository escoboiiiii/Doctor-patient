@extends('layout.app')
@section('main')
    		<!-- Main Wrapper -->
		<div class="main-wrapper">
		

			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
					
						<!-- Profile Sidebar -->
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
							@include('layout.patientmenu')
						</div>
						<!-- /Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									
									<!-- Profile Settings Form -->
									<form action="{{ route('p.setting.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('layout.validate')
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="{{ url('storage/photos' , $data -> photo) }}" alt="User Image">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input name="new_photo" type="file" class="upload">
																<input name="old_photo" type="hidden" value="{{ $data -> photo }}" class="upload">
															</div>
															<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input name="f_name" type="text" class="form-control" value="{{ $data -> f_name }}">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input name="l_name" type="text" class="form-control" value="{{ $data -> l_name }}">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Date of Birth</label>
													<div class="cal-icon">
														<input name="date_of_birth" type="text" class="form-control datetimepicker" value="{{ $data -> date_of_birth }}">
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Blood Group</label>
													<select name="blood" class="form-control select">
														<option @if($data -> blood == 'A-') selected @endif value="A-">A-</option>
														<option @if($data -> blood == 'A+') selected @endif value="A+">A+</option>
														<option @if($data -> blood == 'B-') selected @endif  value="B-">B-</option>
														<option @if($data -> blood == 'B+') selected @endif  value="B+">B+</option>
														<option @if($data -> blood == 'AB-') selected @endif  value="AB-">AB-</option>
														<option @if($data -> blood == 'AB+') selected @endif  value="AB+">AB+</option>
														<option @if($data -> blood == 'O-') selected @endif  value="O-">O-</option>
														<option @if($data -> blood == 'O+') selected @endif  value="O+">O+</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Email ID</label>
													<input name="email" type="email" class="form-control" value="{{ $data -> email }}">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input name="cell" type="text" value="{{ $data -> cell }}" class="form-control">
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
												<label>Address</label>
													<input name="address" ype="text" class="form-control" value="{{ $data -> address }}">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input name="city" type="text" class="form-control" value="{{ $data -> city }}">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>State</label>
													<input name="state" type="text" class="form-control" value="{{ $data -> state }}">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Zip Code</label>
													<input name="zip" type="text" class="form-control" value="{{ $data -> zip }}">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Country</label>
													<input name="country" type="text" class="form-control" value="{{ $data -> country }}">
												</div>
											</div>
										</div>
										<div class="submit-section">
											<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Profile Settings Form -->
									
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>		
			<!-- /Page Content -->
   
		   
		</div>
		<!-- /Main Wrapper -->
	  
@endsection

		