<?php
function editContact($contact_id){
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

    //get contact values and store in session superglobal
    $rs = $db_conn->query($qry);
    if ($rs->num_rows > 0){
        while ($row = $rs->fetch_assoc()){
                foreach ($row as $key => $value) {
                    $_SESSION["$key"] = $value;
                }
        }

        //display all forms with textboxes populated by session values
        $_SESSION['mode'] = 'Add';
        $_SESSION['editing'] = true;
        $_SESSION['add_part'] = 1;
        echo "<h1>Edit Contact</h1>";
        formContactType();
    }
}

function updateContact($db_conn){
	$qry_ct = "update contact set ct_type='".$db_conn->real_escape_string($_SESSION['ct_type'])."'";
	if (isset($_SESSION['ct_first_name'])){
		$qry_ct .= ", ct_first_name='".$db_conn->real_escape_string($_SESSION['ct_first_name'])."'";
	} else {
		$qry_ct .= ", ct_first_name=''";
	}
	if (isset($_SESSION['ct_last_name'])){
		$qry_ct .= ", ct_last_name='".$db_conn->real_escape_string($_SESSION['ct_last_name'])."'";
	} else {
		$qry_ct .= ", ct_last_name=''";
	}
	if (isset($_SESSION['ct_disp_name'])){
		$qry_ct .= ", ct_disp_name='".$db_conn->real_escape_string($_SESSION['ct_disp_name'])."'";
	} else {
		$qry_ct .= ", ct_disp_name=''";
	}
    $qry_ct .= ", ct_deleted='N'";
        $qry_ct .= "where ct_id = ". $_SESSION['selected_id'].";";
	$db_conn->query($qry_ct);

	if (isset($_SESSION['ad_type'])){
		$qry_ad = "update contact_address set ad_type='".$db_conn->real_escape_string($_SESSION['ad_type'])."'";
		if (isset($_SESSION['ad_line_1'])){
			$qry_ad .= ", ad_line_1='".$db_conn->real_escape_string($_SESSION['ad_line_1'])."'";
		} else {
			$qry_ad .= ", ad_line_1=''";
		}
		if (isset($_SESSION['ad_line_2'])){
			$qry_ad .= ", ad_line_2='".$db_conn->real_escape_string($_SESSION['ad_line_2'])."'";
		} else {
			$qry_ad .= ", ad_line_2=''";
		}
		if (isset($_SESSION['ad_line_3'])){
			$qry_ad .= ", ad_line_3='".$db_conn->real_escape_string($_SESSION['ad_line_3'])."'";
		} else {
			$qry_ad .= ", ad_line_3=''";
		}
		if (isset($_SESSION['ad_city'])){
			$qry_ad .= ", ad_city='".$db_conn->real_escape_string($_SESSION['ad_city'])."'";
		} else {
			$qry_ad .= ", ad_city=''";
		}
		if (isset($_SESSION['ad_province'])){
			$qry_ad .= ", ad_province='".$db_conn->real_escape_string($_SESSION['ad_province'])."'";
		} else {
			$qry_ad .= ", ad_province=''";
		}
		if (isset($_SESSION['ad_post_code'])){
			$qry_ad .= ", ad_post_code='".$db_conn->real_escape_string($_SESSION['ad_post_code'])."'";
		} else {
			$qry_ad .= ", ad_post_code=''";
		}
		if (isset($_SESSION['ad_contry'])){
			$qry_ad .= ", ad_country='".$db_conn->real_escape_string($_SESSION['ad_country'])."'";
		} else {
			$qry_ad .= ", ad_country=''";
		}
        $qry_ad .= ", ad_active='Y'";
        $qry_ad .= "where ad_ct_id = ". $_SESSION['selected_id'].";";
		$db_conn->query($qry_ad);
	}
	if (isset($_SESSION['ph_type'])){
		$qry_ph = "update contact_phone set ph_type='".$db_conn->real_escape_string($_SESSION['ph_type'])."'";
		if (isset($_SESSION['ph_number'])){
			$qry_ph .= ", ph_number='".$db_conn->real_escape_string($_SESSION['ph_number'])."'";
		} else {
			$qry_ph .= ", ph_number=''";
		}
        $qry_ph .= ", ph_active='Y'";
        $qry_ph .= "where ph_ct_id = ". $_SESSION['selected_id'].";";
		$db_conn->query($qry_ph);
	}
	if (isset($_SESSION['em_type'])){
		$qry_em = "update contact_email set em_type='".$db_conn->real_escape_string($_SESSION['em_type'])."'";
		if (isset($_SESSION['em_email'])){
			$qry_em .= ", em_email='".$db_conn->real_escape_string($_SESSION['em_email'])."'";
		} else {
			$qry_em .= ", em_email=''";
		}
        $qry_em .= ", em_active='Y'";
        $qry_em .= "where em_ct_id = ". $_SESSION['selected_id'].";";
		$db_conn->query($qry_em);
	}
	if (isset($_SESSION['we_type'])){
		$qry_we = "update contact_web set we_type='".$db_conn->real_escape_string($_SESSION['we_type'])."'";
		if (isset($_SESSION['we_url'])){
			$qry_we .= ", we_url='".$db_conn->real_escape_string($_SESSION['we_url'])."'";
		} else {
			$qry_we .= ", we_url=''";
		}
        $qry_we .= ", we_active='Y'";
        $qry_we .= "where we_ct_id = ". $_SESSION['selected_id'].";";
		$db_conn->query($qry_we);
	}
	if (isset($_SESSION['no_note'])){
		$qry_no = "update contact_note set no_type=''";
        $qry_no .= ", no_note='".$db_conn->real_escape_string($_SESSION['no_note'])."'";
        $qry_no .= "where no_ct_id = ". $_SESSION['selected_id'].";";
		$db_conn->query($qry_no);
	}
}
?>