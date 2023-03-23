<?php
require "db_connection.php";
require "PHPExcel.php";
// $test = fetchAll("select * FROM unit_sys")
if ($con) {
    $query = "SELECT * FROM manager_user";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// print_r($data);
$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('Danh_sach_nguoi_dung');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

//Xét in đậm cho khoảng cột

$excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
$excel->getActiveSheet()->setCellValue('A1', 'id');
$excel->getActiveSheet()->setCellValue('B1', 'Tên ');
$excel->getActiveSheet()->setCellValue('C1', 'sdt');
$excel->getActiveSheet()->setCellValue('D1', 'gmail');
$excel->getActiveSheet()->setCellValue('E1', 'Phòng');
$excel->getActiveSheet()->setCellValue('F1', 'Chức vụ');
$excel->getActiveSheet()->setCellValue('G1', 'Người tạo');
$excel->getActiveSheet()->setCellValue('H1', 'Thời gian tạo');
// // dòng bắt đầu = 2

$numRow = 2;

foreach ($data as $row) {

    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['id_user']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['name_user_manager']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['sdt']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['gmail']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['room']);
    $excel->getActiveSheet()->setCellValue('F' . $numRow, $row['positon_manager']);
    $excel->getActiveSheet()->setCellValue('G' . $numRow, $row['create_by']);
    $excel->getActiveSheet()->setCellValue('H' . $numRow, $row['created_at']);
    $numRow++;
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Danh_sach_nguoi_dung_' . date("d.m.y") . '.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>