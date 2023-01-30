<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Employee') }}
        </h2>

    </x-slot>
    <br>
    @section('content')
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">

                <div class="pull-right">
                    <a class="btn btn-secondary" href="{{ route('employees') }}"> Back</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        
        <form action="{{ route('employees.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$employee->id}}">
            <div class="d-flex align-items-center justify-content-center col-12">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" value="{{old('lname',$employee->fname)}}" required  class="form-control" >
                        </div>
                    </div>
                    
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" value="{{old('lname',$employee->lname)}}" required  class="form-control" >
                        </div>
                    </div>
        
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email"  value="{{old('email',$employee->email)}}" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" value="{{old('phone',$employee->phone)}}" id="phone" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select name="company" id="company" class="form-control">
                                @foreach ($companies as $company )
                                    <option @if($employee->company == $company->id ) selected @else '' @endif value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 text-center">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                    
                </div>
            </div>
        </form>
    @endsection
</x-app-layout>
