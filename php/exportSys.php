<?php
require "db_connection.php";
require "PHPExcel.php";
if ($con) {
    $query = "SELECT * FROM sys_ql";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// print_r($data);
$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('Danh_sach_he_thong');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);

//Xét in đậm cho khoảng cột

$excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
$excel->getActiveSheet()->setCellValue('A1', 'id hệ thống');
$excel->getActiveSheet()->setCellValue('B1', 'Hệ thống');
$excel->getActiveSheet()->setCellValue('C1', 'Nhóm hệ thống');
$excel->getActiveSheet()->setCellValue('D1', 'Đầu số');
$excel->getActiveSheet()->setCellValue('E1', 'Đơn vị quản lý');
$excel->getActiveSheet()->setCellValue('F1', 'Người quản lý');
$excel->getActiveSheet()->setCellValue('G1', 'Mô tả');
$excel->getActiveSheet()->setCellValue('H1', 'Tài liệu');
$excel->getActiveSheet()->setCellValue('I1', 'Ip');
$excel->getActiveSheet()->setCellValue('J1', 'Server');
$excel->getActiveSheet()->setCellValue('K1', 'Cấu hình');
$excel->getActiveSheet()->setCellValue('L1', 'Thời gian tạo');
// // dòng bắt đầu = 2

$numRow = 2;

foreach ($data as $row) {

    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['id_sys']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['name_sys']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['name_team_sys']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['first_number']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['name_unit_manager']);
    $excel->getActiveSheet()->setCellValue('F' . $numRow, $row['name_user_manager']);
    $excel->getActiveSheet()->setCellValue('G' . $numRow, $row['describe_sys']);
    $excel->getActiveSheet()->setCellValue('H' . $numRow, $row['document_sys']);
    $excel->getActiveSheet()->setCellValue('I' . $numRow, $row['ip_sys']);
    $excel->getActiveSheet()->setCellValue('J' . $numRow, $row['server_sys']);
    $excel->getActiveSheet()->setCellValue('K' . $numRow, $row['config_sys']);
    $excel->getActiveSheet()->setCellValue('L' . $numRow, $row['created_at']);
    $numRow++;
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Danh_sach_he_thong_' . date("d.m.y") . '.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>