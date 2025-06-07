<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- You can add your CSS here, like Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="display:inline; padding:0; border:none; cursor:pointer;">
                  Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  
    <div class="container mt-5">
        <h1>Welcome, Admin!</h1>
        <p>This is your admin dashboard.</p>
  
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text">View, add, or remove users.</p>
                        <a href="#" class="btn btn-light">Go</a>
                    </div>
                </div>
            </div>
  
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Shelters</div>
                    <div class="card-body">
                        <h5 class="card-title">Manage Shelters</h5>
                        <p class="card-text">View and approve shelters.</p>
                        <a href="#" class="btn btn-light">Go</a>
                    </div>
                </div>
            </div>
  
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Adoptions</div>
                    <div class="card-body">
                        <h5 class="card-title">Track Adoptions</h5>
                        <p class="card-text">Manage adoption requests.</p>
                        <a href="#" class="btn btn-light">Go</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
