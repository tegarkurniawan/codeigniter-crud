<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.min.css" ?>">
</head>
<body>
<a class="btn btn-primary" href="<?php echo base_url()."index.php/helloworld/add_data";?>">Insert</a>
    <table class='table table-stripped table-bordered'>
        <tr style="background: grey">
            <td>No. Induk</td>
            <td>Nama</td>
            <td>Alamat</td>
            <td colspan="2"></td>
        </tr>
        <?php foreach ($data as $mahasiswa) {?>
        <tr>
            <td><?php echo $mahasiswa->no_induk; ?></td>
            <td><?php echo $mahasiswa->nama; ?></td>
            <td><?php echo $mahasiswa->alamat; ?></td>
            <td><a class="btn btn-success" href="<?php echo base_url()."index.php/helloworld/edit_data/".$mahasiswa->no_induk; ?>">Edit</td>
            <td><a class="btn btn-danger" href="<?php echo base_url()."index.php/helloworld/delete_data/".$mahasiswa->no_induk; ?>">Delete</td>
        </tr>
        <?php } ?>
    </table>
     <?php
        echo $this->pagination->create_links();
    ?>
    
</body>
</html>