<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CHKD CRM System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">

      html{
          display:table;
          width:100%;
          height:100%;}



      .wrapper {
          width: 50%;
          padding: 20px;
          margin: 0 auto;

          display:table-cell;
          vertical-align:middle;
          text-align:center;
      }

      body {
          font: 15px sans-serif;

          display:table-row;
      }

      h2 {
          font: 25px sans-serif;
          font-weight: bolder;
            vertical-align: middle;
      }

      .center {
          text-align: center;
          display: block;
          margin-left: auto;
          margin-right: auto;
            vertical-align: middle;
      }

      .btn {
        -webkit-border-radius: 10;
        -moz-border-radius: 10;
        border-radius: 10px;
        font-family: Arial;
        color: #ffffff;
        font-size: 20px;
        background: #f03c3c;
        padding: 10px 20px 10px 20px;
        text-decoration: none;
      }

      .btn:hover {
        background: #ff0000;
        text-decoration: none;
      }


    </style>
  </head>
  <body>
  <div class="wrapper">
      <img src="img/chkdlogo.png" alt="Chinesischer Handelskammer im Deutschland e.V." class="center">
      <h2 class="center">CHKD e. V. Customer Relationship Management System</h2>
      <br>
      <form>
          <input type="button" value="Login" onclick="window.location.href='login.php'" class="btn" />
      </form>
      <br>
      <form>
          <input type="button" value="Sign Up" onclick="window.location.href='signup.php'" class="btn" />
      </form>
  </div>
  </body>
</html>
