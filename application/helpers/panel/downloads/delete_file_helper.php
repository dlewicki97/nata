<?php
defined('BASEPATH') or exit('No direct script access allowed');


function delete_file($id): bool
{
    $CI = &get_instance();

    $download = $CI->back_m->get_one('downloads', $id);
    $uploads_dir = date('Y-m-d', strtotime($download->created));

    $delete_status = unlink(($file = __DIR__ . "/../../../../uploads/$uploads_dir/$download->raw_name") . $download->ext);
    if (file_exists($webp_type = "$file.webp")) unlink($webp_type);

    if ($delete_status) $CI->back_m->update('downloads', ['name_file_1' => '', 'name' => '', 'raw_name' => '', 'type' => '', 'size' => '', 'full_path' => '', 'file_path' => '', 'path' => ''], $id);

    $CI->session->set_flashdata('flashdata', $delete_status ? 'Pomyślnie usunięto plik!' : 'Nie udało się usunąć pliku...');

    return $delete_status;
}
