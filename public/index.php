<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


require __DIR__ . '/../vendor/autoload.php';

require_once '../includes/dboperation.php';
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

            // login insert data
            $app->post('/userlogin',function (Request $request,Response $response)
            {
                  $requestData = json_decode($request->getBody());
                    $username=$requestData->username;
                    $password=$requestData->password;
                    $role=$requestData->role;
                    $c_id=$requestData->c_id;
                    $db = new DbOperation();
                    $responseData = array();
                    if ($db->userlogin($username, $password, $role)){
                    $responseData['error'] = false;
                     $responseData['user'] = $db->getUserByRole($c_id,$username,$role);
                } else {
                    $responseData['error'] = true;
                    $responseData['message'] = 'Invalid username or password';
                }
                $response->getBody()->write(json_encode($responseData));
            });


                    //  Students admission 
        $app->post('/insertStudents',function (Request $request,Response $response)
        {
            $requestData = json_decode($request->getBody());
            $c_id=$requestData->c_id;
            $a_id=$requestData->a_id;
            $name=$requestData->name;
            $f_name=$requestData->f_name;
            $st_gender=$requestData->st_gender;
            $contact_no=$requestData->contact_no;
            $address=$requestData->address;
            $reference=$requestData->reference;
            $cnic=$requestData->cnic;
            $course=$requestData->course;
            $c_duration=$requestData->c_duration;
            $upcoming_installment=$requestData->upcoming_installment;
            $ad_date=$requestData->ad_date;
            $total_fee=$requestData->total_fee;
            $per_installment=$requestData->per_installment;
            $total_installments=$requestData->total_installments;
            $remaning_amount=$requestData->remaning_amount;
            $end_date=$requestData->end_date;
            $rg_fee=$requestData->rg_fee;
            $installments= $requestData->installments;
                $db = new DbOperation();
                $responseData = array();
                    if($db->insertStudents($c_id,$a_id, $name, $f_name, $st_gender, $contact_no, $address, $reference,
                    $cnic, $course,$c_duration,$upcoming_installment,$ad_date, $total_fee,$per_installment,$total_installments,$remaning_amount,$end_date,$rg_fee)){
                        $db = new DbOperation();
                        $id=$db->getLastStudent();
                        foreach($installments as $installment) {
                            $month = $installment->month;
                            $f_status = $installment->status;
                            $year = $installment->year;
                            $result = $db->insertmonth_installments($id,$c_id,$month,$year,$f_status,$remaning_amount);
                        }
                        
        $netbalance = $db->getnetbalanceMainAcct($c_id);
        $debit = 0;
        $type = "Advance Fee";
        $description = "Student Advance Fee";
        // $test = $db->transactions($c_id, $debit, $netbalance, $type, $description);
        $responseData=array();
                    // $responseData['data'] = $result1;
                    $responseData['message'] = 'data inserted sucessfully';
                    // $responseData['netbalance'] = $db->getnetbalanceMainAcct($a_id,$c_id);
                } else {
                    $responseData['error'] = true;
                    $responseData['message'] = 'data is not inserted';
                }
            $response->getBody()->write(json_encode($responseData));
        });
 
        //     updateStudents method
        $app->post('/updateStudents' ,function (Request $request,Response $response)
        {
            $requestData = json_decode($request->getBody());
                $id=$requestData->id;
                $c_id=$requestData->c_id;
                $name=$requestData->name;
                $f_name=$requestData->f_name;
                $st_gender=$requestData->st_gender;
                $contact_no=$requestData->contact_no;
                $address=$requestData->address;
                $reference=$requestData->reference;
                $cnic=$requestData->cnic;
                $course=$requestData->course;
                $c_duration=$requestData->c_duration;
                $upcoming_installment=$requestData->upcoming_installment;
                $ad_date=$requestData->ad_date;
                $status=$requestData->status;
                $st_status=$requestData->st_status;
                $fee_status=$requestData->fee_status;
                $end_date=$requestData->end_date;
                $rg_fee=$requestData->rg_fee;
                $db = new DbOperation();
                $responseData = array();
                if ($db->updateStudents($id,$c_id,$name,$f_name,$st_gender,$contact_no,$address,$reference,$cnic,$course,$c_duration,$upcoming_installment,$ad_date,$status,$st_status,$fee_status,$end_date,$rg_fee)){
                $responseData['error'] = false;
                $responseData['message'] = 'updated sucessfully';
            } else {    
                $responseData['error'] = true;
                $responseData['message'] = 'not updated sucessfully';
            }
            $response->getBody()->write(json_encode($responseData));
        });

             // get installment by student one by one done

            $app->post('/get_Installments',function (Request $request,Response $response)
            {
                $requestData = json_decode($request->getBody());
                $id=$requestData->id;
                $c_id=$requestData->c_id;  
                    $db = new DbOperation();
                    $result = $db->get_Installments($id,$c_id);
                $response->getBody()->write(json_encode($result));
            });

                            //get_InstallmentsbyStudentId  for view details
            $app->post('/get_InstallmentsbyStudentId',function (Request $request,Response $response)
            {
                $requestData = json_decode($request->getBody());
                $id=$requestData->id;
                $c_id=$requestData->c_id;  
                    $db = new DbOperation();
                    $result = $db->get_InstallmentsbyStudentId($id,$c_id);
                $response->getBody()->write(json_encode($result));
            });

                //  all students get
                $app->get('/getStudents/{c_id}' ,function (Request $request, Response $response)
                {   $c_id = $request->getAttribute('c_id');
                    $db = new DbOperation();
                    $result=$db->getStudents($c_id);
                    $response->getBody()->write(json_encode($result));
                });
                
                       //  GET STUDENT BY status active and deactive
                $app->get('/get_Student/{c_id}' ,function (Request $request, Response $response)
                {
                    $c_id = $request->getAttribute('c_id');
                    $db = new DbOperation();
                    $result=$db->get_Student($c_id);
                    $response->getBody()->write(json_encode($result));
                });
                $app->get('/getlastStudents' ,function (Request $request, Response $response)
                {
                    $db = new DbOperation();
                    $result=$db->getLastStudent();
                    $response->getBody()->write(json_encode($result));
                });


                                                        //    // get all installments  with (c_id)
                    $app->get('/getInstallments/{c_id}' ,function (Request $request, Response $response)
                    {
                        $c_id = $request->getAttribute('c_id');
                        $db = new DbOperation();
                        $result=$db->getInstallments($c_id);
                        $response->getBody()->write(json_encode($result));
                    });


                            // insertInstallments method done
                $app->post('/insertInstallments',function (Request $request,Response $response)
                {
                    $requestData = json_decode($request->getBody());
                    $id=$requestData->id;
                    $a_id=$requestData->a_id;
                    $c_id=$requestData->c_id;
                    $remaning_amount=$requestData->remaning_amount;
                    $installment_no=$requestData->installment_no;
                        $db = new DbOperation();
                        $responseData = array();
                        if ($db->insertInstallments($id,$a_id,$c_id,$remaning_amount,$installment_no)){
                            
                $netbalance = $db->getnetbalanceMainAcct($c_id);
                // $totalnetbalance =0;
                // $totalnetbalance = $netbalance + $advance;
                $debit = 0;
                $type = "Installment";
                $description = "Student Installment";
                $test = $db->transactions($c_id, $debit, $netbalance, $type, $description);
                // $result1 = $db->updateMainAcct($a_id,$c_id, $totalnetbalance);
                        $responseData['error'] = false;
                        $responseData['message'] = 'data inserted sucessfully' .$db->updateStudentStatus($id,$c_id);
                    } else {
                        $responseData['error'] = true;
                        $responseData['message'] = 'data is not inserted';
                    }
                    $response->getBody()->write(json_encode($responseData));
                });


                $app->post('/get_Installmentsbymonth',function (Request $request,Response $response)
                {
                    $requestData = json_decode($request->getBody());
                    $c_id=$requestData->c_id;  
                    $month=$requestData->month;  
                    $year=$requestData->year;  
                        $db = new DbOperation();
                        $result = $db->get_Installmentsbymonth($c_id, $month, $year);
                    $response->getBody()->write(json_encode($result));
                });
    

$app->run();
?>

