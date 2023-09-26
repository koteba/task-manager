<style>
	@media (max-width: 767.98px) { .border-sm-start-none { border-left: none !important; } }
</style>
<x-app-layout title="Home">
	<div class="row">
		<div class="col-lg-8 mb-4">
			<div class="card m-2">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h3 class="card-title text-primary">
								{{ __('Total ' . user()->name . ' ') }}
							</h3>
							<h4 class="mb-4">
								{{-- {{ __('You have done ') }} --}}
							
								{{ __(' The number of active users in the application is.') }}
								<span class="fw-bold">
									{{$totalUsers }}
								</span>
							</h4>

							<a href="{{ route('users.index')}}" class="btn btn-sm btn-outline-primary">
								{{ __('View Users') }}
							</a>
						</div>
					</div>
					
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
						</div>
					</div>
				</div>
			</div>
			<div class="card m-2">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h3 class="card-title text-primary">
								{{ __('Completed Project '  . ' ') }}
							</h3>
							<h4 class="mb-4">
								{{-- {{ __('You have done ') }} --}}
							
								{{ __(' The number of completed projects in the application is.') }}
								<span class="fw-bold">
									{{$totalCompletedProjects }}
								</span>
							</h4>

							<a href="{{ route('projects.index')}}" class="btn btn-sm btn-outline-primary">
								{{ __('View Projects') }}
							</a>
						</div>
					</div>
					
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="{{ asset('assets/img/illustrations/complet.jpg') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
						</div>
					</div>
				</div>
			</div>
			<div class="card m-2">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h3 class="card-title text-primary">
								{{ __('Active Project '  . ' ') }}
							</h3>
							<h4 class="mb-4">
								{{-- {{ __('You have done ') }} --}}
							
								{{ __(' The number of Active projects in the application is.') }}
								<span class="fw-bold">
									{{$totalProjects }}
								</span>
							</h4>

							<a href="{{ route('projects.index')}}" class="btn btn-sm btn-outline-primary">
								{{ __('View Projects') }}
							</a>
						</div>
					</div>
					
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="{{ asset('assets/img/illustrations/projecrs.jpg') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
						</div>
					</div>
				</div>
			</div>
		</div>
			 
	{{-- <div class="col-lg-8 mb-4">
		<div class="card m-2">
			<h5 class="card-title text-primary">
				{{ __('Total Users ' . ' ') }}
			</h5>
			<p class="fs-30 mb-2" style="font-size: 24px; font-weight: bold;">{{ $totalUsers }}</p>
			<p style="font-size: 14px;">22.00% (30 days)</p>
		</div>

		<div class="card m-2">
			<p class="mb-2" style="font-size: 18px; font-weight: bold;">Total Projects</p>
			<p class="fs-30 mb-2" style="font-size: 24px; font-weight: bold;">{{$totalProjects}}</p>
			<p style="font-size: 14px;">22.00% (30 days)</p>
		</div>
		
	<div class="card m-2">
		<p class="mb-2" style="font-size: 18px; font-weight: bold;">Comoleted Projects</p>
		<p class="fs-30 mb-2" style="font-size: 24px; font-weight: bold;">{{$totalCompletedProjects}}</p>
		<p style="font-size: 14px;">22.00% (30 days)</p>
	</div> --}}
</div>


	
</x-app-layout>