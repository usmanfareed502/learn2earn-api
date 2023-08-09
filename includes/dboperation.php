<?php

use phpDocumentor\Reflection\DocBlock\Description;

class DbOperation 
{
    private $con;
    function __construct()
    {
        require_once dirname(__FILE__) . '/dbconnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }
            // user login 
            function userlogin($username, $password, $role)
            {
                 $stmt = $this->con->prepare("SELECT u_id FROM login WHERE username = ? AND password = ? AND role = ?");
                 $stmt->bind_param("sss", $username, $password , $role);
                 $stmt->execute();
                 $stmt->store_result();
                 return $stmt->num_rows > 0;
            }
            function getUserByRole( $c_id, $username, $role)
            {
                $stmt = $this->con->prepare("SELECT u_id,  c_id, username,password,role from login WHERE username = ? AND role = ?");
                $stmt->bind_param("ss", $username, $role);
                $stmt->execute();
                $stmt->bind_result( $u_id , $c_id,$username,$password , $role);
                $stmt->fetch();
                $User = array();
                $User['u_id']=$u_id;
                $User['c_id']=$c_id;
                $User['username'] = $username;
                $User['password'] = $password;
                $User['role']=$role;
                return $User;
            }
            
            
                
            // student first insertInstallments addmission time 
            function insertmonth_installments($id,$c_id,$month,$year,$f_status,$remaning_amount)
            {
                date_default_timezone_set("Asia/Karachi");
                $date = date("ymd");
                $installment_no = 0;
            $stmt=$this->con->prepare("INSERT INTO `m_instalment`(`id`, `c_id`, `month`, `year`, `f_status`,`remaning_amount`,`date`,`installment_no`)  VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("iisssisi", $id,$c_id,$month,$year,$f_status,$remaning_amount,$date,$installment_no);
            if ($stmt->execute())
                {
                    return PROFILE_CREATED;
                }
                    return PROFILE_NOT_CREATED;
            } 

                //  Students admission 
                function insertStudents($c_id,$a_id,$name,$f_name, $st_gender, $contact_no,$address, $reference,$cnic, $course,$c_duration,$upcoming_installment,$ad_date, $total_fee,$per_installment,$total_installments,$remaning_amount,$end_date,$rg_fee)
                {       
                    // date_default_timezone_set("Asia/Karachi");
                    // $ad_date = date("ymd");
                    $status="pending";
                    $st_status="active";
                    $fee_status="pending";
                    $amount=0;
                    $stmt=$this->con->prepare("INSERT INTO `a_student`(`c_id`,`a_id`, `name`, `f_name`, `st_gender`, `contact_no`, `address`, `reference`, `cnic`, `course`, `c_duration`, `upcoming_installment`, `ad_date`, `total_fee`, `per_installment`, `total_installments`,  `remaning_amount`, `status`, `st_status`, `fee_status`, `end_date`, `rg_fee` ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("iisssssssssssiiiissssi",$c_id,$a_id, $name,$f_name, $st_gender, $contact_no,$address, $reference,$cnic, $course,$c_duration,$upcoming_installment,$ad_date,$total_fee,$per_installment,$total_installments,$remaning_amount,$status,$st_status,$fee_status,$end_date,$rg_fee);
                    if ($stmt->execute())
                    {
                        $stmt = $this->con->prepare("SELECT netbalance FROM main_account where a_id = (select MAX(a_id) from main_account)");
                        $stmt->execute();
                        $stmt->bind_result($netbalance);
                        $stmt->fetch();
                        return PROFILE_CREATED;
                    }
                    else{
                        return PROFILE_NOT_CREATED;
                    }
                    
                }  

                
            // // student first insertInstallments addmission time 
            // function insertFirstInstallment($id,$a_id,$c_id,$remaning_amount,$upcoming_installment)
            // {
            // date_default_timezone_set("Asia/Karachi");
            // $date = date("ymd");
            // $installment_no = 0;
            // $stmt=$this->con->prepare("INSERT INTO `installments` (`id`,`a_id`,`c_id`,`remaning_amount`, `date`, `installment_no`,`upcoming_installment`) VALUES (?,?,?,?,?,?,?)");
            // $stmt->bind_param("iiiisis", $id,$a_id,$c_id,$remaning_amount, $date,$installment_no,$upcoming_installment);
            // if ($stmt->execute())
            //     {
            //         return PROFILE_CREATED;
            //     }
            //         return PROFILE_NOT_CREATED;
            // } 


                       //  all students get
                       function getStudents($c_id)
                       {
                           if($c_id == 3){
                               $stmt = $this->con->prepare ("SELECT `id`, `c_id`, `a_id`, `name`, `f_name`, `st_gender`, `contact_no`, `address`, `reference`, `cnic`, `course`, `c_duration`, `upcoming_installment`, `ad_date`, `total_fee`, `per_installment`, `total_installments`, `remaning_amount`, `status`, `st_status`, `fee_status`, `end_date`, `rg_fee` FROM `a_student`");
                               // $stmt->bind_param("i", $c_id);
                               $stmt->execute();
                               $stmt->bind_result($id,$c_id,$a_id, $name,$f_name, $st_gender,$contact_no, $address,$reference, $cnic,$course,$c_duration,$upcoming_installment, $ad_date,$total_fee, $per_installment,$total_installments,$remaning_amount,$status,$st_status,$fee_status,$end_date,$rg_fee);
                               // $stmt->fetch();
                               $cat = array();
                                       while ($stmt->fetch()) {
                                           $test = array();
                               $test['id'] = $id;
                               $test['c_id'] = $c_id;
                               $test['a_id'] = $a_id;
                               $test['name'] = $name;
                               $test['f_name'] = $f_name;
                               $test['st_gender'] = $st_gender;
                               $test['contact_no'] = $contact_no;
                               $test['address'] = $address;
                               $test['reference'] = $reference;
                               $test['cnic'] = $cnic;
                               $test['course'] = $course;
                               $test['c_duration'] = $c_duration;
                               $test['upcoming_installment'] = $upcoming_installment;
                               $test['ad_date'] = $ad_date;
                               $test['total_fee'] = $total_fee;
                               $test['per_installment'] = $per_installment;
                               $test['total_installments'] = $total_installments;
                               $test['remaning_amount'] = $remaning_amount;
                               $test['status'] = $status;
                               $test['st_status'] = $st_status;
                               $test['fee_status'] = $fee_status;
                               $test['end_date'] = $end_date;
                               $test['rg_fee'] = $rg_fee;
                               array_push($cat, $test);
                               }
                               return $cat;
                           }
                           else{
                               $stmt = $this->con->prepare ("SELECT `id`, `c_id`, `a_id`, `name`, `f_name`, `st_gender`, `contact_no`, `address`, `reference`, `cnic`, `course`, `c_duration`, `upcoming_installment`, `ad_date`, `total_fee`, `per_installment`, `total_installments`,  `remaning_amount`, `status`, `st_status`, `fee_status`, `end_date`, `rg_fee` FROM a_student WHERE c_id=?");
                               $stmt->bind_param("i", $c_id);
                               $stmt->execute();
                               $stmt->bind_result($id,$c_id,$a_id, $name,$f_name, $st_gender,$contact_no, $address,$reference, $cnic,$course,$c_duration,$upcoming_installment, $ad_date,$total_fee, $per_installment,$total_installments,$remaning_amount,$status,$st_status,$fee_status,$end_date,$rg_fee);
                               // $stmt->fetch();
                               $cat = array();
                                       while ($stmt->fetch()) {
                                           $test = array();
                                           $test['id'] = $id;
                                           $test['c_id'] = $c_id;
                                           $test['a_id'] = $a_id;
                                           $test['name'] = $name;
                                           $test['f_name'] = $f_name;
                                           $test['st_gender'] = $st_gender;
                                           $test['contact_no'] = $contact_no;
                                           $test['address'] = $address;
                                           $test['reference'] = $reference;
                                           $test['cnic'] = $cnic;
                                           $test['course'] = $course;
                                           $test['c_duration'] = $c_duration;
                                           $test['upcoming_installment'] = $upcoming_installment;
                                           $test['ad_date'] = $ad_date;
                                           $test['total_fee'] = $total_fee;
                                           $test['per_installment'] = $per_installment;
                                           $test['total_installments'] = $total_installments;
                                           $test['remaning_amount'] = $remaning_amount;
                                           $test['status'] = $status;
                                           $test['st_status'] = $st_status;
                                           $test['fee_status'] = $fee_status;
                                           $test['end_date'] = $end_date;
                                           $test['rg_fee'] = $rg_fee;
                               array_push($cat, $test);
                               }
                               return $cat;
                           }
                       }

                      //       update Students 
                 function updateStudents($id,$c_id,$name,$f_name, $st_gender, $contact_no,$address, $reference,$cnic, $course,$c_duration,$upcoming_installment,$ad_date,$status,$st_status,$fee_status,$end_date,$rg_fee)
                 {
                     $stmt=$this->con->prepare("UPDATE `a_student` SET `c_id`=?,`name`=?,`f_name`=?,`st_gender`=?,`contact_no`=?,`address`=?,`reference`=?,`cnic`=?,`course`=?,`c_duration`=?,`upcoming_installment`=?,`ad_date`=?,`status`=?,`st_status`=?,`fee_status`=?,`end_date`=?,`rg_fee`=? WHERE id = ?");
                     $stmt->bind_param("isssssssssssssssii",$c_id,$name,$f_name, $st_gender, $contact_no,$address, $reference,$cnic, $course,$c_duration,$upcoming_installment,$ad_date,$status,$st_status,$fee_status,$end_date,$rg_fee,$id);
                     if($stmt->execute())
                     {
                         return PROFILE_CREATED;
                     }
                     return PROFILE_NOT_CREATED;
                 }

                // get last student
                function getLastStudent()
                {
                $stmt = $this->con->prepare ("SELECT `id` FROM `a_student` where `id` = (select MAX(`id`) from `a_student`)");
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();
                $test = array();
                $test['id'] = $id;
                
                return $id;
                }
    
                              // get all installments with (c_id) 
            function getInstallments($c_id)
            {
            if($c_id == 3){
                $stmt = $this->con->prepare ("SELECT a_student.id,a_student.c_id,a_student.name,a_student.f_name,a_student.st_gender, a_student.contact_no,a_student.address, a_student.reference,a_student.cnic,a_student.course,a_student.c_duration,a_student.upcoming_installment, a_student.ad_date,a_student.total_fee,a_student.per_installment, a_student.total_installments, a_student.status,a_student.st_status,a_student.fee_status,a_student.end_date,a_student.rg_fee,m_instalment.remaning_amount,m_instalment.date,m_instalment.installment_no FROM a_student JOIN m_instalment ON a_student.id = m_instalment.id ");
                // $stmt->bind_param("i",$c_id);
                $stmt->execute();
                $stmt->bind_result($id,$c_id, $name,$f_name,$st_gender,$contact_no,$address,$reference,$cnic,$course,
                $c_duration,$upcoming_installment, $ad_date,$total_fee,$per_installment,$total_installments,  $status,$st_status,$fee_status,$end_date,$rg_fee,$remaning_amount, $date,$installment_no);
                // $stmt->fetch();
                $cat = array();
                        while ($stmt->fetch()) {
                            $test = array();
                            $test['id'] = $id;
                            $test['c_id'] = $c_id;
                            $test['name'] = $name;
                            $test['f_name'] = $f_name;
                            $test['st_gender'] = $st_gender;
                            $test['contact_no'] = $contact_no;
                            $test['address'] = $address;
                            $test['reference'] = $reference;
                            $test['cnic'] = $cnic;
                            $test['course'] = $course;
                            $test['c_duration'] = $c_duration;
                            $test['upcoming_installment'] = $upcoming_installment;
                            $test['ad_date'] = $ad_date;
                            $test['total_fee'] = $total_fee;
                            $test['per_installment'] = $per_installment;
                            $test['total_installments'] = $total_installments;                          
                            $test['status'] = $status;
                            $test['st_status'] = $st_status;
                            $test['fee_status'] = $fee_status;
                            $test['end_date'] = $end_date;
                            $test['rg_fee'] = $rg_fee;
                            $test['remaning_amount'] = $remaning_amount;
                            $test['date'] = $date;
                            $test['installment_no'] = $installment_no;
                array_push($cat, $test);
                }
                return $cat;
            }
            else{
                $stmt = $this->con->prepare ("SELECT a_student.id,a_student.c_id,a_student.name,a_student.f_name,a_student.st_gender, a_student.contact_no,a_student.address, a_student.reference,a_student.cnic,a_student.course,a_student.c_duration,a_student.upcoming_installment, a_student.ad_date,a_student.total_fee,a_student.per_installment, a_student.total_installments, a_student.status,a_student.st_status,a_student.fee_status,a_student.end_date,a_student.rg_fee, m_instalment.remaning_amount,m_instalment.date,m_instalment.installment_no FROM a_student JOIN m_instalment ON a_student.id = m_instalment.id WHERE m_instalment.c_id = ?");
                $stmt->bind_param("i",$c_id);
                $stmt->execute();
                $stmt->bind_result($id,$c_id, $name,$f_name,$st_gender,$contact_no,$address,$reference,$cnic,$course,
                $c_duration,$upcoming_installment, $ad_date,$total_fee,$per_installment,$total_installments,  $status,$st_status,$fee_status,$end_date,$rg_fee, $remaning_amount, $date,$installment_no);
                // $stmt->fetch();
                $cat = array();
                        while ($stmt->fetch()) {
                            $test = array();
                            $test['id'] = $id;
                            $test['c_id'] = $c_id;
                            $test['name'] = $name;
                            $test['f_name'] = $f_name;
                            $test['st_gender'] = $st_gender;
                            $test['contact_no'] = $contact_no;
                            $test['address'] = $address;
                            $test['reference'] = $reference;
                            $test['cnic'] = $cnic;
                            $test['course'] = $course;
                            $test['c_duration'] = $c_duration;
                            $test['upcoming_installment'] = $upcoming_installment;
                            $test['ad_date'] = $ad_date;
                            $test['total_fee'] = $total_fee;
                            $test['per_installment'] = $per_installment;
                            $test['total_installments'] = $total_installments;                          
                            $test['status'] = $status;
                            $test['st_status'] = $st_status;
                            $test['fee_status'] = $fee_status;
                            $test['end_date'] = $end_date;
                            $test['rg_fee'] = $rg_fee;
                            $test['remaning_amount'] = $remaning_amount;
                            $test['date'] = $date;
                            $test['installment_no'] = $installment_no;
                array_push($cat, $test);
                }
                return $cat;
            }
            }

                        // student get by month his installments done
            // SELECT `id` , `name` FROM a_student WHERE id IN ( SELECT DISTINCT(id) FROM installments WHERE month != ?)
            function get_Installmentsbymonth($c_id, $month, $year)
            {
                if($c_id == 3){
                    $stmt = $this->con->prepare ("SELECT a_student.id,a_student.c_id,a_student.name,a_student.f_name,a_student.st_gender, a_student.contact_no,a_student.address, a_student.reference,a_student.cnic,a_student.course,a_student.c_duration, a_student.ad_date,a_student.total_fee,a_student.per_installment, a_student.total_installments, a_student.status,a_student.st_status,a_student.fee_status,a_student.end_date,a_student.rg_fee, m_instalment.month,m_instalment.year,m_instalment.f_status, m_instalment.remaning_amount,m_instalment.date,m_instalment.installment_no FROM a_student JOIN m_instalment ON a_student.id = m_instalment.id
                    WHERE m_instalment.month = ? AND m_instalment.year = ?");
                    $stmt->bind_param("si",$month, $year);
                   $stmt->execute();    
                   $stmt->bind_result( $id,$c_id, $name,$f_name,$st_gender,$contact_no,$address,$reference,$cnic,$course,
                   $c_duration, $ad_date,$total_fee,$per_installment,$total_installments,  $status,$st_status,$fee_status,$end_date,$rg_fee, $month,$year,$f_status,$remaning_amount, $date,$installment_no);
                   // $stmt->fetch();
                     $cat = array();
                            while ($stmt->fetch()) {
                                $test = array();
                                $test['id'] = $id;
                                $test['c_id'] = $c_id;
                                $test['name'] = $name;
                                $test['f_name'] = $f_name;
                                $test['st_gender'] = $st_gender;
                                $test['contact_no'] = $contact_no;
                                $test['address'] = $address;
                                $test['reference'] = $reference;
                                $test['cnic'] = $cnic;
                                $test['course'] = $course;
                                $test['c_duration'] = $c_duration;
                                $test['ad_date'] = $ad_date;
                                $test['total_fee'] = $total_fee;
                                $test['per_installment'] = $per_installment;
                                $test['total_installments'] = $total_installments;                          
                                $test['status'] = $status;
                                $test['st_status'] = $st_status;
                                $test['fee_status'] = $fee_status;
                                $test['end_date'] = $end_date;
                                $test['rg_fee'] = $rg_fee;
                                $test['month'] = $month;
                                $test['year'] = $year;
                                $test['f_status'] = $f_status;                              
                                $test['remaning_amount'] = $remaning_amount;
                                $test['date'] = $date;
                                $test['installment_no'] = $installment_no;
                  
                    array_push($cat, $test);
                   }
                   return $cat;
                }

                else

                {

                    $stmt = $this->con->prepare ("SELECT a_student.id,a_student.c_id,a_student.name,a_student.f_name,a_student.st_gender, a_student.contact_no,a_student.address, a_student.reference,a_student.cnic,a_student.course,a_student.c_duration, a_student.ad_date,a_student.total_fee,a_student.per_installment, a_student.total_installments, a_student.status,a_student.st_status,a_student.fee_status,a_student.end_date,a_student.rg_fee, m_instalment.month,m_instalment.year,m_instalment.f_status, m_instalment.remaning_amount,m_instalment.date,m_instalment.installment_no FROM a_student JOIN m_instalment ON a_student.id = m_instalment.id
                    WHERE m_instalment.c_id = ? AND m_instalment.month = ? AND m_instalment.year = ?");
                    $stmt->bind_param("isi",$c_id, $month, $year);
                   $stmt->execute();
                   $stmt->bind_result( $id,$c_id, $name,$f_name,$st_gender,$contact_no,$address,$reference,$cnic,$course,
                   $c_duration, $ad_date,$total_fee,$per_installment,$total_installments,  $status,$st_status,$fee_status,$end_date,$rg_fee, $month,$year,$f_status,$remaning_amount, $date,$installment_no);
                   // $stmt->fetch();
                     $cat = array();
                            while ($stmt->fetch()) {
                                $test = array();
                                $test['id'] = $id;
                                $test['c_id'] = $c_id;
                                $test['name'] = $name;
                                $test['f_name'] = $f_name;
                                $test['st_gender'] = $st_gender;
                                $test['contact_no'] = $contact_no;
                                $test['address'] = $address;
                                $test['reference'] = $reference;
                                $test['cnic'] = $cnic;
                                $test['course'] = $course;
                                $test['c_duration'] = $c_duration;
                                $test['ad_date'] = $ad_date;
                                $test['total_fee'] = $total_fee;
                                $test['per_installment'] = $per_installment;
                                $test['total_installments'] = $total_installments;                          
                                $test['status'] = $status;
                                $test['st_status'] = $st_status;
                                $test['fee_status'] = $fee_status;
                                $test['end_date'] = $end_date;
                                $test['rg_fee'] = $rg_fee;
                                $test['month'] = $month;
                                $test['year'] = $year;
                                $test['f_status'] = $f_status;                              
                                $test['remaning_amount'] = $remaning_amount;
                                $test['date'] = $date;
                                $test['installment_no'] = $installment_no;
                    array_push($cat, $test);
                   }
                   return $cat;
                }
            }     

                        //  GET STUDENT BY status active and deactive
                        function get_Student($c_id)
                        {
                            if($c_id == 3){
                                $stmt = $this->con->prepare ("SELECT  `id`,`c_id`, `name`, `f_name`, `st_gender`, `contact_no`, `address`, `reference`, `cnic`, `course`,`c_duration`, `ad_date`, `total_fee`, `total_installments`,`remaning_amount`, `status`, `st_status` FROM `a_student` WHERE `st_status`='active' AND `status`='pending'");
                                // $stmt->bind_param("i",$c_id);
                                $stmt->execute();
                                $stmt->bind_result($id,$c_id,$name,$f_name, $st_gender,$contact_no, $address,$reference, $cnic,$course,$c_duration, $ad_date,$total_fee,$total_installments,$remaning_amount, $status,$st_status);
                                // $stmt->fetch();
                                  $cat = array();
                                         while ($stmt->fetch()) {
                                             $test = array();
                                $test['id'] = $id;
                                $test['c_id'] = $c_id;
                                $test['name'] = $name;
                                $test['f_name'] = $f_name;
                                $test['st_gender'] = $st_gender;
                                $test['contact_no'] = $contact_no;
                                $test['address'] = $address;
                                $test['reference'] = $reference;
                                $test['cnic'] = $cnic;
                                $test['course'] = $course;
                                $test['c_duration'] = $c_duration;
                                $test['ad_date'] = $ad_date;
                                $test['total_fee'] = $total_fee;
                                $test['total_installments'] = $total_installments;
                                $test['remaning_amount'] = $remaning_amount;
                                $test['status'] = $status;
                                $test['st_status'] = $st_status;
                                 array_push($cat, $test);
                                }
                                return $cat;
                            }else{
                                $stmt = $this->con->prepare ("SELECT  `id`,`c_id`, `name`, `f_name`, `st_gender`, `contact_no`, `address`, `reference`, `cnic`, `course`,`c_duration`, `ad_date`, `total_fee`,`total_installments`,`remaning_amount`, `status`, `st_status` FROM `a_student` WHERE `st_status`='active' AND `status`='pending' AND c_id=?");
                                $stmt->bind_param("i",$c_id);
                                $stmt->execute();
                                $stmt->bind_result($id,$c_id,$name,$f_name, $st_gender,$contact_no, $address,$reference, $cnic,$course,$c_duration, $ad_date,$total_fee,$total_installments,$remaning_amount, $status,$st_status);
                                // $stmt->fetch();
                                  $cat = array();
                                         while ($stmt->fetch()) {
                                             $test = array();
                                $test['id'] = $id;
                                $test['c_id'] = $c_id;
                                $test['name'] = $name;
                                $test['f_name'] = $f_name;
                                $test['st_gender'] = $st_gender;
                                $test['contact_no'] = $contact_no;
                                $test['address'] = $address;
                                $test['reference'] = $reference;
                                $test['cnic'] = $cnic;
                                $test['course'] = $course;
                                $test['c_duration'] = $c_duration;
                                $test['ad_date'] = $ad_date;
                                $test['total_fee'] = $total_fee;
                                $test['total_installments'] = $total_installments;
                                $test['remaning_amount'] = $remaning_amount;
                                $test['status'] = $status;
                                $test['st_status'] = $st_status;
                                 array_push($cat, $test);
                                }
                                return $cat;
                            }
                        }

                                    // get last installment by student one by one
                        function get_Installments($id,$c_id)
                        {
                            if($c_id == 3){
                                $stmt = $this->con->prepare ("SELECT m_instalment.id,m_instalment.c_id,m_instalment.remaning_amount, m_instalment.date,m_instalment.installment_no
                                , a_student.name,a_student.f_name,a_student.st_gender,a_student.contact_no,a_student.address,a_student.reference, a_student.cnic,a_student.course,a_student.c_duration,
                                            a_student.ad_date,a_student.total_fee,a_student.total_installments,a_student.status, a_student.st_status FROM m_instalment JOIN a_student ON m_instalment.id = a_student.id WHERE m_instalment.m_id = (SELECT MAX(m_id) FROM m_instalment WHERE m_instalment.id =?)");
                                $stmt->bind_param("i",$id);
                                $stmt->execute();
                                $stmt->bind_result($id,$c_id,$remaning_amount, $date,$installment_no,$name,$f_name,$st_gender,$contact_no,
                                                    $address,$reference,$cnic,$course,$c_duration, 
                                                    $ad_date,$total_fee,$total_installments, $status,$st_status);
                                // $stmt->fetch();
                                $cat = array();
                                        while ($stmt->fetch()) {
                                            $test = array();
                                $test['id'] = $id;
                                $test['c_id'] = $c_id;
                                $test['remaning_amount'] = $remaning_amount;
                                $test['date'] = $date;
                                $test['installment_no'] = $installment_no;
                                $test['name'] = $name;
                                $test['f_name'] = $f_name;
                                $test['st_gender'] = $st_gender;
                                $test['contact_no'] = $contact_no;
                                $test['address'] = $address;
                                $test['reference'] = $reference;
                                $test['cnic'] = $cnic;
                                $test['course'] = $course;
                                $test['c_duration'] = $c_duration;
                                $test['ad_date'] = $ad_date;
                                $test['total_fee'] = $total_fee;
                                $test['total_installments'] = $total_installments;
                                $test['status'] = $status;
                                $test['st_status'] = $st_status;
                                array_push($cat, $test);
                                }
                                return $cat;
                            }
                            else{
                                $stmt = $this->con->prepare ("SELECT m_instalment.id,m_instalment.c_id,m_instalment.remaning_amount, m_instalment.date,m_instalment.installment_no
                                , a_student.name,a_student.f_name,a_student.st_gender,a_student.contact_no,a_student.address,a_student.reference, a_student.cnic,a_student.course,a_student.c_duration,
                                            a_student.ad_date,a_student.total_fee,a_student.total_installments,a_student.status, a_student.st_status FROM m_instalment JOIN a_student ON m_instalment.id = a_student.id WHERE m_instalment.m_id = (SELECT MAX(m_id) FROM m_instalment WHERE m_instalment.id =? AND m_instalment.c_id=?)");
                                $stmt->bind_param("ii",$id, $c_id);
                                $stmt->execute();
                                $stmt->bind_result($id,$c_id,$remaning_amount, $date,$installment_no,$name,$f_name,$st_gender,$contact_no,
                                                    $address,$reference,$cnic,$course,$c_duration, 
                                                    $ad_date,$total_fee,$total_installments, $status,$st_status);
                                // $stmt->fetch();
                                $cat = array();
                                        while ($stmt->fetch()) {
                                            $test = array();
                                $test['id'] = $id;
                                $test['c_id'] = $c_id;
                                $test['remaning_amount'] = $remaning_amount;
                                $test['date'] = $date;
                                $test['installment_no'] = $installment_no;
                                $test['name'] = $name;
                                $test['f_name'] = $f_name;
                                $test['st_gender'] = $st_gender;
                                $test['contact_no'] = $contact_no;
                                $test['address'] = $address;
                                $test['reference'] = $reference;
                                $test['cnic'] = $cnic;
                                $test['course'] = $course;
                                $test['c_duration'] = $c_duration;
                                $test['ad_date'] = $ad_date;
                                $test['total_fee'] = $total_fee;
                                $test['total_installments'] = $total_installments;
                                $test['status'] = $status;
                                $test['st_status'] = $st_status;
                                array_push($cat, $test);
                                }
                                return $cat;
                            }
                        }

                        // get all installments by student one by one for details
            function get_InstallmentsbyStudentId($id,$c_id)
            {
                if($c_id == 3){
                    $stmt = $this->con->prepare ("                                   
                    SELECT m_instalment.id,m_instalment.c_id,m_instalment.remaning_amount, m_instalment.date,m_instalment.installment_no,a_student.name
                    ,a_student.f_name,a_student.st_gender,a_student.contact_no,a_student.address,a_student.reference,a_student.cnic,
                    a_student.course,a_student.c_duration,a_student.ad_date,a_student.total_fee,
                    a_student.per_installment,a_student.status,a_student.st_status
                    FROM m_instalment JOIN a_student ON a_student.id = m_instalment.id  WHERE a_student.id = ? ");
                     $stmt->bind_param("i",$id);
                    $stmt->execute();
                    $stmt->bind_result($id,$c_id,$remaning_amount, $date,$installment_no,$name,$f_name,$st_gender,
                    $contact_no,$address,$reference,$cnic,$course,$c_duration,$ad_date,$total_fee,
                     $per_installment, $status,$st_status);
                    // $stmt->fetch();
                      $cat = array();
                             while ($stmt->fetch()) {
                                 $test = array();
                                 $test['id'] = $id;
                                 $test['c_id'] = $c_id;
                                 $test['remaning_amount'] = $remaning_amount;
                                 $test['date'] = $date;
                                 $test['installment_no'] = $installment_no;
                                 $test['name'] = $name;
                                 $test['f_name'] = $f_name;
                                 $test['st_gender'] = $st_gender;
                                 $test['contact_no'] = $contact_no;
                                 $test['address'] = $address;
                                 $test['reference'] = $reference;
                                 $test['cnic'] = $cnic;
                                 $test['course'] = $course;
                                 $test['c_duration'] = $c_duration;
                                 $test['ad_date'] = $ad_date;
                                 $test['total_fee'] = $total_fee;
                                 $test['per_installment'] = $per_installment;
                                 $test['status'] = $status;
                                 $test['st_status'] = $st_status;
                     array_push($cat, $test);
                    }
                    return $cat;
                }
                else{
                    $stmt = $this->con->prepare ("                                   
                    SELECT m_instalment.id,m_instalment.c_id,m_instalment.remaning_amount, m_instalment.date,m_instalment.installment_no,a_student.name
                    ,a_student.f_name,a_student.st_gender,a_student.contact_no,a_student.address,a_student.reference,a_student.cnic,
                    a_student.course,a_student.c_duration,a_student.ad_date,a_student.total_fee,
                    a_student.per_installment,a_student.status,a_student.st_status
                    FROM m_instalment JOIN a_student ON a_student.id = m_instalment.id  WHERE a_student.id = ? AND m_instalment.c_id= ?;");
                     $stmt->bind_param("ii",$id,$c_id);
                    $stmt->execute();
                    $stmt->bind_result($id,$c_id,$remaning_amount, $date,$installment_no,$name,$f_name,$st_gender,
                    $contact_no,$address,$reference,$cnic,$course,$c_duration,$ad_date,$total_fee,
                     $per_installment, $status,$st_status);
                    // $stmt->fetch();
                      $cat = array();
                             while ($stmt->fetch()) {
                                 $test = array();
                                 $test['id'] = $id;
                                 $test['c_id'] = $c_id;
                                 $test['remaning_amount'] = $remaning_amount;
                                 $test['date'] = $date;
                                 $test['installment_no'] = $installment_no;
                                 $test['name'] = $name;
                                 $test['f_name'] = $f_name;
                                 $test['st_gender'] = $st_gender;
                                 $test['contact_no'] = $contact_no;
                                 $test['address'] = $address;
                                 $test['reference'] = $reference;
                                 $test['cnic'] = $cnic;
                                 $test['course'] = $course;
                                 $test['c_duration'] = $c_duration;
                                 $test['ad_date'] = $ad_date;
                                 $test['total_fee'] = $total_fee;
                                 $test['per_installment'] = $per_installment;
                                 $test['status'] = $status;
                                 $test['st_status'] = $st_status;
                     array_push($cat, $test);
                    }
                    return $cat;
                }
                    
             }


                  
             
             //   insertInstallments method
            function insertInstallments($id,$a_id,$c_id,$remaning_amount,$installment_no)
            {       
            date_default_timezone_set("Asia/Karachi");
            $date = date("ymd");
            $stmt=$this->con->prepare("INSERT INTO `installments` (`id`,`a_id`,`c_id`, `remaning_amount`, `date`, `installment_no`) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("iiiisi", $id,$a_id,$c_id,$remaning_amount,$date,$installment_no);
            if ($stmt->execute())
                {
                    // return PROFILE_CREATED;
                }
                    return PROFILE_NOT_CREATED;
            }



                         //       update Students  status
             function updateStudentStatus($id,$c_id)
             {
                 $stmt=$this->con->prepare("UPDATE `a_student` SET `fee_status`= 'complete' WHERE id = ? AND c_id = ?");
                 $stmt->bind_param("ii",$id, $c_id);
                 if($stmt->execute())
                 {
                     return PROFILE_CREATED;
                 }
                 return PROFILE_NOT_CREATED;
             }

                  // Insert Transactions
            function transactions($c_id, $debit, $credit, $netbalance, $type, $description)
            {
                date_default_timezone_set("Asia/Karachi");
                $t_date = date("ymd");
                $netbalance = $netbalance  + $credit ;
                $netbalance = $netbalance - $debit ;
                $stmt=$this->con->prepare("INSERT INTO `transactions`(`c_id`, `debit`, `credit`, `netbalance`, `type`, `description`, `t_date`) VALUES (?,?,?,?,?,?,?)");
                $stmt->bind_param("iiiisss",$c_id, $debit, $credit, $netbalance, $type, $description, $t_date);
                if ($stmt->execute()) {
            
                    return PROFILE_CREATED;
                }
                return PROFILE_NOT_CREATED;
            }

                         // Update Main Account netbalance
            function updateMainAcct($a_id,$c_id,$netbalance)
            {
                date_default_timezone_set("Asia/Karachi");
                $date = date("ymd");
                $stmt = $this->con->prepare("UPDATE `main_account` SET `netbalance`=? WHERE `a_id`=? AND c_id=?");
                $stmt->bind_param("iii", $netbalance,$a_id,$c_id);
                if ($stmt->execute()) {
            
                    return PROFILE_CREATED;
                }
                return PROFILE_NOT_CREATED;
            }
            // Get Netbalance of Main Accounts done
            function getnetbalanceMainAcct($c_id) 
            {
                $stmt = $this->con->prepare("select netbalance from transactions WHERE c_id=? ORDER BY `t_id` DESC LIMIT 1");
                $stmt->bind_param("i",$c_id);
                $stmt->execute();
                $stmt->bind_result($netbalance);
                $stmt->fetch();
                return $netbalance;
            }

        }