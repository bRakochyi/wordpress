<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Масив ролей, які потрібно видалити
$roles_to_remove = [
    'manager_postachaniia',
    'office_admin',
    'ing_comp_sys',
    'designer_graf',
    'manager_zbutu',
    'marketolog',
    'bukhhalter',
    'region_manager_zbutu',
    'economist',
    'nachalnic_viddilu',
    'zav_po_hosp',
    'el_mont_rozpod_pr',
    'ingener_construct',
    'golov_komirnuk',
    'starsh_komirnuk',
    'komirnuk',
    'director',
    'zastup_directora',
    'admin_amperok',
    'paymaster_zalu',
    'vodiy',
    'dispetcher',
    'іngener_praci',
    'mekhanik',
    'ekspeditor',
    'medsestra',
    'logist',
    'programist',
    'mont_radioel_pr'
];

// Видаляємо ролі
foreach ($roles_to_remove as $role) {
    if (get_role($role)) {
        remove_role($role);
    }
}
