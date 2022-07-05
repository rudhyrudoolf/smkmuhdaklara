<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>

    <style>
      html, body, #header {
        <?php if($flag == 'Mutasi'){?>
            margin:  2 0 0 0 !important;
        <?php } else {?>
            margin:  20 0 0 20 !important;
        <?php }?>
            padding: 0 !important;
            font-family: Courier, monospace;
            font-size: 11px;
        }
        thead{
            display:none;
        }
    </style>

</head>
<body>
<?php if($flag == 'Mutasi') { ?>
<table style="width:100%" cellspacing="0" >
    <thead>  
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Sandi</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody >
        <?php
            $no = 1;
            foreach($listData as $row): ?>
        <tr>
            <td width="8%" style="text-align:center"><?= $no++;?></td>
            <td width="11%" style="text-align:center"><?= $row['created_dt']?></td>
            <td width="8%" style="text-align:center"><?= $row['sandi']?></td>
            <td style="text-align:right;padding-right: 10px;"><?=$row['debit']?></td>
            <td style="text-align:right;padding-right: 10px;"><?= $row['kredit']?></td>
            <td style="text-align:right;padding-right: 10px;"><?= $row['saldo']?></td>
            <td width="11%" style="text-align:center"><?= $row['created_by']?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php } else {?>
    <table>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><?= $nis?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $nama?></td>
        </tr>
        <tr>
            <td>Nomor Rekening</td>
            <td>:</td>
            <td><?= $norek?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $alamat?></td>
        </tr>
    </table>
<?php }?>
</body>
</html>
