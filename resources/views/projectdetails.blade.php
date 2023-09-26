<style>
	@media (max-width: 767.98px) { .border-sm-start-none { border-left: none !important; } }
</style>
<x-app-layout title="Home">

    <div class="mb-4">
        <a href="#" class="btn btn-dark">
            {{ __('PROJECTS DETAILS') }}
        </a>
    </div>
	
	<div class="row">
	
            <div class="col-md-12 ">
				@forelse($totalProjects as $project)

              <div class="card shadow-0 border mb-4">
                <div class="card-body">
					  <div class="row">
						<div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
						  <div class="bg-image hover-zoom ripple rounded ripple-surface">
							<img src="{{ asset('storage/projectss/' . $project->image) }}"
							  class="w-100" />
							<a href="#!">
							  <div class="hover-overlay">
								<div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
							  </div>
							</a>
						  </div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-6">
							<h4 class="card-title">
								{{ __($project->name) }}
							</h4>
						  <div class="d-flex flex-row">
						  </div>
						  <div class="d-flex align-items-center mb-2">
							<span class="menu-icon tf-icons bx bx-user"></span>
							<p class="fw-bold mb-0 text-truncate lh-1">Client : <span class="fw-semi-bold text-primary ms-1">{{ $project->client}}</span></p>
						</div>
						<div class="d-flex align-items-center mb-4">
							<span class="menu-icon tf-icons bx bx-dollar"></span>
							<p class="fw-bold mb-0 lh-1">Budget : <span class="ms-1 text-1100 text-primary">{{ $project->budget}}  $</span></p>
						  </div>
						  @if($project->status_id == 'COMPLETED')
						  	<div class="d-flex justify-content-between text-700 fw-semi-bold">
						  <p class="mb-2"> COMPLETED</p>
						  <p class="mb-2 text-1100">100%</p>
						</div>
						
						<div class="progress bg-success-100">
						  <div class="progress-bar rounded bg-success" role="progressbar" aria-label="Success example" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						@elseif($project->status_id == 'IN_PROGRESS')
						<div class="d-flex justify-content-between text-700 fw-semi-bold">
							<p class="mb-2"> IN PROGRESS</p>
							<p class="mb-2 text-1100">67%</p>
						  </div>
						  
						  <div class="progress bg-warning-100">
							<div class="progress-bar rounded bg-warning" role="progressbar" aria-label="Success example" style="width: 67%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						  </div>
						  @elseif($project->status_id == 'PENDING')
						  <div class="d-flex justify-content-between text-700 fw-semi-bold">
							  <p class="mb-2"> PENDING</p>
							  <p class="mb-2 text-1100">10%</p>
							</div>
							
							<div class="progress bg-info-100">
							  <div class="progress-bar rounded bg-info" role="progressbar" aria-label="Success example" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							@elseif($project->status_id == 'REJECTED')
							<div class="d-flex justify-content-between text-700 fw-semi-bold">
								<p class="mb-2"> REJECTED</p>
								<p class="mb-2 text-1100">0%</p>
							  </div>
							  
							  <div class="progress bg-danger-100">
								<div class="progress-bar rounded bg-danger" role="progressbar" aria-label="Success example" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							  </div>
						  @endif
						<div class="d-flex align-items-center mt-4">
							<p class="mb-0 fw-bold fs--1">STARTED :<span class="fw-semi-bold text-600 text-primary ms-1">{{ $project->start_date}}</span></p>
						  </div>
						  <div class="d-flex align-items-center mt-2">
							<p class="mb-0 fw-bold fs--1">DEADLINE : <span class="fw-semi-bold text-600 text-primary ms-1">	{{ $project->end_date}}</span></p>
						  </div>
						  <div class="text-end"> 
							<span class="menu-icon tf-icons bx bx-task"></span>
							<p class="d-inline-block fw-bold mb-0 "><span class="text-primary">{{$project->tasks()->count(	)}}</span><span class="fw-bold ">	Task</span></p>
						  </div>
						
						<!-- will be end of for each  -->
					
						</div>
						<div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
							<div class="d-flex flex-row align-items-center mb-1">
							  <h4 class="mb-1 me-1">$13.99</h4>
							  <span class="text-danger"><s>$20.99</s></span>
							</div>
							<h6 class="text-success">Free shipping</h6>
							<div class="d-flex flex-column mt-4">
							  <button class="btn btn-primary btn-sm" type="button">Details</button>
							  <button class="btn btn-outline-primary btn-sm mt-2" type="button">
								Add to wishlist
							  </button>
							</div>
						  </div>
		
					  </div>
					</div>
				  </div>
			      @empty
                            <tr>
                                <td colspan="100%" class="text-center">
                                    {{ __('No data to display.') }}
                                </td>
                            </tr>
                            @endforelse

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