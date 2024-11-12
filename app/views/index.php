
<div class="container my-5">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <!-- Upload CSV Column -->
                <div class="col-md-6">
                    <?php require 'app/views/importCSV.php'?>
                </div>

                <!-- Export CSV Column -->
                <div class="col-md-6">
                    <?php require 'app/views/exportCSV.php'?>
                </div>
            </div>
        </div>
    </div>
    <h1 class="text-center mb-4">Todo List</h1>
    <!-- Todo List Table -->
    <div class="card">
        <div class="card-header">Your Tasks</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone 1</th>
                            <th>Phone 2</th>
                            <th>Email</th>
                            <th>Subscription Date</th>
                            <th>Website</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($customer['id']); ?></td>
                            <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
                            <td><?php echo htmlspecialchars($customer['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($customer['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($customer['company']); ?></td>
                            <td><?php echo htmlspecialchars($customer['city']); ?></td>
                            <td><?php echo htmlspecialchars($customer['country']); ?></td>
                            <td><?php echo htmlspecialchars($customer['phone_1']); ?></td>
                            <td><?php echo htmlspecialchars($customer['phone_2']); ?></td>
                            <td><?php echo htmlspecialchars($customer['email']); ?></td>
                            <td><?php echo htmlspecialchars($customer['subscription_date']); ?></td>
                            <td><?php echo htmlspecialchars($customer['website']); ?></td>
                        </tr>
                        <!-- End of Edit Task Modal -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


