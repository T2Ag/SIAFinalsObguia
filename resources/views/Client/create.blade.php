@extends('layout')

@section('content')
<div class="mt-[100px] mx-6">
<h1 class="text-2xl text-center font-bold mb-5">Add New Customer</h1>
<div >
   <div class="w-full max-w-md mx-auto">
      <form action="{{url('clients/create')}}" method="POST">
      @csrf 
      <div class="mb-4">
            <label for="first_name"> First Name </label>
            <input type="text" name='first_name' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'>
            @error('first_name')
               <p class='text-red-500'>{{$message}}</p>
            @enderror
      </div>
      <div class="mb-4">
            <label for="last_name"> Last Name </label>
            <input type="text" name='last_name' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outlinel'>
            @error('last_name')
            <p class='text-red-500'>{{$message}}</p>
      @enderror
      </div>
      <div class="mb-4">
            <label for="address"> Address </label>
            <input type="text" name='address' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outlinel'>
            @error('address')
            <p class='text-red-500'>{{$message}}</p>
      @enderror
      </div>
      <div class="mb-4">
            <label for="phone"> Phone </label>
            <input type="text" name='phone' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outlinel'>
            @error('phone')
            <p class='text-red-500'>{{$message}}</p>
      @enderror
      </div>
      <div class="mb-4">
         <label for="membership_id">Membership</label>
         <select name="membership_id" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">Select a membership</option>
            @foreach($memberships as $membership)
                  <option value="{{ $membership['id'] }}">{{ $membership['type'] }} - ${{ $membership['price'] }}</option>
            @endforeach
         </select>
         @error('membership_id')
         <p class="text-red-500">{{ $message }}</p>
         @enderror
      </div>
      <div class="flex justify-end">
            <a href="{{url('/clients')}}" class='btn btn-danger mr-2' type='button'>
               Back
            </a>
            <button class="btn btn-primary">
               Add Customer
            </button>
      </div>
      </form>
   </div>
</div>
</div>


    

@endsection