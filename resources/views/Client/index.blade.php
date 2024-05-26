@extends('layout')

@section('content')



<div class="mt-[100px] mx-6">
    @if (session('info'))
        <div class="alert alert-success">{{session('info')}}</div>
    @endif

    <div class="flex justify-between mb-3">
        <a href="{{url('/clients/create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type='button'>
            Add New Customer
        </a>

        <div class=" flex items-center">
            
            <a href="{{url('/clients/csv')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 rounded" type='button'>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="currentColor">
                    <path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V304H176c-35.3 0-64 28.7-64 64V512H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM200 352h16c22.1 0 40 17.9 40 40v8c0 8.8-7.2 16-16 16s-16-7.2-16-16v-8c0-4.4-3.6-8-8-8H200c-4.4 0-8 3.6-8 8v80c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-8c0-8.8 7.2-16 16-16s16 7.2 16 16v8c0 22.1-17.9 40-40 40H200c-22.1 0-40-17.9-40-40V392c0-22.1 17.9-40 40-40zm133.1 0H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H333.1c-7.2 0-13.1 5.9-13.1 13.1c0 5.2 3 9.9 7.8 12l37.4 16.6c16.3 7.2 26.8 23.4 26.8 41.2c0 24.9-20.2 45.1-45.1 45.1H304c-8.8 0-16-7.2-16-16s7.2-16 16-16h42.9c7.2 0 13.1-5.9 13.1-13.1c0-5.2-3-9.9-7.8-12l-37.4-16.6c-16.3-7.2-26.8-23.4-26.8-41.2c0-24.9 20.2-45.1 45.1-45.1zm98.9 0c8.8 0 16 7.2 16 16v31.6c0 23 5.5 45.6 16 66c10.5-20.3 16-42.9 16-66V368c0-8.8 7.2-16 16-16s16 7.2 16 16v31.6c0 34.7-10.3 68.7-29.6 97.6l-5.1 7.7c-3 4.5-8 7.1-13.3 7.1s-10.3-2.7-13.3-7.1l-5.1-7.7c-19.3-28.9-29.6-62.9-29.6-97.6V368c0-8.8 7.2-16 16-16z"/>
                </svg>
            </a>

            <a href="#" class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 rounded import-csv-btn' type='button'>
                Import CSV
            </a>

            <form action="{{ route('clients.import-csv') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" name="csv_file" id="csv_file" accept=".csv" style="display: none;">
                <button type="submit" class="btn btn-pink1 mo-md-2">Submit</button>
            </form>

            <a href="{{url('/clients/pdf')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type='button'>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="currentColor">
                    <path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="h-[600px] overflow-y-auto">
        <table class="min-w-full text-center text-sm font-light text-surface">
            <thead class="border-b border-neutral-200 bg-[#332D2D] font-medium text-white sticky top-0 z-10">
                <tr>
                    <th scope="col" class=" px-6 py-4">First Name</th>
                    <th scope="col" class=" px-6 py-4">Last Name</th>
                    <th scope="col" class=" px-6 py-4">Address</th>
                    <th scope="col" class=" px-6 py-4">Phone</th>
                    <th scope="col" class=" px-6 py-4">Membership</th>
                    <th scope="col" class=" px-6 py-4">QR</th>
                    <th scope="col" class=" px-6 py-4"></th>

                </tr>
            </thead>
            <tbody >
                @foreach($clients as $client)

                    <tr class="border-b border-gray-400 ">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$client->first_name}}</td>
                        <td>{{$client->last_name}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{$client->phone}}</td>
                        <td>{{$client->membership->type}}</td>
                        <td class="flex justify-center items-center m-2">
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($client->id) !!}
                        </td>
                        <td>
                            <div class="flex">
                                <a href="{{url('/clients/'.$client->id)}}" class='m-2'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </a>
                                <button class="text-red-600 m-2" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$client->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>  
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{$client->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$client->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel-{{$client->id}}">Delete Client - {{$client->first_name}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{url('clients/delete/' . $client->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                Are you sure you want to delete this Client?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete Client</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

</div>  


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var importCsvBtn = document.querySelector('.import-csv-btn');
            var fileInput = document.querySelector('#csv_file');
    
            importCsvBtn.addEventListener('click', function(event) {
                event.preventDefault();
                fileInput.click();
            });
    
            fileInput.addEventListener('change', function() {
                this.parentElement.submit();
            });
        });
    </script>

@endsection

