@extends("layout.defaultPage")
@section("titre","Inscription")
@section("entete","Veuillez vous inscrire")
@section("adresse","Courriel")
@section("rappel","Se rappeler de moi")
@section("mot de passe","Mot de passe")
@section("bouton","S'inscrire")

@section('content')

<form method="POST" action="{{ url('/inscription') }}">

    @method('post')
    @csrf
    <img class="mb-4 img-fluid rounded" src="{{asset('img/logo.jpg')}}" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">@yield("entete","valeur")</h1>

    <div class="form-floating mb-4">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="courriel">
      @if ($errors->has('courriel'))
          <span class="text-danger">
              {{$errors->first('courriel')}}
          </span>
      @endif
      

      <label for="floatingInput">@yield("adresse","valeur")</label>
    </div>

    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de Passe" name="motDePasse">
        @if ($errors->has("motDePasse"))
            <span class="text-danger">{{$errors->first("motDePasse")}}</span>
        @endif
        
      <label for="floatingPassword">@yield("mot de passe","valeur")</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        @yield("rappel","valeur")
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">@yield("bouton","valeur")</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; Cegep de Jonquiere 2024–2025</p>
  </form>

@endsection
