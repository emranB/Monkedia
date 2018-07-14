<?php session_start(); ?>

<div class="container-fluid padded">

  <div class="row">
    <div class="col-10">
      <h4 class="font-two"> Logged in as:
        <b><i class="color-mild"> <?php echo $_SESSION["Username"]; ?> </i></b>
      </h4>
    </div>
    <div class="col-2">
      <button type="button" name="Logout" class="btn btn-primary btn-block bgc-light" onclick="LogoutUser()"> LOGOUT </button>
    </div>
  </div>

  <hr>
  <br>

  <table class="table table-striped table-hover">
    <thead class="thead-dark">
      <tr>
        <th> UID </td>
        <th> USERNAME </td>
        <th> NAME </td>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>

</div>
