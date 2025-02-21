<?php if ($user): ?>
    <div class="text-end">
        <img src="<?php echo base_url('assets/uploads/'.$user['image']); ?>" alt="Profile Image" class="img-thumbnail" width="100">
        <p>Welcome, <?php echo $user['name']; ?>!</p>
    </div>
<?php endif; ?>