<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Data Table</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-danger">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-center text-white">Sample Data Table</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // loops 
                            for ( $i=1 ; $i <= 10 ; $i++) { 
                            
                            echo "<tr>
                                    <td>student $i </td>
                                    <td>Ahmed Mohamed Abubakr</td>
                                    <td>ahmed@example.com</td>
                                    <td>Admin</td>
                            </tr>";
                            
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                 <!-- bootstrap form -->
                <form class="p-3 text-end was-validated">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">الاسم </label>
                                <input type="text" class="form-control is-valid" id="validationServer01" required />
                            </div>
                        </div>

                        <div class="mb-3 col-6">
                            <label class="form-label">البريد </label>
                            <input type="email" class="form-control is-valid" id="validationServer02" required />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block w-100">إرسال</button>
                    </div>
                </form>
                <!-- bootstrap form -->
            </div>
        </div>
    </div>
    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 