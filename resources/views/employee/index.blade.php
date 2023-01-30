
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        </h2> --}}
        <div class="flex">
            {{ __('Employees') }}
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" style="color: blue;">
                <x-nav-link :href="route('employees.add')" :active="request()->routeIs('employees.add')">
                    {{ __('Add Employee') }}
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
                        List of Employees
                    </b>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th></th>
                    </tr>
                    @if(count($employees) > 0)
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->fname }}</td>
                            <td>{{ $employee->lname }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->name }}</td>
                            <td nowrap>
                                <form action="{{ route('employees.delete') }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $employee->id}}">
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="6" align="center"> <b>No employee Found !</b></td>
                        </tr>
                    @endif
                </table>
                <br>
                
                    {!! $employees->links() !!}
                


            </div>
        </div>
    @endsection
</x-app-layout>
