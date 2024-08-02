<?php

namespace App\Controllers;
use App\Models\Register_model;

class Home extends BaseController
{
    public function index()
    {
        
        return view('login');
    }
    public function login()
    {
        return view('login');
    }
    public function Purchasebill()
    {
        $session = \Config\Services::session();
        if (!$session->has('id')) {
            return redirect()->to('/');
        }
        $model = new Register_model();

        $wherecond = array('is_active' => 'Y');
    
        $data['tanker'] = $model->getalldata('tbl_tanker', $wherecond);
        $wherecond = array('is_active' => 'Y');
    
        $data['refillpoint'] = $model->getalldata('water_refill_point', $wherecond);
        $wherecond = array('is_active' => 'Y');
    
        $data['refillpoint'] = $model->getalldata('water_refill_point', $wherecond);
// echo '<pre>';print_r($data);die;
        return view('Admin/Purchasebill',$data);
    }
    public function fuelbill()
    {
        $model = new Register_model();

        $wherecond = array('is_active' => 'Y');
    
        $data['tanker'] = $model->getalldata('tbl_tanker', $wherecond);
        $wherecond = array('is_active' => 'Y');
        return view('Admin/fuelbill',$data);
    }
    public function AdminDashboard()
    {
        $model = new Register_model();

        $wherecond = array('order_status' => null);
    
        $data['order'] = $model->getalldata('tbl_order', $wherecond);
// echo '<pre>';print_r($data['order']);die;
        echo view('Admin/AdminDashboard',$data);
    }
    public function dologin()
    {
    //  print_r($_POST);die;
    $model = new Register_model();

    $session = \CodeIgniter\Config\Services::session();
    // $model = new Loginmodel();
    $mobile_no = $this->request->getPost('mobile_no');
    $password = $this->request->getPost('password');  
    $user = $model->checkCredentials(['mobile_no' => $mobile_no]);
    // print_r($user);die;
    if ($user) {
        if ($password === $user['password']) {  
            $userData = [
                'id' => $user['id'],
                'full_name' => $user['full_name'],
                // 'email' => $user['email'],
                'role' => $user['role'],
                'accesslevel'=>$user['accesslevel'],
            
            ];
            $session->set($userData);
            // print_r($userData);die;
            if ($user['role'] === 'customer') {
                return redirect()->to(base_url('product'));
            } 
                elseif ($user['role'] === 'Admin' && $userData['accesslevel']==='yourorder') {
                    return redirect()->to(base_url('yourorder'));
            } 
            elseif ($user['role'] === 'Admin') {
                return redirect()->to(('AdminDashboard'));
            } else {
                session()->setFlashdata('error', 'Invalid credentials');
                return redirect()->to('login'); 
            }
        } else {
            session()->setFlashdata('error', 'Invalid password');
            return redirect()->to('login');
        }

    } else {
        session()->setFlashdata('error', 'User not found');
        return redirect()->to('login');
    }
}
public function addmenu()
{
    echo view('Admin/addmenu');
}
public function Customerlist()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
    $model = new Register_model();

    $wherecond = array('role' => 'customer','allot_partner'=> null);

    $data['customer'] = $model->getalldata('register', $wherecond);

    $db = \Config\Database::connect();
    $builder = $db->table('register');
    $builder->like('accesslevel', 'yourorder');
    $builder->where(['role' => 'Admin', 'active' => 'Y']);
    $query = $builder->get();
    $data['userdata'] = $query->getResult();
//    echo '<pre>'; print_r($data['customer']);die;
    return view('Admin/Customerlist',$data);
}
public function setmenu()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
   $db = \Config\Database::connect();
   $data = [
       'menu_name' => $this->request->getPost('menu_name'),
       'url_location' => $this->request->getPost('url_location'),
   ];

   // Insert data into the database table
   $db->table('tbl_menu')->insert($data);
   return redirect()->to('addmenu');
}
public function adduser()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
    $model = new Register_model();
    $uri = service('uri');
    $id = $uri->getSegment(2);
    $wherecond = array('active' => 'Y', 'id' => $id);
    $data['single_data'] = $model->get_single_data('register', $wherecond);
    $wherecond = array('is_deleted' => 'N');
    $data['menu_data'] = $model->getalldata('tbl_menu', $wherecond);
    echo view('Admin/adduser', $data);
}
public function addCoustmer()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
    $model = new Register_model();
    
    $wherecond = array('is_active' => 'Y',);

    $zones = $model->getalldata('zone', $wherecond);
    return view('Admin/addCoustmer',['zones' => $zones]);
}
public function userlist()
{
    $model = new Register_model();
    $wherecond = array('role'=>'Admin','active' => 'Y');

    $data['menu_data'] = $model->getalldata('register', $wherecond);
    // print_r($data['menu_data']);die;
    echo view('Admin/userlist',$data);
}
public function addstaff()
{
    // print_r($_POST);die;
    $model = new Register_model();
    $db = \Config\Database::connect();
    
    // Get the posted access levels
    $access_level = $this->request->getPost('accesslevel');
    if (!is_array($access_level)) {
        $access_level = [];
    }

    // Prepare the data for insertion
    $data = [
        'full_name' => $this->request->getPost('full_name'),
        // 'email' => $this->request->getPost('email'),
        'role'=>'Admin',
        'mobile_no' => $this->request->getPost('mobile_no'),
        'password' => $this->request->getPost('password'),
        'accesslevel' => implode(',', $access_level),
    ];


    $db = \Config\Database::Connect();
    if ($this->request->getVar('id') ==     "") {
        $add_data = $db->table('register');
        $add_data->insert($data);
        session()->setFlashdata('success', 'Data added successfully.');
    } else {
        $update_data = $db->table('register')->where('id', $this->request->getVar('id'));
        $update_data->update($data);
        session()->setFlashdata('success', 'Data updated successfully.');
    }
    return redirect()->to('userlist');

    // return redirect()->to('produactlist');
}
public function logout()
{
    $session = session();
    // session_destroy();
    $session->destroy();
    // print_r($_SESSION);die;
    return redirect()->to('/');
}
public function Receivedorder()
{

    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
    $model = new Register_model();
    $wherecond = array('order_status' => null, 'is_deleted' => 'N');
    $data['orders'] = $model->getalldata('tbl_order', $wherecond);
    // print_r($data['orders']);die;
    return view('Admin/receivedorder',$data);
}
public function addproduct()
{
    $model = new Register_model();
    $uri = service('uri');
    $id = $uri->getSegment(2);
    $wherecond = array('is_deleted' => 'N', 'id' => $id);
    $data['single_data'] = $model->get_single_data('tbl_produact', $wherecond);
    echo view('Admin/Watersupplypoints', $data);
}
public function waterreffilpoint()
{
    $model = new Register_model();
    $uri = service('uri');
    $id = $uri->getSegment(2);
    $wherecond = array('is_deleted' => 'N', 'id' => $id);
    $data['single_data'] = $model->get_single_data('tbl_produact', $wherecond);
    echo view('Admin/waterreffilpoint', $data);
}
public function deletuser()
{ 
    $id = $this->request->getPost('id'); 
    $tableName = $this->request->getPost('table_name');

    if (!$id || !$tableName) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid input.']);
    }
    $db = \Config\Database::connect();

    try {
        $db->transBegin();
        $builder = $db->table($tableName);
        $builder->where('id', $id);
        $builder->update(['active' => 'N']);
        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return redirect()->to('userlist');
           //  return $this->response->setJSON(['status' => 'error', 'message' => 'Update failed.']);
        } else {
            $db->transCommit();
           //  return $this->response->setJSON(['status' => 'success', 'message' => 'Record updated successfully.']);
           return redirect()->to('userlist');
       }
    } catch (\Exception $e) {
        $db->transRollback();
        return redirect()->to('userlist');
       //  return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
}
public function addwatersupplypoint()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
   $db = \Config\Database::connect();
   $data = [
       'Water_Supply' => $this->request->getPost('Water_Supply'),
       'Google_location' => $this->request->getPost('Google_location'),
   ];

   // Insert data into the database table
   $db->table('water_supply_point')->insert($data);
   return redirect()->to('Watersupplypoints');
}
public function Purchasebilling()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }

    // Retrieve form data
    $refillCenter = $this->request->getPost('refillCenter');
    $tankerNumber = $this->request->getPost('tankerNumber');
    $waterType = $this->request->getPost('waterType');
    $refillQuantity = $this->request->getPost('refillQuantity');
    $deliveryDate = $this->request->getPost('deliveryDate');
    $deliveryTime = $this->request->getPost('deliveryTime');
    $cost = $this->request->getPost('cost');

    $attachment = $this->request->getFile('attachment');
    $fileName = '';

    if ($attachment->isValid() && !$attachment->hasMoved()) {
        $fileName = $attachment->getRandomName();
        $attachment->move(ROOTPATH . 'public/uploads/purchasebill', $fileName);
    }

    $data = [
        'refillCenter' => $refillCenter,
        'tankerNumber' => $tankerNumber,
        'waterType' => $waterType,
        'refillQuantity' => $refillQuantity,
        'deliveryDate' => $deliveryDate,
        'deliveryTime' => $deliveryTime,
        'cost' => $cost,
        'attachment' => $fileName,
       
    ];

    $db = \Config\Database::connect();
    $db->table('tbl_purchasebill')->insert($data);

    return redirect()->to('Purchasebill'); // Change this to your success page
}
public function fuelbilling()
{
//   print_r($_POST);die;
$session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }

    // Retrieve form data
    $tankerNumber = $this->request->getPost('tankerNumber');
    $refillDate = $this->request->getPost('refillDate');
    $refillTime = $this->request->getPost('refillTime');
    $cost = $this->request->getPost('cost');
    $Fual = $this->request->getPost('Fual');
   
    $attachment = $this->request->getFile('attachment');
    $fileName = '';

    if ($attachment->isValid() && !$attachment->hasMoved()) {
        $fileName = $attachment->getRandomName();
        $attachment->move(ROOTPATH . 'public/uploads/fuelbill', $fileName);
    }

    $data = [
        'tankerNumber' =>$tankerNumber,
        'refillDate' => $refillDate,
        'refillTime' => $refillTime,
        'cost' => $cost,
        'Fual' => $Fual,
        'attachment' => $fileName,
       
    ];

    $db = \Config\Database::connect();
    $db->table('tbl_fuelbilling')->insert($data);

    return redirect()->to('fuelbill');
}
public function addwaterreffilpoint()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
   $db = \Config\Database::connect();
   $data = [
       'Water_refill' => $this->request->getPost('Water_refill'),
       'Google_location' => $this->request->getPost('Google_location'),
   ];

   // Insert data into the database table
   $db->table('water_refill_point')->insert($data);
   return redirect()->to('waterreffilpoint');
}
public function allotdelivery()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
    
    $model = new Register_model();
    $wherecond = ['order_status' => null, 'is_deleted' => 'N'];
    $data['order'] = $model->getalldata('tbl_order', $wherecond);
    
    // Fetch matching tankers for each order
    // Assuming you have a Tanker_model to interact with tbl_tanker
    foreach ($data['order'] as $order) {
        $order->tankers = $model->getMatchingTankers($order->WaterType, $order->Size);
    }

    return view('Admin/allotdelivery', $data);
}
public function addtankers()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
    $model = new Register_model();
    $uri = service('uri');
    $id = $uri->getSegment(2);
    $wherecond = array('is_deleted' => 'N', 'id' => $id);
    $data['single_data'] = $model->get_single_data('tbl_produact', $wherecond);
    echo view('Admin/addtankers',$data);
}
public function add_tankersbyadmin()
{
    // echo '<pre>'; print_r($_POST); die;

    $Tankernumber = $this->request->getPost('Tankernumber');
    $WaterType = $this->request->getPost('WaterType');
    $Size = $this->request->getPost('Size');
    $unit = $this->request->getPost('unit');
    $price = $this->request->getPost('price');
    $ids = $this->request->getPost('id');

    $db = \Config\Database::connect();
    $tbl_produact = $db->table('tbl_tanker');

    for ($i = 0; $i < count($Tankernumber); $i++) {
        // Initialize the data array with form data for the current row
        $data = [
            'Tankernumber' => $Tankernumber[$i],
            'WaterType' => $WaterType[$i],
            'Size' => $Size[$i],
            'unit' => $unit[$i],
            'price' => $price[$i]
        ];

        // Check if the product with the same Tankernumber and Size already exists
        $existingProduct = $tbl_produact
            ->where('Tankernumber', $Tankernumber[$i])
            ->where('Size', $Size[$i])
            ->where('WaterType', $WaterType[$i])
            ->get()
            ->getFirstRow();
        
        if ($existingProduct && ($ids[$i] == "" || $existingProduct->id != $ids[$i])) {
            session()->setFlashdata('error', 'Product with the same Tankernumber and Size already exists: ' . $Tankernumber[$i] . ' - ' . $Size[$i]);
            continue;
        }

        // Insert or update product
        if ($ids[$i] == "") {
            $tbl_produact->insert($data);
        } else {
            $tbl_produact->where('id', $ids[$i])->update($data);
        }
    }

    session()->setFlashdata('success', 'Products added/updated successfully.');
    return redirect()->to('addtankers');
}
public function addCoustmersbyadmin()
{  

    $db = \Config\Database::connect();
    // print_r($_POST);die;
    // Get the POST data
    $postData = $this->request->getPost();

    $zoneId = $postData['Zone'];
    
    // Handle Society
    if ($postData['Societyname'] === 'Other') {
        $societyName = $postData['OtherSocietyname'];
        $societyData = [
            'Societyname' => $societyName,
            'zone_id' => $zoneId
        ];
        $db->table('society')->insert($societyData);
        $societyId = $db->insertID();
    } else {
        $societyId = $postData['Societyname'];
    }
    if ($postData['Buildingname'] === 'Other') {
        $buildingName = $postData['OtherBuildingname'];
        $buildingData = [
            'Buildingname' => $buildingName,
            'zone_id' => $zoneId,
            'society_id' => $societyId
        ];
        $db->table('building')->insert($buildingData);
        $buildingId = $db->insertID();
    } else {
        $buildingId = $postData['Buildingname'];
    }
    $data = [
        'full_name' => $this->request->getPost('full_name'),
        // 'email' => $this->request->getPost('email'),
        'mobile_no' => $this->request->getPost('mobile_no'),
        'role' =>'customer',
        // 'location'=>$this->request->getPost('location'),
        'alternate_name' => $this->request->getPost('Alternate_name'),
        'alternate_number' => $this->request->getPost('Alternatenumber'),
        // 'flat' => $this->request->getPost('Flat'),
        // 'floor' => $this->request->getPost('Floor'),
        'location' => $this->request->getPost('Delivery_Location'),
        'address' => $this->request->getPost('Address'),
        'password' =>$this->request->getPost('password'),
        'agree'=>'on',
        'Zone' => $zoneId,
        'Societyname' => $societyId,
        'Buildingname' => $buildingId
    ];

    // Insert data into the database table
    $db->table('register')->insert($data);
    return redirect()->to('addCoustmer'); 
}
public function addorder()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }
    $model = new Register_model();

    $wherecond = array('is_active' => 'Y');

    $data['tankers'] = $model->getalldata('tbl_tanker', $wherecond);
   
    $wherecond = array('is_active' => 'Y',);

    $data['zones']= $model->getalldata('zone', $wherecond);
  
// print_r($data['tankers']);die;
    return view('Admin/Addorder',$data);
}
public function ordertanker()
{
    print_r($_POST);die;
     // Retrieve form data from $_POST
     $data = [
        'full_name' => $this->request->getPost('full_name'),
        'mobile_no' => $this->request->getPost('mobile_no'),
        'Alternate_name' => $this->request->getPost('Alternate_name'),
        'Alternatenumber' => $this->request->getPost('Alternatenumber'),
        'Address' => $this->request->getPost('Address'),
        'location' => $this->request->getPost('Delivery_Location'),
        'WaterType' => $this->request->getPost('WaterType'),
        'Size' => $this->request->getPost('Size'),
        'deliverydate' => $this->request->getPost('deliverydate'),
        'Price' => $this->request->getPost('Price')
    ];

    // Load the database library
    $db = \Config\Database::connect();

    // Insert data into the tbl_order table
    $db->table('tbl_order')->insert($data);
    return redirect()->to('addorder'); 
}
public function getBuildingsBySociety()
{
    $postData = $this->request->getPost();
    $zone_id = $postData['zone_id'];
    $society_id = $postData['society_id'];

    $model = new Register_model();
    
    $wherecond = array(
        'is_active' => 'Y',
        'zone_id' => $zone_id,
        'society_id' => $society_id
    );

    $buildings = $model->getalldata('building', $wherecond);
    echo json_encode($buildings);
}
public function getSocietiesByZone()
{

 $postData = $this->request->getPost();
 $zone_id = $postData['zone_id']; 
 $model = new Register_model();
 $wherecond = array('zone_id' => $zone_id, 'is_active' => 'Y');
 $societies = $model->getalldata('society', $wherecond);
 echo json_encode($societies);
}
public function WaterPurchasereport()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }

    $model = new Register_model();
    $db = \Config\Database::connect();
   
    $wherecond = array('is_active' => 'Y');
    $waterreport = $model->getalldata('tbl_purchasebill', $wherecond);

    foreach ($waterreport as &$report) {
        // Fetch Size from tbl_tanker based on refillQuantity
        $tankerQuery = $db->table('tbl_tanker')->select('Size')->where('id', $report->refillQuantity)->get();
        $tankerResult = $tankerQuery->getRow();
        $report->Size = $tankerResult ? $tankerResult->Size : 'Unknown';

        // Fetch Water_refill from water_refill_point based on refillCenter
        $refillQuery = $db->table('water_refill_point')->select('Water_refill')->where('id', $report->refillCenter)->get();
        $refillResult = $refillQuery->getRow();
        $report->Water_refill = $refillResult ? $refillResult->Water_refill : 'Unknown';
    }

    $data['waterreport'] = $waterreport;

    return view('Admin/WaterPurchasereport', $data);
}

public function FuelBillreport()
{
    $session = \Config\Services::session();
    if (!$session->has('id')) {
        return redirect()->to('/');
    }

    $model = new Register_model();
    $db = \Config\Database::connect();
   
    $wherecond = array('is_active' => 'Y');
    $data['fuelbill'] = $model->getalldata('tbl_fuelbilling', $wherecond);
    
    return view('Admin/FuelBillreport', $data);
}


}
