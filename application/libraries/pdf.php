<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
     public function generate($html, $filename = "document", $download = false) {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // If $download = true → force download
        // If $download = false → open in browser
        $dompdf->stream($filename . ".pdf", [
            "Attachment" => $download ? 1 : 0
        ]);
    }
    
}