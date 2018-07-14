/*
  Globals
*/
var User = {
  "username": "",
  "password": ""
};

var UsersList = [];


/*
  Page Init functions
*/
$(document).ready(() => {

  /* Check if User is logged in */
  var GetSession = new Promise((resolve, reject) => {
    $.ajax({
      url     : 'scripts/GetSession.php',
      method  : 'GET',
      success : (response) => {
        resolve(response);
      },
      error   : () => {
        console.log('Some thing went wrong!\n');
      }
    });
  });

  /* Set Main page data */
  GetSession.then((response) => {
    SetContent(response);
    response = JSON.parse(response);
    User.username = response["Username"];
    User.password = response["Password"];
  });

});




/*
  Set main page content
*/
var SetContent = (session) => {
  session = session ? JSON.parse(session) : false;
  if (!session.Username) {
    CallAjax('pages/login.html', 'GET', '', 'main-body');
  }
  else {
    /* Get scaffolding to put text in */
    var GetTableHeader = new Promise((resolve, reject) => {
      CallAjax('pages/showUsers.php', 'GET', '', 'main-body');
      resolve();
    });

    /* Get and save a list of all Users */
    var GetUsersList = new Promise((resolve, reject) => {
      $.ajax({
        url     : 'scripts/GetUsers.php',
        method  : 'GET',
        success : (response) => {
          resolve(response);
        },
        error   : () => {
          console.log('Some thing went wrong!\n');
        }
      });
    });

    /* Append UsersList to table */
    GetUsersList.then((data) => {
      UsersList = JSON.parse(data);
      for (var i=0; i<UsersList.length; i++) {
        var user = UsersList[i];
        var row  = "<tr>";
        Object.values(user).forEach( (col) => {
          row += "<td>" + col + "</td>";
        });
        row += "</tr>";
        $(row).appendTo("tbody");
      }
    });

  }
};




/*
  Login User
*/
var LoginUser = (username, password) => {
  var promise = new Promise((resolve, reject) => {
    $.ajax({
      url     : 'scripts/LoginUser.php',
      method  : 'POST',
      data    : JSON.stringify('username='+username+'&password='+password),
      success : (response) => {
        resolve(response);
      },
      error   : () => {
        console.log('Some thing went wrong!\n');
      }
    });
  });

  promise.then((data) => {
    SetContent(data);
  });
};




/*
  Logout User
*/
var LogoutUser = () => {
  var promise = new Promise((resolve, reject) => {
    CallAjax('scripts/LogoutUser.php', 'POST', 'username='+User.username+'&password='+User.password);
    resolve();
  });

  promise.then((data) => {
    SetContent('');
  })
};




/*
  Helper function to make jQuery AJAX calls
*/
var CallAjax = function (url, method, data='', toHtml='') {

  var promise = new Promise((resolve, reject) => {
    $.ajax({
      url     : url,
      method  : method,
      data    : data,
      success : (response) => {
        resolve(response);
      },
      error   : () => {
        console.log('Something went wrong!\n');
      }
    });
  });

  promise.then((data) => {
    if (toHtml)
      $('.' + toHtml).html(data);
    else {
      return data;
    }
  });

};
