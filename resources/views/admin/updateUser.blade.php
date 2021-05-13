@extends('admin.layoutIN')

@section('admin')
<div class="regbody">
    <div class="container">
<h3>Update User </h3>
@foreach($userinfo as $user)
<form method="POST" class="row g-3"  action="{{route('adminUpdateuser')}}">
    @csrf
    <div class="col-md-4">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="id"  value="{{$user->id}}" hidden >
        <input type="text" class="form-control" name="name" placeholder="Enter  student/staff name " value="{{$user->name}}"  >
      </div>
    <div class="col-md-4">
        <label for="birthCertID" class="form-label">BirthCertificate/ID Number:</label>
        <input type="text" class="form-control" name="birthCertID" placeholder="Enter  student/staff birthCertID " value="{{$user->birthCertID}}">
    </div>
    <div class="col-md-4">
        <label for="indexStaffNo" class="form-label">Index/ Staff No::</label>
        <input type="text" class="form-control" name="indexStaffNo" placeholder="Enter  student/staff indexStaffNo " value="{{$user->indexStaffNo}}" >
    </div>
    <div class="col-md-2">
        <label for="cod" class="form-label">Position: </label>
        <select name="role" class="form-control" value="{{$user->role}}">
          <option value="1">Student</option>
          <option value="2">Headteacher</option>
          <option value="3">Admin</option>
          
        </select>
    </div>
    
    <div class="col-md-6">
        <label for="primarySchoolID" class="form-label">Primary School ID:</label>
        <input type="text" class="form-control" name="primarySchoolID" placeholder="Enter  student/staff primarySchoolID " value="{{$user->primarySchoolID}}">
    </div>
    <div class="col-md-4">
        <label for="cod" class="form-label">Gender: </label>
        <select name="gender" value="{{$user->gender}}" class="form-control">
          <option value="Other">Other</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="dob" class="form-label">Death Of Birth:</label>
        <input type="date" class="form-control" name="dob" placeholder="Enter  student/staff dob " value="{{$user->dob}}">
    </div>
    <div class="col-md-4">
        <label for="religion" class="form-label">Religion:</label>
        <input type="text" class="form-control" name="religion" placeholder="Enter  student/staff religion " value="{{$user->religion}}">
    </div>
   
    <div class="col-md-4">
        <label for="cod" class="form-label">Disabled: </label>
        <select name="disabled" value="{{$user->disabled}}" required class="form-control">
          <option value="NO">NO</option>
          <option value="YES">YES</option>
        </select>
    </div>
    <div class="col-md-12">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" placeholder="Enter  student/staff email " value="{{$user->email}}">
    </div>
  
 


    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mt-4">
            <x-jet-label for="terms">
                <div class="flex items-center">
                    <x-jet-checkbox name="terms" id="terms"/>

                    <div class="ml-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </div>
                </div>
            </x-jet-label>
        </div>
    @endif

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
       
        </a>
       
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Update Record</button>
            <a href="/adminshowusers"  class="btn btn-danger" style="float:right"> Back to Users </a>
        </div>
    </div>
</form>
@endforeach
</div>
</div>
@endsection
