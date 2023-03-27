<?php
  
// The location of the PDF file
// on the server

    // Header content type
    $filename = $_GET['filename'];
    $extension = pathinfo($filename);

    $mimeType = '';
    switch ($extension['extension']) {
        case 'pdf':
            $mimeType = 'pdf';
            break;
        case 'doc':
            $mimeType = 'msword';
            break;
        case 'docx':
            $mimeType = 'vnd.openxmlformats-officedocument.wordprocessingml.document';
            header('Content-Disposition: attachment; filename="' . $extension['basename'] . '"');
            break;
        case 'xls':
            $mimeType = 'vnd.ms-excel';
            header('Content-Disposition: attachment; filename="' . $extension['basename'] . '"');
            break;
        case 'xlsx':
            $mimeType = 'vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            header('Content-Disposition: attachment; filename="' . $extension['basename'] . '"');
            break;
        case 'ppt':
            $mimeType = 'vnd.ms-powerpoint';
            header('Content-Disposition: attachment; filename="' . $extension['basename'] . '"');
            break;
        case 'pptx':
            $mimeType = 'vnd.openxmlformats-officedocument.presentationml.presentation';
            header('Content-Disposition: attachment; filename="' . $extension['basename'] . '"');
            break;
    }       
    header('Content-type: application/' . $mimeType);
    
    header("Content-Length: " . filesize($filename));

    
    // Send the file to the browser.
    readfile($filename);

?> 