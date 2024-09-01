<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Project List
            </h2>
            <button onclick="openaddModal()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                Add new
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Table of projects -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-800">
                            @foreach($projects as $project)
                                <tr id="project_{{ $project->id}}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-900">
                                        {{ $project->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                        {{ $project->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                        {{ $project->status }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    <!-- View Icon -->
                                    <a href="{{ route('tasks', ['project_id' => $project->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-list"></i>
                                        <span class="sr-only">View</span>
                                    </a>

                                    <!-- Edit Icon -->
                                    <a href="javascript:void(0)" onclick="openEditModal({{ $project->id }})" class="text-blue-600 hover:text-blue-900 ml-4 edit-project-btn">
                                        <i class="fas fa-edit"></i>
                                        <span class="sr-only">Edit</span>
                                    </a>

                                    <!-- Updated Delete Button -->
                                    <button type="button" onclick="openDeleteModal({{ $project->id }})" class="text-red-600 hover:text-red-900 ml-4">
                                        <i class="fas fa-trash"></i>
                                        <span class="sr-only">Delete</span>
                                    </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                   <!-- Pagination controls -->
                   @if($pagination)
                        <div class="mt-4">
                            <nav class="flex items-center justify-between" aria-label="Pagination">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    <a href="{{ $pagination['current_page'] > 1 ? route('dashboard', ['page' => $pagination['current_page'] - 1, 'per_page' => $pagination['per_page']]) : '#' }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        Previous
                                    </a>
                                    <a href="{{ $pagination['current_page'] < $pagination['last_page'] ? route('dashboard', ['page' => $pagination['current_page'] + 1, 'per_page' => $pagination['per_page']]) : '#' }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        Next
                                    </a>
                                </div>
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700 dark:text-gray-400">
                                            Showing <span class="font-medium">{{ $pagination['current_page'] }}</span> / <span class="font-medium">{{ $pagination['last_page'] }}</span>
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        <form action="{{ route('dashboard') }}" method="GET" class="mr-4">
                                            <label for="per_page" class="sr-only">Items per page</label>
                                            <select id="per_page" name="per_page" class="form-select block w-full text-black bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" onchange="this.form.submit()">
                                                <option value="25" >Per page</option>    
                                                <option value="5" {{ $pagination['per_page'] == 5 ? 'selected' : '' }}>5</option>
                                                <option value="10" {{ $pagination['per_page'] == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ $pagination['per_page'] == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ $pagination['per_page'] == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ $pagination['per_page'] == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </form>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                            <a href="{{ $pagination['current_page'] > 1 ? route('dashboard', ['page' => $pagination['current_page'] - 1, 'per_page' => $pagination['per_page']]) : '#' }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                Previous
                                            </a>
                                            @for($i = 1; $i <= $pagination['last_page']; $i++)
                                                <a href="{{ route('dashboard', ['page' => $i, 'per_page' => $pagination['per_page']]) }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium {{ $i == $pagination['current_page'] ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                                    {{ $i }}
                                                </a>
                                            @endfor
                                            <a href="{{ $pagination['current_page'] < $pagination['last_page'] ? route('dashboard', ['page' => $pagination['current_page'] + 1, 'per_page' => $pagination['per_page']]) : '#' }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                Next
                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <x-viewproject />
    <x-confirm message="Projects" />
    <x-notification />
    <x-addproject />

</x-app-layout>

