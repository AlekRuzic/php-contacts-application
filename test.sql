SELECT ad_type, ad_line_1, ad_line_2, ad_line_3, ad_city, ad_province, ad_post_code, ad_country, em_type, em_email, no_note, ph_type, ph_number, we_type, we_url
FROM contact
    INNER JOIN contact_address ON contact.ct_id = contact_address.ad_ct_id
    INNER JOIN contact_email ON contact.ct_id = contact_email.em_ct_id
    INNER JOIN contact_note ON contact.ct_id = contact_note.no_ct_id
    INNER JOIN contact_phone ON contact.ct_id = contact_phone.ph_ct_id
    INNER JOIN contact_web ON contact.ct_id = contact_web.we_ct_id
WHERE ct_id = 1 AND ct_deleted = 0;
