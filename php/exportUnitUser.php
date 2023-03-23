<?php
require "db_connection.php";
require "PHPExcel.php";
if ($con) {
    $query = "SELECT * FROM unit_user";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('Danh_sach_don_vị_su_dung');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

//Xét in đậm cho khoảng cột

$excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
$excel->getActiveSheet()->setCellValue('A1', 'id đơn vị');
$excel->getActiveSheet()->setCellValue('B1', 'Tên đơn vị');
$excel->getActiveSheet()->setCellValue('C1', 'Tên phòng');
$excel->getActiveSheet()->setCellValue('D1', 'Người tạo');
$excel->getActiveSheet()->setCellValue('E1', 'Thời gian tạo');
// // dòng bắt đầu = 2

$numRow = 2;
foreach ($data as $row) {
    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['id_unit_user']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['name_unit_user']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['name_room_unit']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['create_by']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['created_at']);    
    $numRow++;
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Danh_sach_don_vị_su_dung_' . date("d.m.y") . '.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>