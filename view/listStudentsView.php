<!-- 
    ETML
    Auteur : Larry Lam
    Date : 10.05.19
    Description : Affichage de la liste de tous les élèves
-->
<div class="scrolling-wrapper">
    <div class="py-4 text-center">
    <h1>Liste des élèves</h1>
    </div>
    <!-- Tableau avec la liste des étudiants -->
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
        //Pour chaque étudiant créer une ligne dans le tableau
        foreach($students as $student)
        {
            //Avec leurs informations telles que le nom, prénom, classe,  nom de la section
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
$(document).ready(function() {
    // Création de la dataTable avec la librairie DataTable.
    $('#tablestudents').DataTable();       
});
</script>