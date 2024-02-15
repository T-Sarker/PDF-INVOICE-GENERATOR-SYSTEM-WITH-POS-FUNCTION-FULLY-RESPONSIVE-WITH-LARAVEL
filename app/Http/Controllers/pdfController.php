<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;
class pdfController extends Controller
{
    public function createpdf()
    {
      $pdf = PDF::loadView('cv');
      set_time_limit(300);
      // download PDF file with download method
      return $pdf->download('cv.pdf');
    }

    public function createdoc()
    {
      $templateProcessor = new TemplateProcessor('wordTemplates/Resume.docx');

      $templateProcessor->setValue('name','Tapos Kumar Sarker');
      $templateProcessor->setValue('smallText',htmlspecialchars("<FORMAT=B>some text</FORMAT>, consectetuer adipiscing elit"));
      $templateProcessor->setValue('experience1','Techdynobd, Banani — Web Developer MONTH 20XX - PRESENT Lorem ipsum dolor sit amet,consectetuer adipiscing elit, sed diam nonummy nibh.');
      $templateProcessor->setValue('experience2','IR Integrations,Jigatola — Web desinger MONTH 20XX - PRESENT Lorem ipsum dolor sit amet,consectetuer adipiscing elit, sed diam nonummy nibh.');
      $templateProcessor->setValue('experience3','Wp Redox,Jigatola — Web desinger MONTH 20XX - PRESENT Lorem ipsum dolor sit amet,consectetuer adipiscing elit, sed diam nonummy nibh.');
      $templateProcessor->setValue('skills','Tapos Lorem ipsum dolor sit amet.Consectetuer adipiscing elit.Sed diam nonummy nibh euismod tincidunt.L​​​‌​aoreet dolore magna aliquam erat volutpat.');
      $templateProcessor->setValue('companyLoc','MONTH 20XX - MONTH 20XX Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.');
      $inline = new TextRun();
      $inline->addText('by a red italic text', array('bold' => true, 'italic' => true, 'color' => 'blue', 'underline' => 'single'));
      $templateProcessor->setComplexValue('inline', $inline);

      $templateProcessor->saveAs('mycv'.'.docx');
      return response()->download('mycv'.'.docx')->deleteFileAfterSend(true);

    }
}
