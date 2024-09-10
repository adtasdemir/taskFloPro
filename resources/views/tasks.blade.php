<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight border-r border-white p-2 hover:text-blue-500">
                        Dashboard
                    </h2>
                </a>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Task List
                </h2>
            </div>
            <div>
                <button onclick="openaddModal()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                    Add new
                </button>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Table of tasks -->
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
                            @foreach($tasks as $task)
                                <tr id="task_{{ $task->id}}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-900">
                                        {{ $task->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                        {{ $task->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                        {{ $task->status }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    <!-- Edit Icon -->
                                    <a href="javascript:void(0)" onclick="openEditModal({{ $task->id }})" class="text-blue-600 hover:text-blue-900 ml-4 edit-task-btn">
                                        <i class="fas fa-edit"></i>
                                        <span class="sr-only">Edit</span>
                                    </a>

                                    <!-- Updated Delete Button -->
                                    <button type="button" onclick="openDeleteModal({{ $task->id }})" class="text-red-600 hover:text-red-900 ml-4">
                                        <i class="fas fa-trash"></i>
                                        <span class="sr-only">Delete</span>
                                    </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                 <!-- Pagination controls -->
                 <br>
                   {{ $tasks->links('pagination::tailwind') }}

                </div>
            </div>
        </div>
    </div>
    
    <x-viewtask  />
    <x-confirm message="Tasks" />
    <x-notification />
    <x-addtask message="{{$project_id}}" />
</x-app-layout>

