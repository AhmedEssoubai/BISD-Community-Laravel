@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light">
    <div class="container" style="min-height: 60vh;">
        <div class="row">
            <div class="col d-flex">
                <h2>List d'attente (<span id="count">{{ $users->count() }}</span>) - </h2>
                <h4 class="align-self-center mx-3 mt-1"><a class="align-self-center _link" href="{{ route('admin.users.all') }}">Tout</a></h4>
            </div>
        </div>
        <div id="list" class="row mt-3">
            @foreach($users as $user)
            <div id="user_{{ $user->id }}" class="col-md-6 my-3">
                <div class="d-flex bg-white shadow-sm p-4">
                    <div class="pr-3">
                        <img src="{{ $user->image }}" class="img-fluid rounded-circle" width="78px"/>
                    </div>
                    <div class="flex-grow-1 d-flex flex-column">
                        <h4>{{ $user->prenom }} {{ $user->nom }} <span class="badge badge-primary">{{ $user->niveau }}</span></h4>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                    <div class="align-self-center d-flex">
                        <div class="mx-3 icon-g"><a title="Accepter" onclick="action('{{ route('admin.users.accept', ['user' => $user->id]) }}', {{ $user->id }})"><span><i class="fa fa-check"></i></span></a></div>
                        <div class="mx-3 icon-r"><a title="Refuser" onclick="action('/users/d/{{ $user->id }}', {{ $user->id }})"><span><i class="fa fa-times"></i></span></a></div>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($users->count() == 0)
            <div class="col text-muted text-center py-2 px-2">
                <h2 class="my-3" style="font-size: 3em"><i class="fab fa-cloudversify"></i></h2>
                <h4 class="my-3">Pas de nouveaux utilisateurs</h4>
            </div>
            @endif
        </div>
    </div>
    <script type="text/javascript">
        var count = {{ $users->count() }};
        function action(url, id) {
            var user = document.getElementById('user_' + id);
            user.parentNode.removeChild(user);
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", url, true);
            xhttp.send();
            count--;
            document.getElementById("count").innerHTML = count;
            if (count == 0)
                document.getElementById("list").innerHTML += '<h3 class="col my-4 text-muted text-center"><i class="fab fa-cloudversify"></i> Pas de nouveaux utilisateurs</h3>'
        }
    </script>
</section>
@endsection