<?php require('header.php'); ?>
<!--SECTION-->
<div class="section" style="margin-top: 10px;">
    <div class="col-md-6" style="height: 70vh;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <p style="display: inline-block; font-weight: bold; font-size: 25px;" class="panel-title"><i class="fa fa-user text-right-indent"></i> จัดการข้อมูลผู้ใช้</p> 
                <a class="btn btn-sm btn-success" id="addUserBtn" style="float: right;">เพิ่มผู้ใช้</a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form name="userForm" novalidate>
                        <div class="col-md-3 text-center"> 
                            <img class="img-circle img-responsive" id="ProfileImage"> 
                            <p style="margin-top: 15px; font-size: 20px;"><span id="FullnameTXT"></sapn></p>
                        </div>
                        <div class="col-md-9 table-responsive" style="height: 57vh;"> 
                            <table class="table table-striped" style="overflow-y: scroll;">
                                <tbody>
                                    <tr>
                                        <td><p class="data-important">ชื่อผู้ใช้งาน</p></td>
                                        <td>
                                            <input type="text" class="form-control" id="Fullname" disabled required>
                                            <span class="error-content hide" data-label="ชื่อผู้ใช้งาน"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p class="data-important">เพศ</p></td>
                                        <td>
                                            <select class="form-control" id="Gender" disabled required>
                                                <option value="" selected disabled>เลือกเพศ</option>
                                                <option value="0">หญิง</option>
                                                <option value="1">ชาย</option>
                                            </select>
                                            <span class="error-content hide" data-label="เพศ"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p class="data-important">ตำแหน่ง</p></td>
                                        <td>
                                            <select class="form-control" id="Level" disabled required>
                                                <option value="" selected disabled>เลือกตำแหน่ง</option>
                                                <option value="1">ผู้จัดการ</option>
                                                <option value="2">เจ้าหน้าที่</option>
                                            </select>
                                            <span class="error-content hide" data-label="ตำแหน่ง"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>สังกัด</p></td>
                                        <td>
                                            <input type="text" class="form-control" id="UnderTXT" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>อีเมล์</p></td>
                                        <td>
                                            <input type="text" class="form-control" id="Email" disabled email-only>
                                            <span class="error-content hide" data-label="อีเมล์"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>เบอร์โทรศัพท์</p></td>
                                        <td>
                                            <input type="text" class="form-control" id="Tel" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>เบอร์มือถือ</p></td>
                                        <td>
                                            <input type="text" class="form-control" id="Mobile" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>รหัสผ่านปัจจุบัน</p></td>
                                        <td>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="Password" disabled>
                                                <span class="input-group-addon" style="padding: 0;">
                                                    <button type="button" class="btn btn-info" id="changePasswordBtn" title="คลิกเพื่อแก้ไข Password">แก้ไข</button>
                                                </span>
                                            </div>
                                            <span class="error-content hide" data-label="ชื่อผู้ใช้งาน"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>  
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel-footer">
                <div style="text-align: right;">
                    <a class="btn btn-sm btn-primary" id="insertBtn">บันทึก</a>
                    <a class="btn btn-sm btn-warning" id="updateBtn">แก้ไข</a>
                    <a class="btn btn-sm btn-danger" id="resetBtn">ยกเลิก</a>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6" style="height: 70vh;">
       <div class="panel panel-info">
           <div class="panel-heading">
               <p style="font-weight: bold; font-size: 25px;" class="panel-title"><i class="fa fa-search text-right-indent"></i> ค้นหาข้อมูลพนักงาน</p>
           </div>
           <div class="panel-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="searchUser" placeholder="ค้นหาชื่อพนักงาน">
                </div>
                <div class="table-responsive" style="height: 50vh;">
                    <table class="table table-striped table-bordered search-table" data-id="0" style="margin-top: 0; overflow-y: scroll;"> 
                        <tbody></tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination" style="height: 6vh; margin: 10px 0 0 0; padding: 0;"></div>
           </div>
       </div>
    </div>
</div>
<!--JS-->
 