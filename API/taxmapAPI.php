<?php //Report API
	require_once("../class/database.zoning.class.php");
	require_once("../class/util.class.php");
	require_once("../class/report.class.php");

class taxmap{
	public $type;
	public $crs;
	public $features;

	function __construct() {
		$this->type = "FeatureCollection";
		$this->crs = new taxdetail;
		$this->features = array();
	}

	public function AddRegTax($c,$s,$r){
		$dat = new taxobj;
		$dat->AddProperties($c,$s,$r);
		array_push($this->features,$dat);
	}

	public function AddRegSum($s1,$s2,$s3,$s4,$sa,$r){
		$dat = new sumobj;
		$dat->AddProperties($s1,$s2,$s3,$s4,$sa,$r);
		array_push($this->features,$dat);
	}

	public function AddMonthTax($c,$s,$r,$m){
		$dat = new taxmonthobj;
		$dat->AddProperties($c,$s,$r,$m);
		array_push($this->features,$dat);
	}

	public function AddOverAllRegTax($vta,$vc,$vl,$vs,$vf,$vto,$reg){
		$dat = new OverAlltaxobj;
		$dat->AddProperties($vta,$vc,$vl,$vs,$vf,$vto,$reg);
		array_push($this->features,$dat);
	}

	public function AddOverAllMonthTax($vta,$vc,$vl,$vs,$vf,$vto,$reg,$area){
		$dat = new OverAllMonthtaxobj;
		$dat->AddProperties($vta,$vc,$vl,$vs,$vf,$vto,$reg,$area);
		array_push($this->features,$dat);
	}

	public function AddAreaTax($a,$r,$p,$v){
		$dat = new TaxAreaObj;
		$dat->AddProperties($a,$r,$p,$v);
		array_push($this->features,$dat);
	}

	public function AddAreaSum($a,$r,$p,$s1,$s2,$s3,$s4,$sa){
		$dat = new SumAreaObj;
		$dat->AddProperties($a,$r,$p,$s1,$s2,$s3,$s4,$sa);
		array_push($this->features,$dat);
	}
}

class taxdetail{
	public $type;
	public $properties;

	function __construct() {
		$this->type = "name";
		$this->properties = new taxformat;
	}
}

class taxformat{
	public $name;

	function __construct() {
		$this->name = "urn:ogc:def:crs:OGC:1.3:CRS84";
	}
}

class taxobj{
	public $type;
	public $properties;
	public $geometry;

	function __construct() {
		$this->type = "Feature";
		$this->geometry = null;
	}

	public function AddProperties($c,$s,$r){
		$taxprop = new taxproperties;
		$taxprop->COUNT = $c;
		$taxprop->SUM = $s;
		$taxprop->REG_CODE = $r;
		$this->properties = $taxprop;
	}
}

class taxmonthobj{
	public $type;
	public $properties;
	public $geometry;

	function __construct() {
		$this->type = "Feature";
		$this->geometry = null;
	}

	public function AddProperties($c,$s,$r,$m){
		$taxprop = new TaxMonthProperties;
		$taxprop->COUNT = $c;
		$taxprop->SUM = $s;
		$taxprop->REG_CODE = $r;
		$taxprop->MONTH = $m;
		$this->properties = $taxprop;
	}
}

class OverAlltaxobj{
	public $type;
	public $properties;
	public $geometry;

	function __construct() {
		$this->type = "Feature";
		$this->geometry = null;
	}

	public function AddProperties($vta,$vc,$vl,$vs,$vf,$vto,$reg){
		$taxprop = new OverAllproperties;
		$taxprop->VAL_TAX = $vta;
		$taxprop->VAL_CASE = $vc;
		$taxprop->VAL_LIC = $vl;
		$taxprop->VAL_STAMP = $vs;
		$taxprop->VAL_FAC = $vf;
		$taxprop->VAL_TOTAL = $vto;
		$taxprop->REG_CODE = $reg;
		$this->properties = $taxprop;
	}
}

class OverAllMonthtaxobj{
	public $type;
	public $properties;
	public $geometry;

	function __construct() {
		$this->type = "Feature";
		$this->geometry = null;
	}

	public function AddProperties($vta,$vc,$vl,$vs,$vf,$vto,$reg,$area){
		$taxprop = new OverAllMonthproperties;
		$taxprop->VAL_TAX = $vta;
		$taxprop->VAL_CASE = $vc;
		$taxprop->VAL_LIC = $vl;
		$taxprop->VAL_STAMP = $vs;
		$taxprop->VAL_FAC = $vf;
		$taxprop->VAL_TOTAL = $vto;
		$taxprop->REG_CODE = $reg;
		$taxprop->AREA_CODE = $area;
		$this->properties = $taxprop;
	}
}

class TaxAreaObj{
	public $type;
	public $properties;
	public $geometry;

	function __construct() {
		$this->type = "Feature";
		$this->geometry = null;
	}

	public function AddProperties($a,$r,$p,$v){
		$taxprop = new taxareaproperties;
		$taxprop->AREA_CODE = $a;
		$taxprop->REG_CODE = $r;
		$taxprop->PROV_CODE = $p;
		$taxprop->VAL_SUM = $v;
		$this->properties = $taxprop;
	}
}

class sumobj{
	public $type;
	public $properties;
	public $geometry;

	function __construct() {
		$this->type = "Feature";
		$this->geometry = null;
	}

	public function AddProperties($s1,$s2,$s3,$s4,$sa,$r){
		$sumprop = new sumproperties;
		$sumprop->SUM1 = $s1;
		$sumprop->SUM2 = $s2;
		$sumprop->SUM3 = $s3;
		$sumprop->SUM4 = $s4;
		$sumprop->SUMALL = $sa;
		$sumprop->REG_CODE = $r;
		$this->properties = $sumprop;
	}
}

class SumAreaObj{
	public $type;
	public $properties;
	public $geometry;

	function __construct() {
		$this->type = "Feature";
		$this->geometry = null;
	}

	public function AddProperties($a,$r,$p,$s1,$s2,$s3,$s4,$sa){
		$sumprop = new sumAreaproperties;
		$sumprop->AREA_CODE = $a;
		$sumprop->REG_CODE = $r;
		$sumprop->PROV_CODE = $p;
		$sumprop->SUM1 = $s1;
		$sumprop->SUM2 = $s2;
		$sumprop->SUM3 = $s3;
		$sumprop->SUM4 = $s4;
		$sumprop->SUMALL = $sa;
		$this->properties = $sumprop;
	}
}

class sumAreaproperties{
	public $AREA_CODE;
	public $REG_CODE;
	public $PROV_CODE;
	public $SUM1;
	public $SUM2;
	public $SUM3;
	public $SUM4;
	public $SUMALL;
}

class sumproperties{
	public $SUM1;
	public $SUM2;
	public $SUM3;
	public $SUM4;
	public $SUMALL;
	public $REG_CODE;
}

class taxproperties{
	public $COUNT;
	public $SUM;
	public $REG_CODE;
}

class TaxMonthProperties{
	public $COUNT;
	public $SUM;
	public $REG_CODE;
	public $MONTH;
}

class OverAllproperties{
	public $VAL_TAX;
	public $VAL_CASE;
	public $VAL_LIC;
	public $VAL_STAMP;
	public $VAL_FAC;
	public $VAL_TOTAL;
	public $REG_CODE;
}

class OverAllMonthproperties{
	public $VAL_TAX;
	public $VAL_CASE;
	public $VAL_LIC;
	public $VAL_STAMP;
	public $VAL_FAC;
	public $VAL_TOTAL;
	public $REG_CODE;
	public $AREA_CODE;
}

class taxareaproperties{
	public $AREA_CODE;
	public $REG_CODE;
	public $PROV_CODE;
	public $VAL_SUM;
}

if(isset($_GET["data"])){
	$DB = new ezDB;
	$x = new taxmap;
	$year = isset($_GET["year"])?$_GET["year"]:date('Y');
	$area = isset($_GET["area"])?intval($_GET["area"]):0;
	if($_GET["data"] == "test"){
		echo "update api";
		die;
	}elseif($_GET["data"] == "overall_reg"){
		$DB->GetData("SELECT REGCODE, COUNT(TYPE) AS SALL FROM `illigal_nopoint` WHERE REGCODE IS NOT NULL AND YEAR(DateApprove + INTERVAL 3 MONTH) = ? GROUP BY REGCODE ORDER BY REGCODE",array("i",$year));
		while($fdata = $DB->FetchData()){
			$data["casec"][$fdata["REGCODE"]] = $fdata["SALL"];
		}
		$DB->GetData("SELECT ifRegion, COUNT(regis_number) AS SALL FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea` FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea` FROM Excise_License) AS X WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY ifRegion",array("i",$year));
		while($fdata = $DB->FetchData()){
			$data["lic"][$fdata["ifRegion"]] = $fdata["SALL"];
		}
		$DB->GetData("SELECT REGCODE, COUNT(Name) AS SALL FROM `Academy` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND REGCODE IS NOT NULL GROUP BY REGCODE",array("i",$year));
		while($fdata = $DB->FetchData()){
			$data["academy"][$fdata["REGCODE"]] = $fdata["SALL"];
		}
		for($i=1;$i<=10;$i++){
			@$x->AddOverAllRegTax(0,intval($data["casec"][$i]),intval($data["lic"][$i]),floatval($data["casec"][$i]),intval($data["academy"][$i]),$i,$i);
		}
	}elseif($_GET["data"] == "overall_month"){
			include("../data/geojson/overall_sum_by_reg_code_month.geojson");
			die;
	}elseif($_GET["data"] == "overall_area"){
			include("taxdataMonthOVA.php");
			foreach($AreaList as $A){
				@$x->AddOverAllMonthTax(floatval($data["case"][$A])+floatval($data["stamp"][$A]),intval($data["casec"][$A]),intval($data["lic"][$A]),floatval($data["stamp"][$A]),intval($data["fac"][$A]),$A,intval(substr($A,0,2)),$A);
			}
			//include("../data/geojson/overall_sum_by_area_code.geojson");
			//die;
	}elseif($_GET["data"] == "tax_reg"){
		for($i=1;$i<=10;$i++){
			$x->AddRegTax(0,0.0,$i);
		}
	}elseif($_GET["data"] == "tax_month"){
		for($i=1;$i<=10;$i++){
			for($j=1;$j<=12;$j++){
				$x->AddMonthTax(0,0,$i,$j);
			}
		}
	}elseif($_GET["data"] == "tax_area"){
		$DB->GetData("SELECT LPAD(EXCISECODE,5,0) AS A, LPAD(REGCODE,2,0) AS R, PROVCODE AS P, 0 AS S FROM Excise_Area ORDER BY REGCODE,EXCISECODE");
		while($data = $DB->FetchData()){
			$x->AddAreaTax($data["A"],$data["R"],$data["P"],$data["S"]);
		}
	}elseif($_GET["data"] == "illegal_reg"){
		$DB->GetData("SELECT REGCODE, SUM(IF(TYPE='สุรา',1,0)) AS C1, SUM(IF(TYPE='ยาสูบ',1,0)) AS C2, SUM(IF(TYPE='ไพ่',1,0)) AS C3, SUM(IF(TYPE NOT IN ('สุรา','ยาสูบ','ไพ่'),1,0)) AS C4, COUNT(TYPE)  AS SALL FROM `illigal_nopoint` WHERE REGCODE IS NOT NULL AND YEAR(DateApprove + INTERVAL 3 MONTH) = ? GROUP BY REGCODE ORDER BY REGCODE",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddRegSum(intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]),intval($data["REGCODE"]));
		}
	}elseif($_GET["data"] == "illegal_month"){
		$DB->GetData("SELECT REG_CODE,GovMonthID,C FROM (SELECT REG_CODE,GovMonthID,gmValue FROM `Excise_REGION`,`GovMonth` ORDER BY REG_CODE,GovMonthID) AS X LEFT JOIN (SELECT REGCODE, MONTH(DateApprove) AS M,COUNT(TYPE) AS C FROM `illigal_nopoint` WHERE REGCODE IS NOT NULL AND YEAR(DateApprove + INTERVAL 3 MONTH) = ? GROUP BY REGCODE, M) AS XX ON REGCODE = REG_CODE AND gmValue = M
",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddMonthTax($data["C"],floatval($data["C"]),$data["REG_CODE"],$data["GovMonthID"]);
		}
	}elseif($_GET["data"] == "illegal_area"){
		$DB->GetData("SELECT LPAD(EXCISECODE,5,0) AS A, LPAD(REGCODE,2,0) AS R, PROV_CODE AS P, SUM(IF(TYPE='สุรา',1,0)) AS C1, SUM(IF(TYPE='ยาสูบ',1,0)) AS C2, SUM(IF(TYPE='ไพ่',1,0)) AS C3, SUM(IF(TYPE NOT IN ('สุรา','ยาสูบ','ไพ่'),1,0)) AS C4, COUNT(TYPE) AS SALL FROM `illigal_nopoint` WHERE REGCODE IS NOT NULL AND YEAR(DateApprove + INTERVAL 3 MONTH) = ? GROUP BY EXCISECODE ORDER BY REGCODE, EXCISECODE",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddAreaSum($data["A"],$data["R"],$data["P"],intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]));
		}
	}elseif($_GET["data"] == "license_reg"){
		$DB->GetData("SELECT ifRegion,SUM(IF(LType = 'ส',1,0)) AS C1, SUM(IF(LType = 'ย',1,0)) AS C2, SUM(IF(LType = 'พ',1,0)) AS C3, SUM(IF(LType = '2',1,0)) AS C4, COUNT(regis_number) AS SALL FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea`, '2' AS LType FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea`, SUBSTRING(`LIC_TYPE`,1,1) FROM Excise_License) AS X WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY ifRegion",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddRegSum(intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]),intval($data["ifRegion"]));
		}
	}elseif($_GET["data"] == "license_month"){
		$DB->GetData("SELECT REG_CODE,GovMonthID,C FROM (SELECT REG_CODE,GovMonthID,gmValue FROM `Excise_REGION`,`GovMonth` ORDER BY REG_CODE,GovMonthID) AS X LEFT JOIN (SELECT ifRegion, MONTH(cdate) AS M, COUNT(regis_number) AS C FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea`, '2' AS LType FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea`, SUBSTRING(`LIC_TYPE`,1,1) FROM Excise_License) AS X2 WHERE ifRegion IS NOT NULL AND YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY ifRegion, M) AS XX ON ifRegion = REG_CODE AND gmValue = M",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddMonthTax($data["C"],floatval($data["C"]),$data["REG_CODE"],$data["GovMonthID"]);
		}
	}elseif($_GET["data"] == "license_area"){
		$DB->GetData("SELECT LPAD(ifArea,5,0) AS A, LPAD(ifRegion,2,0) AS R, ifProvince AS P,SUM(IF(LType = 'ส',1,0)) AS C1, SUM(IF(LType = 'ย',1,0)) AS C2, SUM(IF(LType = 'พ',1,0)) AS C3, SUM(IF(LType = '2',1,0)) AS C4, COUNT(regis_number) AS SALL FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea`, '2' AS LType FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea`, SUBSTRING(`LIC_TYPE`,1,1) FROM Excise_License) AS X WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY ifArea",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddAreaSum($data["A"],$data["R"],$data["P"],intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]));
		}
	}elseif($_GET["data"] == "company_reg"){
		$DB->GetData("SELECT ifRegion,SUM(IF(LType = 'ส',1,0)) AS C1, SUM(IF(LType = 'ย',1,0)) AS C2, SUM(IF(LType = 'พ',1,0)) AS C3, SUM(IF(LType = '2',1,0)) AS C4, COUNT(regis_number) AS SALL FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea`, '2' AS LType FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea`, SUBSTRING(`LIC_TYPE`,1,1) FROM Excise_License) AS X WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY ifRegion",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddRegSum(intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]),intval($data["ifRegion"]));
		}
	}elseif($_GET["data"] == "company_month"){
		$DB->GetData("SELECT REG_CODE,GovMonthID,C FROM (SELECT REG_CODE,GovMonthID,gmValue FROM `Excise_REGION`,`GovMonth` ORDER BY REG_CODE,GovMonthID) AS X LEFT JOIN (SELECT ifRegion, MONTH(cdate) AS M, COUNT(regis_number) AS C FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea`, '2' AS LType FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea`, SUBSTRING(`LIC_TYPE`,1,1) FROM Excise_License) AS X2 WHERE ifRegion IS NOT NULL AND YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY ifRegion, M) AS XX ON ifRegion = REG_CODE AND gmValue = M",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddMonthTax($data["C"],floatval($data["C"]),$data["REG_CODE"],$data["GovMonthID"]);
		}
	}elseif($_GET["data"] == "company_area"){
		$DB->GetData("SELECT LPAD(ifArea,5,0) AS A, LPAD(ifRegion,2,0) AS R, ifProvince AS P,SUM(IF(LType = 'ส',1,0)) AS C1, SUM(IF(LType = 'ย',1,0)) AS C2, SUM(IF(LType = 'พ',1,0)) AS C3, SUM(IF(LType = '2',1,0)) AS C4, COUNT(regis_number) AS SALL FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea`, '2' AS LType FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea`, SUBSTRING(`LIC_TYPE`,1,1) FROM Excise_License) AS X WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY ifArea",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddAreaSum($data["A"],$data["R"],$data["P"],intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]));
		}
	}elseif($_GET["data"] == "academy_reg"){
		//$DB->GetData("SELECT REGCODE,SUM(IF(Level = 'อุดมศึกษา',1,0)) AS C1, SUM(IF(Level = 'อาชีวศึกษา',1,0)) AS C2, SUM(IF(Level = 'มัธยมศึกษา',1,0)) AS C3, SUM(IF(Level = 'ประถมศึกษา',1,0)) AS C4, COUNT(Name) AS SALL FROM `Academy` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND REGCODE IS NOT NULL GROUP BY REGCODE",array("i",$year));
		$DB->GetData("SELECT acRegion as REGCODE, SUM(acHigh) AS C1, SUM(acSecounary) AS C2, SUM(acPrimary) AS C3,SUM(acUniversity) AS C4, SUM(acPrimary+acSecounary+acHigh+acUniversity) AS SALL FROM `AcademyCount` GROUP BY acRegion");
		while($data = $DB->FetchData()){
			$x->AddRegSum(intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]),intval($data["REGCODE"]));
		}
	}elseif($_GET["data"] == "academy_month"){
		$DB->GetData("SELECT REG_CODE,GovMonthID,C FROM (SELECT REG_CODE,GovMonthID,gmValue FROM `Excise_REGION`,`GovMonth` ORDER BY REG_CODE,GovMonthID) AS X LEFT JOIN (SELECT REGCODE, MONTH(cdate) AS M,COUNT(Name) AS C FROM `Academy` WHERE REGCODE IS NOT NULL AND YEAR(cdate + INTERVAL 3 MONTH) = ? GROUP BY REGCODE, M) AS XX ON REGCODE = REG_CODE AND gmValue = M",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddMonthTax($data["C"],floatval($data["C"]),$data["REG_CODE"],$data["GovMonthID"]);
		}
	}elseif($_GET["data"] == "academy_area"){
		$DB->GetData("SELECT LPAD(acArea,5,0) AS A, LPAD(acRegion,2,0) AS R, LPAD(MOD(FLOOR(acArea/10),100),2,0) AS P, SUM(acHigh) AS C1, SUM(acSecounary) AS C2, SUM(acPrimary) AS C3,SUM(acUniversity) AS C4, SUM(acPrimary+acSecounary+acHigh+acUniversity) AS SALL FROM `AcademyCount` GROUP BY acArea");
//		$DB->GetData("SELECT LPAD(EXCISECODE,5,0) AS A, LPAD(REGCODE,2,0) AS R, MOD(FLOOR(EXCISECODE/10),100) AS P,SUM(IF(Level = 'อุดมศึกษา',1,0)) AS C1, SUM(IF(Level = 'อาชีวศึกษา',1,0)) AS C2, SUM(IF(Level = 'มัธยมศึกษา',1,0)) AS C3, SUM(IF(Level = 'ประถมศึกษา',1,0)) AS C4, COUNT(Name) AS SALL FROM `Academy` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND EXCISECODE IS NOT NULL GROUP BY EXCISECODE",array("i",$year));
		while($data = $DB->FetchData()){
			$x->AddAreaSum($data["A"],$data["R"],$data["P"],intval($data["C1"]),intval($data["C2"]),intval($data["C3"]),intval($data["C4"]),intval($data["SALL"]));
		}
	}else{
		die;
	}
	header("Access-Control-Allow-Origin: *");
	echo json_encode($x);
	die;
}

$fn = isset($_POST["fn"])?$_POST["fn"]:"";
$mode = isset($_POST["mode"])?$_POST["mode"]:0;
switch($fn){
	case "getGPS" :
		break;
	case "getdata" :
		break;
	case "filter" :
				$DB = new ezDB;
				if($_POST["src"] == 0){
					$data = new exFilter_Bar;
					$data->year = array();
					$data->region = array();
					$data->province = array();
					$data->job = isset($_POST["job"])?$_POST["job"]:1;


					if($data->job == 1){
						$sdata = new exItem;
						$sdata->id = 1;
						$sdata->value = 2017;
						$sdata->label = "ปีงบประมาณ 2560";
						array_push($data->year,$sdata);
					}elseif($data->job == 2){
						$DB->GetData("SELECT DISTINCT YEAR(DateApprove + INTERVAL 3 MONTH) AS fYear FROM `illigal_nopoint` WHERE REGCODE IS NOT NULL AND EXCISECODE IS NOT NULL AND YEAR(DateApprove) BETWEEN 1900 AND YEAR(NOW() + INTERVAL 3 MONTH) ORDER BY fYear DESC");
						for($x=1;$fdata = $DB->FetchData();$x++){
							$sdata = new exItem;
							$sdata->id = $x;
							$sdata->value = $fdata["fYear"];
							$sdata->label = "ปีงบประมาณ ".($fdata["fYear"] + 543);
							array_push($data->year,$sdata);
						}
					}elseif($data->job == 3){
						$DB->GetData("SELECT DISTINCT YEAR(LIC_DATE + INTERVAL 3 MONTH) AS fYear FROM `Excise_License` UNION SELECT DISTINCT YEAR(cdate + INTERVAL 3 MONTH) AS fYear FROM `Information_excise_registration` GROUP BY fYear ORDER BY fYear DESC");
						for($x=1;$fdata = $DB->FetchData();$x++){
							$sdata = new exItem;
							$sdata->id = $x;
							$sdata->value = $fdata["fYear"];
							$sdata->label = "ปีงบประมาณ ".($fdata["fYear"] + 543);
							array_push($data->year,$sdata);
						}
					}elseif(($data->job == 4)){
						$DB->GetData("SELECT DISTINCT YEAR(LIC_DATE + INTERVAL 3 MONTH) AS fYear FROM `Excise_License` UNION SELECT DISTINCT YEAR(cdate + INTERVAL 3 MONTH) AS fYear FROM `Information_excise_registration` GROUP BY fYear ORDER BY fYear DESC");
						for($x=1;$fdata = $DB->FetchData();$x++){
							$sdata = new exItem;
							$sdata->id = $x;
							$sdata->value = $fdata["fYear"];
							$sdata->label = "ปีงบประมาณ ".($fdata["fYear"] + 543);
							array_push($data->year,$sdata);
						}
					}elseif(($data->job == 5)){
						$DB->GetData("SELECT DISTINCT YEAR(cdate + INTERVAL 3 MONTH) AS fYear FROM `Academy` ORDER BY fYear DESC");
						for($x=1;$fdata = $DB->FetchData();$x++){
							$sdata = new exItem;
							$sdata->id = $x;
							$sdata->value = $fdata["fYear"];
							$sdata->label = "ปีงบประมาณ ".($fdata["fYear"] + 543);
							array_push($data->year,$sdata);
						}
					}else{
						for($x=1;$x<=5;$x++){
							$sdata = new exItem;
							$sdata->id = $x;
							$sdata->value = date("Y") - $x + 1;
							$sdata->label = "ปีงบประมาณ ".(date("Y") - $x + 544);
							array_push($data->year,$sdata);
						}
					}

					$sdata = new exItem;
					$sdata->id = 0;
					$sdata->value = "00";
					$sdata->label = "ทุกภาค";
					array_push($data->region,$sdata);

					$DB->GetData("SELECT REG_CODE, LPAD(`REG_CODE`,2,0) AS RegionID, `REG_TNAME` FROM `Excise_REGION`");
					while($fdata = $DB->FetchData()){
						$sdata = new exItem;
						//$sdata->id = $fdata["RegionID"];
						$sdata->id = $fdata["REG_CODE"];
						$sdata->value = $fdata["RegionID"];
						$sdata->label = "สรรพสามิต".$fdata["REG_TNAME"];
						array_push($data->region,$sdata);
					}

					$sdata = new exItem;
					$sdata->id = 0;
					$sdata->value = "00";
					$sdata->label = "ทุกพื้นที่";
					array_push($data->province,$sdata);

					$DB->GetData("SELECT EXCISECODE, LPAD(`EXCISECODE`,5,0) AS AreaID, `EXCISETNAME` FROM `Excise_Area`");
					while($fdata = $DB->FetchData()){
						$sdata = new exItem;
						$sdata->id = $fdata["EXCISECODE"];
						$sdata->value = $fdata["AreaID"];
						$sdata->label = $fdata["EXCISETNAME"];
						array_push($data->province,$sdata);
					}
				}else{
					$S_region = isset($_POST["value"])?intval($_POST["value"]):0;

					$filterLabel = "ทุกพื้นที่";
					$DB->GetData("SELECT `EXCISECODE`, LPAD(`EXCISECODE`,5,0) AS AreaID, `EXCISETNAME` FROM `Excise_Area` WHERE ? IN (0,REGCODE)",array("i",$S_region));

					if($DB->GetNumRows()>0){
						$data = array();
						$sdata = new exItem;
						$sdata->id = 0;
						$sdata->value = "00";
						$sdata->label = $filterLabel;
						array_push($data,$sdata);

						while($fdata = $DB->FetchData()){
							$sdata = new exItem;
							$sdata->id = $fdata["EXCISECODE"];
							$sdata->value = $fdata["AreaID"];
							$sdata->label = $fdata["EXCISETNAME"];
							array_push($data,$sdata);
						}
					}else{
						$data = null;
					}
				}
			break;
	default : $data = null;
}
header("Access-Control-Allow-Origin: *");
echo json_encode($data);
?>
