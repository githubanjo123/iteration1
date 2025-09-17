<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-sign-out-alt fa-3x text-warning mb-3"></i>
                        <h5 class="card-title mb-2">Confirm Logout</h5>
                        <p class="text-muted">Are you sure you want to logout?</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="<?= $logoutUrl ?>" class="btn btn-danger">
                                <i class="fas fa-check me-2"></i>Yes, Logout
                            </a>
                            <a href="<?= $cancelUrl ?>" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
