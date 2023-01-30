
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        </h2> --}}
        <div class="flex">
            {{ __('Companies') }}
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" style="color: blue;">
                <x-nav-link :href="route('companies.add')" :active="request()->routeIs('companies.add')">
                    {{ __('Add Company') }}
                </x-nav-link>
            </div>

        </div>
        @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
    </x-slot>
    <br>
    @section('content')
        <br>
        <div class="h-100 d-flex align-items-center justify-content-center">

            <div class="row ">
                <div class="col-12">
                    <b>
                        List Of Companies
                    </b>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                        <th></th>
                    </tr>
                    @if(count($companies) > 0)
                    @foreach ($companies as $company)
                        <tr>

                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td><a href="{{ $company->logo }}" class="underline" target="_blank"> <img src="{{ $company->logo }}" alt=""></a></td>
                            <td><a href="{{$company->website}}" target="_blank" class="underline">{{$company->website}}</a></td>
                            <td nowrap>
                                <form action="{{ route('companies.delete') }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('companies.edit', $company->id) }}">Edit</a>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $company->id}}">
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5" align="center"> <b>No Company Found !</b></td>
                        </tr>
                    @endif
                </table>
                <br>
                
                    {!! $companies->links() !!}
                


            </div>
        </div>
    @endsection
</x-app-layout>
