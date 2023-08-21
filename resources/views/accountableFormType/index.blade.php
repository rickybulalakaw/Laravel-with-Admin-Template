
<x-app-layout>
<div class="mx-auto w-8/12 sm:pt-0 bg-gray-100 dark:bg-gray-900">
 <h1 class="text-center">List of Accountable Forms</h1>
 <table class="table-auto w-full ">
  <thead>
   <tr>
    <th class="text-center" style="width:15%">Form Number</th>
    <th class="text-center"  style="width:45%">Accountable Form</th>
    <th class="text-center"  style="width:25%">Default Value (in PhP)</th>
    <th class="text-center"  style="width:15%">Action</th>
   </tr>
  </thead>
  <tbody>
   @foreach($accountableFormTypes as $aft) 
   <tr class=" ">
    <td class="text-center border-slate-300 border-y">{{ $aft->number }}</td>
    <td class="border-y border-slate-300">{{ $aft->name }} </td>
    <td class="text-center  border-slate-300 border-y">{{ $aft->default_amount }} </td>
    <td class="text-center  border-slate-300 border-y justify-center">
      <x-fas class="fas fa-edit text-cyan-400 cursor-pointer  "></x-fas>
      <x-fas class="fas fa-trash text-red-400 cursor-pointer  "></x-fas>
    </td>
   </tr>
   @endforeach
  </tbody>
 </table>
</div>
</x-app-layout>