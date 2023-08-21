
<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user">
 <div class="mx-auto w-10/12">
       
 <h2 class="font-semibold text-center mt-5 mb-5 text-xl text-gray-800 dark:text-gray-200 leading-tight">
  Accountable Forms Used Today
 </h2>
 
 <table class="table-auto w-full border-collapse border-gray-200 dark:border-gray-700  mb-5 px-6 py-3  ">
  <thead >

   <tr class="border-b bg-gray-400 text-white border-gray-200 dark:border-gray-700 dark:bg-gray-900">
    <th class="px-6 py-3">Accountable Form Type</th>
    <th class="px-6 py-3">Accountable Form Number</th>
    <th class="px-6 py-3">Used?</th>
    <th class="px-6 py-3">Payor </th>
    <th class="px-6 py-3">Amount</th>
    <th class="px-6 py-3">Review Functions</th>
   </tr>
  </thead>

  <tbody>
  @foreach($used_accountable_forms as $af)
   <tr class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> {{ $af->form_type }} </td>
    <td class="px-6 py-3 text-right "> {{ $af->form_number }}</td>
    <td class="px-6 py-3"> Yes</td>
    <td class="px-6 py-3"> {{ $af->payor  }} </td>
    <td class="text-right px-6 py-3 "> {{ $af->total_amount   }} </td>
    @can('collector')
    <td class="px-6 py-3 flex justify-center">

      <!-- Edit  -->
       <a href="{{ route('add-accountable-form-item', $af->form_id) }} " class=" ">
        <x-fas class="fas fa-edit  hover:text-green-500  "></x-fas>
       </a>
     <!-- View  -->
       <a href="#" class=" ">
        <x-fas class="fas fa-eye hover:text-green-500  "></x-fas>
       </a>
       </td>
    @endcan
   </tr>


   @endforeach
   <tr class="border-b bg-gray-200 font-bold border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3" colspan="4"> Subtotal </td>
    
    <td class="text-right px-6 py-3">{{ $used_accountable_forms->sum('total_amount') }} </td>
    <td class="text-right px-6 py-3"></td>
    
   </tr>
  </tbody>

 </table>

 @can('collector')
 <form action="" method="post">
  <x-jet-button class="mt-3 p-3">
   {{ __('Submit Individual Report')  }}
  </x-jet-button>
 </form>
 @endcan

 </div>

</x-app-layout>