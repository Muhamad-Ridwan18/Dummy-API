<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Employee Table</title>
</head>
<body class="bg-gray-100 p-6">
    <div class="container bg-white p-8 rounded shadow mt-4 mb-4">
        <h1 class="text-2xl font-bold mb-8">Employee Table</h1>
        <button data-bs-toggle="modal" data-bs-target="#createModal"class="btn btn-success mb-2">Create Data</button>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Age</th>
                        <th>Profile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data (Replace with your dynamic data) -->
                    <?php if ($posts): ?>
                         <?php foreach ($posts['data'] as $post): ?>
                              <tr>
                                   <td><?= $post['employee_name'] ?? 'Name not available' ?></td>
                                   <td><?= $post['employee_salary'] ?? 'Author not available' ?></td>
                                   <td><?= $post['employee_age'] ?? 'Category not available' ?></td>
                                   <td class="border p-4"><img src="<?= $post['profile_image'] ?? 'Title not available' ?>" alt="" style="width:100px;"></td>
                                   <td>
                                        <div class="d-grid gap-2 d-md-block" aria-label="Employee Actions">
                                            <a href="/employee/<?= $post['id'] ?>" class="btn btn-primary">View</a>
                                            <a href="/employee/edit/<?= $post['id'] ?>" class="btn btn-secondary">Edit</a>
                                        </div>
                                    </td>

                                    <div class="modal fade" id="editModal<?= $post['id'] ?>" tabindex="-1" aria-labelledby="edit-modal-title" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edit-modal-title">Edit Employee Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="/employee/edit/<?= $post['id'] ?>">
                                                    <div class="modal-body">
                                                        <label for="edit-name" class="form-label">Name:</label>
                                                        <input type="text" id="edit-name" name="edit-name" class="form-control mb-3" value="<?= $post['employee_name'] ?>" required>

                                                        <label for="edit-salary" class="form-label">Salary:</label>
                                                        <input type="number" id="edit-salary" name="edit-salary" class="form-control mb-3" value="<?= $post['employee_salary'] ?>" required>

                                                        <label for="edit-age" class="form-label">Age:</label>
                                                        <input type="number" id="edit-age" name="edit-age" class="form-control mb-3" value="<?= $post['employee_age'] ?>" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                              </tr>
                         <?php endforeach; ?>
                    <?php else: ?>
                         <p>No posts available.</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Create New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/employee/create">
                    <div class="modal-body">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control mb-3" required>

                        <label for="salary" class="form-label">Salary:</label>
                        <input type="number" id="salary" name="salary" class="form-control mb-3" required>

                        <label for="age" class="form-label">Age:</label>
                        <input type="number" id="age" name="age" class="form-control mb-3" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
