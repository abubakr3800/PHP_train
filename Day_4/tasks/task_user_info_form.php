
<!-- Task: Basic Form Layout with Bootstrap -->
<div class="container mt-5">
  <form class="row g-3 needs-validation" novalidate>
    <div class="col-md-6">
      <label for="fullname" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="fullname" required>
    </div>
    <div class="col-md-6">
      <label for="age" class="form-label">Age</label>
      <input type="number" class="form-control" id="age" required>
    </div>
    <div class="col-md-6">
      <label for="job" class="form-label">Job</label>
      <select class="form-select" id="job" required>
        <option disabled selected>Select Job</option>
        <option>Developer</option>
        <option>Designer</option>
        <option>Manager</option>
      </select>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Submit</button>
      <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#jobModal">View Jobs</button>
    </div>
  </form>
  <table class="table table-striped mt-4">
    <thead><tr><th>Name</th><th>Age</th><th>Job</th></tr></thead>
    <tbody>
      <tr><td>Ahmed</td><td>22</td><td>Developer</td></tr>
    </tbody>
  </table>
  <div class="modal fade" id="jobModal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content p-3">
      <h5>Job Info</h5><p>This is a sample job modal info.</p>
    </div></div>
  </div>
</div>
