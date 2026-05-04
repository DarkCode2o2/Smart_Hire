<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
    
    <!-- Header: Name & Job Title -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $resume->full_name }}</h1>
            <p class="text-xl text-indigo-600 font-medium">{{ $resume->job_title }}</p>
            <p class="text-gray-500">{{ $resume->email }} | {{ $resume->experience }} Years Experience</p>
        </div>
        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">← Back to Dashboard</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Left Column: Score & Skills -->
        <div class="space-y-6">
            <!-- Score Card -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Overall Match Score</h3>
                <div class="relative inline-flex items-center justify-center">
                    <!-- Progress Circle (SVG) -->
                    <svg class="w-32 h-32 transform -rotate-90">
                        <circle class="text-gray-200" stroke-width="8" stroke="currentColor" fill="transparent" r="58" cx="64" cy="64"/>
        
                        <circle class="text-indigo-600" 
                            stroke-width="8" 
                            stroke-dasharray="{{ $resume->point > 0 ? ($resume->point / 100) * 364.4 : '0' }} 364.4" 
                            stroke-linecap="round" 
                            stroke="currentColor" 
                            fill="transparent" 
                            r="58" cx="64" cy="64"/>
                    </svg>
                    <span class="absolute text-3xl font-bold text-gray-800">{{ $resume->point }}%</span>
                </div>
            </div>

            <!-- Skills Cloud Card -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Technical Skills</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(json_decode($resume->skills) as $skill)
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium border border-indigo-100">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column: AI Summary -->
        <div class="md:col-span-2">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 h-full">
                <div class="flex items-center mb-4 text-indigo-600">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    <h3 class="text-lg font-bold">Smart AI Summary</h3>
                </div>
                <p class="text-gray-700 leading-relaxed text-lg italic">
                    "{{ $resume->ai_summary }}"
                </p>
                
                <div class="mt-8 pt-8 border-t border-gray-50">
                    <h4 class="text-sm font-bold text-gray-400 uppercase mb-4">Recommendation</h4>
                    <p class="text-sm text-gray-600">
                        Based on the analysis, this candidate shows 
                        <span class="font-bold text-indigo-600">
                            @if($resume->point >= 70) High Potential @elseif($resume->point >= 40) Moderate Fit @else Low Match @endif
                        </span> 
                        for technical roles.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
