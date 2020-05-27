<?php

namespace App\Http\Controllers;
use File;
use ZipArchive;
use App\Models\Emloyee;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    public function downloadZip(Request $req)
    {   extract($_POST);
        
      
        if(isset($createpdf))  
        {  
           
            if(extension_loaded('zip'))  
            {  
            // $fileName = 'myNewFile.zip';
                       // Checking ZIP extension is available  
           if(isset($files) && count($files) > 0)  
           {  
            $zip = new ZipArchive;
            $zip_name = time().".zip";
       
            if ($zip->open(public_path($zip_name), ZipArchive::CREATE) !==TRUE)
            {
                // Opening zip file to load files  
                // print( "* Sorry ZIP creation failed at this time"); 
            }
            
                
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
             
            $zip->close();
            if(file_exists($zip_name)) {  
                 // push to download the zip  
                 header('Content-type: application/zip');  
                 header('Content-Disposition: attachment; filename="'.$zip_name.'"');  
                 readfile($zip_name);  
                 // remove zip file is exists in temp path  
                 unlink($zip_name);  
            } 


        }  else  {  
            // print("* Please select file to zip ");  
        }  
            
            } else {  
                //   print( "* You dont have ZIP extension");  
            }  
      
            
        }
    
        return response()->download(public_path($zip_name));
    }
    
}
