<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<div class="scrolling-wrapper">
    <div class="py-4 text-center">
    <h1>Liste des élèves</h1>
    </div>
<table id="tablestudents" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Classe</th>
                <th>Section</th>
                <th class="no-sorting"></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        // var_dump($consts);
        // echo('<pre>');
        // <td class="text-center"><img class="mb-3" src=\''.$consts['qrUrl'].$consts['qrSize'].'&data='.$consts['webUrl'].'?n='.$student['idStudent'].'\' alt=""></td>
        // <a href="index.php?page=edit&id='.$student['idStudent'].'"><i class="fas fa-pen" style="font-size:18px"></i></a>
                        // <a href="" onclick="deletestudent('.$student['idStudent'].',\''.$student['stuName'].'\')"><i class="fas fa-trash-alt" style="font-size:18px"></i></a>

        foreach($students as $student)
        {
            echo'
                <tr>
                    <td>'.$student['stuName'].'</td>
                    <td>'.$student['stuLastname'].'</td>
                    <td>'.$student['claName'].'</td>
                    <td>'.$student['secName'].'</td>
                    <td class="text-center">
                        <a href="index.php?page=details&id='.$student['idStudent'].'"><i class="fas fa-eye" style="font-size:20px"></i></a>
                        
                    </td>
            </tr>
            ';
        }
        ?>

        <tfoot>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Classe</th>
                <th>Section</th>
                <th class="no-sorting"></th>
            </tr>
        </tfoot>
    </table>
</div>

    <script>
    function deletestudent(idStudent, studentname)
        {
            if(confirm("Voulez-vous vraiment supprimer " + studentname + " ?"))
            {
                window.location.replace('index.php?page=delete&id='+idStudent);
            }else
            {
            }
        }
   
    $(document).ready(function() {
        var myTable = $('#tablestudents').DataTable();
    });
    </script>