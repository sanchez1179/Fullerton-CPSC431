<?php
$students = fopen("student.txt", "r") or die("Unable to open file.");
$lines = fread($students, filesize("student.txt"));
$exploded = explode("\n",$lines);

class Student
{
    public $id;
    public $first;
    public $last;
    public $middle;

    public function __construct($id, $first, $middle, $last)
    {
        $this->id = $id;
        $this->first = $first;
        $this->last = $last;
        $this->middle = $middle;
    }
}

$students = [];
foreach($exploded as $row)
{
  if ($row != "")
  {
      list($id,$lname,$fmname) = explode(",", $row);

      if (preg_match('/\s/', $fmname))
      {
        list($fname,$mname) = explode(" ", $fmname);
      }
      else
      {
        $fname = $fmname;
        $mname = "";
      }

      $student = new Student($id, $fname, $mname, $lname);

      $students[] = $student;
  }
}

$ismatch = false;
foreach ($students as $key => $studentz)
{
    
    if ((isset($_POST['id']) && $_POST['id'] == $studentz->id) ||
        (isset($_POST['firstname']) && $_POST['firstname'] == $studentz->first) ||
        (isset($_POST['lastname']) && $_POST['lastname'] == $studentz->last)) {

        echo "$studentz->id, $studentz->last, $studentz->first" ." $studentz->middle";
        echo '<br><hr><br>';
        $ismatch = true;
    }



}
if ($ismatch == false)
{
  echo "<h1>Your search did not return any records</h1>";
}

?>
