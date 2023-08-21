<x-app-layout>
<div class="mx-auto w-8/12 sm:pt-0 bg-gray-100 dark:bg-gray-900">

 <h1 class="text-center text-lg text-black font-bold mb-5 ">Register Accountable Forms</h1>
 <form action="{{ route('create-accountable-form') }}" method="post">
  @csrf

  <div class="form-group mb-4">   
   <x-jet-label for="accountable_form_type_id" :value="__('Accountable Form Type')"/> 
   <select name="accountable_form_type_id" id="accountable_form_type_id" class="form-control rounded-sm min-w-full border-gray-300 dark:border-gray-700" value="{{ old('accountable_form_type_id') }}">
    <option value=""></option>
    @foreach($accountableFormTypes as $aft) 
    <option value="{{ $aft->id }}">{{ $aft->name }}</option>
    @endforeach
   </select>
   <x-jet-input-error for="accountable_form_type_id" class="mt-2" />   
  </div>

  <div class="form-group mb-4">
   <x-jet-label for="collector" :value="__('Collector')" />
   <select name="collector" id="collector" class="form-control rounded-sm min-w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 " id="collector" value="{{ old('collector') }}">
    <option value=""></option>
    @foreach($collectors as $col)
    <option value="{{ $col->id }}">{{ $col->name ." ". $col->last_name }} </option> 
    @endforeach
   </select>
   <x-jet-input-error for="collector" class="mt-2" />
  </div>

    <div class="col-span-6 sm:col-span-4 mb-4">
        <x-jet-label for="start_number" value="{{ __('Start Number') }}" />
        <x-jet-input id="start_number" name="start_number" type="number" value="{{ old('start_number') }}" class="mt-1 block w-full" wire:model.defer="state.start_number" autocomplete="start_number" />
        <x-jet-input-error for="start_number" class="mt-2" />
    </div>

    <div class="col-span-6 sm:col-span-4 mb-4">
        <x-jet-label for="end_number" value="{{ __('End Number') }}" />
        <x-jet-input id="end_number" name="end_number" type="number" value="{{ old('end_number') }}" class="mt-1 block w-full" wire:model.defer="state.end_number" autocomplete="end_number" />
        <x-jet-input-error for="end_number" class="mt-2" />
    </div>

    <x-jet-button>
        {{ __('Assign to Collector') }}
    </x-jet-button>
  
 </form>
</div>
</x-app-layout>