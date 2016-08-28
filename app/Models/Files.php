<?php
namespace Diskourse\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Files extends Model
{

	protected $table = 'filesinfo';

	protected $fillable = [
                'filepath',
                'faculty', 
                'subject',
                'size',
                'extension',
    ];

    

    public function getPath()
    {

    	return $this->filepath;
    }

    public function getFacultyName()
    {
        return $this->faculty;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getExtension()
    {

    }

}
