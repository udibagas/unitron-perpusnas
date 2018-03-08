<?php
error_reporting(0);
ob_start();
if (!isset($_GET['id'])) {
    header('Location:index.php');
    exit();
}
include "app_global.php";
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
$ruang_id = $konek->real_escape_string(trim($_GET['id']));
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("UNITRON");
$objPHPExcel->getProperties()->setLastModifiedBy("UNITRON");
$objPHPExcel->setActiveSheetIndex(0);

$ruang=$_GET['log_id'];
if($ruang!=null){
$sql = "SELECT
product.product_registration_code,
brands.brand_name,
product.product_model,
product.product_sn,
product.product_receive_date,
product.product_contract_num,
product.product_contract_date,
product.product_price,
product.product_warranty_exp_date,
product.product_rent_exp_date,
product.product_note,
product_condition.product_condition_name,
product_ownership.product_ownership_name,
countries.country_name,
sub_ruang.sub_ruang_name
FROM
product
INNER JOIN brands ON brands.brand_id = product.brand_id
INNER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
INNER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
INNER JOIN countries ON product.country_code = countries.country_code
INNER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id WHERE 
    product.product_deleted = '0' AND sub_ruang.ruang_id='$ruang' ";
}else{
	
$sql = "SELECT
product.product_registration_code,
brands.brand_name,
product.product_model,
product.product_sn,
product.product_receive_date,
product.product_contract_num,
product.product_contract_date,
product.product_price,
product.product_warranty_exp_date,
product.product_rent_exp_date,
product.product_note,
product_condition.product_condition_name,
product_ownership.product_ownership_name,
countries.country_name,
sub_ruang.sub_ruang_name
FROM
product
INNER JOIN brands ON brands.brand_id = product.brand_id
INNER JOIN product_condition ON product_condition.product_condition_id = product.product_condition_id
INNER JOIN product_ownership ON product_ownership.product_ownership_id = product.product_ownership_id
INNER JOIN countries ON product.country_code = countries.country_code
INNER JOIN sub_ruang ON sub_ruang.sub_ruang_id = product.sub_ruang_id WHERE 
    product.product_deleted = '0' ";	
	
}
$result = $konek->query($sql);
$fields = $result->fetch_fields();
$xls_col = 'A';
$xls_row = 1;
for ($i = 0; $i < $konek->field_count; $i++)
{
    $objPHPExcel->getActiveSheet()->setCellValue($xls_col.$xls_row, $fields[$i]->name);
    $xls_col++;
}
$xls_row = 2;
while ($row = $result->fetch_row()) {
    $xls_col = 'A';
    for ($i = 0; $i < $konek->field_count; $i++)
    {
        if (!isset($row[$i])) {
            $value = NULL;
        } elseif ($row[$i] != "") {
            $value = strip_tags($row[$i]);
        } else {
            $value = "";
        }
        $objPHPExcel->getActiveSheet()->setCellValue($xls_col.$xls_row, $value);
        $xls_col++;
    }
    $xls_row++;
}
// Uncomment 2 line below to export to the site directory
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save($ruang_id.'_'.time().'_'.date('Ymd').'.xlsx');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ruang_id.'_'.time().'_'.date('Ymd').'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');