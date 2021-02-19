@extends('layouts.app')

@section('content')
<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bttn.css/0.2.4/bttn.css"> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('resume.resumes') }}
                    <form action="{{route('search')}}" method='get'>
                        <div class='input-group'>
                            <input type='search' name='search' class='form-control'>
                            <span class='input-group-btn'>
                                <button type='submit' class='btn btn-success float-right'>Pesquisar
                            </span>
                        </div>
                    </form>
                    <a href="{{route('resume.create')}}" class="btn btn-success float-left">{{ __('general.new_resume') }}</a>               
                    <a href="{{route('consulta')}}" class="btn btn-success float-left">Consultar Curriculos</a>
                   
                </div>
                         {{$resumes->links()}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    
           
                    @if(count($resumes) > 0 )
                        @foreach($resumes as $resume)
                        <div class="card text-center">
                            <div class="card-header">
                               Profiss&atilde;o :  {{$resume->cargo}} 
                               Nome :  {{$resume->name}}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$resume->email}}</h5>
                                <p class="card-text">{{__('general.last_update')}}: {{$resume->updated_at}}.</p>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <a href="{{route('resume.edit', ['id' => $resume->id])}}" class="float-right btn btn-primary">{{__('general.edit')}}</a>

                                        </div> 
                                        <div class="col-md-2">
                                            <a href="{{route('resume.download', ['id' => $resume->id])}}" class="float-center btn btn-primary">Download</a>
                                        </div> 
                                        <div class="col-md-2">
                                            <a href="{{route('resume.delete', ['id' => $resume->id])}}" class="float- btn btn-danger">Excluir</a>
                                        </div> 
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    @else
                        {{ __('resume.no_resume') }}
                    @endif

                    <script>
                        function myFunction() {
                            document.getElementById("mySubmit").disabled = true;
                         }
                        function AlterStatus()
                        {
                         $("#mySubmit").html('Pesquisando');s
                         }
                     </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
