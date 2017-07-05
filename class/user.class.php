<?php
require_once("session.class.php");

class exUser_Profile{//สำหรับดึงข้อมูลฉลากขึ้นมาแสดง
	public $id;//User ID หากมีค่าเป็น 0 ให้ทำการ Logout
	public $Gender;//เพศ
	public $Status;//สถานะ
	public $Username;//Username สำหรับใช้ login
	public $Fullname;//ชื่อจริง
	public $Level;//ณะดับการเข้าถึงข้อมูล
	public $Under;//อยู่ภายใต้
	public $Eform;//สิทธิ์ในการเข้าถึง e-form
	public $Region;//ภาคที่สังกัด
	public $Province;//จังหวัดที่สังกัด
	public $Area;//พื้นที่ที่สังกัด
	public $Branch;//สาขาที่สังกัด
	public $RegionTXT;//ภาคที่สังกัด(ตัวหนังสือ)
	public $ProvinceTXT;//จังหวัดที่สังกัด(ตัวหนังสือ)
	public $AreaTXT;//พื้นที่ที่สังกัด(ตัวหนังสือ)
	public $BranchTXT;//สาขาที่สังกัด(ตัวหนังสือ)
	public $Email;//อีเมล์
	public $Tel;//หมายเลขโทรศัพท์
	public $Mobile;//หมายเลขโทรศัพท์มือถือ

	public function Load2Profile($DBData){
		$this->id = $DBData["member_id"];
		$this->firstname = $DBData["firstname"];
		$this->lastname = $DBData["lastname"];
		$this->nickname = $DBData["nickname"];
		$this->Group = $DBData["role_id"];
		$this->Department = $DBData["dep_id"];
		$this->Language = $DBData["lastlang"];
		$this->Picture = $DBData["userimg"];
		$this->Email = $DBData["useremail"];
		$this->Tel = $DBData["usertel"];
		$this->Region = $DBData["userRegion"];
		$this->Area = $DBData["userArea"];
		$this->CitizenID = $DBData["userIdentify"];
	}

	public function Loadpermission($ArrayData){
		$this->Permission = $ArrayData;
	}

	public function Export2JSON(){
		return json_encode($this);
	}
}

class exUser{//สำหรับดึงข้อมูลฉลากขึ้นมาแสดง
	public $id; //UserID
	public $firstname;//ชื่อจริง
	public $lastname;//นามสกุลจริง
	public $nickname;//ชื่อเล่น
	public $Group;//กลุ่มผู้ใช้
	public $Department;//แผนก ส่วนงาน
	public $Language;//ภาษาที่ใช้
	public $Picture;//ภาพโปรไฟล์
	public $Email;//email
	public $Tel;//หมายเลขติดต่อ
	public $Region;//ภาค
	public $Area;//พื้นที่
	public $CitizenID;//หมายเลขบัตรประชาชน
	public $Permission;//สิทธิ์ในการเข้าถึง

	function __construct() {//Initital variable in class
		if(!session_is_registered('Zonning')){
			session_is_registered('Zonning');
			$this->clearProfile();
			$this->SavetoSession();
		}else{
			$this->LoadFromSession();
		}
	}

	function __destruct(){
	}

	private function LoadFromSession(){
		$this->id = $_SESSION['Zonning']["id"];
		$this->firstname = $_SESSION['Zonning']["firstname"];
		$this->lastname = $_SESSION['Zonning']["lastname"];
		$this->nickname = $_SESSION['Zonning']["nickname"];
		$this->Group = $_SESSION['Zonning']["Group"];
		$this->Department = $_SESSION['Zonning']["Department"];
		$this->Language = $_SESSION['Zonning']["Language"];
		$this->Picture = $_SESSION['Zonning']["Picture"];
		$this->Email = $_SESSION['Zonning']["Email"];
		$this->Tel = $_SESSION['Zonning']["Tel"];
		$this->Region = $_SESSION['Zonning']["Region"];
		$this->Area = $_SESSION['Zonning']["Area"];
		$this->CitizenID = $_SESSION['Zonning']["CitizenID"];
		$this->Permission = $_SESSION['Zonning']["Permission"];
	}

        private function SavetoSession(){
		$_SESSION['Zonning']["id"] = $this->id;
		$_SESSION['Zonning']["firstname"] = $this->firstname;
		$_SESSION['Zonning']["lastname"] = $this->lastname;
		$_SESSION['Zonning']["nickname"] = $this->nickname;
		$_SESSION['Zonning']["Group"] = $this->Group;
		$_SESSION['Zonning']["Department"] = $this->Department;
		$_SESSION['Zonning']["Language"] = $this->Language;
		$_SESSION['Zonning']["Picture"] = $this->Picture;
		$_SESSION['Zonning']["Email"] = $this->Email;
		$_SESSION['Zonning']["Tel"] = $this->Tel;
		$_SESSION['Zonning']["Region"] = $this->Region;
		$_SESSION['Zonning']["Area"] = $this->Area;
		$_SESSION['Zonning']["CitizenID"] = $this->CitizenID;
		$_SESSION['Zonning']["Permission"] = $this->Permission;
	}

	private function clearProfile(){
		$this->id = 0;
		$this->firstname = "";
		$this->lastname = "";
		$this->nickname = "";
		$this->Group = 0;
		$this->Department = 0;
		$this->Language = "";
		$this->Picture = "";
		$this->Email = "";
		$this->Tel = "";
		$this->Region = "";
		$this->Area = "";
		$this->CitizenID = "";
		$this->Permission = array();
	}

	public function Login($status){	
		if($status == 1){
			$this->SavetoSession();
		}else{
			$this->clearProfile();
			$this->Message = "ไม่สามารถเข้าใช้งานได้";
		}
	}

	public function Logout(){
		$this->clearProfile();
		if(session_is_registered('Zonning')){
			session_unregister('Zonning');
		}
	}

	public function isCanAccess($PermissionID){
		return in_array($Permission,$this->Permission);
	}

	public function CanAccessEform(){
		return ($this->Eform==1);
	}

	public function GetJSONProfile(){
		return json_encode($this);
	}

	public function UpdateProfile($DBData){
		$this->id = $DBData["member_id"];
		$this->firstname = $DBData["firstname"];
		$this->lastname = $DBData["lastname"];
		$this->nickname = $DBData["nickname"];
		$this->Group = $DBData["role_id"];
		$this->Department = $DBData["dep_id"];
		$this->Language = $DBData["lastlang"];
		$this->Picture = $DBData["userimg"];
		$this->Email = $DBData["useremail"];
		$this->Tel = $DBData["usertel"];
		$this->Region = $DBData["userRegion"];
		$this->Area = $DBData["userArea"];
		$this->CitizenID = $DBData["userIdentify"];
	}
}

class exUser_Table{
        public $num_of_row;//จำนวนแถวของข้อมูลที่มีให้แสดง
        public $sum_of_row;//จำนวนแถวของข้อมูลทั้งหมดที่ดึงมาได้
        public $cur_page;//หน้าปัจจุบัน
        public $row_per_page;//จำนวนแถวของข้อมูลต่อ 1 หน้า
        public $data;//ข้อมูล เป็น array of class exReport_Cell

        function __construct() {//Initital variable in class
                $this->num_of_row = 0;
                $this->sum_of_row = 0;
                $this->cur_page = 1;
                $this->row_per_page = 0;
                $this->data = array();
        }

        function __destruct(){
                unset($this->data);
        }

	public function AddItem($id,$icon,$text){
		$CellObj = new exUser_Item;
		$CellObj->id = $id;
		$CellObj->icon = $icon;
		$CellObj->text = $text;
		array_push($this->data,$CellObj);
		$this->num_of_row++;
		return true;
        }

        public function Init($cur,$rpp,$sumrow){
                if($cur > $sumrow / $rpp){
                        $cur = ceil($sumrow / $rpp);
                }
                $this->cur_page = $cur;
                $this->row_per_page = $rpp;
                $this->sum_of_row= $sumrow;
        }
}

class exUser_Item{
        public $id; //id ของ user จะถูกนำไปใช้เรียก getdata อีกที
        public $icon;//บอกว่าเป็นเพศใด 0=หญิง 1=ชาย
        public $text;//ข้อความที่แสดง (ชื่อ - นามสกุล)
}
?>
