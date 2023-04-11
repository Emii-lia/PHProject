<?php 
session_start();

require('dbcon.php');
require('../function.php');

//Church

if(isset($_POST['save_church_btn']) && isset($_POST['design']) && isset($_POST['ideglise'])){

    $design = test_input($_POST['design']);
    $ideglise = test_input($_POST['ideglise']);

    $query = "INSERT INTO EGLISE (design, ideglise) VALUES (:design, :ideglise)";
    $query_run = $conn->prepare($query);

    $data = [
        ':design' => $design,
        ':ideglise' => $ideglise
    ];

    $query_execute = $query_run->execute($data);

    if($query_execute){
        $_SESSION['ch_message'] = "Church has been successfully registered!";
        $tag = "Successful!";
        $color = "green";
        header('Location: ../index.php');
        exit(0);
    }else{
        $_SESSION['ch_err_message'] = "Failed to register";
        header('Location: ../index.php');
        exit(0);
    }
}


//Income
if (isset($_POST['save_income_btn'])) {
    
    if(isset($_POST['save_income_btn']) && isset($_POST['motif']) && isset($_POST['montantEntre']) && (isset($_POST['dateEntre']) && $_POST['dateEntre'] <= date('Y-m-d')) && isset($_POST['id'])){
        $motif = test_input($_POST['motif']);
        $montant_entree = test_input($_POST['montantEntre']);
        $date_entree = $_POST['dateEntre'];
        $id_eglise = test_input($_POST['id']);
        $query = "INSERT INTO ENTREE (ideglise, motif, montantEntre, dateEntre) VALUES (:ideglise, :motif, :montantEntre, :dateEntre)";
        $query_run = $conn->prepare($query);
        
        
        $income_data = [
            ":ideglise" => $id_eglise,
            ":motif" => $motif,
            ":montantEntre" => $montant_entree,
            ":dateEntre" => $date_entree,
        ];
        
        $query_execute = $query_run->execute($income_data);
        
        $query_2 = "SELECT solde FROM EGLISE WHERE ideglise = ?";
        $query_2_run = $conn->prepare($query_2);
        $query_2_execute = $query_2_run->execute([$id_eglise]);
        $row = $query_2_run->fetch();
        $solde_actuel = $row['solde'];

        //calcul nouveau solde

        $nouveau_solde = $solde_actuel + $montant_entree;

        //maj solde

        $query_3 = "UPDATE EGLISE SET solde = ? WHERE ideglise = ?";
        $query_3_run = $conn->prepare($query_3);
        $query_3_execute = $query_3_run->execute([$nouveau_solde, $id_eglise]);

        if($query_execute && $query_2_execute && $query_3_execute){
            $_SESSION['inc_message'] = "Income successfully added";
            header("Location: ../income.php?id=$id_eglise");
            exit(0);
        }else{
            $_SESSION['inc_err_message'] = "Failed to register income";
            header("Location: ../income.php?id=$id_eglise");
            exit(0);
        }

    }else {
        $id_eglise = $_POST['id'];
        // If informations don't matchs the conditions
        $_SESSION['inc_err_message'] = "Please make sure your datas are right";
        header("Location: ../income.php?id=$id_eglise");
        exit(0);
    }
}
//Cost

if (isset($_POST['save_cost_btn'])) {

    $id_eglise = $_POST['ideglise'];
    if(isset($_POST['save_cost_btn']) && isset($_POST['motif']) && isset($_POST['montantSortie']) && (isset($_POST['dateSortie']) && $_POST['dateSortie'] <= date('Y-m-d'))){
        $motif = $_POST['motif'];
        $montant_sortie = $_POST['montantSortie'];
        $date_sortie = $_POST['dateSortie'];
        $seuil = 10000;

        $get_solde = "SELECT solde FROM EGLISE WHERE ideglise = :id_eglise";
        $get_solde_run = $conn->prepare($get_solde);
        $data = [":id_eglise" => $id_eglise];
        $get_solde_run->execute($data);
        $row = $get_solde_run->fetch();
        $solde_actuel = $row['solde'];
        
        $reste = $solde_actuel - $montant_sortie;

        if($reste >= $seuil){
            $cost_add = "INSERT INTO SORTIE (ideglise, motif, montantSortie, dateSortie) VALUES (:ideglise, :motif, :montantSortie, :dateSortie)";
            $cost_add_run = $conn->prepare($cost_add);
                
                
            $cost_data = [
                ":ideglise" => $id_eglise,
                ":motif" => $motif,
                ":montantSortie" => $montant_sortie,
                ":dateSortie" => $date_sortie,
            ];
                
            $cost_added = $cost_add_run->execute($cost_data);
            
            //maj solde
            
            $church_update = "UPDATE EGLISE SET solde = :solde WHERE ideglise = :id_eglise";
            $church_update_run = $conn->prepare($church_update);

            $church_upd_data = [
                ":solde" => $reste,
                ":id_eglise" => $id_eglise,
            ];

            $church_updated = $church_update_run->execute($church_upd_data);
            
            if($cost_added && $church_updated){
                $_SESSION['out_message'] = "Outcomes successfully added to database";
                header("Location: ../costs.php?id=$id_eglise");
                exit(0);
            }else{
                $_SESSION['out_err_message'] = "Failed to insert data";
                header("Location: Location: ../costs.php?id=$id_eglise");
                exit(0);
            }
        }else{
            $_SESSION['out_err_message'] = "Sorry only $reste ariary left in your cash-box if you effectue this operation !";
                header("Location: ../costs.php?id=$id_eglise");
                exit(0);
        }

    }else {
        // If informations don't matchs the conditions
        $_SESSION['out_err_message'] = "Please make sure your datas are right";
        // $id_eglise = $_POST['ideglise'];
        header("Location: ../costs.php?id=$id_eglise");
        exit(0);
    }
}
//income_update

if(isset($_POST['update_income_btn'])){
    $id_entree = $_POST['identre'];
    $motif = $_POST['motif'];
    $montant_entree = $_POST['montantEntre'];
    $date_entree = $_POST['dateEntre'];
    $id_eglise = $_POST['ideglise'];

    //get previous montantEntre
    $query = "SELECT montantEntre FROM ENTREE WHERE identre = :id_entree";
    $query_run = $conn->prepare($query);

    $data = [":id_entree" => $id_entree];

    $query_run->execute($data);

    $row = $query_run->fetch();
    $old_montant_entree = $row['montantEntre'];

    //update ENTREE
    $query_2 = "UPDATE ENTREE SET ideglise = :id_eglise, motif = :motif, montantEntre = :montant_entree, dateEntre = :date_entree WHERE identre = :id_entree";
    $query_2_run = $conn->prepare($query_2);

    $upd_data = [
        ":id_eglise" => $id_eglise,
        ":motif" => $motif,
        ":montant_entree" => $montant_entree,
        ":date_entree" => $date_entree,
        ":id_entree" => $id_entree,
    ];

    $query_2_execute = $query_2_run->execute($upd_data);

    if($query_2_execute){
        //get solde
        $query_3 = "SELECT solde FROM EGLISE WHERE ideglise = :id_eglise";
        $query_3_run = $conn->prepare($query_3);
        $eg_upd_data = [":id_eglise" => $id_eglise,];
        $query_3_run->execute($eg_upd_data);
        $row = $query_3_run->fetch();
        $solde_actuel = $row['solde'];

        //soustraction du montantEntre precedent du solde
        $new_solde = $solde_actuel - $old_montant_entree + $montant_entree;

        //update solde
        $query_4 = "UPDATE EGLISE SET solde = :n_solde WHERE ideglise = :id_eglise";
        $query_4_run = $conn->prepare($query_4);
        $solde_upd_data = [
            ":n_solde" => $new_solde,
            ":id_eglise" => $id_eglise,
        ];
        $query_4_execute = $query_4_run->execute($solde_upd_data);

        if($query_4_execute){
           $_SESSION['message'] = "Updated successfully";
            header("Location: index.php");
            exit(0);
        }else{
            $_SESSION['message'] = "Nothing happens";
            header("Location: index.php");
            exit(0); 
        }
    }else{
        $_SESSION['message'] = "Update failed";
            header("Location: index.php");
            exit(0);
    }
}

//Cost update

if(isset($_POST['update_cost_btn'])){
    $id_sortie = $_POST['idsortie'];
    $motif = $_POST['motif'];
    $montant_sortie = $_POST['montantSortie'];
    $date_sortie = $_POST['dateSortie'];
    $id_eglise = $_POST['ideglise'];

    $query = "SELECT montantSortie FROM SORTIE WHERE idsortie = :id_sortie";
    $query_run = $conn->prepare($query);

    $data = [":id_sortie" => $id_sortie];
    
    $query_run->execute($data);

    $row = $query_run->fetch();
    $old_montant_sortie = $row['montantSortie'];

    $query_2 = "UPDATE SORTIE SET ideglise = :id_eglise, motif = :motif, montantSortie = :montant_sortie, dateSortie = :date_sortie WHERE idsortie = :id_sortie";
    $query_2_run = $conn->prepare($query_2);
    
    $cost_upd_data = [
        ":id_eglise" => $id_eglise,
        ":motif" => $motif,
        ":montant_sortie" => $montant_sortie,
        ":date_sortie" => $date_sortie,
        ":id_sortie" => $id_sortie,
    ];

    $query_2_execute = $query_2_run->execute($cost_upd_data);

    if($query_2_execute){
        $query_3 = "SELECT solde FROM EGLISE WHERE ideglise = :id_eglise";
        $query_3_run = $conn->prepare($query_3);
        $data_1 = [":id_eglise" => $id_eglise,];
        $query_3_run->execute($data_1);
        $row = $query_3_run->fetch();
        $solde_actuel = $row['solde'];


        $new_solde = $solde_actuel + $old_montant_sortie - $montant_sortie;

        // echo $solde_actuel."</br>";
        // echo $old_montant_sortie."</br>";
        // echo $montant_sortie."</br>";
        // echo $new_solde;

        $query_4 = "UPDATE EGLISE SET solde = :n_solde WHERE ideglise = :id_eglise";
        $query_4_run = $conn->prepare($query_4);

        $data_2 = [
            ":n_solde" => $new_solde,
            ":id_eglise" => $id_eglise,
        ];

        $query_4_execute = $query_4_run->execute($data_2);

        if ($query_4_execute){
            $_SESSION['message'] = "Updated successfully";
            header("Location: index.php");
            exit(0);
        }else{
            $_SESSION['message'] = "Nothing happens";
            header("Location: index.php");
            exit(0);
        }
    }else{  
        $_SESSION['message'] = "Update failed";
        header("Location: index.php");
        exit(0);
    }   
}


?>