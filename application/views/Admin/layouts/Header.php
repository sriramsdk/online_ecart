<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" style="margin-left: 10px;" href="#">
        <img src="<?php echo base_url('/assets/logo/online_ecart_logo.png'); ?>" width="35" height="35" class="ml-2 d-inline-block align-top" alt="">
        <?php echo env('SITE_NAME'); ?>
    </a>
    <div class="mr-3" style="width: 50px;">
        <i class="bi bi-box-arrow-right" id="logout" style="font-size: 30px;"></i>
    </div>
</nav>
<script>
    // Logout function
    $(document).ready(function(){
        $('#logout').on('click',function(){
            Swal.fire({
                icon: 'info',
                title: 'Logout',
                text: 'Are you sure want to logout',
                showConfirmButton: true,
                showCancelButton: true,
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url : "<?php echo site_url('Admin/logout')?>",
                        method : "POST",
                        success: function(response){
                            console.log(response);
                            location.reload();
                        }
                    });
                }        
            });
        });
    });
</script>