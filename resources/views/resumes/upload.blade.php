<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    @session('success')
                        <p class="text-green-400 font-semibold my-4">{{$value}}</p>
                    @endsession
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="fieldset">
                        <legend class="fieldset-legend">Pick a Resume</legend>
                        <input type="file" name="resumes[]" class="file-input" accept=".pdf" multiple/>
                        <label class="label">Max size 4MB</label>
                        </fieldset>

                        @if ($errors->has('resumes.*'))
                            <div class="mt-2">
                                @foreach ($errors->get('resumes.*') as $messages)
                                    @foreach ($messages as $message)
                                        <p class="text-sm text-red-500">{{ $message }}</p>
                                    @endforeach
                                    @break
                                @endforeach
                            </div>
                        @endif
                        @error('resumes')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <input type="submit" value="Submit" class="btn block mt-2 bg-blue-500 text-white">
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
