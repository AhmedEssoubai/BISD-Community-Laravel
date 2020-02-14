@extends('layouts.groupe-admin')

@section('content-3')
<div class="container p-0">
    <div class="row px-3">
        <div class="col">
            <h3>List d'attente (<span id="count">{{ $groupe->pending_members->count() }}</span>) </h3>
        </div>
    </div>
    <div id="list" class="row mt-3">
        @foreach($groupe->pending_members as $member)
        <div id="member_{{ $member->id }}" class="col-md-6 my-3">
            <div class="d-flex bg-white shadow-sm p-4">
                <div class="pr-3">
                    <img src="{{ $member->image }}" class="img-fluid rounded-circle" width="78px"/>
                </div>
                <div class="flex-grow-1 d-flex flex-column">
                    <h4>{{ $member->prenom }} {{ $member->nom }} <span class="badge badge-primary">{{ $member->niveau }}</span></h4>
                    <p class="text-muted">{{ $member->email }}</p>
                </div>
                <div class="align-self-center d-flex">
                    <div class="mx-3 icon-g"><a title="Accepter" onclick="action('{{ route('groupes.accept', ['groupe' => $groupe->id, 'user' => $member->id]) }}', {{ $member->id }})"><span><i class="fa fa-check"></i></span></a></div>
                    <div class="mx-3 icon-r"><a title="Refuser" onclick="action('{{ route('groupes.leave', ['groupe' => $groupe->id, 'user' => $member->id]) }}', {{ $member->id }})"><span><i class="fa fa-times"></i></span></a></div>
                </div>
            </div>
        </div>
        @endforeach
        @if ($groupe->pending_members->count() == 0)
            <div class="col text-muted text-center py-2 px-2">
                <h2 class="my-3" style="font-size: 3em"><i class="fas fa-frog"></i></h2>
                <h4 class="my-3">Pas de nouveaux members</h4>
            </div>
        @endif
    </div>
    <script type="text/javascript">
        var count = {{ $groupe->pending_members->count() }};
        function action(url, id) {
            var member = document.getElementById('member_' + id);
            member.parentNode.removeChild(member);
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", url, true);
            xhttp.send();
            count--;
            document.getElementById("count").innerHTML = count;
            if (count == 0)
                document.getElementById("list").innerHTML += 
                    '<div class="col text-muted text-center py-2 px-2">' +
                        '<h2 class="my-3" style="font-size: 3em"><i class="fas fa-frog"></i></h2>' +
                        '<h4 class="my-3">Pas de nouveaux members</h4>' + 
                    '</div>';
        }
    </script>
</div>
@endsection