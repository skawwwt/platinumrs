$(document).ready(function() {
    $.post("php/checkAdmin.php", function(response) {
        if (response == "1") {

        } else {
            window.location.replace("../login");
        }
    });

    getUsers();



    $('.addUser').click(function() {
        $('#userAdd').modal("show");

    });

    $('#addUserButton').click(function() {
        var firstname = $('#firstnameAdd').val(),
            surname = $('#surnameAdd').val(),
            email = $('#emailAdd').val(),
            type = $('[name=typeAdd]').val(),
            busName = $('#busnameAdd').val(),
            testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (firstname == "" | surname == "" | email == "" | type == "" | busName == "" | testEmail == "") {
            $('#addAck').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter data for all fields.</div>');
        } else if (!(testEmail.test(email))) {
            $('#addAck').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter a valid email address.</div>');
        } else {
            $.post("php/manageUsers.php", {
                do: 6,
                id: 0,
                firstname: firstname,
                surname: surname,
                email: email,
                type: type,
                busname: busName
            }, function(response) {
                if (!(response == "1")) {
                    alert("Error adding new user, please try again.");
                } else {
                    $('#userAdd').modal("hide");
                    $('#firstnameAdd').val("");
                    $('#surnameAdd').val("");
                    $('#emailAdd').val("");
                    $('[name=typeAdd]').val("Admin");
                    $('#busnameAdd').val("");
                    getUsers();
                }
            });
        }
    });

    $('.cancelAdd').click(function() {
        $('#userAdd').modal("hide");
        $('#firstnameAdd').val("");
        $('#surnameAdd').val("");
        $('#emailAdd').val("");
        $('[name=typeAdd]').val("Admin");
        $('#busnameAdd').val("");
    });


});

function getUsers() {
    $.post("php/getUsers.php", function(response) {
        $('#userTable').html("");
        response = $.parseJSON(response);
        len = response.length;
        for (var i = 0; i < len; i++) {
            var id = response[i].id,
                firstname = response[i].firstname,
                surname = response[i].surname,
                email = response[i].email,
                type = response[i].type,
                status = response[i].status,
                logAttempts = response[i].attemptLog,
                company = response[i].busName,
                lastLogin = response[i].lastLogin,
                button = "";
            if (status == "0") {
                status = "Unconfirmed";
                button = '<button id="' + id + '" class="btn btn-warning btn-xs suspend">Suspend</button>';
            } else if (status == "1") {
                status = "Confirmed";
                button = '<button id="' + id + '" class="btn btn-warning btn-xs suspend">Suspend</button>';
            } else {
                status = "Suspended";
                button = '<button id="' + id + '" class="btn btn-info btn-xs activate">Re-Activate</button>';
            }
            $('#userTable').append('<tr><td>' + id + '</td><td>' + firstname + '</td><td>' + surname + '</td><td>' + email + '</td><td>' + type + '</td><td>' + status + '</td><td>' + logAttempts + '</td><td>' + company + '</td><td>' + lastLogin + '</td><td><button class="btn btn-danger btn-xs delete" id="' + id + '">Delete</button>' + button + '<button id="' + id + '" class="btn btn-success btn-xs edit">Edit</button></td></tr>')
        }
    });
}

$(document).on("click", ".delete", function() {
    var id = $(this).attr("id");
    $.post("php/manageUsers.php", {
        do: 1,
        id: id
    }, function(response) {
        if (response == "1") {
            getUsers();
        } else {
            alert("issue deleting");
        }
    });

});

$(document).on("click", ".suspend", function() {
    var id = $(this).attr("id");
    $.post("php/manageUsers.php", {
        do: 2,
        id: id
    }, function(response) {
        if (response == "1") {
            getUsers();
        } else {
            alert("issue suspending");
        }
    });
});

$(document).on("click", ".activate", function() {
    var id = $(this).attr("id");
    $.post("php/manageUsers.php", {
        do: 3,
        id: id
    }, function(response) {
        if (response == "1") {
            getUsers();
        } else {
            alert("issue suspending");
        }
    });
});

$(document).on("click", ".edit", function() {
    $('#firstname').val("");
    $('#surname').val("");
    $('#email').val("");
    $('#busname').val("");
    var id = $(this).attr("id");
    $.post("php/manageUsers.php", {
        do: 4,
        id: id
    }, function(response) {
        response = $.parseJSON(response);
        len = response.length;
        for (var i = 0; i < len; i++) {
            var id = response[i].id,
                firstname = response[i].firstname,
                surname = response[i].surname,
                email = response[i].email,
                type = response[i].type,
                company = response[i].busName;
            if (type == "Admin") {
                type = "Admin";
            } else if (type == "Internal") {
                type = "Internal";
            } else {
                type = "External";
            }
            $('#idtag').html(id);
            $('#firstname').val(firstname);
            $('#surname').val(surname);
            $('#email').val(email);
            $('[name=type]').val(type);
            $('#busname').val(company);
        }

    });



    $("#userEdit").modal("show");
});

$('#update').click(function() {
    var id = $('#idtag').html(),
        firstname = $('#firstname').val(),
        surname = $('#surname').val(),
        email = $('#email').val(),
        type = $('[name=type]').val(),
        busname = $('#busname').val(),
        testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (firstname == "" | surname == "" | email == "" | type == "" | busname == "" | testEmail == "") {
        $('#editAck').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter data for all fields.</div>');
    } else if (!(testEmail.test(email))) {
        $('#editAck').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter a valid email address.</div>');
    } else {
        $.post("php/manageUsers.php", {
            do: 5,
            id: id,
            firstname: firstname,
            surname: surname,
            email: email,
            type: type,
            busname: busname
        }, function(response) {
            if (response == "1") {
                $("#userEdit").modal("hide");
                getUsers();
            } else {
                alert("Issue editing user. Please try again.");
            }
        });
    }
});

$('#users').click(function() {
    $('.vacancies').hide();
    $('.news').hide();
    $('.team').hide();
    $('.users').show();
    $('#vacancies').attr("class", "btn btn-default");
    $('#news').attr("class", "btn btn-default");
    $('#team').attr("class", "btn btn-default");
    $('#users').attr("class", "btn btn-default active");
    getUsers();
});


$('#vacancies').click(function() {
    $('.users').hide();
    $('.news').hide();
    $('.team').hide();
    $('.vacancies').show();
    $('#users').attr("class", "btn btn-default");
    $('#news').attr("class", "btn btn-default");
    $('#team').attr("class", "btn btn-default");
    $('#vacancies').attr("class", "btn btn-default active");
    $('#vacanciesTable').html("");
    getVacancies();
});

$('#news').click(function(){
  $('.users').hide();
  $('.vacancies').hide();
  $('.team').hide();
  $('.news').show();
  $('#users').attr("class", "btn btn-default");
  $('#vacancies').attr("class", "btn btn-default");
  $('#team').attr("class", "btn btn-default");
  $('#news').attr("class", "btn btn-default active");
  getNews();
});

$('#team').click(function(){
  $('.users').hide();
  $('.vacancies').hide();
  $('.news').hide();
  $('.team').show();
  $('#users').attr("class", "btn btn-default");
  $('#vacancies').attr("class", "btn btn-default");
  $('#news').attr("class", "btn btn-default");
  $('#team').attr("class", "btn btn-default active");
  getTeam();
});

function getVacancies() {
    $.post("php/manageVacancies.php", {
        do: 1
    }, function(response) {
        response = $.parseJSON(response);
        len = response.length;
        for (var i = 0; i < len; i++) {
            var vid = response[i].vid,
                uid = response[i].uid,
                title = response[i].title,
                description = response[i].description,
                location = response[i].location,
                published = response[i].published,
                updated = response[i].updated,
                end = response[i].vacEnd;

            getAuthor(uid, vid, title, description, location, published, updated, end);

        }
    });
};

function getAuthor(uid, vid, title, description, location, published, updated, end) {
    $.post("php/manageVacancies.php", {
        do: 2,
        id: uid
    }, function(response) {
        response = $.parseJSON(response);
        len = response.length;
        for (var i = 0; i < len; i++) {
            var name = response[i].firstname + " " + response[i].surname,
                busname = response[i].busName;
            var string1 = '<tr><td>' + vid + '</td><td>' + title + '</td><td>' + description + '</td><td>' + location + '</td><td>' + published + '</td><td>' + updated + '</td><td>' + end + '</td>';
            var string2 = '<td>' + name + '</td><td>' + busname + '</td><td><button id="' + vid + '" class="btn btn-danger btn-sm deleteVac">Delete</button><button id="'+vid+'" class="btn btn-success btn-sm editVac">Edit</button></td></tr>';
            var finalString = string1 + string2;
            $('#vacanciesTable').append(finalString);

        }
    });
}

function getNews(){
  $('#newsTable').html("");
  $.post("php/manageNews.php", {do: 1}, function(response){
    response = $.parseJSON(response);
    len = response.length;
    for (var i = 0; i < len; i++) {
        var id = response[i].nid,
            uid = response[i].uid,
            title = response[i].title,
            content = response[i].content,
            published = response[i].published;

            getNewsAuthor(id, uid, title, content, published);

      }
  });
}

function getNewsAuthor(id, uid, title, content, published){
  $.post("php/manageNews.php", {do: 2, uid: uid}, function(response){
    response = $.parseJSON(response);
    len = response.length;
    for (var i = 0; i < len; i++) {
        var name = response[i].firstname + " " + response[i].surname;
        var string = '<tr><td>' + id + '</td><td>' + title + '</td><td>' + content + '</td><td>' + name + '</td><td>' + published + '</td><td><button id="'+id+'" class="btn btn-danger btn-sm newsDel">Delete</button><button id="'+id+'" class="btn btn-success btn-sm newsEdit">Edit</button></td>';
        $('#newsTable').append(string);

      }
  });
}

$(document).on("click", ".deleteVac", function(){
  var id = $(this).attr("id");
  $.post("php/manageVacancies.php", {do: 3, id: id}, function(response){
    if(response == "1"){
      $('#vacanciesTable').html("");
      getVacancies();
    } else {
      alert("Issue deleting vacancy, please try again.");
    }
  });
});

$(document).on("click", ".editVac", function(){
  var id = $(this).attr("id");
  $('.vacUpdate').attr("id", id);
  $.post("php/manageVacancies.php", {do: 4, id: id}, function(response){
    response = $.parseJSON(response);
    len = response.length;
    for (var i = 0; i < len; i++) {
      var vid = response[i].vid,
          uid = response[i].uid,
          title = response[i].title,
          description = response[i].description,
          location = response[i].location,
          published = response[i].published,
          updated = response[i].updated,
          end = response[i].vacEnd;

          $('#vacTitle').val(title);
          $('#vacDesc').val(description);
          $('#vacLocation').val(location);
          $('#vacEnd').val(end);
      }
  });
  $('#editVac').modal("show");
});

$(document).on("click", ".vacUpdate", function(){
  var title = $('#vacTitle').val(),
      description = $('#vacDesc').val(),
      location = $('#vacLocation').val(),
      vacEnd = $('#vacEnd').val(),
      id = $(this).attr("id");

      $.post("php/manageVacancies.php", {do: 5, id: id, title: title, description: description, location: location, vacEnd: vacEnd}, function(response){
        if(response == "1"){
          $('#vacanciesTable').html("");
          $('#editVac').modal("hide");
          getVacancies();
        } else {
          alert("Issue updating vacancy, please try again.");
        }
      });
});

$(document).on("click", ".deleteVac", function(){
  var id = $(this).attr("id");
  $.post("php/manageVacancies.php", {do: 6, id: id}, function(response){
    if (response == "1"){
      $('#vacanciesTable').html("");

    } else {
      alert("Issue deleting vacancy, please try again.");
    }
  });
});

$(document).on("click", ".addVacancy", function(){
  $('#addVac').modal("show");
});

$('.vacAdd').click(function(){
  var title = $('#vacTitleAdd').val(),
      description = $('#vacDescAdd').val(),
      location = $('#vacLocationAdd').val(),
      vacEnd = $('#vacEndAdd').val().replace('T', ' ');
      vacEnd = vacEnd + ":00";
      $.post("php/manageVacancies.php", {do: 7, title: title, description: description, location: location, vacEnd: vacEnd}, function(response){
        if(response == "1"){
          $('#addVac').modal("hide");
          $('#vacanciesTable').html("");
          getVacancies();
        } else {
          alert("Issue adding vacancy, please try again");
        }
      });
});

$(document).on("click", ".newsEdit", function(){
  var id = $(this).attr("id");
  $.post("php/manageNews.php", {do: 3, id: id}, function(response){
    response = $.parseJSON(response);
    len = response.length;
    for (var i = 0; i < len; i++) {
      var title = response[i].title,
          content = response[i].content;
          $('#newsTitleEdit').val(title);
          $('#newsContentEdit').val(content);
          $('#idtagEdit').attr("class",id);
        }
  });
  $('#newsEdit').modal("show");
});

$(document).on("click", ".newsDel", function(){
  var id = $(this).attr("id");
  $.post("php/manageNews.php", {do: 4, id: id}, function(response) {
    if(response == "1"){
      getNews();
    } else {
      alert("Issue deleting news item, please try again.");
    }
  });
});

$('.addNews').click(function(){
  $('#newsAddModal').modal("show");
});

$('#add').click(function(){
  var title = $('#newsTitleAdd').val(),
      content = $('#newsContentAdd').val();
  if(title == "" || content == ""){
    $('#newsAddAck').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter both a title and content.</div>');
  } else {
    $.post("php/manageNews.php", {do: 5, title: title, content: content}, function(response){
      if(response == "1"){
        $('#newsAddModal').modal("hide");
        getNews();
      } else {
        alert("Issue adding news item, please try again.");
      }
    });
  }
});

$('#updateNews').click(function(){
  var title = $('#newsTitleEdit').val(),
      content = $('#newsContentEdit').val(),
      nid = $('#idtagEdit').attr("class");
  if(title == "" || content == ""){
    $('#newsAddAck').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter both a title and content.</div>');
  } else {
    $.post("php/manageNews.php", {do: 6, title: title, content: content, nid: nid}, function(response){
      if(response == "1"){
        $('#newsEdit').modal("hide");
        getNews();
      } else {
        alert("Issue updating news item, please try again.");
      }
    });
  }
});


function getTeam(){
  $('.team_render').html("");
  $.post("php/manageTeam.php", {do: 1}, function(response){
    if(!(response == "2")){
      response = $.parseJSON(response);
      len = response.length;
      for (var i = 0; i < len; i++) {
        var uid = response[i].uid,
            caption = response[i].caption,
            phone = response[i].phone,
            picture = response[i].picture,
            pubStat = response[i].published;

        renderProfile(uid, caption, phone, picture, pubStat);
      }
    } else {
      alert("No team profiles found");
    }
  });
}

function renderProfile(uid, caption, phone, picture, pubStat){
  $.post("php/manageUsers.php", {do: 4, id: uid}, function(response){
    if(!(response == "2")){
      response = $.parseJSON(response);
      len = response.length;
      for (var i = 0; i < len; i++) {
        var fName = response[i].firstname,
            lName = response[i].surname,
            email = response[i].email;
            picture = "../images/profile/" + picture;
      }
      if(pubStat == 1){
        $('.team_render').append('<div class="panel panel-default col-md-12"><div class="panel-body"><div class="col-md-4"><h5>'+ fName + " " + lName + '</h5><div class="profile-image"><img class="img-responsive" src="'+ picture +'" /></div><span class="label label-success">Public</span></div><div class="col-md-8"><h5>Caption</h5><p>'+ caption +'<p><h5>Phone:</h5><p>'+ phone +'</p><h5>Email:</h5><p>'+ email +'</p><button id="'+ uid +'" class="btn btn-primary editTeam">Edit</button></div></div></div>');
      } else {
        $('.team_render').append('<div class="panel panel-default col-md-12"><div class="panel-body"><div class="col-md-4"><h5>'+ fName + " " + lName + '</h5><div class="profile-image"><img class="img-responsive" src="'+ picture +'" /></div><span class="label label-danger">Not Public</span></div><div class="col-md-8"><h5>Caption</h5><p>'+ caption +'<p><h5>Phone:</h5><p>'+ phone +'</p><h5>Email:</h5><p>'+ email +'</p><button id="'+ uid +'" class="btn btn-primary editTeam">Edit</button></div></div></div>');
      }
    } else {
      alert("Issue rendering profile.");
    }
  });
}

$(document).on("click", ".editTeam", function(){
  var id = $(this).attr("id");
  $.post("php/manageTeam.php", {do: 2, uid: id}, function(response){
    if(!(response == 2)){
      response = $.parseJSON(response);
      len = response.length;
      for (var i = 0; i < len; i++) {
        var uid = response[i].uid,
            caption = response[i].caption,
            phone = response[i].phone,
            pubStat = response[i].published;
        $('#idtag').attr("class", uid);
        $('#teamEditCaption').val(caption);
        $('#teamEditPhone').val(phone);
        if(pubStat == 1){
          pubStat = "Yes";
        } else {
          pubStat = "No";
        }
        $('#teamPublishedStatus').val(pubStat);
      }
    } else {
      alert("Issue fetching profile data, please refresh the page and try again.");
    }
  });
  $('#editTeam').modal("show");
});

$('#teamUpdate').click(function(){
  var uid = $('#idtag').attr("class"),
      caption = $('#teamEditCaption').val(),
      phone = $('#teamEditPhone').val(),
      pubStat = $('#teamPublishedStatus').val();
      if (pubStat == "Yes"){
        pubStat = 1;
      } else {
        pubStat = 0;
      }
      $.post("php/manageTeam.php", {do: 3, uid: uid, caption: caption, phone: phone, pubStat: pubStat}, function(response){
        if(response == 1){
          $('#idtag').attr("class", "");
          $('#teamEditCaption').val("");
          $('#teamEditPhone').val("");
          $('#teamPublishedStatus').val("");
          $('#editTeam').modal("hide");
          getTeam();
        } else {
          alert("Error updating profile, please try again.");
        }
      });

});
