<?php
class FileReader{

    private $file;

    function __construct($file){
        $this->file = $file;
    }

    public function openFile(){
        
        if (!file_exists($this->file)) {
            exit("Your file doesn't exist");
        }        
        $this->file = fopen($this->file, "r") or die("Unable to open file!");
        
        return $this->file;
    }

    public function csvFileReader($csv_file){
        
        $csv_file = fgetcsv($csv_file);
        if(false === $csv_file) {
            exit("Could not open $csv_file for reading");
        }
        
        return $csv_file;
    }
}