<x-app-layout>

<div class=" mx-auto w-8/12 dark:bg-gray-900">

<h2 class="text-center text-lg text-black font-bold mb-5">Create Revenue Type</h2>

 <form action="{{ route('create-revenue-type')}}" method="post">
 @csrf

 
 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-jet-label for="single_display" value="{{ __('Revenue Type') }}" />
    <x-jet-input id="single_display" name="single_display" type="text" class="mt-1 block w-full " wire:model.defer="state.single_display" autocomplete="single_display" />
    <x-jet-input-error for="single_display" class="mt-2" />
</div>

 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-jet-label for="column_display" value="{{ __('Column Name in Report') }}" />
    <x-jet-input id="column_display" name="column_display" type="text" class="mt-1 block w-full " wire:model.defer="state.column_display" autocomplete="column_display" />
    <x-jet-input-error for="column_display" class="mt-2" />
</div>

 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-jet-label for="fund" value="{{ __('Fund') }}" />
    <select name="fund" id="fund" class="w-full" class="dark:bg-slate-700 dark:text-white dark:border-slate-600 rounded">
        <option class="dark:bg-slate-700 dark:text-white dark:border-slate-600" value="">Select one</option>
        @foreach ($funds as $fund)
        <option class="dark:bg-slate-700 dark:text-white dark:border-slate-600" value="{{ $fund['value'] }}">{{ $fund['label'] }}</option>

        @endforeach
    </select>
    <x-jet-input-error for="fund" class="mt-2" />
</div>
 

<x-jet-button class="bg-sky-600 hover:bg-sky-700   " type="submit" wire:click="submit">
    {{ __('Create') }}
</x-jet-button>

 </form>
</div>
</x-app-layout>