<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user"  :message_count="$message_count">

   <div class="w-10/12 mx-auto justify-center py-3">
     <x-dashboard.welcome-banner :greeting="$greeting" :message="$message"/>
   </div>
 <div class="w-full justify-center">
  @can('collector')
   <div class="mx-auto w-10/12 justify-center bg-slate-200 dark:bg-slate-600 dark:text-white  p-3 rounded-md mb-5">
    <h3 class="font-thin  text-3xl hover:text-blue-600 hover:font-semibold">Instructions for Collectors</h3>
     <p class="w-full justify-start mb-3">You are designated as Collector. Your role is the input of data  receipts issued for cash received.</p>
     <p class="w-full justify-start mb-3">Below are the recommended steps for creating your individual report:</p>
     <ol class="list-decimal list-inside  indent-5   w-full justify-start mb-3">
      <li>Input the data of your used accountable forms. To do this, click "AF of Collector" on the left side of the web application, then select the appropriate form. Make sure the data of each accountable form is correct. </li>
      <li>After entering all your used accountable forms, view the draft report and check the total amount. Compare the total with the actual cash and check received. If the amounts are different, reconcile the data in the receipts and the amount on hand.</li>
      <li>When the total in the draft report matches the actual cash, click Submit.</li>
      <li>Go to your supervisor to surrender the cash and/or checks.</li>
     </ol>
   </div>
   @endcan 

   @can('consolidator')
   <div class="mx-auto w-10/12 justify-center bg-slate-200 dark:bg-slate-600 dark:text-white  p-3 rounded-md mb-5">
    <h3 class="font-thin  text-3xl hover:text-blue-600 hover:font-semibold">Instructions for Collectors</h3>
     <p class="w-full justify-start mb-3">You are designated as Consolidator. Your review the submitted individual report of cash received and compare the total with the amount submitted.</p>
     <p class="w-full justify-start mb-3">Below are the recommended steps for reviewing individual reports and creating your consolidated report:</p>
     <ol class="list-decimal list-inside  indent-5   w-full justify-start mb-3">
      <li>Click "Consolidator Tools" on the left sidebar, then click "View Individual Reports". This will show the list of individuals with submitted individual reports</li>
      <li>Click the first collector's name. This will show his/her submitted Individual Report.</li>
      <li>Check the total amount versus the amount submitted. If the amounts are different, it is suggested you stop and message the individual that the amount submitted is different from the calculated total. If the amounts are the same, you may proceed to the next step.</li>
      <li>Check the details of each accountable form in the system submission versus those written in the submitted physical forms. For each form, check if the details are correct. If not, enter your comment. To facilitate correction by the collector, make your comment as instructive as possible. However, if the details in the system submission are correct, click "Endorse." Do this for all submitted accountable forms.</li>
     </ol>
   </div>
   @endcan 

   @can('treasurer')
   <div class="mx-auto w-10/12 justify-center bg-slate-200 dark:bg-slate-600 dark:text-white  p-3 rounded-md mb-5">
    <h3 class="font-thin  text-3xl hover:text-blue-600 hover:font-semibold">Instructions for Collectors</h3>
     <p class="w-full justify-start mb-3">You are designated as Treasurer. Your review the submitted consolidated report of cash received and compare the total with the amount submitted.</p>
     <p class="w-full justify-start mb-3">Below are the recommended steps for reviewing consolidated reports and creating your own consolidated report:</p>
     <ol class="list-decimal list-inside  indent-5   w-full justify-start mb-3">
      <li>Click "Treasurer Tools" on the left sidebar, then click "View Reports". This will show the list of individuals with submitted individual reports</li>
      <li>Click the first collector's name. This will show his/her submitted Individual Report.</li>
      <li>Check the total amount versus the amount submitted. If the amounts are different, it is suggested you stop and message the individual that the amount submitted is different from the calculated total. If the amounts are the same, you may proceed to the next step.</li>
      <li>Check the details of each accountable form in the system submission versus those written in the submitted physical forms. For each form, check if the details are correct. If not, enter your comment. To facilitate correction by the collector, make your comment as instructive as possible. However, if the details in the system submission are correct, click "Endorse." Do this for all submitted accountable forms.</li>
     </ol>
   </div>
   @endcan 

   @can('custodian')
   <div class="mx-auto w-10/12 justify-center bg-slate-200 p-3 rounded-md mb-5">
    <h3 class="font-thin  text-3xl hover:text-blue-600">Instructions for Custodians</h3>
     <p class="w-full justify-start mb-3">You are an custodian. Your role is relative to the issuance of accountable forms to collectors and generation of monthly reports.</p>
   </div>
   @endcan 

   @can('admin')
   <div class="mx-auto w-10/12 justify-center bg-slate-200 dark:bg-slate-600 dark:text-white  p-3 rounded-md mb-5">
    <h3 class="font-thin  text-3xl hover:text-blue-600 hover:font-semibold">Instructions for Admin</h3>
     <p class="w-full justify-start mb-3">Admin Functions.</p>
     <p class="w-full justify-start mb-3">As System Admin, your main functions are related to the system and not to the data. You are responsible for: </p>
     <ol class="list-decimal list-inside  indent-5   w-full justify-start mb-3">
      <li>Identifying position and office assignment of users. Their function will determine which functions they have access to. </li>
      <li>Identifying data types, such as types of accountable forms and revenues.</li>
      <li>Viewing access and transactions of users.</li>     
     </ol>
   </div>
   @endcan
 </div>
 
</x-app-layout>
