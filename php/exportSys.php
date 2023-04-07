<?php
require "db_connection.php";
require "PHPExcel.php";
if ($con) {   
    $query = "SELECT sys_ql.*, user_manager.name_user_manager, unit_user.name_unit_user, unit_sys.name_unit_sys,team_sys_manager.name_team_sys FROM sys_ql 
    JOIN user_manager ON sys_ql.user_manager_id = user_manager.id_user_manager 
    JOIN team_sys_manager ON team_sys_manager.id_team_sys = sys_ql.team_sys_id 
    JOIN unit_user ON unit_user.id_unit_user = sys_ql.unit_user_id 
    JOIN unit_sys ON unit_sys.id_unit_sys = sys_ql.unit_sys_id";
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
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('k')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
//Xét in đậm cho khoảng cột

$excel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
$excel->getActiveSheet()->setCellValue('A1', 'id hệ thống');
$excel->getActiveSheet()->setCellValue('B1', 'id đơn vị sử dụng');
$excel->getActiveSheet()->setCellValue('C1', 'id đơn vị quản lý');
$excel->getActiveSheet()->setCellValue('D1', 'id quản trị');
$excel->getActiveSheet()->setCellValue('E1', 'id nhóm hệ thống');
$excel->getActiveSheet()->setCellValue('F1', 'Tên hệ thống');
$excel->getActiveSheet()->setCellValue('G1', 'Tên nhóm hệ thống');
$excel->getActiveSheet()->setCellValue('H1', 'Tên người quản trị');
$excel->getActiveSheet()->setCellValue('I1', 'Tên đơn vị sử dụng');
$excel->getActiveSheet()->setCellValue('J1', 'Tên đơn vị quản trị');
$excel->getActiveSheet()->setCellValue('K1', 'Đầu số');
$excel->getActiveSheet()->setCellValue('L1', 'Mô tả');
$excel->getActiveSheet()->setCellValue('M1', 'Tài liệu');
$excel->getActiveSheet()->setCellValue('N1', 'IP');
$excel->getActiveSheet()->setCellValue('O1', 'Server');
$excel->getActiveSheet()->setCellValue('P1', 'Cấu hình');
$excel->getActiveSheet()->setCellValue('Q1', 'File mô tả');
$excel->getActiveSheet()->setCellValue('R1', 'Người tạo');
$excel->getActiveSheet()->setCellValue('S1', 'Thời gian tạo');
// // dòng bắt đầu = 2

$numRow = 2;

foreach ($data as $row) {

    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['id_sys']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['unit_user_id']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['user_manager_id']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['unit_sys_id']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['team_sys_id']);
    $excel->getActiveSheet()->setCellValue('F' . $numRow, $row['name_sys']);
    $excel->getActiveSheet()->setCellValue('G' . $numRow, $row['name_team_sys']);
    $excel->getActiveSheet()->setCellValue('H' . $numRow, $row['name_user_manager']);
    $excel->getActiveSheet()->setCellValue('I' . $numRow, $row['name_unit_user']);
    $excel->getActiveSheet()->setCellValue('J' . $numRow, $row['name_unit_sys']);
    $excel->getActiveSheet()->setCellValue('K' . $numRow, $row['first_number']);
    $excel->getActiveSheet()->setCellValue('L' . $numRow, $row['describe_sys']);
    $excel->getActiveSheet()->setCellValue('M' . $numRow, $row['document_sys']);
    $excel->getActiveSheet()->setCellValue('N' . $numRow, $row['ip_sys']);
    $excel->getActiveSheet()->setCellValue('O' . $numRow, $row['server_sys']);
    $excel->getActiveSheet()->setCellValue('P' . $numRow, $row['config_sys']);
    $excel->getActiveSheet()->setCellValue('Q' . $numRow, $row['file_des']);
    $excel->getActiveSheet()->setCellValue('R' . $numRow, $row['create_by']);
    $excel->getActiveSheet()->setCellValue('S' . $numRow, $row['created_at']);
    $numRow++;
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Danh_sach_he_thong_' . date("d.m.y") . '.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
