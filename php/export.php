<?php
require "db_connection.php";
require "PHPExcel.php";
// $test = fetchAll("select * FROM unit_sys")
if ($con) {
    $query = "SELECT * FROM team_sys_manager";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// print_r($data);
$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('Nhom_he_thong');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

//Xét in đậm cho khoảng cột

$excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
$excel->getActiveSheet()->setCellValue('A1', 'id');
$excel->getActiveSheet()->setCellValue('B1', 'Tên nhom hệ thống');
$excel->getActiveSheet()->setCellValue('C1', 'loai');
$excel->getActiveSheet()->setCellValue('D1', 'Tai lieu');
$excel->getActiveSheet()->setCellValue('E1', 'Người tạo');
$excel->getActiveSheet()->setCellValue('F1', 'Thời gian tạo');
// // dòng bắt đầu = 2

$numRow = 2;

foreach ($data as $row) {

    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['id_team_sys']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['name_team_sys']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['type_sys']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['describe_sys']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['create_by']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['created_at']);
    $numRow++;
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Nhom_he_thong_' . date("d.m.y") . '.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>