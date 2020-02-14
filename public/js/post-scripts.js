function favorite(post_id) {
    if (document.getElementById("fa_" + post_id + "_fav").classList.contains("active")) {
        document.getElementById("fa_" + post_id + "_fav").classList.remove("fa");
        document.getElementById("fa_" + post_id + "_fav").classList.add("far");
        document.getElementById("likes_" + post_id).innerHTML =
            Number(document.getElementById("likes_" + post_id).innerHTML) - 1;
    } else {
        document.getElementById("fa_" + post_id + "_fav").classList.remove("far");
        document.getElementById("fa_" + post_id + "_fav").classList.add("fa");
        document.getElementById("likes_" + post_id).innerHTML =
            Number(document.getElementById("likes_" + post_id).innerHTML) + 1;
    }
    document.getElementById("fa_" + post_id + "_fav").classList.toggle("active");
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/posts/" + post_id + "/favorite", true);
    xhttp.send();
}

function bookmark(post_id) {
    if (document.getElementById("fa_" + post_id + "_book").classList.contains("active")) {
        document.getElementById("fa_" + post_id + "_book").classList.remove("fa");
        document.getElementById("fa_" + post_id + "_book").classList.add("far");
    } else {
        document.getElementById("fa_" + post_id + "_book").classList.remove("far");
        document.getElementById("fa_" + post_id + "_book").classList.add("fa");
    }
    document.getElementById("fa_" + post_id + "_book").classList.toggle("active");
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/posts/" + post_id + "/bookmark", true);
    xhttp.send();
}

function deletePost() {
    var post_id = document.getElementById("d-post-id").value;
    document.getElementById('p_' + post_id).innerHTML = 
        '<div class="alert alert-danger alert-dismissible fade show shadow-sm mb-3" role="alert">' +
        'Une post a été supprimé!' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
            '<span aria-hidden="true">&times;</span>' + 
        '</button>' + 
        '</div>';
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", '/posts/d/' + post_id, true);
    xhttp.send();
}

$(document).ready(function(){
    $('#delete_post').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#d-post-id').val(id);
    });
});
