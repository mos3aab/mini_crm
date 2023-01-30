<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


@section('content')
<br>
<div class="h-100 d-flex align-items-center justify-content-center">

    <div class="row ">
        <div class="col-12">
            <b>
                CRM -  Companies and Employees 
            </b>
        </div>

        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Count</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>Companies</td>
                            <td>{{$companies}}</td>
                        </tr>
                        <tr>
                            <td>Employess</td>
                            <td>{{$employees}}</td>
                        </tr>
                    </tbody>
            </table>

        </div>
    </div>


</div>
    @endsection

</x-app-layout>
