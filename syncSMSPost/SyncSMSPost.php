<?php
//Use  data  from database to  auto  conf post address in sms server Hybertone http://www.hybertone.com/en/download.asp
//Connect to Vtiger
$db = new mysqli("localhost", "vtigercrm", "passwords", "dataBase");

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
//connect to sms servise database
$db2 = new mysqli('IPofSMSServer', 'user', 'passwords', 'dataBase');

      if($db2->connect_errno > 0){
      die('Unable to connect to database [' . $db->connect_error . ']');
}
$sql = <<<SQL
   select cf_954,cf_1159
   from vtiger_accountscf s left outer join vtiger_account a on a.accountid = s.accountid
   where  cf_954!=''
SQL;
//Select * where Sip account exist 
if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
while($row = $result->fetch_assoc()){

       $pieces = explode("|##|", $row[cf_954]);
   if  ($row[cf_1159] !== '') {
       foreach ($pieces as $value) {
         $value= trim($value);
         echo $value.'<br>'  ;
         //if Post addres set  Enable it
$sql2 ="UPDATE goip.goip SET fwd_http_enable='1',report_http='$row[cf_1159]' WHERE name='$value' limit 1";
    //print_r($sql2);
     if(!$result2 = $db2->query($sql2)){
    die('There was an error running the query [' . $db2->error . ']');
}

       }

}
  else {

  foreach ($pieces as $value) {
         $value= trim($value);
         //echo $value  ;
         //echo "\n";
         //echo "hello";
         //If there is no post address  Disable redirect
$sql3 ="UPDATE goip.goip SET fwd_http_enable='0',report_http='' WHERE name='$value' limit 1";
    //print_r($sql3);
     if(!$result3 = $db2->query($sql3)){
    die('There was an error running the query [' . $db2->error . ']');
   }
}
}
}
echo 'Total rows updated: ' . $db2->affected_rows;
$db->close();
$db2->close();
?>
