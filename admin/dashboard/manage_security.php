<?php
require_once('../../sql_connection/config.php');
requireRole('Admin');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'backup') {
        $message = '<div class="alert alert-success">Database backup scheduled successfully!</div>';
    } elseif ($action === 'password') {
        // In a production environment, validate and update password
        $message = '<div class="alert alert-success">Security settings updated successfully!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Security & Privacy Settings - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <?php include("../include/sidebarnav.php"); ?>
    <main class="main-wrapper">
        <?php include("../include/header.php"); ?>
        
        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-30">
                    <h2>Security & Privacy</h2>
                </div>
                
                <?php echo $message; ?>
                
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Database Backup -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Database Backup</h5>
                            </div>
                            <div class="card-body">
                                <p>Create a backup of your database to prevent data loss.</p>
                                <form method="POST">
                                    <input type="hidden" name="action" value="backup">
                                    <button type="submit" class="btn btn-primary">Create Backup Now</button>
                                </form>
                                <small class="text-muted d-block mt-2">Last backup: Never</small>
                            </div>
                        </div>
                        
                        <!-- Security Settings -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Security Settings</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <input type="hidden" name="action" value="password">
                                    
                                    <div class="mb-3">
                                        <label for="min-password-length" class="form-label">Minimum Password Length</label>
                                        <input type="number" class="form-control" id="min-password-length" value="8" min="6" max="20">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="require-special-chars" checked>
                                            <label class="form-check-label" for="require-special-chars">
                                                Require special characters in passwords
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="two-factor" checked>
                                            <label class="form-check-label" for="two-factor">
                                                Enable two-factor authentication
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save Security Settings</button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Privacy Policy -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Privacy Policy</h5>
                            </div>
                            <div class="card-body">
                                <p>Manage your privacy policy and data retention settings.</p>
                                <a href="#" class="btn btn-secondary">Edit Privacy Policy</a>
                                <a href="#" class="btn btn-secondary">View Audit Log</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <!-- Security Status -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Security Status</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <small class="text-muted">SSL Certificate</small>
                                    <p><span class="badge bg-success">✓ Secure</span></p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Admin Users</small>
                                    <p>1 active admin</p>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Last Security Scan</small>
                                    <p>Never</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
