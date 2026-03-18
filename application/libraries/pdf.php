<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
    public function generate($html, $filename) {
        $options = new Options();
        $options->set('isRemoteEnabled', true); 
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    }
}