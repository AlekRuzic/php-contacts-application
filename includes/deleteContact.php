<?php
function confirmDelete() {
    echo "Are you sure you want to delete this contact?";
    echo "<form method='POST'><input type='submit' name='Yes' value='Yes'/><input type='submit' name='No' value='No'/></form>";

    if (isset($_POST['Yes'])) {
        deleteContact();
    } else  if (isset($_POST['No']) || (isset($_POST['Home']))) {
        $_SESSION['add_part'] = 0;
	    $_SESSION['mode'] = "Display";
    }
}

function deleteContact() {
    $db_conn = new mysqli('localhost', 'lamp1user', '!Lamp1!', 'week7');
    if ($db_conn->connect_errno) {
        printf ("Could not connect to database server \n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
    }

    $qry = "update contact set ct_deleted='Y' where ct_id=".$_SESSION['selected_id'].";";
    $db_conn->query($qry);

    $qry = "update contact_address set ad_active='N' where ad_ct_id=".$_SESSION['selected_id'].";";
    $db_conn->query($qry);

    $qry = "update contact_phone set ph_active='N' where ph_ct_id=".$_SESSION['selected_id'].";";
    $db_conn->query($qry);

    $qry = "update contact_email set em_active='N' where em_ct_id=".$_SESSION['selected_id'].";";
    $db_conn->query($qry);

    $qry = "update contact_web set we_active='N' where we_ct_id=".$_SESSION['selected_id'].";";
    $db_conn->query($qry);

    echo "Customer Deleted";
    echo "<form method='POST'><input type='submit' value='Home' name='Home'/></form>";
}


?>