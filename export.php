dddddfffff
<?php 
require "php/db_connection.php";
// require "php/PHPExcel.php";
// $test = fetchAll("select * FROM unit_sys")
if($con) {   
    $query = "SELECT * FROM unit_sys";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);   
}
print[$data];


// $excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
// $excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
// $excel->getActiveSheet()->setTitle('test');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()

// $excel->getActiveSheet()->getColumnDimension(‘A’)->setWidth(20);

// $excel->getActiveSheet()->getColumnDimension(‘B’)->setWidth(20);

// $excel->getActiveSheet()->getColumnDimension(‘C’)->setWidth(30);

//Xét in đậm cho khoảng cột

// $excel->getActiveSheet()->getStyle(‘A1:C1’)->getFont()->setBold(true);

//Tạo tiêu đề cho từng cột
// $excel->getActiveSheet()->setCellValue('A1', 'id');
// $excel->getActiveSheet()->setCellValue('B1', 'Tên hệ thống');
// $excel->getActiveSheet()->setCellValue('C1', 'Tên phòng');
// $excel->getActiveSheet()->setCellValue('D', 'Người tạo');
// $excel->getActiveSheet()->setCellValue('E1', 'Thời gian tạo' );
// // dòng bắt đầu = 2

// $numRow = 2;

// foreach ($data as $row) {

//     $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['id_unit_sys']);
//     $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['[name_unit_sys']);
//     $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['name_room']);
//     $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['create_by']);
//     $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['created_at']);
//     $numRow++;
// }
// header('Content-type: application/vnd.ms-excel');
// header('Content-Disposition: attachment; filename="test'.time().'.xlsx"');
// PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>