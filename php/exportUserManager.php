<?php
require "db_connection.php";
require "PHPExcel.php";
if ($con) {
    $query = "SELECT * FROM user_manager";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('Danh_sach_quan_tri');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);

//Xét in đậm cho khoảng cột

$excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
$excel->getActiveSheet()->setCellValue('A1', 'id quản trị');
$excel->getActiveSheet()->setCellValue('B1', 'Tên');
$excel->getActiveSheet()->setCellValue('C1', 'Sđt');
$excel->getActiveSheet()->setCellValue('D1', 'Gmail');
$excel->getActiveSheet()->setCellValue('E1', 'Phòng');
$excel->getActiveSheet()->setCellValue('F1', 'Chức vụ');
$excel->getActiveSheet()->setCellValue('G1', 'Người tạo');
$excel->getActiveSheet()->setCellValue('H1', 'Thời gian tạo');
// // dòng bắt đầu = 2

$numRow = 2;

foreach ($data as $row) {

    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['id_user_manager']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['name_user_manager']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['sdt']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['gmail']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['room']);
    $excel->getActiveSheet()->setCellValue('F' . $numRow, $row['position_manager']);
    $excel->getActiveSheet()->setCellValue('G' . $numRow, $row['create_by']);
    $excel->getActiveSheet()->setCellValue('H' . $numRow, $row['created_at']);    
    $numRow++;
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Danh_sach_quan_tri_' . date("d.m.y") . '.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>