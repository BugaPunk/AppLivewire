<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-4 p-4">
        <x-button wire:click="showPostModal">Crear Post</x-button>
    </div>
    <div class="m-4 p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">ID</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Titulo</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Imagen</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Editar</th>
                    </tr>
                </thead>
    
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    
                    @foreach ($posts as $post)
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white text-center">
                            {{ $post ->  id }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                            {{ $post ->  title }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 flex justify-center">
                            <img class="w-8 h-8 rounded-full" src="{{Storage::url($post -> image)}}" alt="Imagen de {{ $post ->  title }}" />
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                            <div class="flex justify-center space-x-5">
                                <x-secondary-button wire:click="showEditPostModal({{ $post -> id }})">
                                    Editar
                                </x-secondary-button>
                                <x-danger-button class="horver:bg-rose-800" wire:click="deletePost({{ $post -> id }})">
                                    Eliminar
                                </x-danger-button>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2 dark:border-gray-700">
                <ol class="flex justify-end gap-1 text-xs font-medium">
                    <li>
                        <a href="#"
                            class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180 dark:border-gray-800 dark:bg-gray-900 dark:text-white">
                            <span class="sr-only">Prev Page</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
            
                    <li>
                        <a href="#"
                            class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900 dark:border-gray-800 dark:bg-gray-900 dark:text-white">
                            1
                        </a>
                    </li>
            
                    <li class="block size-8 rounded border-blue-600 bg-blue-600 text-center leading-8 dark:text-white">
                        2
                    </li>
            
                    <li>
                        <a href="#"
                            class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900 dark:border-gray-800 dark:bg-gray-900 dark:text-white">
                            3
                        </a>
                    </li>
            
                    <li>
                        <a href="#"
                            class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900 dark:border-gray-800 dark:bg-gray-900 dark:text-white">
                            4
                        </a>
                    </li>
            
                    <li>
                        <a href="#"
                            class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180 dark:border-gray-800 dark:bg-gray-900 dark:text-white">
                            <span class="sr-only">Next Page</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div>
    <x-dialog-modal wire:model="showingPostModal">
        @if ($isEditMode)
            <x-slot name="title">Actualizar Post</x-slot>
        @else
            <x-slot name="title">Crear Post</x-slot>
        @endif
        <x-slot name="content">
            <div class="space-y-8 divide-y divide-gray-200 mt-2">
                <form enctype="multipart/form-data">
                    <div class="sm:col-span-6 py-3">
                        <x-label for="title">Titulo</x-label>
                        <div class="mt-1">
                            <x-input class="w-full" type="text" id="title" wire:model.lazy="title" name="title"/>
                        </div>
                        <div class="py-1 text-red-500">@error('title') <span class="error">{{ $message }}</span> @enderror</div>
                    </div>
                    <div>
                        <x-label for="title" class="py-3"> Cargar Image </x-label>
                        <div class="flex">
                            <div class="flex items-center justify-center w-full sm:col-span-6">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Haga click para cargar</span>
                                            o arrastre y suelte</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 1920x1080px)
                                        </p>
                                    </div>
                                    <input id="dropzone-file" type="file" wire:model="newImage" name="image" class="hidden" />
                                </label>
                                @if ($oldImage)
                                    <img class="w-1/2 p-2 rounded-xl" src="{{ Storage::url($oldImage) }}">
                                @endif
                                @if ($newImage)
                                    <img class="w-1/2 p-2 rounded-xl" src="{{ $newImage -> temporaryUrl() }}">
                                @endif
                                
                            </div>
                            
                        </div>
                        <div>
                            <div class="py-1 text-red-500">@error('newImage') <span class="error">{{ $message }}</span> @enderror</div>
                        </div>
                    </div>
                    <div class="sm:col-span-6 py-3">
                        <x-label for="body">Body</x-label>
                        <div class="mt-1">
                            <textarea id="body" rows="3" wire:model.lazy="body"
                                class="shadow-sm focus:ring-indigo-500 appearance-none dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm"></textarea>
                        </div>
                        <div class="py-1 text-red-500">@error('body') <span class="error">{{ $message }}</span> @enderror</div>
                    </div>
                </form>
            </div>
        </x-slot>
        <x-slot name="footer">
            @if ($isEditMode)
                <x-button wire:click="updatePost">Actualizar</x-button>
            @else
            <x-button wire:click="storePost">Crear</x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
    </div>
</div>