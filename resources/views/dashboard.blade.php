<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Top 5 ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('dashboard') }}" method="GET" class="flex gap-4 mb-6">
 
                <label class="input input-primary w-full">
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
                        type="search" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search by name or skill [php,react...]."  />
                </label>
                <select name="min_score" class="select select-primary">
                    <option value="0" @php echo request('min_score') == '0' ? 'selected' : '' @endphp>All Scores</option>
                    <option value="85" @php echo request('min_score') == '85' ? 'selected' : '' @endphp>Above 85%</option>
                    <option value="65" @php echo request('min_score') == '65' ? 'selected' : '' @endphp>Above 65%</option>
                    <option value="50" @php echo request('min_score') == '50' ? 'selected' : '' @endphp>Above 50%</option>
                    <option value="30" @php echo request('min_score') == '30' ? 'selected' : '' @endphp>Above 30%</option>
                </select>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Filter</button>

            </form>
           <div class="overflow-x-auto">
            @if (!$resumes->isEmpty())
                <h1 class="mb-5 text-3xl">Top 5 Ranked Candidates</h1>
                <table class="table bg-gray-200 shadow-md rounded">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Job Title</th>
                        <th>Experience Years</th>
                        <th>Points</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($resumes as $resume)
                            <tr class="hover:bg-gray-100">
                                <th>{{$loop->iteration}}</th>
                                <th>{{$resume['full_name']}}</th>
                                <td>{{$resume['email']}}</td>
                                <td>{{$resume['job_title']}}</td>
                                <td>{{$resume['experience']}} Years</td>
                                <td>
                                    @php
                                       $colors = [
                                            'green' => 'bg-green-100 text-green-700 border-green-200',
                                            'amber' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            'red' => 'bg-red-100 text-red-700 border-red-200',
                                        ];

                                        $key = array_rand($colors);
                                    @endphp
                                    
                                    @if ($resume['point'] >= 70)
                                        <span class="badge badge-success inline-block font-semibold">{{$resume['point']}}<span>
                                    @elseif($resume['point'] >= 40)
                                        <span class="badge badge-warning inline-block font-semibold">{{$resume['point']}}<span>
                                    @else
                                        <span class="badge badge-error inline-block font-semibold">{{$resume['point']}}<span> 
                                    @endif
                                </td>
                                <td class="m-1">
                                    <a class="btn btn-accent btn-outline p-2 text-blue-500 hover:text-white text-xs rounded border border-blue-500 hover:bg-blue-600"
                                     href="{{ route('resume_show', $resume->id) }}">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h2 class=" text-center text-2xl mt-5 mb-3">No resumes analyzed yet. Upload your first one <a class="btn bg-sky-400 text-white rounded border border-sky-400" href="{{ route('resume_upload') }}">Upload</a></h2>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
