<?php
function displayDetails($contact_id){
    $db_conn = new mysqli('localhost', 'lamp1user', '!Lamp1!', 'week7');
    if ($db_conn->connect_errno) {
        printf ("Could not connect to database server \n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
    }

     $qry = "SELECT ct_type, ct_first_name, ct_last_name, ct_disp_name, ad_type, ad_line_1, ad_line_2, ad_line_3, ad_city, ad_province, ad_post_code, ad_country, em_type, em_email, no_note, ph_type, ph_number, we_type, we_url
                FROM contact
                    INNER JOIN contact_address ON contact.ct_id = contact_address.ad_ct_id
                    INNER JOIN contact_email ON contact.ct_id = contact_email.em_ct_id
                    INNER JOIN contact_note ON contact.ct_id = contact_note.no_ct_id
                    INNER JOIN contact_phone ON contact.ct_id = contact_phone.ph_ct_id
                    INNER JOIN contact_web ON contact.ct_id = contact_web.we_ct_id
                WHERE ct_id = $contact_id AND ct_deleted = 0;";

    $rs = $db_conn->query($qry);
    if ($rs->num_rows > 0){
        echo "<h1>Contact Details</h1>\n";
        echo "<table border=\"1\">\n";
            while ($row = $rs->fetch_assoc()){
                echo "<tr><td>Contact Type</td><td>";
                echo $row['ct_type'];
                echo "</td><tr>";
                echo "<tr><td>First Name</td><td>";
                echo $row['ct_first_name'];
                echo "</td><tr>";
                echo "<tr><td>Last Name</td><td>";
                echo $row['ct_last_name'];
                echo "</td><tr>";
                echo "<tr><td>Display Name</td><td>";
                echo $row['ct_disp_name'];
                echo "</td><tr>";
                echo "<tr><td>Address Type</td><td>";
                echo $row['ad_type'];
                echo "</td><tr>";
                echo "<tr><td>Address Line 1</td><td>";
                echo $row['ad_line_1'];
                echo "</td><tr>";
                echo "<tr><td>Address Line 2</td><td>";
                echo $row['ad_line_2'];
                echo "</td><tr>";
                echo "<tr><td>Address Line 3</td><td>";
                echo $row['ad_line_3'];
                echo "</td><tr>";
                echo "<tr><td>City</td><td>";
                echo $row['ad_city'];
                echo "</td><tr>";
                echo "<tr><td>Province</td><td>";
                echo $row['ad_province'];
                echo "</td><tr>";
                echo "<tr><td>Postal Code</td><td>";
                echo $row['ad_post_code'];
                echo "</td><tr>";
                echo "<tr><td>Country</td><td>";
                echo $row['ad_country'];
                echo "</td><tr>";
                echo "<tr><td>Email Type</td><td>";
                echo $row['em_type'];
                echo "</td><tr>";
                echo "<tr><td>Email</td><td>";
                echo $row['em_email'];
                echo "</td><tr>";
                echo "<tr><td>Note</td><td>";
                echo $row['no_note'];
                echo "</td><tr>";
                echo "<tr><td>Phone Type</td><td>";
                echo $row['ph_type'];
                echo "</td><tr>";
                echo "<tr><td>Phone Number</td><td>";
                echo $row['ph_number'];
                echo "</td><tr>";
                echo "<tr><td>Website Type</td><td>";
                echo $row['we_type'];
                echo "</td><tr>";
                echo "<tr><td>Website URl</td><td>";
                echo $row['we_url'];
                echo "</td><tr>";
                echo "</table>";

                echo "<form method='POST'><input type='submit' name='ct_b_back' value='Back'/></form>";
        }
    }
}

?>