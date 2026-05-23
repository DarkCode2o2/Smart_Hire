<x-app-layout>
    <div class="py-12">
        @if($count > 0)
            <div class="max-w-7xl mx-auto sm:px-6 px-4 lg:px-8">
                <form action="{{ route('resume.index') }}" method="GET" class="flex sm:flex-row flex-col gap-4 mb-6" x-data="{}" 
                    @keydown.window.meta.k.prevent="$refs.searchInput.focus()"
                    @keydown.window.ctrl.k.prevent="$refs.searchInput.focus()">
                    
                    <label class="input input-primary w-full cursor-pointer border-none shadow" >
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="currentColor"
                            >
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input  
                    class="cursor-pointer"
                    x-ref="searchInput"
                    
                    type="search" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by name or skill [php,react...]."  />
                    <kbd class="kbd sm:inline-block hidden">ctrl</kbd>
                    <span class="sm:inline-block hidden">+</span>
                    <kbd class="kbd sm:inline-block hidden">K</kbd>
                    </label>
                    <select name="min_score" class="select select-primary border-none sm:w-fit w-full">
                        <option value="0" @php echo request('min_score') == '0' ? 'selected' : '' @endphp>All Scores</option>
                        <option value="85" @php echo request('min_score') == '85' ? 'selected' : '' @endphp>Above 85%</option>
                        <option value="65" @php echo request('min_score') == '65' ? 'selected' : '' @endphp>Above 65%</option>
                        <option value="50" @php echo request('min_score') == '50' ? 'selected' : '' @endphp>Above 50%</option>
                        <option value="30" @php echo request('min_score') == '30' ? 'selected' : '' @endphp>Above 30%</option>
                    </select>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg cursor-pointer">Filter</button>
                </form>
                <hr class="w-full py-2 text-gray-300">
                <div class="overflow-x-auto">
                    <div class="flex justify-between items-center">
                        <h1 class="mb-5 sm:text-3xl text-xl">All Ranked Candidates</h1>
                        <span class="badge badge-soft badge-primary font-semibold shadow-sm"><b>{{$count}}</b> Resumes</span>
                    </div>
                    <table class="table bg-gray-200 shadow-md rounded">
                        @if (!$summaries->isEmpty())
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Job Title</th>
                                    <th>Experience Years</th>
                                    <th>Points</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($summaries as $summary)
                                    <tr class="hover:bg-gray-100">
                                        <th>{{$loop->iteration}}</th>
                                        <th>{{$summary['full_name']}}</th>
                                        <td>{{$summary['email']}}</td>
                                        <td>{{$summary['job_title']}}</td>
                                        <td>{{$summary['experience']}} Years</td>
                                        <td>
                                            @php
                                            $colors = [
                                                    'green' => 'bg-green-100 text-green-700 border-green-200',
                                                    'amber' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                    'red' => 'bg-red-100 text-red-700 border-red-200',
                                                ];

                                                $key = array_rand($colors);
                                            @endphp
                                            
                                            @if ($summary['point'] >= 70)
                                                <span class="badge badge-success inline-block font-semibold">{{$summary['point']}}<span>
                                            @elseif($summary['point'] >= 40)
                                                <span class="badge badge-warning inline-block font-semibold">{{$summary['point']}}<span>
                                            @else
                                                <span class="badge badge-error inline-block font-semibold">{{$summary['point']}}<span> 
                                            @endif
                                        </td>
                                        <td>
                                            @if ($summary['status'] == 'accepted')
                                                <span class="badge badge-soft badge-success"><i class="fa-solid fa-circle-check"></i> Accepted</span>
                                            @elseif($summary['status'] == 'pending')
                                                <span class="badge badge-soft badge-warning"><i class="fa-solid fa-arrows-rotate"></i> Pending</span>
                                            @else
                                                <span class="badge badge-soft badge-error"><i class="fa-solid fa-circle-xmark"></i> Rejected</span>
                                            @endif
                                        </td>
                                        <td class="m-1">
                                            <button class="btn bg-gray-200 font-semibold text-lg" popovertarget="action-{{ $summary->id }}" style="anchor-name:--anchor-{{ $summary->id }}">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown menu min-w-[150px] rounded-box bg-base-100 shadow-sm"
                                                popover id="action-{{ $summary->id }}" style="position-anchor:--anchor-{{ $summary->id }}">
                                                <li >
                                                    <a class="p-2"  href="{{ route('resume.show', $summary->id) }}"><i class="fa-solid fa-eye text-sky-400"></i> View</a>
                                                </li>
                                                @if($summary['status'] != 'accepted') 
                                                    <li>
                                                        <form action="{{ route('resume.updateStatus', $summary->id) }}" method="post" class="text-left p-2 rounded">
                                                            @csrf
                                                            <input type="hidden" name="status" value="accepted">
                                                            <button type="submit" class="cursor-pointer">
                                                                <i class="fa-solid fa-circle-check text-green-400"></i> Accepted
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                                @if($summary['status'] != 'rejected') 
                                                    <li>
                                                        <form action="{{ route('resume.updateStatus', $summary->id) }}" method="post" class="text-left p-2 rounded">
                                                            @csrf
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="cursor-pointer">
                                                                <i class="fa-solid fa-circle-xmark text-red-400  p-0"></i> Rejected
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                                <li>
                                                    <form id="delete-form-{{ $summary->resume_file_id }}" action="{{ route('resume.destroy', $summary->resume_file_id) }}" method="post" class="text-left rounded p-0 m-0">
                                                        @csrf
                                                        @method("delete")
                                                    </form>
                                                    <button type="button" class="p-2 cursor-pointer w-full" onclick="confirmDelete({{ $summary->resume_file_id }})">
                                                        <i class="fa-regular fa-trash-can text-red-500"></i> Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        @elseif($summaries->isEmpty() && request('search') || request('min_score'))
                            <div class="flex justify-center items-center flex-col">
                                    <h2 class="mb-4 sm:text-3xl text-xl text-center">No candidates found matching your criteria</h2>
                                <a href="{{ route('resume.index') }}" class="btn btn-primary text-lg">Show All</a>
                            </div>
                        @endif
                    </table>
                </div>
                <div class="sm:mt-0 mt-4">
                    {{ $summaries->links() }}
                </div>
            </div>    
        @else
            <div class="flex justify-center items-center flex-col">
                <h2 class=" text-center text-4xl text-slate-700 font-bold mt-5 mb-3 capitalize">Ready to find your next star candidate?</h2>
                <p class="text-sm text-slate-400 font-bold max-w-lg text-center">
                    Upload resumes in PDF format and let Gemini AI do the heavy lifting of ranking and scoring for you.
                </p>
                    <a href="{{ route('resume.upload') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-5 mt-8 rounded-2xl font-bold text-lg transition-all transform hover:-translate-y-1 blue-shadow">
                    Upload Your First Resume
                </a>
            </div>
        @endif
</div>
</x-app-layout>