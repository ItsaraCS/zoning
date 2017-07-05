<?php 

define("_DBZHOST","localhost");
define("_DBZUSER","excise");
define("_DBZPASSWORD","3ab3L175HfklTyRP");
define("_DBZNAME","Excise");

//Database Class
class ezDB{	
	
	private $db;	//Database connector
	private $SQL;	//Current SQL String
	private $Result;		//Current SQL Result
	private $Columns;		//Current Column in laat query result
	private $num_rows;		//Number of rows in last query
	private $affected_rows;	//Number of affected rows in last query
	
	private $tmpData;		//temporary data
	
	protected $DBStructure = array(
			//1st = datatype[i=int,d=decimal point,s=string,b=blob]; 2nd...lastest = field
                  "ACADAMY_ZONING" => "isssssdsdsdsddss,id,wkt_geom,NAME,TAMTNAME,AMPTNAME,PROVTNAME,BRANCHCODE,BRANCHTNAM,EXCISECODE,EXCISETNAM,REGCODE,REGTNAME,LAT,LONG,TYPE,REMARK",
                  "ADMINCODE" => "ddssddssdds,ID,TAMCODE,TAMTNAME,F4,ID1,DIST_CODE,DIST_TNAME,F8,ID2,PROVCODE,PROVTNAME",
                  "Academy" => "issssdsdsdsddssssssss,no,Name,TAMTNAME,AMPTNAME,Province,BRANCHCODE,BRANCHTNAM,EXCISECODE,EXCISETNAM,REGCODE,REGTNAME,Lat,Lon,Level,REMARK,Type,cdate,mdate,cby,mby,Address",
                  "Academy_Import" => "dssssdsdsdsddsss,ID,NAME,TAMTNAME,AMPTNAME,PROVTNAME,BRANCHCODE,BRANCHTNAM,EXCISECODE,EXCISETNAM,REGCODE,REGTNAME,LAT,LONG,types,TYPE,REMARK",
                  "Academy_Temp" => "dsssssddssss,no,Name,Address,Province,Type,Level,Lat,Lon,cdate,mdate,cby,mby",
                  "Bar_Data_New" => "isssssddssddsdsdsdsdsdssssss,ID,COM_NAME,CUS_NAME,SHOPTYPE,LIC_ID,ADDRESS,LAT,LONG,COORDINATE,SCHOOLNAME,DISTANCE_M,TAM_CODE,TAM_TNAME,AMP_CODE,AMP_TNAME,PROV_CODE,PROV_TNAME,BRANCHCODE,BRANCHTNAME,EXCISECODE,EXCISETNAME,REGCODE,REGNAME,REMARK,cdate,mdate,cby,mby",
                  "Bar_Data_New_Temp" => "issssssddssddsdsdsdsdsdssssss,ID,COM_NAME,CUS_NAME,SHOPTYPE,LIC_ID,LIC_ID2,ADDRESS,LAT,LONG,COORDINATE,SCHOOLNAME,DISTANCE_M,TAM_CODE,TAM_TNAME,AMP_CODE,AMP_TNAME,PROV_CODE,PROV_TNAME,BRANCHCODE,BRANCHTNAME,EXCISECODE,EXCISETNAME,REGCODE,REGNAME,REMARK,cdate,mdate,cby,mby",
                  "Bar_Data_Zoning_Mapping" => "iii,id,id_acadamy_zone,id_bar_data_new",
                  "Department_list" => "issssssiii,orderid,Department_id,Department_name,cdate,mddate,cby,mby,trash,dactive,type",
                  "EForm_Master_Head" => "issis,id,name,table_name,user_id_create,create_date",
                  "EForm_Master_Table_Column" => "ssssssiii,table_name,column_name,column_label,key_type,key_ref,data_type,data_length,require_column,require_input",
                  "EForm_Master_item" => "iissisi,id,fk_EForm_Master_Head_id,Field_name,Field_Label,Field_authorize,Modify_Date,on_active",
                  "EFrom_Master_Group" => "iii,id,EForm_Master_Head_id,User_id",
                  "Excise_AMPH" => "ddssssdd,ID,AMPHCODE,AMPHTNAME,AMPHENAME,PROV_TNAME,PROV_ENAME,Lat,Long",
                  "Excise_Area" => "ddsdsdsddssss,ID,REGCODE,REGTNAME,EXCISECODE,EXCISETNAME,PROVCODE,PROVTNAME,LAT,LONG,cdate,mdate,cby,mby",
                  "Excise_Branch" => "ddsdsdsdsdsddssss,ID,BRANCHCODE,BRANCHTNAME,EXCISECODE,EXCISETNAME,REGCODE,REGTNAME,AMPHCODE,AMPHTNAME,PROVCODE,PROVTNAME,LAT,LONG,cdate,mdate,cby,mby",
                  "Excise_Data" => "issssddssssssssssssss,ID,NAME,ADDRESS,CONTACT,PHONE,LAT,LON,ADMIN_CODE,TAM_CODE,TAM_TNAME,TAM_ENAME,AMP_CODE,AMP_TNAME,AMP_ENAME,PROV_CODE,PROV_TNAME,PROV_ENAME,REG_CODE,REG_TNAME,REG_ENAME,POSTCODE",
                  "Excise_Head_Office" => "ddssssddssdssdssdssdddssss,ID,EXCISECODE,NAME,ADDRESS,CONTACT,PHONE,ADMIN_CODE,TAM_CODE,TAM_TNAME,TAM_ENAME,AMP_CODE,AMP_TNAME,AMP_ENAME,PROV_CODE,PROV_TNAME,PROV_ENAME,REG_CODE,REG_TNAME,REG_ENAME,POSTCOD,LAT,LONG,cdate,mdate,cby,mby",
                  "Excise_License" => "issdssssddssssdssssdssssssssssssssssssssddsssss,id,DOC_NO,DOC_TYPE,LINE_NO,LIC_NO,LIC_BOOK,LIC_TYPE,LIC_CODE,LIC_SEQ,LIC_PRICE,LIC_DATE,START_DATE,EXP_DATE,CUS_ID,CUS_ADDRSEQ,CUS_TITLE,CUS_NAME,CUS_SURNAME,FAC_ID,FAC_ADDRSEQ,COM_TITLE,COM_NAME,COM_SURNAME,TIN,PIN,BUILDING,FLOORNO,ROOMNO,VILLAGE,ADDNO,MOONO,SOINAME,THNNAME,TAMBOL_CODE,TAMBOL_NAME,AMPHUR_NAME,PROVINCE_NAME,POSCODE,OFFCODE,OFFNAME,Lat,Lon,F42,cdate,mdate,cby,mby",
                  "Excise_Marker" => "isssss,id,marker_name,marker_image,create_date,modify_date,marker_group",
                  "Excise_Province" => "ddssdsdd,ID,PROVCODE,PROVTNAME,PROVENAME,REGCODE,REGTNAME,LAT,LONG",
                  "Excise_REGION" => "ddsdd,ID,REG_CODE,REG_TNAME,LAT,LONG",
                  "Excise_Subdistrict" => "ddssssssdd,ID,SDIST_CODE,SDIST_TNAME,SDIST_ENAME,DIST_TNAME,DIST_ENAME,PROV_TNAME,PROV_ENAME,Lat,Long",
                  "Information_excise_registration" => "issssssddssss,id,regis_number,name,address,fac_name,fac_address,type,lat,lon,cdate,mdate,cby,mby",
                  "Standard_Question" => "iss,QID,Qname,Qtype",
                  "Standard_Question_Log" => "iiiidssss,data_id,eform_id,eform_data_id,sq_id,sdata,cdate,cby,mdate,mby",
                  "University_Polygon" => "isssssddds,ID,wkt_geom,NAME,ADDRESS,PROVINCE,TYPE,LAT,LON,Area,Type1",
                  "access_data" => "issiiiiiiiii,accessid,accessname,accessType,iindex,c_print,c_report,c_add,c_del,c_edit,c_viewmap,c_markmap,c_viewdetail",
                  "answer" => "iisss,answer_id,question_log_id,answer,modified_date,modified_by",
                  "back_up_illigal" => "dssssssssssssssssdsdd,id,TYPE,REG_CODE,REG_TNAME,UPD_DATE,LIC_ID,CHARGE_NAME,SUSPECTS_NAME,HOUSE_NO,OTHER,SOINAME,THNNAME,MOONO,TAM_TNAME,AMP_TNAME,PROV_TNAME,EVIDENCE,FINE,REMARK,LAT,LONG",
                  "check_login" => "ssss,username,activekey,device,adate",
                  "choice" => "iississ,choice_id,question_id,value,type,active,modified_date,modified_by",
                  "eform" => "isssssssssiii,eform_id,code,name,create_date,create_by,status,desc,update_by,update_date,trash,nextstep,parent,markerid",
                  "eform_data" => "iissssis,eform_data_id,eform_id,cdate,cby,mdate,mby,trash,geo_group",
                  "eform_data_running" => "i,eform_data_id",
                  "eform_file" => "iisssdssis,id,eform_data_id,file_name,file_path,file_type,filesize,cdate,cby,trash,trashdate",
                  "eform_line" => "issiissssssss,eform_line_id,eform_line_code,eform_code,eform_id,question_form_id,activity,create_by,create_date,update_by,update_date,trash,trash_by,trash_date",
                  "geometry_data" => "issssssds,geo_id,geo_group,geo_name,geo_type,geo_data,create_date,circle_center,circle_radius,color",
                  "illigal_nopoint" => "dssssssdddddddsdsdsdsssdsddsssss,id,DateApprove,CHARGE_NAME,SUSPECTS_NAME,Address,allegation,EVIDENCE,Fine,court,employee,boodle,Reward,Remit,TAM_CODE,TAM_TNAME,AMP_CODE,AMP_TNAME,PROV_CODE,PROV_TNAME,BRANCHCODE,BRANCHTNAME,EXCISECODE,EXCISETNAME,REGCODE,REGNAME,LAT,LONG,cdate,mdate,cby,mby,TYPE",
                  "member" => "issssisi,Id,username,password,cdate,mdate,active,lastedit,trash",
                  "member_detail" => "isssssssssssss,member_id,username,firstname,lastname,nickname,role_id,dep_id,lastlang,userimg,useremail,usertel,userRegion,userArea,userIdentify",
                  "question" => "isssssssssssssii,question_id,todolist_line_code,question,ans_type,choice_1,choice_2,choice_3,choice_4,choice_5,create_date,create_by,update_by,update_date,takephoto,maxphoto,checkstock",
                  "question_form" => "isssssssssss,question_form_id,todolist_line_code,name,tag,status,trash,create_by,create_date,trash_date,trash_by,update_date,update_by",
                  "question_form_line" => "iiisssssi,question_form_line_id,question_form_id,question_id,username,create_date,trash,trash_date,trash_by,ordering",
                  "question_log" => "iiiisiisssssss,question_log_id,eform_data_id,eform_id,eform_line_id,question,question_id,question_form_id,answer,visit_date,username,answer_choice,update_date,update_by,ans_type",
                  "role_access" => "iiiiiiiiii,role_id,access_id,c_viewdetail,c_print,c_report,c_add,c_del,c_edit,c_viewmap,c_markmap",
                  "roledata" => "iissssiiss,i_index,role_id,role_name,cby,cdate,mdate,active,trash,mby,Descript",
                  "sysdiagrams" => "siiis,name,principal_id,diagram_id,version,definition",
                  "user_log012017" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log022017" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log032016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log032017" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log042016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log042017" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log052016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log052017" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log062016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log062017" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log072016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log082016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log092016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log102016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_log112016" => "ississs,ID,username,usedate,topicid,detail,ipaddress,device",
                  "user_topic_log" => "is,id,topic"
		);
			
	public $ErrorMsg;		//Error Message on String format
	
    function __construct() {//Initital variable in class
		$this->InitDB();
	}
	
	function __destruct(){//Terminated DB connection
		$this->db->close();
	}
	
	private function CreateStatement($data){
		$statment = "\$stmt->bind_param(";
		$this->tmpData = array();
		$i=0;
		foreach($data as $value){
			if($i==0){
				$statment .= "'$value'";
				$this->SQL .= "<br>\n Paramlist ($value)";
			}else{
				$this->SQL .= "<br>\n$i = $value";
				$this->tmpData[$i] = $value;
				$statment .= ",\$this->tmpData[$i]";
			}
			$i++;
		}
		return $statment.");";
	}
	
	public function InitDB(){
		$Host = _DBZHOST;
		$User = _DBZUSER;
		$Password = _DBZPASSWORD;
		$DBName = _DBZNAME;

		$this->SQL = "";
		$this->Result = NULL;
		$this->NumRow = 0;
		$this->EffectRow = 0;
		
		if($this->db){
			$this->db->close();
			unset($this->db);
		}

		$this->db = new MySQLi($Host,$User,$Password,$DBName);

		if(!$this->db){
			$this->ErrorMsg = "Connect Database error";
			die($this->ErrorMsg);
		}else{
			$this->Query("SET NAMES UTF8");
			$this->ErrorMsg = "";
			return $this->db;
		}
	}
	
	public function GetLastSQL(){//Get Last SQL String
		return $this->SQL;
	}

	public function Query($sql,$param=NULL){//Query with out result
		$this->SQL = $sql;
		$stmt = $this->db->prepare($sql);
		if(!is_null($param)){
			eval($this->CreateStatement($param));
		}
		$success = $stmt->execute();
		$this->affected_rows = $stmt->affected_rows;
		return $success;
	}
	
	public function GetNumRows(){
		return $this->num_rows;
	}
	
	public function GetAffectRows(){
		return $this->affected_rows;
	}
	
	public function SeekResultData($rowNo = 0/*0=1st row*/){
		$this->Result->data_seek($rowNo);
	}
	
	public function Now(){// Get Current Datetime
		return $this->GetDataOneField("SELECT NOW()");
	}

	public function Password($password){// Get Current Datetime
		return $this->GetDataOneField("SELECT PASSWORD(?)",array("s",$password));
	}
	
	public function MD5($string){// Get Current Datetime
		return $this->GetDataOneField("SELECT MD5(?)",array("s",$string));
	}
	
	public function NextID($Table){//Get Next ID
		$id = 0;
		$row = $this->GetDataOneRow("SHOW TABLE STATUS LIKE '$Table'");
		if(is_null($row["Auto_increment"])){
			list($ftype,$f1st,$trash) = explode(",",$this->DBStructure[$Table],3);
			$id = $this->GetDataOneField("SELECT MAX($f1st) + 1 FROM `$Table`");
			if(is_null($id)) $id = 1;
		}else{
			$id = $row["Auto_increment"];
		}
		return $id;
	}
	
	public function GetDataOneField($sql,$param=NULL){
		if(strpos($sql,"LIMIT")) $this->SQL = $sql;
		else  $this->SQL = $sql." LIMIT 1";
		$stmt = $this->db->prepare($sql);
		if(!is_null($param)){
			eval($this->CreateStatement($param));
		}
		if (!$stmt->execute()){
			$this->num_rows = 0;
			$this->affected_rows = 0;
			$this->Columns = '';
			$this->Result = NULL;
			return "SQL Query Error";
		}else{
			$stmt->store_result();			
			$this->Result = $stmt;
			$stmt->bind_result($data);
			$stmt->fetch();
			return $data;//return null when select found 0 row you can check with function is_null()
		}
	}

	public function GetDataOneRow($sql,$param=NULL){
		if(strpos($sql,"LIMIT")) $this->SQL = $sql;
		else  $this->SQL = $sql." LIMIT 1";
		if(is_null($param)){
			$this->GetData($sql);
		}else{
			$this->GetData($sql,$param);
		}
		return $this->FetchData();
	}

	public function GetData($sql,$param=NULL){
		$this->SQL = $sql;
		$stmt = $this->db->prepare($sql);
		if(!is_null($param)){
			eval($this->CreateStatement($param));
		}
		if (!($stmt->execute())){
			$this->num_rows = 0;
			$this->affected_rows = 0;
			$this->Columns = '';
			$this->Result = NULL;
			return false;
		}else{
			$stmt->store_result();
			$this->num_rows = $stmt->num_rows;
			$this->affected_rows = $stmt->affected_rows;

			$metaResults = $stmt->result_metadata();
		    $fields = $metaResults->fetch_fields();
		    $statementParams='';
			
			foreach($fields as $field){
    		     if(empty($statementParams)){
        		     $statementParams.="\$column['".$field->name."']";
	        	 }else{
	            	 $statementParams.=", \$column['".$field->name."']";
		         }
		    }
		
			$this->Columns = $statementParams;
			$this->Result = $stmt;
			$statment="\$this->Result->bind_result(".$this->Columns.");";
		    eval($statment);
			$this->tmpData = $column;
			return true;
		}
    }

	public function FetchData($index=NULL){//Load data in current row
		if($this->Result){
		   	if($this->Result->fetch()){
				if(is_null($index)){
					$i=0;
					foreach($this->tmpData as $value){
						$this->tmpData[$i++] = $value;
					}
				}
				return $this->tmpData;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }

	public function InsertData($Table,$Data){
		if(isset($this->DBStructure[$Table])){
			$exparam = "";
			$dbsDetail = explode(",",$this->DBStructure[$Table]);
			for($x=1; $x < count($dbsDetail); $x++){
				if($x==1){
					$sql = "INSERT INTO `$Table` (".$dbsDetail[1];
					$sqlext = ") VALUES ( ?";
					$statment = "\$stmt->bind_param(\"".$dbsDetail[0]."\", \$".$dbsDetail[1];
				}else{
					$sql .= ", ".$dbsDetail[$x];
					$sqlext .= ", ?";
					$statment .= ", \$".$dbsDetail[$x];
				}
				if(isset($Data[$dbsDetail[$x]])){
					${$dbsDetail[$x]} = $Data[$dbsDetail[$x]];
					$exparam .= "<br>\n$x = ".$Data[$dbsDetail[$x]];
				}else{
					switch(substr($dbsDetail[0],$x-1,1)){
						case 'i' : ${$dbsDetail[$x]} = 0;break;
						case 'd' : ${$dbsDetail[$x]} = 0.0;break;
						case 's' : ${$dbsDetail[$x]} = '';break;
						case 'b' : ${$dbsDetail[$x]} = '';break;
					}
				}
			}
			$sql .= $sqlext.")";
			$this->SQL = $sql;
			$this->SQL .= "<br>\nParamlist (".$dbsDetail[0].")".$exparam;
			$statment .= ");";
			$stmt = $this->db->prepare($sql);
		    eval($statment);
			$success = $stmt->execute();
			$this->affected_rows = $stmt->affected_rows;
			return $success;
		}else{
			return false;
		}
	}
	
	public function UpdateData($Table,$Data,$Where,$param=NULL){
		if(isset($this->DBStructure[$Table])){			
			$sql = "UPDATE `$Table` SET ";
			$statment = "\$stmt->bind_param(\"";
			$updateType = "";
			$updateField = "";
			$exparam = "";
			$dbsDetail = explode(",",$this->DBStructure[$Table]);
			$c = 1;
			for($x=1; $x < count($dbsDetail); $x++){
				if(isset($Data[$dbsDetail[$x]])){
					$sql .= $dbsDetail[$x]." = ?, ";
					$exparam .= "<br>\n$c = ".$Data[$dbsDetail[$x]];
					$updateType .= substr($dbsDetail[0],$x-1,1);
					$updateField .= ", \$".$dbsDetail[$x];
					${$dbsDetail[$x]} = $Data[$dbsDetail[$x]];
					$c++;
				}
			}
			if(!is_null($param)){
				$this->tmpData = array();
				$updateType .= $param[0];
				for($x=1;$x < count($param);$x++){
					$exparam .= "<br>\n$c = ".$param[$x];
					$this->tmpData[$x] = $param[$x];
					$updateField .= ", \$this->tmpData[$x]";
					$c++;
				}
			}
			$sql = substr($sql,0,strlen($sql)-2)." WHERE ".$Where;
			$statment .= $updateType."\"".$updateField.");";
			$this->SQL = $sql;
			$this->SQL .= "<br>\nParamlist (".$updateType.")".$exparam;
			$stmt = $this->db->prepare($sql);
		    eval($statment);
			$success = $stmt->execute();
			$this->affected_rows = $stmt->affected_rows;
			return $success;
		}else{
			return false;
		}
	}
	
	public function DeleteData($Table,$Where,$param=NULL){
		if(is_null($param)){
			return $this->Query("DELETE FROM `$Table` WHERE $Where");
		}else{
			return $this->Query("DELETE FROM `$Table` WHERE $Where",$param);
		}
	}
}
?>
