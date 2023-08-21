<div x-data="{show:true}" x-init="setTimeout(()=>show=false,3000)" x-show="show" class=""> 
@if (session()->has('success'))
<div
  class="mb-4 rounded-lg bg-blue-600 px-6 py-5 text-base text-blue-100 w-1/2 mx-auto "
  role="alert">
  {{ session()->get('success') }}
</div>
@elseif (session()->has('error'))
<div
  class="mb-4 rounded-lg bg-red-600 dark:bg-opacity-100  px-6 py-5 text-base text-white  "
  role="alert">
  {{ session()->get('error') }}
</div>
@elseif (session()->has('warning'))
<div
  class="mb-4 rounded-lg bg-yellow-500  px-6 py-5 text-base text-white"
  role="alert">
  {{ session()->get('warning') }}
</div>
@elseif (session()->has('message'))
<div
  class="mb-4 rounded-lg bg-blue-600  px-6 py-5 text-base text-white"
  role="alert">
  {{ session()->get('message') }}
</div>
@endif 
</div>