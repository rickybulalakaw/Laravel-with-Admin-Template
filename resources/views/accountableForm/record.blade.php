<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user" :message_count="$message_count">

<div class="mx-auto w-8/12 sm:pt-0 bg-gray-100 dark:bg-gray-900">
 <h1 class="text-3xl text-center ">Record {{ $name }} </h1>


<form action="{{ route('record-accountable-form', $accountable_form_id) }} " method="post">
 @csrf 
 @method('PUT')

 <input type="text" name="accountable_form_type_id" value="{{ $accountable_form_type_id }}" hidden>
 <input type="text" name="accountable_form_id" value="{{ $accountable_form_id }}" hidden>
 <div class="my-3">
  <x-jet-label for="accountable_form_number">Accountable Form Number</x-jet-label>
  <x-jet-input type="text" class="w-full rounded " name="accountable_form_number" value="{{ $accountable_form_number }}" readonly />
 </div>

 <div class="my-3">
  <x-toggle name="is_cancelled" display="Toggle this if this form is cancelled" :value="1" :on="true" :off="false" />
</div>

 <div class="my-3">
  <x-jet-label for="form_date">Date (Editable)</x-jet-label>
  <x-jet-input type="date" name="form_date" value="{{ $date_today }}" class="w-full rounded " id="form_date" placeholder="Date"></x-jet-input>
  @error('form_date')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
 </div>

 <div class="my-3">
  <x-jet-label for="payor">Payor</x-jet-label>
  <x-jet-input type="text" name="payor" class="w-full rounded " id="date" value=" {{ old('payor') }} " placeholder="Payor"></x-jet-input>
  @error('payor')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
 </div>



 @if(isset($is_rpt_receipt))
 
 <div class="my-3">
   <x-jet-label for="receipt_no_pf_no_25">Receipt No. P.F. No. 25</x-jet-label>
   <x-jet-input type="number" name="receipt_no_pf_no_25" value="{{ old('receipt_no_pf_no_25') }}" id="receipt_no_pf_no_25" class="w-full rounded " autofocus />
   <x-jet-input-error for="receipt_no_pf_no_25" class="mt-2" />
 
  </div>

  <div class="my-3">
   <x-jet-label for="period_covered">Period Covered</x-jet-label>
   <x-jet-input type="text" name="period_covered" value="{{ old('period_covered')  }}" id="period_covered" class="w-full rounded " placeholder="example: 2021-2022" autofocus />
   @error('period_covered')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="my-3">
   <label for="classification">Classification</label>
   <!-- <input type="text" name="classification" value="{{ old('classification')  }}" id="classification" class="w-full rounded border-blue-400" autofocus> -->
   <select name="classification" value="{{ old('classification')  }}" id="classification" class="w-full rounded form-input  border-slate-700  dark:bg-slate-800 dark:text-white" autofocus>
   <option value="" class="dark:bg-slate-800 dark:text-white">Select one</option>
   @foreach ($land_classifications as $class)
   <option value="{{$class['value']}}" class="dark:bg-slate-800 dark:text-white">{{ $class['label'] }} </option>
   @endforeach
   </select>
   @error('classification')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="my-3">
   <x-jet-label for="tax_declaration_no">Tax Declaration Number</x-jet-label>
   <x-jet-input type="text" name="tax_declaration_no" value="{{ old('tax_declaration_no')  }}"  class="w-full rounded " autofocus /> 
   @error('tax_declaration_no')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="formCheck">
    <label class="form-check-label" for="exampleCheck1">I checked that the values are correct.</label>
</div> -->

<div class="my-3">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_reviewed" value="1">
        <label class="custom-control-label text-danger" for="customSwitch1">I checked that the values are correct.</label>
    </div>
</div>


 @elseif (isset($is_ctc))

 <div class="my-3">
   <label for="A">Basic Charge</label>
   <input type="number" name="{{ $ctc_a }}" value="{{ old($ctc_a) }}" id="A" class="w-full rounded border-blue-400" autofocus>
   @error($ctc_a)
   <div class="text-red-500  mt-2 text-sm">
    {{ $message }}
   </div>
   @enderror
  </div>
  <div class="my-3">
   <label for="B">Charge B</label>
   <input type="number" name="{{ $ctc_b }}" value="{{ old($ctc_b)  }}" id="A" class="w-full rounded border-blue-400" autofocus>
   @error($ctc_b)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>
  <div class="my-3">
   <label for="C">Charge C</label>
   <input type="number" name=" {{ $ctc_c }}" value="{{ old($ctc_c)  }}" id="A" class="w-full rounded border-blue-400" autofocus>
   @error($ctc_c)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>
  <div class="my-3">
   <label for="C1">Charge C1</label>
   <input type="number" name="{{ $ctc_c1 }}" value="{{ old($ctc_c1)  }}"  class="w-full rounded border-blue-400" autofocus> 
   @error($ctc_c1)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

 @endif

 <button type="submit" class="hover:bg-blue-600 p-3 border-black text-white rounded bg-cyan-600 "><i class="fas fa-save"></i> Record Used Accountable Form</button>
</form>
</div>

</x-app-layout>