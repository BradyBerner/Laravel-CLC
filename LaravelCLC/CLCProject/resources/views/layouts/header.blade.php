<form action="userProfile" id="userProfile" style="margin:0px;" method="post"></form>
<input form="userProfile" type="hidden" name="_token" value="{{csrf_token()}}"></input>
<input form="userProfile" type="hidden" name="ID" value="{{Session('ID')}}"></input>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgb(60, 63, 65); margin-bottom:20px;">
  <a class="navbar-brand" href="\CLC">CLC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if(Session::has('USERNAME')){?>
      <li class="nav-item active">
			<input type="submit" form="userProfile" class="nav-link" style="color:inherit; cursor:pointer; background:none; border:none; width:100% !important;" value="{{Session('USERNAME')}}">
      </li>
      <?php if(session('ROLE')){?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="userAdmin">User Admin</a>
          <a class="dropdown-item" href="#">PlaceHolder</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">PlaceHolder</a>
        </div>
      </li>
      <?php }?>
      <li class="nav-item">
      	<a class="nav-link" href="SignOut">Sign Out</a>
      </li>
      <?php } else {?>
      <li class="nav-item">
        <a class="nav-link" href="Login">Login</a>
      </li>
      <?php }?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
