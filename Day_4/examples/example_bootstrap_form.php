<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
<!-- Bootstrap Form Example Without POST -->
<div class="container mt-5">
  <form class="row g-3 needs-validation" novalidate>
    <div class="col-md-6">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="name" required>
      <div class="invalid-feedback">Please enter your name.</div>
    </div>
    <div class="col-md-6">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" required>
      <div class="invalid-feedback">Valid email is required.</div>
    </div>
    <div class="col-md-6">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" class="form-control" id="phone" required>
    </div>
    <div class="col-md-6">
      <label for="city" class="form-label">City</label>
      <select class="form-select" id="city" required>
        <option selected disabled value="">Choose...</option>
        <option>Cairo</option>
        <option>Alexandria</option>
        <option>Giza</option>
      </select>
    </div>
    <div class="col-12">
      <button class="btn btn-success" type="submit">Send</button>
      <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#infoModal">View Info</button>
    </div>
  </form>
  <div class="table-responsive mt-4">
    <table class="table table-bordered text-center">
      <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>City</th></tr></thead>
      <tbody>
        <tr><td>Test User</td><td>test@email.com</td><td>0100000000</td><td>Cairo</td></tr>
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="infoModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <h5>Example Modal</h5>
        <p>This is just a sample data preview.</p>
      </div>
    </div>
  </div>
</div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 