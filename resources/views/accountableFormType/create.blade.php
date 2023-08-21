<x-app-layout>

<div class=" mx-auto w-8/12 dark:bg-gray-900">

<h2 class="text-center text-lg text-black font-bold mb-5">Create Accountable Form Type</h2>

 <form action="{{ route('create-accountable-form-type')}}" method="post">
 @csrf

 
 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-jet-label for="name" value="{{ __('Form Name') }}" />
    <x-jet-input id="name" name="name" type="number" class="mt-1 block w-full " wire:model.defer="state.name" autocomplete="name" />
    <x-jet-input-error for="name" class="mt-2" />
</div>

 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-jet-label for="number" value="{{ __('Form Number') }}" />
    <x-jet-input id="number" name="number" type="text" class="mt-1 block w-full" wire:model.defer="state.number" autocomplete="number" />
    <x-jet-input-error for="number" class="mt-2" />
</div>

 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-jet-label for="default_amount" value="{{ __('Default Amount (Optional)') }}" />
    <x-jet-input id="default_amount" name="default_amount" type="number" class="mt-1 block w-full" wire:model.defer="state.default_amount" autocomplete="default_amount" />
    <x-jet-input-error for="default_amount" class="mt-2" />
</div>

<x-jet-button class="bg-sky-600 hover:bg-sky-700   " type="submit" wire:click="submit">
    {{ __('Create') }}
</x-jet-button>

 </form>
</div>
</x-app-layout>