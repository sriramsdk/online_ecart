<div class="container mt-5 mb-5 w-100 h-100">
    <table id="my_orders_table" class="table table-bordered mt-2 mb-2">
        <thead>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Order status</th>
        </thead>
        <tbody>
            <?php if(!empty($my_orders)){?>
                <?php foreach($my_orders as $key => $orders){?>
                    <tr>
                        <td>
                            <img id="edit_product_image_preview" src="<?php echo base_url('/').$orders['product_image']?>" alt="Product Image" class="img-fluid mt-2 ml-3" width="150">
                            <p class="ml-3"><?= $orders['product_name'];?></p>
                        </td>
                        <td><?= $orders['final_price'];?></td>
                        <td><button class="btn btn-success">Ordered</button></td>
                    </tr>
                <?php } ?>
            <?php }else{ ?>
                <tr>No Orders Available</tr>
            <?php }?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $('#my_orders_table').DataTable();
    });
</script>