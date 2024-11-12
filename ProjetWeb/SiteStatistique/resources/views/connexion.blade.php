@extends("layout.defaultPage")
@section("titre","Connexion")
@section("entete","Veuillez vous connecter")
@section("adresse","Courriel")
@section("mot de passe","Mot de passe")
@section("rappel","Se rappeler de moi")
@section("bouton","Se connecter")
@section('content')


<div class="container">
  <div class = "mt-5">
  @if($errors->any())
    <div class="col-12">
    @foreach($errors->all() as $error)
      <div class="alert alert-danger">{{$error}}</div>
    </div>
    @endforeach
  </div>
</div>
  @endif

  @if(session()->has('error'))
  <div class="alert alert-danger col-12">{{session('error')}}</div>
  @endif

<form method="POST" action="{{ route('connexion.post') }}">

    @method('post')
    @csrf
    <img class="mb-4 img-fluid rounded" src="{{asset('img/logo.jpg')}}" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">@yield("entete","valeur")</h1>

    <div class="form-floating mb-4">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      

      <label for="floatingInput">@yield("adresse","valeur")</label>
    </div>

    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de Passe" name="password">
        
        
      <label for="floatingPassword">@yield("mot de passe","valeur")</label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">@yield("bouton","valeur")</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; Cegep de Jonquiere 2024–2025</p>
  </form>
@endsection