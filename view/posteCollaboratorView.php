<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<div class="scrolling-wrapper">
<table id="tablestudents" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th class="no-sorting">Section</th>
                <th class="no-sorting"></th>
            </tr>
        </thead>
        <tbody>

        <?php 

        var_dump($collaborators);
        if(isset($_GET['id']) && isset($_GET['action']))
        {
            echo ($_GET['id'].' + '.$_GET['action']);
        }
        var_dump($_POST);
        if(isset($_POST['collaborators']))
        {

        }

        echo('<pre>');
        foreach($collaborators as $collaborator)
        {

            echo'
                <tr>
                    <td>'.$collaborator['colName'].'</td>
                    <td>'.$collaborator['colLastname'].'</td>
                    <td>'.$collaborator['colEmail'].'</td>
                    <td>'.$collaborator['secName'].'</td>
                    <td class="text-center">
                    ';
                    echo'
                        <a href="index.php?page=poste&action=add&id='.$collaborator['idCollaborator'].'" ><i class="fas fa-user-plus"></i></a>
                        <a href="#" class="red"><i class="fas fa-user-minus"></i></a>
                    </td>
            </tr>
            ';
        }
        ?>

        <tfoot>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th class="no-sorting">Section</th>
                <th class="no-sorting"></th>
            </tr>
        </tfoot>
    </table>

    <!-- <ul class="list-group">
            <li class="list-group-item"><h5 class="modal-title">Modal title</h5></li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul> -->
        <br>

<!-- 
        <br>
        <div class="card w-50">
            <div class="card-header">
                <div class="row">
                    <div class="col text-left">
                        <h5 class="modal-title">Poste 2</h5>
                    </div>
                    <div class="col text-right pt-1">
                        <a href="#"><i class="fas fa-pen" style="font-size:15px"></i></a>
                        <a href="#" class="ml-2"><i class="fas fa-times" style="font-size:18px"></i></a>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col text-left">Lylah Aldred</div>
                        <div class="col text-right font-weight-bold">Informatique</div>
                    </div>
                </li>
            </ul>
        </div>
        <br>
        <table class="table table-bordered">
  <thead>
    <tr class="card-header">
      <th scope="col" colspan="2" style="border-right:transparent;">Poste 1</th>
      <td class="text-right" style="border-left:transparent;">
        <a href="#"><i class="fas fa-pen" style="font-size:15px"></i></a>
        <a href="#" class="ml-2"><i class="fas fa-times" style="font-size:18px"></i></a></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
  </tbody>
</table> -->
</div>
    <script>
    function deletestudent(idstudent, studentname)
        {
            if(confirm("Voulez-vous vraiment supprimer " + studentname + " ?"))
            {
                window.location.replace('index.php?page=delete&id='+idstudent);
            }else
            {
            }
        }
   
    $(document).ready(function() {
        var myTable = $('#tablestudents').DataTable();
    });
    </script>