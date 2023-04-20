<?php
require "db_connection.php";
require "PHPExcel.php";
// $test = fetchAll("select * FROM unit_sys")
if ($con) {
    $query = "SELECT device_room.*, sys_room.name_room FROM device_room  JOIN sys_room ON sys_room.id_room = device_room.id_room";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// print_r($data);
$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('Danh_sach_thiet_bi_phong');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

//Xét in đậm cho khoảng cột

$excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
$excel->getActiveSheet()->setCellValue('A1', 'Tên phòng');
$excel->getActiveSheet()->setCellValue('B1', 'Tên phòng chuyển');
$excel->getActiveSheet()->setCellValue('C1', 'Tên thiết bị');
$excel->getActiveSheet()->setCellValue('D1', 'Mã thiết bị');
$excel->getActiveSheet()->setCellValue('E1', 'Trạng thái');
$excel->getActiveSheet()->setCellValue('F1', 'Thời gian tạo');
// // dòng bắt đầu = 2

$numRow = 2;

foreach ($data as $row) {

    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['name_room']);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['name_room_tran']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['name_device']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['code_device']);
    // $status = $item[2] == 1 ? 'hoạt động' : 'không hoạt động'; // Điều kiện để thay đổi giá trị trường trạng thái
    // $status = $item[2] == 1 ? 'hoạt động' : 'không hoạt động'; // Điều kiện để thay đổi giá trị trường trạng thái
    // $sheet->setCellValue('C' . $row, $status);
    switch ($row['status']) {
        case 0:
            $status = 'Không dùng';
            break;
        case 1:
            $status = 'Đang dùng';
            break;
        case 2:
            $status = 'Chuyển tiếp';
            break;
        default:
            $status = '';
            break;
    }
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $status);    
    $excel->getActiveSheet()->setCellValue('F' . $numRow, $row['created_at']);
    $numRow++;
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Danh_sach_thiet_bi_phong_' . date("d.m.y") . '.xlsx"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>