<?php
class siteuser
{
	var $uname,
		$pword,
		$fname,
		$lname,
		$role;
		
	public function siteuser($un='unknown', $pw='unknown', $fn='First', $ln='Last', $r='Guest')
	{
		$this->uname = $un;
		$this->pword = $pw;
		$this->fname = $fn;
		$this->lname = $ln;
		$this->role = $r;
	}
	
	public function fullName()
	{
		return $this->fname . " " . $this->lname;
	}
	
	public function alphabetical()
	{
		return $this->lname . ", " . $this->fname;
	}
}
?>