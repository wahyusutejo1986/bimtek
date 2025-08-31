<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-upload text-blue-600 mr-2"></i>
            {{ __('File Manager') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Document Upload Center
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Upload and manage your files and documents.
                            </p>
                        </div>
                        <div class="text-blue-600">
                            <i class="fas fa-cloud-upload-alt text-3xl"></i>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Upload Form -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-file-upload text-blue-500 mr-2"></i>
                                Upload New File
                            </h4>
                            
                            <form action="{{ route('services.upload.handle') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                        Select File
                                    </label>
                                    <input type="file" 
                                           id="file" 
                                           name="file" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                           required>
                                </div>
                                
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                    <i class="fas fa-upload mr-2"></i>
                                    Upload File
                                </button>
                            </form>
                        </div>

                        <!-- Upload Information -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-info-circle text-green-500 mr-2"></i>
                                Upload Guidelines
                            </h4>
                            
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Supported Formats</p>
                                        <p class="text-xs text-gray-600">All file types are supported</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">File Size</p>
                                        <p class="text-xs text-gray-600">Maximum upload size depends on server configuration</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Processing</p>
                                        <p class="text-xs text-gray-600">Files are processed automatically after upload</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Storage</p>
                                        <p class="text-xs text-gray-600">Files are stored securely on our servers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- File Management Actions -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">
                            <i class="fas fa-folder-open text-purple-500 mr-2"></i>
                            File Management
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-medium text-gray-900 mb-2">Recent Uploads</h5>
                                <p class="text-sm text-gray-600 mb-3">View your recently uploaded files</p>
                                <button class="text-blue-600 hover:text-blue-900 text-sm">
                                    View Files →
                                </button>
                            </div>
                            
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-medium text-gray-900 mb-2">File Browser</h5>
                                <p class="text-sm text-gray-600 mb-3">Browse all uploaded documents</p>
                                <button class="text-blue-600 hover:text-blue-900 text-sm">
                                    Browse →
                                </button>
                            </div>
                            
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-medium text-gray-900 mb-2">Storage Info</h5>
                                <p class="text-sm text-gray-600 mb-3">Check your storage usage</p>
                                <button class="text-blue-600 hover:text-blue-900 text-sm">
                                    View Stats →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
