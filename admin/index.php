<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <script type="text/javascript" src="js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="icon" href="favicon.png" sizes="16x16 32x32" type="image/png">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
	        Admin Panel - Platinum R S
	      </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../php/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="container">

            <div class="col-md-12">
                <br>
                <br>
                <br>
                <p class="pull-right">Logged In:
                    <?php session_start(); echo $_SESSION['firstname']." ".$_SESSION['surname']; ?>
                </p>
            </div>
            <div class="col-md-12">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <button type="button" id="users" class="btn btn-default active">Manager Users</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="vacancies" class="btn btn-default">Manage Vacancies</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="news" class="btn btn-default">Publish News</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="team" class="btn btn-default">Manage Team</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div hidden class="row vacancies">
        <div class="container">
            <div class="col-md-12">
                <h3>Manage Vacancies<button class="btn btn-success pull-right addVacancy">Add Vacancy</button></h3>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#vid</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Published</th>
                            <th>Updated</th>
                            <th>End Date</th>
                            <th>Author</th>
                            <th>Company</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody id="vacanciesTable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row users">
        <div class="container">
            <div class="col-md-12">
                <h3>Manage Users<button class="btn btn-success pull-right addUser">Add User</button></h3>
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Failed Logins</th>
                            <th>Company</th>
                            <th>Last Login</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        <tr>
                            <td>1</td>
                            <td>Stevie</td>
                            <td>Cowie</td>
                            <td>steviecowie@platinumrs.co.uk</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>0</td>
                            <td>Platinum R S</td>
                            <td>2016-07-05 17:49:53</td>
                            <td>
                                <button class="btn btn-danger btn-xs">Delete</button>
                                <button class="btn btn-warning btn-xs">Suspend</button>
                                <button class="btn btn-success btn-xs">Edit</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div hidden class="row news">
      <div class="container">
        <div class="col-md-12">
          <h3>Manage News Articles<button class="btn btn-success pull-right addNews">Add News Post</button></h3>
          <table class="table table-striped table-hover ">
              <thead>
                  <tr>
                      <th>#id</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Author</th>
                      <th>Published</th>
                      <th>Options</th>
                  </tr>
              </thead>
              <tbody id="newsTable">
                  <tr>
                      <td>1</td>
                      <td>Youth Football Sponsorship</td>
                      <td>We are happy to announce that platinum recruitment specialists are sponsoring the livingston youth football team in this seasons lineup.</td>
                      <td>Stevie Cowie</td>
                      <td>2016-07-05 17:49:53</td>
                      <td>
                          <button class="btn btn-danger btn-sm newsDel">Delete</button>
                          <button class="btn btn-success btn-sm newsEdit">Edit</button>
                      </td>
                  </tr>

              </tbody>
          </table>
        </div>
      </div>
    </div>

    <div hidden class="row team">
      <div class="container">
        <div class="col-md-12">
          <h3>Manage Team Profiles</h3>
          <div class="team_render">
            <div class="panel panel-default col-md-12">
              <div class="panel-body">
                <div class="col-md-4">
                  <h5>Stevie Cowie</h5>
                  <div class="profile-image">

                  </div>
                </div>
                <div class="col-md-8">
                  <h5>Caption</h5>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.<p>
                  <button class="btn btn-primary">Edit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal editTeamProfile -->
    <div id="editTeam" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Team Profile</h4>
                </div>
                <div class="modal-body">
                    <form id="newsAdd">
                      <span hidden id="idtag"></span>
                      <label>Caption:</label>
                      <textarea id="teamEditCaption" name="teamEditCaption" type="text" class="form-control" placeholder="Caption..." rows="5"></textarea>
                      <label>Phone:</label>
                      <input type="text" rows="20" id="teamEditPhone" name="teamEditPhone" class="form-control" placeholder="Phone number..."></input>
                      <label>Publicly Displayed:</label>
                      <select class="form-control" id="teamPublishedStatus" name="teamPublishedStatus">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </form>
                    <br>
                    <div id="newsAddAck"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="teamUpdate">Update</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal addNews -->
    <div id="newsAddModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <form id="newsAdd">
                      <span hidden id="idtag"></span>
                      <label>Title:</label>
                      <input id="newsTitleAdd" name="newTitleAdd" type="text" class="form-control" placeholder="News Title..." />
                      <label>Content:</label>
                      <textarea rows="20" id="newsContentAdd" name="newsContentAdd" class="form-control" placeholder="News Content..."></textarea>
                    </form>
                    <br>
                    <div id="newsAddAck"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="add">Submit</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal editNews -->
    <div id="newsEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <form id="newsUser">
                      <span hidden id="idtagEdit"></span>
                      <label>Title:</label>
                      <input id="newsTitleEdit" name="newTitleEdit" type="text" class="form-control" value="" />
                      <label>Content:</label>
                      <textarea rows="20" id="newsContentEdit" name="newsContentEdit" class="form-control" value=""></textarea>
                    </form>
                    <br>
                    <div id="editAck"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="updateNews">Update</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal editUser -->
    <div id="userEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <form id="editUser">
                        <span hidden id="idtag"></span>
                        <label>First Name:</label>
                        <input id="firstname" name="firstname" type="text" class="form-control" value="" />
                        <label>Surname:</label>
                        <input id="surname" name="surname" type="text" class="form-control" value="" />
                        <label>Email:</label>
                        <input id="email" name="email" type="text" class="form-control" value="" />
                        <label>User Type:</label>
                        <select id="type" name="type" class="form-control">
                            <option>Admin</option>
                            <option>Internal</option>
                            <option>External</option>
                        </select>
                        <label>Business Name:</label>
                        <input id="busname" name="busname" type="text" class="form-control" value="" />
                    </form>
                    <br>
                    <div id="editAck"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="update">Update</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal addUser-->
    <div id="userAdd" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <form id="addUser">
                        <span hidden id="idtag"></span>
                        <label>First Name:</label>
                        <input id="firstnameAdd" name="firstnameAdd" type="text" class="form-control" placeholder="Enter Firstname..." value="" />
                        <label>Surname:</label>
                        <input id="surnameAdd" name="surnameAdd" type="text" class="form-control" placeholder="Enter Surname..." value="" />
                        <label>Email:</label>
                        <input id="emailAdd" name="emailAdd" type="text" class="form-control" placeholder="Enter Email Address..." value="" />
                        <label>User Type:</label>
                        <select id="typeAdd" name="typeAdd" class="form-control">
                            <option>Admin</option>
                            <option>Internal</option>
                            <option>External</option>
                        </select>
                        <label>Business Name:</label>
                        <input id="busnameAdd" name="busnameAdd" type="text" class="form-control" placeholder="Enter Business Name..." value="" />
                    </form>
                    <br>
                    <div id="addAck"></div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default cancelAdd" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="addUserButton">Add</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal editVacancy-->
    <div id="editVac" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Vacancy</h4>
                </div>
                <div class="modal-body">
                    <form id="addUser">
                        <span hidden id="idtag"></span>
                        <label>Title:</label>
                        <input id="vacTitle" name="vacTitle" type="text" class="form-control" placeholder="Enter Firstname..." value="" />
                        <label>Description:</label>
                        <textarea id="vacDesc" name="vacDesc" type="text" class="form-control" placeholder="Enter Surname..." value=""></textarea>
                        <label>Location:</label>
                        <input id="vacLocation" name="vacLocation" type="text" class="form-control" placeholder="Enter Email Address..." value="" />
                        <label>End Date:</label>
                        <input id="vacEnd" name="vacEnd" type="datetime" class="form-control" />
                    </form>
                    <br>
                    <div id="addAck"></div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success vacUpdate" id="">Update</button>
                </div>
            </div>



        </div>
    </div>

    <!-- Modal addVacancy-->
    <div id="addVac" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Vacancy</h4>
                </div>
                <div class="modal-body">
                    <form id="addvac">
                        <span hidden id="idtag"></span>
                        <label>Title:</label>
                        <input id="vacTitleAdd" name="vacTitleAdd" type="text" class="form-control" placeholder="Enter Firstname..." value="" />
                        <label>Description:</label>
                        <textarea id="vacDescAdd" name="vacDescAdd" type="text" class="form-control" placeholder="Enter Surname..." value=""></textarea>
                        <label>Location:</label>
                        <input id="vacLocationAdd" name="vacLocationAdd" type="text" class="form-control" placeholder="Enter Email Address..." value="" />
                        <label>End Date:</label>
                        <input id="vacEndAdd" name="vacEndAdd" type="datetime-local" class="form-control" />
                    </form>
                    <br>
                    <div id="addAck"></div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success vacAdd" id="">Add</button>
                </div>
            </div>



        </div>
    </div>
    <script>
      jQuery(function($) {
        var panelList = $('#draggablePanelList');

        panelList.sortable({
            // Only make the .panel-heading child elements support dragging.
            // Omit this to make then entire <li>...</li> draggable.
            handle: '.panel-heading',
            update: function() {
                $('.panel', panelList).each(function(index, elem) {
                     var $listItem = $(elem),
                         newIndex = $listItem.index();

                     // Persist the new indices.
                });
            }
        });
    });

    jQuery(function($) {
        var panelList2 = $('#draggablePanelList2');

        panelList2.sortable({
            // Only make the .panel-heading child elements support dragging.
            // Omit this to make then entire <li>...</li> draggable.
            handle: '.panel-heading',
            update: function() {
                $('.panel', panelList2).each(function(index, elem) {
                     var $listItem = $(elem),
                         newIndex = $listItem.index();

                     // Persist the new indices.
                });
            }
        });
    });

    </script>
    <script type="text/javascript" src="js/admin.js"></script>
</body>

</html>
