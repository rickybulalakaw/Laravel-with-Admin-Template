<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user" :message_count="$message_count">
<div class="container">
@if (Session::has('error') )
 <p class="alert alert-danger">
  {{ $error }} 
 </p> 
 @endif
 <h1 class="text-center">Register Community Tax Certificate</h1>
 <form action="{{ route('record-community-tax-individual', $accountable_form_id) }}" method="post">
  @csrf

  <input type="text" name="accountable_form_id" value="{{ $accountable_form_id }}" id="accountable_form_id" hidden>
  <input type="text" name="accountable_form_type_id" value="{{ $accountable_form_id }}" id="accountable_form_id" hidden>
  <div class="form-group">
   <label for="A">Charge A</label>
   <input type="number" name="{{ $ctc_a }}" value="{{ old($ctc_a) }}" id="A" class="form-control" autofocus>
   @error($ctc_a)
   <div class="text-danger mt-2 text-sm">
    {{ $message }}
   </div>
  @enderror
  </div>
  <div class="form-group">
   <label for="A">Charge B</label>
   <input type="number" name="{{ $ctc_b }}" value="{{ old($ctc_b)  }}" id="A" class="form-control" autofocus>
   @error($ctc_b)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>
  <div class="form-group">
   <label for="A">Charge C</label>
   <input type="number" name=" {{ $ctc_c }}" value="{{ old($ctc_c)  }}" id="A" class="form-control" autofocus>
   @error($ctc_c)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>
  <div class="form-group">
   <label for="A">Charge C1</label>
   <input type="number" name="{{ $ctc_c1 }}" value="{{ old($ctc_c1)  }}"  class="form-control" autofocus> 
   @error($ctc_c1)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="formCheck">
    <label class="form-check-label" for="exampleCheck1">I checked that the values are correct.</label>
</div> -->

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_reviewed" value="1">
        <label class="custom-control-label text-danger" for="customSwitch1">I checked that the values are correct.</label>
    </div>
</div>



  <button class="btn btn-primary">Submit</button>
 </form>
</div>
</x-app-layout>