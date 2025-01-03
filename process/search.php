<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $search_term = strtolower($_POST['search-term']);

        switch($search_term) {
            case 'store': header("Location: ../pet_store.php"); exit; break;
            case 'pharmacy': header("Location: ../pharmacy.php"); exit; break;
            case 'services': header("Location: ../services_page.php"); exit; break;
            case 'groom': header("Location: ../groom.php"); exit; break;
            case 'walk': header("Location: ../walk.php"); exit; break;
            case 'hostel': header("Location: ../hostel.php"); exit; break;
            case 'vet': header("Location: ../vet.php"); exit; break;
            case 'food': header("Location: ../pet_store_products.php?section=food"); exit; break;
            case 'pet care': header("Location: ../pet_store_products.php?section=health"); exit; break;
            case 'treats': header("Location: ../pet_store_products.php?section=treat"); exit; break; 

            default: header("Location: ../index.php"); exit; break;
        }
    }
?>