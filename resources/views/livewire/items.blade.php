<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    @if(session()->has('message'))
    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 relative" role="alert" x-data="{show: true}" x-show="show">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
        </svg>
        <p>{{session('message')}}</p>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
            <svg class="fill-current h-6 w-6 text-white-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @endif
    <div class="mt-8 text-2xl font-medium text-gray-900 dark:text-white flex justify-between ">
        <div>Items</div>
        <div class="mr-2">
            <x-button wire:click="confirmItemAdd" class="bg-blue-500 hover:bg-blue-700">
                Add New Item
            </x-button>
        </div>

    </div>
    {{ $active}}
    {{ $query}}
    <br>
    {{ $item}}
    <div class="mt-6">
        <div class="flex justify-between">
            <div class="">
                <input wire:model.live="q" type="search" placeholder="Search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            </div>
            <div class="mr-2">
                <input type="checkbox" class="mr-2 leading-tight" wire:model.live="active" /> Active Only?
            </div>
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <!-- <button wire:click="test1('hola')">ID</button> -->
                            <button wire:click="ordenaBy('id')">ID</button>
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="ordenaBy('name')">Name</button>
                            <x-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="ordenaBy('price')">Price</button>
                            <x-sort-icon sortField="price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    @if(!$active)
                    <th class="px-4 py-2">
                        <div class="flex items-center">Status</div>
                    </th>
                    @endif
                    <th class="px-4 py-2">
                        <div class="flex items-center">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="border px-4 py-2">{{$item->id}}</td>
                    <td class="border px-4 py-2" wire:key="{{$item->id}}">
                        <span wire:mouseenter="sobre('{{$item->id}}')">{{$item->name}}</span>
                    </td>
                    <td class="border px-4 py-2">{{number_format($item->price,2)}}</td>
                    @if(!$active)
                    <td class="border px-4 py-2">{{$item->status ? 'Active':'Not-Active'}}</td>
                    @endif
                    <td class="border px-4 py-2">
                        <x-button wire:click="confirmItemEdit({{ $item }})" class="bg-orange-500 hover:bg-orange-700">
                            Edit
                        </x-button>
                        <x-danger-button wire:click="confirmItemDeletion({{ $item->id }})" wire:loading.attr="disabled">
                            Delete
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$id}}
    </div>

    <div class="mt-4">
        {{$items->links()}}
    </div>

    <!-- Delete Item Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingItemDeletion">
        <x-slot name="title">
            {{ __('Delete Item') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your Item?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingItemDeletion',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteItem({{ $confirmingItemDeletion}})" wire:loading.attr="disabled">
                {{ __('Delete Item') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    <!-- Create Item Confirmation Modal -->
    <x-dialog-modal wire:model.live="confirmingItemAdd">
        <x-slot name="title">
            {{isset($this->item->id)?'Edit Item':'Add Item'}}
        </x-slot>

        <x-slot name="content">
            <br>
            {{ isset($this->item)?$this->item:''}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="item.name" value="name" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="item.name" />
                <!-- <input id="name" type="text" class="mt-1 block w-full" wire:model="item.name" > -->
                <x-input-error for="item.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="price" value="{{ __('Price') }}" />
                <x-input id="price" type="text" class="mt-1 block w-full" wire:model.defer="item.price" />
                <x-input-error for="item.price" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model.defer="item.status" class="form-checkbox" />
                    <span class="ml-2 text-sm text-gray-600">Active</span>
                </label>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingItemAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="saveItem()" wire:loading.attr="disabled">
                {{ __('Save Item') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

</div>
