<?php
	require_once("../class/database.zoning.class.php");
	require_once("../class/database.class.php");
	require_once("../class/util.class.php");
	require_once("../class/report.class.php");
	require_once("../class/search.class.php");

$fn = isset($_POST["fn"])?$_POST["fn"]:"";

switch($fn){
	case "gettable" :
				$RPP = 5;
				$year = isset($_POST["year"])?$_POST["year"]:0;
				$region = isset($_POST["region"])?$_POST["region"]:0;
				$province = isset($_POST["province"])?$_POST["province"]:0;
				$page = isset($_POST["page"])?$_POST["page"]-1:0;
				$job = isset($_POST["job"])?$_POST["job"]:0;
				$menu = isset($_POST["menu"])?$_POST["menu"]:0;
				$Keyword = isset($_POST["keyword"])?$_POST["keyword"]:"";
				if(!in_array($job,array(1,2,3,4,5,6))) $job = 1;
				$title = array(
					1 => array("ลำดับที่","ชื่อผู้ประกอบการ","ประเภทสินค้า","ที่อยู่สถานประกอบการ","ตำแหน่งพิกัด","เลขทะเบียนสรรพสามิต","ชำระภาษี"),
					2 => array("ลำดับที่","พรบ","วันที่เกิดเหตุ","ผู้กล่าวหา/ผู้ต้องหา","สถานที่เกิดเหตุ","ข้อกล่าวหา","เปรียบเทียบปรับ","ศาลปรับ","พนักงานสอบสวน","เงินสินบน","เงินรางวัล","เงินส่งคลัง"),
					3 => array("ลำดับที่","ชื่อผู้ประกอบการ","เลขทะเบียนสรรพสามิต","พรบ.สุรา","พรบ.ยาสูบ","พรบ.ไพ่","พรบ.2527","ใบอนุญาตรายวัน"),
					4 => array("ลำดับที่","ชื่อผู้ประกอบการ","ประเภทสินค้า","ที่อยู่สถานประกอบการ","ตำแหน่งพิกัด","เลขทะเบียนสรรพสามิต"),
					5 => array("ลำดับที่","ชื่อสถานศึกษา","ที่ตั้ง","จังหวัด","ประเภท","ระดับ","ละติจูด","ลองติดจูด","จำนวนร้านค้าในโซนนิ่ง"),
					6 => array("ลำดับที่","ชื่อสถานศึกษา","ชื่อผู้ประกอบการ","รหัสผู้ประกอบการ","พรบ.สุรา","พรบ.ยาสูบ","พรบ.ไพ่","พรบ.2527","ใบอนุญาตรายวัน"),
				);
				//$TitleShow = $title[$job*10 + $menu];
				$TitleShow = $title[$job];
				$colnum = count($TitleShow);


				if($year + $region + $province == 0){
					$data = new exSearch_Table;
					$data->Init($job,$page+1,$RPP,0);
					$etcObj = new exETC;
					for($i=0;$i<$colnum;$i++){
						$data->AddLabel($TitleShow[$i]);
					}
				}else{
					switch($job){
						case 1:
								$DB = new exDB;
								list($s1,$s2,$s3,$s4,$s5,$c1,$c2,$c3,$c4,$c5) = $DB->GetDataOneRow("SELECT SUM(BIL), SUM(PRL), SUM(SAL), SUM(TPL), SUM(STL), COUNT(BIL), COUNT(PRL), COUNT(SAL), COUNT(TPL), COUNT(STL)  FROM (SELECT ? AS Y, 0 AS BIL, 0 AS PRL, 0 AS SAL, 0 AS TPL, (SELECT SUM(stTax) FROM `Stamp` WHERE YEAR(stReleaseDate - INTERVAL 3 MONTH) = Y AND stFacCode = FactoryID) AS STL FROM `Factory` WHERE ? IN (0,faRegion) AND ? IN (0,faProvince) AND faName LIKE ?) AS XX",array("iiis",$year,$region,$province,"%".$Keyword."%"));
        
								$total = max($c1,$c2,$c3,$c4,$c5);
        
        
								$DB->GetData("SELECT ? AS Y, faName, 0 AS BIL, 0 AS PRL, 0 AS SAL, 0 AS TPL, (SELECT SUM(stTax) FROM `Stamp` WHERE YEAR(stReleaseDate - INTERVAL 3 MONTH) = Y AND stFacCode = FactoryID) AS STL, faLat, faLong FROM `Factory` WHERE ? IN (0,faRegion) AND ? IN (0,faProvince) AND faName LIKE ? LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
        
        
								$data = new exSearch_Table;
								$data->Init(1,$page+1,$RPP,$total,array($s1,$s2,$s3,$s4,$s5,($s1+$s2+$s3+$s4+$s5)));
								if($total > 0){
									$etcObj = new exETC;
									for($i=0;$i<$colnum;$i++){
										$data->AddLabel($TitleShow[$i]);
									}
									for($x=($page * $RPP + 1);$fdata = $DB->FetchData();$x++){
										$data->AddCell($x,1);
										$data->AddCell($fdata["faName"]);
										$data->AddCell(number_format($fdata["BIL"]),1);
										$data->AddCell(number_format($fdata["PRL"],3),1);
										$data->AddCell(number_format($fdata["SAL"],4),1);
										$data->AddCell(number_format($fdata["TPL"],4),1);
										$data->AddCell(number_format($fdata["STL"],2),1);
										$data->AddLatLong($x,$fdata["faLat"],$fdata["faLong"]);
									}
								}
							break;
						case 2:
								$prb = array("","สุรา","ยาสูบ","ไพ่");
								$DB = new ezDB;
								$DB->GetData("SELECT IF(`TYPE`='สุรา',1,IF(`TYPE`='ยาสูบ',2,IF(`TYPE`='ไพ่',3,4))) AS ilCase, COUNT(id) AS C FROM illigal_nopoint WHERE YEAR(DateApprove + INTERVAL 3 MONTH) = ? AND ? IN (0,REGCODE) AND ? IN (0,EXCISECODE) AND CONCAT(CHARGE_NAME,'#',SUSPECTS_NAME) LIKE ? GROUP BY ilCase ORDER BY ilCase",array("iiis",$year,$region,$province,"%".$Keyword."%"));
								$ldata = array();
								while ($tdata = $DB->FetchData()) {
									$ldata[$tdata["ilCase"]-1] = $tdata["C"];
								}
                                                        

								switch($menu){
									case 0:
											$total = $DB->GetDataOneField("SELECT COUNT(id) FROM `illigal_nopoint` WHERE YEAR(DateApprove + INTERVAL 3 MONTH) = ? AND ? IN (0,REGCODE) AND ? IN (0,EXCISECODE) AND CONCAT(CHARGE_NAME,'#',SUSPECTS_NAME) LIKE ?",array("iiis",$year,$region,$province,"%".$Keyword."%"));
											$DB->GetData("SELECT `TYPE`,DateApprove,CONCAT('\(ก\)',CHARGE_NAME,'/\(ต\)',SUSPECTS_NAME) AS Person,Address,allegation,Fine,court,employee,boodle,Reward,Remit,LAT,`LONG` FROM `illigal_nopoint` WHERE YEAR(DateApprove + INTERVAL 3 MONTH) =  ? AND ? IN (0,REGCODE) AND ? IN (0,EXCISECODE) AND CONCAT(CHARGE_NAME,'#',SUSPECTS_NAME) LIKE ? LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
										break;
									case 1:
									case 2:
									case 3:
											$total = $DB->GetDataOneField("SELECT COUNT(id) FROM `illigal_nopoint` WHERE YEAR(DateApprove + INTERVAL 3 MONTH) = ? AND ? IN (0,REGCODE) AND ? IN (0,EXCISECODE) AND `TYPE` LIKE ? AND CONCAT(CHARGE_NAME,'#',SUSPECTS_NAME) LIKE ?",array("iiiss",$year,$region,$province,$prb[$menu],"%".$Keyword."%"));
											$DB->GetData("SELECT `TYPE`,DateApprove,CONCAT('\(ก\)',CHARGE_NAME,'/\(ต\)',SUSPECTS_NAME) AS Person,Address,allegation,Fine,court,employee,boodle,Reward,Remit,LAT,`LONG` FROM `illigal_nopoint` WHERE YEAR(DateApprove + INTERVAL 3 MONTH) =  ? AND ? IN (0,REGCODE) AND ? IN (0,EXCISECODE) AND `TYPE` LIKE ? AND CONCAT(CHARGE_NAME,'#',SUSPECTS_NAME) LIKE ? LIMIT ?,?",array("iiissii",$year,$region,$province,$prb[$menu],"%".$Keyword."%",$page*$RPP,$RPP));
										break;
									default:
											$total = $DB->GetDataOneField("SELECT COUNT(id) FROM `illigal_nopoint` WHERE YEAR(DateApprove + INTERVAL 3 MONTH) = ? AND ? IN (0,REGCODE) AND ? IN (0,EXCISECODE) AND `TYPE` NOT IN ('สุรา','ยาสูบ','ไพ่') AND CONCAT(CHARGE_NAME,'#',SUSPECTS_NAME) LIKE ?",array("iiis",$year,$region,$province,"%".$Keyword."%"));
											$DB->GetData("SELECT `TYPE`,DateApprove,CONCAT('\(ก\)',CHARGE_NAME,'/\(ต\)',SUSPECTS_NAME) AS Person,Address,allegation,Fine,court,employee,boodle,Reward,Remit,LAT,`LONG` FROM `illigal_nopoint` WHERE YEAR(DateApprove + INTERVAL 3 MONTH) =  ? AND ? IN (0,REGCODE) AND ? IN (0,EXCISECODE) AND `TYPE` NOT IN ('สุรา','ยาสูบ','ไพ่') AND CONCAT(CHARGE_NAME,'#',SUSPECTS_NAME) LIKE ? LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
										break;
								}
                                                        
								array_push($ldata,$total);
//								array_shift($ldata);
                                                        
                                                        
                                                        
								$data = new exSearch_Table;
								$data->Init(2,$page+1,$RPP,$total,$ldata);
                                                        
								if($total > 0){
									$etcObj = new exETC;
									for($i=0;$i<$colnum;$i++){
										$data->AddLabel($TitleShow[$i]);
									}
									for($x=($page * $RPP + 1);$fdata = $DB->FetchData();$x++){
										$data->AddCell($x,1);
										$data->AddCell($fdata["TYPE"]);
										$data->AddCell($etcObj->GetShortDate(exETC::C_TH,$fdata["DateApprove"]));
										$data->AddCell($fdata["Person"]);
										$data->AddCell($fdata["Address"]);
										$data->AddCell($fdata["allegation"]);
										$data->AddCell(number_format($fdata["Fine"],2),1);
										$data->AddCell(number_format($fdata["court"],2),1);
										$data->AddCell(number_format($fdata["employee"],2),1);
										$data->AddCell(number_format($fdata["boodle"],2),1);
										$data->AddCell(number_format($fdata["Reward"],2),1);
										$data->AddCell(number_format($fdata["Remit"],2),1);
										$data->AddLatLong($x,$fdata["LAT"],$fdata["LONG"]);
									}
								}
							break;
						case 3:
								$DB = new ezDB;
        
								$ldata = array();
        
								/*list($total,$ldata[0],$ldata[1],$ldata[2],$ldata[3]) = $DB->GetDataOneRow("SELECT COUNT(faName), COUNT(FL), SUM(IF(ISNULL(PL),0,1)), SUM(IF(ISNULL(TL),0,1)), SUM(IF(ISNULL(SL),0,1))  FROM (SELECT ? AS Y, faName, faCode, '' AS FL,(SELECT lbLicense FROM `Label` WHERE lbFacCode = FactoryID AND YEAR(lbExpireDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS PL,(SELECT tpLicense FROM Transport WHERE tpFactory = FactoryID AND YEAR(tpDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS TL, (SELECT SaleLicenseID FROM SaleLicense WHERE slFactoryID = FactoryID AND YEAR(slExtendDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS SL FROM Factory WHERE ? IN (0,faRegion) AND ? IN (0,faProvince)) AS AllData WHERE CONCAT(FL,'@',IF(ISNULL(PL),'',PL),'@',IF(ISNULL(TL),'',TL),'@',IF(ISNULL(SL),'',SL)) LIKE ?",array("iiis",$year,$region,$province,"%".$Keyword."%"));
								$ldata[0] = $DB->GetDataOneField("SELECT COUNT(FactoryID) FROM Factory WHERE YEAR(faIssueDate + INTERVAL 3 MONTH) = ? AND ? IN (0,faRegion) AND  ? IN (0,faProvince) AND faCode LIKE ?",array("iiis",$year,$region,$province,"%".$Keyword."%"));
								$ldata[1] = $DB->GetDataOneField("SELECT COUNT(LabelID) FROM Label WHERE YEAR(lbIssueDate+ INTERVAL 3 MONTH) = ? AND ? IN (0,lbRegion) AND  ? IN (0,lbProvince) AND lbLicense LIKE ?",array("iiis",$year,$region,$province,"%".$Keyword."%"));
								$ldata[2] = $DB->GetDataOneField("SELECT COUNT(SaleLicenseID) FROM SaleLicense, Factory WHERE slFactoryID = FactoryID AND YEAR(slExtendDate + INTERVAL 3 MONTH) = ? AND ? IN (0,faRegion) AND  ? IN (0,faProvince) AND SaleLicenseID LIKE ?",array("iiis",$year,$region,$province,"%".$Keyword."%"));
								$ldata[3] = $DB->GetDataOneField("SELECT COUNT(TransportID) FROM Transport WHERE YEAR(tpDate + INTERVAL 3 MONTH) = ? AND ? IN (0,tpRegion) AND ? IN (0,tpProvince) AND tpLicense LIKE ?",array("iiis",$year,$region,$province,"%".$Keyword."%"));
								$ldata[4] = $ldata[0] + $ldata[1] + $ldata[2] + $ldata[3];

        
								$DB->GetData("SELECT faName, faCode, FL, PL, TL, SL, faLat, faLong  FROM (SELECT ? AS Y, faName, faCode, faCode AS FL,(SELECT lbLicense FROM `Label` WHERE lbFacCode = FactoryID AND YEAR(lbExpireDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS PL,(SELECT tpLicense FROM Transport WHERE tpFactory = FactoryID AND YEAR(tpDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS TL, (SELECT SaleLicenseID FROM SaleLicense WHERE slFactoryID = FactoryID AND YEAR(slExtendDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS SL, faLat, faLong FROM Factory WHERE ? IN (0,faRegion) AND ? IN (0,faProvince)) AS AllData WHERE CONCAT(FL,'@',IF(ISNULL(PL),'',PL),'@',IF(ISNULL(TL),'',TL),'@',IF(ISNULL(SL),'',SL)) LIKE ? LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));

								switch($menu){
									case 4 :
										$total = $ldata[3];
										$DB->GetData("SELECT faName, faLat, faLong, tpFactory, tpLicense AS TL, (SELECT faCode FROM Factory WHERE FactoryID = tpFactory LIMIT 1) AS FL, (SELECT lbLicense FROM `Label` WHERE tpFactory = lbFacCode LIMIT 1) AS PL, (SELECT SaleLicenseID FROM SaleLicense WHERE slFactoryID = tpFactory LIMIT 1) AS SL FROM (SELECT tpFactory, tpLicense FROM Transport WHERE YEAR(tpDate + INTERVAL 3 MONTH) = ? AND ? IN (0,tpRegion) AND ? IN (0,tpProvince) AND tpLicense LIKE ?) AS ALLData LEFT JOIN Factory ON FactoryID = tpFactory LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
										break;
									case 3 :
										$total = $ldata[2];
										$DB->GetData("SELECT faName, faLat, faLong, slFactoryID, SaleLicenseID AS SL, faCode AS FL, (SELECT tpLicense FROM Transport WHERE tpFactory = slFactoryID LIMIT 1) AS TL, (SELECT lbLicense FROM `Label` WHERE slFactoryID = lbFacCode LIMIT 1) AS PL FROM SaleLicense, Factory WHERE FactoryID = slFactoryID AND YEAR(slIssueDate + INTERVAL 3 MONTH) = ? AND ? IN (0,faRegion) AND ? IN (0,faProvince) AND SaleLicenseID LIKE ? LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
										break;
									case 2 :
										$total = $ldata[1];
										$DB->GetData("SELECT faName, faLat, faLong, lbFacCode, lbLicense AS PL, (SELECT faCode FROM Factory WHERE FactoryID = lbFacCode LIMIT 1) AS FL, (SELECT tpLicense FROM Transport WHERE tpFactory = lbFacCode LIMIT 1) AS TL, (SELECT SaleLicenseID FROM SaleLicense WHERE slFactoryID = lbFacCode LIMIT 1) AS SL FROM (SELECT lbFacCode, lbLicense FROM `Label` WHERE YEAR(lbIssueDate + INTERVAL 3 MONTH) = ? AND ? IN (0,lbRegion) AND ? IN (0,lbProvince) AND lbLicense LIKE ?) AS ALLData LEFT JOIN Factory ON FactoryID = lbFacCode LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
										break;
									case 1 :
									default :
										$total = $ldata[0];
										$DB->GetData("SELECT faName, faCode, FL, PL, TL, SL, faLat, faLong  FROM (SELECT ? AS Y, faName, faCode, faCode AS FL,(SELECT lbLicense FROM `Label` WHERE lbFacCode = FactoryID AND YEAR(lbExpireDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS PL,(SELECT tpLicense FROM Transport WHERE tpFactory = FactoryID AND YEAR(tpDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS TL, (SELECT SaleLicenseID FROM SaleLicense WHERE slFactoryID = FactoryID AND YEAR(slExtendDate + INTERVAL 3 MONTH) = Y LIMIT 1) AS SL, faLat, faLong FROM Factory WHERE ? IN (0,faRegion) AND ? IN (0,faProvince)) AS AllData WHERE FL LIKE ? LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
								}
*/

								$total = 0;
								$ldata = array(
									"รวม" => 0,
									"สุรา" => 0,
									"ยาสูบ" => 0,
									"ไพ่" => 0,
									"2527" => 0,
									"รายวัน" => 0,
								);
								$prb = array("รวม","สุรา","ยาสูบ","ไพ่","2527","รายวัน");
								$DB->GetData("SELECT ltTitle,COUNT(COM_NAME) AS C FROM (SELECT COM_NAME, CUS_ID, ltTitle, COUNT(LIC_NO) AS Amount,Lat,Lon FROM (SELECT CUS_ID, LIC_DATE, elRegion, elArea, ltTitle, COM_NAME, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT `regis_number`, cdate,ifRegion,ifArea,'2527',`name`,lat,lon,`regis_number` FROM Information_excise_registration ) AS alldata WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND ? IN (0,elRegion) AND ? IN (0,elArea) GROUP BY COM_NAME,ltTitle) AS T1 GROUP BY ltTitle",array("iii",$year,$region,$province));

								while($subTotal = $DB->FetchData()){
									$ldata["รวม"] += $subTotal["C"];
									$ldata[$subTotal["ltTitle"]] = $subTotal["C"];
								}

								switch($menu){
									case 0 :
											$total = $DB->GetDataOneField("SELECT COUNT(COM_NAME) FROM (SELECT COM_NAME, CUS_ID, ltTitle, COUNT(LIC_NO) AS Amount,Lat,Lon FROM (SELECT CUS_ID, LIC_DATE, elRegion, elArea, ltTitle, COM_NAME, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT `regis_number`, cdate,ifRegion,ifArea,'2527',`name`,lat,lon,`regis_number` FROM Information_excise_registration ) AS alldata WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND ? IN (0,elRegion) AND ? IN (0,elArea) GROUP BY COM_NAME,ltTitle) AS T1 WHERE COM_NAME LIKE ? GROUP BY COM_NAME",array("iiis",$year,$region,$province,"%".$Keyword."%"));
											$DB->GetData("SELECT COM_NAME,CUS_ID,Lat,Lon, SUM(IF(ltTitle = 'สุรา',Amount,0)) AS C1, SUM(IF(ltTitle = 'ยาสูบ',Amount,0)) AS C2, SUM(IF(ltTitle = 'ไพ่',Amount,0)) AS C3, SUM(IF(ltTitle = '2527',Amount,0)) AS C4 FROM (SELECT COM_NAME, CUS_ID, ltTitle, COUNT(LIC_NO) AS Amount,Lat,Lon FROM (SELECT CUS_ID, LIC_DATE, elRegion, elArea, ltTitle, COM_NAME, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT `regis_number`, cdate,ifRegion,ifArea,'2527',`name`,lat,lon,`regis_number` FROM Information_excise_registration ) AS alldata WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND ? IN (0,elRegion) AND ? IN (0,elArea) GROUP BY COM_NAME,ltTitle) AS T1 WHERE COM_NAME LIKE ? GROUP BY COM_NAME LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
										break;
									case 1 :
									case 2 :
									case 3 :
									case 4 :
											$total = $DB->GetDataOneField("SELECT COUNT(*) FROM (SELECT COM_NAME,CUS_ID,Lat,Lon, SUM(IF(ltTitle = 'สุรา',Amount,0)) AS C1, SUM(IF(ltTitle = 'ยาสูบ',Amount,0)) AS C2, SUM(IF(ltTitle = 'ไพ่',Amount,0)) AS C3, SUM(IF(ltTitle = '2527',Amount,0)) AS C4 FROM (SELECT COM_NAME, CUS_ID, ltTitle, COUNT(LIC_NO) AS Amount,Lat,Lon FROM (SELECT CUS_ID, LIC_DATE, elRegion, elArea, ltTitle, COM_NAME, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT `regis_number`, cdate,ifRegion,ifArea,'2527',`name`,lat,lon,`regis_number` FROM Information_excise_registration ) AS alldata WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND ? IN (0,elRegion) AND ? IN (0,elArea) GROUP BY COM_NAME,ltTitle) AS T1 WHERE COM_NAME LIKE ? GROUP BY COM_NAME) AS T2 WHERE C".intval($menu)." > 0",array("iiis",$year,$region,$province,"%".$Keyword."%"));
											$DB->GetData("SELECT * FROM (SELECT COM_NAME,CUS_ID,Lat,Lon, SUM(IF(ltTitle = 'สุรา',Amount,0)) AS C1, SUM(IF(ltTitle = 'ยาสูบ',Amount,0)) AS C2, SUM(IF(ltTitle = 'ไพ่',Amount,0)) AS C3, SUM(IF(ltTitle = '2527',Amount,0)) AS C4 FROM (SELECT COM_NAME, CUS_ID, ltTitle, COUNT(LIC_NO) AS Amount,Lat,Lon FROM (SELECT CUS_ID, LIC_DATE, elRegion, elArea, ltTitle, COM_NAME, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT `regis_number`, cdate,ifRegion,ifArea,'2527',`name`,lat,lon,`regis_number` FROM Information_excise_registration ) AS alldata WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND ? IN (0,elRegion) AND ? IN (0,elArea) GROUP BY COM_NAME,ltTitle) AS T1 WHERE COM_NAME LIKE ? GROUP BY COM_NAME) AS T2 WHERE C".intval($menu)." > 0 LIMIT ?,?",array("iiisii",$year,$region,$province,"%".$Keyword."%",$page*$RPP,$RPP));
										break;
									default :
											$total = 0;
											$DB->GetData("SELECT * FROM (SELECT NULL AS A) AS B WHERE A = 1");
								}

        
								$data = new exSearch_Table;
								$data->Init(3,$page+1,$RPP,$total,array($ldata["สุรา"],$ldata["ยาสูบ"],$ldata["ไพ่"],$ldata["2527"],$ldata["รายวัน"],$ldata["รวม"]));
        
								if($total > 0){
									$etcObj = new exETC;
									for($i=0;$i<$colnum;$i++){
										$data->AddLabel($TitleShow[$i]);
									}
									for($x=($page * $RPP + 1);$fdata = $DB->FetchData();$x++){
										$data->AddCell($x,1);
										$data->AddCell(isset($fdata["COM_NAME"])?$fdata["COM_NAME"]:"-");
										$data->AddCell(isset($fdata["CUS_ID"])?$fdata["CUS_ID"]:"-",2);
										$data->AddCell(isset($fdata["C1"])?$fdata["C1"]:"0",2);
										$data->AddCell(isset($fdata["C2"])?$fdata["C2"]:"0",2);
										$data->AddCell(isset($fdata["C3"])?$fdata["C3"]:"0",2);
										$data->AddCell(isset($fdata["C4"])?$fdata["C4"]:"0",2);
										$data->AddCell("-",2);
										$data->AddLatLong($x,$fdata["Lat"],$fdata["Lon"]);
									}
								}
							break;
						case 4:
								$DB = new ezDB;
								$prb = array("","สุรา","ยาสูบ","ไพ่","2527","oneday","unknow");
								$total = $DB->GetDataOneField("SELECT COUNT(COM_NAME) FROM (SELECT LIC_DATE, elRegion, elArea, ltTitle AS prb ,COM_NAME, ltTitle, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT cdate, ifRegion, ifArea, '2527' AS prb, name, type, `lat`,`lon`, regis_number FROM `Information_excise_registration` UNION SELECT cdate, REGCODE,EXCISECODE, 'unknow' AS  prb,COM_NAME,SHOPTYPE, `LAT`,`LONG`, '' AS regisno FROM `Bar_Data_New` WHERE EXCISECODE IS NOT NULL) AS AllCom WHERE ? IN (0,elRegion) AND ? IN (0,elArea) AND YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND prb LIKE ? AND `COM_NAME` LIKE ?",array("iiiss",$region,$province,$year,"%".$prb[$menu]."%","%".$Keyword."%"));
								$tdata = $DB->GetDataOneRow("SELECT SUM(IF(prb='สุรา',1,0)) AS C1,SUM(IF(prb='ยาสูบ',1,0)) AS C2,SUM(IF(prb='ไพ่',1,0)) AS C3,SUM(IF(prb='2527',1,0)) AS C4, 0 AS C5, SUM(IF(prb='unknow',1,0)) AS C6, COUNT(COM_NAME) AS SALL FROM (SELECT LIC_DATE, elRegion, elArea, ltTitle AS prb ,COM_NAME, ltTitle, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT cdate, ifRegion, ifArea, '2527' AS prb, name, type, `lat`,`lon`, regis_number FROM `Information_excise_registration` UNION SELECT cdate, REGCODE,EXCISECODE, 'unknow' AS  prb,COM_NAME,SHOPTYPE, `LAT`,`LONG`, '' AS regisno FROM `Bar_Data_New` WHERE EXCISECODE IS NOT NULL AND COM_NAME IS NOT NULL) AS AllCom WHERE ? IN (0,elRegion) AND ? IN (0,elArea) AND YEAR(LIC_DATE + INTERVAL 3 MONTH) = ?",array("iii",$region,$province,$year));
//								$tdata = $DB->GetDataOneRow("SELECT SUM(IF(LType = 'ส',1,0)) AS C1, SUM(IF(LType = 'ย',1,0)) AS C2, SUM(IF(LType = 'พ',1,0)) AS C3, SUM(IF(LType = '2',1,0)) AS C4, 0 AS C5, COUNT(regis_number) AS SALL FROM (SELECT `cdate`,`regis_number`,`ifRegion`,`ifProvince`,`ifArea`, '2' AS LType FROM Information_excise_registration UNION SELECT `LIC_DATE`,`LIC_NO`,`elRegion`,`elProvince`,`elArea`, SUBSTRING(`LIC_TYPE`,1,1) FROM Excise_License) AS X WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND ? IN (0, ifArea) AND ? IN (0, ifRegion)",array("iii",$year,$province,$region));

								$DB->GetData("SELECT * FROM (SELECT LIC_DATE, elRegion, elArea, ltTitle AS prb ,COM_NAME, ltTitle, CONCAT(IF(`ADDNO`IS NULL,'',`ADDNO`), IF(`BUILDING` IS NULL,'',CONCAT(' ',`BUILDING`)), IF(`FLOORNO` IS NULL,'',CONCAT(' ชั้น ',`FLOORNO`)), IF(`VILLAGE` IS NULL,'',CONCAT(' หมู่บ้าน',`VILLAGE`)),IF(`MOONO` IS NULL,'',CONCAT(' หมู่ที่ ',`MOONO`)), IF(`SOINAME` IS NULL,'',CONCAT(' ซอย',`SOINAME`)), IF(`TAMBOL_NAME` IS NULL,'',CONCAT(' ',`TAMBOL_NAME`)), IF(`AMPHUR_NAME` IS NULL,'',CONCAT(' ',`AMPHUR_NAME`)), IF(`PROVINCE_NAME` IS NULL,'',CONCAT(' ',`PROVINCE_NAME`)), ' ',IF(`POSCODE` IS NULL,'',`POSCODE`)) AS address, `Lat`,`Lon`, LIC_NO FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT cdate, ifRegion, ifArea, '2527' AS prb, name, type, fac_address, `lat`,`lon`, regis_number FROM `Information_excise_registration` UNION SELECT cdate, REGCODE,EXCISECODE, 'unknow' AS  prb,COM_NAME,SHOPTYPE,ADDRESS, `LAT`,`LONG`, '' AS regisno FROM `Bar_Data_New` WHERE EXCISECODE IS NOT NULL) AS AllCom WHERE ? IN (0,elRegion) AND ? IN (0,elArea) AND YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND prb LIKE ? AND `COM_NAME` LIKE ? LIMIT ?,?",array("iiissii",$region,$province,$year,"%".$prb[$menu]."%","%".$Keyword."%",$page*$RPP,$RPP));
                
								$data = new exSearch_Table;
								$data->Init(4,$page+1,$RPP,$total,array($tdata["C1"],$tdata["C2"],$tdata["C3"],$tdata["C4"],$tdata["C5"],$tdata["C6"],$tdata["SALL"]));
								if($total > 0){
									$etcObj = new exETC;
									for($i=0;$i<$colnum;$i++){
										$data->AddLabel($TitleShow[$i]);
									}
									for($x=($page * $RPP + 1);$fdata = $DB->FetchData();$x++){
										$data->AddCell($x,1);
										$data->AddCell($fdata["COM_NAME"]);
										$data->AddCell($fdata["ltTitle"]);
										$data->AddCell($fdata["address"]);
										$data->AddCell($fdata["Lat"].",".$fdata["Lon"],2);
										$data->AddCell($fdata["LIC_NO"],2);
										$data->AddLatLong($x,$fdata["Lat"],$fdata["Lon"]);
									}
								}
							break;
						case 5:
									$DB = new ezDB;
									$LV = array(0,0,0,0,0);
									$LvText = array("","อุดม","อาชีว","มัธยม","ประถม");
/*									$DB->GetData("SELECT IF(`Level`='อุดมศึกษา',1,IF(`Level`='อาชีวศึกษา',2,IF(`Level`='มัธยมศึกษา',3,4))) AS L, COUNT(`no`) AS C FROM `Academy` WHERE ? IN (0, REGCODE) AND ? IN (0,EXCISECODE) GROUP BY `Level`",array("ii",$region,$province));
									while($fdata = $DB->FetchData()){
										$LV[$fdata["L"]] = $fdata["C"];
										$LV[0] += $fdata["C"];
									}*/
									$LV = $DB->GetDataOneRow("SELECT SUM(acPrimary+acSecounary+acHigh+acUniversity),SUM(acUniversity), SUM(acHigh), SUM(acSecounary), SUM(acPrimary) FROM `AcademyCount` WHERE ? IN (0,acRegion) AND ? IN (0,acArea)",array("ii",$region,$province));
									$total = $DB->GetDataOneField("SELECT COUNT(Name) FROM `Academy` WHERE ? IN (0, REGCODE) AND ? IN (0,EXCISECODE) AND `Level` LIKE ? AND Name LIKE ?",array("iiss",$region,$province,"%".$LvText[$menu]."%","%".$Keyword."%"));
									$DB->GetData("SELECT `Name`, `Address`, `Province`, `Type`, `Level`,`Lat`,`Lon`,COUNT(id) AS C FROM (SELECT `no`, Name, CONCAT(TAMTNAME, ' ', AMPTNAME, ' ',Province) AS Address, Province, `Type`, `Level`, `Lat`,`Lon` FROM `Academy` WHERE ? IN (0, REGCODE) AND ? IN (0,EXCISECODE) AND `Level` LIKE ? AND Name LIKE ?) AS X LEFT JOIN Bar_Data_Zoning_Mapping ON id_acadamy_zone = `no` GROUP BY `no` LIMIT ?,?",array("iissii",$region,$province,"%".$LvText[$menu]."%","%".$Keyword."%",$page*$RPP,$RPP));

									$data = new exSearch_Table;
									$data->Init(5,$page+1,$RPP,$total,array($LV[1],$LV[2],$LV[3],$LV[4],$LV[0]));
									if($total > 0){
										$etcObj = new exETC;
										for($i=0;$i<$colnum;$i++){
											$data->AddLabel($TitleShow[$i]);
										}
										for($x=($page * $RPP + 1);$fdata = $DB->FetchData();$x++){
											$data->AddCell($x,1);
											$data->AddCell($fdata["Name"]);
											$data->AddCell($fdata["Address"]);
											$data->AddCell($fdata["Province"]);
											$data->AddCell(is_null($fdata["Type"])==true?"-":$fdata["Type"],2);
											$data->AddCell($fdata["Level"],2);
											$data->AddCell($fdata["Lat"]);
											$data->AddCell($fdata["Lon"]);
											$data->AddCell($fdata["C"],1);
											$data->AddLatLong($x,$fdata["Lat"],$fdata["Lon"]);
										}
									}
						break;
						case 6:
									$DB = new ezDB;
									$LV = array(0,0,0,0,0,0);
									$LvText = array("","อุดม","อาชีว","มัธยม","ประถม");
									$DB->GetData("SELECT IF(`Level`='อุดมศึกษา',1,IF(`Level`='อาชีวศึกษา',2,IF(`Level`='มัธยมศึกษา',3,4))) AS L, COUNT(`no`) AS C FROM Academy, (SELECT AcademyID, `name`,regis_number, '-' AS C1, '-' AS C2, '-' AS C3, regis_number AS C4, '-' AS C5 FROM `Information_excise_registration`,ACademyLink WHERE id = CompanyID AND TableID = 2
UNION SELECT AcademyID, COM_NAME, FAC_ID, IF(SUBSTR(LIC_TYPE,1,1)='ส',LIC_NO,'-') AS C1, IF(SUBSTR(LIC_TYPE,1,1)='ย',LIC_NO,'-') AS C2, IF(SUBSTR(LIC_TYPE,1,1)='พ',LIC_NO,'-') AS C3, '-' AS C4, '-' AS C5 FROM Excise_License, ACademyLink WHERE id = CompanyID AND TableID = 1 UNION SELECT AcademyID, COM_NAME, LIC_ID, '-' AS C1, '-' AS C2, '-' AS C3, '-' AS C4, '-' AS C5 FROM `Bar_Data_New`,ACademyLink WHERE ID = CompanyID AND TableID = 3) AS X1 WHERE `no` = AcademyID AND ? IN (0, REGCODE) AND ? IN (0,EXCISECODE) GROUP BY `Level`",array("ii",$region,$province));
									while($fdata = $DB->FetchData()){
										$LV[$fdata["L"]] = $fdata["C"];
										$LV[0] += $fdata["C"];
									}

									$total = $DB->GetDataOneField("SELECT COUNT(*) FROM Academy, (SELECT AcademyID, `name`,regis_number FROM `Information_excise_registration`,ACademyLink WHERE id = CompanyID AND TableID = 2 UNION SELECT AcademyID, COM_NAME, FAC_ID FROM Excise_License, ACademyLink WHERE id = CompanyID AND TableID = 1 UNION SELECT AcademyID, COM_NAME, LIC_ID FROM `Bar_Data_New`,ACademyLink WHERE ID = CompanyID AND TableID = 3) AS X1 WHERE `no` = AcademyID AND ? IN (0, REGCODE) AND ? IN (0,EXCISECODE) AND `Level` LIKE ? AND Academy.Name LIKE ?",array("iiss",$region,$province,"%".$LvText[$menu]."%","%".$Keyword."%"));

									$DB->GetData("SELECT Academy.Name AS AName, X1.* FROM Academy, (SELECT AcademyID, Lat AS fLat, Lon AS fLong, COM_NAME, FAC_ID, IF(SUBSTR(LIC_TYPE,1,1)='ส',LIC_NO,'-') AS C1, IF(SUBSTR(LIC_TYPE,1,1)='ย',LIC_NO,'-') AS C2, IF(SUBSTR(LIC_TYPE,1,1)='พ',LIC_NO,'-') AS C3, '-' AS C4, '-' AS C5 FROM Excise_License, ACademyLink WHERE id = CompanyID AND TableID = 1 UNION SELECT AcademyID, lat AS fLat, lon AS fLong, `name`,regis_number, '-' AS C1, '-' AS C2, '-' AS C3, regis_number AS C4, '-' AS C5 FROM `Information_excise_registration`,ACademyLink WHERE id = CompanyID AND TableID = 2 UNION SELECT AcademyID, LAT AS fLat, `LONG` AS fLong, COM_NAME, LIC_ID, '-' AS C1, '-' AS C2, '-' AS C3, '-' AS C4, '-' AS C5 FROM `Bar_Data_New`,ACademyLink WHERE ID = CompanyID AND TableID = 3) AS X1 WHERE `no` = AcademyID AND ? IN (0, REGCODE) AND ? IN (0,EXCISECODE) AND `Level` LIKE ? AND Academy.Name LIKE ? LIMIT ?,?",array("iissii",$region,$province,"%".$LvText[$menu]."%","%".$Keyword."%",$page*$RPP,$RPP));
									$data = new exSearch_Table;
									$data->Init(6,$page+1,$RPP,$total,array($LV[1],$LV[2],$LV[3],$LV[4],$LV[0]));
									if($total > 0){
										$etcObj = new exETC;
										for($i=0;$i<$colnum;$i++){
											$data->AddLabel($TitleShow[$i]);
										}
										for($x=($page * $RPP + 1);$fdata = $DB->FetchData();$x++){
											$data->AddCell($x,1);
											$data->AddCell($fdata["AName"]);
											$data->AddCell($fdata["COM_NAME"]);
											$data->AddCell($fdata["FAC_ID"]);
											$data->AddCell($fdata["C1"],2);
											$data->AddCell($fdata["C2"],2);
											$data->AddCell($fdata["C3"],2);
											$data->AddCell($fdata["C4"],2);
											$data->AddCell($fdata["C5"],2);
											$data->AddLatLong($x,$fdata["fLat"],$fdata["fLong"]);
										}
									}
						break;
						default:
								$data = new exReport_Table;
								$data->Init($page+1,$RPP,100,array(1,2,3,4));
								
								for($i=0;$i<$colnum;$i++){
									$data->AddLabel($TitleShow[$i]);
								}
								for($i=0;$i < $RPP;$i++){
									for($j=0;$j<$colnum - 1;$j++){
										$data->AddCell("dummy".rand(10000,99999));
									}
									$data->AddCell(rand(1000000,9999999)/100,1);
                                                                }
					}
				}
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
					}elseif(($data->job == 6)){
						$DB->GetData("SELECT DISTINCT YEAR(LIC_DATE + INTERVAL 3 MONTH) AS fYear FROM `Excise_License` UNION SELECT DISTINCT YEAR(cdate + INTERVAL 3 MONTH) AS fYear FROM `Information_excise_registration` GROUP BY fYear ORDER BY fYear DESC");
						for($x=1;$fdata = $DB->FetchData();$x++){
							$sdata = new exItem;
							$sdata->id = $x;
							$sdata->value = $fdata["fYear"];
							$sdata->label = "ปีงบประมาณ ".($fdata["fYear"] + 543);
							array_push($data->year,$sdata);
						}
					}else{
						$sdata = new exItem;
						$sdata->id = 1;
						$sdata->value = date("Y");
						$sdata->label = "ปีงบประมาณ ".(date("Y") + 543);
						array_push($data->year,$sdata);
					}

					$sdata = new exItem;
					$sdata->id = 0;
					$sdata->value = 0;
					$sdata->label = "ทุกภาค";
					array_push($data->region,$sdata);

					$DB->GetData("SELECT REG_CODE, LPAD(`REG_CODE`,2,0) AS RegionID, `REG_TNAME`,`LAT`,`LONG` FROM `Excise_REGION`");
					while($fdata = $DB->FetchData()){
						$sdata = new exItem;
						$sdata->id = $fdata["REG_CODE"];
						$sdata->value = $fdata["REG_CODE"];
						$sdata->label = $fdata["REG_TNAME"];
						$sdata->lat = $fdata["LAT"];
						$sdata->long = $fdata["LONG"];
						array_push($data->region,$sdata);
					}

					$sdata = new exItem;
					$sdata->id = 0;
					$sdata->value = 0;
					$sdata->label = "ทุกพื้นที่";
					array_push($data->province,$sdata);

					$DB->GetData("SELECT EXCISECODE, LPAD(`EXCISECODE`,5,0) AS AreaID, `EXCISETNAME`, `LAT`,`LONG`  FROM `Excise_Area`");
					while($fdata = $DB->FetchData()){
						$sdata = new exItem;
						$sdata->id = $fdata["EXCISECODE"];
						$sdata->value = $fdata["EXCISECODE"];
						$sdata->label = $fdata["EXCISETNAME"];
						$sdata->lat = $fdata["LAT"];
						$sdata->long = $fdata["LONG"];
						array_push($data->province,$sdata);
					}
				}else{
					$S_region = isset($_POST["value"])?intval($_POST["value"]):0;
					$DB->GetData("SELECT `EXCISECODE`, LPAD(`EXCISECODE`,5,0) AS AreaID, `EXCISETNAME`, `LAT`, `LONG` FROM `Excise_Area` WHERE ? IN (0,REGCODE)",array("i",$S_region));

					if($DB->GetNumRows()>0){
						$data = array();
						$sdata = new exItem;
						$sdata->id = 0;
						$sdata->value = 0;
						$sdata->label = "ทุกพื้นที่";
						array_push($data,$sdata);

						while($fdata = $DB->FetchData()){
							$sdata = new exItem;
							$sdata->id = $fdata["EXCISECODE"];
							$sdata->value = $fdata["EXCISECODE"];
							$sdata->label = $fdata["EXCISETNAME"];
							$sdata->lat = $fdata["LAT"];
							$sdata->long = $fdata["LONG"];
							array_push($data,$sdata);
						}
					}else{
						$data = null;
					}
				}
			break;

	case "autocomplete" :
				$year = isset($_POST["year"])?$_POST["year"]:date("Y");
				$menu = isset($_POST["menu"])?intval($_POST["menu"]):0;
				switch($_POST["src"]){
					case 1: //โรงงาน
							$data = array();
        
							$DB = new exDB;
							$DB->GetData("SELECT `FactoryID`, `faName` FROM `Factory` WHERE YEAR(faIssueDate + INTERVAL 3 MONTH) = ? AND faName LIKE ? LIMIT 10",array("is",$year,"%".$_POST["value"]."%"));
        
							while($fdata = $DB->FetchData()){
								$sdata = new exItem;
								$sdata->id = $fdata["FactoryID"];
								$sdata->value = $fdata["faName"];
								$sdata->label = $fdata["faName"];
								array_push($data,$sdata);
							}
						break;
					case 2: //ปราบปราม
							$data = array();
        
							$DB = new ezDB;
							$DB->GetData("SELECT `id`, `SUSPECTS_NAME` FROM `illigal_nopoint` WHERE YEAR(DateApprove + INTERVAL 3 MONTH) = ? AND SUSPECTS_NAME LIKE ? LIMIT 10",array("is",$year,"%".$_POST["value"]."%"));
        
							while($fdata = $DB->FetchData()){
								$sdata = new exItem;
								$sdata->id = $fdata["id"];
								$sdata->value = $fdata["SUSPECTS_NAME"];
								$sdata->label = $fdata["SUSPECTS_NAME"];
								array_push($data,$sdata);
							}
						break;
					case 3: //ใบอนุญาต
							$menu = isset($_POST["menu"])?$_POST["menu"]:0;
							$data = array();
							$DB = new ezDB;
							switch($menu){
								case 1:
								case 2:
								case 3:
									$lt = array("","ส","ย","พ");
									$DB->GetData("SELECT `id`, COM_NAME AS fName, COM_NAME AS fNameShow FROM `Excise_License` WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND SUBSTRING(LIC_TYPE,1,1) LIKE ? AND (`COM_NAME` LIKE ? OR TRIM(`LIC_NO`) = ?) GROUP BY COM_NAME LIMIT 10",array("isss",$year,$lt[$menu],"%".$_POST["value"]."%",$_POST["value"]));
									if(strlen($_POST["value"]) > 8){
										if(preg_replace('/[^0-9]+/', '', $_POST["value"]) == $_POST["value"]){
											$DB->GetData("SELECT `id`, COM_NAME AS fName, CONCAT('ใบอนุญาตเลขที่ ',LIC_NO) AS fNameShow FROM `Excise_License` WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND SUBSTRING(LIC_TYPE,1,1) LIKE ? AND `LIC_NO` LIKE ? GROUP BY COM_NAME LIMIT 10",array("iss",$year,$lt[$menu],$_POST["value"]."%"));
										}
									}
								break;
								case 4:
									$DB->GetData("SELECT `id`, `name` AS fName , `name` AS fNameShow FROM `Information_excise_registration` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND (`name` LIKE ? OR `regis_number` = ?) GROUP BY `name` LIMIT 10",array("iss",$year,"%".$_POST["value"]."%",$_POST["value"]));
									if(strlen($_POST["value"]) > 8){
										if(preg_replace('/[^0-9]+/', '', $_POST["value"]) == $_POST["value"]){
											$DB->GetData("SELECT `id`, `name` AS fName , CONCAT('ใบอนุญาตเลขที่ ',regis_number) AS fNameShow FROM `Information_excise_registration` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND `regis_number` LIKE ? GROUP BY `name` LIMIT 10",array("is",$year,$_POST["value"]."%"));
										}
									}
								break;
								case 5:
									$DB->GetData("SELECT X FROM (SELECT 0 AS X) AS Y WHERE X = 1");
								break;
								default:
									$DB->GetData("SELECT `id`, COM_NAME AS fName, COM_NAME AS fNameShow FROM (SELECT id, LIC_DATE, COM_NAME FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT id,cdate, name FROM `Information_excise_registration` UNION SELECT ID, cdate, COM_NAME FROM `Bar_Data_New` WHERE EXCISECODE IS NOT NULL) AS AllCom WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND `COM_NAME` LIKE ? LIMIT 10",array("is",$year,"%".$_POST["value"]."%"));
									if(strlen($_POST["value"]) > 8){
										if(preg_replace('/[^0-9]+/', '', $_POST["value"]) == $_POST["value"]){
											$DB->GetData("SELECT `id`, COM_NAME AS fName, CONCAT('ใบอนุญาตเลขที่ ',LIC_NO) AS fNameShow FROM ( SELECT LIC_DATE, id, COM_NAME, LIC_NO FROM `Excise_License` UNION SELECT cdate, `id`, `name`, regis_number FROM `Information_excise_registration` ) AS AllCom WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND `LIC_NO` LIKE ? LIMIT 10",array("is",$year,$_POST["value"]."%"));
										}
									}
							}
							while($fdata = $DB->FetchData()){
								$sdata = new exItem;
								$sdata->id = $fdata["id"];
								$sdata->value = $fdata["fName"];
								$sdata->label = $fdata["fNameShow"];
								array_push($data,$sdata);
							}
						break;
					case 4: //สถานประกอบการ
							$menu = isset($_POST["menu"])?$_POST["menu"]:0;
							$data = array();
							$DB = new ezDB;
							switch($menu){
								case 1:
								case 2:
								case 3:
									$lt = array("","ส","ย","พ");
									$DB->GetData("SELECT `id`, COM_NAME AS fName, COM_NAME AS fNameShow FROM `Excise_License` WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND SUBSTRING(LIC_TYPE,1,1) LIKE ? AND (`COM_NAME` LIKE ? OR TRIM(`LIC_NO`) = ?) GROUP BY COM_NAME LIMIT 10",array("isss",$year,$lt[$menu],"%".$_POST["value"]."%",$_POST["value"]));
									if(strlen($_POST["value"]) > 8){
										if(preg_replace('/[^0-9]+/', '', $_POST["value"]) == $_POST["value"]){
											$DB->GetData("SELECT `id`, COM_NAME AS fName, CONCAT('ใบอนุญาตเลขที่ ',LIC_NO) AS fNameShow FROM `Excise_License` WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND SUBSTRING(LIC_TYPE,1,1) LIKE ? AND `LIC_NO` LIKE ? GROUP BY COM_NAME LIMIT 10",array("iss",$year,$lt[$menu],$_POST["value"]."%"));
										}
									}
								break;
								case 4:
									$DB->GetData("SELECT `id`, `name` AS fName, `name` AS fNameShow FROM `Information_excise_registration` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND (`name` LIKE ? OR `regis_number` = ?) GROUP BY `name` LIMIT 10",array("iss",$year,"%".$_POST["value"]."%",$_POST["value"]));
									$DB->GetData("SELECT `id`, `name` AS fName , `name` AS fNameShow FROM `Information_excise_registration` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND (`name` LIKE ? OR `regis_number` = ?) GROUP BY `name` LIMIT 10",array("iss",$year,"%".$_POST["value"]."%",$_POST["value"]));
									if(strlen($_POST["value"]) > 8){
										if(preg_replace('/[^0-9]+/', '', $_POST["value"]) == $_POST["value"]){
											$DB->GetData("SELECT `id`, `name` AS fName , CONCAT('ใบอนุญาตเลขที่ ',regis_number) AS fNameShow FROM `Information_excise_registration` WHERE YEAR(cdate + INTERVAL 3 MONTH) = ? AND `regis_number` LIKE ? GROUP BY `name` LIMIT 10",array("is",$year,$_POST["value"]."%"));
										}
									}
								break;
								default:
									$DB->GetData("SELECT `id`, COM_NAME as fName, COM_NAME AS fNameShow FROM (SELECT id, LIC_DATE, COM_NAME FROM `Excise_License`,`LicenseType` WHERE LicenseTypeID = LIC_TYPE GROUP BY `Excise_License`.`id` UNION SELECT id, cdate, name FROM `Information_excise_registration` UNION SELECT ID, cdate, COM_NAME FROM `Bar_Data_New` WHERE EXCISECODE IS NOT NULL) AS AllCom WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND `COM_NAME` LIKE ? LIMIT 10",array("is",$year,"%".$_POST["value"]."%"));
									if(strlen($_POST["value"]) > 8){
										if(preg_replace('/[^0-9]+/', '', $_POST["value"]) == $_POST["value"]){
											$DB->GetData("SELECT `id`, COM_NAME AS fName, CONCAT('ใบอนุญาตเลขที่ ',LIC_NO) AS fNameShow FROM ( SELECT LIC_DATE, id, COM_NAME, LIC_NO FROM `Excise_License` UNION SELECT cdate, `id`, `name`, regis_number FROM `Information_excise_registration` ) AS AllCom WHERE YEAR(LIC_DATE + INTERVAL 3 MONTH) = ? AND `LIC_NO` LIKE ? LIMIT 10",array("is",$year,$_POST["value"]."%"));
										}
									}
							}
							while($fdata = $DB->FetchData()){
								$sdata = new exItem;
								$sdata->id = $fdata["id"];
								$sdata->value = $fdata["fName"];
								$sdata->label = $fdata["fNameShow"];
								array_push($data,$sdata);
							}
						break;
					case 5: //สถานศึกษา
					case 6: //โซนนิ่ง
							$menu = isset($_POST["menu"])?$_POST["menu"]:0;
							$LvText = array("","อุดม","อาชีว","มัธยม","ประถม");
							$data = array();
        
							$DB = new ezDB;
							$DB->GetData("SELECT `no`, `Name` FROM Academy WHERE `Level` LIKE ? AND `Name` LIKE ? LIMIT 10",array("ss","%".$LvText[$menu]."%","%".$_POST["value"]."%"));
        
							while($fdata = $DB->FetchData()){
								$sdata = new exItem;
								$sdata->id = $fdata["no"];
								$sdata->value = $fdata["Name"];
								$sdata->label = $fdata["Name"];
								array_push($data,$sdata);
							}
						break;
					default :
							$data = array();
				}
		break;
	case "getgraph" :
				$job = isset($_POST["job"])?$_POST["job"]:0;
				$year = isset($_POST["year"])?$_POST["year"]:9999;
				$region = isset($_POST["region"])?$_POST["region"]:0;
				$province = isset($_POST["province"])?$_POST["province"]:0;
				
				$data = new exChart;
				$data->minvalue = 999999999999;
				$data->maxvalue = 0;
				$data->labels = array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				$data->datasets = array();

				$DB = new exDB;
				switch($job){
					case 1 :
							$DB->GetData("SELECT YEAR(stReleaseDate) AS Y, MONTH(stReleaseDate) AS M, SUM(stTax) AS S FROM (SELECT stTax, stReleaseDate FROM `Stamp`,`Label` WHERE stLabel = LabelID AND YEAR(stReleaseDate) BETWEEN ? AND ? AND ? IN (0,lbRegion) AND ? IN (0,lbProvince)) AS X  GROUP BY Y,M ORDER BY Y,M",array("iiii",$year - 4,$year,$region,$province));
						break;
					case 4 :
							$DB->GetData("SELECT YEAR(stReleaseDate) AS Y, MONTH(stReleaseDate) AS M, SUM(stAmount) AS S FROM (SELECT stAmount, stReleaseDate FROM `Stamp`,`Label` WHERE stLabel = LabelID AND YEAR(stReleaseDate) BETWEEN ? AND ?  AND ? IN (0,lbRegion) AND ? IN (0,lbProvince)) AS X  GROUP BY Y,M ORDER BY Y,M",array("iiii",$year - 4,$year,$region,$province));
						break;
					case 5 :
					case 31 :
							$DB->GetData("SELECT YEAR(faIssueDate) AS Y, MONTH(faIssueDate) AS M, COUNT(FactoryID) AS S FROM `Factory` WHERE (YEAR(faIssueDate) BETWEEN ? AND ?) AND ? IN (0,faRegion) AND ? IN (0, faProvince) GROUP BY Y,M ORDER BY Y,M",array("iiii",$year - 4,$year,$region,$province));
						break;
					case 32 :
							$DB->GetData("SELECT YEAR(lbIssueDate) AS Y, MONTH(lbIssueDate) AS M,COUNT(lbIssueDate) AS S FROM (SELECT lbIssueDate FROM `Stamp`,`Label`, `SuraType` WHERE stLabel = LabelID AND lbType = SuraTypeID AND YEAR(lbIssueDate) BETWEEN ? AND ? AND ? IN (0,lbRegion) AND ? IN (0,lbProvince) GROUP BY lbLicense ORDER BY lbIssueDate) AS X GROUP BY Y,M ORDER BY Y,M",array("iiii",$year - 4,$year,$region,$province));
					case 33 :
							$DB->GetData("SELECT YEAR(slExtendDate) AS Y, MONTH(slExtendDate) AS M, COUNT(slExtendDate) AS S FROM (SELECT slExtendDate, COUNT(`SaleLicenseID`) AS C FROM `SaleLicense`,`Factory` WHERE slFactoryID = FactoryID AND YEAR(slExtendDate) BETWEEN ? AND ? AND ? IN (0,faRegion) AND ? IN (0,faProvince) GROUP BY `SaleLicenseID`) AS X GROUP BY Y,M ORDER BY Y,M",array("iiii",$year - 4,$year,$region,$province));
					default :
				}

				if($DB->GetNumRows() > 0){
					$CurYear = 0;
					$CountYear = 0;
					$YearList = array();
					while($fdata = $DB->FetchData()){
						if($CurYear != $fdata["Y"]){
							$CurYear = $fdata["Y"];
							array_push($YearList,$CurYear);
							$CountYear++;
						}
						$tmpData[$fdata["Y"]][$fdata["M"] - 1] = $fdata["S"];
					}

					for($i=0;$i<$CountYear;$i++){
						$sdata = new exChart_Data;
						$sdata->label = "ปี ".($YearList[$i] + 543);
						$sdata->data = array();
						for($j=0;$j<12;$j++){
							if(isset($tmpData[$YearList[$i]][$j])){
								if($tmpData[$YearList[$i]][$j] < $data->minvalue) $data->minvalue = $tmpData[$YearList[$i]][$j];
								if($tmpData[$YearList[$i]][$j] > $data->maxvalue) $data->maxvalue = $tmpData[$YearList[$i]][$j];
								//array_push($sdata->data,number_format($tmpData[$YearList[$i]][$j]));
								array_push($sdata->data,$tmpData[$YearList[$i]][$j]);
							}else{
								array_push($sdata->data,null);
							}
						}
						array_push($data->datasets,$sdata);
					}
				}else{
					if($job==0){
						for($i=0;$i<5;$i++){
							$sdata = new exChart_Data;
							$sdata->label = "ปี 255".($i+5);
							$sdata->data = array();
							for($j=0;$j<12;$j++){
								$randomValue = rand(1000000,5000000)/100;
								if($randomValue < $data->minvalue) $data->minvalue = $randomValue;
								if($randomValue > $data->maxvalue) $data->maxvalue = $randomValue;
								array_push($sdata->data,$randomValue,2);
							}
							array_push($data->datasets,$sdata);
						}
					}
				}
				if($data->minvalue == 999999999999) $data->minvalue = 0;
			break;
	default : $data = null;
}
header("Access-Control-Allow-Origin: *");
echo json_encode($data);
?>
