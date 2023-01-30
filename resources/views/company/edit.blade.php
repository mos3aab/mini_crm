<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Company') }}
        </h2>

    </x-slot>
    <br>
    @section('content')
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">

                <div class="pull-right">
                    <a class="btn btn-secondary" href="{{ route('companies') }}"> Back</a>
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
        
        <form action="{{ route('companies.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$company->id}}">
            <div class="d-flex align-items-center justify-content-center col-12">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{$company->name}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{$company->email}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" value="{{$company->website}}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-xs-8 col-sm-8 col-md-8 mt-3">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            @if($company->logo)
                            <img src="/{{ $company->logo }}" alt="">        
                            @endif
                            <input type="file" name="logo" id="logo" class="form-control">
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
