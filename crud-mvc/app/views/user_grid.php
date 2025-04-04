<table class="table table-hover table-dark table-sm" id="users_grid">
    <!-- Table headers -->
    <thead class="text-center font-weight-bold">
        <tr>
            <th width="5%">ID</th>
            <th width="20%">First Name</th>
            <th width="20%">Last Name</th>
            <th width="25%">Email</th>
            <th width="15%">Sign Date</th>
            <th width="15%" class="td-actions"> Options </th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php if (!empty($data['users'])): ?>                   <!-- check if users are available  -->
             <?php foreach ($data['users'] as $row): ?>      <!--loop through the users -->
            <tr>
                <th><?php echo $row['id']; ?></th>
                <th><?php echo $row['first_name']; ?></th>
                <th><?php echo $row['last_name']; ?></th>
                <th><?php echo $row['email']; ?></th>
                <th><?php echo $row['sign_date']; ?></th>
                <th>
                    <!-- Add delete and edit buttons -->
                    <button type="button" id="<?php echo $row['id']; ?>" class="btn btn-xs btn-info" title="Edit" onclick="User.show(this);">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" id="<?php echo $row['id']; ?>" class="btn btn-xs btn-danger" title="Delete" onclick="User.confirm(this);">
                        <i class="fa fa-trash"></i>
                    </button>
                </th>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr class="text-center">
                <td colspan="6">No users</td>       <!-- no users available -->
            </tr>
        <?php endif; ?>
    </tbody>
</table>
