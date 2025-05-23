<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap JS Bundle -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

  <style>
    /* Your existing styles here */
    body {
      color: #000;
      overflow-x: hidden;
      height: 100%;
      background-color: #B0BEC5;
      background-repeat: no-repeat;
    }
    .card0 {
      box-shadow: 0px 4px 8px 0px #757575;
      border-radius: 0px;
    }
    .card2 {
      margin: 0px 40px;
    }
    .logo {
      width: 200px;
      height: 100px;
      margin-top: 20px;
      margin-left: 35px;
    }
    .image {
      width: 360px;
      height: 280px;
    }
    .border-line {
      border-right: 1px solid #EEEEEE;
    }
    .facebook, .twitter, .linkedin {
      color: #fff;
      font-size: 18px;
      padding-top: 5px;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      cursor: pointer;
    }
    .facebook { background-color: #3b5998; }
    .twitter { background-color: #1DA1F2; }
    .linkedin { background-color: #2867B2; }
    .facebook:hover, .twitter:hover, .linkedin:hover { opacity: 0.8; transition: 0.3s; }
    .line {
      height: 1px;
      width: 45%;
      background-color: #E0E0E0;
      margin-top: 10px;
    }
    .or {
      width: 10%;
      font-weight: bold;
    }
    input, textarea {
      padding: 10px 12px;
      border: 1px solid lightgrey;
      border-radius: 2px;
      margin-bottom: 5px;
      width: 100%;
      color: #2C3E50;
      font-size: 14px;
      letter-spacing: 1px;
    }
    input:focus, textarea:focus {
      border: 1px solid #304FFE;
      outline-width: 0;
    }
    button:focus {
      outline-width: 0;
    }
    a {
      color: inherit;
      cursor: pointer;
    }
    .btn-blue {
      background-color: #1A237E;
      width: 150px;
      color: #fff;
      border-radius: 2px;
    }
    .btn-blue:hover {
      background-color: #000;
    }
    .bg-blue {
      color: #fff;
      background-color: #1A237E;
    }
    .error-msg {
      color: red;
      margin-bottom: 15px;
    }
    @media screen and (max-width: 991px) {
      .logo { margin-left: 0px; }
      .image { width: 300px; height: 220px; }
      .border-line { border-right: none; }
      .card2 { border-top: 1px solid #EEEEEE !important; margin: 0px 15px; }
    }
  </style>
</head>
<body>

<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
  <div class="card card0 border-0">
    <div class="row d-flex">
      <div class="col-lg-6">
        <div class="card1 pb-5">
          <div class="row">
            <img src="https://i.imgur.com/CXQmsmF.png" class="logo" alt="Logo">
          </div>
          <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
            <img src="https://i.imgur.com/uNGdWHi.png" class="image" alt="Illustration">
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card2 card border-0 px-4 py-5">
          <div class="row mb-4 px-3">
            <h6 class="mb-0 mr-4 mt-2">Sign in with</h6>
            <div class="facebook text-center mr-3"><div class="fa fa-facebook"></div></div>
            <div class="twitter text-center mr-3"><div class="fa fa-twitter"></div></div>
            <div class="linkedin text-center mr-3"><div class="fa fa-linkedin"></div></div>
          </div>

          <div class="row px-3 mb-4">
            <div class="line"></div>
            <small class="or text-center">Or</small>
            <div class="line"></div>
          </div>

          <!-- Show error messages here -->
          <div class="row px-3">
            <?php if(session()->getFlashdata('error')): ?>
              <div class="error-msg"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if($errors = \Config\Services::validation()->getErrors()): ?>
              <div class="error-msg">
                <ul class="mb-0 pl-3">
                  <?php foreach($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>

          <form method="post" action="/login_ac">
            <?= csrf_field() ?>
            <div class="row px-3">
              <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
              <input
                class="mb-4"
                type="email"
                name="email"
                placeholder="Enter a valid email address"
                value="<?= old('email') ?>"
                required
              >
            </div>

            <div class="row px-3">
              <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
              <input
                type="password"
                name="password"
                placeholder="Enter password"
                required
              >
            </div>

            <div class="row px-3 mb-4">
              <div class="custom-control custom-checkbox custom-control-inline">
                <input id="chk1" type="checkbox" name="remember" class="custom-control-input" />
                <label for="chk1" class="custom-control-label text-sm">Remember me</label>
              </div>
              <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
            </div>

            <div class="row mb-3 px-3">
              <button type="submit" class="btn btn-blue text-center">Login</button>
              <button type="button" class="btn btn-secondary ml-3" onclick="window.location.href='auth/portal'">Cancel</button>
            </div>
          </form>

          <div class="row mb-4 px-3">
            <small class="font-weight-bold">
              Don't have an account? <a href="/register" class="text-danger">Register</a>
            </small>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-blue py-4">
      <div class="row px-3">
        <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
        <div class="social-contact ml-4 ml-sm-auto">
          <span class="fa fa-facebook mr-4 text-sm"></span>
          <span class="fa fa-google-plus mr-4 text-sm"></span>
          <span class="fa fa-linkedin mr-4 text-sm"></span>
          <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
