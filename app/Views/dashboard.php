<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>User Dashboard</title>
    <style>
        /* Page background and padding */
        body {
            background-color: #f4f6f9;
            padding-top: 40px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #040720;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h4 {
            margin: 0;
            color: #f4f6f9;
        }

        .card-body h5 {
            color: #007bff;
        }

        .btn-custom {
            margin-top: 20px;
            border-radius: 30px;
            padding: 10px 20px;
        }

        .btn-custom-success {
            background-color: #040720;
            border-color: #28a745;
            color: #f4f6f9;
        }

        .btn-custom-danger {
            background-color: #040720; 
            border-color: #007bff; 
            color: #f8f9fa; 
            transition: color 0.3s ease-in-out; 
        }

        .btn-custom:hover {
            color: #FFA500; 
            background-color: #040720; 
            text-decoration: wavy; 
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">User Dashboard</h4>
                        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-custom btn-custom-danger">Logout</a>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info text-center">
                            Welcome, <?= esc($user_name); ?>!
                        </div>
                        <h5 class="text-center fw-bold">USER DETAIL</h5>
                        <h5 class="mt-4 text-center">Profile Picture</h5>
                        <?php if (!empty($avatar)): ?>
                            <img src="<?= base_url('uploads/' . esc($avatar)); ?>" 
                            alt="Profile Picture" 
                            class="img-fluid rounded-circle" 
                            style="width: 150px; height: 150px;">
                        <?php else: ?>
                            <p class="text-center">No profile picture uploaded.</p>
                        <?php endif; ?>

                        <div class="list-group mb-4">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-3 fw-bold">User ID:</div>
                                    <div class="col-9"><?= esc($user_id); ?></div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-3 fw-bold">Name:</div>
                                    <div class="col-9"><?= esc($user_name); ?></div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-3 fw-bold">Email:</div>
                                    <div class="col-9"><?= esc($user_email); ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="list-group mb-4">
    <?php foreach ($user_blogs as $blog): ?>
        <div class="list-group-item">
            <div class="row">
                <div class="col-9">
                    <strong><?= esc($blog['title']); ?></strong><br>
                    <small>Created on: <?= esc($blog['created_at']); ?></small>
                </div>
                <div class="col-3 text-end">
                    <a href="<?= site_url('blog/edit/' . $blog['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                    <form action="<?= site_url('blog/delete/' . $blog['id']); ?>" method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

                        <h5>Upload Profile Picture:</h5>
                        <div class="button-group">
                            <form action="<?= site_url('auth/upload'); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <input type="file" name="avatar" class="form-control" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-custom btn-custom-success">Upload</button>
                            </form>

                            <a href="<?= site_url('blog/create'); ?>" class="btn btn-custom btn-custom-danger">Create Blog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>