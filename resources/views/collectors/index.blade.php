<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user"  :message_count="$message_count">
<div class="mx-auto lg:container flex flex-col space-y-12 lg:w-10/12">
 <h1 class="text-center text-3xl font-bold ">{{ $page_title }}

 </h1>
 <table class="table-auto w-full">
  <thead>
   <tr>
    <th class="text-center dark:text-white bg-gray-500 dark:bg-gray-800">Name of Collector</th>
    <th class="text-center dark:text-white bg-gray-500 dark:bg-gray-800">Amount Submitted</th>
    <th class="text-center dark:text-white bg-gray-500 dark:bg-gray-800">Status of Submission</th>
    <!-- <th class="text-center">Supervisor</th> -->
    <th class="text-center dark:text-white bg-gray-500 dark:bg-gray-800 ">Open</th>
   </tr>
  </thead>
  <tbody>
   @foreach($collectors2 as $collector)

   <tr class="odd:bg-gray-200 even:bg-gray-300 dark:odd:bg-gray-700 dark:even:bg-gray-800 dark:text-white">
    <td>{{ $collector->name }} {{ $collector->last_name }}</td>
    <td class="text-right">{{ number_format($collector->total, 2) }}</td>
    <td class="text-center">No registered AF</td>
    <td><a href="" class="btn btn-primary btn-block">Open</a></td>
   </tr>

   @endforeach
  </tbody>
 </table>
</div>
</x-app-layout>