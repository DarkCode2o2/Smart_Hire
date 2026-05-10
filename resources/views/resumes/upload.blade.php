<x-app-layout>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto mt-12 p-6 bg-white rounded-3xl shadow-xl border border-slate-100" 
                x-data="resumeUploader()">
    
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-800">Upload Resumes</h2>
                    <p class="text-slate-500">Drag and drop one or more PDF files to analyze them with SmartHire AI.</p>
                </div>

                <!-- Loading State -->
                <div x-show="isUploading" x-cloak class="py-12 text-center">
                    <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-blue-600 border-t-transparent mb-4"></div>
                    <h3 class="text-xl font-bold text-slate-800">Processing <span x-text="files.length"></span> Files...</h3>
                    <p class="text-slate-500">Our AI is extracting data, please don't close the page.</p>
                </div>

                <!-- Upload Area -->
                <div x-show="!isUploading">
                    <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data" x-ref="uploadForm">
                        @csrf
                        <div 
                            @dragover.prevent="isDragging = true" 
                            @dragleave.prevent="isDragging = false" 
                            @drop.prevent="handleDrop($event)"
                            @click="$refs.fileInput.click()"
                            :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-blue-400'"
                            class="relative border-2 border-dashed rounded-2xl p-16 text-center cursor-pointer transition-all duration-300 group">
                            
                            <input type="file" name="resumes[]" x-ref="fileInput" class="hidden" accept=".pdf" multiple @change="handleFiles($event)">

                            <div class="space-y-4">
                                <div class="flex justify-center">
                                    <div class="p-4 bg-blue-50 rounded-full group-hover:bg-blue-100 transition-colors">
                                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-slate-700">Click to upload or drag and drop</p>
                                    <p class="text-sm text-slate-400 mt-1">PDF Resumes only (Max 5 files at once)</p>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Preview Selected Files -->
                    <template x-if="files.length > 0">
                        <div class="mt-6 space-y-3">
                            <p class="text-sm font-medium text-slate-600">Selected Files:</p>
                            <template x-for="(file, index) in files" :key="index">
                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100">
                                    <div class="flex items-center space-x-3">
                                        <span class="text-blue-600 text-xl font-bold">PDF</span>
                                        <span class="text-sm font-medium text-slate-700" x-text="file.name"></span>
                                        <span class="text-xs text-slate-400" x-text="Math.round(file.size / 1024) + ' KB'"></span>
                                    </div>
                                </div>
                            </template>
                            <button @click="submitFiles" class="w-full mt-4 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200">
                                Start Analysis
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
    function resumeUploader() {
        return {
            isDragging: false,
            isUploading: false,
            files: [],
            
            handleFiles(event) {
                this.files = Array.from(event.target.files);
            },
            
            handleDrop(event) {
                this.isDragging = false;
                const droppedFiles = Array.from(event.dataTransfer.files).filter(f => f.type === 'application/pdf');
                if(droppedFiles.length > 0) {
                    this.files = droppedFiles;
                    // إسناد الملفات للـ Input الحقيقي ليتم إرسالها مع الفورم
                    this.$refs.fileInput.files = event.dataTransfer.files;
                }
            },
            
            submitFiles() {
                if(this.files.length > 0) {
                    this.isUploading = true;
                    this.$refs.uploadForm.submit();
                }
            }
        }
    }

        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });

                @if($errors->has('resumes'))
                    Toast.fire({
                        icon: 'error',
                        title: "{{ $errors->first('resumes') }}"
                    });
                @endif

                @if($errors->has('resumes.*'))
                    {{-- نستخدم setTimeout بسيط لضمان ظهور التنبيهين بشكل مرتب إذا وجدا معاً --}}
                    setTimeout(() => {
                        Toast.fire({
                            icon: 'warning',
                            title: "{{ $errors->first('resumes.*') }}"
                        });
                    }, 500);
                @endif
            @endif
        });
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
        
</x-app-layout>
