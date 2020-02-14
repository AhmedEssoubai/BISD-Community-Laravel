@extends('layouts.groupe-admin')

@section('content-3')
<div class="container p-0">
    <div class="row mb-3 border-bottom py-3">
        <h2 class="col text-muted">Fondateur</h2>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 my-3">
            <div class="d-flex bg-white shadow-sm p-4">
                <div class="pr-3">
                    <img src="{{ $groupe->admin->image }}" class="img-fluid rounded-circle" width="78px"/>
                </div>
                <div class="flex-grow-1 d-flex flex-column">
                    <h4>{{ $groupe->admin->prenom }} {{ $groupe->admin->nom }}</h4>
                    <p class="text-muted">{{ $groupe->admin->niveau }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3 border-bottom py-3">
        <h2 class="col text-muted">Members</h2>
    </div>
    <div class="row mt-3">
        @foreach($groupe->real_members as $member)
        <div id="member_{{ $member->id }}" class="col-md-6 my-3">
            <div class="d-flex bg-white shadow-sm p-4">
                <div class="pr-3">
                    <img src="{{ $member->image }}" class="img-fluid rounded-circle" width="78px"/>
                </div>
                <div class="flex-grow-1 d-flex flex-column">
                    <h4>{{ $member->prenom }} {{ $member->nom }}</h4>
                    <p class="text-muted">{{ $member->niveau }}</p>
                </div>
                @if ($member->id == Auth::id() || !$groupe->can_join() || Auth::user()->etat == 'admin')
                <div class="d-flex pr-3 align-items-center dropdown">
                    <span class="icon-mute" id="member_{{ $member->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="member_{{ $member->id }}_options">
                        <a class="dropdown-item" href="/users/d/{{ $member->id }}">Ejecter</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @if ($groupe->members->count() == 0)
            <div class="col text-muted text-center py-2 px-2">
                <h2 class="my-3" style="font-size: 3em"><i class="fab fa-qq"></i></h2>
                <h4 class="my-3">Pas de members dans ce groupe</h4>
            </div>
        @endif
    </div>
    <script type="text/javascript">
        var count = {{ $groupe->members->count() }};
        function action(url, id) {
            var member = document.getElementById('member_' + id);
            member.parentNode.removeChild(member);
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", url, true);
            xhttp.send();
            count--;
            document.getElementById("count").innerHTML = count;
            if (count == 0)
                document.getElementById("list").innerHTML += '<h3 class="col my-4 text-muted text-center"><i class="fas fa-frog mr-2"></i> Pas de nouveaux members</h3>'
        }
    </script>
</div>
@endsection