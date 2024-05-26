@extends('layout')

@section('content')

<h1 class="text-2xl text-center font-bold mb-5">Edit Client</h1>
<div class="">
   <div class="w-full max-w-md mx-auto">
      <form action="{{url('clients/'.$client->id)}}" method="POST">
      @csrf 
      <div class="mb-4">
            <label for="first_name"> First Name </label>
            <input type="text" name='first_name' value='{{$client->first_name}}' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'>
            @error('first_name')
               <p class='text-red-500'>{{$message}}</p>
            @enderror
      </div>
      <div class="mb-4">
            <label for="last_name"> Last Name </label>
            <input type="text" name='last_name' value='{{$client->last_name}}' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outlinel'>
            @error('last_name')
            <p class='text-red-500'>{{$message}}</p>
      @enderror
      </div>
      <div class="mb-4">
            <label for="address"> Address </label>
            <input type="text" name='address' value='{{$client->address}}' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outlinel'>
            @error('address')
            <p class='text-red-500'>{{$message}}</p>
      @enderror
      </div>
      <div class="mb-4">
            <label for="phone"> Phone </label>
            <input type="text" name='phone' value='{{$client->phone}}' class='appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outlinel'>
            @error('phone')
            <p class='text-red-500'>{{$message}}</p>
      @enderror
      </div>
      <div class="mb-4">
         <label for="membership_id">Membership</label>
         <select name="membership_id" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">Select a membership</option>
            @foreach($memberships as $membership)
                  <option value="{{ $membership['id'] }}" {{ $client->membership_id == $membership['id'] ? 'selected' : '' }}>
                     {{ $membership['type'] }} - ${{ $membership['price'] }}
                  </option>
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
               Update Customer
            </button>
      </div>
      </form>
   </div>
</div>

    

@endsection